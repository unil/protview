ProtView.Application.Sandbox = (function() {
	var server = function(action, el) {
		var method = 'post',
		url = Application.ROOTPATH + 'raw/application/do/';
		$.ajax({
			type : method,
			url : url,
			dataType : 'html',
			data : {
				xaction: action
			},
			success : function(data) {
				console.log('ProtView.Application.Sandbox.Server: ' + action + ' OK');
				$(el).append(data);
			}
		});
	},
	load = function (module, el) {
		var action = null;
		switch(module) {
			case 'drawboard' :
				action = 'startDrawboard';
				break;
			case 'sidebar' :
				action = 'startSidebar';
				break;
			case 'structure' :
				action = 'startStructure';
				break;
		}
		if (action != null)
			server(action, el);
		else
			console.log('ProtView.Application.Sandbox.Load: module "' + module + '" does not exist.');
	},
	unload = function(module) {
		
	};
	return {
		start : function(module, el) {
			load(module, el);
		},
		stop : function (module) {
			unload(module);
		}
	};
}());