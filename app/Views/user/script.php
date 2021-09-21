<!-- page script -->
<script>
  $("#user").DataTable({
    "responsive": true, 
    "lengthChange": false, 
    "autoWidth": false
  })

  function tambah(){
    $("#tambah_user form").trigger("reset")
    $("#tambah_user form input").removeClass("is-invalid")
    $("#tambah_user form span.error").remove()
    $("#tambah_user").modal("show")
  }

  function edit(id){
    $.ajax({
      url: '/user/show',
      type: 'post',
      dataType: 'json',
      data: {id:id},
      success(a){
        $("#edit_user input[name='id']").val(a.id)
        $("#edit_user input[name='nama']").val(a.nama)
        
        $("#edit_user form input").removeClass("is-invalid")
        $("#edit_user form span.error").remove()
        $("#edit_user").modal("show")
      },
      error(e){
        console.log(e)
      }
    })
  }

  function hapus(id){
    if(confirm('Apakah anda yakin?')){
      $.ajax({
        url: 'user/hapus',
        type: 'post',
        dataType: 'json',
        data: {id:id},
        success(a){
          if(a == null){
            $("#user").DataTable().clear().draw()
          } else {
            $("#user").DataTable().destroy();
            $("#tbody").empty()

            // append data to tbody
            for (let i = 0; i < a.length; i++) {
              $("#tbody").append(a[i])
            }

            // re-initialize datatable
            $("#user").DataTable({
              "responsive": true, 
              "lengthChange": false, 
              "autoWidth": false
            })
          }
        },
        error(e){
          console.log(e)
        }
      })
    }
  }

  $('#tambah_user form').validate({
    rules: {
      nama: {
        required: true,
      },
      password: {
        required: true,
      }
    },
    messages: {
      nama: {
        required: "Silahkan masukkan nama"
      },
      password: {
        required: "Silahkan masukkan password",
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    },
    submitHandler: function(data){
      var form = new FormData(data)
      $.ajax({
        url: '/user/tambah',
        type: 'post',
        dataType: 'json',
        data: form,
        processData: false,
        contentType: false,
        success(a){
          $("#user").DataTable().destroy();
          $("#tbody").empty()

          // append data to tbody
          for (let i = 0; i < a.length; i++) {
            $("#tbody").append(a[i])
          }

          // re-initialize datatable
          $("#user").DataTable({
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false
          })

          // close modal
          $("#tambah_user").modal("hide")
        },
        error(e){
          console.log(e)
        }
      })
    }
  })

  $('#edit_user form').validate({
    rules: {
      nama: {
        required: true,
      }
    },
    messages: {
      nama: {
        required: "Silahkan masukkan nama"
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    },
    submitHandler: function(data){
      var form = new FormData(data)
      $.ajax({
        url: '/user/update',
        type: 'post',
        dataType: 'json',
        data: form,
        processData: false,
        contentType: false,
        success(a){
          $("#user").DataTable().destroy();
          $("#tbody").empty()

          // append data to tbody
          for (let i = 0; i < a.length; i++) {
            $("#tbody").append(a[i])
          }

          // re-initialize datatable
          $("#user").DataTable({
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false
          })

          // close modal
          $("#edit_user").modal("hide")
        },
        error(e){
          console.log(e)
        }
      })
    }
  })
</script>