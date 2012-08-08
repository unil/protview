 /*Backbone.Model.prototype.parse = function(resp, xhr) {
	 return resp.items;	
 };
 */
Backbone.Collection.prototype.parse = function(resp, xhr) {
	 return resp.items;	
};