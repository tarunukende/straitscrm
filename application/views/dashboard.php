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
					<form id="form-filter" class="form-horizontal">
                    <div class="form-group">
                        <label for="country" class="col-sm-2 control-label">Website</label>
                        <div class="col-sm-4">
                           <select class="form-control">
                           	<option>Select Website</option>
                           	<option value="reportsmonitor.com">RM</option>
                           	<option value="garnerinsights.com">GI</option>
                           	<option value="market research vision">MRV</option>
                           </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="FirstName" class="col-sm-2 control-label"> Date From</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="FirstName">
                        </div>
                    
                        <label for="LastName" class="col-sm-2 control-label">Date To </label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="LastName">
                        </div>
                    </div>
                    <div class="form-group">
                            <center><button type="button" id="btn-filter" class="btn btn-primary">Filter</button></center>
                    </div>
                </form>
				</div>
			</div>
		</section>
	</div>
<?php $this->load->view('templates/footer') ?>