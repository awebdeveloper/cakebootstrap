<div id="contentcolumn">
    <div class="MainHead">
      	<h2>Site Statistics</h2>
    </div> 
    <div class="users stats">
	 	<div class="users stats clearfix sites-states-block">
		    <div>
		        <div class="overflow-block">
					<table class="table table-striped table-bordered">
						<tr>
							<th colspan=''>&nbsp;</th>
							<?php foreach($periods as $key => $period){ ?>
							<th>
								<?php echo $period['display']; ?>
							</th>
							<?php } ?>
						</tr>
						<?php 
						foreach($models as $unique_model){ ?>
							<?php foreach($unique_model as $model => $fields){
								$aliasName = isset($fields['alias']) ? $fields['alias'] : $model;
							?>
								
									<?php $element = isset($fields['colspan']) ? 'rowspan ="'.$fields['colspan'].'"' : ''; ?>						
									<?php if(!isset($fields['isSub'])) :?>
										<tr>
										<td class="sub-title" <?php echo $element;?>>
											<?php echo $fields['display']; ?>
										</td>
									<?php endif;?>
									<?php if(isset($fields['isSub'])) :	?>
										<td >
											<?php echo $fields['display']; ?>
										</td>
									<?php endif; ?>		
									<?php if(!isset($fields['colspan'])) :?>
										<?php foreach($periods as $key => $period){ ?>
												<td>
													<span class="<?php echo (!empty($fields['class']))? $fields['class'] : ''; ?>">
														<?php											
															
															if (!empty($fields['link'])):
																$fields['link']['stat'] = $key;
																echo $this->Html->link((${$aliasName.$key}), $fields['link'], array('escape' => false, 'title' => ('Click to View Details')));
															else:
																echo (${$aliasName.$key});
															endif;											
														?>
													</span>
												</td>
										<?php } ?>
										</tr>
									<?php endif; ?>		
								
							 <?php } ?>
						<?php } ?>

						
					</table>
		        </div>
		    </div>
	    </div>
	</div>
</div>

<script>
<?php $this->Html->scriptStart(array('inline' => false)); ?>

	$(function() {
		//$( "#dialog" ).dialog();
	});

<?php $this->Html->scriptEnd(); ?>
</script>
