/*! modernizr 3.6.0 (Custom Build) | MIT *
 * https://modernizr.com/download/?-cssanimations-csstransforms-csstransforms3d-csstransitions-domprefixes-prefixes-setclasses-shiv-testallprops-testprop-teststyles !*/
!(function(e, t, n) {
  function r(e, t) {
    return typeof e === t;
  }

  function o() {
    var e, t, n, o, a, i, s;
    for (var l in S)
      if (S.hasOwnProperty(l)) {
        if (
          ((e = []),
          (t = S[l]),
          t.name &&
            (e.push(t.name.toLowerCase()),
            t.options && t.options.aliases && t.options.aliases.length))
        )
          for (n = 0; n < t.options.aliases.length; n++)
            e.push(t.options.aliases[n].toLowerCase());
        for (o = r(t.fn, "function") ? t.fn() : t.fn, a = 0; a < e.length; a++)
          (i = e[a]),
            (s = i.split(".")),
            1 === s.length
              ? (Modernizr[s[0]] = o)
              : (!Modernizr[s[0]] ||
                  Modernizr[s[0]] instanceof Boolean ||
                  (Modernizr[s[0]] = new Boolean(Modernizr[s[0]])),
                (Modernizr[s[0]][s[1]] = o)),
            C.push((o ? "" : "no-") + s.join("-"));
      }
  }

  function a(e) {
    var t = x.className,
      n = Modernizr._config.classPrefix || "";
    if ((w && (t = t.baseVal), Modernizr._config.enableJSClass)) {
      var r = new RegExp("(^|\\s)" + n + "no-js(\\s|$)");
      t = t.replace(r, "$1" + n + "js$2");
    }
    Modernizr._config.enableClasses &&
      ((t += " " + n + e.join(" " + n)),
      w ? (x.className.baseVal = t) : (x.className = t));
  }

  function i(e, t) {
    return !!~("" + e).indexOf(t);
  }

  function s() {
    return "function" != typeof t.createElement
      ? t.createElement(arguments[0])
      : w
      ? t.createElementNS.call(t, "http://www.w3.org/2000/svg", arguments[0])
      : t.createElement.apply(t, arguments);
  }

  function l(e) {
    return e
      .replace(/([a-z])-([a-z])/g, function(e, t, n) {
        return t + n.toUpperCase();
      })
      .replace(/^-/, "");
  }

  function u() {
    var e = t.body;
    return e || ((e = s(w ? "svg" : "body")), (e.fake = !0)), e;
  }

  function c(e, n, r, o) {
    var a,
      i,
      l,
      c,
      f = "modernizr",
      d = s("div"),
      p = u();
    if (parseInt(r, 10))
      for (; r--; )
        (l = s("div")), (l.id = o ? o[r] : f + (r + 1)), d.appendChild(l);
    return (
      (a = s("style")),
      (a.type = "text/css"),
      (a.id = "s" + f),
      (p.fake ? p : d).appendChild(a),
      p.appendChild(d),
      a.styleSheet
        ? (a.styleSheet.cssText = e)
        : a.appendChild(t.createTextNode(e)),
      (d.id = f),
      p.fake &&
        ((p.style.background = ""),
        (p.style.overflow = "hidden"),
        (c = x.style.overflow),
        (x.style.overflow = "hidden"),
        x.appendChild(p)),
      (i = n(d, e)),
      p.fake
        ? (p.parentNode.removeChild(p), (x.style.overflow = c), x.offsetHeight)
        : d.parentNode.removeChild(d),
      !!i
    );
  }

  function f(e, t) {
    return function() {
      return e.apply(t, arguments);
    };
  }

  function d(e, t, n) {
    var o;
    for (var a in e)
      if (e[a] in t)
        return n === !1
          ? e[a]
          : ((o = t[e[a]]), r(o, "function") ? f(o, n || t) : o);
    return !1;
  }

  function p(e) {
    return e
      .replace(/([A-Z])/g, function(e, t) {
        return "-" + t.toLowerCase();
      })
      .replace(/^ms-/, "-ms-");
  }

  function m(t, n, r) {
    var o;
    if ("getComputedStyle" in e) {
      o = getComputedStyle.call(e, t, n);
      var a = e.console;
      if (null !== o) r && (o = o.getPropertyValue(r));
      else if (a) {
        var i = a.error ? "error" : "log";
        a[i].call(
          a,
          "getComputedStyle returning null, its possible modernizr test results are inaccurate"
        );
      }
    } else o = !n && t.currentStyle && t.currentStyle[r];
    return o;
  }

  function h(t, r) {
    var o = t.length;
    if ("CSS" in e && "supports" in e.CSS) {
      for (; o--; ) if (e.CSS.supports(p(t[o]), r)) return !0;
      return !1;
    }
    if ("CSSSupportsRule" in e) {
      for (var a = []; o--; ) a.push("(" + p(t[o]) + ":" + r + ")");
      return (
        (a = a.join(" or ")),
        c(
          "@supports (" + a + ") { #modernizr { position: absolute; } }",
          function(e) {
            return "absolute" == m(e, null, "position");
          }
        )
      );
    }
    return n;
  }

  function g(e, t, o, a) {
    function u() {
      f && (delete k.style, delete k.modElem);
    }
    if (((a = r(a, "undefined") ? !1 : a), !r(o, "undefined"))) {
      var c = h(e, o);
      if (!r(c, "undefined")) return c;
    }
    for (
      var f, d, p, m, g, v = ["modernizr", "tspan", "samp"];
      !k.style && v.length;

    )
      (f = !0), (k.modElem = s(v.shift())), (k.style = k.modElem.style);
    for (p = e.length, d = 0; p > d; d++)
      if (
        ((m = e[d]),
        (g = k.style[m]),
        i(m, "-") && (m = l(m)),
        k.style[m] !== n)
      ) {
        if (a || r(o, "undefined")) return u(), "pfx" == t ? m : !0;
        try {
          k.style[m] = o;
        } catch (y) {}
        if (k.style[m] != g) return u(), "pfx" == t ? m : !0;
      }
    return u(), !1;
  }

  function v(e, t, n, o, a) {
    var i = e.charAt(0).toUpperCase() + e.slice(1),
      s = (e + " " + P.join(i + " ") + i).split(" ");
    return r(t, "string") || r(t, "undefined")
      ? g(s, t, o, a)
      : ((s = (e + " " + N.join(i + " ") + i).split(" ")), d(s, t, n));
  }

  function y(e, t, r) {
    return v(e, n, n, t, r);
  }
  var C = [],
    S = [],
    E = {
      _version: "3.6.0",
      _config: {
        classPrefix: "",
        enableClasses: !0,
        enableJSClass: !0,
        usePrefixes: !0
      },
      _q: [],
      on: function(e, t) {
        var n = this;
        setTimeout(function() {
          t(n[e]);
        }, 0);
      },
      addTest: function(e, t, n) {
        S.push({ name: e, fn: t, options: n });
      },
      addAsyncTest: function(e) {
        S.push({ name: null, fn: e });
      }
    },
    Modernizr = function() {};
  (Modernizr.prototype = E), (Modernizr = new Modernizr());
  var b = E._config.usePrefixes
    ? " -webkit- -moz- -o- -ms- ".split(" ")
    : ["", ""];
  E._prefixes = b;
  var x = t.documentElement,
    w = "svg" === x.nodeName.toLowerCase();
  w ||
    !(function(e, t) {
      function n(e, t) {
        var n = e.createElement("p"),
          r = e.getElementsByTagName("head")[0] || e.documentElement;
        return (
          (n.innerHTML = "x<style>" + t + "</style>"),
          r.insertBefore(n.lastChild, r.firstChild)
        );
      }

      function r() {
        var e = C.elements;
        return "string" == typeof e ? e.split(" ") : e;
      }

      function o(e, t) {
        var n = C.elements;
        "string" != typeof n && (n = n.join(" ")),
          "string" != typeof e && (e = e.join(" ")),
          (C.elements = n + " " + e),
          u(t);
      }

      function a(e) {
        var t = y[e[g]];
        return t || ((t = {}), v++, (e[g] = v), (y[v] = t)), t;
      }

      function i(e, n, r) {
        if ((n || (n = t), f)) return n.createElement(e);
        r || (r = a(n));
        var o;
        return (
          (o = r.cache[e]
            ? r.cache[e].cloneNode()
            : h.test(e)
            ? (r.cache[e] = r.createElem(e)).cloneNode()
            : r.createElem(e)),
          !o.canHaveChildren || m.test(e) || o.tagUrn
            ? o
            : r.frag.appendChild(o)
        );
      }

      function s(e, n) {
        if ((e || (e = t), f)) return e.createDocumentFragment();
        n = n || a(e);
        for (
          var o = n.frag.cloneNode(), i = 0, s = r(), l = s.length;
          l > i;
          i++
        )
          o.createElement(s[i]);
        return o;
      }

      function l(e, t) {
        t.cache ||
          ((t.cache = {}),
          (t.createElem = e.createElement),
          (t.createFrag = e.createDocumentFragment),
          (t.frag = t.createFrag())),
          (e.createElement = function(n) {
            return C.shivMethods ? i(n, e, t) : t.createElem(n);
          }),
          (e.createDocumentFragment = Function(
            "h,f",
            "return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&(" +
              r()
                .join()
                .replace(/[\w\-:]+/g, function(e) {
                  return (
                    t.createElem(e), t.frag.createElement(e), 'c("' + e + '")'
                  );
                }) +
              ");return n}"
          )(C, t.frag));
      }

      function u(e) {
        e || (e = t);
        var r = a(e);
        return (
          !C.shivCSS ||
            c ||
            r.hasCSS ||
            (r.hasCSS = !!n(
              e,
              "article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}"
            )),
          f || l(e, r),
          e
        );
      }
      var c,
        f,
        d = "3.7.3",
        p = e.html5 || {},
        m = /^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,
        h = /^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,
        g = "_html5shiv",
        v = 0,
        y = {};
      !(function() {
        try {
          var e = t.createElement("a");
          (e.innerHTML = "<xyz></xyz>"),
            (c = "hidden" in e),
            (f =
              1 == e.childNodes.length ||
              (function() {
                t.createElement("a");
                var e = t.createDocumentFragment();
                return (
                  "undefined" == typeof e.cloneNode ||
                  "undefined" == typeof e.createDocumentFragment ||
                  "undefined" == typeof e.createElement
                );
              })());
        } catch (n) {
          (c = !0), (f = !0);
        }
      })();
      var C = {
        elements:
          p.elements ||
          "abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output picture progress section summary template time video",
        version: d,
        shivCSS: p.shivCSS !== !1,
        supportsUnknownElements: f,
        shivMethods: p.shivMethods !== !1,
        type: "default",
        shivDocument: u,
        createElement: i,
        createDocumentFragment: s,
        addElements: o
      };
      (e.html5 = C),
        u(t),
        "object" == typeof module && module.exports && (module.exports = C);
    })("undefined" != typeof e ? e : this, t);
  var _ = "Moz O ms Webkit",
    N = E._config.usePrefixes ? _.toLowerCase().split(" ") : [];
  E._domPrefixes = N;
  var T = "CSS" in e && "supports" in e.CSS,
    z = "supportsCSS" in e;
  Modernizr.addTest("supports", T || z);
  var P = E._config.usePrefixes ? _.split(" ") : [];
  E._cssomPrefixes = P;
  var j = ((E.testStyles = c), { elem: s("modernizr") });
  Modernizr._q.push(function() {
    delete j.elem;
  });
  var k = { style: j.elem.style };
  Modernizr._q.unshift(function() {
    delete k.style;
  });
  E.testProp = function(e, t, r) {
    return g([e], n, t, r);
  };
  (E.testAllProps = v),
    (E.testAllProps = y),
    Modernizr.addTest("cssanimations", y("animationName", "a", !0)),
    Modernizr.addTest("csstransforms", function() {
      return (
        -1 === navigator.userAgent.indexOf("Android 2.") &&
        y("transform", "scale(1)", !0)
      );
    }),
    Modernizr.addTest("csstransforms3d", function() {
      return !!y("perspective", "1px", !0);
    }),
    Modernizr.addTest("csstransitions", y("transition", "all", !0)),
    o(),
    a(C),
    delete E.addTest,
    delete E.addAsyncTest;
  for (var F = 0; F < Modernizr._q.length; F++) Modernizr._q[F]();
  e.Modernizr = Modernizr;
})(window, document);
