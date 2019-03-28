<?php if ($total != 0): ?>
	<div class="row mt-40">
		<div class="col-md-5 col-sm-5 col-xs-12 pagidesc pt-20">
			Showing <?=$start?> to <?=$end ?> out of <?=$total ?>
		</div>
		<?php if ($pages != 1): ?>
			<?php 
				if ($page_name == 'allleads')
				{
					$dest = 'allleads';
				}
			?>
			<div class="col-md-7 col-sm-7 col-xs-12">
				<ul class="pagination pagination-info pull">
					<?php if ($current != 1): ?>
						<li class="">
							<a href="<?=base_url().$dest.'/'.($current-1)?>">
								<span class="glyphicon glyphicon-triangle-left thm_clr_yl" ></span>
							</a>
						</li>
					<?php endif ?>
					<?php if ($current>5): ?>
						<li><a href="javascript:void(0);">...</a></li>
					<?php endif ?>
					<?php 
					if ($pages>3)
					{
						if ($current<3)
						{
							$start = 1;
							$end = $current +2;
						}
						elseif ($current == $pages && $pages >5)
						{
							$start = $current - 4;
							$end = $current;
						}
						elseif ($current == $pages && $pages <5)
						{
							$start = $current - 3;
							$end = $current;
						}
						elseif ($current >= $pages - 2)
						{
							$start = $current - 2;
							$end = $pages;
						}
						else
						{
							$start = $current - 2;
							$end = $current + 2;
						}
					}
					else
					{
						$start=1;
						$end = $pages;
					}
					for ($i=$start; $i <= $end; $i++) 
					{ ?> 
						<li <?php if($i==$current) echo 'class="active"' ?>>
							<a href="<?=base_url().$dest.'/'.$i?>">
							<b><?=$i?></b>
							</a>
						</li>	
					<?php } ?>
					<?php if ($current < $pages-2): ?>
						<li><a href="javascript:void(0);">...</a></li>
					<?php endif ?>
					<?php if ($current <= ($pages - 3)): ?>
						<li>
							<a href="<?=base_url().$dest.'/'.$pages?>"><?=$pages?></a>
						</li>
					<?php endif ?>
					<?php if ($current != $pages): ?>
						<li class="">
							<a href="<?=base_url().$dest.'/'.($current+1)?>">
								<span class="glyphicon glyphicon-triangle-right thm_clr_yl" ></span>
							</a>
						</li>
					<?php endif ?>
				</ul>
			</div>
		<?php endif ?>
	</div>
<?php endif ?>