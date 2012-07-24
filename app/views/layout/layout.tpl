<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>FBM Toolbox - ProtView</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="https://wwwfbm.unil.ch/favicon.ico"
	type="image/x-icon" />
<link rel="shortcut icon" href="https://wwwfbm.unil.ch/favicon.ico"
	type="image/x-icon" />
<!-- Le styles -->
<?php foreach ($m['css'] as $css): ?>
<link href="<?php echo $css ?>" rel="stylesheet">
<?php endforeach ?>
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
	<!-- BEGIN PAGE -->
	<div id="page">
		<!-- BEBIN HEADER -->
		<div id="header">
			<div id='menubar' style='visibility: hidden;'>
				<?php echo xView::load('layout/menubar')->render() ?>
			</div>
		</div>
		<!-- END HEADER -->
		<!-- BEGIN MAIN -->
		<div id="main">
			<!-- BEGIN CONTENT -->
			<div id="content">
				<img id="content-loading"
					src="<?php echo xUtil::url('a/js/jqwidgets/resources/loader.gif')?>" />
				<?php if (is_array($d['messages'])) foreach ($d['messages'] as $type => $message): ?>
				<div class="alert <?php echo $type ?>">
					<button class="close" data-dismiss="alert">×</button>
					<?php echo $message ?>
				</div>
				<?php endforeach ?>
				<?php echo $d['html']['content'] ?>
				<!--  style="min-height: 800px; height: auto !important; height: 800px;"></div>-->
				<div id="protein" style="display: inline;"></div>
				<!-- END CONTENT -->
				<!-- BEGIN SIDEBAR -->
				<div id="sidebar">
					<?php echo xView::load('layout/sidebar')->render() ?>
				</div>
				<!-- END SIDEBAR -->
			</div>
		</div>
		<!-- END MAIN -->
		<!-- BEGIN FOOTER -->
		<div id="footer">&copy; 2012 - Université de Lausanne - All right
			reserved</div>
		<!-- END FOOTER -->
	</div>
	<!-- END PAGE -->
	<!-- JavaScript - for better performance, on the bottom -->
	<?php foreach ($m['js'] as $js): ?>
	<script type="text/javascript" src="<?php echo $js ?>"></script>
	<?php endforeach ?>
	<!-- Le fav and touch icons -->
	<script type="text/javascript">
	$(document).ready(function() {
		
		var theme = 'summer';

		$("#menubar").jqxMenu({ width: '100%', height: '30px', theme: theme });
        $("#menubar").css('visibility', 'visible');

		$('#sidebar').jqxDocking({ theme: theme, orientation: 'horizontal', width: 400, mode: 'docked' });
		$('#sidebar').jqxDocking('showAllCollapseButtons');
		$('#settingsTabs').jqxTabs({ theme: theme, width: '100%', height: '100%', selectedItem: 1 });
		
		ProtView.init();
		$('#content-loading').remove();

	});
</script>
</body>
</html>
