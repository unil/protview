<div id="new-protein-dialog">
	<div>New protein</div>
	<div>
	<!--  <div style="display: block;" class="alert alert-error">
            <strong>Ooops!</strong> You did not pass the validation.
          </div>-->
	In order to create a new protein, please enter name bellow.
	<form id="new-protein-form" class="form-horizontal">
	 <script type="text/template" id="new-protein-form-template">
	<div class="control-group">
		<label class="control-label" for="new-protein-name" id="new-protein-name-label">Name</label>
		<div class="controls">
			<input type="text" name="new-protein-name" id="new-protein-name" class="input-large required"
				value="" />
		</div>
	</div>
 	<div class="form-actions">
		<button class="btn btn-primary" id="new-protein-form-submit">Save</button>
	</div>
</script>
</form>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		  $('#new-protein-dialog').jqxWindow({ 
			  theme: Application.THEME, 
			  width: 400,
              height: 180, 
              resizable: false,
              isModal: true
          });
		  $('#new-protein-dialog').bind('closed', function (event) {
			  ProtView.Application.Sandbox.publish("/structure/hide", ['protein-new']);
		  });
		  ProtView.Application.Sandbox.publish("/structure/show", ['protein-new']);
	});
</script>