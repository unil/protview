ProtView.DrawBoard.Utils.Drawing = Class.extend( {
	svg : null,
	//fixme, this attribute should not be at this place
	aaSize : 10,
	init: function(svg) {
		this.svg = svg;
	},
	paint : function(collection, params) {

		var self = this;
		
	    if (params.dimension != null) {
	    	var dimension = params.dimension;
	    	var minX = dimension.minX,
	    	maxX = dimension.maxX,
	    	minY = dimension.minY,
	    	maxY = dimension.maxY;
	    	var width = maxX - minX,
	    	height = maxY - minY;
	    	
	    	if (params.membrane != null) {
	    		var membrane = params.membrane;
	    		self.drawMembrane(minX, maxX, membrane.minY, membrane.maxY);
	    	}

	    	self.svg.configure({viewBox: minX + ' ' + minY + ' ' + width + ' ' + height});
	    }
		
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
	clearAll : function() {
		this.svg.clear();
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
		var g = svg.group({
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
		svg.text(g, -4, 6, pos, {
			id : 'aa-' + pos + '-seq_num',
			class_: 'seq_num'
		});
	},
	/**
	 * Draws the membrane of the current protein
	 * 
	 * @param minX
	 * @param maxX
	 * @param minY
	 * @param maxY
	 */
	drawMembrane : function(minX, maxX, minY, maxY) {
		var svg = this.svg;
		var g = svg.group({
			id : 'membrane'
		});

		svg.line(g, minX, minY, maxX, minY, {strokeWidth: 2, id : 'membrane-bottom'});
		svg.line(g, minX, ((maxY+minY)/2), maxX, ((maxY+minY)/2), {strokeWidth: (maxY-minY), id : 'membrane-center'});
		svg.line(g, minX, maxY, maxX, maxY, {strokeWidth: 2, id : 'membrane-top'});
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
			  	})
			  	//this event should not be handled here
				.bind('mousedown', function (event) {
	                var rightclick = false;
                    if (!event) event = window.event;
                    if (event.which) rightclick = (event.which == 3);
                    else if (event.button) rightclick = (event.button == 2);
	                
	                if (rightclick) {
	                    var scrollTop = $(window).scrollTop();
	                    var scrollLeft = $(window).scrollLeft();
	                    var contextMenu = $("#drawBoardContextMenu").jqxMenu({ width: '120px', height: '140px', autoOpenPopup: false, mode: 'popup', theme: Application.THEME });
	                    contextMenu.jqxMenu('open', parseInt(event.clientX) + 5 + scrollLeft, parseInt(event.clientY) + 5 + scrollTop);
	                    return false;
	                }
	            });
		}
	},
});
