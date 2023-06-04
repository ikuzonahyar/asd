<div id="modalUpdate" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header" style="padding:1rem">
                <h4><b>Update User</b></h4>
            </div>
            <div class="modal-body" style="height: auto;">
              <input type="text" name="id_user" id="id_user" hidden>
              <div class="form-group">
                  <label for="">Nama</label>
                  <input name="namaUpdate" id="namaUpdate" class="form-control form-control-sm" placeholder="Input nama.." type="text" autocomplete="off">
              </div>
              <div class="form-group">
                  <label for="">Email</label>
                  <input name="emailUpdate" id="emailUpdate" class="form-control form-control-sm" placeholder="Input email.." type="email" autocomplete="off">
              </div>
              <div class="form-group">
                  <label for="">Password Baru</label>
                  <input name="passwordUpdate" id="passwordUpdate" class="form-control form-control-sm" type="password" autocomplete="off">
                  <span style="color:red;font-size:15px"><i>*biarkan kosong jika password tidak berubah</i></span>
              </div>
              <div class="form-group">
                  <label for="">Jabatan</label>
                  <select id="roleUpdate" class="form-control form-control-sm">
                      <option value="" selected disabled>--Pilih--</option>
                      <option value="1">Pemilik</option>
                      <option value="2">Pegawai</option>
                  </select>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="update" onclick="update()" class="btn btn-success">
                    Simpan
                </button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>