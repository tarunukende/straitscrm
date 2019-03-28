<?php $this->load->view('templates/header') ?>
<?php $this->load->view('Sales_exc/templates/sidemenu') ?>
	<div class="content-wrapper">
		<section class="content">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Lead Details</h3>
				</div>
				<div class="box-body">
					<!-- <?php print_r($Record) ?> -->
					<div class="row">
						<div class="col-md-4 clo-sm-12" >
							<label>Name</label><br>
							<label><?php echo $Record['name'] ?></label>
						</div>
						<div class="col-md-4 clo-sm-12" >
							<label>Email</label><br>
							<label><?php echo $Record['mail'] ?></label>
						</div>
						<div class="col-md-4 clo-sm-12" >
							<label>Job Title</label><br>
							<label><?php echo $Record['job_title'] ?></label>
						</div>
					</div>
					<div class="row" style="margin-top: 10px">
						<div class="col-md-4 clo-sm-12" >
							<label>Company</label><br>
							<label><?php echo $Record['company'] ?></label>
						</div>
						<div class="col-md-4 clo-sm-12" >
							<label>Phone</label><br>
							<label><?php echo $Record['phone'] ?></label>
						</div>
						<div class="col-md-4 clo-sm-12" >
							<label>Country</label><br>
							<label><?php echo $Record['country'] ?></label>
						</div>
					</div>
					<div class="row" style="margin-top: 10px">
						<div class="col-md-4 clo-sm-12" >
							<label>Report</label><br>
							<label><?php echo $Record['report'] ?></label>
						</div>
						<div class="col-md-4 clo-sm-12" >
							<label>Region</label><br>
							<label><?php echo $Record['region'] ?></label>
						</div>
						<div class="col-md-4 clo-sm-12" >
							<label>Ip</label><br>
							<label><?php echo $Record['ip'] ?></label>
						</div>
					</div>
					<div class="row" style="margin-top: 10px">
						<div class="col-md-12 clo-sm-12" >
							<label>Message</label><br>
							<label><?php echo $Record['message'] ?></label>
						</div>
					</div>
				</div>
			</div>
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title"><?php echo $pagetitle ?></h3>
				</div>
				<div class="box-body">
					<form class="form-horizontal form-label-left" id="demo-form2" data-parsley-validate method="post"  enctype="multipart/form-data">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">
								Category
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<select class="form-control col-md-7 col-xs-12" id="category_id" name="category_id" required="required">
									<option value="">Select Option</option>
									<?php if ($categories): ?>
										<?php foreach ($categories as $category): ?>
											<option value="<?php echo($category['id']) ?>">
												<?php echo $category['name']; ?>
											</option>
										<?php endforeach ?>
									<?php endif ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="comment">
								Comment
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<textarea id="comment" name="comment" class="form-control col-md-7 col-xs-12" required="required" cols="3"></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="called">
								Called?
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<select class="form-control col-md-7 col-xs-12" id="called" name="called" required="required">
									<option value="">Select Option</option>
									<option value="0">No</option>
									<option value="1">Yes</option>
									<option value="2">Not reachable</option>
								</select>
							</div>
						</div>

						<div class="form-group" id="file_upload" hidden="true">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="recording_file">
								Recording File
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<div class="btn btn-default btn-file">
									<i class="fa fa-paperclip"></i> Attachment
									<input type="file" id="recording_file" name="recording_file">
								</div>
								<p class="help-block">Max. 32MB</p>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="sample_shared">
								Sample Shared
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<select class="form-control col-md-7 col-xs-12" id="sample_shared" name="sample_shared" required="required">
									<option value="">Select Option</option>
									<option value="0">No</option>
									<option value="1">Yes</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="publisher_id">
								Publisher
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<select class="form-control col-md-7 col-xs-12" id="publisher_id" name="publisher_id" required="required">
									<option value="">Select Option</option>
									<?php if ($Publishers): ?>
										<?php foreach ($Publishers as $Publisher): ?>
											<option value="<?php echo($Publisher['id']) ?>">
												<?php echo $Publisher['name']; ?>
											</option>
										<?php endforeach ?>
									<?php endif ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="sales_status_id">
								Sales Status
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<select class="form-control col-md-7 col-xs-12" id="sales_status_id" name="sales_status_id" required="required">
									<option value="">Select Option</option>
									<?php if ($sales_status): ?>
										<?php foreach ($sales_status as $sales): ?>
											<option value="<?php echo($sales['id']) ?>">
												<?php echo $sales['name']; ?>
											</option>
										<?php endforeach ?>
									<?php endif ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="followup">
								Followup Needed?
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<select class="form-control col-md-7 col-xs-12" id="followup" name="followup" required="required">
									<option value="">Select Option</option>
									<option value="0">No</option>
									<option value="1">Yes</option>
								</select>
							</div>
						</div>
						<div id="follow" hidden="true">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="followup_no">
									Followup Number
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
									<input id="followup_no" class="form-control col-md-7 col-xs-12" type="text" name="followup_no">
								</div>
							</div>
							<!-- Date -->
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="followup_no">
									Followup Date
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
									  	</div>
										<input type="text" class="form-control pull-right" id="datepicker" name="followup_date">
									</div>
								</div>	
							</div>
						</div>

						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<a href="<?php echo base_url().'sales_exc/list' ?>"><button class="btn btn-primary" type="button">Cancel</button></a>
								<button class="btn btn-primary" type="reset">Reset</button>
								<button type="submit" id="submit" class="btn btn-success">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
	</div>
	<script type="text/javascript">
		$(function() {
			$('#called').change(function(){
				if ($(this).val() ==1)
				{
					// $('.colors').hide();
					$('#file_upload').show();
				}
				else
				{
					$('#file_upload').hide();
				}
			});

			$('#followup').change(function(){
				if ($(this).val() ==1)
				{
					// $('.colors').hide();
					$('#follow').show();
				}
				else
				{
					$('#follow').hide();
				}
			});
		});
	</script>
<?php $this->load->view('templates/footer') ?>