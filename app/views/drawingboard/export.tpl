<div id="export-dialog">
	<div>Export</div>
	<div>
		<form id="export-form" class="form-horizontal">
			<div id="peptide-form-insert">
				<div class="control-group">
					<label for="export-size" id="export-size-label"
						class="control-label">Size</label>
					<div class="controls">
						<label class="radio"> <input type="radio" name="export-size"
							id="export-size-original" value="original" checked> Original
						</label> <label class="radio"> <input type="radio"
							name="export-size" id="export-size-1024_768" value="1024_768">
							1024x768
						</label> <label class="radio"> <input type="radio"
							name="export-size" id="export-size-other" value="other"> Other :
							<input type="text" name="export-size-other-size" id="export-size-other-size" value="">
						</label>
					</div>
				</div>
			</div>
			<div class="form-actions">
				<button class="btn btn-primary" type="submit"
					id="export-form-submit">Export</button>
				<button class="btn">Cancel</button>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		  $('#export-dialog').jqxWindow({ 
			  theme: Application.THEME, 
			  width: 400,
              height: 220, 
              resizable: false,
              isModal: true
          });
		  $('#export-dialog').bind('closed', function (event) {
			  //cleaning dom
			  $('#open-representation-dialog').remove();
			  $('.jqx-window-modal ').remove();
		  });
	});
</script>
