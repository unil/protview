<?php 
/**
 * Implementation from http://geekswithblogs.net/GruffCode/archive/2010/10/28/detecting-the-file-download-dialog-in-the-browser.aspx
 */
?>
<div id="export-dialog">
	<div>Export</div>
	<div>
		<form id="export-form" class="form-horizontal" method="post"
			action="<?php echo xUtil::url('raw/drawingboard/do/export')?>"
			target="download">
			<input type="hidden" name="svgContent" id="svgContent" value=""> <input
				type="hidden" name="svgViewbox" id="svgViewbox" value=""> <input
				type="hidden" name="css" id="css" value="<?php echo $d['css'];?>"> <input
				type="hidden" name="token" id="token" value="">
			<div id="peptide-form-insert">
				<div class="control-group">
					<label for="export-size" id="export-size-label"
						class="control-label">Size</label>
					<div class="controls">
						<label class="radio"> <input type="radio" name="export-size"
							id="export-size-original" value="original" checked> Original
						</label> <label class="radio"> <input type="radio"
							name="export-size" id="export-size-1024_768" value="1024x768">
							1024x768
						</label> <label class="radio"> <input type="radio"
							name="export-size" id="export-size-other" value="other"> Other :

						</label> <input class="input-xmini inline" type="text"
							name="export-size-other-width" id="export-size-other-width"
							value=""> x <input class="input-xmini inline" type="text"
							name="export-size-other-height" id="export-size-other-height"
							value="">
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
	
</div>
<iframe id="download" name="download" width="0" height="0"></iframe>
<script type="text/javascript">
	var token = new Date().getTime();
	$(document).ready(function() {
		
		var svg_data = $('#svg-representation').contents();
		var svgContent = '';
		svg_data.each(function(key, val) {
			svgContent += $("<div/>").html($(val).clone()[0]).html();
		});
		$('#svgContent').val(svgContent);


		var svg = $('#svg-representation')[0];
		var viewbox = svg.getAttribute('viewBox');

		$('#svgViewbox').val(viewbox);

		
		$('#token').val(token);
		/*console.log('log');
		console.log($(c).attr('viewBox'));*/
		$.cookie('download', 'toto');
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

		  $('#export-form').submit(function () {
		      blockUIForDownload();
		  });
	});
	var fileDownloadCheckTimer;
	  function blockUIForDownload() {
		$("#export-dialog").block();
	    fileDownloadCheckTimer = window.setInterval(function () {
	      var cookieValue = $.cookie('download');
	      if (cookieValue == token)
	       finishDownload();
	    }, 1000);
	  }

	function finishDownload() {
		  window.clearInterval(fileDownloadCheckTimer);
		  $.cookie('download', null); //clears this cookie value
		  $("#export-dialog").unblock();
		  $('#export-dialog').jqxWindow('close');
	}
</script>
