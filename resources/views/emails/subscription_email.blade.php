<head>
  <meta charset="utf-8">
  <style>
      .btn {
        background-color: #e83e8c !important; 
        border-color: #ff0477 !important; 
        border-radius: 3px !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid transparent !important;
        display: inline-block !important;
        padding: 6px 12px !important;
        margin-bottom: 0 !important;
        font-size: 14px !important;
        font-weight: 400 !important;
        line-height: 1.42857143 !important;
        text-align: center !important;
        white-space: nowrap !important;
        vertical-align: middle !important;
        -ms-touch-action: manipulation !important;
        touch-action: manipulation !important;
        cursor: pointer !important;
        -webkit-user-select: none !important;
        -moz-user-select: none !important;
        -ms-user-select: none !important;
        user-select: none !important;
        background-image: none !important;
        border: 1px solid transparent !important;
      }
      .btn:hover {
         border: 1px solid #ff0075!important;
         text-shadow: #1e4158 0 1px 0!important;
         background: #ff0075!important;
         background: -webkit-linear-gradient(top, #e41e79, #ff0075)!important;
         background: -moz-linear-gradient(top, #e41e79, #ff0075)!important;
         background: -ms-linear-gradient(top, #e41e79, #ff0075)!important;
         background: -o-linear-gradient(top, #e41e79, #ff0075)!important;
         background-image: -ms-linear-gradient(top, #e41e79 0%, #ff0075 100%)!important;
         color: #fff;
      }
	.content p {
		margin: 6;	
	}
</style>
</head>
<body style="background-color:#fd9eca">
  	<div style="margin-left:12%;display: inline-block; width:90%; margin-top:20px">
    	<div style="background-color:white;padding:20px;width:80%;overflow-x:auto;">
     	 	<div align="center">
      			<h2 style="font-family:'Russo One';margin-top: 0;margin-bottom:0;font-size:24px" id="headertitle">Expiration Notification</h2>
      			<hr style="margin-top: 0;margin-bottom:0;">
      			<h2 style="font-family:'Orbitron';margin-top: 0;margin-bottom:0;font-size:18px">Subscription Portal</h2>
      		</div>
      	<h3 style="font-family:'Dosis'">Hi, {{ $ao }}</h3>
	<p>Subscription is about to expire for:</p>
<div class="row content">
	<p><b>Company:</b> {{ $customerName }}</p>
	<p><b>Contact Person:</b> {{ $contactPerson }}</p>
	<p><b>Item/Product:</b> {{ $product }}
	</p>
	<p><b>Expiration Date:</b> {{ $expirationDate }}</p>
	<p><b>Terms:</b> 1 Year</p>
	<p><b>Activation Date:</b> {{ $activationDate }} </p>
	<P><b>Assigned PM:</b> {{ $pmName }}</p>
	<p><b>Assigned TCD:</b> N/A</p>
	<p><b>Assigned CSD:</b> N/A</p> 
 </div>   
<br>
	<a href="#" class="btn col-md-4" style="text-decoration:none;color:white;background-color:#e83e8c;padding:5px 5px 5px 5px; margin-left: 43%;" align="center">View More Information</a><br>
      	<hr style="margin-top: 10px;margin-bottom:0;">
      		<center>
        	<h5 style="margin-top: 0;margin-bottom:0;">** This is a system generated message. DO NOT REPLY TO THIS EMAIL. **</h5>
        	<h6 style="margin-top: 0;margin-bottom:0;float:right">APPSDEV</h6>
      		</center>
    		</div>
    	<br><br>
  	</div>
</body>
