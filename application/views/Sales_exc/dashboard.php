<?php $this->load->view('templates/header') ?>
<?php $this->load->view('Sales_exc/templates/sidemenu') ?>
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
                                <h3><?php echo $new; ?></h3>
                                <p>Active leads</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-tasks"></i>
                            </div>
                            <a href="<?php echo base_url() . 'sales_exc/viewlist' ?>" class="small-box-footer">
                                View all <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3><?php echo $current; ?></h3>
                                <p>Workable leads</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-tasks"></i>
                            </div>
                            <a href="<?php echo base_url() . 'sales_exc/currentList' ?>" class="small-box-footer">
                                View all <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3><?php echo $closed; ?></h3>
                                <p>Closed Leads</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-tasks"></i>
                            </div>
                            <a href="<?php echo base_url() . 'sales_exc/closedList' ?>" class="small-box-footer">
                                View all <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
    </section>

    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $pagesubtitle ?></h3>
            </div>
            <div class="box-body">
                <?php if ($this->session->flashdata('msg')): ?>
                    <div class="alert alert-info">
                        <strong>Info!</strong> <?php echo $this->session->flashdata('msg') ?>
                    </div>
                <?php endif ?>
                <!-- <?php print_r($Records['followup_date']); ?> -->
                <input type="hidden" name="status" id="status" class="status" value="<?php echo $status; ?>"/>
                <table id="leadsdata" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Country</th>
                            <th>Website</th>
                            <th>Message</th>
                            <th>Report</th>
                            <th>Sales Excutive</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('templates/footer') ?>
<script src="<?php echo base_url() . 'assets/' ?>js/salesexecuetiveHelper.js"></script>