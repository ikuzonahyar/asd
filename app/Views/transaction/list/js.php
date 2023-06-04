<?php echo view('transaction/add/js') ?>
<?php echo view('transaction/decrypt/js') ?>

<script type="text/javascript">
  $(document).ready(function(){
    
    var table = $('#transaction').DataTable({
      ajax: "<?php echo base_url('Transaction/listData'); ?>",
      columns: [
        { "data" : "<?="id_file"?>" },
        { "data" : "<?="file_name_source"?>" },
        { "data" : "<?="tgl_upload"?>" },
        { "data" : "<?="user"?>" },
        { 
          "data" : "<?="id_file"?>", render : function ( data, type, row, meta ) 
          {
            return type === 'display'  ? '<button type="button" class="btn btn-sm btn-primary btn-edit" data-toggle="modal" data-target="#modalUpdate"><i class="fa fa-download"></i> Decrypt</button>&nbsp;<button type="button" class="btn btn-sm btn-danger btn-delete" data-id="'+ data +'"><i class="fa fa-trash text-light"></i> Delete</button>' : data;
          }
        }
      ],
      dom: "<'row'<'col-sm-6 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
      buttons: [
        {
          className: 'btn btn-success',
          text: '<i class="fa fa-plus"></i> TAMBAH',
          action: function ( e, dt, node, config ) 
          {
            $('#modalTambah').modal('show'); 
          }
        }
      ]
    });

    var table_c = $('#transaction').DataTable()

    $('#transaction tbody').on('click', '.btn-edit', function(){
      var all_data = table.row($(this).parents('tr')).data()

      $('#id_file').val(all_data['id_file'])
    });

    $('#transaction tbody').on('click', '.btn-delete', function(){
      var all_data = table.row($(this).parents('tr')).data()

      var data = [
        all_data['id_file']
      ]

      Swal.fire({
        title: 'Yakin akan menghapus data?',
        showDenyButton: true,
        confirmButtonText: 'Iya',
        denyButtonText: `Tidak`,
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '<?php echo base_url('Transaction/delete') ?>',
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
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Data telah berhasil di hapus.',
                showConfirmButton: false,
                timer: 1500
              })
              table_c.ajax.reload();
            }
          })
        } else if (result.isDenied) {
          Swal.close()
        }
      })
    });
  });
</script>