ProtView.Utils.Drawing = Class.extend( {
	svg : null,
	init: function(svg) {
		this.svg = svg;
	},
	draw : function(collection) {
	    for (var i = 0, len = collection.length; i < len; i++) {
	        var geometry = collection.at(i);

	        var coordinates = geometry.get('coordinates');
			var labels = geometry.get('labels');
			

			for (var j = 0, lenC = coordinates.length; j < lenC; j++) {
				var coordinate = coordinates[j];
				var label = labels[j].split("-");
				var x = coordinate.x;
				var y = coordinate.y;
				
				var type = label[0];
				var pos = label[1];
					
				console.log('x: ' + x);
				console.log('y: ' + y);
				console.log('type: ' + type);
				console.log('pos: ' + pos);
			}
		}
	}
});
