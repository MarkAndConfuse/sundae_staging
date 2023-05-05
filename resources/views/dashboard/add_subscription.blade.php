<main class="subs">
    <div class="container-fluid">
<div class="row charts-docs">
    <div class="col-xl-12 ">
        <div class="card mb-4">         
<div class="card-header subscription-h">
    <i class="fa fa-plus-circle"></i>
        ADD SUBSCIPTION
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
    </div>
    <div class="row">
        <div class="col-md-3">
            <label><b>SO Number</b></label>
                <input id="so-style" type="text" class="form-control so_no_val" name="so_no" />
                <input type="hidden" class="form-control" value="{{ session()->get('GoogleName') }}" name="created_by" />
            <span id="u-so-no-text"></span>
        </div>
        <div class="col-md-3">
            <label><b>Invoice Date</b></label>
                <input id="inv-date-style" type="date" class="form-control invoice_date_val" name="invoice_date" />
            <span id="inv-date-text"></span>
        </div>
        <div class="col-md-3">
            <label><b>Activation Date</b></label>
                <input id="activation-date-style" type="date" class="form-control activation_date_val" name="activation_date"> 
            <span id="activation-date-text"></span>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label><b>Activation Status</b></label>
                    <input id="activation-status-style" type="text" class="form-control activation_status_val" name="activation_status"> 
                <span id="activation-status-text"></span>
            </div>
        </div>
        <div class="col-md-3">
            <label><b>Brand</b></label>
                <select id="brand-style" class="form-control brand_val" name="brand">
                    <option value=""></option>
                    @foreach($brands as $brand)
                    <option value="{{ $brand->Brand }}">{{ $brand->Brand }}</option>
                    @endforeach
                </select>
            <span id="brand-text"></span>
        </div>
        <div class="col-md-9">
            <label><b>Category</b></label>
                <input id="category-style" type="text" class="form-control category_val" name="category" />
                <p id="category-text"></p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label><b>Material Number</b></label>
                    <input id="material-no-style" type="text" class="form-control material_no_val" name="material_no" />
                <span id="material-no-text"></span>
            </div>
        </div>
        <div class="col-md-12">
            <label><b>Material Description</b></label>
                <textarea id="material-desc-style" rows="6" type="text" class="form-control material_desc_val" name="material_desc_val"></textarea>
                <span id="material-desc-text"></span>
            </div>  
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label><b>Terms (Years)</b></label>
                    <input id="terms-style" type="number" class="form-control terms_val" name="terms" />
                <span id="terms-text"></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label><b>Payment Schedule</b></label>
                    <input id="p-schedule-style" type="text" class="form-control p_schedule_val" name="payment_schedule" />
                <span id="p-schedule-text" class="data-text"></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label><b>BU</b></label>
                    <select id="bu-style" class="form-control bu_val" onchange="selectBu()" name="bu">    
                        <option value="BU1">BU1</option>
                        <option value="BU2">BU2</option>
                        <option value="BU5">BU5</option>
                        <option value="BU8">BU8</option>
                        <option value="BU10">BU10</option>
                        <option value="BU12">BU12</option>
                        <option value="CE01">CE01</option>
                        <option value="CB02">CB02</option>
                    </select>
                <span id="bu-text"></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label><b>Assigned AO</b></label>
                <select id="ao-style" class="form-control ao_val" name="ao"></select>  
                <span id="ao-text" class="data-text"></span>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label><b>Select Customer</b></label>
                    <div class="input-group mb-3">
                        <input id="customer-name-style" type="text" class="form-control customer_name_val" placeholder="Example: Integrated Computer System Inc." name="customer_name" readonly />
                            <input type="hidden" class="form-control customer_number_val" name="customer_number" />
                                <input type="hidden" class="form-control customer_id_val" name="customer_id" />
                            <div class="input-group-append">
                        <span style="cursor: pointer;" onclick="openCustoModal(event)" class="input-group-text"><i class="fas fa-building"></i></span>
                    <span id="customer-name-text" class="data-text"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6" style="margin-top: 31px;">
        <div class="form-group">
            <div class="input-group mb-3 for-contacts">
                <input id="contact-name-style" type="text" class="form-control contacts_val" placeholder="Contacts" readonly />
                    <div class="input-group-append">
                        <span style="cursor: pointer;" class="input-group-text"><i class="fas fa-address-book"></i></span>
                        <span id="contact-name-text" class="data-text"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Assign PM</label>
                <select id="pm_name_style" class="select2 sPm" name="pm[]" multiple="multiple" data-placeholder="Select PM Account" style="width: 100%;">
                @foreach($getPm as $pm)
                <option value="{{ $pm->AccountID .' '. $pm->AccountName }}"> {{ $pm->AccountName }}</option>
                @endforeach
                </select>
            <span id="pm-name-text" class="data-text"></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Assign TCD</label>
            <select id="tcd_name_style" class="select2 sTcd" name="tcd[]" multiple="multiple" data-placeholder="Select TCD Account" style="width: 100%;">
            @foreach($getTcd as $tcd)
            <option value="{{ $tcd->AccountID .' '. $tcd->AccountName }}">{{ $tcd->AccountName }}</option>
            @endforeach
            </select>
            <span id="tcd-name-text" class="data-text"></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Assign CSD</label>
            <select id="csd_name_style" class="select2 sCsd" name="csd[]" multiple="multiple" data-placeholder="Select CSD Account" style="width: 100%;">
            @foreach($getCsd as $csd)
            <option value="{{ $csd->AccountID .' '. $csd->AccountName }}">{{ $csd->AccountName }}</option>
            @endforeach
            </select>
            <span id="csd-name-text" class="data-text"></span>
        </div>
    </div>
</div>
<br />
<!-- <div class="customers" style="margin-top: -20px;">
</div>
<div class="card-body custo-body">
</div> -->
</div>
<div class="modal-footer">
    <div class="row s-btn">
        </div>
            <button id="create-btn" type="button" 
                class="btn btn-success btn-sm" onclick="submitSubscriptionForm()">
                    <i class="fa fa-save"></i> SUBMIT</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .subscription-h {
        background-color: #BFBFBF;
        margin-top: -10px;
    }
</style>
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











