<div class="shares index">
	<div class="page-header">
		<h1>
			<?php echo Inflector::humanize($title); ?>
			<div class="pull-right">
				<?php 
					echo $this->Html->link('Details', 
							array('controller'=>'Shares','action'=>'index',	'admin'=> true),
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
		    <?php  echo $this -> Html -> link(__('Shares'), array(
					'controller'=>'Shares',
					'action'=>'index',
					'prefix' 	 => false
				), array('title' =>  'Shares'));
			?>
		    <span class="divider">/</span>
		</li>
		<li>
			<?php echo Inflector::humanize($type); ?>

		</li>
	</ul>
	<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
	<tr>
		<th><?php echo $this->Paginator->sort('name'); ?></th>
		<th><?php echo $this->Paginator->sort('count'); ?></th>
		<th>Actions</th>
	</tr>
	<?php	foreach ($shares as $share): ?>
	<tr>
		<td>
			<?php echo $share['0']['name']; ?>
		</td>
		<td>
			<?php echo $share['0']['count']; ?>
		</td>
		<td>
			<?php 
				foreach (array('user','provider') as $key => $value) {
					if($value != $type){
				
						echo $this->Html->link(Inflector::humanize($value), 
												array('controller'=>'Shares','action'=>'stats',
														'admin'=> true,'?' => array($type => $share['0']['id'], 'type' => $value )),
												array('class'=>'btn btn-info'));
						echo '&nbsp;';
					}

				}
			?>
			
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
