moment.tz.setDefault("Asia/Kolkata");

$(function() {
    loadDataTable($("#daterange").val());
    
    $("#searchButton").click(function() {
        loadDataTable($("#daterange").val());
    });

    $("#allTimeReport").click(function() {
        loadDataTable();
    });

    $("#cutoffReport").click(function() {
        loadDataTable("", true);
    });

    /**
     * Reset form values
     */
    $('#affiliateStatusModal').on('hidden.bs.modal', function(){
        $('#affiliateStatusForm').trigger("reset");
    });
    $('#affiliateCommission').on('hidden.bs.modal', function(){
        $('#affiliateCommissionForm').trigger("reset");
    });
    $('#affiliateCutoff').on('hidden.bs.modal', function(){
        $('#affiliateCutoffForm').trigger("reset");
    });

    /**
     * Pass affiliate info in modal
     */
     // Affiliate Status Modal
    $('#affiliateStatusModal').on("show.bs.modal", function (e) {
        let myForm = $("#affiliateStatusForm");

        let affiliateId = $(e.relatedTarget).data().affiliateid;
        $("input[name='affiliateId']", myForm).val(affiliateId);

        let selectedOption = $(e.relatedTarget).data().affiliatestatus;
        $("#affiliateStatus", myForm).val(selectedOption);
    });

    // Affiliate Commission Modal
    $('#affiliateCommissionModal').on("show.bs.modal", function (e) {
        let myForm = $("#affiliateCommissionForm");

        let affiliateId = $(e.relatedTarget).data().affiliateid;
        $("input[name='affiliateId']", myForm).val(affiliateId);

        let defaultValSports = $(e.relatedTarget).data().affiliatesportscommission;
        $("#affiliateSportsCommission", myForm).val(defaultValSports);
        
        let defaultValCasino = $(e.relatedTarget).data().affiliatecasinocommission;
        $("#affiliateCasinoCommission", myForm).val(defaultValCasino);

        let defaultCutoff = $(e.relatedTarget).data().affiliatecutoff;
        $('#affiliateCutoff', myForm).daterangepicker({
            "minDate": defaultCutoff,
            "singleDatePicker": true,
            "showDropdowns": true,
            "startDate": defaultCutoff
        });

        let defaultCutoffWeekDay = $(e.relatedTarget).data().affiliatecutoffweekday;
        if (defaultCutoffWeekDay > 0) {
            $("input[name='cutoffType'][value='W']", myForm).prop( "checked", true );
            $(".cutoffDateContainer").hide();
            $(".cutoffDayContainer").show();
        } else {
            $("input[name='cutoffType'][value='M']", myForm).prop( "checked", true );
            $(".cutoffDayContainer").hide();
            $(".cutoffDateContainer").show();
        }

    });
    
    $(".cutoffDayContainer").hide();
    $("input[name='cutoffType']").click(function() {
        let prefix = $(this).val();
        if (prefix === "W") {
            $(".cutoffDateContainer").hide();
            $(".cutoffDayContainer").show();
        } else {
            $(".cutoffDayContainer").hide();
            $(".cutoffDateContainer").show();
        }
    });

});


/**
 * JQuery Plugins
 */

$('#daterange').daterangepicker({
    "showDropdowns": true,
    "startDate": moment().subtract(1, 'days'),
    "endDate": moment().subtract(1, 'days'),
    "timePickerSeconds": false,
    "timePicker": false,
    "timePicker24Hour": false,
    "ranges": {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
});

$('.date-picker-add-aff').daterangepicker({
    "minDate": moment(),
    "singleDatePicker": true,
    "showDropdowns": true,
    "startDate": moment()
});

/**
 * Functions
 */
console.log(columnRight);
/**
* Data table settings
* @param  {Number} isFilter Use as a flag
* @param  {Number} agentId  The agent id provided
* @param  {Number} playerId The player id provided
* @return {void}
*/
function loadDataTable(dateRange, isCutoff = 0) {
    $('#affiliateTable').DataTable().destroy();
    $('#affiliateTable').DataTable({
        "pageLength": [ 10, 25, 50 ],
        "processing": true,
        "serverSide": false,
        "paging": true,
        "searching": false,
        "pageLength": 10,
        "order": [],
        "dom": 'Blfrtip',
        "buttons":[
            {
                "extend": "pdf",
                "className": "btn green btn-outline",
                "orientation": 'landscape',
                "pageSize": 'LEGAL'
            },
            {
                "extend": "csv",
                "className": "btn purple btn-outline "
            }
        ],
        "ajax": {
            "url": "/affiliate-list/affiliates",
            "type": "GET",
            "data": {
                "_token": "{{csrf_token()}}",
                "dateRange" : dateRange,
                "countryManagerId": $('#affiliateCountryManagerFilter').val(),
                "affiliateId": $('#affiliateFilterDropdown').val(),
                "affiliateStatus": $('#affiliateStatusFilterDropdown').val(),
                "cutOff": isCutoff
            }
        },
        // "order": [[6, "desc"]],
        "columnDefs": [
            {
                "targets" : columnRight,
                "className": "text-right"
            },
            {
                "targets" : columnCenter,
                "className": "text-center"
            },
            {
                "targets" : columnOrder,
                "searchable": false,
                "orderable": false
            }
        ],
    });
}
