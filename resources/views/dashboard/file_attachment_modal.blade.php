<div class="modal fileAttachmentModal" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content pull-right">
        <div class="sModalHeader"><p class="header-label"><i class="fa fa-envelope"></i> <b>File Attachment</b></p></div>
    <div class="row alert-m">
</div>
<div class="modal-body div-docs">
    <div class="row addNewNotif">
        <div class="col-md-6">
            <label><b>Subject</b></label>
                <input id="subject_style" type="text" class="form-control subject" name="subject">
            <span id="subject-text"></span>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label><b>Message</b></label>
                    <input id="message_style" type="text" class="form-control message" name="message">
                <span id="message-text"></span>
            </div>
        </div>
        <div class="col-md-3">
            <label><b>When to Send</b></label>
                <select id="when_to_send_style" class="form-control when_to_send" name="when_to_send">
                    <option value="90">90 Days</option>
                    <option value="60">60 Days</option>
                    <option value="30">30 Days</option>
                </select>
            <span id="when-to-send-text"></span>
        </div>
        <div class="col-md-12" style="margin-top: 20px;">
            <button id="email-notif-btn" type="button" 
                class="btn btn-success btn-sm" onclick="submitFileAttachment()">
                <i class="fa fa-save"></i> SUBMIT</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 emailNotifsTable">
                </div>
        </div>
        <div class="modal-footer">
            <div class="row s-btn">
                </div>
                <button type="button" 
            class="btn btn-secondary btn-sm" data-dismiss="modal" style="margin-top: 15px;">
        <i class="fa fa-window-close"></i> CLOSE</button>
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