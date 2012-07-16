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
		 // Create jqxNavigationBar
		$("#toolbar").jqxExpander({ width: '350px', theme: 'summer' });
	});
</script>
</head>
<body>
	<!-- BEGIN PAGE -->
	<div id="page">
		<!-- BEBIN HEADER -->
		<div id="header"></div>
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
					<div id='toolbar'>
						<div>Settings</div>
						<div>
							<form id="eventform" name="eventform" action="" method="post">
									<div class="input text">
										<label for="name" id="name-label">Name :</label> <input
											type="text" name="name" id="name" class="required" value="" />
									</div>

									<div class="input textarea">
										<label for="sequence" id="sequence-label">Sequence :</label>
										<textarea name="sequence" id="sequence" cols="20" rows="20"></textarea>
									</div>

									<div class="input text">
										<label for="n-terminal" id="n-terminal-label">N-Terminal</label>
										<select name="n-terminal" id="n-terminal">
											<option value="inside" selected>Inside</option>
											<option value="outside">Outside</option>
										</select>
									</div>
									<div class="input text">
										<label for="c-terminal" id="c-terminal-label">C-Terminal</label>
										<select name="c-terminal" id="c-terminal">
											<option value="inside" selected>Inside</option>
											<option value="outside">Outside</option>
										</select>
									</div>
									<div class="input text">
										<label for="whole_day" id="event-whole-day">Domain :</label> 
										<input type="checkbox" name="whole_day" id="whole_day" >
									
									</div>

							</form>
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
