<div class="shares view">
<h2><?php echo __('Share'); ?></h2>
	<dl class="dl-horizontal dl-horizontal-left">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($share['Share']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($share['User']['id'], array('controller' => 'users', 'action' => 'view', $share['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($share['Share']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Provider'); ?></dt>
		<dd>
			<?php echo $this->Html->link($share['Provider']['name'], array('controller' => 'providers', 'action' => 'view', $share['Provider']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Login'); ?></dt>
		<dd>
			<?php echo $this->Html->link($share['UserLogin']['id'], array('controller' => 'user_logins', 'action' => 'view', $share['UserLogin']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($share['Share']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($share['Share']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<?php $this->start('actions'); ?>		<li><?php echo $this->Html->link(__('Edit Share'), array('action' => 'edit', $share['Share']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Share'), array('action' => 'delete', $share['Share']['id']), null, __('Are you sure you want to delete # %s?', $share['Share']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Shares'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Share'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Providers'), array('controller' => 'providers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Provider'), array('controller' => 'providers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Logins'), array('controller' => 'user_logins', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Login'), array('controller' => 'user_logins', 'action' => 'add')); ?> </li>
<?php $this->end('actions'); ?>