<div id="export-dialog">
	<div>Export</div>
	<div>
		<form id="export-form" class="form-horizontal" method="post" action="<?php echo xUtil::url('raw/drawingboard/do/export')?>" target="download">
			<input type="hidden" name="svgContent" id="svgContent" value="">
			<input type="hidden" name="svgViewbox" id="svgViewbox" value="">
			<input type="hidden" name="css" id="css" value="<?php echo $d['css'];?>">
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
							
						</label>
						<input class="input-xmini inline" type="text" name="export-size-other-width" id="export-size-other-width" value=""> x
						<input class="input-xmini inline" type="text" name="export-size-other-height" id="export-size-other-height" value="">
					</div>
				</div>
			</div>
			<div class="form-actions">
				<button class="btn btn-primary" type="submit"
					id="export-form-submit">Export</button>
				<button id="export-dialog-close" class="btn">Cancel</button>
			</div>
		</form>
	</div>
	<iframe id="download" name="download" width="0" height="0"></iframe>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		var svg_data = $('#svg-representation').contents();
		var svgContent = '';
		svg_data.each(function(key, val) {
			svgContent += $("<div/>").html($(val).clone()[0]).html();
		});
		$('#svgContent').val(svgContent);

		var svg = $('#drawBoard').svg('get');
		var c = svg.getElementById('svg-representation');
		

		console.log('log');
		console.log($(c).attr('viewBox'));

		
		  $('#export-dialog').jqxWindow({ 
			  theme: Application.THEME, 
			  width: 400,
              height: 220, 
              resizable: false,
              isModal: true
          });
		  $('#export-dialog').bind('closed', function (event) {
			  //cleaning dom
			  $('#export-dialog').remove();
			  $('.jqx-window-modal ').remove();
		  });

		  $('#export-dialog-close').click(function(e) {
			  e.preventDefault();
			  $('#export-dialog').jqxWindow('close');
		  });
	});
</script>
