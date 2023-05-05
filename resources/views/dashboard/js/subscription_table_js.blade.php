<script type="text/javascript">

function manageSubscription(event){
    $.ajax({
    url: '{{ url("/manage_subscription") }}',
    method: 'GET',
    cache: false,
        success: function(html){
        $('.main-d').html(html);
            $('.docs-body').hide();
            $('.subs-spinner').html('<div class="container spinner"><div class="col-md-12 container"><img style="height: 60px; width: 60px; display: block; margin-left: 450px;" src="/images/loader_circle.gif" /></div></div>');  
        setTimeout(loadSubscriptionDataTable, 2000);
        }
    });   
}

function loadSubscriptionDataTable(){
    $('.spinner').hide();
    $('.docs-body').show();
    $('#subscriptions').DataTable().destroy();
        table = $('#subscriptions').DataTable({
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
                'url': '{{ url("/subscription_datatables") }}',
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
                { width: 60, targets: 3 },
                { width: 60, targets: 4 },
                { width: 60, targets: 5 },
                { width: 150, targets: 9 },
                { width: 60, targets: 10 },
                { width: 60, targets: 11 }
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
                data: 'activation_date',
                name: 'activation_date'
            },
            {
                data: 'mat_number',
                name: 'mat_number'
            },
            {
                data: 'action',
                name: 'action'
            },
            {
                data: 'mat_desc',
                name: 'mat_desc'
            },
            {
                data: 'bu',
                name: 'bu'
            },
            {
                data: 'assigned_ao',
                name: 'assigned_ao'
            },
            {
                data: 'customer_name',
                name: 'customer_name'
            },
            {
                data: 'customer_number',
                name: 'customer_number'
            },
            {
                data: 'payment_schedule',
                name: 'payment_schedule'
            },
            {
                data: 'terms',
                name: 'terms'
            }
        ]
    });   
}

function addSubscription(event){
    $.ajax({
    url: '{{ url("/add_subscription") }}',
    method: 'GET',
    cache: false,
        success: function(html){
            $('.main-d').html(html);
            $('.docs-body').hide();
            loadCustomers();
        }
    });  
}

// Filter Contacts by BU
function selectBu(){
    var buVal = $('.bu_val').val()
    console.log('x: ', buVal);
    getContactValues(buVal)
}

function getContactValues(buVal){
    console.log('bu: ', buVal);
    $.ajax({
        url: '/filter_ao_by_bu',
        method: 'post',
        dataType: 'json',
        data: { 
            _token: function() {
                return "{{ csrf_token() }}"
            },
        buVal
        },
        success: function (response){
            // $('#skillFilter').attr('disabled', false);
            const contactList = response;
            var cList = {contactList}
            console.log(cList);
            var dropDownField = cList;
            var html = '<option value=""></option>';
            if (typeof(dropDownField) === "object" && Object.keys(dropDownField).length) {
                $.each(dropDownField.contactList, function(key, data) {
                    html += `<option value="${data.AccountID +','+ data.AccountName}">${data.AccountName}</option>`;
                });
            }
            $('#ao-style').html(html); 
        }
    });
}

var so_number = '';
function submitSubscriptionForm(event) {

    so_number = $('.so_no_val').val();
    const brand = $('.brand_val').val();
    const category = $('.category_val').val();
    const invoice_date = $('.invoice_date_val').val();
    const material_no = $('.material_no_val').val();
    const bu = $('.bu_val').val();
    const activation_date = $('.activation_date_val').val();
    const activation_status = $('.activation_status_val').val();
    const assigned_ao = $('.ao_val').val();
    console.log('ao val: ', assigned_ao);
    const pm_payload = $('.sPm').val();
    const customer_name = $('.customer_name_val').val();
    const customer_number = $('.customer_number_val').val();
    const customer_id = $('.customer_id_val').val();
    const material_desc = $('.material_desc_val').val();
    const contact_id = $('.customer_contact_val').val();
    const terms = $('.terms_val').val();
    const p_schedule = $('.p_schedule_val').val();

    const contacts_val = $('.contact_val').val();

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

    if (!contacts_val){
        $('#contact-name-text').text('* Contact Name is required').css('color', '#D24D57');
        $('#contact-name-style').addClass('is-invalid');
        $('#create-btn').attr('disabled', true);
    }

    $('.contacts_val').bind('click', function(){
        $('#contact-name-style').removeClass('is-invalid');
        $('#contact-name-text').text('');
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
        assigned_ao && 
        customer_name &&
        terms 
        ) {
        $('#create-btn').attr('disabled', true);
        saveCreatedSubscription();
        // submitAssignPM();
        // submitAssignTCD();
        // submitAssignCSD();
    }
var subs_id = '';
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
    pm_payload,
    p_schedule,
    customer_number,
    contact_id,
    customer_id
    },
    cache: false,
    dataType: 'JSON',
        success:function(response){
            console.log('response: ', response);
            subs_id = response;
            $('.alert-m').html('<div class="container"><div class="col-md-12 alert-margin" style="margin-top: 15px;"><div class="alert alert-info"><div class="fa fa-spinner fa-spin"></div> SUBSCRIPTION WAS SUCCESSFULLY CREATED.</div></div></div>'); 
            setTimeout(listOfSubscriptions, 5000);
        submitAssignPM(subs_id);
        submitAssignTCD(subs_id);
        submitAssignCSD(subs_id);

            }
        });
    }
}

var subsId = '';
var custoNo = '';
var custoId = '';
var updateAo = '';
var updateAoId = '';
function viewAndUpdateSubscription(button, sId){
    $.ajax({
    url: '{{ url("/view_and_update_subscription") }}/' + sId,
    method: 'GET',
    cache: false,
        success: function(html){
            $('.main-d').html(html);
            $('.docs-body').hide();
            // loadCustomers();  

            subsId = button.getAttribute('data-subs-id');
            var uSoNumber = button.getAttribute('data-so-number');
            var uInvoiceDate = button.getAttribute('data-invoice-date');
            var uActivationDate = button.getAttribute('data-activation-date');
            var uActivationStatus = button.getAttribute('data-activation-status');
            var uBrand = button.getAttribute('data-brand');
            var uCategory = button.getAttribute('data-category');
            var uMaterialNo = button.getAttribute('data-material-no');
            var uMaterialDesc = button.getAttribute('data-material-desc');
            var uTerms = button.getAttribute('data-terms');
            var uPSchedule = button.getAttribute('data-p-schedule');
            var uBu = button.getAttribute('data-bu');
            var uAo = button.getAttribute('data-assigned-ao');
            var uAoId = button.getAttribute('data-ao-id');
            updateAo = uAo;
            updateAoId = uAoId;
            var uCustomerName = button.getAttribute('data-customer-name');
            var uCustomerNo = button.getAttribute('data-customer-number');
            var uCustomerId = button.getAttribute('data-customer-id');
            custoNo = uCustomerNo;
            custoId = uCustomerId;

            $('.so_number').val(uSoNumber);
            $('.invoice_date').val(uInvoiceDate);
            $('.activation_date').val(uActivationDate);
            $('.activation_status').val(uActivationStatus);
            $('.brand').val(uBrand);
            $('.category').val(uCategory);
            $('.material_no').val(uMaterialNo);
            $('.material_desc').val(uMaterialDesc);
            $('.terms').val(uTerms);
            $('.p_schedule').val(uPSchedule);
            $('.bu').val(uBu);
            $('.ao').val(uAo);
            $('.customer_name_val').val(uCustomerName);
            $('.customer_number_val').val(uCustomerNo);
            $('.customer_id_val').val(uCustomerId);
            $('.subs_id').val(subsId);
            $('#customer-name-label').text(uCustomerName);
            $('#so-number-label').text(uSoNumber);
            $('.e_recs').attr('data-rec-subs-id', subsId);
            }
        });   
    }

    // Filter AO - Update Subscriptions
    function selectUpdateBu(){
        var buVal = $('.bu').val()
        getContactValuesToUpdate(buVal)
        $('.update_Ao').html('<div class="col-md-12"><div class="form-group"><label><b>Assigned AO</b></label><select id="u-ao-style" class="form-control ao" style="width: 14em;"></select></div><span id="u-ao-text"></span></div>');
        }

        function getContactValuesToUpdate(buVal){
            $.ajax({
                url: '/filter_ao_by_bu',
                method: 'post',
                dataType: 'json',
                data: { 
                    _token: function() {
                        return "{{ csrf_token() }}"
                    },
                buVal
                },
                success: function (response){
                    // $('#skillFilter').attr('disabled', false);
                    const contactList = response;
                    var cList = {contactList}
                    console.log(cList);
                    var dropDownField = cList;
                    var html = '<option></option>'
                    if (typeof(dropDownField) === "object" && Object.keys(dropDownField).length) {
                        $.each(dropDownField.contactList, function(key, data) {
                            html += `<option value="${data.AccountID +','+ data.AccountName}">${data.AccountName}</option>`;
                        });
                    }
                    $('#u-ao-style').html(html); 
                }
             });
        }

function updateSubscriptionForm(event){        

    const uSoNumberVal = $('.so_number').val();
    const uActivationDateVal = $('.activation_date').val();
    const uInvoiceDateVal = $('.invoice_date').val();
    const uActivationStatusVal = $('.activation_status').val();
    const uBrandVal = $('.brand').val();
    const uCategoryVal = $('.category').val();
    const uBuVal = $('.bu').val();
    const uMatNumberVal = $('.material_no').val();
    const uMatDescVal = $('.material_desc').val();
    const uTermsVal = $('.terms').val();
    const uPScheduleVal = $('.p_schedule').val();
    const uAoVal = $('.ao').val();
    const uCustomerNameVal = $('.customer_name_val').val();
    const uCustomerNoVal = $('.customer_number_val').val();
    const uCustomerIdVal = $('.customer_id_val').val();
    const uContactIdVal = $('.customer_contact_val').val();
    const uUpdatedByVal = $('.updated_by_val').val();

    console.log($('.ePm').val());
    
    if (!uActivationDateVal){
        $('#u-act-date-text').text('* Activation Date is required').css('color', '#D24D57');
        $('#act_style').addClass('is-invalid');
        $('#update-btn').attr('disabled', true);
    }

    $('.activation_date').bind('click', function(){
        $('#act_style').removeClass('is-invalid');
        $('#u-act-date-text').text('');
        $('#update-btn').attr('disabled', false);
    });
    
    if (!uActivationStatusVal){
        $('#u-act-status-text').text('* Activation Status is required').css('color', '#D24D57');
        $('#act_status_style').addClass('is-invalid');
        $('#update-btn').attr('disabled', true);
    }

    $('.activation_status').bind('click', function(){
        $('#act_status_style').removeClass('is-invalid');
        $('#u-act-status-text').text('');
        $('#update-btn').attr('disabled', false);
    });

    if (!uSoNumberVal){
        $('#u-so-number-text').text('* SO number is required').css('color', '#D24D57');
        $('#so_style').addClass('is-invalid');
        $('#update-btn').attr('disabled', true);
    }

    $('.so_number').bind('click', function(){
        $('#so_style').removeClass('is-invalid');
        $('#u-so-number-text').text('');
        $('#update-btn').attr('disabled', false);
    });

    if (!uInvoiceDateVal){
        $('#u-inv-date-text').text('* Invoice Date is required').css('color', '#D24D57');
        $('#inv_style').addClass('is-invalid');
        $('#update-btn').attr('disabled', true);
    }
    
    $('.invoice_date').bind('click', function(){
        $('#inv_style').removeClass('is-invalid');
        $('#u-inv-date-text').text('');
        $('#update-btn').attr('disabled', false);
    });

    if (!uBrandVal){
        $('#u-brand-text').text('* Brand is required').css('color', '#D24D57');
        $('#brand_style').addClass('is-invalid');
        $('#update-btn').attr('disabled', true);
    }

    $('.brand').bind('click', function(){
        $('#brand_style').removeClass('is-invalid');
        $('#u-brand-text').text('');
        $('#update-btn').attr('disabled', false);
    });

    if (!uCategoryVal){
        $('#u-category-text').text('* Category is required').css('color', '#D24D57');
        $('#category_style').addClass('is-invalid');
        $('#update-btn').attr('disabled', true);
    }
    
    $('.category').bind('click', function(){
        $('#category_style').removeClass('is-invalid');
        $('#u-category-text').text('');
        $('#update-btn').attr('disabled', false);
    });

    if (!uBuVal){
        $('#u-bu-text').text('* BU is required').css('color', '#D24D57');
        $('bu_style').addClass('is-invalid');
        $('#update-btn').attr('disabled', true);
    }

    $('.bu').bind('click', function(){
        $('#bu_style').removeClass('is-invalid');
        $('#u-bu-text').text('');
        $('#update-btn').attr('disabled', false);
    });

    if (!uAoVal){
        $('#u-ao-text').text('* Assigned AO is required').css('color', '#D24D57');
        $('u_ao_style').addClass('is-invalid');
        $('#update-btn').attr('disabled', true);
    }

    $('.ao').bind('click', function(){
        $('#update_ao_style').removeClass('is-invalid');
        $('#u-ao-text').text('');
        $('#update-btn').attr('disabled', false);
    });

    if (!uMatNumberVal){
        $('#u-mat-no-text').text('* Material Number is required').css('color', '#D24D57');
        $('mat_no_style').addClass('is-invalid');
        $('#update-btn').attr('disabled', true);
    }

    $('.material_no').bind('click', function(){
        $('#mat_no_style').removeClass('is-invalid');
        $('#u-mat-no-text').text('');
        $('#update-btn').attr('disabled', false);
    });

    if (!uMatDescVal){
        $('#u-mat-desc-text').text('* Material Desc is required').css('color', '#D24D57');
        $('mat_desc_style').addClass('is-invalid');
        $('#update-btn').attr('disabled', true);
    }

    $('.material_desc').bind('click', function(){
        $('#mat_desc_style').removeClass('is-invalid');
        $('#u-mat-desc-text').text('');
        $('#update-btn').attr('disabled', false);
    });
    
    if (!uTermsVal){
        $('#u-terms-text').text('* Subscription Term is required').css('color', '#D24D57');
        $('terms_style').addClass('is-invalid');
        $('#update-btn').attr('disabled', true);
    }

    $('.terms').bind('click', function(){
        $('#terms_style').removeClass('is-invalid');
        $('#u-terms-text').text('');
        $('#update-btn').attr('disabled', false);
    });

    if (!uPScheduleVal){
        $('#u-p-schedule-text').text('* Payment Schedule is required').css('color', '#D24D57');
        $('p_schedule_style').addClass('is-invalid');
        $('#update-btn').attr('disabled', true);
    }

    $('.p_schedule').bind('click', function(){
        $('#p_schedule_style').removeClass('is-invalid');
        $('#u-p-schedule-text').text('');
        $('#update-btn').attr('disabled', false);
    });
    
    if (!uAoVal){
        $('#u-ao-text').text('* AO is required').css('color', '#D24D57');
        $('#u-ao-style').addClass('is-invalid');
        $('#update-btn').attr('disabled', true);
    }

    $('.ao').bind('click', function(){
        $('#u-ao-style').removeClass('is-invalid');
        $('#u-ao-text').text('');
        $('#update-btn').attr('disabled', false);
    })

    if (!uCustomerNameVal){
        $('#u-customer-name-text').text('* Customer Name is required').css('color', '#D24D57');
        $('customer_namne_style').addClass('is-invalid');
        $('#update-btn').attr('disabled', true);
    }

    $('.customer_name').bind('click', function(){
        $('#customer_name_style').removeClass('is-invalid');
        $('#u-customer-name-text').text('');
        $('#update-btn').attr('disabled', false);
    })
            
    if (uSoNumberVal && 
        uActivationDateVal && 
        uActivationStatusVal &&
        uInvoiceDateVal &&
        uBrandVal &&
        uCategoryVal &&
        uBuVal &&
        uMatNumberVal &&
        uMatDescVal &&
        uTermsVal &&
        uPScheduleVal &&
        uAoVal &&
        uCustomerNameVal 
        ) {
        saveUpdatedSubscription();
        submitEditPM();
        submitEditTCD();
        submitEditCSD();
    }
             
    function saveUpdatedSubscription(){
        $.ajax({
            url: "{{ url('/update_subscription') }}",
            method: 'POST',
            data: { 
                _token: function() {
                return "{{ csrf_token() }}"
            },
            subsId,
            uActivationDateVal,
            uInvoiceDateVal,
            uActivationStatusVal,
            uSoNumberVal,
            uBrandVal,
            uCategoryVal,
            uBuVal,
            uMatNumberVal,
            uMatDescVal,
            uTermsVal,
            uPScheduleVal,
            uAoVal,
            uCustomerNameVal,
            uCustomerNoVal,
            uCustomerIdVal,
            uContactIdVal,
            uUpdatedByVal
            },
            cache: false,
            success:function(html){
                $('.alert-m').html('<div class="container"><div class="col-md-12 alert-margin" style="margin-top: 15px;"><div class="alert alert-info"><div class="fa fa-spinner fa-spin"></div> SUBSCRIPTION DETAILS WAS SUCCESSFULLY UPDATED.</div></div></div>'); 
                setTimeout(removeEditSubscriptionAlert, 3000);
            }
        });
    }
} 

function removeEditSubscriptionAlert(){
    $('.alert-m').hide();
}

// View Subscription
function viewSubscription(button, sId){
    $.ajax({
    url: '{{ url("/view_subscription") }}/' + sId,
    method: 'GET',
    cache: false,
        success: function(html){
            $('.main-d').html(html);
            $('.docs-body').hide();
            // loadCustomers();  
            subsId = button.getAttribute('data-subs-id');
            var uSoNumber = button.getAttribute('data-so-number');
            var uInvoiceDate = button.getAttribute('data-invoice-date');
            var uActivationDate = button.getAttribute('data-activation-date');
            var uActivationStatus = button.getAttribute('data-activation-status');
            var uBrand = button.getAttribute('data-brand');
            var uCategory = button.getAttribute('data-category');
            var uMaterialNo = button.getAttribute('data-material-no');
            var uMaterialDesc = button.getAttribute('data-material-desc');
            var uTerms = button.getAttribute('data-terms');
            var uPSchedule = button.getAttribute('data-p-schedule');
            var uBu = button.getAttribute('data-bu');
            var uAo = button.getAttribute('data-assigned-ao');
            updateAo = uAo;
            var uCustomerName = button.getAttribute('data-customer-name');
            var uCustomerNo = button.getAttribute('data-customer-number');
            var uCustomerId = button.getAttribute('data-customer-id');
            custoNo = uCustomerNo;
            custoId = uCustomerId;

            $('.so_number').val(uSoNumber);
            $('.invoice_date').val(uInvoiceDate);
            $('.activation_date').val(uActivationDate);
            $('.activation_status').val(uActivationStatus);
            $('.brand').val(uBrand);
            $('.category').val(uCategory);
            $('.material_no').val(uMaterialNo);
            $('.material_desc').val(uMaterialDesc);
            $('.terms').val(uTerms);
            $('.p_schedule').val(uPSchedule);
            $('.bu').val(uBu);
            $('.ao').val(uAo);
            $('.customer_name_val').val(uCustomerName);
            $('.customer_number_val').val(uCustomerNo);
            $('.customer_id_val').val(uCustomerId);
            $('.subs_id').val(subsId);
            $('#customer-name-label').text(uCustomerName);
            $('#so-number-label').text(uSoNumber);
            $('.e_recs').attr('data-rec-subs-id', subsId);
        }
    });   
}

// View Email Notifications
// function emailNotifications(button, sId){
//     $.ajax({
//     url: '{{ url("/view_email_notifications") }}/' + sId,
//     method: 'GET',
//     cache: false,
//         success: function(html){
//             $('.main-d').html(html);
//             $('.docs-body').hide();
//         }
//     });   
// }

// Email Notifications
function emailNotifs(button){
    $('.emailNotifsModal').modal('show');
    getEmailNotifsTable();
}

function getEmailNotifsTable(){
    $.ajax({
    url: '{{ url("/get_email_notifs_list") }}/' + subsId,
    method: 'GET',
    cache: false,
        success: function(html){
        $('.emailNotifsTable').html(html);
        }
    });   
}

function submitEmailNotif(){    
    var subjectVal = $('.subject').val();
    var messageVal = $('.message').val();
    var whenToSendVal = $('.when_to_send').val();
    var dateSentVal = $('.date_sent').val();

    if (!subjectVal){
        $('#subject-text').text('* Subject is Required').css('color', '#D24D57');
        $('#subject_style').addClass('is-invalid');
        $('#email-notif-btn').attr('disabled', true);
    }

    $('.subject').bind('click', function(){
        $('#subject_style').removeClass('is-invalid');
        $('#subject-text').text('');
        $('#email-notif-btn').attr('disabled', false);
    })

    if (!messageVal){
        $('#message-text').text('* Message is Required').css('color', '#D24D57');
        $('#message_style').addClass('is-invalid');
        $('#email-notif-btn').attr('disabled', true);
    }

    $('.message').bind('click', function(){
        $('#message_style').removeClass('is-invalid');
        $('#message-text').text('');
        $('#email-notif-btn').attr('disabled', false);
    })

    if (!whenToSendVal){
        $('#when-to-send-text').text('* When to send is Required').css('color', '#D24D57');
        $('#when_to_send_style').addClass('is-invalid');
        $('#email-notif-btn').attr('disabled', true);
    }

    $('.when_to_send').bind('click', function(){
        $('#when_to_send_style').removeClass('is-invalid');
        $('#when-to-send-text').text('');
        $('#email-notif-btn').attr('disabled', false);
    })

    if (subjectVal){
        saveEmailNotif();
    }

    function saveEmailNotif(){
        $('#email-notif-btn').attr('disabled', true);
        $('.alert-m').show();
        $.ajax({
            url: "{{ url('/add_email_notif') }}",
            method: 'POST',
            data: { 
            _token: function() {
                return "{{ csrf_token() }}"
            },
            subsId,
            subjectVal,
            messageVal,
            whenToSendVal,
            dateSentVal
            },
            cache: false,
            success:function(html){
            $('.alert-m').html('<div class="container"><div class="col-md-12 alert-margin" style="margin-top: 15px;"><div class="alert alert-info"><div class="fa fa-spinner fa-spin"></div> EMAIL NOTIFICATION INFO WAS SUCCESSFULLY CREATED.</div></div></div>'); 
            setTimeout(removeEmailNotifAlert, 2000);
            }
        });
    }
}

function removeEmailNotifAlert(){
    $('.alert-m').hide();
    // emailNotifications(sId);
    getEmailNotifsTable();
    $('#email-notif-btn').attr('disabled', false);
}

// Edit Email Notif Page
var nId = '';
function editEmailNotif(button){
    var notifId = button.getAttribute('data-notif-id');
    nId = notifId;
    var eSubject = button.getAttribute('data-notif-subject');
    var eMessage = button.getAttribute('data-notif-message');
    // alert(eSubject)
    $.ajax({
        url: "{{ url('/edit_email_notif') }}/" + notifId,
        method: 'GET',
        cache: false,
        success: function(html){
            $('.addNewNotif').html(html)
            $('.e-subject').val(eSubject);
            $('.e-message').val(eMessage);

            $('#email-notif-btn').remove();
        }
    }); 
}

// Submit Updated Email Notif
function submitUpdatedEmailNotif(event){
    $('.alert-m').show();
    const uSubject = $('.e-subject').val();
    const uMessage = $('.e-message').val();
    const uWhenToSend = $('.e-when_to_send').val();
    $.ajax({
        url: "{{ url('/save_updated_email_notif') }}",
        method: 'POST',
        data: { 
        _token: function() {
            return "{{ csrf_token() }}"
        },
        nId,
        uSubject,
        uMessage,
        uWhenToSend
        },
        cache: false,
        success:function(html){
        $('.alert-m').html('<div class="container"><div class="col-md-12 alert-margin" style="margin-top: 15px;"><div class="alert alert-info"><div class="fa fa-spinner fa-spin"></div> EMAIL NOTIFICATION INFO WAS UPDATED.</div></div></div>'); 
        setTimeout(removeUpdateEmailNotifAlert, 2000);
        }
    }); 
}

function removeUpdateEmailNotifAlert(){
    $('.alert-m').hide();
    // emailNotifications(sId);
    getEmailNotifsTable();
    $('#u-email-notif-btn').attr('disabled', false);
}

// Delete Email Notif
var dNotifId = '';
function deleteEmailNotif(button){
    $('.alert-m').show();
    dNotifId = button.getAttribute('data-notif-id');
    $.ajax({
        url: "{{ url('/delete_email_notif') }}",
        method: 'POST',
        data: { 
        _token: function() {
            return "{{ csrf_token() }}"
        },
        dNotifId
        },
        cache: false,
        success:function(html){
        $('.alert-m').html('<div class="container"><div class="col-md-12 alert-margin" style="margin-top: 15px;"><div class="alert alert-info"><div class="fa fa-spinner fa-spin"></div> EMAIL NOTIFICATION INFO WAS DELETED.</div></div></div>'); 
        setTimeout(removeDeleteEmailNotifAlert, 2000);
        }
    }); 
}

function removeDeleteEmailNotifAlert(){
    $('.alert-m').hide();
    getEmailNotifsTable();
}

function listOfSubscriptions(){
    $.ajax({
    url: '{{ url("/manage_subscription") }}',
    method: 'GET',
    cache: false,
    success: function(html){
        $('.main-d').html(html);
        $('.docs-body').hide();
        $('.subs-spinner').html('<div class="container spinner"><div class="col-md-12 container"><img style="height: 60px; width: 60px; display: block; margin-left: 460px;" src="/images/loader_circle.gif" /></div></div>');  
        setTimeout(loadSubscriptionDataTable, 1000);
        }
    });
}

function loadCDBAccounts(){
    $('#cdb-accounts-tcd').DataTable().destroy();
    $('#cdb-accounts-csd').DataTable().destroy();
    $.ajax({
    url: '{{ url("/load_cdb_accounts") }}',
    method: 'GET',
    cache: false,
        success: function(html){
        $('.cdbaccounts').html(html);
            $('.cdb-body').hide();
            $('.subs-spinner').html('<div class="container spinner"><div class="col-md-12 container"><img style="height: 60px; width: 60px; display: block; margin-left: 1450px;" src="/images/loader_circle.gif" /></div></div>');  
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

// Live Search
function openCustoModal(){
    $('#selectCustomerModal').modal('show');
}

function openEditCustoModal(){
    $('#selectCustomerModal').modal('show');
}

var keyWord = '';
function searchCustomer (event){

    $('.custo-spinner').html('<div class="container c-spinner"><div class="col-md-12 container"><img style="height: 60px; width: 60px; display: block; margin-left: 500px;" src="/images/loader_circle.gif" /></div></div>');  
    $('.live-search-body').hide();

    var search = $('.ex').val()
    if (search === ''){
        keyWord = btoa('appsdev');
    } else {
        keyWord = btoa(search)
    }

    setTimeout(loadLiveSearchDataTable, 1000);

function loadLiveSearchDataTable(){
    $('.c-spinner').hide();
    $('.live-search-body').show();
    $('#live-search-table').DataTable().destroy();
    table = $('#live-search-table').DataTable({
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
        "url": '{{ url("/live_search_datatable") }}/' + keyWord,
        "data" : {
            // "_token"	: "{{ csrf_token() }}"
            }
        },
        columnDefs: [
            { className: 'dt-body-center', targets: 4, "className": "text-center" },
            { targets: 4, orderable: false },
            { width: 40, targets: 0 },
            { width: 80, targets: 1 },
            { width: 40, targets: 2 },
            { width: 40, targets: 3 },
            { width: 40, targets: 4 }
        ],
        columns:[
        {
            data: 'CustomerName',
            name: 'CustomerName'
        },
        {
            data: 'CustomerNumber',
            name: 'CustomerNumber'
        },
        {
            data: 'AO',
            name: 'AO'
        },
        {
            data: 'SalesGroup',
            name: 'SalesGroup'
        },
        {
            data: 'action',
            name: 'action'
        }  
        ]
        });   
    }
}

// Query Customers
var cId = '';
function selectCus(button){
    $('#selectCustomerModal').modal('hide');
    const cusName = button.getAttribute('data-cus-name');
    const customerNameVal = $('.customer_name_val').val(cusName);
    
    const cusNo = button.getAttribute('data-cus-no');
    const cusNoVal = $('.customer_number_val').val(cusNo);

    const cusId = button.getAttribute('data-cus-id');
    const customerIdVal = $('.customer_id_val').val(cusId);
    cId = cusId;
    getContacts(cusId)
}

function getContacts(cusId){
    $.ajax({
    url: '{{ url("/get_contacts") }}/' + cusId,
    method: 'GET',
    cache: false,
        success: function(html){
        $('.for-contacts').html(html)
        }
    });   
}

// Add Contacts
function openAddContacts(button){
    $('.addContact').modal('show');
    console.log('c: ', cId);
}
    function submitContact(){
       
        var c_salutation_val = $('.c_s_val').val();
        var c_fname_val = $('.c_firstname_val').val();
        var c_lname_val = $('.c_lastname_val').val();
        var c_mname_val = $('.c_middlename_val').val();
        var c_email_val = $('.c_email_val').val();
        var c_mobile_val = $('.c_mobile_val').val();
        var c_telephone_val = $('.c_telephone_val').val();
        var c_mobile_val = $('.c_mobile_val').val();
        var c_address_val = $('.c_address_val').val();
        var c_contact_name_val = c_salutation_val + c_fname_val + c_lname_val;

        if (!c_salutation_val){
            $('#c-s-text').text('* Salutation is required').css('color', '#D24D57');
            $('#c_s_style').addClass('is-invalid');
            $('#add-contact-btn').attr('disabled', true);
        }

        $('.c_s_val').bind('click', function(){
            $('#c_s_style').removeClass('is-invalid');
            $('#c-s-text').text('');
            $('#add-contact-btn').attr('disabled', false);
        });
        
        if (!c_fname_val){
            $('#c-fName-text').text('* Firstname is required').css('color', '#D24D57');
            $('#c_fName_style').addClass('is-invalid');
            $('#add-contact-btn').attr('disabled', true);
        }

        $('.c_firstname_val').bind('click', function(){
            $('#c_fName_style').removeClass('is-invalid');
            $('#c-fName-text').text('');
            $('#add-contact-btn').attr('disabled', false);
        });

        if (!c_lname_val){
            $('#c-lName-text').text('* Lastname is required').css('color', '#D24D57');
            $('#c_lName_style').addClass('is-invalid');
            $('#add-contact-btn').attr('disabled', true);
        }

        $('.c_lastname_val').bind('click', function(){
            $('#c_lName_style').removeClass('is-invalid');
            $('#c-lName-text').text('');
            $('#add-contact-btn').attr('disabled', false);
        });

        if (!c_email_val){
            $('#c-email-text').text('* Email is required').css('color', '#D24D57');
            $('#c_email_style').addClass('is-invalid');
            $('#add-contact-btn').attr('disabled', true);
        }

        $('.c_email_val').bind('click', function(){
            $('#c_email_style').removeClass('is-invalid');
            $('#c-email-text').text('');
            $('#add-contact-btn').attr('disabled', false);
        });

        if (!c_mobile_val){
            $('#c-mobile-text').text('* Mobile Number is required').css('color', '#D24D57');
            $('#c_mobile_style').addClass('is-invalid');
            $('#add-contact-btn').attr('disabled', true);
        }

        $('.c_mobile_val').bind('click', function(){
            $('#c_mobile_style').removeClass('is-invalid');
            $('#c-mobile-text').text('');
            $('#add-contact-btn').attr('disabled', false);
        });

        if (!c_telephone_val){
            $('#c-tel-text').text('* Telephone Number is required').css('color', '#D24D57');
            $('#c_tel_style').addClass('is-invalid');
            $('#add-contact-btn').attr('disabled', true);
        }

        $('.c_telephone_val').bind('click', function(){
            $('#c_tel_style').removeClass('is-invalid');
            $('#c-tel-text').text('');
            $('#add-contact-btn').attr('disabled', false);
        });

        if(c_salutation_val && c_fname_val && c_lname_val && c_mobile_val & c_telephone_val){
            saveAddContact()
        }
    
    function saveAddContact(){
        $.ajax({
            url: "{{ url('/add_subs_contact') }}",
            method: 'POST',
            data: { 
                _token: function() {
                return "{{ csrf_token() }}"
            },
            cId,
            c_salutation_val,
            c_fname_val,
            c_lname_val,
            c_mname_val,
            c_email_val,
            c_mobile_val,
            c_telephone_val,
            c_mobile_val,
            c_address_val,
            c_contact_name_val
            },
            cache: false,
            success:function(html){
                $('.alert-m').html('<div class="container"><div class="col-md-12 alert-margin" style="margin-top: 15px;"><div class="alert alert-info"><div class="fa fa-spinner fa-spin"></div> NEW CONTACT WAS SUCCESSFULLY CREATED.</div></div></div>'); 
            setTimeout(removeAddContactAlert, 2000);
            }
        });
    }
}

function removeAddContactAlert(){
    $('.alert-m').hide();
}

function submitAssignPM(idX){    
    var sPmVal = $('.sPm').val();
    
    if (!sPmVal){
        $('#pm-name-text').text('* Please Select PM').css('color', '#D24D57');
        $('#pm_name_style').addClass('is-invalid');
    }

    $('.sPm').bind('click', function(){
        $('#pm_name_style').removeClass('is-invalid');
        $('#pm-name-text').text('');
    })

    if (sPmVal){
        addAssignPm();
    }

    function addAssignPm(){
        $.ajax({
            url: "{{ url('/add_assign_pm') }}/" + sPmVal + "/" + idX,
            method: 'GET',
            cache: false
        });
    }
}

function submitAssignTCD(iTcd){    
    var sTcdVal = $('.sTcd').val();
    const soNumber = so_number;
    if (!sTcdVal){
        $('#tcd-name-text').text('* Please Select TCD').css('color', '#D24D57');
        $('#tcd_name_style').addClass('is-invalid');
    }

    $('.sTcd').bind('click', function(){
        $('#tcd_name_style').removeClass('is-invalid');
        $('#tcd-name-text').text('');
       
    })

    if (sTcdVal){
        addAssignTcd();
    }

    function addAssignTcd(){
        $.ajax({
            url: "{{ url('/add_assign_tcd') }}/" + sTcdVal + "/" + iTcd,
            method: 'GET',
            cache: false
        });
    }
}

function submitAssignCSD(iCsd){    
    var sCsdVal = $('.sCsd').val();
    const soNumber = so_number;
    if (!sCsdVal){
        $('#csd-name-text').text('* Please Select CSD').css('color', '#D24D57');
        $('#csd_name_style').addClass('is-invalid');
    }

    $('.sCsd').bind('click', function(){
        $('#csd_name_style').removeClass('is-invalid');
        $('#csd-name-text').text('');
    })

    if (sCsdVal){
        addAssignCsd();
    }

    function addAssignCsd(){
        $.ajax({
            url: "{{ url('/add_assign_csd') }}/" + sCsdVal + "/" + iCsd,
            method: 'GET',
            cache: false
        });
    }
}

function submitEditPM(){    
    var ePmVal = $('.ePm').val();
    if (!ePmVal){
        $('#pm-name-text').text('* Please Select PM').css('color', '#D24D57');
        $('#pm_name_style').addClass('is-invalid');
    }

    $('.ePm').bind('click', function(){
        $('#pm_name_style').removeClass('is-invalid');
        $('#pm-name-text').text('');
    })

    if (ePmVal){
        editAssignPm();
    }

    function editAssignPm(){
        $.ajax({
            url: "{{ url('/edit_assign_pm') }}/" + ePmVal + "/" + subsId,
            method: 'GET',
            cache: false
        });
    }
}

function submitEditTCD(){    
    var eTcdVal = $('.eTcd').val();
    if (!eTcdVal){
        $('#tcd-name-text').text('* Please Select TCD').css('color', '#D24D57');
        $('#tcd_name_style').addClass('is-invalid');
    }

    $('.eTcd').bind('click', function(){
        $('#tcd_name_style').removeClass('is-invalid');
        $('#tcd-name-text').text('');
       
    })

    if (eTcdVal){
        editAssignTcd();
    }

    function editAssignTcd(){
        $.ajax({
            url: "{{ url('/edit_assign_tcd') }}/" + eTcdVal + "/" + subsId,
            method: 'GET',
            cache: false
        });
    }
}

function submitEditCSD(){    
    var eCsdVal = $('.eCsd').val();
    console.log('csd: ', eCsdVal);
    if (!eCsdVal){
        $('#e-csd-name-text').text('* Please Select CSD').css('color', '#D24D57');
        $('#e_csd_name_style').addClass('is-invalid');
    }

    $('.eCsd').bind('click', function(){
        $('#e_csd_name_style').removeClass('is-invalid');
        $('#e-csd-name-text').text('');
    })

    if (eCsdVal){
        editAssignCsd();
    }

    function editAssignCsd(){
        $.ajax({
            url: "{{ url('/edit_assign_csd') }}/" + eCsdVal + "/" + subsId,
            method: 'GET',
            cache: false
        });
    }
}

// File Attachment
function fileAttachment() {
    $('.fileAttachmentModal').modal('show');
}

</script>






