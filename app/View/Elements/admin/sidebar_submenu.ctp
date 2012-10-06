<div class="well sidebar-nav">
	<ul class="nav nav-list">
	<?php if($MenuType['category'] == 'user' || empty($MenuType['category'])){ ?>
		<li class="nav-header">User</li>
		<li><a href="<?php echo SITEURL ?>admin/users/index/">Manage User</a></li>
	<?php }  if($MenuType['category'] == 'analytics' || empty($MenuType['category'])){ ?>
		<li class="nav-header">Analytics</li>
		<li><a href="<?php echo SITEURL; ?>admin/shares/stats/">Interaction</a></li>
		<li><a href="#">Google Analytics</a></li>
	<?php }  if($MenuType['category'] == 'admin' || empty($MenuType['category'])){ ?>
		<li class="nav-header">Support</li>
		<li><a href="<?php echo SITEURL; ?>admin/tickets/index/bug">Bugs</a></li>
		<li><a href="<?php echo SITEURL; ?>admin/tickets/index/help">Support</a></li>
		<li><a href="<?php echo SITEURL; ?>admin/ticketcategories/index/">Categories</a></li>
	<?php } ?>
	</ul>
</div><!--/.well -->