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
 * @copyright	 Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link		  http://cakephp.org CakePHP(tm) Project
 * @package	   Cake.View.Layouts
 * @since		 CakePHP(tm) v 0.10.0.1076
 * @license	   MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>:
		<?php echo SITE_NAME; ?>
	</title>
	<?php
		echo $this->element('admin/prescript');
		echo $this->fetch('css');
	?>
</head>
<body>
	<?php	echo $this->element('admin/topmenu',array('_USER'=>$_USER)); ?>
	
	<?php echo $this->Session->flash(); ?>
	
	 <div class="container-fluid">
	  <div class="row-fluid">
		<div class="span9 pull-right">
		  <?php echo $content_for_layout; ?>
		</div><!--/span-->
		<div class="span3 pull-left">
			<?php	echo $this->element('admin/sidebar_submenu',array('MenuType'=>@$MenuType));?>
		</div><!--/span-->
	  </div><!--/row-->

	  <hr>

	  <footer>
		<p>&copy; Company 2012</p>
	  </footer>

	</div><!--/.fluid-container-->




	<?php echo $this->element('admin/postscript'); ?>
	<?php echo $this->fetch('script'); ?>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
