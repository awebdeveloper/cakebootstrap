<div class="providers form">
<?php echo $this->Form->create('Provider', array('class'=>'form', 'inputDefaults' => array('div' => array('class'=>'form-group')))); ?>
	<fieldset>
		<legend><?php echo __('Edit Provider'); ?></legend>
	<?php
		echo $this->Form->input('id',array('class'=>'form-control'));
		echo $this->Form->input('name',array('class'=>'form-control'));
		echo $this->Form->input('url',array('class'=>'form-control'));
	?>
	<div class="submit">
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>


<?php $this->start('actions'); ?>
<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Provider.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Provider.id'))); ?></li>
<li><?php echo $this->Html->link(__('List Providers'), array('action' => 'index')); ?></li>
<li><?php echo $this->Html->link(__('List Shares'), array('controller' => 'shares', 'action' => 'index')); ?> </li>
<li><?php echo $this->Html->link(__('New Share'), array('controller' => 'shares', 'action' => 'add')); ?> </li>
<li><?php echo $this->Html->link(__('List Social Details'), array('controller' => 'social_details', 'action' => 'index')); ?> </li>
<li><?php echo $this->Html->link(__('New Social Detail'), array('controller' => 'social_details', 'action' => 'add')); ?> </li>
<?php $this->end('actions'); ?>