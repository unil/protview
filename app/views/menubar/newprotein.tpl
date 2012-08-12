<div id="new-protein-dialog">
	<div>New protein</div>
	<div>
	<div style="display: block;" class="alert alert-error">
            <strong>Ooops!</strong> You did not pass the validation.
          </div>
	In order to create a new protein, please enter name bellow.
	<form id="protein-form" class="form-horizontal">
	<div class="control-group">
		<label class="control-label" for="protein.name" id="protein-name-label">Name</label>
		<div class="controls">
			<input type="text" name="protein-name" id="protein-name" class="input-large required"
				value="" />
		</div>
	</div>
 	<div class="form-actions">
		<button class="btn btn-primary" id="protein-form-submit">Save</button>
	</div>

</form>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		  $('#new-protein-dialog').jqxWindow({ 
			  theme: Application.THEME, 
			  width: 400,
              height: 200, 
              resizable: false,
              isModal: true
          });
		  $('#new-protein-dialog').bind('closed', function (event) {
			  //cleaning dom
			  $('#new-protein-dialog').remove();
			  $('.jqx-window-modal ').remove();
			  }
		  );
	});
</script>