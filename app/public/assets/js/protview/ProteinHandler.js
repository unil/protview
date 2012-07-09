var aaSize = 9;
var prot = new Array();

/**
 * Draws an amino acid element 
 * <group>
 * 	<circle>
 *  <text>Label</text>
 *  <text>Position</text>
 * <group>
 * 
 * @param svg
 * @param x
 * @param y
 * @param size
 * @param label
 * @param pos
 */
function drawAminoAcid(svg, x, y, size, label, pos) {
	g = svg.group({
		id : 'aa-' + pos,
		class_: 'aa',
		/* bug fix for translation start position bug
		 * as draggable is based on html dom
		 */
		style : 'position: relative; left: ' + x + 'px; top:' + y + 'px;',
		transform: 'translate(' + x + ',' + y + ')'
	});
	
	svg.circle(g, 0, 0, size, {
		id: 'aa-1-cercle'
	});
	
	svg.text(g, -2, -2, label, {
		id : 'aa-1-text'
	});
	svg.text(g, -2, 6, pos, {
		class_: 'seq_num'
	});
}

/**
 * Adds drag and drop support to an SVG Element
 * 
 * @param svgElement
 */
function addDragSupport(svgElement) {
	if (svgElement != null) {
		svgElement
		  	.draggable({
			  //sets cursor position relative to elements size
			  cursorAt: { 
				  top: aaSize, 
				  left: aaSize 
				  }
		  	})
		  	.bind('drag', function(event, ui){
		  		// update coordinates manually, since top/left style props don't work on SVG
		  		event.target.setAttribute('transform', 'translate(' + ui.position.left + ',' + ui.position.top + ')');
		  	});
	}
}



function draw(svg) {
	for (var i = 0; i < prot.length; i++) {
		x = prot[i]['x'];
		y = prot[i]['y'];
		drawAminoAcid(svg, x, y, aaSize, 'L', '' + (i+1));
	}
	
	addDragSupport($('.aa'));
	

}
function send(method) {
	$.ajax({
		type : method,
		url : "api/protview/",
		dataType: "json",
		data : {
			"id" : "12",
			"example" : "adsf"
		},
		success : function(msg) {
			prot = msg['graph']['coords']['aa'];
			$('#protein').svg({
				//loadURL: 'protein.svg',
				onLoad: draw
			});

		}
	});
}

$(document).ready(function() {
	send('get');
});