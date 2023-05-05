<div id="contactsModal" class="modal" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content pull-right">
        <div class="sModalHeader"><p class="header-label"><i class="fa fa-phone"></i> <b>CONTACTS</b></p></div>
    <div class="row alert-m">
</div>
<div class="modal-body div-docs">
    <div class="row">
        <div class="col-md-10">
            <label><i class="fa fa-plus-circle"></i> ADD CUSTOMER CONTACT</label>
        </div>
        <div class="col-md-6">
            <label><b>Contact Name</b></label>
            <input id="contact_name_style" type="text" class="form-control contact_name_val" name="contact_nmae">
        <span id="contact-name-text"></span>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-10">
        <button id="email-notif-btn" type="button" 
            class="btn btn-success btn-sm" onclick="submitSubsContacts()">
            <i class="fa fa-save"></i> SUBMIT</button>
        </div>
    </div>

<br>
<div class="row">
    <div class="col-md-12">
        <div class="subsContactsTable"></div>
        </div>
    <hr>
</div>
<div class="modal-footer">
    <div class="row s-btn">
        </div>
            <button type="button" 
                class="btn btn-secondary btn-sm" data-dismiss="modal">
                <i class="fa fa-window-close"></i> CLOSE</button>
            </div>
        </div>
    </div>
</div>
