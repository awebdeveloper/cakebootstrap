<div class="navbar navbar-fixed-top">
      	<div class="navbar-inner">
	        <div class="container-fluid">
	          	<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	            	<span class="icon-bar"></span>
	            	<span class="icon-bar"></span>
	            	<span class="icon-bar"></span>
	          	</a>
	          	<a class="brand" href="#"><?php echo SITE_NAME; ?></a>
	          	<div class="nav-collapse">
	            	<ul class="nav">
	              		<li class="active"><a href="<?php echo SITEURL; ?>admin/users/dashboard/">Home</a></li>
	              		<li><a href="<?php echo SITEURL; ?>admin/users/index/">Users</a></li>
	              		<li><a href="<?php echo SITEURL; ?>admin/shares/stats/">Analytics</a></li>
	              		<li><a href="<?php echo SITEURL; ?>admin/tickets/index/help/">Support</a></li>
	           		</ul>
	          	</div><!--/.nav-collapse -->
	          	<div class="pull-right">
					<div class="btn-group pull-right">
		            	<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
		              		<i class="icon-user"></i> <?php echo Inflector::humanize($_USER['username']); ?>
		              		<span class="caret"></span>
		            	</a>
		            	<ul class="dropdown-menu">
		              		<li><a href="#">Profile</a></li>
		              		<li class="divider"></li>
		              		<li><a href="<?php echo SITEURL; ?>users/logout/">Sign Out</a></li>
		            	</ul>
		            </div>
	          	</div>
	        </div>	
	    </div>
	</div>