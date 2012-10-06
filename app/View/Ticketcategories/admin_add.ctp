<div class="ticketcategories form">
	<div class="page-header">
		<h1>
			<?php echo __('Ticketcategories'); ?>			
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
			<?php  echo $this -> Html -> link(__('Ticketcategory'), array(
					'controller' => 'Ticketcategories',
					'action' 	 => 'index'
				), array('title' => 'Ticketcategory'));
			?>
		    <span class="divider">/</span>
		</li>
		<li>
		    Add 
		</li>
	</ul>
<?php echo $this->Form->create('Ticketcategory',array(
											  	'class'=>'form-horizontal',
											  	'inputDefaults' => array('label' => false,'div' => false)
											)); ?>
	<fieldset>
		<div class="control-group">
			<label class="control-label"><span class="red">* </span>Name </label>
			<div class="controls">
				<?php echo $this->Form->input('name'); ?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label"><span class="red">* </span>Parent Id </label>
			<div class="controls">
				<?php echo $this->Form->input('parent_id',array(
												'options'=>$parentTicketcategories,
												'empty' => 'Top Level'
										)); ?>
			</div>
		</div>
	</fieldset>
	<div class="form-actions">
		<button type="submit" class="btn btn-primary">Save</button>
	</div>
<?php echo $this->Form->end(); ?>
</div>