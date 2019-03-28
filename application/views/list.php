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
					<?php if($this->session->flashdata('msg')): ?>
						<div class="alert alert-info">
							<strong>Info!</strong> <?php echo $this->session->flashdata('msg') ?>
						</div>
					<?php endif ?>
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Id</th>
								<th>Name</th>
								<th>Email</th>
								<th>Report</th>
								<th>Region</th>
								<th>Date</th>
								<th>Website</th>
								<th>Sales Excutive</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($Records): ?>
								<!-- <?php print_r($Records) ?> -->
								<?php foreach ($Records as $Record): ?>
									<tr>
										<td><?php echo $Record['id'] ?></td>
										<td><?php echo $Record['name'] ?></td>
										<td><?php echo $Record['mail'] ?></td>
										<td><?php echo $Record['report'] ?></td>
										<td><?php echo $this->data_model->getSimilarData(array('field' => 'name', 'value' => $Record['region']), 'regions')[0]['name'] ?></td>
										<td><?php echo date('d M Y h:i a', strtotime($Record['created_at'])) ?></td>
										<td><?php echo $Record['website'] ?></td>
										<?php
											if ($this->data_model->getByCondition(array('field' => 'lead_id', 'value'=> $Record['id']), 'lead_details'))
											{?>
												<td><?php echo $this->data_model->getById('sales', $Record['sales_id'])['name'] ?></td>
												<td class="text-center">
													<a class="view" href="javascript:void(0);" data-id="<?php echo($Record["id"]) ?>" data-toggle="tooltip" data-placement="bottom" title="View">
														<i class="fa fa-eye"></i>
													</a>
												</td>
										<?php
											}
											else
											{
												$AllExc = $this->data_model->getAll('sales');
											?>
												<td>
													<select data-id="<?php echo $Record['sid'] ?>" class="target form-control">
														<?php 
														foreach ($AllExc as $Exc)
														{?>
															<option value="<?php echo $Exc['id']?>" <?php if($Exc['id']== $Record['sales_id']) echo "selected"; ?>><?php echo $Exc['name']?></option>
														<?php }
														 ?>
													</select>
												</td>
												<td></td>
										<?php }
										?>
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
	<div id="myModal1" class="modal fade" role="dialog">
	</div>
	<script type="text/javascript">
		$(document).ready(function()
		{
			var base = "<?php echo base_url();?>";
			$('.view').click(function()
			{
				var id = $(this).attr('data-id');
				$.ajax
				({ 
					url: base+"user/details/"+id,
					// data: {"bookID": book_id},
					type: 'get',
					success: function(result)
					{
						// alert(result);
						$("#myModal1").html(result);
						$('#myModal1').modal('show');
					}
				});
			})
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function()
		{
			var base = "<?php echo base_url();?>";
			$( ".target" ).change(function() {
				var id = $(this).attr('data-id');
				var sales_id = $(this).val();
				$.ajax
				({ 
					url: base+"user/chngExc/"+sales_id+"/"+id,
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