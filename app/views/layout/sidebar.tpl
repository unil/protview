<?php 
/*
 *     <form class="form-horizontal">
<fieldset>
<legend>Legend text</legend>
<div class="control-group">
<label class="control-label" for="input01">Text input</label>
<div class="controls">
<input type="text" class="input-xlarge" id="input01">
<p class="help-block">Supporting help text</p>
</div>
</div>
</fieldset>
</form>
*/
?>

<!-- DOCKING BEGIN -->
<div>
	<!-- SETTINGS WINDOW BEGIN -->
	<div id="settingsWindow" style="height: 540px">
		<div>Settings</div>
		<div style="overflow: hidden;">
			<div id="settingsTabs">
				<ul style="margin-left: 3px">
					<li>General</li>
					<li>Structure</li>
					<li>Modification</li>
				</ul>
				<div>
					<form id="generalSettingsForm" class="form-horizontal">
						<div class="control-group">
							<label class="control-label" for="name" id="name-label">Name</label>
							<div class="controls">
								<input type="text" name="name" id="name"
									class="input-large required" value="" />
							</div>
						</div>
						<div>
							<input type="submit" value="Save" />
						</div>
					</form>
				</div>
				<!-- STRUCTURE SETTINGS BEGIN -->
				<div>
					<form id="transmembraneSettingsForm" class="form-horizontal">
						<div class="control-group">
							<label class="control-label" for="sequence" id="sequence-label">Sequence</label>
							<div class="controls">
								<textarea name="sequence" id="sequence"
									class="input-large required" rows="5"></textarea>
							</div>
						</div>
						<div class="control-group">
							<label for="domain" id="domain-label" class="control-label">Terminus</label>
							<div class="controls">
								N : <select name="n-terminal" id="n-terminal"
									class="input-small">
									<option value="inside" selected>Inside</option>
									<option value="outside">Outside</option>
								</select> C : <select name="n-terminal" id="n-terminal"
									class="input-small">
									<option value="inside" selected>Inside</option>
									<option value="outside">Outside</option>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label for="domain" id="domain-label" class="control-label">Membrane
								domains</label>
							<div class="controls">
							<ol>
								<li style="margin-left: 20px; margin-bottom: 9px;">From : <input type="text" class="input-xmini inline"
									name="from-1" id="from-1"> To : <input type="text"
									class="input-xmini inline" name="to-1" id="to-1"></li>
								<li style="margin-left: 20px; margin-bottom: 9px;">From : <input type="text" class="input-xmini inline"
									name="from-2" id="from-2"> To : <input type="text"
									class="input-xmini inline" name="to-2" id="to-2"></li>
								<li style="margin-left: 20px; margin-bottom: 9px;">From : <input type="text" class="input-xmini inline"
									name="from-3" id="from-3"> To : <input type="text"
									class="input-xmini inline" name="to-3" id="to-3"></li>
								<li style="margin-left: 20px; margin-bottom: 9px;">From : <input type="text" class="input-xmini inline"
									name="from-4" id="from-4"> To : <input type="text"
									class="input-xmini inline" name="to-4" id="to-4"></li>
								<li style="margin-left: 20px; margin-bottom: 9px;">From : <input type="text" class="input-xmini inline"
									name="from-5" id="from-5"> To : <input type="text"
									class="input-xmini inline" name="to-5" id="to-5"></li>
									
							</ol>
							</div>
						</div>
						<div class="form-actions">
							<button class="btn btn-primary" type="submit">Save changes</button>
							<button class="btn">Cancel</button>
						</div>
					</form>

				</div>
				<!-- STRUCTURE SETTINGS END -->
				<!-- MODIFICATION SETTINGS BEGIN -->
				<div>
					<img
						src="<?php echo xUtil::url('a/js/lib/jqwidgets/resources/loader.gif')?>" />
				</div>
				<!-- MODIFICATION SETTINGS END -->
			</div>
		</div>
	</div>
	<!-- SETTINGS WINDOW END -->
</div>
<!-- DOCKING END -->