<div id="contentcolumn">
    <div class="MainHead">
      	<h2>Dashboard</h2>
    </div> 
    <div class="log-stats">
		<div id="error-log" class="well">
			<div>
			    <h3>
			    	<?php echo ('Error Log') ?> 
			    	<small class="pull-right">
				    	<?php echo $this->Html->link(('Clear Error Log'), 
									array('controller' => 'users', 'action' => 'admin_clear_logs', 'type' => 'error_log'));		?>
			    	</small>
				</h3>
			</div>
			<div><textarea><?php echo @$error_log;?></textarea></div>
		</div>
		<div id="debug-log" class="well">
			<div>
			    <h3>
			    	<?php echo ('Debug Log') ?> 
			    	<small class="pull-right">
				    	<?php echo $this->Html->link(('Clear Debug Log'), 
									array('controller' => 'users', 'action' => 'admin_clear_logs', 'type' => 'debug_log'));		?>
			    	</small>
				</h3>
			 </div>
			<div><textarea><?php echo @$debug_log;?></textarea></div>
		</div>
	</div>
</div>

<script>
<?php $this->Html->scriptStart(array('inline' => false)); ?>

	$(function() {
		//$( "#dialog" ).dialog();
	});

<?php $this->Html->scriptEnd(); ?>
</script>
