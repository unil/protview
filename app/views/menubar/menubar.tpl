<div class="navbar">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse"
				data-target=".nav-collapse"> <span class="icon-bar"></span> <span
				class="icon-bar"></span> <span class="icon-bar"></span>
			</a> <span class="brand">ProtView</span>
			<div class="nav-collapse">
				<ul class="nav">
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown">File<b class="caret"></b>
					</a>
						<ul class="dropdown-menu">
							<li class="menu"><a id="file-new-protein">New</a></li>
							<li class="menu"><a id="file-open-representation">Open</a></li>
							<li class="menu"><a id="file-save-representation">Save</a></li>
						</ul>
					</li>
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown">View <b class="caret"></b>
					</a>
						<ul class="dropdown-menu">
							<li class="menu"><a id="show-drawboard">Show Drawboard</a></li>
							<li class="menu"><a id="show-sidebar">Show Sidebar</a></li>
						</ul>
					</li>
				</ul>
				<ul class="nav pull-right">
					<li></li>
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown">About <b class="caret"></b>
					</a>
						<ul class="dropdown-menu">
							<li class="menu"><a style="text-decoration: none;" href="<?php echo xUtil::url('doc/js/index.html')?>" target="_blank">Client-side documentation</a></li>
							<li class="menu"><a style="text-decoration: none;" href="<?php echo xUtil::url('doc/php/index.html')?>" target="_blank">Server-side documentation</a></li>
						</ul></li>
				</ul>
			</div>
			<!-- /.nav-collapse -->
		</div>
	</div>
	<!-- /navbar-inner -->
</div>
<script type="text/javascript">
	$(document).ready(function() {
		var mb = new ProtView.Application.MenubarView();

		//bug fix for menu not closing
		$(".menu").bind("click", function (e) {
			var currentMenu = $(this).parent('ul').parent('li');
		    currentMenu.removeClass("open");
		  });

	});
</script>
