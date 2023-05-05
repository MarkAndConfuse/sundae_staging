<script type="text/javascript">

function manageCustomers(event){
    $.ajax({
    url: '{{ url("/manage_customers") }}',
    method: 'GET',
    cache: false,
        success: function(html){
            $('.main-d').html(html);
                $('.custo-body').hide();
                $('.subs-spinner').html('<div class="container spinner"><div class="col-md-12 container"><img style="height: 60px; width: 60px; display: block; margin-left: 450px;" src="/images/loader_circle.gif" /></div></div>');  
            setTimeout(loadCustomersDataTable, 2000);
            }
        });   
    }

    function loadCustomersDataTable(){
        $('.spinner').hide();
        $('.custo-body').show();
        $('#customers').DataTable().destroy();
        table = $('#customers').DataTable({
            "searching": true,
            "loading": false,
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
                'url': '{{ url("/customers_datatables") }}',
                "data" : {
                    // "_token"	: "{{ csrf_token() }}"
	    		}
            },
            columnDefs: [
                { className: 'dt-body-center', targets: 2, "className": "text-center" },
                { targets: 2, orderable: false },
                { width: 60, targets: 0 },
                {"defaultContent": "-",
                "targets": "_all"
            }
            ],
            columns:[
            {
                data: 'CustomerID',
                name: 'CustomerID'
            },
            {
                data: 'CustomerName',
                name: 'CustomerName'
            },
            {
                data: 'action',
                name: 'action'
            }
        ]
    });   
}

