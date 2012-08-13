<form id="structure-form" class="form-horizontal">
<?php //<script type="text/template" id="structure-form-template"> ?>
	<div class="control-group">
		<label class="control-label" for="structure-sequence" id="structure-sequence-label">Sequence</label>
		<div class="controls">
			<textarea name="structure-sequence" id="structure-sequence" class="input-large required"
				rows="5"></textarea>
		</div>
	</div>
	<div class="control-group">
		<label for="structure-terminus-n" id="structure-terminus-n-label" class="control-label">Terminus</label>
		<div class="controls">
			N : <select name="structure-terminus-n" id="structure-terminus-n" class="input-small">
				<option value="inside" selected>Inside</option>
				<option value="outside">Outside</option>
			</select> C : <select name="structure-terminus-c" id="structure-terminus-c"
				class="input-small">
				<option value="inside" selected>Inside</option>
				<option value="outside">Outside</option>
			</select>
		</div>
	</div>
	<div class="control-group">
		<label for="structure-region-1" id="structure-region-label" class="control-label">Membrane
			regions</label>
		<div class="controls">
			<ol>
				<li style="margin-left: 20px; margin-bottom: 9px;">From : <input
					type="text" class="input-xmini inline" name="structure-region-from-1" id="from-1">
					To : <input type="text" class="input-xmini inline" name="structure-region-form-1"
					id="to-1">
					<i class="icon-minus"></i>
				</li>
				<li style="margin-left: 20px; margin-bottom: 9px;">From : <input
					type="text" class="input-xmini inline" name="from-2" id="from-2">
					To : <input type="text" class="input-xmini inline" name="to-2"
					id="to-2">
					<i class="icon-minus"></i>
				</li>
				<li style="margin-left: 20px; margin-bottom: 9px;">From : <input
					type="text" class="input-xmini inline" name="from-3" id="from-3">
					To : <input type="text" class="input-xmini inline" name="to-3"
					id="to-3">
					<i class="icon-minus"></i>
				</li>
				<li style="margin-left: 20px; margin-bottom: 9px;">From : <input
					type="text" class="input-xmini inline" name="from-4" id="from-4">
					To : <input type="text" class="input-xmini inline" name="to-4"
					id="to-4">
					<i class="icon-minus"></i>
				</li>
				<li style="margin-left: 20px; margin-bottom: 9px;">From : <input
					type="text" class="input-xmini inline" name="from-5" id="from-5">
					To : <input type="text" class="input-xmini inline" name="to-5"
					id="to-5">
					<i class="icon-plus"></i>
				</li>
			</ol>
		</div>
	</div>
	<div class="form-actions">
		<button class="btn btn-primary" type="submit" id="protein-form-submit">Save changes</button>
		<button class="btn">Cancel</button>
	</div>
<?php //</script> ?>
</form>
<!-- JavaScript - for better performance, on the bottom -->
<?php foreach ($m['js'] as $js): ?>
<script
	type="text/javascript" src="<?php echo $js ?>"></script>
<?php endforeach ?>
<script type="text/javascript">
	$(document).ready(function() {
		ProtView.Structure.Module.show('structure',1);
	});
</script>