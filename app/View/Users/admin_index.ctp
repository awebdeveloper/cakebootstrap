<div class="users index">
		<div class="page-header">
		<h1>
			<?php echo __('Users');?>
			<div class="pull-right">
			</div> 
		</h1>
  	</div>
  	<ul class="breadcrumb">
		<li>
			<?php  echo $this -> Html -> link(__('Dashboard'), array(
					'controller' => 'users',
					'action' => 'dashboard'
				), array('title' => 'Dashboard'));
			?>
			<span class="divider">/</span>
		</li>
		<li>
			<?php  echo $this -> Html -> link(__('Manage Users'), array(
					'action' => 'index'
				), array('title' => 'Manage Users'));
			?>
			<span class="divider">/</span>
		</li>
		
	</ul>	
	<div class="clearfix">
		<form  class="form-inline" type="get">
			<input type="text" placeholder="Name or Email">
			<select class="input-small">
				<option>Status</option>
				<option>Active</option>
				<option>Inactive</option>
			</select>
			<select class="input-small">
				<option>Type</option>
				<option>Admin</option>
				<option>Support</option>
			</select>
			<input type="text" class="input-small ui-dateinput" placeholder="Joined on">
			<input type="submit" value="Search" class="btn"> 
		</form>
	</div>

	<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
	<tr>
			<th><?php echo $this->Paginator->sort('id','#');?></th>
			<th><?php echo $this->Paginator->sort('username');?></th>
			<th><?php echo $this->Paginator->sort('user_type_id');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('created','Joined');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($user['UserType']['name'], '#'); ?>
		</td>
		<td><?php echo str_replace('@', '<wbr>@', h($user['User']['email'])); ?>&nbsp;</td>
		<td><?php echo h($user['User']['status']); ?>&nbsp;</td>
		<td title="<?php echo h($user['User']['created']); ?>">
				<?php echo h(substr($user['User']['created'],0,10)); ?>&nbsp;
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id']),
													 array('class'=>'btn')); ?>
			<?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $user['User']['id']),
													 array('class'=>'btn btn-danger')); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="pagination pagination-centered">
	<ul>
		<?php	echo $this->Paginator->numbers(array('separator'=>'','currentClass'=>'active','tag'=>'li'));	?>
	</ul>
	</div>
</div>
