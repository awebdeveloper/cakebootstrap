<?php echo $this->Html->charset(); ?>
<title>
	<?php echo $title_for_layout; ?>: 
	<?php echo SITE_NAME; ?>
</title>

<meta name="description" content="<?php echo DESCRIPTION ?>">
<meta http-equiv="content-language" content="en-us" />

<!-- Open Graph -->
<meta property="og:type" content="website"/>
<meta property="og:site_name" content="<?php echo SITE_NAME ?>"/>
<?php if(!strlen($FetchedMeta)) {?>
<meta property="og:title" content="<?php echo SITE_NAME ?>"/>
<meta property="og:image" content="<?php echo ASSETURL ?>img/ico/icon-114x114.png"/>
<meta property="og:description" content="<?php echo SITE_NAME ?>"/>
<?php } else { 
	echo $FetchedMeta ; 
} ?>

<!-- IE9 Pinned Tab -->
<meta name="application-name" content="<?php echo SITE_NAME ?>" />
<meta name="msapplication-tooltip" content="<?php echo SITE_NAME ?>" />
<meta name="msapplication-starturl" content="<?php echo SITEURL ?>?pinned=true" />
<meta name="msapplication-navbutton-color" content="#448899" />
<meta name="msapplication-window" content="width=1024;height=780" />
<meta name="msapplication-task" content="name=Task 1;action-uri=http://host/Page1.html;icon-uri=<?php echo ASSETURL ?>img/ico/favicon.ico" />
<meta name="msapplication-task" content="name=Task 2;action-uri=http://microsoft.com/Page2.html;icon-uri=<?php echo ASSETURL ?>img/ico/favicon.ico" />

<!-- IE -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="imagetoolbar" content="false">

<!-- Geo Location-->
<meta name="geo.placename" content="India" />

<!-- Favicon and other icons -->
<link rel="shortcut icon" type="image/x-icon" href="<?php echo ASSETURL ?>img/ico/favicon.ico" />
<link rel="icon" type="image/png" href="<?php echo ASSETURL ?>img/ico/icon-64x64.png" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo ASSETURL ?>img/ico/icon-114x114.png" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo ASSETURL ?>img/ico/icon-72x72.png" />
<link rel="apple-touch-icon-precomposed" href="<?php echo ASSETURL ?>img/ico/icon-57x57.png" />

<!-- Mobile -->
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width">
<meta http-equiv="cleartype" content="on">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">