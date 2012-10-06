<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<div class="<?php echo $pluralVar; ?> form">
	<div class="page-header">
		<h1>
			<?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?>
			
			<div class="pull-right">
				<a href="#" class="btn btn-inverse js-back"> Back </a>
	    	</div> 
		</h1>
  	</div>
  	<ul class="breadcrumb">
		<li>
		    <?php echo "<?php  echo \$this -> Html -> link(__('Dashboard'), array(
					'controller' => 'users',
					'action' 	 => 'dashboard',
					'prefix' 	 => false
				), array('title' => 'Dashboard'));
			?>"; ?>

		    <span class="divider">/</span>
		</li>
		<li> 
			<?php echo "<?php  echo \$this -> Html -> link(__('$singularHumanName'), array(
					'controller' => '".Inflector::pluralize($modelClass)."',
					'action' 	 => 'index'
				), array('title' => '$singularHumanName'));
			?>"; ?>

		    <span class="divider">/</span>
		</li>
		<li>
		    <?php echo (strpos($action, 'add') !== false) ? 'Add ' : 'Edit ';   ?>

		</li>
	</ul>
<?php echo "<?php echo \$this->Form->create('{$modelClass}',array(
											  	'class'=>'form-horizontal',
											  	'inputDefaults' => \$inputDefaults
											)); ?>\n"; ?>
	<fieldset>
<?php
	foreach ($fields as $field) {
		if (strpos($action, 'add') !== false && $field == $primaryKey) {
			continue;
		} elseif (!in_array($field, array('created', 'modified', 'updated','id'))) {
?>
		<div class="control-group">
			<label class="control-label"><?php echo Inflector::humanize($field)	?> <span class="red">* </span></label>
			<?php echo "\t\t<?php echo \$this->Form->input('{$field}'); ?>\n";	?>
		</div>
<?php				
			}
		}
		if (!empty($associations['hasAndBelongsToMany'])) {
			foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
		?>
		<div class="control-group">
			<label class="control-label"><?php echo Inflector::humanize($assocName)	?><span class="red">* </span> </label>
			<?php echo "\t\t<?php echo \$this->Form->input('{$assocName}'); ?>\n"; ?>
		</div>
		<?php	
			}
		}
?>
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
	</fieldset>

<?php
	echo "<?php echo \$this->Form->end(); ?>\n";
?>
</div>