<script type="text/javascript">
  function upload() {
    var table_c = $('#transaction').DataTable()

    var file =  $('#file').prop('files')[0];
    var form_data = new FormData();                  
    form_data.append('file', file); 
    
    if(!file){
      Swal.fire({
          title: 'Gagal!',
          text: 'File harus di isi !',
          icon: "error"
      })
      return
    }
    
    var password = $('#password').val()

    if(!password){
      Swal.fire({
          title: 'Gagal!',
          text: 'Password harus di isi',
          icon: "error"
      })
      return
    }

    if(password.length < 5 || password.length > 20){
      Swal.fire({
          title: 'Gagal!',
          text: 'Password min 5 dan max 20 karakter',
          icon: "error"
      })
      return
    }

    form_data.append('password', password);

    $.ajax({
      url: '<?php echo site_url('Transaction/add');?>',
      dataType: 'text',
      cache: false,
      dataType: "json",
      contentType: false,
      processData: false,
      data: form_data,                         
      type: 'post',
      beforeSend: function() {
        Swal.showLoading()
      },
      error: function(err){
        swal.close()
        
        Swal.fire({
          title: 'Gagal!',
          text: 'Silahkan periksa kembali file anda',
          icon: "error"
        })
      },
      success: async function(res){
        swal.close()
        $('#file').val('')
        $('#password').val('')
        if(res.message == 'berhasil'){
          Swal.fire({
            title: 'Berhasil!',
            text: 'Dokumen telah berhasil di upload.',
            icon: 'success',
            timer: 3000
          })
          
          table_c.ajax.reload();
          $("#modalTambah .btn-warning").click()
        }else{
          Swal.fire({
            title: 'Gagal!',
            text: res.data,
            icon: "error"
          })
        }
      }
    })
  }
</script>