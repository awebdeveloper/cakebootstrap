<div class="configurations form">
<?php echo $this->Form->create('Configuration');?>
	<fieldset>
		<legend><?php echo __('Admin Add Configuration'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('code');
		echo $this->Form->input('value');
		echo $this->Form->input('type',array('options'=>array('text','string','enum')));
		echo $this->Form->input('allowedvalues');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Configurations'), array('action' => 'index'));?></li>
	</ul>
</div>
