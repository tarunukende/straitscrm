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
					<table id="example2" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Id</th>
								<th>Name</th>
								<th>Reports</th>
								<th>Country</th>
								<th>Date</th>
								<th>Follow Up</th>
								<th>Comment</th>
								<th>Sample Share</th>
								<th>Publisher</th>
								<th>Called</th>

							</tr>
						</thead>
						<tbody>
							<?php if ($Records): ?>
								<?php foreach ($Records as $Record): ?>
									<tr>
										<td><?php echo $Record['lead_id'] ?></td>
										<td><?php echo $Record['name'] ?></td>
										<td><?php echo $Record['report'] ?></td>
										<td><?php echo $Record['country'] ?></td>
										<td><?php echo date('d M Y h:i a', strtotime($Record['created_at'])) ?></td>
										<td><?php echo $Record['followup_date'] ?></td>
										<td><?php echo $Record['comment'] ?></td>
										<td>
											<?php if ($Record['sample_shared']): ?>
												<?php echo('Yes') ?>
												<?php else: ?>
													<?php echo('No') ?>
											<?php endif ?>		
										</td>
										<td>
											<?php echo $this->data_model->getById('publisher', $Record['publisher_id'])['name']; ?> 
										</td>
										<td>
											<?php if ($Record['called']==2): ?>
												<?php echo('Not Reachable') ?>
											<?php endif ?>
											<?php if ($Record['called']==1): ?>
												<?php echo('Yes') ?>
											<?php endif ?>
											<?php if ($Record['called']==0): ?>
												<?php echo('No') ?>
											<?php endif ?>
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