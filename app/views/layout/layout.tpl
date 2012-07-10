<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title></title>
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
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
<!-- Le scripts | TODO: move to body bottom -->
<?php foreach ($m['js'] as $js): ?>
<script type="text/javascript" src="<?php echo $js ?>"></script>
<?php endforeach ?>
<!-- Le fav and touch icons -->
<script type="text/javascript">
	$(document).ready(function() {
		ProtView.init();
	});
</script>
</head>
<body>
	<!-- BEGIN PAGE -->
	<div id="page">
		<!-- BEBIN HEADER -->
		<div id="header">
			<img id="login" src="https://wwwfbm.unil.ch/html/img/login.gif"
				alt="login" />
			<div id="language">English | Français</div>
			<div id="bar">FBM - Protein visualizator</div>
		</div>
		<!-- END HEADER -->
		<!-- BEGIN CONTENT -->
		<div id="content">
			<!-- BEGIN MAIN -->
			<div id="main">
				<!-- BEGIN CONTENT -->
				<?php if (is_array($d['messages'])) foreach ($d['messages'] as $type => $message): ?>
            <div class="alert <?php echo $type ?>">
                <button class="close" data-dismiss="alert">×</button>
                <?php echo $message ?>
            </div>
<?php endforeach ?>
            <?php echo $d['html']['content'] ?>
				<div id="toolbar"></div>
				<div id="protein" style=" min-height:800px; height:auto !important; height:800px;" ></div>
				<!-- END CONTEN -->
			</div>
			<!-- END MAIN -->
			<!-- BEGIN SIDEBAR -->
			<div id="sidebar">
				<!-- BEGIN ROOM-VIEW -->
				<div id="room">
					<!-- BEGIN INFORMATION -->
					<div class="box">
						<h1>Information</h1>
						<div>adfs</div>
					</div>
					<!-- END INFORMATION -->
					<!-- BEGIN CONTACT -->
					<div class="box">
						<h1>Contact</h1>
						<div>adsf</div>
					</div>
					<!-- END CONTACT -->
				</div>
				<!-- END ROOM-VIEW -->
				<!-- BEGIN CONTROL-VIEW -->
				<div id="control"></div>
				<!-- END CONTROL-VIEW -->
			</div>
			<!-- END SIDEBAR -->
		</div>
		<!-- END CONTENT -->
		<!-- BEGIN FOOTER -->
		<div id="footer">&copy; 2012 - Université de Lausanne - All right
			reserved</div>
		<!-- END FOOTER -->
	</div>
	<!-- END PAGE -->
</body>
</html>
