<main class="subs">
    <div class="container-fluid"> 
<div class="row charts-docs">
    <div class="col-xl-12 ">
        <div class="card mb-4">  
<div class="card-header subscription-h">
    <i class="fa fa-tasks"></i>
    EMAIL NOTIFICATIONS
</div> 
<div class="row alert-m">
</div>
<div class="card-body">
    <div class="col-md-12">
        <button class="btn btn-primary btn-xs" 
            onclick="manageSubscription(event)"
                style="margin-top: -18px; margin-left: -4px;">
            <i class="fa fa-arrow-left"></i> 
        BACK
        </button>
        <button class="btn btn-warning btn-xs" 
            onclick="viewAndUpdateSubscription(this, {{ $subs->id }})"
                data-subs-id="{{ $subs->id }}"
                    data-so-number="{{ $subs->so_number }}"
                    data-invoice-date="{{ $subs->invoice_date }}"
                    data-so-date="{{ $subs->so_date }}"
                    data-material-no="{{ $subs->mat_number }}"
                    data-material-desc="{{ $subs->mat_desc }}"
                    data-brand="{{ $subs->brand }}"
                    data-category="{{ $subs->category }}"
                    data-bu="{{ $subs->bu }}"
                    data-assigned-ao="{{ $subs->assigned_ao }}"
                    data-activation-date="{{ $subs->activation_date }}"
                    data-activation-status="{{ $subs->activation_status }}"
                    data-customer-name="{{ $subs->customer_name }}"
                    data-customer-number="{{ $subs->customer_number }}"
                    data-customer-id="{{ $subs->customer_id }}"
                    data-terms="{{ $subs->terms }}"
                    data-p-schedule="{{ $subs->payment_schedule }}" 
                    style="margin-top: -18px; margin-left: 4px;">
                    <i class="fa fa-edit"></i> 
                UPDATE
            </button>
        </div> 
    <hr style="margin-top: 3px;">
    <div class="row subs-info">
        <div class="col-md-3">
            <p>SO No:<b> {{ $subs->so_number }}</b></p>
        </div>
        <div class="col-md-3">
            <p>Material No:<b> {{ $subs->mat_number }}</b></p>
        </div>
        <div class="col-md-3">
            <p>BU:<b> {{ $subs->bu }}</b></p>
        </div>
        <div class="col-md-3">
            <p>Assigned AO:<b> {{ $subs->assigned_ao }}</b></p>
        </div>
        <div class="col-md-12" style="margin-top: -12px;">
            <p>Product:<b> {{ $subs->mat_desc }}</b></p>
        </div>
    </div>
<div>
    <div class="row" style="margin-top: -12px;">
        <div class="col-md-3">
            <p>Invoice Date:<b> {{ $inv_date }}</b></p>
        </div>
        <div class="col-md-3">
            <p>Acitivation Date:<b> {{ $act_date }}</b></p>
        </div>
    </div>
    <hr style="margin-top: -10px;">
    <div class="row addNewNotif" style="margin-top: -3px;">
        <div class="col-md-10">
            <label><i class="fa fa-plus-circle"> </i> Add Email Notification</label>
        </div>
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
                    <option value="20">20 Days</option>
                    <option value="15">15 Days</option>
                    <option value="10">10 Days</option>
                    <option value="5">5 Days</option>
                </select>
                <span id="when-to-send-text"></span>
            </div>
        </div>
        <div class="row s-btn">
            <div class="col-md-3">
                <button id="email-notif-btn" type="button" 
                    class="btn btn-success btn-sm pull-right" onclick="submitEmailNotif()">
                <i class="fa fa-save"></i> SUBMIT</button>
            </div>
        </div>        
        <hr>
        @if (!empty($emailNotifs))
        <p><b><i class="fa fa-list"></i> List of Email Notifications</b></p>
        <div class="table-responsive">
            <table id="email-notis" class="table-docs table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="t-th">Subject</th>
                        <th class="t-th">Message</th>
                        <th class="t-th">When to Send</th>
                        <th class="t-th">Action</th>
                    </tr>
                    @foreach($emailNotifs as $eN)
                    <tr>
                        <td>{{ $eN->subject }}</td>
                        <td>{{ $eN->message }}</td>
                        <td>{{ $eN->when_to_send }} Days</td>
                        <td style="text-align: center;">
                            <button class="btn btn-warning btn-xs" 
                            data-notif-id="{{ $eN->id }}" 
                            data-notif-subject="{{ $eN->subject }}" 
                            data-notif-message="{{ $eN->message }}" 
                            type="button" onclick="editEmailNotif(this)"><i class="fa fa-edit"></i> Edit</button>
                            @if(session()->get('GoogleName') == 'Mark Edo Escario')
                            <button class="btn btn-danger btn-xs" data-notif-id="{{ $eN->id }}" type="button" onclick="deleteEmailNotif(this)"><i class="fa fa-trash"></i> Delete</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </thead>
                </table>
            </div>
        @endif
    </div>
</main>
<style>
    .subscription-h {
        background-color: #BFBFBF;
        margin-top: -16px;
    }
    .subs-info {
        margin-top: -5px;
    }
    .s-btn {
        margin-top: 20px;
    }
</style>





