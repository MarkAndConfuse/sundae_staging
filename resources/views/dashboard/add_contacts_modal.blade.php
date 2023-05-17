<div class="modal addContact" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content pull-right">
        <div class="sModalHeader"><p class="header-label"><i class="fa fa-plus-circle"></i> <b>Add Contacts</b></p></div>
    <div class="row alert-c">
</div>
<div class="modal-body div-docs">
    <div class="row">
        <div class="col-md-3">
            <label><b>Salutation</b></label>
                <input id="c_s_style" type="text" class="form-control c_s_val" name="Salutation">    
            <span id="c-s-text"></span>
        </div>
        <div class="col-md-3">
            <label><b>Firstname</b></label>
                <input id="c_fName_style" type="text" class="form-control c_firstname_val" name="FirstName">
            <span id="c-fName-text"></span>
        </div>
        <div class="col-md-3">
            <label><b>Middlename</b></label>
                <input id="c_mName_style" type="text" class="form-control c_middlename_val" name="MiddleName">
            <span id="c-mName-text"></span>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label><b>Lastname</b></label>
                    <input id="c_lName_style" type="text" class="form-control c_lastname_val" name="LastName">
                <span id="c-lName-text"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label><b>Email</b></label>
                <input id="c_email_style" type="text" class="form-control c_email_val" name="Email">
            <span id="c-email-text"></span>
        </div>
        <div class="col-md-3">
            <label><b>Mobile No.</b></label>
                <input id="c_mobile_style" type="text" class="form-control c_mobile_val" name="Mobile">
            <span id="c-mobile-text"></span>
        </div>
        <div class="col-md-3">
            <label><b>Telephone No.</b></label>
                <input id="c_tel_style" type="text" class="form-control c_telephone_val" name="Telephone">
            <span id="c-tel-text"></span>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label><b>Designation</b></label>
                    <input id="c_designation_style" type="text" class="form-control c_designation_val" name="Designation">
                <span id="c-designation-text"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label><b>Address</b></label>
                <input id="c_address_style" type="text" class="form-control c_address_val" name="Address">
            <span id="c-address-text"></span>
        </div>
    </div>
</div>
<div class="modal-footer">
    <div class="row s-btn">
        </div>
            <button id="add-contact-btn" type="button" 
                class="btn btn-success btn-sm" onclick="submitContact(event)">
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