<main class="subs">
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
        <button class="btn btn-primary btn-xs" 
            onclick="manageSubscription(event)"
                style="margin-top: -18px; margin-left: -4px;">
            <i class="fa fa-arrow-left"></i> 
        BACK
        </button>
        <button class="btn btn-warning btn-xs" 
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
                    data-terms="{{ $subs->terms }}"
                    data-p-schedule="{{ $subs->payment_schedule }}" 
                style="margin-top: -18px; margin-left: 4px;">
            <i class="fa fa-edit"></i> 
        UPDATE
        </button>
        <button class="btn btn-warning btn-xs" 
            onclick="emailNotifs(this, {{ $subs->id }})" 
                style="margin-top: -18px; margin-left: 4px;">
            <i class="fa fa-bell"></i> 
        EMAIL NOTIFICATIONS
        </button>
        <!-- <button class="btn btn-warning btn-xs e_recs" 
            onclick="emailRecipients(this)" 
                style="margin-top: -18px;">
            <i class="fa fa-address-book"></i> 
        EMAIL RECIPIENTS
        </button>
        <button class="btn btn-warning btn-xs" 
            onclick="fileAttachments(event)" 
                style="margin-top: -18px;">
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
    <div class="col-md-12">
                       
                      
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>SO Number: <b>{{ $subs->so_number }}</b></td>
                                        <td>Invoice Date: <b>{{ $inv_date }}</b></td>
                                        <td>Payment Schedule: <b>{{ $subs->payment_schedule }} </b></td>
                                        <td>Activation Date: <b>{{ $act_date }}</b></td>
                                    </tr>
</tbody>
                                    <br />
                                    <table class="table table-bordered">
                                        <tbody>
                                    <tr>
                                        <td style="width: 13.2em;">Exp. Date: <b>{{ $exp_date }}</b></td>
                                        <td style="width: 17.2em;">Act. Status: <b>{{ $subs->activation_status }}</b></td>
                                        <td style="width: 15.4em;">Terms: <b>{{ $subs->terms }}</b></td>
                                        <td>BU: <b>{{ $subs->bu }}</b></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    <!-- /.card-body -->
                
          
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
                                        <td>Brand</td>
                                        <td>Material No.</td>
                                        <td>Category</td>
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
                            <td><center><img src="{{ $gAvatar }}" class="img-circle elevation-2" 
                        alt="User Image" style="width:42px; height:42px; border-radius:50%" /></center></td> 
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
                        <tr>
                            <td><center><img src="{{ $pM->GAvatar }}" class="img-circle elevation-2" 
                            alt="User Image" style="width:42px; height:42px; border-radius:50%" /></center></td> 
                            <td>{{ $pM->AccountName }}</td>
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
                    <h3 class="card-title"><b>ASSIGNED TCD</b></h3>
                </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        @if($tCd[0] == '')
                            <p>N/A</p>
                        @else
                        @foreach($tCd as $key => $value)
                        <tr>
                        <td><center><img src="{{ $t->GAvatar }}" class="img-circle elevation-2" 
                            alt="User Image" style="width:42px; height:42px; border-radius:50%" /></center></td>
                            <td>{{ $tCd->AccountName }}</td>
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
                         @if($cSd[0] == '')
                            <p>N/A</p>
                        @else
                        @foreach($cSd as $key => $value)
                        <tr>
                            <td>1.</td> 
                            <td>{{ $value }}</td>
                        </tr>
                        @endforeach
                        @endif 
                    </tbody>
                </table>
            </div>
                <!-- /.card-body -->
                    </div>  
                </div>
            </div>
            <div class="row">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" style="background-color: #e83e8c;">
                            <h3 class="card-title"><b>EMAIL NOTIFICATION</b></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>90 Days Alert</th>
                                        <th>60 Days Alert</th>
                                        <th>30 Days Alert</th>
                                    </tr>
                                    <tr>
                                        <td><span style="font-size: 14px;" class="badge bg-primary">{{ $notif90 }}</span></td>
                                        <td><span style="font-size: 14px;" class="badge bg-warning">{{ $notif60 }}</span></td>
                                        <td><span style="font-size: 14px;" class="badge bg-danger">{{ $notif30 }}</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>  
    </div>
</main>
<style>
    .subscription-h {
        background-color: #BFBFBF;
        margin-top: -16px;
    }
</style>
@include('dashboard.email_notifs_modal')




