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
<div class="<?php echo $pluralVar; ?> index">
	<div class="page-header">
		<h1>
			<?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?>

			<div class="pull-right">
				<?php echo "<?php echo \$this->Html->link(__('Add'), 
								array('action' => 'add'),
								array('class'=>'btn btn-success')); ?>\n"; ?>
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
		    <?php echo $singularHumanName; ?>

		</li>
	</ul>
	<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
	<tr>
	<?php  foreach ($fields as $field): ?>
		<th><?php echo "<?php echo \$this->Paginator->sort('{$field}'); ?>"; ?></th>
	<?php endforeach; ?>
		<th class="actions"><?php echo "<?php echo __('Actions'); ?>"; ?></th>
	</tr>
	<?php
	echo "<?php	foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
	echo "\t<tr>\n";
		foreach ($fields as $field) {
			$isKey = false;
			if (!empty($associations['belongsTo'])) {
				foreach ($associations['belongsTo'] as $alias => $details) {
					if ($field === $details['foreignKey']) {
						$isKey = true;
						echo "\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";
						break;
					}
				}
			}
			
			 if ($isKey !== true) {
			 	if (in_array($field, array('created', 'modified'))) {

					echo "\t\t<td title=\"<?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>\">".
							"\n\t\t\t<?php echo h(substr(\${$singularVar}['{$modelClass}']['{$field}'],0,10)); ?>"
						."\n\t\t</td>\n";
				}
				else
				{
					echo "\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
				}				
			}
		}

		echo "\t\t<td class=\"actions\">\n";
		echo "\t\t\t<?php echo \$this->Html->link(__('View'), 
									array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}']),
									array('class'=>'btn')); ?>\n";
	 	echo "\t\t\t<?php echo \$this->Html->link(__('Edit'), 
	 								array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']),
	 								array('class'=>'btn btn-success')); ?>\n";
	 	echo "\t\t\t<?php echo \$this->Form->postLink(__('Delete'), 
		 							array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), 
		 							array('class'=>'btn btn-danger'), 
		 							__('Are you sure you want to delete # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
		echo "\t\t</td>\n";
	echo "\t</tr>\n";

	echo "\t<?php endforeach; ?>\n";
	?>
	</table>
	<p>
		<?php echo "<?php
		echo \$this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
		));
		?>\n"; ?>
	</p>

	<div class="pagination pagination-centered">
		<ul>
		<?php
			echo "\t<?php echo \$this->Paginator->numbers(array('separator'=>'','currentClass'=>'active','tag'=>'li')); ?>\n";
		?>
		</ul>
	</div>
</div>
