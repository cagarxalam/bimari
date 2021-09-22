<!-- page script -->
<script>
  $("#izin").DataTable({
    "responsive": true, 
    "lengthChange": false, 
    "autoWidth": false
  })

  function tambah(){
    $("#tambah_izin form .is-invalid").removeClass("is-invalid")
    $("#tambah_izin form span.error").remove()
    $("#tambah_izin form").trigger("reset")
    $("#tambah_izin").modal("show")
  }

  function edit(id){
    $("#edit_izin option").removeAttr("selected")
    $.ajax({
      url: '/pengajuan-barang/show',
      type: 'post',
      dataType: 'json',
      data: {id:id},
      success(a){
        $("#edit_izin input[name='id']").val(a.id)
        $("#edit_izin input[name='prevStok']").val(a.stok)
        $("#edit_izin select[name='barang'] option[value='"+a.stok+"']").attr("selected","selected")
        $("#edit_izin input[name='pemohon']").val(a.pemohon)
        $("#edit_izin select[name='lokasi'] option[value='"+a.lokasi+"']").attr("selected","selected")
        $("#edit_izin input[name='jumlah']").val(a.jumlah)

        //clear validation
        $("#edit_izin form .is-invalid").removeClass("is-invalid")
        $("#edit_izin form span.error").remove()
        $("#edit_izin").modal("show")
      },
      error(e){
        console.log(e)
      }
    })
  }

  function hapus(id,id_stok){
    if(confirm('Apakah anda yakin?')){
      $.ajax({
        url: '/pengajuan-barang/hapus',
        type: 'post',
        dataType: 'json',
        data: {id:id,id_stok:id_stok},
        success(a){
          if(a == null) {
            $("#izin").DataTable().clear().draw()
          } else {
            // destroy datatable first
            $("#izin").DataTable().destroy()
            // empty tbody
            $("#tbody").empty()

            // append tr
            for (let i = 0; i < a.length; i++) {
              $("#tbody").append(a[i])
            }

            // re-intialize DataTable
            $("#izin").DataTable({
              "responsive": true, 
              "lengthChange": false, 
              "autoWidth": false
            })
          }
        },
        error(e){
          console.log(e.responseJSON.message)
        }
      })
    }
  }

  $('#tambah_izin form').validate({
    rules: {
      pemohon: {
        required: true
      },
      jumlah: {
        required: true,
        number: true
      }
    },
    messages: {
      pemohon: {
        required: 'Silahkan isi nama pemohon'
      },
      jumlah: {
        required: 'Silahkan isi jumlah',
        number: 'Silahkan isi dengan angka'
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
        url: '/pengajuan-barang/tambah',
        type: 'post',
        dataType: 'json',
        data: form,
        processData: false,
        contentType: false,
        success(a){
          if(a == null) {
            $("#izin").DataTable().clear().draw()
          } else {
            // destroy datatable first
            $("#izin").DataTable().destroy()
            // empty tbody
            $("#tbody").empty()

            // append tr
            for (let i = 0; i < a.length; i++) {
              $("#tbody").append(a[i])
            }

            // re-intialize DataTable
            $("#izin").DataTable({
              "responsive": true, 
              "lengthChange": false, 
              "autoWidth": false
            })
          }

          $("#tambah_izin").modal("hide")
        },
        error(e){
          console.log(e)
        }
      })
    }
  })

  $('#edit_izin form').validate({
    rules: {
      pemohon: {
        required: true
      },
      jumlah: {
        required: true,
        number: true
      }
    },
    messages: {
      pemohon: {
        required: 'Silahkan isi nama pemohon'
      },
      jumlah: {
        required: 'Silahkan isi jumlah',
        number: 'Silahkan isi dengan angka'
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
        url: '/pengajuan-barang/update',
        type: 'post',
        dataType: 'json',
        data: form,
        processData: false,
        contentType: false,
        success(a){
          if(a == null) {
            $("#izin").DataTable().clear().draw()
          } else {
            // destroy datatable first
            $("#izin").DataTable().destroy()
            // empty tbody
            $("#tbody").empty()

            // append tr
            for (let i = 0; i < a.length; i++) {
              $("#tbody").append(a[i])
            }

            // re-intialize DataTable
            $("#izin").DataTable({
              "responsive": true, 
              "lengthChange": false, 
              "autoWidth": false
            })
          }

          $("#edit_izin").modal("hide")
        },
        error(e){
          console.log(e)
        }
      })
    }
  })
</script>