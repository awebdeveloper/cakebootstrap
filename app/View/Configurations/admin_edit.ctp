<div class="configurations form">
<?php echo $this->Form->create('Configuration');?>
	<fieldset>
		<legend><?php echo __('Configuration'); ?></legend>
		<?php
			echo $this->Form->input('id');
		?>		
		<?php
			$i = -1;
			$lable = ucwords(strtolower($this->request->data['Configuration']['name']));
			$type  = $this->request->data['Configuration']['type'];
				
			switch($type)
			{
				case 'email'	:   
				case 'url'		:   
				case 'date'		:   
				case 'tel'		:   
				case 'date'		:   
				case 'text' 	:  	if(count($this->request->data['Configuration']['allowedvalues']) > 0 && is_array($this->request->data['Configuration']['allowedvalues']))
									{
										echo $this->Form->input('value',array('options'	=>	$this->request->data['Configuration']['allowedvalues'],
																			  'label'	=> 	$lable));
									}
									else
									{
										echo $this->Form->input('value',array('label'	=> 	$lable));
									}
									break;
									
				case 'boolean'	:	echo $this->Form->input('value',array('type'	=> 'radio',
																		  'legend'	=> $lable,
																		  'options'	=> array('Disable','Enable')));
									break;
					
				case 'emaillist'	:   
				case 'urllist'		:   
				case 'datelist'		:   
				case 'tellist'		:   
				case 'datelist'		:   
				case 'textlist' 	:	$type = str_replace('list', '', $type);
										
										echo '<div class="input '.$type.' required addnew" id="ConfigurationValues"><label>'.$lable.'</label>';
											if(is_array($this->request->data['Configuration']['value']))
											{
												foreach($this->request->data['Configuration']['value'] as $i => $value)
												{
													echo $this->Form->text('value',array('value'	=>$value,
																						 'id'		=> false,
																						 'type'		=> $type,
																						 'class'	=> 'repeatefield',
																						 'name'		=>'data[Configuration][value][]'));
												}
											}
											if($i==-1)
											{
												echo $this->Form->text('Configuration.value',array('name'	=>'data[Configuration][value][]',
																									'type'	=> $type,
																								   'class'	=> 'repeatefield'));
											}
											echo '<div class="actions" style="padding-left:0px;" ><a onclick="return false;" href="#" class="AddNew">Add</a></div>
										</div>';
										break;
			}
		?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>

<script type="text/javascript">
	<?php $this->Html->scriptStart(array('inline' => false)); ?>
	<?php $this->Html->scriptEnd();?>
</script>
