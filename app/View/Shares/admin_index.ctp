<div class="shares index">
	<div class="page-header">
		<h1>
			<?php echo Inflector::humanize($title); ?>
			<div class="pull-right">
				<?php 
					echo $this->Html->link('Counts', 
							array('controller'=>'Shares','action'=>'stats',
									'admin'=> true,'?' => array($condition => @$_GET[$condition])),
							array('class'=>'btn btn-warning'));
				?>
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
		    Share
		</li>
	</ul>
	<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
	<tr>
		<th><?php echo $this->Paginator->sort('user_id', 'User @ login'); ?></th>
		<th><?php echo $this->Paginator->sort('provider_id'); ?></th>
		<th><?php echo $this->Paginator->sort('posted'); ?></th>
	</tr>
	<?php	foreach ($shares as $share): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($share['User']['username'], array('controller' => 'Shares', 'action' => 'index',
											'admin'		 => true,'?' => array('user' => $share['User']['id']))); ?>  @
			<?php echo $this->Html->link($share['UserLogin']['user_id'], array('controller' => 'user_logins', 'action' => 'view', $share['UserLogin']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($share['Provider']['name'], array('controller' => 'Shares', 'action' => 'index',
											'admin'		 => true,'?' => array('provider' => $share['Provider']['id']))); ?>
		</td>
		<td title="<?php echo h($share['Share']['created']); ?>">
			<?php echo h(substr($share['Share']['created'],0,10)); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</table>
	<p>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
		));
		?>
	</p>

	<div class="pagination pagination-centered">
		<ul>
			<?php echo $this->Paginator->numbers(array('separator'=>'','currentClass'=>'active','tag'=>'li')); ?>
		</ul>
	</div>
</div>
