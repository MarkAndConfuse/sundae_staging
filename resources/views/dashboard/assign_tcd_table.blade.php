<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <!-- <h1 class="m-0 text-dark">Dashboard</h1> -->
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>    
                    <li class="breadcrumb-item active"> Today is {{ $dateTime }}</li>     
                </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
<!-- /.content-header -->
<main class="main-d">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
                <div class="row">
                <div class="container">
                <div class="card mb-4">         
                <div class="card-header subscription-h">
                <i class="fa fa-list"></i>
            ASSIGNED TCD
        </div>
    <div class="row subs-spinner">
</div> 
<div class="card-body tcd-body" style="margin-top: -12px;">
<br>
    <form id="search-items-form">
    <div class="row alert-tcd-message">
        </div>
        <!-- <div class="row">
            <div class="col-md-3">
                <label>ADD NEW TCD</label>
                <select class="form-control" name="tcd_name">
                    <option></option>
                </select>
            </div>
        </div>
    <br>
        <div class="row">
            <div class="col-md-3">
            <button id="update-btn" type="submit" 
                class="btn btn-success btn-sm">
            <i class="fa fa-save"></i> SUBMIT</button>
        </div>          
    </div> -->
</form>
<div class="table-responsive">
    <table id="tcd-table" class="table-docs table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th class="t-th">Account ID</th>
                <th class="t-th">Name</th>
                <th class="t-th">Email</th>
                <th class="t-th">Action</th>
            </tr>
            </thead>
            @foreach($assignTcd as $tCd)
            <tr>
                <td>{{ $tCd->account_id }}</td>
                <td>{{ $tCd->tcd_name }}</td>
                <td>{{ $tCd->email }}</td>
                <td style="text-align: center;">
                    <button class="btn btn-danger btn-xs" data-tcd-id="{{ $tCd->id }}" data-sub-id="{{ $tCd->sub_id }}" 
                    type="button" onclick="deleteTcd(this)"><i class="fa fa-trash"></i> Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
        </div>  
    </div>
</div>
<!-- /.card-header -->
<div class="card-body pt-0">
    </div>
        </div>
          	</section>	
            </div>
        <!-- /.content -->
    </div>
</main>
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
        background-color: #E83E8C;
        height: 2.3em;
        white-space: nowrap; 
    }
    
    .subscription-h {
        background-color: #BFBFBF;
    }
    td { 
        white-space: nowrap; 
    }
</style>
@include('dashboard.js.assign_tcd_js')

