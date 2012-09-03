ProtView.Application.MenubarView = Backbone.View.extend({
	el : '#menubar',
	events : {
		'click #file-new-protein' : 'newProtein',
		'click #file-open-representation' : 'openRepresentation',
		'click #show-drawboard' : 'showDrawboard',
		'click #show-sidebar' : 'showSidebar',
		'click #file-save-representation' : 'saveRepresentation'
	},
	newProtein : function() {
		console.log('newProtein');
		var url = Application.ROOTPATH + 'raw/menubar/do/newprotein';
		this.load(url, '#application-items');
	},
	showDrawboard : function() {
		ProtView.Application.Sandbox.start('drawboard', '#drawingBoard');
		//hack to not open sidebar twice, should be done via message
		$('#show-drawboard').attr('id', 'show-drawboard-open');
	},
	showSidebar : function() {
		ProtView.Application.Sandbox.start('sidebar', '#sidebar');
		//hack to not open sidebar twice, should be done via message
		$('#show-sidebar').attr('id', 'show-sidebar-open');
	},
	saveRepresentation : function() {
		ProtView.Application.Sandbox.publish('/drawboard/save');
	},
	openRepresentation : function() {
		var url = Application.ROOTPATH + 'raw/menubar/do/openrepresentation';
		this.load(url, '#application-items');
	},
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