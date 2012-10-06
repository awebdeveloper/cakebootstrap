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
<div class="<?php echo $pluralVar; ?> view">
	<div class="page-header">
		<h1>
			<?php echo "<?php echo __('{$singularHumanName}'); ?>"; ?>

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
			<?php echo "<?php  echo \$this -> Html -> link(__('".$modelClass."'), array(
					'controller' => '<?php echo $modelClass; ?>',
					'action' 	 => 'index'
				), array('title' => '<?php echo $modelClass; ?>'));
			?>"; ?>

		    <span class="divider">/</span>
		</li>
		<li>
		    <?php 		    	echo $singularHumanName; 		    ?>

		</li>
	</ul>
	<h2>#<?php echo "<?php echo h(\${$singularVar}['{$modelClass}']['id']); ?>"; ?></h2>
	<table class="table table-striped">
	<?php foreach ($fields as $field) { ?>
	<?php
		$isKey = false;
		if (!empty($associations['belongsTo'])) {
			foreach ($associations['belongsTo'] as $alias => $details) {
				if ($field === $details['foreignKey']) {
					$isKey = true;
					echo "\t<tr>\n\t\t\t<td><strong><?php echo __('" . Inflector::humanize(Inflector::underscore($alias)) . "'); ?></strong></td>\n";
					echo "\t\t\t\t<td>\n\t\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t\t\t&nbsp;\n\t\t\t</td>\n\t\t</tr>\n";
		?><tr>
			<td><strong><?php echo"<?php  echo __('" . Inflector::humanize(Inflector::underscore($alias)) . "');  ?>"; ?></strong></td>
			<td>
				<?php echo"<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], 
					array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>"; ?>&nbsp;
			</td>
		</tr><?php
					break;
				}
			}
		}
		if ($isKey !== true) {
		?><tr>
			<td><strong><?php echo"<?php echo __('" . Inflector::humanize($field) . "'); ?>"; ?></strong></td>
			<td><?php echo"<?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>"; ?>&nbsp;</td>
		</tr><?php
		}
	?>
		<?php }	?>

	</table>
</div>
<?php
if (!empty($associations['hasOne'])) :
	foreach ($associations['hasOne'] as $alias => $details): ?>
	<div class="related">
		<h3><?php echo "<?php echo __('Related " . Inflector::humanize($details['controller']) . "'); ?>"; ?></h3>
		<?php echo "<?php if (!empty(\${$singularVar}['{$alias}'])): ?>\n"; ?>
			<dl>
				<?php
						foreach ($details['fields'] as $field) {
							echo "\t\t<dt><?php echo __('" . Inflector::humanize($field) . "'); ?></dt>\n";
							echo "\t\t<dd>\n\t<?php echo \${$singularVar}['{$alias}']['{$field}']; ?>\n&nbsp;</dd>\n";
						}
				?>
			</dl>
		<?php echo "<?php endif; ?>\n"; ?>
	</div>
	<?php
	endforeach;
endif;
if (empty($associations['hasMany'])) {
	$associations['hasMany'] = array();
}
if (empty($associations['hasAndBelongsToMany'])) {
	$associations['hasAndBelongsToMany'] = array();
}
$relations = array_merge($associations['hasMany'], $associations['hasAndBelongsToMany']);
$i = 0;
foreach ($relations as $alias => $details):
	$otherSingularVar = Inflector::variable($alias);
	$otherPluralHumanName = Inflector::humanize($details['controller']);
	?>
<div class="related">
	<h3><?php echo "<?php echo __('Related " . $otherPluralHumanName . "'); ?>"; ?></h3>
	<?php echo "<?php if (!empty(\${$singularVar}['{$alias}'])): ?>\n"; ?>
		<table cellpadding = "0" cellspacing = "0" class="table table-striped table-bordered">
			<tr>
			<?php	foreach ($details['fields'] as $field) { ?>
	<th><?php echo "<?php echo __('" . Inflector::humanize($field) . "'); ?>"; ?></th>
			<?php	}	?>
	<th class="actions"><?php echo "<?php echo __('Actions'); ?>"; ?></th>
			</tr>
		<?php
		echo "\t<?php
				\$i = 0;
				foreach (\${$singularVar}['{$alias}'] as \${$otherSingularVar}): ?>\n";
				echo "\t\t\t\t<tr>\n";
					foreach ($details['fields'] as $field) {
						echo "\t\t\t\t\t<td><?php echo \${$otherSingularVar}['{$field}']; ?></td>\n";
					}

					echo "\t\t\t\t\t<td class=\"actions\">\n";
					echo "\t\t\t\t\t\t<?php echo \$this->Html->link(__('View'), 
												array('controller' => '{$details['controller']}', 'action' => 'view', \${$otherSingularVar}['{$details['primaryKey']}']),
												array('class'=>'btn')); ?>\n";
					echo "\t\t\t\t\t\t<?php echo \$this->Html->link(__('Edit'), 
												array('controller' => '{$details['controller']}', 'action' => 'edit', \${$otherSingularVar}['{$details['primaryKey']}']),
												array('class'=>'btn btn-success')); ?>\n";
					echo "\t\t\t\t\t\t<?php echo \$this->Form->postLink(__('Delete'), 
												array('controller'=>'{$details['controller']}', 'action'=>'delete', \${$otherSingularVar}['{$details['primaryKey']}']), 
												array('class'=>'btn btn-danger'), 
												__('Are you sure you want to delete # %s?', \${$otherSingularVar}['{$details['primaryKey']}'])); ?>\n";
					echo "\t\t\t\t\t</td>\n";
				echo "\t\t\t\t</tr>\n";

		echo "\t\t\t<?php endforeach; ?>\n";
		?>
		</table>
	<?php echo "<?php endif; ?>\n\n"; ?>
	<div class="actions">
		<ul>
			<li><?php echo "<?php echo \$this->Html->link(__('New " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'add')); ?>"; ?> </li>
		</ul>
	</div>
</div>
<?php endforeach; ?>
