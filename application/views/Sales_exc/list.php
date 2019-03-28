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
					<?php if($this->session->flashdata('msg')): ?>
						<div class="alert alert-info">
							<strong>Info!</strong> <?php echo $this->session->flashdata('msg') ?>
						</div>
					<?php endif ?>
					<!-- <?php print_r($Records['followup_date']); ?> -->

					<table id="example2" class="table table-bordered table-striped">
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
						<tbody>
							<?php if ($Records): ?>
								<?php foreach ($Records as $Record): ?>
									<tr>
										<td><?php echo $Record['id'] ?></td>
										<td><?php echo $Record['name'] ?></td>
										<td><?php echo $Record['country'] ?></td>
										<td><?php echo $Record['message'] ?></td>
										<td><?php echo $Record['report'] ?></td>
										<td><?php echo $Record['website'] ?></td>
										<td><?php echo date('d M Y h:i a', strtotime($Record['created_at'])) ?></td>
										<td><?php 
												if ($Record['status'] == 0)
												{
													echo "Pending";
												}
												elseif($Record['status'] == 1)
												{
													echo "Rescheduled";
												}
												elseif($Record['status'] == 2)
												{
													echo "Closed";
												}
												elseif($Record['status'] == 3)
												{
													echo "Reopened";
												}
											?>
										</td>
										<td class="text-center">
											<a class="details" href="javascript:void(0);" data-status="<?php echo($Record['status']) ?>" data-id="<?php echo($Record['id']) ?>" data-toggle="tooltip" data-placement="bottom" title="View"> <i class="fa fa-eye"></i></a>&nbsp&nbsp
											<?php if ($Record['status']!=2): ?>
												<a class="edit" href="javascript:void(0);" data-id="<?php echo($Record['id']) ?>" data-toggle="tooltip" data-placement="top" title="Edit">
													<i class="fa fa-edit"></i>
												</a>
											<?php endif ?>
											<!-- <?php if ($pagetitle=='Current Leads'): ?>
												<a  href="<?php echo base_url().'sales_exc/followupDetails/'.($Record['id']) ?>" title="Details">
													<i class="fa fa-info-circle"></i>
												</a>
											<?php endif ?> -->
										</td>
									</tr>
								<?php endforeach ?>
							<?php else: ?>
								<tr>
									<td class="text-center" colspan="7"><b>No Records Found</b></td>
								</tr>
							<?php endif ?>
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>
<?php $this->load->view('templates/footer') ?>