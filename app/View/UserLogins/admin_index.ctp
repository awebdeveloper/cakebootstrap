<div class="userLogins index">
	<div class="page-header">
		<h1>
			<?php echo __('User Logins'); ?>
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
			<?php  echo $this -> Html -> link(__('User'), array(
					'controller' => 'Users',
					'action' 	 => 'index'
				), array('title' => 'Users'));
			?>
		    <span class="divider">/</span>
		</li>
		<li>
		    Logins
		</li>
	</ul>
	<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
	<tr>
			<th><?php echo $this->Paginator->sort('id','#'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('ip_address','IP'); ?></th>
			<th width="25%"><?php echo $this->Paginator->sort('user_agent'); ?></th>
			<th><?php echo $this->Paginator->sort('operating_system','OS'); ?></th>
			<th><?php echo $this->Paginator->sort('browser'); ?></th>
			<th><?php echo $this->Paginator->sort('city','Location'); ?></th>
			<th><?php echo $this->Paginator->sort('referer'); ?></th>
			<th><?php echo $this->Paginator->sort('provider'); ?></th>
			<th><?php echo $this->Paginator->sort('Time'); ?></th>
	</tr>
	<?php	foreach ($userLogins as $userLogin): ?>
	<tr>
		<td><?php echo h($userLogin['UserLogin']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($userLogin['User']['username'], array('controller' => 'users', 'action' => 'view', $userLogin['User']['id'])); ?>
		</td>
		<td><?php echo h($userLogin['UserLogin']['ip_address']); ?>&nbsp;</td>

		<td title="<?php echo h($userLogin['UserLogin']['user_agent']); ?>" >
				...<?php echo h(substr($userLogin['UserLogin']['user_agent'],-50,30)); ?>
		</td>
		<td><?php echo h($userLogin['UserLogin']['operating_system']); ?>&nbsp;</td>
		<td><?php echo h($userLogin['UserLogin']['browser']); ?>&nbsp;</td>
		<td>
			<?php echo h($userLogin['UserLogin']['city']); ?>,<br />
			<?php echo h($userLogin['UserLogin']['country']); ?>
		</td>
		<td title="<?php echo h($userLogin['UserLogin']['referer']); ?>">
				<?php echo h(substr($userLogin['UserLogin']['referer'],0,20)); ?>...
		</td>
		<td><?php echo h(Inflector::humanize($userLogin['UserLogin']['provider'])); ?>&nbsp;</td>
		<td><?php echo h($userLogin['UserLogin']['created']); ?></td>
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
