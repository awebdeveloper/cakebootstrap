<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<div class="<?php echo $pluralVar; ?> index">
	<h2><?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?></h2>
	<div class="table-responsive">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<?php foreach ($fields as $field): ?><th><?php echo "<?php echo \$this->Paginator->sort('{$field}'); ?>"; ?></th>
					<?php endforeach; ?><th class="actions"><?php echo "<?php echo __('Actions'); ?>"; ?></th>
				</tr>
			</thead>
			<tbody>
			<?php
			echo "\t<?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
			echo "\t\t\t\t<tr>\n";
				foreach ($fields as $field) {
					$isKey = false;
					if (!empty($associations['belongsTo'])) {
						foreach ($associations['belongsTo'] as $alias => $details) {
							if ($field === $details['foreignKey']) {
								$isKey = true;
								echo "\t\t\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";
								break;
							}
						}
					}
					if ($isKey !== true) {
						echo "\t\t\t\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
					}
				}

				echo "\t\t\t\t\t<td class=\"actions\">\n";
				echo "\t\t\t\t\t\t<?php echo \$this->Html->link(__('View'), array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
				echo "\t\t\t\t\t\t<?php echo \$this->Html->link(__('Edit'), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
				echo "\t\t\t\t\t\t<?php echo \$this->Form->postLink(__('Delete'), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), null, __('Are you sure you want to delete # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
				echo "\t\t\t\t\t</td>\n";
			echo "\t\t\t\t</tr>\n";

			echo "\t\t\t\t<?php endforeach; ?>\n";
			?>
			</tbody>
		</table>
	</div>

	<p>
		<small><?php
	echo "<?php
		echo \$this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
		));
		?>"; ?></small>
	</p>

	<ul class="pagination"><?php
			echo "\n\t<?php\n";
			echo "\t\techo \$this->Paginator->prev('« ' . __('Prev'),  array('tag' => 'li'), null, array('class' => 'prev disabled','tag' => 'li','disabledTag'=>'a'));\n";
			echo "\t\techo \$this->Paginator->numbers(array('separator' => '','tag' => 'li','currentTag'=>'a','currentClass'=>'active'));\n";
			echo "\t\techo \$this->Paginator->next(__('Next') . ' »', array('tag' => 'li'), null, array('class' => 'next disabled','tag' => 'li','disabledTag'=>'a'));\n";
			echo "\t?>\n";
		?>
	</ul>
</div>


<?php echo '<?php $this->start(\'actions\'); ?>'."\n"; ?>
<li><?php echo "<?php echo \$this->Html->link(__('New " . $singularHumanName . "'), array('action' => 'add')); ?>"; ?></li><?php
	$done = array();
	foreach ($associations as $type => $data) {
		foreach ($data as $alias => $details) {
			if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
				echo "<li><?php echo \$this->Html->link(__('List " . Inflector::humanize($details['controller']) . "'), array('controller' => '{$details['controller']}', 'action' => 'index')); ?> </li>\n";
				echo "<li><?php echo \$this->Html->link(__('New " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'add')); ?> </li>\n";
				$done[] = $details['controller'];
			}
		}
	}
	echo '<?php $this->end(\'actions\'); ?>';
?>
