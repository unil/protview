<!-- DOCKING BEGIN -->
<div>
	<!-- SETTINGS WINDOW BEGIN -->
	<div id="settingsWindow">
		<div>Settings</div>
		<div style="overflow: hidden;">
			<div id="settingsTabs">
				<ul style="margin-left: 3px">
					<li>General</li>
					<li>Transmembrane</li>
					<li>Modification</li>
				</ul>
				<div>
					<img
						src="<?php echo xUtil::url('a/js/jqwidgets/resources/loader.gif')?>" />
				</div>
				<!-- TRANSMEMBRANE SETTINGS BEGIN -->
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
						<h1>Transmembrane protein information</h1>
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
						<h2>Transmembrane domains</h2>
						<div class="input text">
							<ol>
								<li>From : <input type="text" name="whole_day" id="whole_day">
									To : <input type="text" name="whole_day" id="whole_day">
								</li>
								<li>From : <input type="text" name="whole_day" id="whole_day">
									To : <input type="text" name="whole_day" id="whole_day">
								</li>
							</ol>
						</div>
					</form>

				</div>
				<!-- TRANSMEMBRANE SETTINGS END -->
				<div>Modification</div>
			</div>
		</div>
	</div>
	<!-- SETTINGS WINDOW END -->
</div>
<!-- DOCKING END -->
