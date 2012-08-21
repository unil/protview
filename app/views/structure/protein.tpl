<form id="protein-form" class="form-horizontal">
 <script type="text/template" id="protein-form-template">
	<div class="control-group">
		<label class="control-label" for="protein.name" id="protein-name-label">Name</label>
		<div class="controls">
			<input type="text" name="protein-name" id="protein-name" class="input-large required"
				value="<%= name %>" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="protein-species" id="protein-species-label">Species</label>
		<div class="controls">
			<input type="text" name="protein-species" id="protein-species" class="input-large required"
				value="<%= species %>" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="protein-note" id="protein-note-label">Note</label>
		<div class="controls">
			<textarea name="protein-note" id="protein-note" class="input-large required"
				rows="5"><%= note %></textarea>
		</div>
	</div>
 	<div class="form-actions">
		<button class="btn btn-primary" id="protein-form-submit">Save changes</button>
		<button class="btn">Cancel</button>
	</div>
</script>

</form>

<script type="text/javascript">
	$(document).ready(function() {
		ProtView.Application.Sandbox.publish("/structure/show", ['protein', Application.PROTEIN]);		
	});
</script>
