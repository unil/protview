/**
 * 
 * Handles and shows Toolbar
 * 
 * 
 * @module DrawBoard
 * @namespace DrawBoard.View
 * @class ToolbarView
 * @extends Backbone.View
 * 
 * @author Stefan Meier
 * @version 20120903
 * 
 */
ProtView.DrawBoard.View.ToolbarView = Backbone.View.extend({
	/**
	* Contains View's main Dom-Element
	*
	* @property el
	* @type String
	* @default #toolbar
	**/
	el : '#toolbar',
	events : {
		/**
		 * @event click #drawboad-show-representation
		 */
		'click #drawboad-show-representation' : 'showRepresentation',
		/**
		 * @event click #drawboard-export-png
		 */
		'click #drawboard-export-png' : 'exportFile'
	},
	/**
	 * Calls DrawBoardController (server-side)
	 * 
	 * @method exportFile
	 */
	exportFile : function() {		
		var url = Application.ROOTPATH + 'raw/drawboard/do/exportDialog';
		$.ajax({
			type : 'post',
			url : url,
			dataType : 'html',
			data : {
				css : 'protein.css'
			},
			success : function(data) {
				$('#application-items').append(data);
			}
		});
	},
	/**
	 * Calls /drawboard/show
	 * 
	 * @method showRepresentation
	 */
	showRepresentation: function() {
		ProtView.Application.Sandbox.publish("/drawboard/show", ['drawboard', Application.CONTEXT.getRepresentation()]);
	}
});