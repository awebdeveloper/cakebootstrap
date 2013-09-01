<div class="providers view">
<h2><?php echo __('Provider'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Provider'), array('action' => 'edit', $provider['Provider']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Provider'), array('action' => 'delete', $provider['Provider']['id']), null, __('Are you sure you want to delete # %s?', $provider['Provider']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Providers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Provider'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shares'), array('controller' => 'shares', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Share'), array('controller' => 'shares', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Social Details'), array('controller' => 'social_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Social Detail'), array('controller' => 'social_details', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Shares'); ?></h3>
	<?php if (!empty($provider['Share'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Url'); ?></th>
		<th><?php echo __('Provider Id'); ?></th>
		<th><?php echo __('User Login Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($provider['Share'] as $share): ?>
		<tr>
			<td><?php echo $share['id']; ?></td>
			<td><?php echo $share['user_id']; ?></td>
			<td><?php echo $share['url']; ?></td>
			<td><?php echo $share['provider_id']; ?></td>
			<td><?php echo $share['user_login_id']; ?></td>
			<td><?php echo $share['created']; ?></td>
			<td><?php echo $share['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'shares', 'action' => 'view', $share['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'shares', 'action' => 'edit', $share['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'shares', 'action' => 'delete', $share['id']), null, __('Are you sure you want to delete # %s?', $share['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Share'), array('controller' => 'shares', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Social Details'); ?></h3>
	<?php if (!empty($provider['SocialDetail'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Identifier'); ?></th>
		<th><?php echo __('Provider Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($provider['SocialDetail'] as $socialDetail): ?>
		<tr>
			<td><?php echo $socialDetail['id']; ?></td>
			<td><?php echo $socialDetail['user_id']; ?></td>
			<td><?php echo $socialDetail['identifier']; ?></td>
			<td><?php echo $socialDetail['provider_id']; ?></td>
			<td><?php echo $socialDetail['created']; ?></td>
			<td><?php echo $socialDetail['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'social_details', 'action' => 'view', $socialDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'social_details', 'action' => 'edit', $socialDetail['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'social_details', 'action' => 'delete', $socialDetail['id']), null, __('Are you sure you want to delete # %s?', $socialDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Social Detail'), array('controller' => 'social_details', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
