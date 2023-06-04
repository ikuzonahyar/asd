<?php echo view('user/add/js') ?>
<?php echo view('user/update/js') ?>

<script type="text/javascript">
  $(document).ready(function(){
    var table = $('#user').DataTable({
      ajax: "<?php echo base_url('User/listData'); ?>",
      columns: [
        { "data" : "<?="id_user"?>" },
        { "data" : "<?="nama"?>" },
        { "data" : "<?="email"?>" },
        { "data" : "<?="role"?>" },
        { 
          "data" : "<?="id_user"?>", render : function ( data, type, row, meta ) 
          {
            return type === 'display'  ? '<button type="button" class="btn btn-sm btn-warning btn-edit" data-id="'+ data +'" data-toggle="modal" data-target="#modalUpdate"><i class="fa fa-edit text-dark"></i> Edit</button>&nbsp;<button type="button" class="btn btn-sm btn-danger btn-delete" data-id="'+ data +'"><i class="fa fa-trash text-light"></i> Delete</button>' : data;
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

    $('#user tbody').on('click', '.btn-edit', function(){
      var all_data = table.row($(this).parents('tr')).data()

      $('#id_user').val(all_data['id_user'])
      $('#namaUpdate').val(all_data['nama'])
      $('#emailUpdate').val(all_data['email'])
      $('#roleUpdate').val(all_data['role'])
    });

    $('#user tbody').on('click', '.btn-delete', function(){
      var table_c = $('#user').DataTable()
      var all_data = table.row($(this).parents('tr')).data()
      
      var data = [
        all_data['id_user']
      ];

      Swal.fire({
        title: 'Yakin akan menghapus data?',
        showDenyButton: true,
        confirmButtonText: 'Iya',
        denyButtonText: `Tidak`,
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '<?php echo base_url('User/delete') ?>',
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