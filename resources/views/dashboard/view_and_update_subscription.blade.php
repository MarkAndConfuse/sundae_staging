<main class="subs">
    <div class="container-fluid"> 
<div class="row charts-docs">
    <div class="col-xl-12 ">
        <div class="card mb-4">  
<div class="card-header subscription-h">
    <i class="fa fa-edit"></i>
    VIEW AND UPDATE SUBSCRIPTION
</div> 
<div id="update-subs" class="row alert-m">
</div>
<div class="card-body">
    <div class="col-md-12">
        <a href="/subscriptions/{{ $subs->id }}">
            <button class="btn btn-primary btn-xs" 
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
                style="margin-top: -18px; margin-left: -5px;">
                <i class="fa fa-arrow-left"></i> 
                BACK
            </button>
        </a>
        <!-- <button class="btn btn-primary btn-xs" 
            onclick="manageSubscription(event)"
                style="margin-top: -18px; margin-left: 3px;">
            <i class="fa fa-list"></i> 
        LIST
        </button> -->
        <!-- <button class="btn btn-warning btn-xs pull-right" 
            onclick="emailNotifs(event)" 
                style="margin-top: -18px; margin-left: 3px;">
            <i class="fa fa-bell"></i> 
        EMAIL NOTIFICATIONS
        </button> -->
        <!-- <button class="btn btn-warning btn-xs e_recs" 
            onclick="emailRecipients(this)" 
                style="margin-top: -18px;">
            <i class="fa fa-address-book"></i> 
        EMAIL RECIPIENTS
        </button> -->
        <!-- <button class="btn btn-warning btn-xs" 
            onclick="fileAttachment(event)" 
                style="margin-top: -18px;  margin-left: 4px;">
            <i class="fa fa-address-book"></i> 
        FILE ATTACHMENTS
        </button> -->
    </div> 
    <div class="row">
        <div class="col-md-3">
            <label><b>SO Number</b></label>
                <input id="so_style" type="number" class="form-control so_number" name="so_number" />
                <input type="hidden" name="updated_by" value="{{ session()->get('GoogleName') }}" />
            <span id="u-so-number-text"></span>
        </div>
        <div class="col-md-3">
            <label><b>Invoice Date</b></label>
                <input id="inv_style" type="text" class="form-control invoice_date" name="invoice_date">
            <span id="u-inv-date-text"></span>
        </div>
        <div class="col-md-3">
            <label><b>Activation Date</b></label>
                <input id="act_style" type="date" class="form-control activation_date" name="activation_date" />
            <span id="u-act-date-text"></span>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label><b>Activation Status</b></label>
                    <input id="act_status_style" type="text" class="form-control activation_status" name="activation_status" />
                <span id="u-act-status-text"></span>
            </div>
        </div>
        <div class="col-md-3">
            <label><b>Brand</b></label>
                <select id="brand-style" class="form-control brand" name="brand"></select>
            <span id="u-brand-text"></span>
        </div>
        <div class="col-md-6">
            <label><b>Category</b></label>
                <input id="category_style" type="text" class="form-control category" name="category" />
            <span id="u-category-text"></span>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label><b>Material Number</b></label>
                    <input id="mat_no_style" type="number" class="form-control material_no" name="mat_number" />
                <span id="u-mat-no-text"></span>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <label><b>Material Description</b></label>
                <textarea id="mat_desc_style" rows="6" class="form-control material_desc" name="mat_desc"></textarea>
                <span id="u-mat-desc-text"></span>
            </div>  
        </div>
    <hr>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label><b>Subscription Terms</b></label>
                <input id="terms_style" type="number" class="form-control terms" name="terms" />
                <span id="u-terms-text"></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label><b>Payment Schedule</b></label>
                <input id="p_schedule_style" type="text" class="form-control p_schedule" name="payment_schedule" />
                <span id="u-p-schedule-text"></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label><b>BU</b></label>
                    <select id="bu-style" class="form-control bu" onchange="selectUpdateBu()" name="bu">    
                    <option value="BU1">BU1</option>
                    <option value="BU2">BU2</option>
                    <option value="BU5">BU5</option>
                    <option value="BU6">BU6</option>
                    <option value="BU8">BU8</option>
                    <option value="BU10">BU10</option>
                    <option value="BU12">BU12</option>
                    <option value="CE01">CE01</option>
                </select>
                <span id="u-bu-text"></span>
            </div>
        </div>
        <div class="col-md-3 update_Ao">
            <div class="form-group">
                <label><b>Assigned AO</b></label>
                    <input id="update-ao-style" type="text" class="form-control ao" name="ao" />
                    <!-- <select id="u-ao-style" class="form-control u_ao" name="ao"></select> -->
                <span id="u-ao-text"></span>
            </div>
        </div>
        <hr>
        <div class="col-md-6">
            <div class="form-group">
                <label><b>Select Customer</b></label>
                    <div class="input-group mb-3">
                        <input id="customer-name-style" type="text" class="form-control customer_name_val" placeholder="SELECT CUSTOMER" name="customer_name" readonly />
                            <input type="hidden" class="form-control customer_number_val" name="customer_number" />
                                <input type="hidden" class="form-control customer_id_val" name="customer_id" />
                                <div class="input-group-append">
                            <span style="cursor: pointer;" class="input-group-text"><i class="fas fa-user-circle"></i></span>
                        <span id="customer-name-text" class="data-text"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6" style="margin-top: 31px;">
        <div class="form-group">
            <div class="input-group mb-3 for-contacts">
                <!-- <input id="contact-name-style" type="text" class="form-control contacts_val" placeholder="Contacts" readonly /> -->
                <select id="contact-name-style" class="form-control u_contact_val"></select>    
                    <div class="input-group-append">
                        <span style="cursor: pointer;" class="input-group-text"><i class="fas fa-address-book"></i></span>
                        <span id="customer-name-text" class="data-text"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- <br />
<div class="customers">
    </div>
        <div class="card-body custo-body">
    </div> -->
<hr>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Assign PM</label>
                <select id="pm_name_style" class="select2 ePm" name="pm[]" multiple="multiple" data-placeholder="Select PM Account" style="width: 100%;">
                    @if($pM[0] != '[]')
                    @foreach($pM as $key => $value)
                    <option value="{{ $value }}" selected>{{ preg_replace('/[0-9]+/', '', $value) }}</option>
                    @endforeach
                    @endif
                
                    @foreach($getPm as $gP)
                    <option value="{{ $gP->AccountID .' '. $gP->AccountName }}">{{ $gP->AccountName }}</option>
                    @endforeach
                </select>
            <span id="pm-name-text" class="data-text"></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Assign TCD</label>
                <select id="tcd_name_style" class="select2 eTcd" name="tcd[]" multiple="multiple" data-placeholder="Select TCD Account" style="width: 100%;">
                    @if($tCd[0] != '[]')
                    @foreach($tCd as $key => $value)
                    <option value="{{ $value }}" selected>{{ preg_replace('/[0-9]+/', '', $value) }}</option>
                    @endforeach
                    @endif

                    @foreach($getTcd as $gT)
                    <option value="{{ $gT->AccountID .' '. $gT->AccountName }}">{{ $gT->AccountName }}</option>
                    @endforeach
                </select>
            <span id="tcd-name-text" class="data-text"></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Assign CSD</label>
                <select id="e_csd_name_style" class="select2 eCsd" name="csd[]" multiple="multiple" data-placeholder="Select CSD Account" style="width: 100%;">
                    @if($cSd[0] != '[]')
                    @foreach($cSd as $key => $value)
                    <option value="{{ $value }}" selected>{{ preg_replace('/[0-9]+/', '', $value) }}</option>
                    @endforeach
                    @endif

                    @foreach($getCsd as $gC)
                    <option value="{{  $gC->AccountID .' '. $gC->AccountName }}">{{ $gC->AccountName }}</option>
                    @endforeach
                </select>
            <span id="e-csd-name-text" class="data-text"></span>
        </div>
    </div>
</div>
<div class="modal-footer">
    <div class="row s-btn">
        </div>
            <button id="update-btn" type="button" 
                class="btn btn-success btn-sm" onclick="updateSubscriptionForm(event)">
                    <i class="fa fa-save"></i> UPDATE</button>
                        </div>
                    </div>
                </div>        
            </div><!-- /.container-fluid -->
        </section>
    </div>
@include('dashboard.file_attachment_modal')
</main>
<style>
    .subscription-h {
        background-color: #BFBFBF;
        margin-top: -16px;
    }
</style>
@include('dashboard.email_notifs_modal')
<script>
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
        format: 'MM/DD/YYYY hh:mm A'
        }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
    },
    function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
        format: 'LT'
    })
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
         $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

})
</script>







