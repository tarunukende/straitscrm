<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<header class="main-header">
			<a href="<?php echo base_url().'dashboard' ?>" class="logo">
				<span class="logo-mini"><b>CRM</b></span>
				<span class="logo-lg"><b>Straits</b> CRM</span>
			</a>
			<nav class="navbar navbar-static-top">
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>

				<div class="navbar-custom-menu">
      				<ul class="nav navbar-nav">
      					<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?php echo base_url().'assets/' ?>dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
								<span class="hidden-xs"><?php echo $this->session->userdata('name') ?></span>
							</a>
							<ul class="dropdown-menu">
					  			<!-- User image -->
								<li class="user-header">
									<img src="<?php echo base_url().'assets/' ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
									<p>
										<?php echo $this->session->userdata('name') ?>
									</p>
								</li>
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-right">
										<a href="<?php echo base_url().'logout/Admin' ?>" class="btn btn-default btn-flat">Log out</a>
									</div>
								</li>
							</ul>
				  		</li>
					</ul>
				</div>
			</nav>
		</header>
		<aside class="main-sidebar">
			<section class="sidebar">
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">MAIN NAVIGATION</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-chevron-circle-right"></i>
							<span>Sales Executive</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url();?>sales"><i class="fa fa-circle-o"></i> List Sales Executive</a></li>
							<li><a href="<?php echo base_url();?>sales/add"><i class="fa fa-circle-o"></i> Add Sales Executive</a></li>
						</ul>
					</li>
				<!-- 	<li class="treeview">
						<a href="#">
							<i class="fa fa-chevron-circle-right"></i>
							<span>Marketing Team Leads</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url();?>marketing"><i class="fa fa-circle-o"></i> List Marketing Team Leads</a></li>
							<li><a href="<?php echo base_url();?>marketing/add"><i class="fa fa-circle-o"></i> Add Marketing Team Leads</a></li>
						</ul>
					</li>

					<li class="treeview">
						<a href="#">
							<i class="fa fa-chevron-circle-right"></i>
							<span>Marketing Executive</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url();?>marketing_agent"><i class="fa fa-circle-o"></i> List Marketing Executive</a></li>
							<li><a href="<?php echo base_url();?>marketing_agent/add"><i class="fa fa-circle-o"></i> Add Marketing Executive</a></li>
						</ul>
					</li> -->
					
					<li class="treeview">
						<a href="#">
							<i class="fa fa-chevron-circle-right"></i>
							<span>Regions</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url();?>regions"><i class="fa fa-circle-o"></i> List Regions</a></li>
							<li><a href="<?php echo base_url();?>regions/add"><i class="fa fa-circle-o"></i> Add Regions</a></li>
						</ul>
					</li>

					<li class="treeview">
						<a href="#">
							<i class="fa fa-chevron-circle-right"></i>
							<span>Sales Status</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url();?>sales_status"><i class="fa fa-circle-o"></i> List Sales Status</a></li>
							<li><a href="<?php echo base_url();?>sales_status/add"><i class="fa fa-circle-o"></i> Add Sales Status</a></li>
						</ul>
					</li>

					<li class="treeview">
						<a href="#">
							<i class="fa fa-chevron-circle-right"></i>
							<span>Category</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url();?>category"><i class="fa fa-circle-o"></i> List Category</a></li>
							<li><a href="<?php echo base_url();?>category/add"><i class="fa fa-circle-o"></i> Add Category</a></li>
						</ul>
					</li>

					<li class="treeview">
						<a href="#">
							<i class="fa fa-chevron-circle-right"></i>
							<span>Publisher</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url();?>publisher"><i class="fa fa-circle-o"></i> List Publisher</a></li>
							<li><a href="<?php echo base_url();?>publisher/add"><i class="fa fa-circle-o"></i> Add Publisher</a></li>
						</ul>
					</li>

					<li>
						<a href="<?php echo base_url().'leads' ?>">
							<i class="fa fa-chevron-circle-right"></i><span>All Leads</span>
						</a>
					</li>
				</ul>


			</section>
		</aside>