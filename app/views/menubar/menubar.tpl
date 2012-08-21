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
							<li><a id="file-new-protein">New Protein</a>
							</li>
							<li><a id="file-open">Open</a>
							</li>
							<li><a id="file-save">Save</a>
							</li>
						</ul></li>
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown">View <b class="caret"></b>
					</a>
						<ul class="dropdown-menu">
							<li><a id="show-drawboard">Drawboard</a>
							</li>
							<li><a id="show-sidebar">Sidebar</a>
							</li>
						</ul></li>
				</ul>
				<ul class="nav pull-right">
					<li class="divider-vertical"></li>
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown">About <b class="caret"></b>
					</a>
						<ul class="dropdown-menu">
							<li><a href="#">Author</a>
							</li>
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
	});
</script>
