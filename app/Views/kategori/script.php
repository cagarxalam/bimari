<!-- page script -->
<script>
  $("#kategori").DataTable({
    "responsive": true, 
    "lengthChange": false, 
    "autoWidth": false
  })

  function tambah(){
    $("#tambah_kategori form").trigger("reset")
    $("#tambah_kategori form input").removeClass("is-invalid")
    $("#tambah_kategori form span.error").remove()
    $("#tambah_kategori").modal("show")
  }

  function edit(id){
    $.ajax({
      url: '/kategori/show',
      type: 'post',
      dataType: 'json',
      data: {id:id},
      success(a){
        $("#edit_kategori input[name='id']").val(a.id)
        $("#edit_kategori input[name='jenis']").val(a.jenis)
        $("#edit_kategori input[name='satuan']").val(a.satuan)
        $("#edit_kategori form input").removeClass("is-invalid")
        $("#edit_kategori form span.error").remove()
        $("#edit_kategori").modal("show")
      },
      error(e){
        console.log(e)
      }
    })
  }

  function hapus(id){
    if(confirm('Apakah anda yakin?')){
      $.ajax({
        url: 'kategori/hapus',
        type: 'post',
        dataType: 'json',
        data: {id:id},
        success(a){
          if(a == null){
            $("#kategori").DataTable().clear().draw()
          } else {
            $("#kategori").DataTable().destroy();
            $("#tbody").empty()

            // append data to tbody
            for (let i = 0; i < a.length; i++) {
              $("#tbody").append(a[i])
            }

            // re-initialize datatable
            $("#kategori").DataTable({
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

  $('#tambah_kategori form').validate({
    rules: {
      jenis: {
        required: true,
      },
      satuan: {
        required: true,
      }
    },
    messages: {
      jenis: {
        required: "Silahkan masukkan kategori"
      },
      satuan: {
        required: "Silahkan masukkan satuan"
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
        url: 'kategori/tambah',
        type: 'post',
        dataType: 'json',
        data: form,
        processData: false,
        contentType: false,
        success(a){
          $("#kategori").DataTable().destroy();
          $("#tbody").empty()

          // append data to tbody
          for (let i = 0; i < a.length; i++) {
            $("#tbody").append(a[i])
          }

          // re-initialize datatable
          $("#kategori").DataTable({
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false
          })

          // close modal
          $("#tambah_kategori").modal("hide")
        },
        error(e){
          console.log(e)
        }
      })
    }
  })

  $('#edit_kategori form').validate({
    rules: {
      jenis: {
        required: true,
      },
      satuan: {
        required: true,
      }
    },
    messages: {
      jenis: {
        required: "Silahkan masukkan kategori"
      },
      satuan: {
        required: "Silahkan masukkan satuan"
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
        url: 'kategori/update',
        type: 'post',
        dataType: 'json',
        data: form,
        processData: false,
        contentType: false,
        success(a){
          $("#kategori").DataTable().destroy()
          $("#rows-"+a.id).replaceWith(a.tr)
          $("#kategori").DataTable({
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false
          }).draw()

          $("#edit_kategori").modal("hide")
        },
        error(e){
          console.log(e)
        }
      })
    }
  })
</script>