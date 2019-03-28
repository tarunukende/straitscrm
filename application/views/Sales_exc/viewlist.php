<?php $this->load->view('templates/header') ?>
<?php $this->load->view('Sales_exc/templates/sidemenu') ?>
<div class="content-wrapper">
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $pagetitle ?></h3>
            </div>
            <div class="box-body">
                <?php if ($this->session->flashdata('msg')): ?>
                    <div class="alert alert-info">
                        <strong>Info!</strong> <?php echo $this->session->flashdata('msg') ?>
                    </div>
                <?php endif ?>
                <!-- <?php print_r($Records['followup_date']); ?> -->
                <input type="text" name="status" id="status" class="status" value="<?php echo $status; ?>"/>
                <table id="posts" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Country</th>
                            <th>Message</th>
                            <th>Report</th>
                            <th>Website</th>
                            <th>Date</th>
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