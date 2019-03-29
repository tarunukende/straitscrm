<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/sidemenu') ?>
	<div class="content-wrapper">
		<section class="content">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title"><?php echo $pagetitle ?></h3>
				</div>
				<div class="box-body">
					<?php if($this->session->flashdata('msg')): ?>
						<div class="alert alert-info">
							<strong>Info!</strong> <?php echo $this->session->flashdata('msg') ?>
						</div>
					<?php endif ?>
					<br />
					<form class="form-horizontal form-label-left" id="demo-form2" data-parsley-validate method="post">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="Name">
								Name
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<input type="text" id="Name" name="name" required="required" class="form-control col-md-7 col-xs-12">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="Mail">
								Mail
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<input type="email" id="mail" name="mail" required="required" class="form-control col-md-7 col-xs-12">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="Job-Title">
								Job-Title
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<input type="text" id="job_title" name="job_title" required="required" class="form-control col-md-7 col-xs-12">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="Company">
								Company
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<input type="text" id="company" name="company" required="required" class="form-control col-md-7 col-xs-12">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="Phone">
								Phone
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<input type="text" id="phone" name="phone" required="required" class="form-control col-md-7 col-xs-12">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="Country">
								Country
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<input type="text" id="country" name="country" required="required" class="form-control col-md-7 col-xs-12">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="Message">
								Message
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<input type="text" id="message" name="message" required="required" class="form-control col-md-7 col-xs-12">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="Report">
								Report
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<input type="text" id="report" name="report" required="required" class="form-control col-md-7 col-xs-12">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="Region">
								Region
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<input type="text" id="region" name="region" required="required" class="form-control col-md-7 col-xs-12">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="IP">
								IP
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<input type="text" id="ip" name="ip" required="required" class="form-control col-md-7 col-xs-12">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="Website">
								Website
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<input type="text" id="website" name="website" required="required" class="form-control col-md-7 col-xs-12">
							</div>
						</div> 
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="Source">
								Source
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<input type="text" id="source" name="source" required="required" class="form-control col-md-7 col-xs-12">
							</div>
						</div>
					<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<a href="<?php echo base_url().'addLead' ?>"><button class="btn btn-primary" type="button">Cancel</button></a>
								<button class="btn btn-primary" type="reset">Reset</button>
								<button type="submit" id="submit" class="btn btn-success">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
	</div>
<?php $this->load->view('templates/footer') ?>