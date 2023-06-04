<script type="text/javascript">
  function tambah() {
    var table_c = $('#user').DataTable()

    var nama = $('#nama').val()
    var email = $('#email').val()
    var password = $('#password').val()
    var role = $('#role').val()

    var data = [
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

    if(!password){
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        html: '<b>Password</b> tidak boleh kosong.'
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
      url: '<?php echo base_url('User/add') ?>',
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
              $('#nama').val('')
              $('#email').val('')
              $('#password').val('')
              $('#role').val('')
              $("#modalTambah .btn-warning").click()
            });
          }else{
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Data telah berhasil di tambah.',
              showConfirmButton: false,
              timer: 1500
            }).then(() => {
              $('#nama').val('')
              $('#email').val('')
              $('#password').val('')
              $('#role').val('')
              $("#modalTambah .btn-warning").click()
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