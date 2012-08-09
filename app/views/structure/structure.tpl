<form id="transmembraneSettingsForm" class="form-horizontal">
	<div class="control-group">
		<label class="control-label" for="sequence" id="sequence-label">Sequence</label>
		<div class="controls">
			<textarea name="sequence" id="sequence" class="input-large required"
				rows="5"></textarea>
		</div>
	</div>
	<div class="control-group">
		<label for="domain" id="domain-label" class="control-label">Terminus</label>
		<div class="controls">
			N : <select name="n-terminal" id="n-terminal" class="input-small">
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
			regions</label>
		<div class="controls">
			<ol>
				<li style="margin-left: 20px; margin-bottom: 9px;">From : <input
					type="text" class="input-xmini inline" name="from-1" id="from-1">
					To : <input type="text" class="input-xmini inline" name="to-1"
					id="to-1">
				</li>
				<li style="margin-left: 20px; margin-bottom: 9px;">From : <input
					type="text" class="input-xmini inline" name="from-2" id="from-2">
					To : <input type="text" class="input-xmini inline" name="to-2"
					id="to-2">
				</li>
				<li style="margin-left: 20px; margin-bottom: 9px;">From : <input
					type="text" class="input-xmini inline" name="from-3" id="from-3">
					To : <input type="text" class="input-xmini inline" name="to-3"
					id="to-3">
				</li>
				<li style="margin-left: 20px; margin-bottom: 9px;">From : <input
					type="text" class="input-xmini inline" name="from-4" id="from-4">
					To : <input type="text" class="input-xmini inline" name="to-4"
					id="to-4">
				</li>
				<li style="margin-left: 20px; margin-bottom: 9px;">From : <input
					type="text" class="input-xmini inline" name="from-5" id="from-5">
					To : <input type="text" class="input-xmini inline" name="to-5"
					id="to-5">
				</li>

			</ol>
		</div>
	</div>
	<div class="form-actions">
		<button class="btn btn-primary" type="submit">Save changes</button>
		<button class="btn">Cancel</button>
	</div>
</form>
