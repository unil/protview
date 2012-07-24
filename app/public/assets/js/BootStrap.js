/**
 * @author Stefan Meier
 * @version 2012.07.10
 * 
 * inspired by https://github.com/openlayers/
 */
(function() {
	var scriptName = "BootStrap.js";
	var jsFiles = [
	               	"protview/ProtView.js",
	                "protview/Global.js",
	                "protview/Network.js",
	                "protview/Graphic.js",
	                ];

	
    var scriptLocation  = 
        /**
         * Returns the path to this script. 
         *
         * @return string
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