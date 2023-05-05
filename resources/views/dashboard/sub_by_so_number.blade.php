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
            FILTERED SUBSCRIPTION BY SO NUMBER
        </div>
    <div class="row subs-spinner">
</div> 
<div class="card-body tcd-body" style="margin-top: -12px;">
<br>
    <form id="search-items-form">
    <div class="row alert-csd-message">
        </div>
        <!-- <div class="row">
            <div class="col-md-3">
                <label>ADD NEW CSD</label>
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
<!-- <hr> -->
<div class="table-responsive">
    <table id="result-table" class="table-docs table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th class="t-th">Mat. No.</th>
                <th class="t-th">SO No.</th>
                <th class="t-th">Brand</th>
                <th class="t-th">Customer</th>
                <th class="t-th">Action</th>
            </tr>
            </thead>
            @foreach($soResults as $sub)
            <tr>
                <td>{{ $sub->mat_number }}</td>
                <td>{{ $sub->so_number }}</td>
                <td>{{ $sub->brand }}</td>
                <td>{{ $sub->customer_name }}</td>
                <td style="text-align: center;">
                    <button class="btn btn-primary btn-xs" 
                    data-subs-id="{{ $sub->id }}"
                    data-so-number="{{ $sub->so_number }}" 
                    data-invoice-date="{{ $sub->invoice_date }}"
                    data-so-date="{{ $sub->so_date }}"
                    data-material-no="{{ $sub->mat_number }}"
                    data-material-desc="{{ $sub->mat_desc }}"
                    data-brand="{{ $sub->brand }}"
                    data-category="{{ $sub->category }}"
                    data-bu="{{ $sub->bu }}"
                    data-assigned-ao="{{ $sub->assigned_ao }}"
                    data-ao-id="{{ $sub->ao_id }}"
                    data-activation-date="{{ $sub->activation_date }}"
                    data-activation-status="{{ $sub->activation_status }}"
                    data-customer-name="{{ $sub->customer_name }}"
                    data-customer-number="{{ $sub->customer_number }}"
                    data-customer-id="{{ $sub->customer_id }}"
                    data-terms="{{ $sub->terms }}"
                    data-p-schedule="{{ $sub->payment_schedule }}"
                    type="button" onclick="viewSubscription(this, {{ $sub->id }})"><i class="fa fa-eye"></i> View
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
@include('dashboard.js.assign_csd_js')
