/*

highlight v4

Highlights arbitrary terms.

<http://johannburkard.de/blog/programming/javascript/highlight-javascript-text-higlighting-jquery-plugin.html>

MIT license.

Johann Burkard
<http://johannburkard.de>
<mailto:jb@eaio.com>

*/
!function($) {
  $.fn.highlight = function(pat, ignore) {
    function replaceDiacritics(str) {
      var diacritics = [ [ /[\u00c0-\u00c6]/g, 'A' ],
        [ /[\u00e0-\u00e6]/g, 'a' ], 
        [ /[\u00c7]/g, 'C' ],
        [ /[\u00e7]/g, 'c' ], 
        [ /[\u00c8-\u00cb]/g, 'E' ],
        [ /[\u00e8-\u00eb]/g, 'e' ], 
        [ /[\u00cc-\u00cf]/g, 'I' ],
        [ /[\u00ec-\u00ef]/g, 'i' ], 
        [ /[\u00d1|\u0147]/g, 'N' ],
        [ /[\u00f1|\u0148]/g, 'n' ],
        [ /[\u00d2-\u00d8|\u0150]/g, 'O' ],
        [ /[\u00f2-\u00f8|\u0151]/g, 'o' ], 
        [ /[\u0160]/g, 'S' ],
        [ /[\u0161]/g, 's' ], 
        [ /[\u00d9-\u00dc]/g, 'U' ],
        [ /[\u00f9-\u00fc]/g, 'u' ], 
        [ /[\u00dd]/g, 'Y' ],
        [ /[\u00fd]/g, 'y' ]
      ];
    
      for ( var i = 0; i < diacritics.length; i++) {
        str = str.replace(diacritics[i][0], diacritics[i][1]);
      }
      
      return str;
    }
    
    function innerHighlight(node, pat, ignore) {
      var skip = 0;
      if (node.nodeType == 3) {
        var isPatternArray = $.isArray(pat);
        if (!isPatternArray) {
          pat = [pat];
        }
        var patternCount = pat.length;
        for (var ii = 0; ii < patternCount; ii++) {
          var currentTerm = (ignore ? replaceDiacritics(pat[ii]) : pat[ii]).toUpperCase();
          var pos = (ignore ? replaceDiacritics(node.data) : node.data).toUpperCase().indexOf(currentTerm);
          if (pos >= 0) {
            var spannode = document.createElement('span');
            spannode.className = 'highlight';
            var middlebit = node.splitText(pos);
            var endbit = middlebit.splitText(currentTerm.length);
            var middleclone = middlebit.cloneNode(true);
            spannode.appendChild(middleclone);
            middlebit.parentNode.replaceChild(spannode, middlebit);
            skip = 1;
          }
        }
      } else if (node.nodeType == 1 && node.childNodes && !/(script|style)/i.test(node.tagName)) {
        for (var i = 0; i < node.childNodes.length; ++i) {
          i += innerHighlight(node.childNodes[i], pat, ignore);
        }
      }
      return skip;
    }
    return this.length && pat && pat.length ? this.each(function() {
      ignore = typeof ignore !== 'undefined' ? ignore : $.fn.highlight.defaults.ignore;
      innerHighlight(this, pat, ignore);
    }) : this;
  };
  
  $.fn.highlight.defaults = {
    ignore : false
  }

  $.fn.removeHighlight = function() {
    return this.find("span.highlight").each(function() {
      this.parentNode.firstChild.nodeName;
      with(this.parentNode) {
        replaceChild(this.firstChild, this);
        normalize();
      }
    }).end();
  };
}(window.jQuery);