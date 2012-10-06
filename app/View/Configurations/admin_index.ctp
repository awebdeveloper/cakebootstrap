<div class="configurations form">
	<?php echo $this->Form->create('Configuration');?>
	<fieldset>
		<legend><?php echo __('Configuration'); ?></legend>	
			
		<?php
			foreach ($configurations as $configuration): 
					
				$label = ucwords(strtolower($configuration['Configuration']['name']));
				$name  = 'Configuration.value.'.$configuration['Configuration']['code'];
				$value = $configuration['Configuration']['value'];
				$type  = $configuration['Configuration']['type'];
				
				switch($type)
				{ 
					case 'time'			:  echo $this->Form->input($name, array('label'		=> 	$label,
																				'type'		=>  $type,
																				'required'	=>  'required',
																				'timeFormat'=>  24,
																				'interval'	=>  2,
																				'selected'	=>  $value));
											break;
					
					  
					case 'date'			:   echo $this->Form->input($name,array('label'		=> 	$label,
																				'type'		=>  $type,
																				'required'	=>  'required',
																				'selected'	=>  $value));
											break;
					case 'email'		:   
					case 'url'			:
					case 'tel'			: 
					case 'text' 		:  	
					case 'other'		:	if(count($configuration['Configuration']['allowedvalues']) > 0 && is_array($configuration['Configuration']['allowedvalues']))
											{
												echo $this->Form->input($name,array('options'	=>	$configuration['Configuration']['allowedvalues'],
																					'value'		=>  $value,
																					'type'		=>  $type,
																					'required'	=>  'required',
																					'label'		=> 	$label));
											}
											else
											{
												if($type == 'date' )
												{
													
												}
												if($type == 'date' )
												{
													
												}
												else 
												{
													echo $this->Form->input($name,array('label'		=> 	$label,
																						'type'		=>  $type,
																						'required'	=>  'required',
																						'value'		=>  $value));
												}
											}
											break;
										
					case 'boolean'		:	echo $this->Form->input($name, array('type'		=> 'radio',
																				 'legend'	=> $label,
																				 'value'	=> $value,
																				 'required'	=>  'required',
																				 'options'	=> array('Disable','Enable')));
											break;
										
					case 'emaillist'	:   
					case 'urllist'		:   
					case 'datelist'		:   
					case 'tellist'		:   
					case 'datelist'		:
					case 'timelist'		: 
					case 'textlist' 	:	
					case 'enum'			:	?>
												<table cellpadding="0" cellspacing="0" class="ConfigEdit">
												<tr>
													<td class="title" width="100">
														<?php echo $configuration['Configuration']['name']; ?> 
													</td>
													<td >
														<?php echo str_replace('|||', ', ', $value);?>
													</td>
													<td class="actions" width="100" >
														<?php echo $this->Html->link(__('Edit '), array('action' => 'edit', $configuration['Configuration']['id'])) ?>
													</td>
												</tr>
												</table>
											<?php
											break;
				}
			endforeach; 
		?>
		
	</fieldset>
	<?php echo $this->Form->end(__('Submit'));?>
</div>