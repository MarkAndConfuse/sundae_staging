<script type="text/javascript">

function loadCDBAccounts(){
    $.ajax({
    url: '{{ url("/load_cdb_accounts") }}',
    method: 'GET',
    cache: false,
        success: function(html){
        $('.cdb').html(html);
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

</script>






