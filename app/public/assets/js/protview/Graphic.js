/**
 * Requires ProtView.js, Global.js
 */

ProtView.Graphic = {
	svg : null,

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
	drawAminoAcid : function (svg, x, y, size, label, pos) {
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
		if (svgElement != null) {
			svgElement
			  	.draggable({
				  // sets cursor position relative to elements size
				  cursorAt: { 
					  top: ProtView.Global.aaSize, 
					  left: ProtView.Global.aaSize 
					  }
			  	})
			  	.bind('drag', function(event, ui){
			  		// update coordinates manually, since top/left style props don't
					// work on SVG
			  		event.target.setAttribute('transform', 'translate(' + ui.position.left + ',' + ui.position.top + ')');
			  	});
		}
	},

	save : function (svg) {
		svg.toSVG();
	},
	
	
	
	draw : function (svg) {
		graph = ProtView.Global.prot['graph']['coords']['aa'];
		struct = ProtView.Global.prot['struct'];
		for (var i = 0; i < graph.length; i++) {
			x = graph[i]['x'];
			y = graph[i]['y'];
			ref = graph[i]['ref'];
			subunit = ref['subunit'];
			peptide = ref['peptide'];
			seq = ref['seq'];
			label = struct['peptide'][peptide-1]['seq'].charAt(seq);
			ProtView.Graphic.drawAminoAcid(svg, x, y, ProtView.Global.aaSize, label, '' + seq);
		}
		
		ProtView.Graphic.addDragSupport($('.aa'));
		
	
	},
	
	init : function (msg) {
		ProtView.Global.prot = msg;
		// prot = msg['graph']['coords']['aa'];
		$('#protein').svg({
			// loadURL: 'protein.svg',
			onLoad: ProtView.Graphic.draw, 
			settings: {
				width : "800px",
				height : "800px", 
				xmlns : "http://www.w3.org/2000/svg",
				style : "display:inline; float: left; z-index: 1;"
			}
		});
	}
};