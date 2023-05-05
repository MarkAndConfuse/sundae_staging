<script type="text/javascript">

function loadPm(event){
    $.ajax({
    url: '{{ url("/load_pm") }}',
    method: 'GET',
    cache: false,
        success: function(html){
            $('.main-d').html(html);
                $('.pm-body').hide();
                $('.subs-spinner').html('<div class="container spinner"><div class="col-md-12 container"><img style="height: 60px; width: 60px; display: block; margin-left: 450px;" src="/images/loader_circle.gif" /></div></div>');  
            setTimeout(loadAssignPMDataTable, 2000);
            }
        });   
    }

    function loadAssignPMDataTable(){
        $('.spinner').hide();
        $('.pm-body').show();
        $('#pm-table').DataTable().destroy();
        table = $('#pm-table').DataTable({
            "searching": true,
            "processing": false,
            "serverSide": false,
            "paginate": true,
            "responsive": true,
            "paging": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "lengthChange": true,
            "pageLength": 5,
            "ajax": {
                'url': '{{ url("/pm_datatable") }}',
                "data" : {
                    // "_token"	: "{{ csrf_token() }}"
	    		}
            },
            columnDefs: [
                { className: 'dt-body-center', targets: 4, "className": "text-center" },
                { targets: 4, orderable: false },
                { width: 60, targets: 0 },
                { width: 60, targets: 1 },
                { width: 60, targets: 2 },
                { width: 60, targets: 3 }
            ],
            columns:[
            {
                data: 'so_number',
                name: 'so_number'
            },
            {
                data: 'invoice_date',
                name: 'invoice_date'
            },
            {
                data: 'action',
                name: 'action'
            }
        ]
    });   
}

function addPMForm(button){
    var x = button.getAttribute('data-subs-id');
    alert(x);
    $.ajax({
    url: '{{ url("/assign_pm_form") }}',
    method: 'GET',
    cache: false,
        success: function(html){
            $('.main-d').html(html);
            $('.docs-body').hide();
            loadCDBAccounts();
        }
    });  
}

function submitPMForm(event) {

    const so_number = $('.so_no_val').val();
    const brand = $('.brand_val').val();
    const category = $('.category_val').val();
    const invoice_date = $('.invoice_date_val').val();
    const material_no = $('.material_no_val').val();
    const bu = $('.bu_val').val();
    const activation_date = $('.activation_date_val').val();
    const activation_status = $('.activation_status_val').val();
    const assigned_ao = $('.ao_val').val();
    const customer_name = $('.customer_name_val').val();
    const customer_number = $('.customer_number_val').val();
    const customer_id = $('.customer_id_val').val();
    const material_desc = $('.material_desc_val').val();
    const terms = $('.terms_val').val();
    const p_schedule = $('.p_schedule_val').val();

    if (!so_number){
        $('#so-no-text').text('* SO number is required').css('color', '#D24D57');
        $('#so-style').addClass('is-invalid');
        $('#create-btn').attr('disabled', true);
    }

    $('.so_no_val').bind('click', function(){
        $('#so-style').removeClass('is-invalid');
        $('#so-no-text').text('');
        $('#create-btn').attr('disabled', false);
    });

    if (!brand){
        $('#brand-text').text('* Brand is required').css('color', '#D24D57');
        $('#brand-style').addClass('is-invalid');
        $('#create-btn').attr('disabled', true);
    }

    $('.brand_val').bind('click', function(){
        $('#brand-style').removeClass('is-invalid');
        $('#brand-text').text('');
        $('#create-btn').attr('disabled', false);
    });

    if (!category){
        $('#category-text').text('* Category is required').css('color', '#D24D57');
        $('#category-style').addClass('is-invalid');
        $('#create-btn').attr('disabled', true);
    }

    $('.category_val').bind('click', function(){
        $('#category-style').removeClass('is-invalid');
        $('#category-text').text('');
        $('#create-btn').attr('disabled', false);
    });

    if (!invoice_date){
        $('#inv-date-text').text('* Invoice date is required').css('color', '#D24D57');
        $('#inv-date-style').addClass('is-invalid');
        $('#create-btn').attr('disabled', true);
    }

    $('.invoice_date_val').bind('click', function(){
        $('#inv-date-style').removeClass('is-invalid');
        $('#inv-date-text').text('');
        $('#create-btn').attr('disabled', false);
    });

    if (!material_no){
        $('#material-no-text').text('* Material Number is required').css('color', '#D24D57');
        $('#material-no-style').addClass('is-invalid');
        $('#create-btn').attr('disabled', true);
    }

    $('.material_no_val').bind('click', function(){
        $('#material-no-style').removeClass('is-invalid');
        $('#material-no-text').text('');
        $('#create-btn').attr('disabled', false);
    });

    if (!bu){
        $('#bu-text').text('* BU is required').css('color', '#D24D57');
        $('#bu-style').addClass('is-invalid');
        $('#create-btn').attr('disabled', true);
    }

    $('.bu_val').bind('click', function(){
        $('#bu-style').removeClass('is-invalid');
        $('#bu-text').text('');
        $('#create-btn').attr('disabled', false);
    });

    if (!activation_date){
        $('#activation-date-text').text('* Activation Date is required').css('color', '#D24D57');
        $('#activation-date-style').addClass('is-invalid');
        $('#create-btn').attr('disabled', true);
    }

    $('.activation_date_val').bind('click', function(){
        $('#activation-date-style').removeClass('is-invalid');
        $('#activation-date-text').text('');
        $('#create-btn').attr('disabled', false);
    });

    if (!activation_status){
        $('#activation-status-text').text('* Activation Status is required').css('color', '#D24D57');
        $('#activation-status-style').addClass('is-invalid');
        $('#create-btn').attr('disabled', true);
    }

    $('.activation_status_val').bind('click', function(){
        $('#activation-status-style').removeClass('is-invalid');
        $('#activation-status-text').text('');
        $('#create-btn').attr('disabled', false);
    });

    if (!assigned_ao){
        $('#ao-text').text('* Assigend AO is required').css('color', '#D24D57');
        $('#ao-style').addClass('is-invalid');
        $('#create-btn').attr('disabled', true);
    }

    $('.ao_val').bind('click', function(){
        $('#ao-style').removeClass('is-invalid');
        $('#ao-text').text('');
        $('#create-btn').attr('disabled', false);
    });

    if (!customer_name){
        $('#customer-name-text').text('* Customer Name is required').css('color', '#D24D57');
        $('#customer-name-style').addClass('is-invalid');
        $('#create-btn').attr('disabled', true);
    }

    $('.customer_name_val').bind('click', function(){
        $('#customer-name-style').removeClass('is-invalid');
        $('#customer-name-text').text('');
        $('#create-btn').attr('disabled', false);
    });

    if (!material_desc){
        $('#material-desc-text').text('* Material Description is required').css('color', '#D24D57');
        $('#material-desc-style').addClass('is-invalid');
        $('#create-btn').attr('disabled', true);
    }

    $('.material_desc_val').bind('click', function(){
        $('#material-desc-style').removeClass('is-invalid');
        $('#material-desc-text').text('');
        $('#create-btn').attr('disabled', false);
    });

    if (!terms){
        $('#terms-text').text('* Subscription Term is required').css('color', '#D24D57');
        $('#terms-style').addClass('is-invalid');
        $('#create-btn').attr('disabled', true);
    }

    $('.terms_val').bind('click', function(){
        $('#terms-style').removeClass('is-invalid');
        $('#terms-text').text('');
        $('#create-btn').attr('disabled', false);
    });

    if (!p_schedule){
        $('#p-schedule-text').text('* Payment Schedule is required').css('color', '#D24D57');
        $('#p-schedule-style').addClass('is-invalid');
        $('#create-btn').attr('disabled', true);
    }

    $('.p_schedule_val').bind('click', function(){
        $('#p-schedule-style').removeClass('is-invalid');
        $('#p-schedule-text').text('');
        $('#create-btn').attr('disabled', false);
    });

    if (so_number && 
        brand && 
        category && 
        invoice_date && 
        material_no && 
        material_desc && 
        bu && 
        activation_date && 
        activation_status && 
        assigned_ao && 
        customer_name && 
        terms 
        ) {
        $('#create-btn').attr('disabled', true);
        saveCreatedSubscription();
    }
       
function saveCreatedSubscription(){
    $.ajax({
        url: "{{ url('/create_subscription') }}",
        method: 'POST',
        data: { 
        _token: function() {
        return "{{ csrf_token() }}"
    },
    so_number,
    brand,
    category,
    invoice_date,
    material_no,
    bu,
    activation_date,
    activation_status,
    assigned_ao,
    customer_name,
    material_desc,
    terms,
    p_schedule,
    customer_number,
    customer_id
    },
    cache: false,
        success:function(html){
            $('.alert-m').html('<div class="container"><div class="col-md-12 alert-margin" style="margin-top: 15px;"><div class="alert alert-info"><div class="fa fa-spinner fa-spin"></div> SUBSCRIPTION WAS SUCCESSFULLY CREATED.</div></div></div>'); 
            setTimeout(listOfSubscriptions, 5000);
            }
        });
    }
}

function loadCDBAccounts(){
    $.ajax({
    url: '{{ url("/load_cdb_accounts") }}',
    method: 'GET',
    cache: false,
        success: function(html){
        $('.cdbaccounts').html(html);
            $('.cdb-body').hide();
            $('.subs-spinner').html('<div class="container spinner"><div class="col-md-12 container"><img style="height: 60px; width: 60px; display: block; margin-left: 450px;" src="/images/loader_circle.gif" /></div></div>');  
            setTimeout(loadCDBAccountsDataTable, 2000);
        }
    });   
}

function loadCDBAccountsDataTable(){
    $('.spinner').hide();
    $('.cdb-body').show();
    $('#cdb-accounts').DataTable().destroy();
    table = $('#cdb-accounts').DataTable({
        "searching": true,
        "processing": false,
        "serverSide": false,
        "paginate": true,
        "responsive": true,
        "paging": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "lengthChange": true,
        "pageLength": 5,
        "ajax": {
        'url': '{{ url("/cdb_accounts_datatables") }}',
        "data" : {
            // "_token"	: "{{ csrf_token() }}"
            }
        },
        columnDefs: [
            { className: 'dt-body-center', targets: 2, "className": "text-center" },
            { targets: 2, orderable: false },
            { width: 60, targets: 0 },
            { width: 60, targets: 1 },
            { width: 60, targets: 2 }
        ],
        columns:[
        {
            data: 'AccountName',
            name: 'AccountName'
        },
        {
            data: 'Email',
            name: 'Email'
        },
        {
            data: 'action',
            name: 'action'
        }  
        ]
    });   
}

function selectPM(button){
    var custoID = button.getAttribute('data-custo-id');
    $('.customer_id_val').val(custoID)

    var custoNumber = button.getAttribute('data-custo-number');
    $('.customer_number_val').val(custoNumber)
}

var dPmId = '';
var pSubId = '';
function deletePm(button){
    $('.alert-pm-message').show();
    dPmId = button.getAttribute('data-pm-id');
    pSubId = button.getAttribute('data-sub-id');
    $.ajax({
        url: "{{ url('/delete_assign_pm') }}",
        method: 'POST',
        data: { 
        _token: function() {
            return "{{ csrf_token() }}"
        },
        dPmId
        },
        cache: false,
        success:function(html){
        $('.alert-pm-message').html('<div class="container"><div class="col-md-12 alert-margin" style="margin-top: 15px;"><div class="alert alert-info"><div class="fa fa-spinner fa-spin"></div> ASSIGN PM WAS DELETED.</div></div></div>'); 
        setTimeout(removePmAlert, 2000);
        }
    }); 
}

function removePmAlert(){
    $('.alert-pm-message').hide();
    window.location.href = '/load_pm/' + pSubId ;
}

</script>






