ProtView.Application.MenubarView = Backbone.View.extend({
	el : '#menubar',
	events : {
		'click #file-new-protein' : 'newProtein',
		'click #file-open-representation' : 'openRepresentation',
		'click #show-drawboard' : 'showDrawboard',
		'click #show-sidebar' : 'showSidebar'
	},
	newProtein : function() {
		console.log('newProtein');
		var url = Application.ROOTPATH + 'raw/menubar/do/newprotein';
		this.load(url, '#application-items');
	},
	showDrawboard : function() {
		ProtView.Application.Sandbox.start('drawboard', '#drawingBoard');
	},
	showSidebar : function() {
		ProtView.Application.Sandbox.start('sidebar', '#sidebar');
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