 <!-- scripts concatenated and minified via build script -->
  	<link href="<?php echo ASSETURL; ?>css/poststyle.combined.css" rel="stylesheet" type="text/css">
  	<script src="<?php echo ASSETURL; ?>js/script.combined.js" type="text/javascript"></script>
  	<script type="text/javascript">
  		$('.dropdown-toggle').dropdown();
  		$(".collapse").collapse()
  	</script>

  	<?php if(Configure::read('debug') != 0): ?>
  		<link href="<?php echo ASSETURL; ?>css/libs/cake.generic.css" rel="stylesheet" type="text/css">
  	<?php endif; ?>

