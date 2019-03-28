<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<header class="main-header">
			<a href="<?php echo base_url().'marketing_exc/dashboard' ?>" class="logo">
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
						<!-- <li class="dropdown tasks-menu" id="notification">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-tasks"></i>
								<span class="label label-danger"><?php echo ($NewLeads) ? count($NewLeads) : 0 ; ?></span>
							</a>
							<ul class="dropdown-menu">
								<?php if ($NewLeads): ?>
									<li class="header">You have <?php echo count($NewLeads); ?> New Leads</li>
									<li>
										<ul class="menu">
											<li>
												<?php foreach ($NewLeads as $NewLead): ?>
													<a class="details" href="javascript:void(0);" data-id="<?php echo $NewLead['id'] ?>">
													<i class="fa fa-users text-aqua"></i> <?php echo $NewLead['name'].' From '. $NewLead['country'].' asked for '.$NewLead['report'] ?>
												</a>
												<?php endforeach ?>
											</li>
										</ul>
									</li>
									<li class="footer"><a href="#">View all</a></li>
								<?php else: ?>
									<li class="header">No New Leads</li>
								<?php endif ?>
							</ul>
						</li> -->
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
									<div class="pull-left">
										<a href="<?php echo base_url().'marketing_exc/changePassword' ?>" class="btn btn-default btn-flat">Change Password</a>
									</div>
									<div class="pull-right">
										<a href="<?php echo base_url().'logout/marketing_exc' ?>" class="btn btn-default btn-flat">Log out</a>
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
					<li>
						<a href="<?php echo base_url().'marketing_exc/viewlist' ?>">
							<i class="fa fa-chevron-circle-right"></i><span>All Leads</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url().'marketing_exc/myList' ?>">
							<i class="fa fa-chevron-circle-right"></i><span>My Leads</span>
						</a>
					</li>
				</ul>
			</section>
		</aside>