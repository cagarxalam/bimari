<!-- page script -->
<script>
  $("#example1").DataTable({
    "responsive": true, 
    "lengthChange": false, 
    "autoWidth": false
  })

  function tambah(){
    $("#tambah_barang form .is-invalid").removeClass("is-invalid")
    $("#tambah_barang form span.error").remove()
    $("#tambah_barang form").trigger("reset")
    $("#tambah_barang").modal("show")
  }

  function edit(id){
    $("#edit_barang option").removeAttr("selected")
    $.ajax({
      url: '/stok/show',
      type: 'post',
      dataType: 'json',
      data: {id:id},
      success(a){
        $("#edit_barang option[value='"+a.jenis+"']").attr("selected","selected")
        $("#edit_barang input[name='id']").val(a.id)
        $("#edit_barang input[name='barang']").val(a.barang)
        $("#edit_barang input[name='merk']").val(a.merk)
        $("#edit_barang input[name='jumlah']").val(a.jumlah)

        //clear validation
        $("#edit_barang form .is-invalid").removeClass("is-invalid")
        $("#edit_barang form span.error").remove()
        $("#edit_barang").modal("show")
      },
      error(e){
        console.log(e)
      }
    })
  }

  function hapus(id){
    if(confirm('Apakah anda yakin?')){
      $.ajax({
        url: 'stok/delete',
        type: 'post',
        dataType: 'json',
        data: {id:id},
        success(a){
          if(a == null) {
            $("#example1").DataTable().clear().draw()
          } else {
            // destroy datatable first
            $("#example1").DataTable().destroy()
            // empty tbody
            $("#tbody").empty()

            // append tr
            for (let i = 0; i < a.length; i++) {
              $("#tbody").append(a[i])
            }

            // re-intialize DataTable
            $("#example1").DataTable({
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

  $('#tambah_barang form').validate({
    rules: {
      barang: {
        required: true
      },
      merk: {
        required: true
      },
      jumlah: {
        required: true,
        number:   true,
      }
    },
    messages: {
      barang: {
        required: "Silahkan masukkan nama barang"
      },
      merk: {
        required: "Silahkan masukkan merk"
      },
      jumlah: {
        required: 'Silahkan masukkan jumlah',
        number:   'Masukkan dengan angka',
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
        url: 'stok/tambah',
        type: 'post',
        dataType: 'json',
        data: form,
        processData: false,
        contentType: false,
        success(a){
          if(a == null) {
            $("#example1").DataTable().clear().draw()
          } else {
            // destroy datatable first
            $("#example1").DataTable().destroy()
            // empty tbody
            $("#tbody").empty()

            // append tr
            for (let i = 0; i < a.length; i++) {
              $("#tbody").append(a[i])
            }

            // re-intialize DataTable
            $("#example1").DataTable({
              "responsive": true, 
              "lengthChange": false, 
              "autoWidth": false
            })
          }

          $("#tambah_barang").modal("hide")
        },
        error(e){
          console.log(e)
        }
      })
    }
  })

  $('#edit_barang form').validate({
    rules: {
      barang: {
        required: true
      },
      merk: {
        required: true
      },
      jumlah: {
        required: true,
        number:   true,
      }
    },
    messages: {
      barang: {
        required: "Silahkan masukkan nama barang"
      },
      merk: {
        required: "Silahkan masukkan merk"
      },
      jumlah: {
        required: 'Silahkan masukkan jumlah',
        number:   'Masukkan dengan angka',
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
        url: 'stok/update',
        type: 'post',
        dataType: 'json',
        data: form,
        processData: false,
        contentType: false,
        success(a){
          if(a == null) {
            $("#example1").DataTable().clear().draw()
          } else {
            // destroy datatable first
            $("#example1").DataTable().destroy()
            // empty tbody
            $("#tbody").empty()

            // append tr
            for (let i = 0; i < a.length; i++) {
              $("#tbody").append(a[i])
            }

            // re-intialize DataTable
            $("#example1").DataTable({
              "responsive": true, 
              "lengthChange": false, 
              "autoWidth": false
            })
          }

          $("#edit_barang").modal("hide")
        },
        error(e){
          console.log(e)
        }
      })
    }
  })
</script>