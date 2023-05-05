@include('dashboard.header')
	<!-- Main Sidebar Container -->
		<aside class="main-sidebar elevation-4" style="background-color: #EEEEEE;">
    		<!-- Brand Logo -->
			<div class="user-panel mt-3 pb-3 mb-3 d-flex">
				<div class="image">
      				<a href="/dashboard" class="brand-link">
        				<img src="../images/sundae.jpg" class="img-circle elevation-2" style="width:35px; height:35px; border-radius:50%" alt="Sundae">
        			<!-- <span class="brand-text font-weight-light">ICS</span> -->
        		<span style="color: #E83E8C; font-size: 20px; margin-left: 8px;"><b>SUNDAE</b></span>
    		</a>
		</div>
	</div>
    <!-- Sidebar -->
    <div class="sidebar" style="margin-top: -38px;">
        <!-- Sidebar user panel (optional) -->
        	<div class="user-panel mt-3 pb-3 mb-3 d-flex">
				@if(session()->get('GoogleName'))
            	<div class="image">
				<img src="{{ session()->get('gAvatar') }}" class="img-circle elevation-2" alt="User Image">
            		<!-- <img src="/admin_lte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
        		</div>
				@endif
        		<div class="info">
            <a href="#" class="d-block">{{ strtoupper(session()->get('GoogleName')) }}</a>
        </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column">
          	<!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
          		<!-- <li class="nav-item has-treeview">
            		<a href="/dashboard" class="nav-link">
              			<i class="nav-icon fas fa-tachometer-alt"></i>
              			<p>Dashboard <i class="right fas fa-angle-left"></i></p>
              		<p>Dashboard</p>
            	</a> -->
        		<!-- <ul class="nav nav-treeview"> -->
				<li class="nav-item">
                	<a href="/dashboard" style="cursor: pointer;" class="nav-link">
                  		<i class="fa fa-tachometer-alt nav-icon"></i>
                  			<p>Dashboard</p>
                		</a>
            		</li>
					@if(session()->get('GoogleName'))
            		<li class="nav-item">
                		<a style="cursor: pointer;" onclick="manageSubscription(event)" class="nav-link active">
                  			<i class="fa fa-link nav-icon"></i>
                  			<p>Subscriptions</p>
                		</a>
            		</li>
					@endif
					@if(session()->get('GoogleName') == 'Admin')
					<li class="nav-item">
                	<a style="cursor: pointer;" onclick="importSubscriptionData(event)" class="nav-link">
                  		<i class="fa fa-upload nav-icon"></i>
                  			<p>Upload Data</p>
                		</a>
            		</li>
					@endif
        		    <!-- </ul> -->
        	    </li>
          	    <li class="nav-item">
				@if(session()->get('GoogleName'))
			  	    <a class="dropdown-item" href="{{ route('logout') }}"
                	onclick="event.preventDefault();
                	document.getElementById('logout-form').submit();">
					<i class="fa fa-arrow-left nav-icon"></i>
                	{{ __('Logout') }}
                </a>
				@else
				<a style="cursor: pointer;" href="https://sundae.ics.com.ph" class="nav-link">
					<i class="fa fa-arrow-right nav-icon"></i>
                  			<p>Login</p>
                		</a>
				@endif
					<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
						@csrf
					</form>
          		</li>
        	</ul>
    	</nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
@include('dashboard.assign_tcd_table')
@include('dashboard.footer')


