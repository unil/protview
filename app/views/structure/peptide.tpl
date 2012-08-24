<form id="peptide-form" class="form-horizontal">
	<div id="peptide-form-insert">
		<script type="text/template" id="peptide-form-template">

	<div class="control-group">
		<label class="control-label" for="peptide-sequence" id="peptide-sequence-label">Sequence</label>
		<div class="controls">
			<textarea name="peptide-sequence" id="peptide-sequence" class="input-large required"
				rows="5"><%= sequence %></textarea>
		</div>
	</div>
	<div class="control-group">
		<label for="peptide-terminus-n" id="peptide-terminus-n-label" class="control-label">Terminus</label>
		<div class="controls">
			N : <select name="peptide-terminus-n" id="peptide-terminus-n" class="input-small">
				<option value="intra" <% if(terminusN=='intra') { %>
								selected="selected"
								<% } %>>
				Inside</option>
				<option value="extra"<% if(terminusN=='extra') { %>
								selected="selected"
								<% } %>>Outside</option>
			</select> C : <select name="peptide-terminus-c" id="peptide-terminus-c"
				class="input-small">
				<option value="intra" <% if(terminusC=='intra') { %>
								selected="selected"
								<% } %>>Inside</option>
				<option value="extra" <% if(terminusC=='extra') { %>
								selected="selected"
								<% } %>>Outside</option>
			</select>
		</div>
	</div>
	</script>
	</div>
	<div class="form-actions">
		<button class="btn btn-primary" type="submit" id="peptide-form-submit">Save
			changes</button>
		<button class="btn">Cancel</button>
	</div>
</form>
<script type="text/javascript">
	$(document).ready(function() {
		ProtView.Application.Sandbox.publish("/structure/show", ['peptide', Application.CONTEXT.getProtein()]);		
	});
</script>
