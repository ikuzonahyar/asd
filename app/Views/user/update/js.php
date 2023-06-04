<script type="text/javascript">
  function update() {
    var table_c = $('#user').DataTable()

    var id_user = $('#id_user').val()
    var nama = $('#namaUpdate').val()
    var email = $('#emailUpdate').val()
    var password = $('#passwordUpdate').val()
    var role = $('#roleUpdate').val()

    var data = [
      id_user,
      nama,
      email,
      password,
      role,
    ];
    
    if(!nama){
      swal.fire({
        icon: 'error',
        title: 'Gagal',
        html: '<b>Nama</b> tidak boleh kosong.'
      })
      return
    }

    if(!email){
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        html: '<b>Email</b> tidak boleh kosong.'
      })
      return
    }

    if(!role){
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        html: '<b>Jabatan</b> harus dipilih.'
      })
      return
    }

    $.ajax({
      url: '<?php echo base_url('User/update') ?>',
      type: 'POST',
      dataType: 'json',
      data: {'data':data},
      beforeSend: function() {
        Swal.showLoading()
      },
      error: function() {
        swal.close()
        
        // $.ajax({
        //   url: '<?php echo base_url('Login/cek_session'); ?>',
        //   type: 'GET',
        //   success: function(response){
        //     try {
        //       JSON.parse(response)

        //       Swal.fire({
        //         icon: 'error',
        //         title: 'Gagal',
        //         text: 'Terjadi kesalahan, mohon input kembali.'
        //       })
        //     } catch (err) {
        //       window.open('<?php echo base_url('Login/token_habis') ?>', '_self')
        //     }
        //   }
        // })
      },
      success: function(res) {
        if(res.message){
          if(res.message == 'gagal'){
            Swal.fire({
              icon: 'error',
              title: 'Gagal',
              text: res.error
            }).then(() => {
              $('#namaUpdate').val('')
              $('#emailUpdate').val('')
              $('#passwordUpdate').val('')
              $('#roleUpdate').val('')
              $("#modalUpdate .btn-warning").click()
            });
          }else{
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Data telah berhasil di update.',
              showConfirmButton: false,
              timer: 1500
            }).then(() => {
              $('#namaUpdate').val('')
              $('#emailUpdate').val('')
              $('#passwordUpdate').val('')
              $('#roleUpdate').val('')
              $("#modalUpdate .btn-warning").click()
            });
          }
          
          table_c.ajax.reload();
        }else{
          Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Terjadi kesalahan, mohon input kembali.'
          })
        }
      }
    })
  }
</script>