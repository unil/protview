
(function() {
	var scriptName = "BootStrap.js";
	var jsFiles = [
	               	"ProtView/ProtView.js",
	                "ProtView/Global.js",
	                "ProtView/Graphic.js",
	                ];

	
	/**
     * Namespace: OpenLayers
     * The OpenLayers object provides a namespace for all things OpenLayers
     */
    var scriptLocation  = 
        /**
         * Method: _getScriptLocation
         * Return the path to this script. This is also implemented in
         * OpenLayers/SingleFile.js
         *
         * Returns:
         * {String} Path to this script
         */
         function() {
            var r = new RegExp("(^|(.*?\\/))(" + scriptName + ")(\\?|$)"),
                s = document.getElementsByTagName('script'),
                src, m, l = "";
            for(var i=0; i<s.length; i++) {	
                src = s[i].getAttribute('src');
                if(src) {
                    m = src.match(r);
                    if(m) {
                        l = m[1];
                        break;
                    }
                }
            }
            return l;
        }();
        
    var path = scriptLocation;    
	
	var scriptTags = new Array(jsFiles.length);
	for (var i=0, len=jsFiles.length; i<len; i++) {
        scriptTags[i] = "<script src='" + path + jsFiles[i] +
                               "'></script>"; 
    }
    if (scriptTags.length > 0) {
        document.write(scriptTags.join(""));
    }
	
})();