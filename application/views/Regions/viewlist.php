<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/sidemenu') ?>
	<div class="content-wrapper">
		<section class="content">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title"><?php echo $pagetitle ?></h3>
					<div class="pull-right">
						<a class="btn btn-primary" href="<?php echo base_url().'regions/add' ?>"> <i class="fa fa-plus"></i> Add</a>
					</div>
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
										<td><?php echo ($Record['status']) ? 'Enabled' : 'Disabled' ; ?></td>
										<td class="text-center">
											<a href="<?php echo base_url()."regions/edit/".$Record['id'] ?>" data-toggle="tooltip" data-placement="top" title="Edit">
												<i class="fa fa-edit"></i>
											</a>&nbsp&nbsp
											<a class="delete" href="javascript:void(0);" data-id="<?php echo($Record['id']) ?>" data-toggle="tooltip" data-placement="bottom" title="Delete"> <i class="fa fa-trash"></i></a>&nbsp&nbsp
											<?php if ($Record['status']): ?>
												<a class="disable" href="javascript:void(0);" data-id="<?php echo($Record['id']) ?>" data-toggle="tooltip" data-placement="top" title="Disable"> <i class="fa fa-close"></i></a>
											<?php else: ?>
												<a class="enable" href="javascript:void(0);" data-id="<?php echo($Record['id']) ?>" data-toggle="tooltip" data-placement="top" title="Enable"> <i class="fa fa-check"></i></a>
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
	<script type="text/javascript">
		$(document).ready(function()
		{
			var url="<?php echo base_url();?>";
			$('.delete').click(function()
			{
				var id = $(this).attr('data-id');
				// alert(id);
				if (confirm("Do you want to delete this Record?")==true)
					window.location = url+"regions/delete/"+id;
				else
					return false;
			})

			$('.enable').click(function()
			{
				var id = $(this).attr('data-id');
				// alert(id);
				if (confirm("Do you want to enable this Record?")==true)
					window.location = url+"regions/enable/"+id;
				else
					return false;
			})

			$('.disable').click(function()
			{
				var id = $(this).attr('data-id');
				// alert(id);
				if (confirm("Do you want to disable this Record?")==true)
					window.location = url+"regions/disable/"+id;
				else
					return false;
			})
		});
	</script>
<?php $this->load->view('templates/footer') ?>