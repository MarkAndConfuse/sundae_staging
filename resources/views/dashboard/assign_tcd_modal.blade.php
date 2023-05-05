<div class="modal assignTcdModal" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content pull-right">
        <div class="sModalHeader"><p class="header-label"><i class="fa fa-link"></i> <b>Assign TCD</b></p></div>
    <div class="row alert-m">
</div>
<div class="modal-body div-docs">
    <div class="row">
        <div class="col-md-6">
            <label><b>TCD Account Name</b></label>
                <input id="tcd_name_style" type="text" class="form-control tcd_name_val" name="tcd_name" readonly>
                <input type="hidden" class="form-control account_id_val" name="account_id">
                <input type="hidden" class="form-control account_email_val" name="email">
                <input type="hidden" class="form-control created_by_val" name="created_by" value="{{ session()->get('GoogleName') }}" />
                <input type="hidden" class="form-control subs_id" name="id"/>
                <span id="tcd-name-text"></span>
            </div>
        </div>
    <br />
<div class="tcdList"></div>
    <hr>
<div class="cdbaccountsTcd">
    </div>
<div class="card-body cdb-tcd-body">
    </div>
</div>
<div class="modal-footer">
    <div class="row s-btn">
        </div>
            <button id="assign-tcd-btn" type="button" 
                class="btn btn-success btn-sm" onclick="submitAssignTCD()">
                <i class="fa fa-save"></i> SUBMIT</button>
                <button type="button" 
                class="btn btn-secondary btn-sm" data-dismiss="modal">
                <i class="fa fa-window-close"></i> CLOSE</button>
            </div>
        </div>
    </div>
</div>
<style>
.modal-backdrop
{
    opacity:0.5 !important;
}
.sModalHeader {
    background-color: #E83E8C;
    text-transform: uppercase;
    height: 43px;
}
.header-label {
    margin-top: 10px;
    margin-left: 10px;
}
.material-desc-text {
    margin-top: -15px;
}
.alert-margin {
    margin-top: 12px;
}
.data-text {
    margin-top: -12px;
}
</style>