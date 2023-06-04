<a id="download" href="#" download hidden>download</a>
<div id="modalUpdate" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header" style="padding:1rem">
                <h4><b>Decrypt FIle</b></h4>
            </div>
            <div class="modal-body" style="height: auto;">
              <input type="text" name="id_file" id="id_file" hidden>
              <div class="form-group">
                  <label for="">Masukan Password</label>
                  <input name="passwordD" id="passwordD" class="form-control form-control-sm" type="password" autocomplete="off">
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="update" onclick="decrypt()" class="btn btn-success">
                    Simpan
                </button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>