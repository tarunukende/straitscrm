<?php $this->load->view('templates/header') ?>
<?php $this->load->view('Marketing_exc/templates/sidemenu') ?>
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
								<th>Acquired by</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($Records): ?>
								<?php $i=0; ?>
								<?php foreach ($Records as $Record): ?>
									<?php $i++; ?>
									<?php
										// print_r($Record);
										// echo "<br>";
									?>
									<tr>
										<td><?php echo $i ?></td>
										<td><?php echo $Record['company'] ?></td>
										<td><?php echo $Record['country'] ?></td>
										<td><?php echo $Record['report'] ?></td>
										<td><?php echo $Record['source'] ?></td>
										<td><?php echo $this->data_model->getById('category', $Record['category_id'])['name']; ?></td>
										<td><?php echo $Record['website'] ?></td>
										<td><?php echo $this->data_model->getById('publisher', $Record['publisher_id'])['name']; ?></td>
										<?php if (isset($Record['agent_id'])): ?>
											<?php if ($Record['agent_id']!=0): ?>
												<td><?php echo $this->data_model->getById('marketing_agent', $Record['agent_id'])['name']; ?></td>
											<?php elseif ($Record['agent_id'] == 0): ?>
												<td><?php echo $this->session->userdata('name'); ?></td>
											<?php endif ?>
										<?php else: ?>
											<td class="text-center">
												<select id="agent_id" data-id="<?php echo $Record['id'] ?>" class="form-control">
													<option value="">Select Member</option>
													<option data-id="Self" value="<?php echo $this->session->userdata('userid'); ?>">Self</option>
													<?php foreach ($Teams as $Team): ?>
														<option data-id="Agent" value="<?php echo $Team['id'] ?>"><?php echo $Team['name'] ?></option>
													<?php endforeach ?>
												</select>
											</td>
										<?php endif ?>
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
	<script type="text/javascript">
		$(document).ready(function()
		{
			var base = "<?php echo base_url();?>";
			$('#agent_id').change(function()
			{
				var leadid = $(this).attr('data-id');
				var id = $(this).val();
				var stat = $(this).find(':selected').data('id');
				// alert(base+"marketing_exc/edit/"+leadid+"/"+id+"/"+stat);
				console.log(base+"marketing_exc/edit/"+leadid+"/"+id+"/"+stat);
				$.ajax
				({ 
					url: base+"marketing_exc/edit/"+leadid+"/"+id+"/"+stat,
					// data: {"bookID": book_id},
					type: 'get',
					success: function(result)
					{
						console.log(result);
						location.reload();
					}
				});
			});
		});
	</script>
<?php $this->load->view('templates/footer') ?>