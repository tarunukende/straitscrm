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
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
								<span id="email-valid" class="hidden mob">
									<i class="fa fa-check pwd-valid"></i>Valid Email ID
								</span>  
								<span id="email-invalid" class="hidden mob-helpers">
									<i class="fa fa-times email-invalid"></i>Invalid Email ID
								</span>
							</div>
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="Email">
								Email
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<input id="Email" class="form-control col-md-7 col-xs-12" type="email" name="email" required="required">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
								<span id="mobile-valid" class="hidden mob">
									<i class="fa fa-check pwd-valid"></i>Valid Mobile No
								</span>  
								<span id="folio-invalid" class="hidden mob-helpers">
									<i class="fa fa-times mobile-invalid"></i>Invalid mobile No
								</span>
							</div>
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="Mobile_number">
								Mobile
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<input id="Mobile_number" class="form-control col-md-7 col-xs-12" type="text" name="mobile_number" required="required" maxlength="10">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="Client_Id">
								Region
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<select class="form-control col-md-7 col-xs-12" id="Client_Id" name="region_id[]" required="required" multiple>
									<option value="0">Select Region</option>
									<?php foreach ($Regions as $Region): ?>
										<option value="<?php echo $Region['id'] ?>">
											<?php echo $Region['name'] ?>
										</option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="Client_Id">
								Status
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<select class="form-control col-md-7 col-xs-12" id="Client_Id" name="status" required="required">
									<option value="1">Enabled</option>
									<option value="0">Disabled</option>
								</select>
							</div>
						</div>
						

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="Password">
								Password
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<input id="Password" class="form-control col-md-7 col-xs-12" type="text" name="password" required="required">
							</div>
	  					</div>

						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<a href="<?php echo base_url().'sales' ?>"><button class="btn btn-primary" type="button">Cancel</button></a>
								<button class="btn btn-primary" type="reset">Reset</button>
								<button type="submit" id="submit" class="btn btn-success" disabled="true">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
	</div>
<?php $this->load->view('templates/footer') ?>