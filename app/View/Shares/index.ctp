<div class="shares index">
	<h2><?php echo __('Shares'); ?></h2>
	<div class="table-responsive">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th><?php echo $this->Paginator->sort('id'); ?></th>
					<th><?php echo $this->Paginator->sort('user_id'); ?></th>
					<th><?php echo $this->Paginator->sort('url'); ?></th>
					<th><?php echo $this->Paginator->sort('provider_id'); ?></th>
					<th><?php echo $this->Paginator->sort('user_login_id'); ?></th>
					<th><?php echo $this->Paginator->sort('created'); ?></th>
					<th><?php echo $this->Paginator->sort('modified'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($shares as $share): ?>
				<tr>
					<td><?php echo h($share['Share']['id']); ?>&nbsp;</td>
				<td>
			<?php echo $this->Html->link($share['User']['id'], array('controller' => 'users', 'action' => 'view', $share['User']['id'])); ?>
		</td>
					<td><?php echo h($share['Share']['url']); ?>&nbsp;</td>
				<td>
			<?php echo $this->Html->link($share['Provider']['name'], array('controller' => 'providers', 'action' => 'view', $share['Provider']['id'])); ?>
		</td>
				<td>
			<?php echo $this->Html->link($share['UserLogin']['id'], array('controller' => 'user_logins', 'action' => 'view', $share['UserLogin']['id'])); ?>
		</td>
					<td><?php echo h($share['Share']['created']); ?>&nbsp;</td>
					<td><?php echo h($share['Share']['modified']); ?>&nbsp;</td>
					<td class="actions">
						<?php echo $this->Html->link(__('View'), array('action' => 'view', $share['Share']['id'])); ?>
						<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $share['Share']['id'])); ?>
						<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $share['Share']['id']), null, __('Are you sure you want to delete # %s?', $share['Share']['id'])); ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

	<p>
		<small><?php
		echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
		));
		?></small>
	</p>

	<ul class="pagination">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'),  array('tag' => 'li'), null, array('class' => 'prev disabled','disabledTag'=>'a'));
		echo $this->Paginator->numbers(array('separator' => '','tag' => 'li','currentTag'=>'a'));
		echo $this->Paginator->next(__('next') . ' >', array('tag' => 'li'), null, array('class' => 'next disabled','tag' => 'li'));
	?>
	</ul>
</div>


<?php $this->start('actions'); ?>
<li><?php echo $this->Html->link(__('New Share'), array('action' => 'add')); ?></li><li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
<li><?php echo $this->Html->link(__('List Providers'), array('controller' => 'providers', 'action' => 'index')); ?> </li>
<li><?php echo $this->Html->link(__('New Provider'), array('controller' => 'providers', 'action' => 'add')); ?> </li>
<li><?php echo $this->Html->link(__('List User Logins'), array('controller' => 'user_logins', 'action' => 'index')); ?> </li>
<li><?php echo $this->Html->link(__('New User Login'), array('controller' => 'user_logins', 'action' => 'add')); ?> </li>
<?php $this->end('actions'); ?>