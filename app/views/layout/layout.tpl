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
		var theme = 'summer';
		 // Create jqxNavigationBar
		//$("#toolbar").jqxExpander({ width: '350px', theme: theme });
		$('#sidebar').jqxDocking({ theme: theme, orientation: 'horizontal', width: 350, mode: 'docked' });
		$('#settingsTabs').jqxTabs({ theme: theme, width: 310, height: 181, selectedItem: 1 });

		$("#jqxMenu").jqxMenu({ width: '100%', height: '30px', theme: theme });
        $("#jqxMenu").css('visibility', 'visible');
	});
</script>
</head>
<body>
	<!-- BEGIN PAGE -->
	<div id="page">
		<!-- BEBIN HEADER -->
		<div id="header">
			<div id='jqxMenu' style='visibility: hidden;'>
				<ul>
					<li><a href="#Home">Home</a></li>
					<li>Solutions
						<ul style='width: 250px;'>
							<li><a target="_parent" href="#Education">Education</a></li>
							<li id="fin"><a href="#Financial">Financial services</a></li>
							<li><a href="#Government">Government</a></li>
							<li><a href="#Manufacturing">Manufacturing</a></li>
							<li type='separator'></li>
							<li>Software Solutions
								<ul style='width: 220px;'>
									<li><a href="#ConsumerPhoto">Consumer photo and video</a></li>
									<li><a href="#Mobile">Mobile</a></li>
									<li><a href="#RIA">Rich Internet applications</a></li>
									<li><a href="#TechnicalCommunication">Technical communication</a>
									</li>
									<li><a href="#Training">Training and eLearning</a></li>
									<li><a href="#WebConferencing">Web conferencing</a></li>
								</ul>
							</li>
							<li><a href="#">All industries and solutions</a></li>
						</ul>
					</li>
				</ul>
			</div>


		</div>
		<!-- END HEADER -->
		<!-- BEGIN MAIN -->
		<div id="main">
			<!-- BEGIN CONTENT -->
			<div id="content">
				<?php if (is_array($d['messages'])) foreach ($d['messages'] as $type => $message): ?>
				<div class="alert <?php echo $type ?>">
					<button class="close" data-dismiss="alert">×</button>
					<?php echo $message ?>
				</div>
				<?php endforeach ?>
				<?php echo $d['html']['content'] ?>
				<!--  style="min-height: 800px; height: auto !important; height: 800px;"></div>-->
				<!-- END CONTENT -->
				<div id="protein" style="display: inline;"></div>
				<!-- BEGIN SIDEBAR -->
				<div id="sidebar">
					<div>
                	<div id="settingsWindow" style="height: 220px;">
						<div>Settings</div>
						<div style="overflow: hidden;">
							<div id="settingsTabs">
                            <ul style="margin-left: 30px">
                                <li>General</li>
                                <li>Transmembrane specific</li>
                                <li>Modification</li>
                            </ul>
                            <div>
                                General settings
                            </div>
                            <div>
                                Transmembrane specific
                            </div>
                            <div>
                                Modification
                            </div>
                        </div>
						</div>
						</div>
					</div>
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
</body>
</html>
