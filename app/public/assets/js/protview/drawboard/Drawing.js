ProtView.Utils.Drawing = Class.extend( {
	svg : null,
	//fixme, this attribute should not at this place
	aaSize : 12,
	init: function(svg) {
		this.svg = svg;
	},
	paint : function(collection) {
		var self = this;
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
					
				self.drawAminoAcid(x, y, self.aaSize, type, pos);
			}
		}
	    self.addDragSupport($('.aa'));
	},
	/**
	 * Draws an amino acid element <group> <circle> <text>Label</text>
	 * <text>Position</text> <group>
	 * 
	 * @param svg
	 * @param x
	 * @param y
	 * @param size
	 * @param label
	 * @param pos
	 */
	drawAminoAcid : function (x, y, size, label, pos) {
		var svg = this.svg;
		g = svg.group({
			id : 'aa-' + pos,
			class_: 'aa',
			/*
			 * bug fix for translation start position bug as draggable is based on
			 * html dom
			 */
			style : 'position: relative; left: ' + x + 'px; top:' + y + 'px;',
			transform: 'translate(' + x + ',' + y + ')'
		});

		svg.circle(g, 0, 0, size, {
			id: 'aa-' + pos + '-cercle'
		});

		svg.text(g, -4, 0, label, {
			id : 'aa-' + pos + '-text'
		});
		svg.text(g, 0, 6, pos, {
			id : 'aa-' + pos + '-seq_num',
			class_: 'seq_num'
		});
	},

	/**
	 * Adds drag and drop support to an SVG Element
	 * 
	 * @param svgElement
	 */
	addDragSupport : function (svgElement) {
		var self = this;
		if (svgElement != null) {
			svgElement
			  	.draggable({
				  // sets cursor position relative to elements size
				  cursorAt: { 
					  top: self.aaSize, 
					  left: self.aaSize 
					  }
			  	})
			  	.bind('drag', function(event, ui){
			  		// update coordinates manually, since top/left style props don't
					// work on SVG
			  		event.target.setAttribute('transform', 'translate(' + ui.position.left + ',' + ui.position.top + ')');
			  	});
		}
	},
});
