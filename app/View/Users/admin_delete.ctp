<div class="categories form">
<?php echo $this->Form->create('Users');?>
<br />
<br />
	<fieldset>
		<legend><?php echo __("Please Enter your password to delete the $deletename"." ! ".$email); ?></legend>
		<legend><?php echo $this->Session->flash(); ?></legend>
	<?php
		
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>