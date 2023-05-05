<div class="row charts-docs">
    <div class="col-xl-12 docs-table">
        <div class="card mb-4">         
<div class="card-header customers-h">
    <i class="fa fa-list"></i>
        LIST OF CONTACTS
            </div>
        <div class="row subs-spinner">
    </div> 
<div class="card-body subs-contacts-body" style="margin-top: -12px;">
<br>
<div class="table-responsive">
    <table id="subs-contacts-table" class="table-docs table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th class="t-th">Contact Name</th>
                <th class="t-th">Designation</th>
                <th class="t-th">Email</th>
                <th class="t-th">Telephone</th>
                <th class="t-th">Mobile</th>
            </tr>
        </thead>
    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-group-xs > .btn, .btn-xs {
        padding: .25rem .4rem;
        font-size: .875rem;
        line-height: .5;
        border-radius: .2rem;
    }
    .t-th {
        font-size: 14px;
        font-family: "Montserrat", sans-serif;
        text-transform: uppercase;
        background-color: #BFBFBF;
        height: 2.3em;
        white-space: nowrap; 
    }
    .center {
        display: block;
        margin-left: auto;
        margin: auto;
        width: 100%;
    }  
    .customers-h {
        background-color: #BFBFBF;
    }
    td { 
        white-space: nowrap; 
    }
</style>
<script type="text/javascript">
    $(function () {
        $('#subs-contacts-table').DataTable({
        "paging": true,
        "loading": false,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "processing": false,
        "fixedColumns":   {
            heightMatch: 'none'
        }
    });
});
</script>

  








