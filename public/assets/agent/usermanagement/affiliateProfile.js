moment.tz.setDefault("Asia/Kolkata");

$(function() {
    loadDataTable();
    loadAffiliateProfile($("#daterange").val());
    loadGrandTotal($("#daterange").val());

    $('#affiliateCutoff').on('hidden.bs.modal', function(){
        $('#affiliateCutoffForm').trigger("reset");
    });

    /**
     * Pass affiliate info in modal
     */
     // Affiliate Status Modal
    $('#newPlayerModal').on("show.bs.modal", function (e) {
        let myForm = $("#affiliatePlayerForm");

        let affiliateId = $(e.relatedTarget).data().affiliateid;
        $("input[name='affiliateId']", myForm).val(affiliateId);
    });

    $("#playerSelection").change(function() {
       $.ajax({
           url: "/affiliate-profile/playerEmail/"+$(this).val(),
           type: "GET",
           success: function(msg) {
               $("#playerEmail").val(msg);
           }
       })
    });

    $("#searchButton").click(function() {
        loadAffiliateProfile($("#daterange").val());
        loadGrandTotal($("#daterange").val());
    });

    $("#allTimeReport").click(function() {
        loadAffiliateProfile();
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
function loadDataTable() {
    $('#datatableCommision').DataTable().destroy();
    $('#datatableCommision').DataTable({
        "pageLength": [ 10, 25, 50 ],
        "processing": true,
        "serverSide": false,
        "paging": true,
        "searching": false,
        "pageLength": 10,
        "dom": 'Blfrtip',
        "buttons":[
            {
                "extend": "print",
                "className": "btn dark btn-outline"
            },
            {
                "extend": "pdf",
                "className": "btn green btn-outline"
            },
            {
                "extend": "csv",
                "className": "btn purple btn-outline "
            }
        ],
        "ajax": {
            "url": "/affiliate-profile/commissionLogs",
            "type": "GET",
            "data": {
                "affiliateId" : $('#affId').val()
            }
        }
    });
    
}

function loadAffiliateProfile(dateRange) {
    $("#affiliatePlayerTable").DataTable().destroy();
    $("#affiliatePlayerTable").DataTable({
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
            "url": "/affiliate-profile/playerList",
            "type": "GET",
            "data": {
                "affiliateId"   : $('#affId').val(),
                "dateRange"     : dateRange,
                "playerId"      : $("#affiliatePlayerDropdown").val()
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
            "url": "/affiliate-profile/grandTotal",
            "type": "GET",
            "data": {
                "affiliateId"   : $('#affId').val(),
                "dateRange"     : dateRange,
                "playerId"      : $("#affiliatePlayerDropdown").val()
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
