<?php $this->load->view('templates/header') ?>
<?php $this->load->view('sales_exc/templates/sidemenu') ?>
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
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="old_pwd">
								Old Password
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<input type="password" id="old_pwd" name="old_pwd" required="required" class="form-control col-md-7 col-xs-12">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="new_pwd">
								New Password
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<input type="password" id="new_pwd" name="new_pwd" required="required" class="form-control col-md-7 col-xs-12">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="con_pwd">
								Confirm Password
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
								<input type="password" id="con_pwd" name="new_pwd" required="required" class="form-control col-md-7 col-xs-12">
								<span id='message'></span>
							</div>
						</div>
						
						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<a href="<?php echo base_url().'sales_exc/dashboard' ?>">
									<button class="btn btn-primary" type="button">Cancel</button>
								</a>
								<button type="submit" id="submit" class="btn btn-success" disabled>Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
	</div>
	<script type="text/javascript">
		$(document).ready(function()
		{
			$('#new_pwd, #con_pwd').on('keyup', function () 
			{
				if ($('#new_pwd').val() === null || $('#new_pwd').val() === "", $('#con_pwd').val() === null || $('#con_pwd').val() === "")
				{
					$('#message').html('Not Matching').css('color', 'red');
					$("#submit").prop('disabled', true);
				}
				else
				{
					if ($('#new_pwd').val() == $('#con_pwd').val()) 
					{
						$('#message').html('Matching').css('color', 'green');
						$("#submit").prop('disabled', false);
					}
					else
					{
						$('#message').html('Not Matching').css('color', 'red');
						$("#submit").prop('disabled', true);
					}
				}
			});
		});
	</script>
<?php $this->load->view('templates/footer') ?>