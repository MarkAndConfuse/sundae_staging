<script type="text/javascript">

function emailRecipients(button){
    $('.emailRecipientsModal').modal('show');
    var rSubId = button.getAttribute('data-rec-subs-id');
    console.log('rec subs id: ', rSubId);
}

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



</script>






