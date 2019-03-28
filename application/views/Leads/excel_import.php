<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/sidemenu') ?>
	<div class="content-wrapper">
		<section class="content">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<div class="col-md-6">
						<h3 class="box-title"><?php echo $pagetitle ?></h3>
					</div>
					<div class="col-md-6 text-right">
						<a href="<?php echo(base_url().'downloads/LeadsSample.xlsx'); ?>" class="btn btn-primary">Download Sample File</a>
					</div>
				</div>
				<div class="box-body">
					<div class="x_panel">
		  				<div class="x_content">
		  					<?php if($this->session->flashdata('msg')): ?>
								<div class="alert alert-info">
									<strong>Success!</strong> <?php echo $this->session->flashdata('msg') ?>
								</div>
							<?php endif ?>
							<br />
							<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<p class="col-md-12 text-center"><strong> You can Download the Sample excel file and upload it back by filling your data in it </strong></p>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="excelFile">
										Upload Excel File
									</label>
									<input type="hidden" name="test" value="test">
									<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
										<input type="file" id="excelFile" name="excelFile" required="required" class="form-control col-md-7 col-xs-12">
									</div>
			  					</div>
			  					<div class="ln_solid"></div>
								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
										<button class="btn btn-primary" onclick="goBack()" type="button">Cancel</button>
										<button type="submit" class="btn btn-success">Submit</button>
									</div>
								</div>
							</form>
		  				</div>
					</div>
				</div>
			</div>
		</section>
	</div>
<?php $this->load->view('templates/footer') ?>