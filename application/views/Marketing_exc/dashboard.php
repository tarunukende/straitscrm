<?php $this->load->view('templates/header') ?>
<?php $this->load->view('Marketing_exc/templates/sidemenu') ?>
	<div class="content-wrapper">
		<section class="content">
			<!-- Default box -->
			<div class="box" style="margin-top: 40px">
				<div class="box-header with-border">
					<h3 class="box-title"><?php echo $pagetitle ?></h3>
				</div>
				<div class="box-body">
					<div class="row" style="padding-top: 30px">
						<div class="col-lg-4 col-xs-6">
							<!-- small box -->
							<div class="small-box bg-aqua">
								<div class="inner">
									<h3><?php echo $NewLeads ?></h3>
									<p>New Leads</p>
								</div>
								<div class="icon">
									<i class="fa fa-tasks"></i>
								</div>
								<a href="<?php echo base_url().'marketing_exc/list' ?>" class="small-box-footer">
									View all <i class="fa fa-arrow-circle-right"></i>
								</a>
							</div>
						</div>
						<div class="col-lg-4 col-xs-6">
							<!-- small box -->
							<div class="small-box bg-green">
								<div class="inner">
									<h3><?php echo $MyLeads ?></h3>
									<p>My Leads</p>
								</div>
								<div class="icon">
									<i class="fa fa-tasks"></i>
								</div>
								<a href="<?php echo base_url().'marketing_exc/myList' ?>" class="small-box-footer">
									View all <i class="fa fa-arrow-circle-right"></i>
								</a>
							</div>
						</div>
					</div>

				</div>
			</div>
		</section>
	</div>
<?php $this->load->view('templates/footer') ?>