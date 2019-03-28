<?php $this->load->view('templates/header') ?>
<?php $this->load->view('Marketing_team/templates/sidemenu') ?>
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
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Id</th>
								<th>Company</th>
								<th>Country</th>
								<th>Report</th>
								<th>Source</th>
								<th>Category</th>
								<th>Website</th>
								<th>Publisher</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($Records): ?>
								<?php $i=0; ?>
								<?php foreach ($Records as $Record): ?>
									<?php $i++; ?>
									<tr>
										<td><?php echo $i ?></td>
										<td><?php echo $Record['company'] ?></td>
										<td><?php echo $Record['country'] ?></td>
										<td><?php echo $Record['report'] ?></td>
										<td><?php echo $Record['source'] ?></td>
										<td><?php echo $this->data_model->getById('category', $Record['category_id'])['name']; ?></td>
										<td><?php echo $Record['website'] ?></td>
										<td><?php echo $this->data_model->getById('publisher', $Record['publisher_id'])['name']; ?></td>
									</tr>
								<?php endforeach ?>
							<?php else: ?>
								<tr>
									<td class="text-center" colspan="8"><b>No Records Found</b></td>
								</tr>
							<?php endif ?>
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>
<?php $this->load->view('templates/footer') ?>