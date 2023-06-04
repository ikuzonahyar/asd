<script type="text/javascript">
  function decrypt() {
    if(!$('#passwordD').val()){
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: 'Password harus di isi'
      })

      return
    }

    var data = [
      $('#id_file').val(),
      $('#passwordD').val(),
    ];
    
    $.ajax({
      url: '<?php echo base_url('Transaction/decrypt') ?>',
      type: 'POST',
      dataType: 'json',
      data: {data:data},
      beforeSend: function() {
        Swal.showLoading()
      },
      error: function() {
        swal.close()
    
        $.ajax({
          url: '<?php echo base_url('Login/cek_session'); ?>',
          type: 'GET',
          success: function(response){
            try {
              JSON.parse(response)

              Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Terjadi kesalahan, mohon input kembali.'
              })
            } catch (err) {
              window.open('<?php echo base_url('Login/token_habis') ?>', '_self')
            }
          }
        })
      },
      success: function(res) {
        if(res.message == 'berhasil'){
          swal.close()
          $('#passwordD').val('')
          $("#modalUpdate .btn-warning").click()

          $("#download").attr("href", '<?php echo base_url('file') ?>/'+res.data)
          window.location.href = $('#download').attr('href');

          Swal.fire({
            title: 'Berhasil!',
            text: 'Dokumen telah berhasil di decrypt.',
            icon: 'success',
            timer: 3000
          })
        }else{
          Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: res.data
          })
        }
        
        // window.open('<?php echo base_url('Transaction/download') ?>/'+all_data['id_transaction'])
      }
    })
  }
</script>