/*
jQWidgets v2.2.1 (2012-June-18)
Copyright (c) 2011-2012 jQWidgets.
License: http://jqwidgets.com/license/
*/

(function(a){a.jqx.dataview.grouping=function(){this.loadgrouprecords=function(y,J,H,r,d,D,p,u,v){var E=y;var A=this;var f=new Array();for(iGroupColumn=0;iGroupColumn<A.groups.length;iGroupColumn++){f[iGroupColumn]=A.generatekey()}var o=new Array();var h=0;var f=f;var g=new Array();var C=J;var L=J;var n=A.groups.length;this.loadedrecords=new Array();this.bounditems=new Array();this.loadedrecords=new Array();this.loadedrootgroups=new Array();this.loadedgroups=new Array();this.loadedgroupsByKey=new Array();this.sortedgroups=new Array();var k=this.sortdata!=null;var I=k?this.sortdata:this.records;for(obj=J;obj<H;obj++){var G={};if(!k){G=a.extend({},I[obj])}else{G=a.extend({},I[obj].value)}id=G[A.uniqueId];if(d>=u||id!=p[d][A.uniqueId]||(D&&D[id])){v[v.length]=d}var e=new Array();var x=0;for(iGroupColumn=0;iGroupColumn<n;iGroupColumn++){var l=A.groups[iGroupColumn];var B=G[l];if(null==B){continue}e[x++]={value:B,hash:f[iGroupColumn]}}if(e.length!=n){break}var z=null;var s="";var c=-1;for(q=0;q<e.length;q++){c++;var F=e[q].value;var j=e[q].hash;s=s+"_"+j+"_"+F;if(g[s]!=undefined&&g[s]!=null){z=g[s];continue}if(z==null){z={group:F,subItems:new Array(),subGroups:new Array(),level:0};o[h++]=z;z.uniqueid=A.generatekey();A.loadedgroupsByKey[F]=z}else{var t={group:F,subItems:new Array(),subGroups:new Array(),parentItem:z,level:z.level+1};A.loadedgroupsByKey[z.uniqueid+"_"+F]=t;t.uniqueid=A.generatekey();z.subGroups[z.subGroups.length++]=t;z=t}g[s]=z}if(z!=null){if(!G.uid){G.uid=this.getid(this.source.id,G,C)}if(!k){G.boundindex=C;this.recordsbyid["id"+G.uid]=I[obj]}else{G.boundindex=I[obj].index;this.recordsbyid["id"+G.uid]=I[obj].value}this.bounditems[G.boundindex]=G;this.sortedgroups[C]=G;G.uniqueid=A.generatekey();G.parentItem=z;G.level=z.level+1;z.subItems[z.subItems.length++]=G}else{if(!G.uid){G.uid=this.getid(this.source.id,G,C)}if(!k){G.boundindex=C;this.recordsbyid["id"+G.uid]=I[obj]}else{G.boundindex=I[obj].index;this.recordsbyid["id"+G.uid]=I[obj].value}this.sortedgroups[C]=G;this.bounditems[G.boundindex]=G;G.uniqueid=A.generatekey()}d++;C++;L++}var w=function(M,N,O){for(m=0;m<N.subItems.length;m++){N.subItems[m].visibleindex=y+O;M.rows[O]=N.subItems[m];M.loadedrecords[O]=N.subItems[m];O++}return O};var b=function(M,O,P){for(subGroup in O.subGroups){var N=O.subGroups[subGroup];if(N.subGroups){M.loadedgroups[M.loadedgroups.length]=N;N.visibleindex=y+P;M.rows[P]=N;M.loadedrecords[P]=N;P++;if(N.subGroups.length>0){P=b(M,N,P)}else{if(N.subItems.length>0){P=w(M,N,P)}}}}if(O.subItems.length>0){P=w(M,O,P)}return P};var K=o.length;this.loadedgroups=new Array();this.rows=new Array();var E=0;for(C=0;C<K;C++){var l=o[C];this.loadedrootgroups[C]=l;this.loadedgroups[this.loadedgroups.length]=l;l.visibleindex=y+E;this.rows[E]=l;this.loadedrecords[E]=l;E++;E=b(this,l,E)}return E};this._updategroupsinpage=function(A,r,I,d,u,j,f){var p=new Array();var v=[];if(this.groupable&&this.groups.length>0){var z=0;var h=new Array();var g=new Array();for(iGroupColumn=0;iGroupColumn<A.groups.length;iGroupColumn++){g[iGroupColumn]=A.generatekey()}var D=0;var o=new Array();var k=0;if(f>this.totalrecords){f=this.totalrecords}for(obj=j;obj<f;obj++){var F=a.extend({},A.sortedgroups[obj]);id=F[A.uniqueId];if(!A.pagesize||(I>=A.pagesize*A.pagenum&&I<A.pagesize*(A.pagenum+1))){if(d>=u||id!=p[d][A.uniqueId]||(updated&&updated[id])){v[v.length]=d}var e=new Array();var x=0;for(iGroupColumn=0;iGroupColumn<A.groups.length;iGroupColumn++){var n=A.groups[iGroupColumn];var B=F[n];if(null==B){continue}e[x++]={value:B,hash:g[iGroupColumn]}}if(e.length!=A.groups.length){break}var y=null;var s="";var c=-1;for(q=0;q<e.length;q++){c++;var E=e[q].value;var l=e[q].hash;s=s+"_"+l+"_"+E;if(h[s]!=undefined&&h[s]!=null){y=h[s];continue}if(y==null){y={group:E,subItems:new Array(),subGroups:new Array(),level:0};o[k++]=y;var C=A.loadedgroupsByKey[E];y.visibleindex=C.visibleindex;y.uniqueid=C.uniqueid}else{var t={group:E,subItems:new Array(),subGroups:new Array(),parentItem:y,level:y.level+1};var C=A.loadedgroupsByKey[y.uniqueid+"_"+E];t.visibleindex=C.visibleindex;t.uniqueid=C.uniqueid;y.subGroups[y.subGroups.length++]=t;y=t}h[s]=y}if(y!=null){F.parentItem=y;F.level=y.level+1;y.subItems[y.subItems.length++]=F}d++}D++;I++}var w=function(K,L,J){for(m=0;m<L.subItems.length;m++){p[J]=a.extend({},L.subItems[m]);J++}return J};var G=function(M){var K=false;for(subGroup in M.subGroups){var L=M.subGroups[subGroup];if(L.subGroups){if(L.subGroups.length>0){var J=G(L);if(J){K=true;return true}}if(L.subItems.length>0){K=true;return true}}}if(M.subItems.length>0){K=true;return true}return K};var b=function(K,M,J){for(subGroup in M.subGroups){var L=M.subGroups[subGroup];if(L.subGroups){if(G(L)){p[J]=L;J++;if(L.subGroups.length>0){J=b(K,L,J)}else{if(L.subItems.length>0){J=w(K,L,J)}}}}}if(M.subItems.length>0){J=w(K,M,J)}return J};var H=0;for(D=0;D<o.length;D++){var n=o[D];if(G(n)){p[z]=n;z++;z=b(this,n,z)}}}return p}};a.extend(a.jqx._jqxGrid.prototype,{_initgroupsheader:function(){this.groupsheader.css("visibility","hidden");if(this._groupsheader()){this.groupsheader.css("visibility","inherit");var e=this;var c=this.gridlocalization.groupsheaderstring;this.groupsheaderdiv=this.groupsheaderdiv||a('<div style="width: 100%; position: relative;"></div>');this.groupsheaderdiv.height(this.groupsheaderheight);this.groupsheaderdiv.css("top",0);this.groupsheader.append(this.groupsheaderdiv);this.groupheadersbounds=new Array();var d=this.groups.length;this.groupsheaderdiv.children().remove();this.groupsheaderdiv[0].innerHTML="";var b=new Array();if(d>0){a.each(this.groups,function(j){var o=this;var n=e._getColumnText(this);var l=e._rendergroupcolumn(n,o);l.addClass(e.toThemeProperty("jqx-grid-group-column"));e.groupsheaderdiv.append(l);if(e.closeablegroups){var k=a(l.find(".icon-close"));e.addHandler(k,"click",function(){e.removegroupat(j);return false})}if(e.sortable){e.addHandler(l,"click",function(){var p=e.getcolumn(o);if(p!=null){e._togglesort(p)}return false})}b[b.length]=l;e._handlegroupstocolumnsdragdrop(this,l);if(j<d-1){var g=l.height();var h=a('<div style="float: left; position: relative;"></div>');h.width(e.groupindentwidth/3);h.height(1);h.css("top",g/2);h.addClass(e.toThemeProperty("jqx-grid-group-column-line"));e.groupsheaderdiv.append(h)}})}else{var f=a('<div style="position: relative;">'+c+"</div>");this.groupsheaderdiv.append(f)}this._groupheaders=b;this._updategroupheadersbounds()}},_updategroupheadersbounds:function(){var c=this;var b=this.groupsheaderdiv.children().outerHeight();var d=(this.groupsheader.height()-b)/2;this.groupsheaderdiv.css("top",d);this.groupsheaderdiv.css("left",d);a.each(this._groupheaders,function(f){var e=this.offset();c.groupheadersbounds[f]={left:e.left,top:e.top,width:this.outerWidth(),height:this.outerHeight(),index:f}})},addgroup:function(c){if(c){var b=this;b.groups[b.groups.length]=c;b.refreshdata();this._raiseEvent(12,{type:"Add"})}},insertgroup:function(d,c){if(d!=undefined&&d!=null&&d>=0&&d<=this.groups.length){if(c){var b=this;b.groups.splice(d,0,c);b.refreshdata();this._raiseEvent(12,{type:"Insert"})}}},_insertaftergroup:function(d,c){var b=this._getGroupIndexByDataField(d);this.insertgroup(b+1,c)},_insertbeforegroup:function(d,c){var b=this._getGroupIndexByDataField(d);this.insertgroup(b,c)},removegroupat:function(c){if(c>=0&&c!=null&&c!=undefined){var b=this;b.groups.splice(c,1);b.refreshdata();this._raiseEvent(12,{type:"Remove"});return true}return false},removegroup:function(c){if(c==null){return false}var b=this.groups.indexOf(c.toString());return this.removegroupat(b)},getrootgroupscount:function(){var b=this.dataview.loadedrootgroups.length;return b},collapsegroup:function(b){return this._setrootgroupstate(b,false)},expandgroup:function(b){return this._setrootgroupstate(b,true)},collapseallgroups:function(){this._setbatchgroupstate(false)},expandallgroups:function(){this._setbatchgroupstate(true)},getgroup:function(e){var k=this.dataview.loadedrootgroups[e];if(k==null){return null}var f=this.expandedgroups[k.uniqueid].expanded;var g=k.group;var b=k.level;var c=new Array();this._getsubgroups(c,k);var j=this;var d={group:g,level:b,expanded:f,subgroups:c};if(k.subItems){var h=new Array();a.each(k.subItems,function(){var l=this.boundindex;h[h.length]=j.getrowdata(l)});if(h.length>0){d.subrows=h}}return d},_getsubgroups:function(c,k){var j=this;for(obj in k.subGroups){var g=k.subGroups[obj];var e=j.expandedgroups[g.uniqueid].expanded;var f=g.group;var b=g.level;c[c.length]={group:f,level:b,expanded:e};if(g.subItems){var h=new Array();a.each(g.subItems,function(){var l=this.boundindex;h[h.length]=j.getrowdata(l)});c[c.length-1].subrows=h}if(g.subGroups){var d=new Array();j._getsubgroups(d,g)}}return c},_setbatchgroupstate:function(b){var c=this;for(obj in this.dataview.loadedrootgroups){c._setrootgroupstate(obj,b,false,true)}this.rendergridcontent(true);return true},_setrootgroupstate:function(d,b,e,c){if(d==undefined||d==null||d<0){return false}if(!this.groupable||this.groups.length==0){return false}var g=e!=undefined?e:true;if(d>=0&&d<this.dataview.loadedrootgroups.length){var f=this.dataview.loadedrootgroups[d];return this._setgroupstate(f,b,g,c)}return false},_togglegroupstate:function(c,d){if(c==null||c==undefined){return false}var b=this.expandedgroups[c.uniqueid];if(b==undefined){b=false}else{b=b.expanded}b=!b;return this._setgroupstate(c,b,d)},_setgroupstate:function(f,b,g,c){if(f==null||f==undefined){return false}var e=false;var d=this.expandedgroups[f.uniqueid];if(d==undefined){d={expanded:false};e=true}if(d.expanded!=b){e=true}if(e){this.expandedgroups[f.uniqueid]={expanded:b,group:f};this._setsubgroupsvisibility(this,f,!b,c);if(g){this.rendergridcontent(true,false)}if(undefined==this.suspendgroupevents||this.suspendgroupevents==false){if(b){this._raiseEvent(4,{group:f.group,parentgroup:f.parentItem?f.parentItem.group:null,level:f.level,visibleindex:f.visibleindex})}else{this._raiseEvent(5,{group:f.group,parentgroup:f.parentItem?f.parentItem.group:null,level:f.level,visibleindex:f.visibleindex})}}return true}return false},_setgroupitemsvisibility:function(b,d,c){for(m=0;m<d.subItems.length;m++){b._setrowvisibility(d.subItems[m].visibleindex,c,false)}},_setsubgroupsvisibility:function(c,g,f,d){if(g.parentItem!=null){if(this.hiddens[g.parentItem.visibleindex]){return}}else{if(g.parentItem==null){if(this.hiddens[g.visibleindex]){return}}}for(subGroup in g.subGroups){var e=g.subGroups[subGroup];if(!f){c._setrowvisibility(e.visibleindex,f,false)}var b=!f;if(!d){if(c.expandedgroups[e.uniqueid]==undefined){b=false}else{b=c.expandedgroups[e.uniqueid].expanded}}else{this.expandedgroups[e.uniqueid]={expanded:b,group:e}}if(e.subGroups){if(e.subGroups.length>0){c._setsubgroupsvisibility(c,e,!b||f,d)}else{if(e.subItems.length>0){c._setgroupitemsvisibility(c,e,!b||f)}}}if(f){c._setrowvisibility(e.visibleindex,f,false)}}if(g.subItems&&g.subItems.length>0){c._setgroupitemsvisibility(c,g,f)}},_handlecolumnsdragdrop:function(){var d=this;var g=-1;var c=false;if(!d.groupable){return}var f="mousemove.grouping"+this.element.id;var e="mousedown.grouping"+this.element.id;var h="mouseup.grouping"+this.element.id;var b=false;if(this.isTouchDevice()){b=true;f="touchmove.grouping"+this.element.id;e="touchstart.grouping"+this.element.id;h="touchend.grouping"+this.element.id}this.removeHandler(a(document),f);this.addHandler(a(document),f,function(k){if(d.dragcolumn!=null){var n=parseInt(k.pageX);var w=parseInt(k.pageY);if(b){var t=d.getTouches(k);var s=t[0];n=parseInt(s.pageX);w=parseInt(s.pageY)}var p=d.host.offset();var x=parseInt(p.left);var y=parseInt(p.top);if(d.dragmousedownoffset==undefined||d.dragmousedownoffset==null){d.dragmousedownoffset={left:0,top:0}}var v=parseInt(n)-parseInt(d.dragmousedownoffset.left);var j=parseInt(w)-parseInt(d.dragmousedownoffset.top);d.dragcolumn.css({left:v+"px",top:j+"px"});c=false;if(n>=x&&n<=x+d.host.width()){if(w>=y&&w<=y+d.host.height()){c=true}}g=-1;if(c){d.dragcolumnicon.removeClass(d.toThemeProperty("jqx-grid-dragcancel-icon"));d.dragcolumnicon.addClass(d.toThemeProperty("jqx-grid-drag-icon"));var u=d.groupsheader.offset();var o=u.top+d.groupsheader.height();var l=d.groups.indexOf(a.data(d.dragcolumn[0],"datarecord").toString());var r=(l==-1)||(d.groups.length>1&&l>-1);if(d.dropline!=null){if(w>=u.top&&w<=o){if(r){g=d._handlegroupdroplines(n)}}else{d.dropline.fadeOut("slow")}}}else{if(d.dropline!=null){d.dropline.fadeOut("slow")}d.dragcolumnicon.removeClass(d.toThemeProperty("jqx-grid-drag-icon"));d.dragcolumnicon.addClass(d.toThemeProperty("jqx-grid-dragcancel-icon"))}return false}});this.removeHandler(a(document),e);this.addHandler(a(document),e,function(j){a(document.body).addClass("jqx-disableselect")});this.removeHandler(a(document),h);this.addHandler(a(document),h,function(j){a(document.body).removeClass("jqx-disableselect");var o=parseInt(j.pageX);var v=parseInt(j.pageY);if(b){var s=d.getTouches(j);var r=s[0];o=parseInt(r.pageX);v=parseInt(r.pageY)}var p=d.host.offset();var w=parseInt(p.left);var x=parseInt(p.top);var l=d.groupsheader.height();d.dragstarted=false;d.dragmousedown=null;if(d.dragcolumn!=null){var n=a.data(d.dragcolumn[0],"datarecord");d.dragcolumn.remove();d.dragcolumn=null;if(n!=null){if(c){if(g!=-1){var t=g.index;var u=d.groups[t];var k=d._getGroupIndexByDataField(n);if(k!=t){if(k!=undefined&&k>=0){d.groups.splice(k,1)}if(g.position=="before"){d._insertbeforegroup(u,n)}else{d._insertaftergroup(u,n)}}}else{if(d.groups.length==0){if(v>x&&v<=x+l){d.addgroup(n)}}else{if(v>x+l){var k=d._getGroupIndexByDataField(n);d.removegroupat(k)}}}}if(d.dropline!=null){d.dropline.remove();d.dropline=null}}return false}})},_getGroupIndexByDataField:function(b){for(i=0;i<this.groups.length;i++){if(this.groups[i]==b){return i}}return -1},_isColumnInGroups:function(b){for(i=0;i<this.groups.length;i++){if(this.groups[i]==b){return true}}return false},_handlegroupdroplines:function(d){var b=this;var c=-1;a.each(b.groupheadersbounds,function(e){if(d<=this.left+this.width/2){var f=this.left-3;if(e>0){f=this.left-1-b.groupindentwidth/6}b.dropline.css("left",f);b.dropline.css("top",this.top);b.dropline.height(this.height);b.dropline.fadeIn("slow");c={index:e,position:"before"};return false}else{if(d>=this.left+this.width/2){b.dropline.css("left",1+this.left+this.width);b.dropline.css("top",this.top);b.dropline.height(this.height);b.dropline.fadeIn("slow");c={index:e,position:"after"}}}});return c},_handlegroupstocolumnsdragdrop:function(c,e){this.dragmousedown=null;this.dragmousedownoffset=null;this.dragstarted=false;this.dragcolumn=null;var f=this;var d;var h="mousedown";var g="mousemove";var b=false;if(this.isTouchDevice()){b=true;h="touchstart";g="touchmove"}else{this.addHandler(e,"dragstart",function(j){return false})}this.addHandler(e,h,function(j){var n=j.pageX;var l=j.pageY;f.dragmousedown={left:n,top:l};if(b){var k=f.getTouches(j);var p=k[0];n=p.pageX;l=p.pageY;f.dragmousedown={left:n,top:l}}var o=a(j.target).offset();f.dragmousedownoffset={left:parseInt(n)-parseInt(o.left),top:parseInt(l-o.top)}});this.addHandler(e,g,function(j){if(f.dragmousedown){d={left:j.pageX,top:j.pageY};if(b){var l=f.getTouches(j);var o=l[0];d={left:o.pageX,top:o.pageY}}if(!f.dragstarted&&f.dragcolumn==null){var k=Math.abs(d.left-f.dragmousedown.left);var n=Math.abs(d.top-f.dragmousedown.top);if(k>3||n>3){f._createdragcolumn(e,d,true);a.data(f.dragcolumn[0],"datarecord",c)}}}})},_createdragcolumn:function(c,e,g){var h=this;var f=e;h.dragcolumn=a("<div></div>");var k=c.clone();h.dragcolumn.css("z-index",999999);k.css("border-width","1px");k.css("opacity","0.4");var j=a(k.find("."+h.toThemeProperty("jqx-grid-column-menubutton")));if(j.length>0){j.css("display","none")}var b=a(k.find(".icon-close"));if(b.length>0){b.css("display","none")}h.dragcolumnicon=a('<div style="z-index: 9999; position: absolute; left: 100%; top: 50%; margin-left: -18px; margin-top: -7px;"></div>');h.dragcolumnicon.addClass(h.toThemeProperty("jqx-grid-drag-icon"));h.dragcolumn.css("float","left");h.dragcolumn.css("position","absolute");var d=h.host.offset();k.width(c.width()+16);h.dragcolumn.append(k);h.dragcolumn.height(c.height());h.dragcolumn.width(k.width());h.dragcolumn.append(h.dragcolumnicon);a(document.body).append(h.dragcolumn);k.css("margin-left",0);k.css("left",0);k.css("top",0);h.dragcolumn.css("left",f.left+h.dragmousedown.left);h.dragcolumn.css("top",f.top+h.dragmousedown.top);if(g!=undefined&&g){h.dropline=a('<div style="display: none; position: absolute;"></div>');h.dropline.width(2);h.dropline.addClass(h.toThemeProperty("jqx-grid-group-drag-line"));a(document.body).append(h.dropline)}},iscolumngroupable:function(b){return this._getcolumnproperty(b,"groupable")},_handlecolumnstogroupsdragdrop:function(c,f){this.dragmousedown=null;this.dragmousedownoffset=null;this.dragstarted=false;this.dragcolumn=null;var g=this;var e;var b=false;if(this.isTouchDevice()){b=true}var d="mousedown.drag";var e="mousemove.drag";if(b){d="touchstart.drag";e="touchmove.drag"}else{this.addHandler(f,"dragstart",function(h){return false})}this.addHandler(f,d,function(k){if(g._isColumnInGroups(c.datafield)){if(f.css("cursor")!="col-resize"){return false}else{return true}}var j=k.pageX;var h=k.pageY;if(b){var l=g.getTouches(k);var o=l[0];j=o.pageX;h=o.pageY}g.dragmousedown={left:j,top:h};var n=a(k.target).offset();g.dragmousedownoffset={left:parseInt(j)-parseInt(n.left),top:parseInt(h-n.top)}});this.addHandler(f,e,function(k){if(g._isColumnInGroups(c.datafield)){if(f.css("cursor")!="col-resize"){return false}else{return true}}if(g.dragmousedown){var j=k.pageX;var h=k.pageY;if(b){var n=g.getTouches(k);var p=n[0];j=p.pageX;h=p.pageY}e={left:j,top:h};if(!g.dragstarted&&g.dragcolumn==null){var l=Math.abs(e.left-g.dragmousedown.left);var o=Math.abs(e.top-g.dragmousedown.top);if(l>3||o>3){g._createdragcolumn(f,e,true);a.data(g.dragcolumn[0],"datarecord",c.datafield)}}}})},_rendergroupcolumn:function(f,g){var d=a('<div style="float: left; position: relative;"></div>');if(this.groupcolumnrenderer!=null){d[0].innerHTML=this.groupcolumnrenderer(f);d.addClass(this.toThemeProperty("jqx-grid-group-column"));d.addClass(this.toThemeProperty("jqx-fill-state-normal"))}if(this.closeablegroups){if(d[0].innerHTML==""){d[0].innerHTML='<a style="float: left;" href="#">'+f+"</a>"}var c='<div style="float: right; min-height: 16px; min-width: 18px;"><div style="position: absolute; left: 100%; top: 50%; margin-left: -18px; margin-top: -8px; float: none; width: 16px; height: 16px;" class="'+this.toThemeProperty("icon-close")+'"></div></div>';if(a.browser.msie&&a.browser.version<8){c='<div style="float: left; min-height: 16px; min-width: 18px;"><div style="position: absolute; left: 100%; top: 50%; margin-left: -18px; margin-top: -8px; float: none; width: 16px; height: 16px;" class="'+this.toThemeProperty("icon-close")+'"></div></div>'}d[0].innerHTML+=c}else{if(d[0].innerHTML==""){d[0].innerHTML='<a href="#">'+f+"</a>"}}if(this.sortable){var e=a('<div style="float: right; min-height: 16px; min-width: 18px;"><div style="position: absolute; left: 100%; top: 50%; margin-left: -16px; margin-top: -8px; float: none; width: 16px; height: 16px;" class="'+this.toThemeProperty("jqx-grid-column-sortascbutton")+'"></div></div>');var b=a('<div style="float: right; min-height: 16px; min-width: 18px;"><div style="position: absolute; left: 100%; top: 50%; margin-left: -16px; margin-top: -8px; float: none; width: 16px; height: 16px;" class="'+this.toThemeProperty("jqx-grid-column-sortdescbutton")+'"></div></div>');if(this.closeablegroups){var e=a('<div style="float: right; min-height: 16px; min-width: 18px;"><div style="position: absolute; left: 100%; top: 50%; margin-left: -32px; margin-top: -8px; float: none; width: 16px; height: 16px;" class="'+this.toThemeProperty("jqx-grid-column-sortascbutton")+'"></div></div>');var b=a('<div style="float: right; min-height: 16px; min-width: 18px;"><div style="position: absolute; left: 100%; top: 50%; margin-left: -32px; margin-top: -8px; float: none; width: 16px; height: 16px;" class="'+this.toThemeProperty("jqx-grid-column-sortdescbutton")+'"></div></div>')}e.css("display","none");b.css("display","none");if(a.browser.msie&&a.browser.version<8){e.css("float","left");b.css("float","left")}d.append(e);d.append(b);a.data(document.body,"groupsortelements"+g,{sortasc:e,sortdesc:b})}d.addClass(this.toThemeProperty("jqx-fill-state-normal"));d.addClass(this.toThemeProperty("jqx-grid-group-column"));return d},_rendergroup:function(e,b,p,h,n,r){var t=b;var g=b.cells[p.level];var l=this._findgroupstate(p.uniqueid);if(p.bounddata.subGroups.length>0||p.bounddata.subItems.length>0){if(l){g.className+=" "+this.toThemeProperty("jqx-grid-group-expand")}else{g.className+=" "+this.toThemeProperty("jqx-grid-group-collapse")}}var o=this._getColumnText(this.groups[p.level]);var d=this.groupindentwidth;var f=this.rowdetails&&this.showrowdetailscolumn?(1+e)*d:(e)*d;var c=a(t).width()-f;a(t.cells[p.level+1]).width(c);if(this.groupsrenderer!=null){var s={group:p.group,level:p.level,groups:p.bounddata.subGroups,rows:p.bounddata.subItems};var j=this.groupsrenderer(o+": "+p.group,p.group,l,s);if(j){t.cells[p.level+1].innerHTML=j}else{var k=p.bounddata.subItems.length>0?p.bounddata.subItems.length:p.bounddata.subGroups.length;t.cells[p.level+1].innerHTML='<div class="'+this.toThemeProperty("jqx-grid-groups-row")+'" style="position: absolute;"><span>'+o+': </span><span class="'+this.toThemeProperty("jqx-grid-groups-row-details")+'">'+p.group+" ("+k+")</span></div>"}}else{var k=p.bounddata.subItems.length>0?p.bounddata.subItems.length:p.bounddata.subGroups.length;t.cells[p.level+1].innerHTML='<div class="'+this.toThemeProperty("jqx-grid-groups-row")+'" style="position: absolute;"><span>'+o+': </span><span class="'+this.toThemeProperty("jqx-grid-groups-row-details")+'">'+p.group+" ("+k+")</span></div>"}}})})(jQuery);