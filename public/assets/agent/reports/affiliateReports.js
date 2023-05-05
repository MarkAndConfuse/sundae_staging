moment.tz.setDefault("Asia/Kolkata");

$(function() {
    loadAffiliateReports($("#daterange").val());
    loadGrandTotal($("#daterange").val());

    $("#searchButton").click(function() {
        loadAffiliateReports($("#daterange").val());
        loadGrandTotal($("#daterange").val());
    });

    $("#allTimeReport").click(function() {
        loadAffiliateReports();
        loadGrandTotal();
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

/**
 * Functions
 */

/**
* Datatable settings
* @param  {Number} affiliateId  The agent id provided
* @return {void}
*/
function loadAffiliateReports(dateRange) {
    $("#affiliateReportTable").DataTable().destroy();
    $("#affiliateReportTable").DataTable({
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
                "extend": "print",
                "className": "btn dark btn-outline",
                "customize": function(win) {
                    var last = null;
                    var current = null;
                    var bod = [];
                    
                    var css = '@page { size: landscape; }',
                        head = win.document.head || win.document.getElementsByTagName('head')[0],
                        style = win.document.createElement('style');
     
                    style.type = 'text/css';
                    style.media = 'print';
     
                    if (style.styleSheet)
                        style.styleSheet.cssText = css;
                    else
                        style.appendChild(win.document.createTextNode(css));
     
                    head.appendChild(style);
                }
            },
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
            "url": "/reports-affiliate/affiliteReportsDT",
            "type": "GET",
            "data": {
                "dateRange"   : dateRange,
                "affiliateId" : $("#affiliateReportsDropdown").val(),
                "countryManagerId": $('#affiliateCountryManagerFilter').val()
            }
        },
        "columnDefs": [
            {
                "targets" : columnRight,
                "className": "text-right"
            }
        ],
    });
}

function loadGrandTotal(dateRange) {
    $("#grandTotalTable").DataTable().destroy();
    $("#grandTotalTable").DataTable({
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
                "extend": "print",
                "className": "btn dark btn-outline",
                "customize": function(win) {
                    var last = null;
                    var current = null;
                    var bod = [];
                    
                    var css = '@page { size: landscape; }',
                        head = win.document.head || win.document.getElementsByTagName('head')[0],
                        style = win.document.createElement('style');
     
                    style.type = 'text/css';
                    style.media = 'print';
     
                    if (style.styleSheet)
                        style.styleSheet.cssText = css;
                    else
                        style.appendChild(win.document.createTextNode(css));
     
                    head.appendChild(style);
                }
            },
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
            "url": "/reports-affiliate/affiliateReportsGTDT",
            "type": "GET",
            "data": {
                "dateRange"   : dateRange,
                "affiliateId" : $("#affiliateReportsDropdown").val(),
                "countryManagerId": $('#affiliateCountryManagerFilter').val()
            }
        },
        "columnDefs": [
            {
                "targets" : columnRight,
                "className": "text-right"
            }
        ],
    });
}
