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