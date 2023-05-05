<main class="subs">
    <div class="container-fluid">
<div class="row charts-docs">
    <div class="col-xl-12 docs-table">
        <div class="card mb-4">         
<div class="card-header subscription-h">
    <i class="fa fa-list"></i>
        LIST OF SUBSCRIPTIONS
        </div>
    <div class="row subs-spinner">
</div> 
<div class="card-body docs-body">
<div class="row">
    <div class="col-md-6">
        <button class="btn btn-success btn-xs" onclick="addSubscription(event)"><i class="fa fa-plus-circle"></i> Add Subscription</button>
    </div>
</div>
<br>
<div class="table-responsive">
    <table id="subscriptions" class="table-docs table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th class="s-th">SO No.</th>
                <th class="s-th">Inv. Date</th>
                <th class="s-th">Act. Date</th>
                <th class="s-th">Mat. No.</th>
                <th class="s-th">Action</th>
                <th class="s-th">Mat. Desc.</th>
                <th class="s-th">BU</th>
                <th class="s-th">AO</th>
                <th class="s-th">Customer Name</th>
                <th class="s-th">Customer Number</th>
                <th class="s-th">Payment Schedule</th>
                <th class="s-th">Terms</th>
                
            </tr>
        </thead>
    </table>
                    </div>
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
    .s-th {
        font-size: 14px;
        font-family: "Montserrat", sans-serif;
        text-transform: uppercase;
        background-color: #E83E8C;
        height: 2.3em;
        white-space: nowrap; 
        /* background-color: #E83E8C; */
    }
    .center {
        display: block;
        margin-left: auto;
        margin: auto;
        width: 100%;
    }  
    .subscription-h {
        background-color: #BFBFBF;
    }
    td { 
        white-space: nowrap; 
    }
</style>
<script type="text/javascript">
    $(function () {
        $('#subscriptions').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "loading": false,
        "info": true,
        "autoWidth": false,
        "processing": false,
        "fixedColumns":   {
            heightMatch: 'none'
        }
    });
});
</script>









