/**
 * 
 * Menubar View
 * 
 * Handles the main application menubar
 * 
 * 
 * @module Application
 * @namespace Application
 * @extends Backbone.View
 * @class MenuBarView
 * 
 * @author Stefan Meier
 * @version 20120903
 * 
 */
ProtView.Application.MenubarView = Backbone.View.extend({
	/**
	* Contains View's main Dom-Element
	*
	* @property el
	* @type String
	* @default #menubar
	**/
	el : '#menubar',
	events : {
		/**
		 * @event click #file-new-protein:newProtein
		 */  
		'click #file-new-protein' : 'newProtein',
		/**
		 * @event click #file-open-representation:openRepresentation
		 */
		'click #file-open-representation' : 'openRepresentation',
		/**
		 * @event click #show-drawboard:showDrawboard
		 */
		'click #show-drawboard' : 'showDrawboard',
		/**
		 * @event click #show-sidebar:showSidebar
		 */
		'click #show-sidebar' : 'showSidebar',
		/**
		 * @event click #file-save-representation:saveRepresentation
		 */
		'click #file-save-representation' : 'saveRepresentation'
	},
	/**
	 * Shows newProtein Dialog
	 * 
	 * @method newProtein
	 */
	newProtein : function() {
		var url = Application.ROOTPATH + 'raw/menubar/do/newprotein';
		this.load(url, '#application-items');
	},
	/**
	 * Shows drawboard
	 * 
	 * @method showDrawBoard
	 */
	showDrawboard : function() {
		ProtView.Application.Sandbox.start('drawboard', '#drawingBoard');
		//hack to not open sidebar twice, should be done via message
		$('#show-drawboard').attr('id', 'show-drawboard-open');
	},
	/**
	 * Shows Sidbear
	 * 
	 * @method showSidebar
	 */
	showSidebar : function() {
		ProtView.Application.Sandbox.start('sidebar', '#sidebar');
		//hack to not open sidebar twice, should be done via message
		$('#show-sidebar').attr('id', 'show-sidebar-open');
	},
	/**
	 * Shows Saves current work
	 * @method saveRepresentation
	 */
	saveRepresentation : function() {
		ProtView.Application.Sandbox.publish('/drawboard/save');
	},
	/**
	 * Shows Open Representation dialog
	 * 
	 * @method openRepresentation
	 */
	openRepresentation : function() {
		var url = Application.ROOTPATH + 'raw/menubar/do/openrepresentation';
		this.load(url, '#application-items');
	},
	/**
	 * Loads resource
	 * 
	 * Loaded resource is appended to domElement
	 * 
	 * @param url
	 * @param domElement
	 * @method laod
	 */
	load : function(url, el) {
		var method = 'get';
		$.ajax({
			type : method,
			url : url,
			dataType : 'html',
			data : {

			},
			success : function(msg) {
				$(el).append(msg);
			}
		});
	}
});