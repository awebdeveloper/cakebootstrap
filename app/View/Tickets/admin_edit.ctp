<div class="tickets form">
	<div class="page-header">
		<h1>
			<?php echo __('Tickets'); ?>			
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
			<?php  echo $this -> Html -> link(__('Ticket'), array(
					'controller' => 'Tickets',
					'action' 	 => 'index'
				), array('title' => 'Ticket'));
			?>
		    <span class="divider">/</span>
		</li>
		<li>
		    Edit 
		</li>
	</ul>
	<?php echo $this->Form->create('Ticket',array('class'=>'form-horizontal','inputDefaults' => array('label' => false,'div' => false))); ?>
		<fieldset>
			<div class="control-group">
				<label class="control-label"><span class="red">* </span>Category</label>
				<div class="controls">
						<?php echo $this->Form->input('ticketcategory_id',array('options'=>$allTicketCategories)); ?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"><span class="red">* </span>Status </label>
				<div class="controls">
						<?php echo $this->Form->input('ticketstatus',array('options'=>$allTicketStatus)); ?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"><span class="red">* </span>Type </label>
				<div class="controls">
						<?php echo $this->Form->input('tickettype',array('options'=>$allTicketType)); ?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"><span class="red">* </span>Assignee </label>
				<div class="controls">
						<?php echo $this->Form->input('assignee_id',array('options'=>$Asssignees)); ?>
				</div>
			</div>
		</fieldset>
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
	<?php echo $this->Form->end(); ?>
</div>