<div class="configurations form">
	<div class="page-header">
		<h1>
			<?php echo __('Configurations'); ?>			
			<div class="pull-right">
				<a href="#" class="btn btn-inverse js-back"> Back </a>
	    	</div> 
		</h1>
  	</div>
  	<ul class="breadcrumb">
		<li>
		    <?php  echo $this -> Html -> link(__('Dashboard'), array(
					'controller' => 'users',
					'action' 	 => 'dashboard',
					'prefix' 	 => false
				), array('title' => 'Dashboard'));
			?>
		    <span class="divider">/</span>
		</li>
		<li> 
			<?php  echo $this -> Html -> link(__('Configuration'), array(
					'controller' => 'Configurations',
					'action' 	 => 'index'
				), array('title' => 'Configuration'));
			?>
		    <span class="divider">/</span>
		</li>
		<li>
		    Add 
		</li>
	</ul>
<?php echo $this->Form->create('Configuration',array(
											  	'class'=>'form-horizontal',
											  	'inputDefaults' => $inputDefaults
											)); ?>
	<fieldset>
		<div class="control-group">
			<label class="control-label">Name <span class="red">* </span></label>
					<?php echo $this->Form->input('name'); ?>
		</div>
		<div class="control-group">
			<label class="control-label">Code <span class="red">* </span></label>
					<?php echo $this->Form->input('code'); ?>
		</div>
		<div class="control-group">
			<label class="control-label">Value <span class="red">* </span></label>
					<?php echo $this->Form->input('value'); ?>
		</div>
		<div class="control-group">
			<label class="control-label">Type <span class="red">* </span></label>
					<?php echo $this->Form->input('type',array('options'=>$AllConfigurationTypes)); ?>
		</div>
		<div class="control-group addnew" id="Configurationallowedvalues">
			<label class="control-label">Allowedvalues <span class="red">* </span></label>
			<div class="controls">
				<?php
						$i = -1;
						if(isset($this->request->data['Configuration']['allowedvalues']) && 
							is_array($this->request->data['Configuration']['allowedvalues']))
						{
							foreach($this->request->data['Configuration']['allowedvalues'] as $i => $value)
							{
								echo $this->Form->text('allowedvalues',array('value'=>$value,
																			 'id'	=>false,
																			 'class'=> 'repeatefield',
																			 'name'	=>'data[Configuration][allowedvalues][]'));
							}
						}
						if($i ==-1)
						{
							echo $this->Form->text('Configuration.allowedvalues',array( 'class'	=> 'repeatefield',
																						'name'	=> 'data[Configuration][allowedvalues][]'));
						}
						echo '';
					
				?> <br />
				<p class="help-block actions">
					<a onclick="return false;" href="#" class="AddNew">Add More</a>
				</p>
			</div>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
	</fieldset>

<?php echo $this->Form->end(); ?>
</div>