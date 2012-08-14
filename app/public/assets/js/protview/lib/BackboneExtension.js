Backbone.Model.prototype._super = function(funcName){
  return this.constructor.__super__[funcName].apply(this, _.rest(arguments));
};
Backbone.View.prototype._super = function(funcName){
	  return this.constructor.__super__[funcName].apply(this, _.rest(arguments));
};
Backbone.Model.prototype.parse = function(resp, xhr) {
	if (resp.items)
		return resp.items[0];
	else
		return resp;
};
Backbone.Collection.prototype.parse = function(resp, xhr) {
	if (resp.items)
		return resp.items;
	else
		return resp;
};
//overwrite mapping for xfm (exchange PUT and POST)
var methodMap = {
	'create' : 'PUT',
	'update' : 'POST',
	'delete' : 'DELETE',
	'read' : 'GET'
};
var getValue = function(object, prop) {
    if (!(object && object[prop])) return null;
    return _.isFunction(object[prop]) ? object[prop]() : object[prop];
  };
Backbone.sync = function(method, model, options) {
	var type = methodMap[method];
	options || (options = {});

	var params = {
		type : type,
		dataType : 'json'
	};

	if (!options.url) {
		params.url = getValue(model, 'url') || urlError();
	}

	if (!options.data && model && (method == 'create' || method == 'update')) {
		params.contentType = 'application/json';
		//overwrite for xfm
		var data =  {items: model.toJSON()};
		params.data = JSON.stringify(data);
	}

	if (Backbone.emulateJSON) {
		params.contentType = 'application/x-www-form-urlencoded';
		params.data = params.data ? {
			model : params.data
		} : {};
	}

	if (Backbone.emulateHTTP) {
		if (type === 'PUT' || type === 'DELETE') {
			if (Backbone.emulateJSON)
				params.data._method = type;
			params.type = 'POST';
			params.beforeSend = function(xhr) {
				xhr.setRequestHeader('X-HTTP-Method-Override', type);
			};
		}
	}

	if (params.type !== 'GET' && !Backbone.emulateJSON) {
		params.processData = false;
	}

	return $.ajax(_.extend(params, options));
};