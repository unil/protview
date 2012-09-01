<div id="export-dialog">
	<div>Export</div>
	<div>
		<form id="export-form" class="form-horizontal" method="post" action="<?php echo xUtil::url('raw/drawingboard/do/export')?>" target="download">
			<input type="hidden" id="svg_content" value="">
			<input type="hidden" id="svg_viewbox" value="">
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
<iframe id="download" name="download" width="0" height="0"></iframe>
<script type="text/javascript">
	$(document).ready(function() {
		var svg_data = $('#svg-representation').contents();
		var svgContent = '';
		svg_data.each(function(key, val) {
			svgContent += $("<div/>").html($(val).clone()[0]).html();
		});
		$('#svg_content').val(svgContent);

		console.log('log');
		console.log($('#svg-representation').attr('viewBox'));

		
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
