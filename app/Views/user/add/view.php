<div id="modalTambah" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header" style="padding:1rem">
                <h4><b>Add User</b></h4>
            </div>
            <div class="modal-body" style="height: auto;">
              <div class="form-group">
                  <label for="">Nama</label>
                  <input name="nama" id="nama" class="form-control form-control-sm" placeholder="Input nama.." type="text" autocomplete="off">
              </div>
              <div class="form-group">
                  <label for="">Email</label>
                  <input name="email" id="email" class="form-control form-control-sm" placeholder="Input email.." type="email" autocomplete="off">
              </div>
              <div class="form-group">
                  <label for="">Password</label>
                  <input name="password" id="password" class="form-control form-control-sm" type="password" autocomplete="off">
              </div>
              <div class="form-group">
                  <label for="">Jabatan</label>
                  <select id="role" class="form-control form-control-sm">
                      <option value="" selected disabled>--Pilih--</option>
                      <option value="1">Pemilik</option>
                      <option value="2">Pegawai</option>
                  </select>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="tambah" onclick="tambah()" class="btn btn-success">
                    Simpan
                </button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>