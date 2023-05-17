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
@if(session()->get('GoogleName'))
<main class="main-d">
    <div class="container-fluid"> 
<div class="row charts-docs">
    <div class="col-xl-12 ">
        <div class="card mb-4">  
<div class="card-header subscription-h">
    <i class="fa fa-edit"></i>
    VIEW SUBSCRIPTION
</div> 
<div class="card-body">
    <div class="col-md-12">
        <!-- <a style="text-decoratino: none;">
            <button class="btn btn-primary btn-xs" style="margin-top: -18px; margin-left: -4px;">
                <i class="fa fa-arrow-left"></i> 
            BACK
            </button>
        </a> -->
        <button class="btn btn-primary btn-xs" 
            onclick="viewAndUpdateSubscription(this, {{ $subs->id }})"
                data-subs-id="{{ $subs->id }}"
                    data-so-number="{{ $subs->so_number }}"
                    data-invoice-date="{{ $subs->invoice_date }}"
                    data-so-date="{{ $subs->so_date }}"
                    data-material-no="{{ $subs->mat_number }}"
                    data-material-desc="{{ $subs->mat_desc }}"
                    data-brand="{{ $subs->brand }}"
                    data-category="{{ $subs->category }}"
                    data-bu="{{ $subs->bu }}"
                    data-assigned-ao="{{ $subs->assigned_ao }}"
                    data-activation-date="{{ $subs->activation_date }}"
                    data-activation-status="{{ $subs->activation_status }}"
                    data-customer-name="{{ $subs->customer_name }}"
                    data-customer-number="{{ $subs->customer_number }}"
                    data-customer-id="{{ $subs->customer_id }}"
                    data-contact-id="{{ $subs->contact_id }}"
                    data-terms="{{ $subs->terms }}"
                    data-p-schedule="{{ $subs->payment_schedule }}" 
                style="margin-top: -18px; margin-left: 4px;">
            <i class="fa fa-edit"></i> 
        UPDATE
        </button>
        <button class="btn btn-warning btn-xs" 
            data-subs-id="{{ $subs->id }}"
            onclick="emailNotifs(this, {{ $subs->id }})" 
                style="margin-top: -18px; margin-left: 4px;">
            <i class="fa fa-bell"></i> 
        EMAIL NOTIFICATIONS
        </button>
        <!-- @if(session()->get('GoogleName') == 'Mark Edo Escario')
        <a href="/load_pm/{{ $subs->id }}" style="text-decoration: none;"><button class="btn btn-warning btn-xs e_recs"  
                style="margin-top: -18px; margin-left: 4px;">
            <i class="fa fa-address-book"></i> 
        ASSIGNED PM
        </button></a>
        @endif
        @if(session()->get('GoogleName') == 'Mark Edo Escario')
        <a href="/load_tcd/{{ $subs->id }}" style="text-decoration: none;"><button class="btn btn-warning btn-xs e_recs"  
                style="margin-top: -18px; margin-left: 4px;">
            <i class="fa fa-address-book"></i> 
        ASSIGNED TCD
        </button></a>
        @endif
        @if(session()->get('GoogleName') == 'Mark Edo Escario')
        <a href="/load_csd/{{ $subs->id }}" style="text-decoration: none;"><button class="btn btn-warning btn-xs e_recs"  
                style="margin-top: -18px; margin-left: 4px;">
            <i class="fa fa-address-book"></i> 
        ASSIGNED CSD
        </button></a>
        @endif -->
        <!-- <button class="btn btn-warning btn-xs" 
            onclick="fileAttachment(event)" 
                style="margin-top: -18px; margin-left: 4px">
            <i class="fa fa-address-book"></i> 
        FILE ATTACHMENTS
        </button> -->
    </div> 
<hr>
<div class="row" style="margin-top: -5px;">
    <div class="col-md-12">
        <p>Customer Name: <b style="font-size: 28px;">{{ $subs->customer_name }}</b></p>
</div>
<div class="col-md-8">
    <p style="margin-top: -15px;">Contact Person: <b style="text-transform: uppercase;">{{ $contactPerson->ContactName }}</b></p>
        </div>
    </div>
    <div class="row">   
        <div class="col-md-6 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-paperclip"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">SO Number</span>
                        <span class="info-box-text"><b>{{ $subs->so_number }}</b></span>
                    </div>
                    <div class="info-box-content">
                        <span class="info-box-text">Invoice Date</span>
                        <span class="info-box-text"><b>{{ $inv_date }}</b></span>
                    </div>
                    <div class="info-box-content">
                        <span class="info-box-text">Payment Schedule</span>
                        <span class="info-box-text"><b>{{ $subs->payment_schedule }}</b></span>
                    </div>
                        <!-- /.info-box-content -->
                    </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fa fa-calendar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Activation Date</span>
                        <span class="info-box-text"><b>{{ $act_date }}</b></span>
                    </div>
                    <div class="info-box-content">
                        <span class="info-box-text">Expiration Date</span>
                        <span class="info-box-text"><b>{{ $exp_date }}</b></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-6 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-plug"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Activation Status</span>
                        <span class="info-box-text"><b>{{ $subs->activation_status }}</b></span>
                    </div>
                    <div class="info-box-content">
                        <span class="info-box-text">Terms</span>
                        <span class="info-box-text"><b>{{ $subs->terms }}</b></span>
                    </div>
                    <!-- /.info-box-content -->
                    </div>
                <!-- /.info-box -->
            </div>
        <div class="col-md-6 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-user-circle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">BU</span>
                        <span class="info-box-text"><b>{{ $subs->bu }}</b></span>
                    </div>
                    <!-- /.info-box-content -->
                    </div>
                <!-- /.info-box -->
            </div>
        </div>
        <div class="row">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" style="background-color: #e83e8c;">
                            <h3 class="card-title"><b>PRODUCT</b></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Brand</th>
                                        <th>Material No.</th>
                                        <th>Category</th>
                                    </tr>
                                    <tr>
                                        <td><b>{{ $subs->brand }}</b></td>
                                        <td><b>{{ $subs->mat_number }}</b></td>
                                        <td><b>{{ $subs->category }}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-12 col-sm-6 col-12">
                <div class="info-box">
                    <div class="info-box-content">
                        <span class="info-box-text">Material Description</span>
                        <span class="info-box-number">{{ $subs->mat_desc }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" style="background-color: #e83e8c;">
                    <h3 class="card-title"><b>ASSIGNED AO</b></h3>
                </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                        @if(substr($gAvatar, -4) == '.png' || $gAvatar == '')
                        <td><center><img src="/ics_subscription/public/images/avatar.PNG" class="img-circle elevation-2" 
                            alt="User Image" style="width:42px; height:42px; border-radius:50%" />
                            </center>
                        </td>
                        @else
                            <td><center><img src="{{ $gAvatar }}" class="img-circle elevation-2" 
                        alt="User Image" style="width: 42px; height: 42px; border-radius:50%" /></center></td> 
                        @endif
                        <td>{{ $subs->assigned_ao }}</td>
                        </tr>
                        </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>  
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" style="background-color: #e83e8c;">
                    <h3 class="card-title"><b>ASSIGNED PM</b></h3>
                </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        @if(empty($pM))
                            <p>N/A</p>
                        @else
                        @foreach($pM as $x)
                        <tr>
                        @if(substr($x[1], -4) == '.png')
                        <td><center><img src="/ics_subscription/public/images/avatar.PNG" class="img-circle elevation-2" 
                            alt="User Image" style="width:42px; height:42px; border-radius:50%" />
                            </center>
                        </td>
                        @else
                        <td><center><img src="{{ $x[1] }}" class="img-circle elevation-2" 
                            alt="User Image" style="width:42px; height:42px; border-radius:50%" />
                            </center>
                        </td>
                        @endif
                            <td>{{ $x[0] }}</td>
                        </tr>
                        @endforeach
                        @endif 
                        </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>  
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" style="background-color: #e83e8c;">
                    <h3 class="card-title"><b>ASSIGNED TCD</b></h3>
                </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        @if(empty($tCd))
                            <p>N/A</p>
                        @else
                        @foreach($tCd as $x)
                        <tr>
                        @if(substr($x[1], -4) == '.png')
                        <td><center><img src="/ics_subscription/public/images/avatar.PNG" class="img-circle elevation-2" 
                            alt="User Image" style="width:42px; height:42px; border-radius:50%" />
                            </center>
                        </td>
                        @else
                        <td><center><img src="{{ $x[1] }}" class="img-circle elevation-2" 
                            alt="User Image" style="width:42px; height:42px; border-radius:50%" />
                            </center>
                        </td>
                        @endif
                            <td>{{ $x[0] }}</td>
                        </tr>
                        @endforeach
                        @endif 
                    </tbody>
                </table>
            </div>
                <!-- /.card-body -->
                </div>  
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" style="background-color: #e83e8c;">
                    <h3 class="card-title"><b>ASSIGNED CSD</b></h3>
                </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        @if(empty($cSd))
                            <p>N/A</p>
                        @else
                        @foreach($cSd as $x)
                        <tr>
                        @if(substr($x[1], -4) == '.png' || $x[1] == '')
                        <td><center><img src="/ics_subscription/public/images/avatar.PNG" class="img-circle elevation-2" 
                            alt="User Image" style="width:42px; height:42px; border-radius:50%" />
                            </center>
                        </td>
                        @else
                        <td><center><img src="{{ $x[1] }}" class="img-circle elevation-2" 
                            alt="User Image" style="width:42px; height:42px; border-radius:50%" />
                            </center>
                        </td>
                        @endif
                            <td>{{ $x[0] }}</td>
                        </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>  
            </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header" style="background-color: #e83e8c;">
                    <h3 class="card-title"><b>EMAIL NOTIFICATION</b></h3>
                </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>90 Days Alert</td> 
                            <td><span style="font-size: 14px;" class="badge bg-danger">{{ $notif90 }}</span></td>
                        </tr>
                        <tr>
                            <td>60 Days Alert</td> 
                            <td><span style="font-size: 14px;" class="badge bg-warning">{{ $notif60 }}</span></td>
                        </tr>
                        <tr>
                            <td>30 Days Alert</td> 
                            <td><span style="font-size: 14px;" class="badge bg-success">{{ $notif30 }}</span></td>
                        </tr>    
                        <tr>
                            <td>15 Days Alert</td> 
                            <td><span style="font-size: 14px;" class="badge bg-info">{{ $notif15 }}</span></td>
                        </tr>
                        <tr>
                            <td>7 Days Alert</td> 
                            <td><span style="font-size: 14px;" class="badge bg-secondary">{{ $notif7 }}</span></td>
                        </tr>
                        <tr>
                            <td>1 Day Alert</td> 
                            <td><span style="font-size: 14px;" class="badge bg-primary">{{ $notif1 }}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <!-- /.card-body -->
    </main>
</div>  
        </div>  
                
            @include('dashboard.email_notifs_modal')
            </div>
@else
<div class="col-md-12 alert-margin" style="margin-top: 15px;">
    <div class="alert alert-danger"><div class="fa fa-spinner fa-spin"></div> 
        Sorry, this is an invalid access. Please ask assistance from
        Application Development Team / IT Department. Please <a href=".">Log in</a>.</div></div>
    </div>
</div>
@endif
            </div>  
                </div>
            </div>
        </div>  
        </div>  
                </div>
            </div>
            </div>
            </div>
<style>
    .subscription-h {
        background-color: #BFBFBF;
        margin-top: -16px;
    }
</style>









