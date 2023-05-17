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
                    @if(session()->get('GoogleName'))
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $subsTotal }}</h3>
                                <p><a style="cursor: pointer;" class="small-box-footer" onclick="manageSubscription(event)">SUBSCRIPTIONS RECORDS</a></p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-link"></i>
                            </div>
                        <a style="cursor: pointer;" class="small-box-footer" onclick="manageSubscription(event)">View <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    @else 
                    <div class="col-lg-12 col-12">
                        <div class="col-md-12 alert-margin" style="margin-top: 15px;">
                            <div class="alert alert-danger"><div class="fa fa-spinner fa-spin"></div> 
                            Sorry, this is an invalid access. Please ask assistance from
                            Application Development Team / IT Department. Please <a href=".">Log in</a>.</div></div>
                        </div>
                    @endif
                    </div>
                    <!-- ./col -->
                    <!-- <div class="col-lg-3 col-6"> -->
                    <!-- small box -->
                    <!-- <div class="small-box bg-success">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px">%</sup></h3>
                        <p>UPCOMING EXPIRATIONS</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    </div> -->
                    <!-- ./col -->
                    <!-- <div class="col-lg-3 col-6"> -->
                    <!-- small box -->
                    <!-- <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>44</h3>
                        <p>ASSIGNED AOs</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div> -->
            <!-- ./col -->
            <!-- <div class="col-lg-3 col-6"> -->
                <!-- small box -->
                <!-- <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>65</h3>
                    <p>CUSTOMERS</p>
                </div>
                <div class="icon"> -->
                    <!-- <i class="ion ion-pie-graph"></i> -->
					<!-- <i class="fa fa-users"></i>
                </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            		</div> -->
            		<!-- ./col -->
            	</div>
        	</div>
        	<!-- /.card-header -->
            <div class="card-body pt-0">
                <div id="calendar" style="width: 100%"></div>
              		</div>
            			</div>
            			<!-- /.card -->
          					</section>
          				<!-- right col -->
        				</div>
       				<!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
        <!-- /.content -->
    </div>
</main>