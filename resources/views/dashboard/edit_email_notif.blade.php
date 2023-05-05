<div class="row addNewNotif" style="margin-left: 3px;">
    <div class="col-md-10">
        <label><i class="fa fa-edit"> </i> Edit Email Notification</label>
    </div>
    <div class="col-md-6">
        <label><b>Subject</b></label>
            <input id="subject_style" type="text" class="form-control e-subject" name="subject">
        <span id="subject-text"></span>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label><b>Message</b></label>
                <input id="message_style" type="text" class="form-control e-message" name="message">
            <span id="message-text"></span>
        </div>
    </div>
    <div class="col-md-3">
        <label><b>When to Send</b></label>
            <select id="when_to_send_style" class="form-control e-when_to_send" name="when_to_send">
                <option value="90">90 Days</option>
                <option value="60">60 Days</option>
                <option value="30">30 Days</option>
                <option value="20">20 Days</option>
                <option value="15">15 Days</option>
                <option value="10">10 Days</option>
                <option value="5">5 Days</option>
            </select>
        <span id="when-to-send-text"></span>
    </div>
    <div class="col-md-12">
        <br />
        <button id="u-email-notif-btn" type="button" 
            class="btn btn-success btn-sm" onclick="submitUpdatedEmailNotif(event)">
        <i class="fa fa-save"></i> Update</button>
    </div>
</div>    