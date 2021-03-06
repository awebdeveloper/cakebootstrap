<div class="providers index">
	<h2><?php echo __('Providers'); ?></h2>
	<div class="table-responsive">
  		<table class="table table-bordered table-striped">
  			<thead>
				<tr>
					<th><?php echo $this->Paginator->sort('id'); ?></th>
					<th><?php echo $this->Paginator->sort('name'); ?></th>
					<th><?php echo $this->Paginator->sort('url'); ?></th>
					<th><?php echo $this->Paginator->sort('created'); ?></th>
					<th><?php echo $this->Paginator->sort('modified'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($providers as $provider): ?>
				<tr>
					<td><?php echo h($provider['Provider']['id']); ?>&nbsp;</td>
					<td><?php echo h($provider['Provider']['name']); ?>&nbsp;</td>
					<td><?php echo h($provider['Provider']['url']); ?>&nbsp;</td>
					<td><?php echo h($provider['Provider']['created']); ?>&nbsp;</td>
					<td><?php echo h($provider['Provider']['modified']); ?>&nbsp;</td>
					<td class="actions">
						<?php echo $this->Html->link(__('View'), array('action' => 'view', $provider['Provider']['id'])); ?>
						<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $provider['Provider']['id'])); ?>
						<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $provider['Provider']['id']), null, __('Are you sure you want to delete # %s?', $provider['Provider']['id'])); ?>
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

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<?php $this->start('actions'); ?>
	<li><?php echo $this->Html->link(__('New Provider'), array('action' => 'add')); ?></li>
<?php $this->end('actions'); ?>
