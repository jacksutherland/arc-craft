!function(a){a.add("plugin","specialchars",{translations:{en:{specialchars:"Special Characters"}},init:function(a){this.app=a,this.lang=a.lang,this.toolbar=a.toolbar,this.insertion=a.insertion,this.chars=["&lsquo;","&rsquo;","&ldquo;","&rdquo;","&ndash;","&mdash;","&divide;","&hellip;","&trade;","&bull;","&rarr;","&asymp;","$","&euro;","&cent;","&pound;","&yen;","&iexcl;","&curren;","&brvbar;","&sect;","&uml;","&copy;","&ordf;","&laquo;","&raquo;","&not;","&reg;","&macr;","&deg;","&sup1;","&sup2;","&sup3;","&acute;","&micro;","&para;","&middot;","&cedil;","&ordm;","&frac14;","&frac12;","&frac34;","&iquest;","&Agrave;","&Aacute;","&Acirc;","&Atilde;","&Auml;","&Aring;","&AElig;","&Ccedil;","&Egrave;","&Eacute;","&Ecirc;","&Euml;","&Igrave;","&Iacute;","&Icirc;","&Iuml;","&ETH;","&Ntilde;","&Ograve;","&Oacute;","&Ocirc;","&Otilde;","&Ouml;","&times;","&Oslash;","&Ugrave;","&Uacute;","&Ucirc;","&Uuml;","&Yacute;","&THORN;","&szlig;","&agrave;","&aacute;","&acirc;","&atilde;","&auml;","&aring;","&aelig;","&ccedil;","&egrave;","&eacute;","&ecirc;","&euml;","&igrave;","&iacute;","&icirc;","&iuml;","&eth;","&ntilde;","&ograve;","&oacute;","&ocirc;","&otilde;","&ouml;","&oslash;","&ugrave;","&uacute;","&ucirc;","&uuml;","&yacute;","&thorn;","&yuml;","&OElig;","&oelig;","&#372;","&#374","&#373","&#375;"]},start:function(){var a={title:this.lang.get("specialchars")},t=this._buildDropdown();this.$button=this.toolbar.addButton("specialchars",a),this.$button.setIcon('<i class="re-icon-specialcharacters"></i>'),this.$button.setDropdown(t)},_set:function(a){this.insertion.insertChar(a)},_buildDropdown:function(){for(var t=this,i=a.dom('<div class="redactor-dropdown-cells">'),r=function(i){i.preventDefault();var r=a.dom(i.target);t._set(r.data("char"))},e=0;e<this.chars.length;e++){var c=a.dom("<a>");c.attr({href:"#","data-char":this.chars[e]}),c.css({"line-height":"32px",width:"32px",height:"32px"}),c.html(this.chars[e]),c.on("click",r),i.append(c)}return i}})}(Redactor);
//# sourceMappingURL=specialchars.js.map
