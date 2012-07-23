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
				<form id="generalSettingsForm" name="eventform" action="" method="post">
						<div>
							<label for="name" id="name-label">Name :</label> <input
								type="text" name="name" id="name" class="required" value="" />
						</div>
						<div>
							<label for="sequence" id="sequence-label">Sequence :</label>
							<textarea name="sequence" id="sequence" cols="20" rows="20"></textarea>
						</div>
					</form>
				</div>
				<!-- TRANSMEMBRANE SETTINGS BEGIN -->
				<div>
					<form id="transmembraneSettingsForm" name="eventform" action="" method="post">
						<div>
							<label for="n-terminal" id="n-terminal-label">N-Terminal</label>
							<select name="n-terminal" id="n-terminal">
								<option value="inside" selected>Inside</option>
								<option value="outside">Outside</option>
							</select>
						</div>
						<div>
							<label for="c-terminal" id="c-terminal-label">C-Terminal</label>
							<select name="c-terminal" id="c-terminal">
								<option value="inside" selected>Inside</option>
								<option value="outside">Outside</option>
							</select>
						</div>
						<div>
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
				<!-- MODIFICATION SETTINGS BEGIN -->
				<div>
					<img src="<?php echo xUtil::url('a/js/jqwidgets/resources/loader.gif')?>" />
				</div>
				<!-- MODIFICATION SETTINGS END -->
			</div>
		</div>
	</div>
	<!-- SETTINGS WINDOW END -->
</div>
<!-- DOCKING END -->
