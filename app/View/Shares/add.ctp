<div class="shares form">
<?php echo $this->Form->create('Share', array('class'=>'form', 'inputDefaults' => array('div' => array('class'=>'form-group')))); ?>
	<fieldset>
		<legend><?php echo __('Add Share'); ?></legend>
	<?php
		echo $this->Form->input('user_id',array('class'=>'form-control'));
		echo $this->Form->input('url',array('class'=>'form-control'));
		echo $this->Form->input('provider_id',array('class'=>'form-control'));
		echo $this->Form->input('user_login_id',array('class'=>'form-control'));
	?>
	<div class="submit">
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>


<?php $this->start('actions'); ?>
<li><?php echo $this->Html->link(__('List Shares'), array('action' => 'index')); ?></li>
<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
<li><?php echo $this->Html->link(__('List Providers'), array('controller' => 'providers', 'action' => 'index')); ?> </li>
<li><?php echo $this->Html->link(__('New Provider'), array('controller' => 'providers', 'action' => 'add')); ?> </li>
<li><?php echo $this->Html->link(__('List User Logins'), array('controller' => 'user_logins', 'action' => 'index')); ?> </li>
<li><?php echo $this->Html->link(__('New User Login'), array('controller' => 'user_logins', 'action' => 'add')); ?> </li>
<?php $this->end('actions'); ?>