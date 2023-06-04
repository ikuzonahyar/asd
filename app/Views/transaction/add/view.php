<div id="modalTambah" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header" style="padding:1rem">
                <h4><b>Add Transaction</b></h4>
            </div>
            <div class="modal-body" style="height: auto;">
              <div class="form-group">
                  <label for="">Upload file</label>
                  <input name="file" id="file" class="form-control" type="file" accept=".xlsx,.xls,.docx,.ppt, .pptx,.txt,.pdf">
              </div>
              <div class="form-group">
                  <label for="">Password</label>
                  <input name="password" id="password" class="form-control" type="password">
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="tambah" onclick="upload()" class="btn btn-success">
                    Encrypt
                </button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>