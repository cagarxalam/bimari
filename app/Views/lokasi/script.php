<!-- page script -->
<script>
  $("#lokasi").DataTable({
    "responsive": true, 
    "lengthChange": false, 
    "autoWidth": false
  })

  function tambah(){
    $("#tambah_lokasi form").trigger("reset")
    $("#tambah_lokasi form input").removeClass("is-invalid")
    $("#tambah_lokasi form span.error").remove()
    $("#tambah_lokasi").modal("show")
  }

  function edit(id){
    $.ajax({
      url: '/lokasi/show',
      type: 'post',
      dataType: 'json',
      data: {id:id},
      success(a){
        $("#edit_lokasi input[name='id']").val(a.id)
        $("#edit_lokasi input[name='lokasi']").val(a.lokasi)
        
        $("#edit_lokasi form input").removeClass("is-invalid")
        $("#edit_lokasi form span.error").remove()
        $("#edit_lokasi").modal("show")
      },
      error(e){
        console.log(e)
      }
    })
  }

  function hapus(id){
    if(confirm('Apakah anda yakin?')){
      $.ajax({
        url: 'lokasi/hapus',
        type: 'post',
        dataType: 'json',
        data: {id:id},
        success(a){
          if(a == null){
            $("#lokasi").DataTable().clear().draw()
          } else {
            $("#lokasi").DataTable().destroy();
            $("#tbody").empty()

            // append data to tbody
            for (let i = 0; i < a.length; i++) {
              $("#tbody").append(a[i])
            }

            // re-initialize datatable
            $("#lokasi").DataTable({
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

  $('#tambah_lokasi form').validate({
    rules: {
      lokasi: {
        required: true,
      }
    },
    messages: {
      lokasi: {
        required: "Silahkan masukkan lokasi aset"
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
        url: '/lokasi/tambah',
        type: 'post',
        dataType: 'json',
        data: form,
        processData: false,
        contentType: false,
        success(a){
          $("#lokasi").DataTable().destroy();
          $("#tbody").empty()

          // append data to tbody
          for (let i = 0; i < a.length; i++) {
            $("#tbody").append(a[i])
          }

          // re-initialize datatable
          $("#lokasi").DataTable({
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false
          })

          // close modal
          $("#tambah_lokasi").modal("hide")
        },
        error(e){
          console.log(e)
        }
      })
    }
  })

  $('#edit_lokasi form').validate({
    rules: {
      lokasi: {
        required: true,
      }
    },
    messages: {
      lokasi: {
        required: "Silahkan masukkan lokasi aset"
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
        url: 'lokasi/update',
        type: 'post',
        dataType: 'json',
        data: form,
        processData: false,
        contentType: false,
        success(a){
          $("#lokasi").DataTable().destroy();
          $("#tbody").empty()

          // append data to tbody
          for (let i = 0; i < a.length; i++) {
            $("#tbody").append(a[i])
          }

          // re-initialize datatable
          $("#lokasi").DataTable({
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false
          })

          // close modal
          $("#edit_lokasi").modal("hide")
        },
        error(e){
          console.log(e)
        }
      })
    }
  })
</script>