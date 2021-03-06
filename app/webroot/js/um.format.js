/*!
 * UEditor Mini版本
 * version: 1.0.0
 * build: Tue Sep 17 2013 15:57:30 GMT+0800 (CST)
 */

!
function() {
    function a(a, b, c) {
        var d;
        return b = b.toLowerCase(),
        (d = a.__allListeners || c && (a.__allListeners = {})) && (d[b] || c && (d[b] = []))
    }
    UMEDITOR_CONFIG = window.UMEDITOR_CONFIG || {},
    window.UM = {
        plugins: {},
        commands: {},
        I18N: {},
        version: "1.0.0"
    };
    var b = UM.dom = {},
    c = UM.browser = function() {
        var a = navigator.userAgent.toLowerCase(),
        b = window.opera,
        c = {
            ie: !!window.ActiveXObject,
            opera: !!b && b.version,
            webkit: a.indexOf(" applewebkit/") > -1,
            mac: a.indexOf("macintosh") > -1,
            quirks: "BackCompat" == document.compatMode
        };
        c.gecko = "Gecko" == navigator.product && !c.webkit && !c.opera;
        var d = 0;
        if (c.ie && (d = parseFloat(a.match(/msie (\d+)/)[1]), c.ie9Compat = 9 == document.documentMode, c.ie8 = !!document.documentMode, c.ie8Compat = 8 == document.documentMode, c.ie7Compat = 7 == d && !document.documentMode || 7 == document.documentMode, c.ie6Compat = 7 > d || c.quirks, c.ie9above = d > 8, c.ie9below = 9 > d), c.gecko) {
            var e = a.match(/rv:([\d\.]+)/);
            e && (e = e[1].split("."), d = 1e4 * e[0] + 100 * (e[1] || 0) + 1 * (e[2] || 0))
        }
        return /chrome\/(\d+\.\d)/i.test(a) && (c.chrome = +RegExp.$1),
        /(\d+\.\d)?(?:\.\d)?\s+safari\/?(\d+\.\d+)?/i.test(a) && !/chrome/i.test(a) && (c.safari = +(RegExp.$1 || RegExp.$2)),
        c.opera && (d = parseFloat(b.version())),
        c.webkit && (d = parseFloat(a.match(/ applewebkit\/(\d+)/)[1])),
        c.version = d,
        c.isCompatible = !c.mobile && (c.ie && d >= 6 || c.gecko && d >= 10801 || c.opera && d >= 9.5 || c.air && d >= 1 || c.webkit && d >= 522 || !1),
        c
    } (),
    d = c.ie;
    c.webkit,
    c.gecko,
    c.opera;
    var e = UM.utils = {
        each: function(a, b, c) {
            if (null != a) if (a.length === +a.length) {
                for (var d = 0,
                e = a.length; e > d; d++) if (b.call(c, a[d], d, a) === !1) return ! 1
            } else for (var f in a) if (a.hasOwnProperty(f) && b.call(c, a[f], f, a) === !1) return ! 1
        },
        makeInstance: function(a) {
            var b = new Function;
            return b.prototype = a,
            a = new b,
            b.prototype = null,
            a
        },
        extend: function(a, b, c) {
            if (b) for (var d in b) c && a.hasOwnProperty(d) || (a[d] = b[d]);
            return a
        },
        extend2: function(a) {
            for (var b = arguments,
            c = 1; c < b.length; c++) {
                var d = b[c];
                for (var e in d) a.hasOwnProperty(e) || (a[e] = d[e])
            }
            return a
        },
        inherits: function(a, b) {
            var c = a.prototype,
            d = e.makeInstance(b.prototype);
            return e.extend(d, c, !0),
            a.prototype = d,
            d.constructor = a
        },
        bind: function(a, b) {
            return function() {
                return a.apply(b, arguments)
            }
        },
        defer: function(a, b, c) {
            var d;
            return function() {
                c && clearTimeout(d),
                d = setTimeout(a, b)
            }
        },
        indexOf: function(a, b, c) {
            var d = -1;
            return c = this.isNumber(c) ? c: 0,
            this.each(a,
            function(a, e) {
                return e >= c && a === b ? (d = e, !1) : void 0
            }),
            d
        },
        removeItem: function(a, b) {
            for (var c = 0,
            d = a.length; d > c; c++) a[c] === b && (a.splice(c, 1), c--)
        },
        trim: function(a) {
            return a.replace(/(^[ \t\n\r]+)|([ \t\n\r]+$)/g, "")
        },
        listToMap: function(a) {
            if (!a) return {};
            a = e.isArray(a) ? a: a.split(",");
            for (var b, c = 0,
            d = {}; b = a[c++];) d[b.toUpperCase()] = d[b] = 1;
            return d
        },
        unhtml: function(a, b) {
            return a ? a.replace(b || /[&<">'](?:(amp|lt|quot|gt|#39|nbsp);)?/g,
            function(a, b) {
                return b ? a: {
                    "<": "&lt;",
                    "&": "&amp;",
                    '"': "&quot;",
                    ">": "&gt;",
                    "'": "&#39;"
                } [a]
            }) : ""
        },
        html: function(a) {
            return a ? a.replace(/&((g|l|quo)t|amp|#39);/g,
            function(a) {
                return {
                    "&lt;": "<",
                    "&amp;": "&",
                    "&quot;": '"',
                    "&gt;": ">",
                    "&#39;": "'"
                } [a]
            }) : ""
        },
        cssStyleToDomStyle: function() {
            var a = document.createElement("div").style,
            b = {
                "float": void 0 != a.cssFloat ? "cssFloat": void 0 != a.styleFloat ? "styleFloat": "float"
            };
            return function(a) {
                return b[a] || (b[a] = a.toLowerCase().replace(/-./g,
                function(a) {
                    return a.charAt(1).toUpperCase()
                }))
            }
        } (),
        loadFile: function() {
            function a(a, c) {
                try {
                    for (var d, e = 0; d = b[e++];) if (d.doc === a && d.url == (c.src || c.href)) return d
                } catch(f) {
                    return null
                }
            }
            var b = [];
            return function(c, d, e) {
                var f = a(c, d);
                if (f) return f.ready ? e && e() : f.funs.push(e),
                void 0;
                if (b.push({
                    doc: c,
                    url: d.src || d.href,
                    funs: [e]
                }), !c.body) {
                    var g = [];
                    for (var h in d)"tag" != h && g.push(h + '="' + d[h] + '"');
                    return c.write("<" + d.tag + " " + g.join(" ") + " ></" + d.tag + ">"),
                    void 0
                }
                if (!d.id || !c.getElementById(d.id)) {
                    var i = c.createElement(d.tag);
                    delete d.tag;
                    for (var h in d) i.setAttribute(h, d[h]);
                    i.onload = i.onreadystatechange = function() {
                        if (!this.readyState || /loaded|complete/.test(this.readyState)) {
                            if (f = a(c, d), f.funs.length > 0) {
                                f.ready = 1;
                                for (var b; b = f.funs.pop();) b()
                            }
                            i.onload = i.onreadystatechange = null
                        }
                    },
                    i.onerror = function() {
                        throw Error("The load " + (d.href || d.src) + " fails,check the url settings of file umeditor.config.js ")
                    },
                    c.getElementsByTagName("head")[0].appendChild(i)
                }
            }
        } (),
        isEmptyObject: function(a) {
            if (null == a) return ! 0;
            if (this.isArray(a) || this.isString(a)) return 0 === a.length;
            for (var b in a) if (a.hasOwnProperty(b)) return ! 1;
            return ! 0
        },
        fixColor: function(a, b) {
            if (/color/i.test(a) && /rgba?/.test(b)) {
                var c = b.split(",");
                if (c.length > 3) return "";
                b = "#";
                for (var d, e = 0; d = c[e++];) d = parseInt(d.replace(/[^\d]/gi, ""), 10).toString(16),
                b += 1 == d.length ? "0" + d: d;
                b = b.toUpperCase()
            }
            return b
        },
        clone: function(a, b) {
            var c;
            b = b || {};
            for (var d in a) a.hasOwnProperty(d) && (c = a[d], "object" == typeof c ? (b[d] = e.isArray(c) ? [] : {},
            e.clone(a[d], b[d])) : b[d] = c);
            return b
        },
        transUnitToPx: function(a) {
            if (!/(pt|cm)/.test(a)) return a;
            var b;
            switch (a.replace(/([\d.]+)(\w+)/,
            function(c, d, e) {
                a = d,
                b = e
            }), b) {
            case "cm":
                a = 25 * parseFloat(a);
                break;
            case "pt":
                a = Math.round(96 * parseFloat(a) / 72)
            }
            return a + (a ? "px": "")
        },
        domReady: function() {
            function a(a) {
                a.isReady = !0;
                for (var c; c = b.pop(); c());
            }
            var b = [];
            return function(d, e) {
                e = e || window;
                var f = e.document;
                d && b.push(d),
                "complete" === f.readyState ? a(f) : (f.isReady && a(f), c.ie ? (!
                function() {
                    if (!f.isReady) {
                        try {
                            f.documentElement.doScroll("left")
                        } catch(b) {
                            return setTimeout(arguments.callee, 0),
                            void 0
                        }
                        a(f)
                    }
                } (), e.attachEvent("onload",
                function() {
                    a(f)
                })) : (f.addEventListener("DOMContentLoaded",
                function() {
                    f.removeEventListener("DOMContentLoaded", arguments.callee, !1),
                    a(f)
                },
                !1), e.addEventListener("load",
                function() {
                    a(f)
                },
                !1)))
            }
        } (),
        cssRule: c.ie ?
        function(a, b, c) {
            var d, e;
            c = c || document,
            d = c.indexList ? c.indexList: c.indexList = {};
            var f;
            if (d[a]) f = c.styleSheets[d[a]];
            else {
                if (void 0 === b) return "";
                f = c.createStyleSheet("", e = c.styleSheets.length),
                d[a] = e
            }
            return void 0 === b ? f.cssText: (f.cssText = b || "", void 0)
        }: function(a, b, c) {
            c = c || document;
            var d, e = c.getElementsByTagName("head")[0];
            if (! (d = c.getElementById(a))) {
                if (void 0 === b) return "";
                d = c.createElement("style"),
                d.id = a,
                e.appendChild(d)
            }
            return void 0 === b ? d.innerHTML: ("" !== b ? d.innerHTML = b: e.removeChild(d), void 0)
        }
    };
    e.each(["String", "Function", "Array", "Number", "RegExp", "Object"],
    function(a) {
        UM.utils["is" + a] = function(b) {
            return Object.prototype.toString.apply(b) == "[object " + a + "]"
        }
    });
    var f = UM.EventBase = function() {};
    f.prototype = {
        addListener: function(b, c) {
            b = e.trim(b).split(" ");
            for (var d, f = 0; d = b[f++];) a(this, d, !0).push(c)
        },
        removeListener: function(b, c) {
            b = e.trim(b).split(" ");
            for (var d, f = 0; d = b[f++];) e.removeItem(a(this, d) || [], c)
        },
        fireEvent: function() {
            var b = arguments[0];
            b = e.trim(b).split(" ");
            for (var c, d = 0; c = b[d++];) {
                var f, g, h, i = a(this, c);
                if (i) for (h = i.length; h--;) if (i[h]) {
                    if (g = i[h].apply(this, arguments), g === !0) return g;
                    void 0 !== g && (f = g)
                } (g = this["on" + c.toLowerCase()]) && (f = g.apply(this, arguments))
            }
            return f
        }
    };
    var g = b.dtd = function() {
        function a(a) {
            for (var b in a) a[b.toUpperCase()] = a[b];
            return a
        }
        var b = e.extend2,
        c = a({
            isindex: 1,
            fieldset: 1
        }),
        d = a({
            input: 1,
            button: 1,
            select: 1,
            textarea: 1,
            label: 1
        }),
        f = b(a({
            a: 1
        }), d),
        g = b({
            iframe: 1
        },
        f),
        h = a({
            hr: 1,
            ul: 1,
            menu: 1,
            div: 1,
            blockquote: 1,
            noscript: 1,
            table: 1,
            center: 1,
            address: 1,
            dir: 1,
            pre: 1,
            h5: 1,
            dl: 1,
            h4: 1,
            noframes: 1,
            h6: 1,
            ol: 1,
            h1: 1,
            h3: 1,
            h2: 1
        }),
        i = a({
            ins: 1,
            del: 1,
            script: 1,
            style: 1
        }),
        j = b(a({
            b: 1,
            acronym: 1,
            bdo: 1,
            "var": 1,
            "#": 1,
            abbr: 1,
            code: 1,
            br: 1,
            i: 1,
            cite: 1,
            kbd: 1,
            u: 1,
            strike: 1,
            s: 1,
            tt: 1,
            strong: 1,
            q: 1,
            samp: 1,
            em: 1,
            dfn: 1,
            span: 1
        }), i),
        k = b(a({
            sub: 1,
            img: 1,
            embed: 1,
            object: 1,
            sup: 1,
            basefont: 1,
            map: 1,
            applet: 1,
            font: 1,
            big: 1,
            small: 1
        }), j),
        l = b(a({
            p: 1
        }), k),
        m = b(a({
            iframe: 1
        }), k, d),
        n = a({
            img: 1,
            embed: 1,
            noscript: 1,
            br: 1,
            kbd: 1,
            center: 1,
            button: 1,
            basefont: 1,
            h5: 1,
            h4: 1,
            samp: 1,
            h6: 1,
            ol: 1,
            h1: 1,
            h3: 1,
            h2: 1,
            form: 1,
            font: 1,
            "#": 1,
            select: 1,
            menu: 1,
            ins: 1,
            abbr: 1,
            label: 1,
            code: 1,
            table: 1,
            script: 1,
            cite: 1,
            input: 1,
            iframe: 1,
            strong: 1,
            textarea: 1,
            noframes: 1,
            big: 1,
            small: 1,
            span: 1,
            hr: 1,
            sub: 1,
            bdo: 1,
            "var": 1,
            div: 1,
            object: 1,
            sup: 1,
            strike: 1,
            dir: 1,
            map: 1,
            dl: 1,
            applet: 1,
            del: 1,
            isindex: 1,
            fieldset: 1,
            ul: 1,
            b: 1,
            acronym: 1,
            a: 1,
            blockquote: 1,
            i: 1,
            u: 1,
            s: 1,
            tt: 1,
            address: 1,
            q: 1,
            pre: 1,
            p: 1,
            em: 1,
            dfn: 1
        }),
        o = b(a({
            a: 0
        }), m),
        p = a({
            tr: 1
        }),
        q = a({
            "#": 1
        }),
        r = b(a({
            param: 1
        }), n),
        s = b(a({
            form: 1
        }), c, g, h, l),
        t = a({
            li: 1,
            ol: 1,
            ul: 1
        }),
        u = a({
            style: 1,
            script: 1
        }),
        v = a({
            base: 1,
            link: 1,
            meta: 1,
            title: 1
        }),
        w = b(v, u),
        x = a({
            head: 1,
            body: 1
        }),
        y = a({
            html: 1
        }),
        z = a({
            address: 1,
            blockquote: 1,
            center: 1,
            dir: 1,
            div: 1,
            dl: 1,
            fieldset: 1,
            form: 1,
            h1: 1,
            h2: 1,
            h3: 1,
            h4: 1,
            h5: 1,
            h6: 1,
            hr: 1,
            isindex: 1,
            menu: 1,
            noframes: 1,
            ol: 1,
            p: 1,
            pre: 1,
            table: 1,
            ul: 1
        }),
        A = a({
            area: 1,
            base: 1,
            basefont: 1,
            br: 1,
            col: 1,
            command: 1,
            dialog: 1,
            embed: 1,
            hr: 1,
            img: 1,
            input: 1,
            isindex: 1,
            keygen: 1,
            link: 1,
            meta: 1,
            param: 1,
            source: 1,
            track: 1,
            wbr: 1
        });
        return a({
            $nonBodyContent: b(y, x, v),
            $block: z,
            $inline: o,
            $inlineWithA: b(a({
                a: 1
            }), o),
            $body: b(a({
                script: 1,
                style: 1
            }), z),
            $cdata: a({
                script: 1,
                style: 1
            }),
            $empty: A,
            $nonChild: a({
                iframe: 1,
                textarea: 1
            }),
            $listItem: a({
                dd: 1,
                dt: 1,
                li: 1
            }),
            $list: a({
                ul: 1,
                ol: 1,
                dl: 1
            }),
            $isNotEmpty: a({
                table: 1,
                ul: 1,
                ol: 1,
                dl: 1,
                iframe: 1,
                area: 1,
                base: 1,
                col: 1,
                hr: 1,
                img: 1,
                embed: 1,
                input: 1,
                link: 1,
                meta: 1,
                param: 1,
                h1: 1,
                h2: 1,
                h3: 1,
                h4: 1,
                h5: 1,
                h6: 1
            }),
            $removeEmpty: a({
                a: 1,
                abbr: 1,
                acronym: 1,
                address: 1,
                b: 1,
                bdo: 1,
                big: 1,
                cite: 1,
                code: 1,
                del: 1,
                dfn: 1,
                em: 1,
                font: 1,
                i: 1,
                ins: 1,
                label: 1,
                kbd: 1,
                q: 1,
                s: 1,
                samp: 1,
                small: 1,
                span: 1,
                strike: 1,
                strong: 1,
                sub: 1,
                sup: 1,
                tt: 1,
                u: 1,
                "var": 1
            }),
            $removeEmptyBlock: a({
                p: 1,
                div: 1
            }),
            $tableContent: a({
                caption: 1,
                col: 1,
                colgroup: 1,
                tbody: 1,
                td: 1,
                tfoot: 1,
                th: 1,
                thead: 1,
                tr: 1,
                table: 1
            }),
            $notTransContent: a({
                pre: 1,
                script: 1,
                style: 1,
                textarea: 1
            }),
            html: x,
            head: w,
            style: q,
            script: q,
            body: s,
            base: {},
            link: {},
            meta: {},
            title: q,
            col: {},
            tr: a({
                td: 1,
                th: 1
            }),
            img: {},
            embed: {},
            colgroup: a({
                thead: 1,
                col: 1,
                tbody: 1,
                tr: 1,
                tfoot: 1
            }),
            noscript: s,
            td: s,
            br: {},
            th: s,
            center: s,
            kbd: o,
            button: b(l, h),
            basefont: {},
            h5: o,
            h4: o,
            samp: o,
            h6: o,
            ol: t,
            h1: o,
            h3: o,
            option: q,
            h2: o,
            form: b(c, g, h, l),
            select: a({
                optgroup: 1,
                option: 1
            }),
            font: o,
            ins: o,
            menu: t,
            abbr: o,
            label: o,
            table: a({
                thead: 1,
                col: 1,
                tbody: 1,
                tr: 1,
                colgroup: 1,
                caption: 1,
                tfoot: 1
            }),
            code: o,
            tfoot: p,
            cite: o,
            li: s,
            input: {},
            iframe: s,
            strong: o,
            textarea: q,
            noframes: s,
            big: o,
            small: o,
            span: a({
                "#": 1,
                br: 1,
                b: 1,
                strong: 1,
                u: 1,
                i: 1,
                em: 1,
                sub: 1,
                sup: 1,
                strike: 1,
                span: 1
            }),
            hr: o,
            dt: o,
            sub: o,
            optgroup: a({
                option: 1
            }),
            param: {},
            bdo: o,
            "var": o,
            div: s,
            object: r,
            sup: o,
            dd: s,
            strike: o,
            area: {},
            dir: t,
            map: b(a({
                area: 1,
                form: 1,
                p: 1
            }), c, i, h),
            applet: r,
            dl: a({
                dt: 1,
                dd: 1
            }),
            del: o,
            isindex: {},
            fieldset: b(a({
                legend: 1
            }), n),
            thead: p,
            ul: t,
            acronym: o,
            b: o,
            a: b(a({
                a: 1
            }), m),
            blockquote: b(a({
                td: 1,
                tr: 1,
                tbody: 1,
                li: 1
            }), s),
            caption: o,
            i: o,
            u: o,
            tbody: p,
            s: o,
            address: b(g, l),
            tt: o,
            legend: o,
            q: o,
            pre: b(j, f),
            p: b(a({
                a: 1
            }), o),
            em: o,
            dfn: o
        })
    } (),
    h = d && c.version < 9 ? {
        tabindex: "tabIndex",
        readonly: "readOnly",
        "for": "htmlFor",
        "class": "className",
        maxlength: "maxLength",
        cellspacing: "cellSpacing",
        cellpadding: "cellPadding",
        rowspan: "rowSpan",
        colspan: "colSpan",
        usemap: "useMap",
        frameborder: "frameBorder"
    }: {
        tabindex: "tabIndex",
        readonly: "readOnly"
    },
    i = e.listToMap(["-webkit-box", "-moz-box", "block", "list-item", "table", "table-row-group", "table-header-group", "table-footer-group", "table-row", "table-column-group", "table-column", "table-cell", "table-caption"]),
    j = b.domUtils = {
        NODE_ELEMENT: 1,
        NODE_DOCUMENT: 9,
        NODE_TEXT: 3,
        NODE_COMMENT: 8,
        NODE_DOCUMENT_FRAGMENT: 11,
        POSITION_IDENTICAL: 0,
        POSITION_DISCONNECTED: 1,
        POSITION_FOLLOWING: 2,
        POSITION_PRECEDING: 4,
        POSITION_IS_CONTAINED: 8,
        POSITION_CONTAINS: 16,
        fillChar: d && "6" == c.version ? "﻿": "​",
        keys: {
            8 : 1,
            46 : 1,
            16 : 1,
            17 : 1,
            18 : 1,
            37 : 1,
            38 : 1,
            39 : 1,
            40 : 1,
            13 : 1
        },
        breakParent: function(a, b) {
            var c, d, e, f = a,
            g = a;
            do {
                for (f = f.parentNode, d ? (c = f.cloneNode(!1), c.appendChild(d), d = c, c = f.cloneNode(!1), c.appendChild(e), e = c) : (d = f.cloneNode(!1), e = d.cloneNode(!1)); c = g.previousSibling;) d.insertBefore(c, d.firstChild);
                for (; c = g.nextSibling;) e.appendChild(c);
                g = f
            } while ( b !== f );
            return c = b.parentNode,
            c.insertBefore(d, b),
            c.insertBefore(e, b),
            c.insertBefore(a, e),
            j.remove(b),
            a
        },
        trimWhiteTextNode: function(a) {
            function b(b) {
                for (var c; (c = a[b]) && 3 == c.nodeType && j.isWhitespace(c);) a.removeChild(c)
            }
            b("firstChild"),
            b("lastChild")
        },
        getPosition: function(a, b) {
            if (a === b) return 0;
            var c, d = [a],
            e = [b];
            for (c = a; c = c.parentNode;) {
                if (c === b) return 10;
                d.push(c)
            }
            for (c = b; c = c.parentNode;) {
                if (c === a) return 20;
                e.push(c)
            }
            if (d.reverse(), e.reverse(), d[0] !== e[0]) return 1;
            for (var f = -1; f++, d[f] === e[f];);
            for (a = d[f], b = e[f]; a = a.nextSibling;) if (a === b) return 4;
            return 2
        },
        getNodeIndex: function(a, b) {
            for (var c = a,
            d = 0; c = c.previousSibling;) b && 3 == c.nodeType ? c.nodeType != c.nextSibling.nodeType && d++:d++;
            return d
        },
        inDoc: function(a, b) {
            return 10 == j.getPosition(a, b)
        },
        findParent: function(a, b, c) {
            if (a && !j.isBody(a)) for (a = c ? a: a.parentNode; a;) {
                if (!b || b(a) || j.isBody(a)) return b && !b(a) && j.isBody(a) ? null: a;
                a = a.parentNode
            }
            return null
        },
        findParentByTagName: function(a, b, c, d) {
            return b = e.listToMap(e.isArray(b) ? b: [b]),
            j.findParent(a,
            function(a) {
                return b[a.tagName] && !(d && d(a))
            },
            c)
        },
        findParents: function(a, b, c, d) {
            for (var e = b && (c && c(a) || !c) ? [a] : []; a = j.findParent(a, c);) e.push(a);
            return d ? e: e.reverse()
        },
        insertAfter: function(a, b) {
            return a.parentNode.insertBefore(b, a.nextSibling)
        },
        remove: function(a, b) {
            var c, d = a.parentNode;
            if (d) {
                if (b && a.hasChildNodes()) for (; c = a.firstChild;) d.insertBefore(c, a);
                d.removeChild(a)
            }
            return a
        },
        isBookmarkNode: function(a) {
            return 1 == a.nodeType && a.id && /^_baidu_bookmark_/i.test(a.id)
        },
        getWindow: function(a) {
            var b = a.ownerDocument || a;
            return b.defaultView || b.parentWindow
        },
        split: function(a, b) {
            var d = a.ownerDocument;
            if (c.ie && b == a.nodeValue.length) {
                var e = d.createTextNode("");
                return j.insertAfter(a, e)
            }
            var f = a.splitText(b);
            if (c.ie8) {
                var g = d.createTextNode("");
                j.insertAfter(f, g),
                j.remove(g)
            }
            return f
        },
        isWhitespace: function(a) {
            return ! new RegExp("[^ 	\n\r" + j.fillChar + "]").test(a.nodeValue)
        },
        getXY: function(a) {
            for (var b = 0,
            c = 0; a.offsetParent;) c += a.offsetTop,
            b += a.offsetLeft,
            a = a.offsetParent;
            return {
                x: b,
                y: c
            }
        },
        on: function(a, b, c) {
            var d = e.isArray(b) ? b: [b],
            f = d.length;
            if (f) for (; f--;) if (b = d[f], a.addEventListener) a.addEventListener(b, c, !1);
            else {
                c._d || (c._d = {
                    els: []
                });
                var g = b + c.toString(),
                h = e.indexOf(c._d.els, a);
                c._d[g] && -1 != h || ( - 1 == h && c._d.els.push(a), c._d[g] || (c._d[g] = function(a) {
                    return c.call(a.srcElement, a || window.event)
                }), a.attachEvent("on" + b, c._d[g]))
            }
            a = null
        },
        un: function(a, b, c) {
            var d = e.isArray(b) ? b: [b],
            f = d.length;
            if (f) for (; f--;) if (b = d[f], a.removeEventListener) a.removeEventListener(b, c, !1);
            else {
                var g = b + c.toString();
                try {
                    a.detachEvent("on" + b, c._d ? c._d[g] : c)
                } catch(h) {}
                if (c._d && c._d[g]) {
                    var i = e.indexOf(c._d.els, a); - 1 != i && c._d.els.splice(i, 1),
                    0 == c._d.els.length && delete c._d[g]
                }
            }
        },
        isEmptyInlineElement: function(a) {
            if (1 != a.nodeType || !g.$removeEmpty[a.tagName]) return 0;
            for (a = a.firstChild; a;) {
                if (j.isBookmarkNode(a)) return 0;
                if (1 == a.nodeType && !j.isEmptyInlineElement(a) || 3 == a.nodeType && !j.isWhitespace(a)) return 0;
                a = a.nextSibling
            }
            return 1
        },
        isBlockElm: function(a) {
            return 1 == a.nodeType && (g.$block[a.tagName] || i[j.getComputedStyle(a, "display")]) && !g.$nonChild[a.tagName]
        },
        getElementsByTagName: function(a, b, c) {
            if (c && e.isString(c)) {
                var d = c;
                c = function(a) {
                    var b = !1;
                    return $.each(e.trim(d).replace(/[ ]{2,}/g, " ").split(" "),
                    function(c, d) {
                        return $(a).hasClass(d) ? (b = !0, !1) : void 0
                    }),
                    b
                }
            }
            b = e.trim(b).replace(/[ ]{2,}/g, " ").split(" ");
            for (var f, g = [], h = 0; f = b[h++];) for (var i, j = a.getElementsByTagName(f), k = 0; i = j[k++];)(!c || c(i)) && g.push(i);
            return g
        },
        unSelectable: d || c.opera ?
        function(a) {
            a.onselectstart = function() {
                return ! 1
            },
            a.onclick = a.onkeyup = a.onkeydown = function() {
                return ! 1
            },
            a.unselectable = "on",
            a.setAttribute("unselectable", "on");
            for (var b, c = 0; b = a.all[c++];) switch (b.tagName.toLowerCase()) {
            case "iframe":
            case "textarea":
            case "input":
            case "select":
                break;
            default:
                b.unselectable = "on",
                a.setAttribute("unselectable", "on")
            }
        }: function(a) {
            a.style.MozUserSelect = a.style.webkitUserSelect = a.style.KhtmlUserSelect = "none"
        },
        removeAttributes: function(a, b) {
            b = e.isArray(b) ? b: e.trim(b).replace(/[ ]{2,}/g, " ").split(" ");
            for (var d, f = 0; d = b[f++];) {
                switch (d = h[d] || d) {
                case "className":
                    a[d] = "";
                    break;
                case "style":
                    a.style.cssText = "",
                    !c.ie && a.removeAttributeNode(a.getAttributeNode("style"))
                }
                a.removeAttribute(d)
            }
        },
        createElement: function(a, b, c) {
            return j.setAttributes(a.createElement(b), c)
        },
        setAttributes: function(a, b) {
            for (var c in b) if (b.hasOwnProperty(c)) {
                var d = b[c];
                switch (c) {
                case "class":
                    a.className = d;
                    break;
                case "style":
                    a.style.cssText = a.style.cssText + ";" + d;
                    break;
                case "innerHTML":
                    a[c] = d;
                    break;
                case "value":
                    a.value = d;
                    break;
                default:
                    a.setAttribute(h[c] || c, d)
                }
            }
            return a
        },
        getComputedStyle: function(a, b) {
            return e.transUnitToPx(e.fixColor(b, $(a).css(b)))
        },
        preventDefault: function(a) {
            a.preventDefault ? a.preventDefault() : a.returnValue = !1
        },
        getStyle: function(a, b) {
            var c = a.style[e.cssStyleToDomStyle(b)];
            return e.fixColor(b, c)
        },
        setStyle: function(a, b, c) {
            a.style[e.cssStyleToDomStyle(b)] = c,
            e.trim(a.style.cssText) || this.removeAttributes(a, "style")
        },
        removeDirtyAttr: function(a) {
            for (var b, c = 0,
            d = a.getElementsByTagName("*"); b = d[c++];) b.removeAttribute("_moz_dirty");
            a.removeAttribute("_moz_dirty")
        },
        getChildCount: function(a, b) {
            var c = 0,
            d = a.firstChild;
            for (b = b ||
            function() {
                return 1
            }; d;) b(d) && c++,
            d = d.nextSibling;
            return c
        },
        isEmptyNode: function(a) {
            return ! a.firstChild || 0 == j.getChildCount(a,
            function(a) {
                return ! j.isBr(a) && !j.isBookmarkNode(a) && !j.isWhitespace(a)
            })
        },
        isBr: function(a) {
            return 1 == a.nodeType && "BR" == a.tagName
        },
        isFillChar: function(a, b) {
            return 3 == a.nodeType && !a.nodeValue.replace(new RegExp((b ? "^": "") + j.fillChar), "").length
        },
        isEmptyBlock: function(a, b) {
            if (1 != a.nodeType) return 0;
            if (b = b || new RegExp("[ 	\r\n" + j.fillChar + "]", "g"), a[c.ie ? "innerText": "textContent"].replace(b, "").length > 0) return 0;
            for (var d in g.$isNotEmpty) if (a.getElementsByTagName(d).length) return 0;
            return 1
        },
        isCustomeNode: function(a) {
            return 1 == a.nodeType && a.getAttribute("_ue_custom_node_")
        },
        fillNode: function(a, b) {
            var d = c.ie ? a.createTextNode(j.fillChar) : a.createElement("br");
            b.innerHTML = "",
            b.appendChild(d)
        },
        isBoundaryNode: function(a, b) {
            for (var c; ! j.isBody(a);) if (c = a, a = a.parentNode, c !== a[b]) return ! 1;
            return ! 0
        },
        isFillChar: function(a, b) {
            return 3 == a.nodeType && !a.nodeValue.replace(new RegExp((b ? "^": "") + j.fillChar), "").length
        }
    },
    k = new RegExp(j.fillChar, "g"); !
    function() {
        function a(a) {
            a.collapsed = a.startContainer && a.endContainer && a.startContainer === a.endContainer && a.startOffset == a.endOffset
        }
        function d(a) {
            return ! a.collapsed && 1 == a.startContainer.nodeType && a.startContainer === a.endContainer && 1 == a.endOffset - a.startOffset
        }
        function e(b, c, d, e) {
            return 1 == c.nodeType && (g.$empty[c.tagName] || g.$nonChild[c.tagName]) && (d = j.getNodeIndex(c) + (b ? 0 : 1), c = c.parentNode),
            b ? (e.startContainer = c, e.startOffset = d, e.endContainer || e.collapse(!0)) : (e.endContainer = c, e.endOffset = d, e.startContainer || e.collapse(!1)),
            a(e),
            e
        }
        function f(a, b) {
            try {
                if (l && j.inDoc(l, a)) if (l.nodeValue.replace(k, "").length) l.nodeValue = l.nodeValue.replace(k, "");
                else {
                    var d = l.parentNode;
                    for (j.remove(l); d && j.isEmptyInlineElement(d) && (c.safari ? !(j.getPosition(d, b) & j.POSITION_CONTAINS) : !d.contains(b));) l = d.parentNode,
                    j.remove(d),
                    d = l
                }
            } catch(e) {}
        }
        function h(a, b) {
            var c;
            for (a = a[b]; a && j.isFillChar(a);) c = a[b],
            j.remove(a),
            a = c
        }
        function i(a, b) {
            var c, d, e = a.startContainer,
            f = a.endContainer,
            g = a.startOffset,
            h = a.endOffset,
            i = a.document,
            k = i.createDocumentFragment();
            if (1 == e.nodeType && (e = e.childNodes[g] || (c = e.appendChild(i.createTextNode("")))), 1 == f.nodeType && (f = f.childNodes[h] || (d = f.appendChild(i.createTextNode("")))), e === f && 3 == e.nodeType) return k.appendChild(i.createTextNode(e.substringData(g, h - g))),
            b && (e.deleteData(g, h - g), a.collapse(!0)),
            k;
            for (var l, m, n = k,
            o = j.findParents(e, !0), p = j.findParents(f, !0), q = 0; o[q] == p[q];) q++;
            for (var r, s = q; r = o[s]; s++) {
                for (l = r.nextSibling, r == e ? c || (3 == a.startContainer.nodeType ? (n.appendChild(i.createTextNode(e.nodeValue.slice(g))), b && e.deleteData(g, e.nodeValue.length - g)) : n.appendChild(b ? e: e.cloneNode(!0))) : (m = r.cloneNode(!1), n.appendChild(m)); l && l !== f && l !== p[s];) r = l.nextSibling,
                n.appendChild(b ? l: l.cloneNode(!0)),
                l = r;
                n = m
            }
            n = k,
            o[q] || (n.appendChild(o[q - 1].cloneNode(!1)), n = n.firstChild);
            for (var t, s = q; t = p[s]; s++) {
                if (l = t.previousSibling, t == f ? d || 3 != a.endContainer.nodeType || (n.appendChild(i.createTextNode(f.substringData(0, h))), b && f.deleteData(0, h)) : (m = t.cloneNode(!1), n.appendChild(m)), s != q || !o[q]) for (; l && l !== e;) t = l.previousSibling,
                n.insertBefore(b ? l: l.cloneNode(!0), n.firstChild),
                l = t;
                n = m
            }
            return b && a.setStartBefore(p[q] ? o[q] ? p[q] : o[q - 1] : p[q - 1]).collapse(!0),
            c && j.remove(c),
            d && j.remove(d),
            k
        }
        var l, m = 0,
        n = j.fillChar,
        o = b.Range = function(a, b) {
            var c = this;
            c.startContainer = c.startOffset = c.endContainer = c.endOffset = null,
            c.document = a,
            c.collapsed = !0,
            c.body = b
        };
        o.prototype = {
            deleteContents: function() {
                var a;
                return this.collapsed || i(this, 1),
                c.webkit && (a = this.startContainer, 3 != a.nodeType || a.nodeValue.length || (this.setStartBefore(a).collapse(!0), j.remove(a))),
                this
            },
            inFillChar: function() {
                var a = this.startContainer;
                return this.collapsed && 3 == a.nodeType && a.nodeValue.replace(new RegExp("^" + j.fillChar), "").length + 1 == a.nodeValue.length ? !0 : !1
            },
            setStart: function(a, b) {
                return e(!0, a, b, this)
            },
            setEnd: function(a, b) {
                return e(!1, a, b, this)
            },
            setStartAfter: function(a) {
                return this.setStart(a.parentNode, j.getNodeIndex(a) + 1)
            },
            setStartBefore: function(a) {
                return this.setStart(a.parentNode, j.getNodeIndex(a))
            },
            setEndAfter: function(a) {
                return this.setEnd(a.parentNode, j.getNodeIndex(a) + 1)
            },
            setEndBefore: function(a) {
                return this.setEnd(a.parentNode, j.getNodeIndex(a))
            },
            setStartAtFirst: function(a) {
                return this.setStart(a, 0)
            },
            setStartAtLast: function(a) {
                return this.setStart(a, 3 == a.nodeType ? a.nodeValue.length: a.childNodes.length)
            },
            setEndAtFirst: function(a) {
                return this.setEnd(a, 0)
            },
            setEndAtLast: function(a) {
                return this.setEnd(a, 3 == a.nodeType ? a.nodeValue.length: a.childNodes.length)
            },
            selectNode: function(a) {
                return this.setStartBefore(a).setEndAfter(a)
            },
            selectNodeContents: function(a) {
                return this.setStart(a, 0).setEndAtLast(a)
            },
            cloneRange: function() {
                var a = this;
                return new o(a.document).setStart(a.startContainer, a.startOffset).setEnd(a.endContainer, a.endOffset)
            },
            collapse: function(a) {
                var b = this;
                return a ? (b.endContainer = b.startContainer, b.endOffset = b.startOffset) : (b.startContainer = b.endContainer, b.startOffset = b.endOffset),
                b.collapsed = !0,
                b
            },
            shrinkBoundary: function(a) {
                function b(a) {
                    return 1 == a.nodeType && !j.isBookmarkNode(a) && !g.$empty[a.tagName] && !g.$nonChild[a.tagName]
                }
                for (var c, d = this,
                e = d.collapsed; 1 == d.startContainer.nodeType && (c = d.startContainer.childNodes[d.startOffset]) && b(c);) d.setStart(c, 0);
                if (e) return d.collapse(!0);
                if (!a) for (; 1 == d.endContainer.nodeType && d.endOffset > 0 && (c = d.endContainer.childNodes[d.endOffset - 1]) && b(c);) d.setEnd(c, c.childNodes.length);
                return d
            },
            trimBoundary: function(a) {
                this.txtToElmBoundary();
                var b = this.startContainer,
                c = this.startOffset,
                d = this.collapsed,
                e = this.endContainer;
                if (3 == b.nodeType) {
                    if (0 == c) this.setStartBefore(b);
                    else if (c >= b.nodeValue.length) this.setStartAfter(b);
                    else {
                        var f = j.split(b, c);
                        b === e ? this.setEnd(f, this.endOffset - c) : b.parentNode === e && (this.endOffset += 1),
                        this.setStartBefore(f)
                    }
                    if (d) return this.collapse(!0)
                }
                return a || (c = this.endOffset, e = this.endContainer, 3 == e.nodeType && (0 == c ? this.setEndBefore(e) : (c < e.nodeValue.length && j.split(e, c), this.setEndAfter(e)))),
                this
            },
            txtToElmBoundary: function(a) {
                function b(a, b) {
                    var c = a[b + "Container"],
                    d = a[b + "Offset"];
                    3 == c.nodeType && (d ? d >= c.nodeValue.length && a["set" + b.replace(/(\w)/,
                    function(a) {
                        return a.toUpperCase()
                    }) + "After"](c) : a["set" + b.replace(/(\w)/,
                    function(a) {
                        return a.toUpperCase()
                    }) + "Before"](c))
                }
                return (a || !this.collapsed) && (b(this, "start"), b(this, "end")),
                this
            },
            insertNode: function(a) {
                var b = a,
                c = 1;
                11 == a.nodeType && (b = a.firstChild, c = a.childNodes.length),
                this.trimBoundary(!0);
                var d = this.startContainer,
                e = this.startOffset,
                f = d.childNodes[e];
                return f ? d.insertBefore(a, f) : d.appendChild(a),
                b.parentNode === this.endContainer && (this.endOffset = this.endOffset + c),
                this.setStartBefore(b)
            },
            setCursor: function(a, b) {
                return this.collapse(!a).select(b)
            },
            createBookmark: function(a, b) {
                var c, d = this.document.createElement("span");
                return d.style.cssText = "display:none;line-height:0px;",
                d.appendChild(this.document.createTextNode("‍")),
                d.id = "_baidu_bookmark_start_" + (b ? "": m++),
                this.collapsed || (c = d.cloneNode(!0), c.id = "_baidu_bookmark_end_" + (b ? "": m++)),
                this.insertNode(d),
                c && this.collapse().insertNode(c).setEndBefore(c),
                this.setStartAfter(d),
                {
                    start: a ? d.id: d,
                    end: c ? a ? c.id: c: null,
                    id: a
                }
            },
            moveToBookmark: function(a) {
                var b = a.id ? this.document.getElementById(a.start) : a.start,
                c = a.end && a.id ? this.document.getElementById(a.end) : a.end;
                return this.setStartBefore(b),
                j.remove(b),
                c ? (this.setEndBefore(c), j.remove(c)) : this.collapse(!0),
                this
            },
            adjustmentBoundary: function() {
                if (!this.collapsed) {
                    for (; ! j.isBody(this.startContainer) && this.startOffset == this.startContainer[3 == this.startContainer.nodeType ? "nodeValue": "childNodes"].length && this.startContainer[3 == this.startContainer.nodeType ? "nodeValue": "childNodes"].length;) this.setStartAfter(this.startContainer);
                    for (; ! j.isBody(this.endContainer) && !this.endOffset && this.endContainer[3 == this.endContainer.nodeType ? "nodeValue": "childNodes"].length;) this.setEndBefore(this.endContainer)
                }
                return this
            },
            getClosedNode: function() {
                var a;
                if (!this.collapsed) {
                    var b = this.cloneRange().adjustmentBoundary().shrinkBoundary();
                    if (d(b)) {
                        var c = b.startContainer.childNodes[b.startOffset];
                        c && 1 == c.nodeType && (g.$empty[c.tagName] || g.$nonChild[c.tagName]) && (a = c)
                    }
                }
                return a
            },
            select: c.ie ?
            function(a, b) {
                var c;
                this.collapsed || this.shrinkBoundary();
                var d = this.getClosedNode();
                if (d && !b) {
                    try {
                        c = this.document.body.createControlRange(),
                        c.addElement(d),
                        c.select()
                    } catch(e) {}
                    return this
                }
                var g, i = this.createBookmark(),
                k = i.start;
                if (c = this.document.body.createTextRange(), c.moveToElementText(k), c.moveStart("character", 1), this.collapsed) {
                    if (!a && 3 != this.startContainer.nodeType) {
                        var m = this.document.createTextNode(n),
                        o = this.document.createElement("span");
                        o.appendChild(this.document.createTextNode(n)),
                        k.parentNode.insertBefore(o, k),
                        k.parentNode.insertBefore(m, k),
                        f(this.document, m),
                        l = m,
                        h(o, "previousSibling"),
                        h(k, "nextSibling"),
                        c.moveStart("character", -1),
                        c.collapse(!0)
                    }
                } else {
                    var p = this.document.body.createTextRange();
                    g = i.end,
                    p.moveToElementText(g),
                    c.setEndPoint("EndToEnd", p)
                }
                this.moveToBookmark(i),
                o && j.remove(o);
                try {
                    c.select()
                } catch(e) {}
                return this
            }: function(a) {
                function b(a) {
                    function b(b, c, d) {
                        3 == b.nodeType && b.nodeValue.length < c && (a[d + "Offset"] = b.nodeValue.length)
                    }
                    b(a.startContainer, a.startOffset, "start"),
                    b(a.endContainer, a.endOffset, "end")
                }
                var d, e = j.getWindow(this.document),
                g = e.getSelection();
                if (c.gecko ? this.body.focus() : e.focus(), g) {
                    if (g.removeAllRanges(), this.collapsed && !a) {
                        var i = this.startContainer,
                        k = i;
                        1 == i.nodeType && (k = i.childNodes[this.startOffset]),
                        3 == i.nodeType && this.startOffset || (k ? k.previousSibling && 3 == k.previousSibling.nodeType: i.lastChild && 3 == i.lastChild.nodeType) || (d = this.document.createTextNode(n), this.insertNode(d), f(this.document, d), h(d, "previousSibling"), h(d, "nextSibling"), l = d, this.setStart(d, c.webkit ? 1 : 0).collapse(!0))
                    }
                    var m = this.document.createRange();
                    if (this.collapsed && c.opera && 1 == this.startContainer.nodeType) {
                        var k = this.startContainer.childNodes[this.startOffset];
                        if (k) {
                            for (; k && j.isBlockElm(k) && 1 == k.nodeType && k.childNodes[0];) k = k.childNodes[0];
                            k && this.setStartBefore(k).collapse(!0)
                        } else k = this.startContainer.lastChild,
                        k && j.isBr(k) && this.setStartBefore(k).collapse(!0)
                    }
                    b(this),
                    m.setStart(this.startContainer, this.startOffset),
                    m.setEnd(this.endContainer, this.endOffset),
                    g.addRange(m)
                }
                return this
            },
            createAddress: function(a, b) {
                function c(a) {
                    for (var c, d = a ? e.startContainer: e.endContainer, f = j.findParents(d, !0,
                    function(a) {
                        return ! j.isBody(a)
                    }), g = [], h = 0; c = f[h++];) g.push(j.getNodeIndex(c, b));
                    var i = 0;
                    if (b) if (3 == d.nodeType) {
                        for (var l = d.previousSibling; l && 3 == l.nodeType;) i += l.nodeValue.replace(k, "").length,
                        l = l.previousSibling;
                        i += a ? e.startOffset: e.endOffset
                    } else if (d = d.childNodes[a ? e.startOffset: e.endOffset]) i = j.getNodeIndex(d, b);
                    else {
                        d = a ? e.startContainer: e.endContainer;
                        for (var m = d.firstChild; m;) if (j.isFillChar(m)) m = m.nextSibling;
                        else if (i++, 3 == m.nodeType) for (; m && 3 == m.nodeType;) m = m.nextSibling;
                        else m = m.nextSibling
                    } else i = a ? j.isFillChar(d) ? 0 : e.startOffset: e.endOffset;
                    return 0 > i && (i = 0),
                    g.push(i),
                    g
                }
                var d = {},
                e = this;
                return d.startAddress = c(!0),
                a || (d.endAddress = e.collapsed ? [].concat(d.startAddress) : c()),
                d
            },
            moveToAddress: function(a, b) {
                function c(a, b) {
                    for (var c, e, f, g = d.body,
                    h = 0,
                    i = a.length; i > h; h++) if (f = a[h], c = g, g = g.childNodes[f], !g) {
                        e = f;
                        break
                    }
                    b ? g ? d.setStartBefore(g) : d.setStart(c, e) : g ? d.setEndBefore(g) : d.setEnd(c, e)
                }
                var d = this;
                return c(a.startAddress, !0),
                !b && a.endAddress && c(a.endAddress),
                d
            },
            equals: function(a) {
                for (var b in this) if (this.hasOwnProperty(b) && this[b] !== a[b]) return ! 1;
                return ! 0
            },
            scrollIntoView: function() {
                var a = $('<span style="padding:0;margin:0;display:block;border:0">&nbsp;</span>');
                this.cloneRange().insertNode(a.get(0));
                var b = $(window).scrollTop(),
                c = $(window).height(),
                d = a.offset().top; (b - c > d || d > b + c) && (d > b + c ? window.scrollTo(0, d - c + a.height()) : window.scrollTo(0, b - d)),
                a.remove()
            }
        }
    } (),
    function() {
        function a(a, b) {
            var c = j.getNodeIndex;
            a = a.duplicate(),
            a.collapse(b);
            var d = a.parentElement();
            if (!d.hasChildNodes()) return {
                container: d,
                offset: 0
            };
            for (var e, f, h = d.children,
            i = a.duplicate(), k = 0, l = h.length - 1, m = -1; l >= k;) {
                m = Math.floor((k + l) / 2),
                e = h[m],
                i.moveToElementText(e);
                var n = i.compareEndPoints("StartToStart", a);
                if (n > 0) l = m - 1;
                else {
                    if (! (0 > n)) return {
                        container: d,
                        offset: c(e)
                    };
                    k = m + 1
                }
            }
            if ( - 1 == m) {
                if (i.moveToElementText(d), i.setEndPoint("StartToStart", a), f = i.text.replace(/(\r\n|\r)/g, "\n").length, h = d.childNodes, !f) return e = h[h.length - 1],
                {
                    container: e,
                    offset: e.nodeValue.length
                };
                for (var o = h.length; f > 0;) f -= h[--o].nodeValue.length;
                return {
                    container: h[o],
                    offset: -f
                }
            }
            if (i.collapse(n > 0), i.setEndPoint(n > 0 ? "StartToStart": "EndToStart", a), f = i.text.replace(/(\r\n|\r)/g, "\n").length, !f) return g.$empty[e.tagName] || g.$nonChild[e.tagName] ? {
                container: d,
                offset: c(e) + (n > 0 ? 0 : 1)
            }: {
                container: e,
                offset: n > 0 ? 0 : e.childNodes.length
            };
            for (; f > 0;) try {
                var p = e;
                e = e[n > 0 ? "previousSibling": "nextSibling"],
                f -= e.nodeValue.length
            } catch(q) {
                return {
                    container: d,
                    offset: c(p)
                }
            }
            return {
                container: e,
                offset: n > 0 ? -f: e.nodeValue.length + f
            }
        }
        function d(b, c) {
            if (b.item) c.selectNode(b.item(0));
            else {
                var d = a(b, !0);
                c.setStart(d.container, d.offset),
                0 != b.compareEndPoints("StartToEnd", b) && (d = a(b, !1), c.setEnd(d.container, d.offset))
            }
            return c
        }
        function e(a, b) {
            var c;
            try {
                c = a.getNative(b).createRange()
            } catch(d) {
                return null
            }
            var e = c.item ? c.item(0) : c.parentElement();
            return (e.ownerDocument || e) === a.document ? c: null
        }
        var f = b.Selection = function(a, b) {
            var d = this;
            d.document = a,
            d.body = b,
            c.ie9below && (j.on(b, "beforedeactivate",
            function() {
                d._bakIERange = d.getIERange()
            }), j.on(b, "activate",
            function() {
                try {
                    var a = e(d);
                    a && d.rangeInBody(a) || !d._bakIERange || d._bakIERange.select()
                } catch(b) {}
                d._bakIERange = null
            }))
        };
        f.prototype = {
            hasNativeRange: function() {
                var a;
                if (!c.ie || c.ie9above) {
                    var b = this.getNative();
                    if (!b.rangeCount) return ! 1;
                    a = b.getRangeAt(0)
                } else a = e(this);
                return this.rangeInBody(a)
            },
            getNative: function(a) {
                var b = this.document;
                try {
                    return b ? c.ie9below || a ? b.selection: j.getWindow(b).getSelection() : null
                } catch(d) {
                    return null
                }
            },
            getIERange: function(a) {
                var b = e(this, a);
                return b && this.rangeInBody(b, a) || !this._bakIERange ? b: this._bakIERange
            },
            rangeInBody: function(a, b) {
                var d = c.ie9below || b ? a.item ? a.item() : a.parentElement() : a.startContainer;
                return d === this.body || j.inDoc(d, this.body)
            },
            cache: function() {
                this.clear(),
                this._cachedRange = this.getRange(),
                this._cachedStartElement = this.getStart(),
                this._cachedStartElementPath = this.getStartElementPath()
            },
            getStartElementPath: function() {
                if (this._cachedStartElementPath) return this._cachedStartElementPath;
                var a = this.getStart();
                return a ? j.findParents(a, !0, null, !0) : []
            },
            clear: function() {
                this._cachedStartElementPath = this._cachedRange = this._cachedStartElement = null
            },
            isFocus: function() {
                return this.hasNativeRange()
            },
            getRange: function() {
                function a(a) {
                    for (var b = e.body.firstChild,
                    c = a.collapsed; b && b.firstChild;) a.setStart(b, 0),
                    b = b.firstChild;
                    a.startContainer || a.setStart(e.body, 0),
                    c && a.collapse(!0)
                }
                var e = this;
                if (null != e._cachedRange) return this._cachedRange;
                var f = new b.Range(e.document, e.body);
                if (c.ie9below) {
                    var g = e.getIERange();
                    if (g && this.rangeInBody(g)) try {
                        d(g, f)
                    } catch(h) {
                        a(f)
                    } else a(f)
                } else {
                    var i = e.getNative();
                    if (i && i.rangeCount && e.rangeInBody(i.getRangeAt(0))) {
                        var k = i.getRangeAt(0),
                        l = i.getRangeAt(i.rangeCount - 1);
                        f.setStart(k.startContainer, k.startOffset).setEnd(l.endContainer, l.endOffset),
                        f.collapsed && j.isBody(f.startContainer) && !f.startOffset && a(f)
                    } else {
                        if (this._bakRange && (this._bakRange.startContainer === this.body || j.inDoc(this._bakRange.startContainer, this.body))) return this._bakRange;
                        a(f)
                    }
                }
                return this._bakRange = f
            },
            getStart: function() {
                if (this._cachedStartElement) return this._cachedStartElement;
                var a, b, d, e, f = c.ie9below ? this.getIERange() : this.getRange();
                if (c.ie9below) {
                    if (!f) return this.document.body.firstChild;
                    if (f.item) return f.item(0);
                    for (a = f.duplicate(), a.text.length > 0 && a.moveStart("character", 1), a.collapse(1), b = a.parentElement(), e = d = f.parentElement(); d = d.parentNode;) if (d == b) {
                        b = e;
                        break
                    }
                } else if (b = f.startContainer, 1 == b.nodeType && b.hasChildNodes() && (b = b.childNodes[Math.min(b.childNodes.length - 1, f.startOffset)]), 3 == b.nodeType) return b.parentNode;
                return b
            },
            getText: function() {
                var a, b;
                return this.isFocus() && (a = this.getNative()) ? (b = c.ie9below ? a.createRange() : a.getRangeAt(0), c.ie9below ? b.text: b.toString()) : ""
            }
        }
    } (),
    function() {
        function a(a, b) {
            var c;
            if (b.textarea) if (e.isString(b.textarea)) {
                for (var d, f = 0,
                g = j.getElementsByTagName(a, "textarea"); d = g[f++];) if (d.id == "umeditor_textarea_" + b.options.textarea) {
                    c = d;
                    break
                }
            } else c = b.textarea;
            c || (a.appendChild(c = j.createElement(document, "textarea", {
                name: b.options.textarea,
                id: "umeditor_textarea_" + b.options.textarea,
                style: "display:none"
            })), b.textarea = c),
            c.value = b.hasContents() ? b.options.allHtmlEnabled ? b.getAllHtml() : b.getContent(null, null, !0) : ""
        }
        function h(a) {
            for (var b in UM.plugins) UM.plugins[b].call(a);
            a.langIsReady = !0,
            a.fireEvent("langReady")
        }
        function i(a) {
            for (var b in a) return b
        }
        var k, l = 0,
        m = UM.Editor = function(a) {
            var b = this;
            b.uid = l++,
            f.call(b),
            b.commands = {},
            b.options = e.extend(e.clone(a || {}), UMEDITOR_CONFIG, !0),
            b.shortcutkeys = {},
            b.inputRules = [],
            b.outputRules = [],
            b.setOpt({
                isShow: !0,
                initialContent: "",
                initialStyle: "",
                autoClearinitialContent: !1,
                textarea: "editorValue",
                focus: !1,
                focusInEnd: !0,
                autoClearEmptyNode: !0,
                fullscreen: !1,
                readonly: !1,
                zIndex: 999,
                enterTag: "p",
                lang: "zh-cn",
                langPath: b.options.UMEDITOR_HOME_URL + "lang/",
                theme: "default",
                themePath: b.options.UMEDITOR_HOME_URL + "themes/",
                allHtmlEnabled: !1,
                autoSyncData: !0,
                autoHeightEnabled: !0
            }),
            e.isEmptyObject(UM.I18N) ? e.loadFile(document, {
                src: b.options.langPath + b.options.lang + "/" + b.options.lang + ".js",
                tag: "script",
                type: "text/javascript",
                defer: "defer"
            },
            function() {
                h(b)
            }) : (b.options.lang = i(UM.I18N), h(b))
        };
        m.prototype = {
            ready: function(a) {
                var b = this;
                a && (b.isReady ? a.apply(b) : b.addListener("ready", a))
            },
            setOpt: function(a, b) {
                var c = {};
                e.isString(a) ? c[a] = b: c = a,
                e.extend(this.options, c, !0)
            },
            getOpt: function(a) {
                return this.options[a] || ""
            },
            destroy: function() {
                var a = this;
                a.fireEvent("destroy");
                var b = a.container.parentNode;
                b === document.body && (b = a.container);
                var c = a.textarea;
                c ? c.style.display = "": (c = document.createElement("textarea"), b.parentNode.insertBefore(c, b)),
                c.style.width = a.body.offsetWidth + "px",
                c.style.height = a.body.offsetHeight + "px",
                c.value = a.getContent(),
                c.id = a.key,
                b.contains(c) && $(c).insertBefore(b),
                b.innerHTML = "",
                j.remove(b),
                UM.clearCache(a.id);
                for (var d in a) a.hasOwnProperty(d) && delete this[d]
            },
            initialCont: function(a) {
                if (a) {
                    if (a.getAttribute("name") && (this.options.textarea = a.getAttribute("name")), a && /script|textarea/gi.test(a.tagName)) {
                        var b = document.createElement("div");
                        a.parentNode.insertBefore(b, a),
                        this.options.initialContent = UM.htmlparser(a.value || a.innerHTML || this.options.initialContent).toHtml(),
                        a.className && (b.className = a.className),
                        a.style.cssText && (b.style.cssText = a.style.cssText),
                        /textarea/i.test(a.tagName) ? (this.textarea = a, this.textarea.style.display = "none") : (a.parentNode.removeChild(a), a.id && (b.id = a.id)),
                        a = b,
                        a.innerHTML = ""
                    }
                    return a
                }
                return null
            },
            render: function(a) {
                var b = this,
                d = b.options,
                f = function(b) {
                    return parseInt($(a).css(b))
                };
                if (e.isString(a) && (a = document.getElementById(a)), a) {
                    this.id = a.getAttribute("id"),
                    UM.setEditor(this),
                    e.cssRule("umeditor_body_css", b.options.initialStyle, document),
                    a = this.initialCont(a),
                    a.className += " edui-body-container",
                    d.minFrameWidth = d.initialFrameWidth ? d.initialFrameWidth: d.initialFrameWidth = $(a).width() || UM.defaultWidth,
                    d.initialFrameHeight ? d.minFrameHeight = d.initialFrameHeight: d.initialFrameHeight = d.minFrameHeight = $(a).height() || UM.defaultHeight,
                    a.style.width = /%$/.test(d.initialFrameWidth) ? "100%": d.initialFrameWidth - f("padding-left") - f("padding-right") + "px";
                    var g = /%$/.test(d.initialFrameHeight) ? "100%": d.initialFrameHeight - f("padding-top") - f("padding-bottom");
                    this.options.autoHeightEnabled ? (a.style.minHeight = g + "px", a.style.height = "", c.ie && c.version <= 6 && (a.style.height = g, a.style.setExpression("height", "this.scrollHeight <= " + g + ' ? "' + g + 'px" : "auto"'))) : $(a).height(g),
                    a.style.zIndex = d.zIndex,
                    this._setup(a)
                }
            },
            _setup: function(d) {
                var e = this,
                f = e.options;
                d.contentEditable = !0,
                document.body.spellcheck = !1,
                e.document = document,
                e.window = document.defaultView || document.parentWindow,
                e.body = d,
                e.$body = $(d),
                j.isBody = function(a) {
                    return a === d
                },
                e.selection = new b.Selection(document, e.body);
                var g;
                c.gecko && (g = this.selection.getNative()) && g.removeAllRanges(),
                this._initEvents();
                for (var h = d.parentNode; h && !j.isBody(h); h = h.parentNode) if ("FORM" == h.tagName) {
                    e.form = h,
                    e.options.autoSyncData ? j.on(d, "blur",
                    function() {
                        a(h, e)
                    }) : j.on(h, "submit",
                    function() {
                        a(this, e)
                    });
                    break
                }
                if (f.initialContent) if (f.autoClearinitialContent) {
                    var i = e.execCommand;
                    e.execCommand = function() {
                        return e.fireEvent("firstBeforeExecCommand"),
                        i.apply(e, arguments)
                    },
                    this._setDefaultContent(f.initialContent)
                } else this.setContent(f.initialContent, !1, !0);
                j.isEmptyNode(e.body) && (e.body.innerHTML = "<p>" + (c.ie ? "": "<br/>") + "</p>"),
                f.focus && setTimeout(function() {
                    e.focus(e.options.focusInEnd),
                    !e.options.autoClearinitialContent && e._selectionChange()
                },
                0),
                e.container || (e.container = d.parentNode),
                e._bindshortcutKeys(),
                e.isReady = 1,
                e.fireEvent("ready"),
                f.onready && f.onready.call(e),
                (!c.ie || c.ie9above) && j.on(e.body, ["blur", "focus"],
                function(a) {
                    var b = e.selection.getNative();
                    if ("blur" == a.type) b.rangeCount > 0 && (e._bakRange = b.getRangeAt(0));
                    else {
                        try {
                            e._bakRange && b.addRange(e._bakRange)
                        } catch(a) {}
                        e._bakRange = null
                    }
                }),
                !f.isShow && e.setHide(),
                f.readonly && e.setDisabled()
            },
            sync: function(b) {
                var c = this,
                d = b ? document.getElementById(b) : j.findParent(c.body.parentNode,
                function(a) {
                    return "FORM" == a.tagName
                },
                !0);
                d && a(d, c)
            },
            setHeight: function(a, b) { ! b && (this.options.initialFrameHeight = a),
                this.options.autoHeightEnabled ? ($(this.body).css({
                    "min-height": a + "px"
                }), c.ie && c.version <= 6 && this.container && (this.container.style.height = a, this.container.style.setExpression("height", "this.scrollHeight <= " + a + ' ? "' + a + 'px" : "auto"'))) : $(this.body).height(a)
            },
            setWidth: function(a) {
                this.$container && this.$container.width(a),
                $(this.body).width(a - 1 * $(this.body).css("padding-left").replace("px", "") - 1 * $(this.body).css("padding-right").replace("px", ""))
            },
            addshortcutkey: function(a, b) {
                var c = {};
                b ? c[a] = b: c = a,
                e.extend(this.shortcutkeys, c)
            },
            _bindshortcutKeys: function() {
                var a = this,
                b = this.shortcutkeys;
                a.addListener("keydown",
                function(c, d) {
                    var e = d.keyCode || d.which;
                    for (var f in b) for (var g, h = b[f].split(","), i = 0; g = h[i++];) {
                        g = g.split(":");
                        var k = g[0],
                        l = g[1]; (/^(ctrl)(\+shift)?\+(\d+)$/.test(k.toLowerCase()) || /^(\d+)$/.test(k)) && (("ctrl" == RegExp.$1 ? d.ctrlKey || d.metaKey: 0) && ("" != RegExp.$2 ? d[RegExp.$2.slice(1) + "Key"] : 1) && e == RegExp.$3 || e == RegExp.$1) && ( - 1 != a.queryCommandState(f, l) && a.execCommand(f, l), j.preventDefault(d))
                    }
                })
            },
            getContent: function(a, b, c, d, f) {
                var g = this;
                if (a && e.isFunction(a) && (b = a, a = ""), b ? !b() : !this.hasContents()) return "";
                g.fireEvent("beforegetcontent");
                var h = UM.htmlparser(g.body.innerHTML, d);
                return g.filterOutputRule(h),
                g.fireEvent("aftergetcontent", h),
                h.toHtml(f)
            },
            getAllHtml: function() {
                var a = this,
                b = [];
                if (a.fireEvent("getAllHtml", b), c.ie && c.version > 8) {
                    var f = "";
                    e.each(a.document.styleSheets,
                    function(a) {
                        f += a.href ? '<link rel="stylesheet" type="text/css" href="' + a.href + '" />': "<style>" + a.cssText + "</style>"
                    }),
                    e.each(a.document.getElementsByTagName("script"),
                    function(a) {
                        f += a.outerHTML
                    })
                }
                return "<html><head>" + (a.options.charset ? '<meta http-equiv="Content-Type" content="text/html; charset=' + a.options.charset + '"/>': "") + (f || a.document.getElementsByTagName("head")[0].innerHTML) + b.join("\n") + "</head>" + "<body " + (d && c.version < 9 ? 'class="view"': "") + ">" + a.getContent(null, null, !0) + "</body></html>"
            },
            getPlainTxt: function() {
                var a = new RegExp(j.fillChar, "g"),
                b = this.body.innerHTML.replace(/[\n\r]/g, "");
                return b = b.replace(/<(p|div)[^>]*>(<br\/?>|&nbsp;)<\/\1>/gi, "\n").replace(/<br\/?>/gi, "\n").replace(/<[^>/] + >/g,"").replace(/ (\n) ? <\ / ([ ^ >] + ) > /g,function(a,b,c){return g.$block[c]?"\n":b?b:""}),b.replace(a,"").replace(/\u00a0 / g,
                " ").replace(/&nbsp;/g, " ")
            },
            getContentTxt: function() {
                var a = new RegExp(j.fillChar, "g");
                return this.body[c.ie ? "innerText": "textContent"].replace(a, "").replace(/\u00a0/g, " ")
            },
            setContent: function(b, d, e) {
                function f(a) {
                    return "DIV" == a.tagName && a.getAttribute("cdata_tag")
                }
                var h = this;
                h.fireEvent("beforesetcontent", b);
                var i = UM.htmlparser(b);
                if (h.filterInputRule(i), b = i.toHtml(), h.body.innerHTML = (d ? h.body.innerHTML: "") + b, "p" == h.options.enterTag) {
                    var k, l = this.body.firstChild;
                    if (!l || 1 == l.nodeType && (g.$cdata[l.tagName] || f(l) || j.isCustomeNode(l)) && l === this.body.lastChild) this.body.innerHTML = "<p>" + (c.ie ? "&nbsp;": "<br/>") + "</p>" + this.body.innerHTML;
                    else for (var m = h.document.createElement("p"); l;) {
                        for (; l && (3 == l.nodeType || 1 == l.nodeType && g.p[l.tagName] && !g.$cdata[l.tagName]);) k = l.nextSibling,
                        m.appendChild(l),
                        l = k;
                        if (m.firstChild) {
                            if (!l) {
                                h.body.appendChild(m);
                                break
                            }
                            l.parentNode.insertBefore(m, l),
                            m = h.document.createElement("p")
                        }
                        l = l.nextSibling
                    }
                }
                h.fireEvent("aftersetcontent"),
                h.fireEvent("contentchange"),
                !e && h._selectionChange(),
                h._bakRange = h._bakIERange = h._bakNativeRange = null;
                var n;
                c.gecko && (n = this.selection.getNative()) && n.removeAllRanges(),
                h.options.autoSyncData && h.form && a(h.form, h)
            },
            focus: function(a) {
                try {
                    var b = this,
                    c = b.selection.getRange();
                    a ? c.setStartAtLast(b.body.lastChild).setCursor(!1, !0) : c.select(!0),
                    this.fireEvent("focus")
                } catch(d) {}
            },
            blur: function() {
                var a = this.selection.getNative();
                a.empty ? a.empty() : a.removeAllRanges(),
                this.fireEvent("blur")
            },
            isFocus: function() {
                return this.selection.isFocus()
            },
            _initEvents: function() {
                var a = this,
                b = a.body;
                a._proxyDomEvent = e.bind(a._proxyDomEvent, a),
                j.on(b, ["click", "contextmenu", "mousedown", "keydown", "keyup", "keypress", "mouseup", "mouseover", "mouseout", "selectstart"], a._proxyDomEvent),
                j.on(b, ["focus", "blur"], a._proxyDomEvent),
                j.on(b, ["mouseup", "keydown"],
                function(b) {
                    "keydown" == b.type && (b.ctrlKey || b.metaKey || b.shiftKey || b.altKey) || 2 != b.button && a._selectionChange(250, b)
                })
            },
            _proxyDomEvent: function(a) {
                return this.fireEvent(a.type.replace(/^on/, ""), a)
            },
            _selectionChange: function(a, b) {
                var d, e, f = this,
                g = !1;
                if (c.ie && c.version < 9 && b && "mouseup" == b.type) {
                    var h = this.selection.getRange();
                    h.collapsed || (g = !0, d = b.clientX, e = b.clientY)
                }
                clearTimeout(k),
                k = setTimeout(function() {
                    if (f.selection.getNative()) {
                        var a;
                        if (g && "None" == f.selection.getNative().type) {
                            a = f.document.body.createTextRange();
                            try {
                                a.moveToPoint(d, e)
                            } catch(c) {
                                a = null
                            }
                        }
                        var h;
                        a && (h = f.selection.getIERange, f.selection.getIERange = function() {
                            return a
                        }),
                        f.selection.cache(),
                        h && (f.selection.getIERange = h),
                        f.selection._cachedRange && f.selection._cachedStartElement && (f.fireEvent("beforeselectionchange"), f.fireEvent("selectionchange", !!b), f.fireEvent("afterselectionchange"), f.selection.clear())
                    }
                },
                a || 50)
            },
            _callCmdFn: function(a, b) {
                b = Array.prototype.slice.call(b, 0);
                var c, d, e = b.shift().toLowerCase();
                return c = this.commands[e] || UM.commands[e],
                d = c && c[a],
                c && d || "queryCommandState" != a ? d ? d.apply(this, [e].concat(b)) : void 0 : 0
            },
            execCommand: function(a) {
                if (!this.isFocus()) {
                    var b = this.selection._bakRange;
                    b ? b.select() : this.focus(!0)
                }
                a = a.toLowerCase();
                var c, d = this,
                e = d.commands[a] || UM.commands[a];
                return e && e.execCommand ? (e.notNeedUndo || d.__hasEnterExecCommand ? (c = this._callCmdFn("execCommand", arguments), !d._ignoreContentChange && d.fireEvent("contentchange")) : (d.__hasEnterExecCommand = !0, -1 != d.queryCommandState.apply(d, arguments) && (d.fireEvent("beforeexeccommand", a), c = this._callCmdFn("execCommand", arguments), !d._ignoreContentChange && d.fireEvent("contentchange"), d.fireEvent("afterexeccommand", a)), d.__hasEnterExecCommand = !1), !d._ignoreContentChange && d._selectionChange(), c) : null
            },
            queryCommandState: function() {
                try {
                    return this._callCmdFn("queryCommandState", arguments)
                } catch(a) {
                    return 0
                }
            },
            queryCommandValue: function() {
                try {
                    return this._callCmdFn("queryCommandValue", arguments)
                } catch(a) {
                    return null
                }
            },
            hasContents: function(a) {
                if (a) for (var b, c = 0; b = a[c++];) if (this.body.getElementsByTagName(b).length > 0) return ! 0;
                if (!j.isEmptyBlock(this.body)) return ! 0;
                for (a = ["div"], c = 0; b = a[c++];) for (var d, e = j.getElementsByTagName(this.body, b), f = 0; d = e[f++];) if (j.isCustomeNode(d)) return ! 0;
                return ! 1
            },
            reset: function() {
                this.fireEvent("reset")
            },
            setEnabled: function() {
                var a, b = this;
                if ("false" == b.body.contentEditable) {
                    b.body.contentEditable = !0,
                    a = b.selection.getRange();
                    try {
                        a.moveToBookmark(b.lastBk),
                        delete b.lastBk
                    } catch(c) {
                        a.setStartAtFirst(b.body).collapse(!0)
                    }
                    a.select(!0),
                    b.bkqueryCommandState && (b.queryCommandState = b.bkqueryCommandState, delete b.bkqueryCommandState),
                    b.fireEvent("selectionchange")
                }
            },
            enable: function() {
                return this.setEnabled()
            },
            setDisabled: function(a) {
                var b = this;
                a = a ? e.isArray(a) ? a: [a] : [],
                "true" == b.body.contentEditable && (b.lastBk || (b.lastBk = b.selection.getRange().createBookmark(!0)), b.body.contentEditable = !1, b.bkqueryCommandState = b.queryCommandState, b.queryCommandState = function(c) {
                    return - 1 != e.indexOf(a, c) ? b.bkqueryCommandState.apply(b, arguments) : -1
                },
                b.fireEvent("selectionchange"))
            },
            disable: function(a) {
                return this.setDisabled(a)
            },
            _setDefaultContent: function() {
                function a() {
                    var b = this;
                    b.document.getElementById("initContent") && (b.body.innerHTML = "<p>" + (d ? "": "<br/>") + "</p>", b.removeListener("firstBeforeExecCommand focus", a), setTimeout(function() {
                        b.focus(),
                        b._selectionChange()
                    },
                    0))
                }
                return function(b) {
                    var c = this;
                    c.body.innerHTML = '<p id="initContent">' + b + "</p>",
                    c.addListener("firstBeforeExecCommand focus", a)
                }
            } (),
            setShow: function() {
                var a = this,
                b = a.selection.getRange();
                if ("none" == a.container.style.display) {
                    try {
                        b.moveToBookmark(a.lastBk),
                        delete a.lastBk
                    } catch(c) {
                        b.setStartAtFirst(a.body).collapse(!0)
                    }
                    setTimeout(function() {
                        b.select(!0)
                    },
                    100),
                    a.container.style.display = ""
                }
            },
            show: function() {
                return this.setShow()
            },
            setHide: function() {
                var a = this;
                a.lastBk || (a.lastBk = a.selection.getRange().createBookmark(!0)),
                a.container.style.display = "none"
            },
            hide: function() {
                return this.setHide()
            },
            getLang: function(a) {
                var b = UM.I18N[this.options.lang];
                if (!b) throw Error("not import language file");
                a = (a || "").split(".");
                for (var c, d = 0; (c = a[d++]) && (b = b[c], b););
                return b
            },
            getContentLength: function(a, b) {
                var c = this.getContent(!1, !1, !0).length;
                if (a) {
                    b = (b || []).concat(["hr", "img", "iframe"]),
                    c = this.getContentTxt().replace(/[\t\r\n]+/g, "").length;
                    for (var d, e = 0; d = b[e++];) c += this.body.getElementsByTagName(d).length
                }
                return c
            },
            addInputRule: function(a, b) {
                a.ignoreUndo = b,
                this.inputRules.push(a)
            },
            filterInputRule: function(a, b) {
                for (var c, d = 0; c = this.inputRules[d++];) b && c.ignoreUndo || c.call(this, a)
            },
            addOutputRule: function(a, b) {
                a.ignoreUndo = b,
                this.outputRules.push(a)
            },
            filterOutputRule: function(a, b) {
                for (var c, d = 0; c = this.outputRules[d++];) b && c.ignoreUndo || c.call(this, a)
            }
        },
        e.inherits(m, f)
    } (),
    UM.filterWord = function() {
        function a(a) {
            return /(class="?Mso|style="[^"]*\bmso\-|w:WordDocument|<v:)/gi.test(a)
        }
        function b(a) {
            return a = a.replace(/[\d.]+\w+/g,
            function(a) {
                return e.transUnitToPx(a)
            })
        }
        function d(a) {
            return a.replace(/[\t\r\n]+/g, "").replace(/<!--[\s\S]*?-->/gi, "").replace(/<v:shape [^>]*>[\s\S]*?.<\/v:shape>/gi,
            function(a) {
                if (c.opera) return "";
                try {
                    var d = a.match(/width:([ \d.]*p[tx])/i)[1],
                    e = a.match(/height:([ \d.]*p[tx])/i)[1],
                    f = a.match(/src=\s*"([^"]*)"/i)[1];
                    return '<img width="' + b(d) + '" height="' + b(e) + '" src="' + f + '" />'
                } catch(g) {
                    return ""
                }
            }).replace(/<\/?div[^>]*>/g, "").replace(/v:\w+=(["']?)[^'"]+\1/g, "").replace(/<(!|script[^>]*>.*?<\/script(?=[>\s])|\/?(\?xml(:\w+)?|xml|meta|link|style|\w+:\w+)(?=[\s\/>]))[^>]*>/gi, "").replace(/<p [^>]*class="?MsoHeading"?[^>]*>(.*?)<\/p>/gi, "<p><strong>$1</strong></p>").replace(/\s+(class|lang|align)\s*=\s*(['"]?)([\w-]+)\2/gi,
            function(a, b, c, d) {
                return "class" == b && "MsoListParagraph" == d ? a: ""
            }).replace(/<(font|span)[^>]*>\s*<\/\1>/gi, "").replace(/(<[a-z][^>]*)\sstyle=(["'])([^\2]*?)\2/gi,
            function(a, c, d, e) {
                for (var f, g = [], h = e.replace(/^\s+|\s+$/, "").replace(/&#39;/g, "'").replace(/&quot;/gi, "'").split(/;\s*/g), i = 0; f = h[i]; i++) {
                    var j, k, l = f.split(":");
                    if (2 == l.length) {
                        if (j = l[0].toLowerCase(), k = l[1].toLowerCase(), /^(background)\w*/.test(j) && 0 == k.replace(/(initial|\s)/g, "").length || /^(margin)\w*/.test(j) && /^0\w+$/.test(k)) continue;
                        switch (j) {
                        case "mso-padding-alt":
                        case "mso-padding-top-alt":
                        case "mso-padding-right-alt":
                        case "mso-padding-bottom-alt":
                        case "mso-padding-left-alt":
                        case "mso-margin-alt":
                        case "mso-margin-top-alt":
                        case "mso-margin-right-alt":
                        case "mso-margin-bottom-alt":
                        case "mso-margin-left-alt":
                        case "mso-height":
                        case "mso-width":
                        case "mso-vertical-align-alt":
                            /<table/.test(c) || (g[i] = j.replace(/^mso-|-alt$/g, "") + ":" + b(k));
                            continue;
                        case "horiz-align":
                            g[i] = "text-align:" + k;
                            continue;
                        case "vert-align":
                            g[i] = "vertical-align:" + k;
                            continue;
                        case "font-color":
                        case "mso-foreground":
                            g[i] = "color:" + k;
                            continue;
                        case "mso-background":
                        case "mso-highlight":
                            g[i] = "background:" + k;
                            continue;
                        case "mso-default-height":
                            g[i] = "min-height:" + b(k);
                            continue;
                        case "mso-default-width":
                            g[i] = "min-width:" + b(k);
                            continue;
                        case "mso-padding-between-alt":
                            g[i] = "border-collapse:separate;border-spacing:" + b(k);
                            continue;
                        case "text-line-through":
                            ("single" == k || "double" == k) && (g[i] = "text-decoration:line-through");
                            continue;
                        case "mso-zero-height":
                            "yes" == k && (g[i] = "display:none");
                            continue;
                        case "background":
                            break;
                        case "margin":
                            if (!/[1-9]/.test(k)) continue
                        }
                        if (/^(mso|column|font-emph|lang|layout|line-break|list-image|nav|panose|punct|row|ruby|sep|size|src|tab-|table-border|text-(?:decor|trans)|top-bar|version|vnd|word-break)/.test(j) || /text\-indent|padding|margin/.test(j) && /\-[\d.]+/.test(k)) continue;
                        g[i] = j + ":" + l[1]
                    }
                }
                return c + (g.length ? ' style="' + g.join(";").replace(/;{2,}/g, ";") + '"': "")
            }).replace(/[\d.]+(cm|pt)/g,
            function(a) {
                return e.transUnitToPx(a)
            })
        }
        return function(b) {
            return a(b) ? d(b) : b
        }
    } (),
    function() {
        function a(a, b, c) {
            return a.push(n),
            b + (c ? 1 : -1)
        }
        function b(a, b) {
            for (var c = 0; b > c; c++) a.push(m)
        }
        function c(e, i, j, k) {
            switch (e.type) {
            case "root":
                for (var l, m = 0; l = e.children[m++];) j && "element" == l.type && !g.$inlineWithA[l.tagName] && m > 1 && (a(i, k, !0), b(i, k)),
                c(l, i, j, k);
                break;
            case "text":
                d(e, i);
                break;
            case "element":
                f(e, i, j, k);
                break;
            case "comment":
                h(e, i, j)
            }
            return i
        }
        function d(a, b) {
            b.push("pre" == a.parentNode.tagName ? a.data: a.data.replace(/[ ]{2}/g, " &nbsp;"))
        }
        function f(d, e, f, h) {
            var i = "";
            if (d.attrs) {
                i = [];
                var j = d.attrs;
                for (var k in j) i.push(k + (void 0 !== j[k] ? '="' + j[k] + '"': ""));
                i = i.join(" ")
            }
            if (e.push("<" + d.tagName + (i ? " " + i: "") + (g.$empty[d.tagName] ? "/": "") + ">"), f && !g.$inlineWithA[d.tagName] && "pre" != d.tagName && d.children && d.children.length && (h = a(e, h, !0), b(e, h)), d.children && d.children.length) for (var l, m = 0; l = d.children[m++];) f && "element" == l.type && !g.$inlineWithA[l.tagName] && m > 1 && (a(e, h), b(e, h)),
            c(l, e, f, h);
            g.$empty[d.tagName] || (f && !g.$inlineWithA[d.tagName] && "pre" != d.tagName && d.children && d.children.length && (h = a(e, h), b(e, h)), e.push("</" + d.tagName + ">"))
        }
        function h(a, b) {
            b.push("<!--" + a.data + "-->")
        }
        function i(a, b) {
            var c;
            if ("element" == a.type && a.getAttr("id") == b) return a;
            if (a.children && a.children.length) for (var d, e = 0; d = a.children[e++];) if (c = i(d, b)) return c
        }
        function j(a, b, c) {
            if ("element" == a.type && a.tagName == b && c.push(a), a.children && a.children.length) for (var d, e = 0; d = a.children[e++];) j(d, b, c)
        }
        function k(a, b) {
            if (a.children && a.children.length) for (var c, d = 0; c = a.children[d];) k(c, b),
            c.parentNode && (c.children && c.children.length && b(c), c.parentNode && d++);
            else b(a)
        }
        var l = UM.uNode = function(a) {
            this.type = a.type,
            this.data = a.data,
            this.tagName = a.tagName,
            this.parentNode = a.parentNode,
            this.attrs = a.attrs || {},
            this.children = a.children
        },
        m = "    ",
        n = "\n";
        l.createElement = function(a) {
            return /[<>]/.test(a) ? UM.htmlparser(a).children[0] : new l({
                type: "element",
                children: [],
                tagName: a
            })
        },
        l.createText = function(a, b) {
            return new UM.uNode({
                type: "text",
                data: b ? a: e.unhtml(a || "")
            })
        },
        l.prototype = {
            toHtml: function(a) {
                var b = [];
                return c(this, b, a, 0),
                b.join("")
            },
            innerHTML: function(a) {
                if ("element" != this.type || g.$empty[this.tagName]) return this;
                if (e.isString(a)) {
                    if (this.children) for (var b, c = 0; b = this.children[c++];) b.parentNode = null;
                    this.children = [];
                    for (var b, d = UM.htmlparser(a), c = 0; b = d.children[c++];) this.children.push(b),
                    b.parentNode = this;
                    return this
                }
                var d = new UM.uNode({
                    type: "root",
                    children: this.children
                });
                return d.toHtml()
            },
            innerText: function(a, b) {
                if ("element" != this.type || g.$empty[this.tagName]) return this;
                if (a) {
                    if (this.children) for (var c, d = 0; c = this.children[d++];) c.parentNode = null;
                    return this.children = [],
                    this.appendChild(l.createText(a, b)),
                    this
                }
                return this.toHtml().replace(/<[^>]+>/g, "")
            },
            getData: function() {
                return "element" == this.type ? "": this.data
            },
            firstChild: function() {
                return this.children ? this.children[0] : null
            },
            lastChild: function() {
                return this.children ? this.children[this.children.length - 1] : null
            },
            previousSibling: function() {
                for (var a, b = this.parentNode,
                c = 0; a = b.children[c]; c++) if (a === this) return 0 == c ? null: b.children[c - 1]
            },
            nextSibling: function() {
                for (var a, b = this.parentNode,
                c = 0; a = b.children[c++];) if (a === this) return b.children[c]
            },
            replaceChild: function(a, b) {
                if (this.children) {
                    a.parentNode && a.parentNode.removeChild(a);
                    for (var c, d = 0; c = this.children[d]; d++) if (c === b) return this.children.splice(d, 1, a),
                    b.parentNode = null,
                    a.parentNode = this,
                    a
                }
            },
            appendChild: function(a) {
                if ("root" == this.type || "element" == this.type && !g.$empty[this.tagName]) {
                    this.children || (this.children = []),
                    a.parentNode && a.parentNode.removeChild(a);
                    for (var b, c = 0; b = this.children[c]; c++) if (b === a) {
                        this.children.splice(c, 1);
                        break
                    }
                    return this.children.push(a),
                    a.parentNode = this,
                    a
                }
            },
            insertBefore: function(a, b) {
                if (this.children) {
                    a.parentNode && a.parentNode.removeChild(a);
                    for (var c, d = 0; c = this.children[d]; d++) if (c === b) return this.children.splice(d, 0, a),
                    a.parentNode = this,
                    a
                }
            },
            insertAfter: function(a, b) {
                if (this.children) {
                    a.parentNode && a.parentNode.removeChild(a);
                    for (var c, d = 0; c = this.children[d]; d++) if (c === b) return this.children.splice(d + 1, 0, a),
                    a.parentNode = this,
                    a
                }
            },
            removeChild: function(a, b) {
                if (this.children) for (var c, d = 0; c = this.children[d]; d++) if (c === a) {
                    if (this.children.splice(d, 1), c.parentNode = null, b && c.children && c.children.length) for (var e, f = 0; e = c.children[f]; f++) this.children.splice(d + f, 0, e),
                    e.parentNode = this;
                    return c
                }
            },
            getAttr: function(a) {
                return this.attrs && this.attrs[a.toLowerCase()]
            },
            setAttr: function(a, b) {
                if (!a) return delete this.attrs,
                void 0;
                if (this.attrs || (this.attrs = {}), e.isObject(a)) for (var c in a) a[c] ? this.attrs[c.toLowerCase()] = a[c] : delete this.attrs[c];
                else b ? this.attrs[a.toLowerCase()] = b: delete this.attrs[a]
            },
            getIndex: function() {
                for (var a, b = this.parentNode,
                c = 0; a = b.children[c]; c++) if (a === this) return c;
                return - 1
            },
            getNodeById: function(a) {
                var b;
                if (this.children && this.children.length) for (var c, d = 0; c = this.children[d++];) if (b = i(c, a)) return b
            },
            getNodesByTagName: function(a) {
                a = e.trim(a).replace(/[ ]{2,}/g, " ").split(" ");
                var b = [],
                c = this;
                return e.each(a,
                function(a) {
                    if (c.children && c.children.length) for (var d, e = 0; d = c.children[e++];) j(d, a, b)
                }),
                b
            },
            getStyle: function(a) {
                var b = this.getAttr("style");
                if (!b) return "";
                var c = new RegExp("(^|;)\\s*" + a + ":([^;]+)", "i"),
                d = b.match(c);
                return d && d[0] ? d[2] : ""
            },
            setStyle: function(a, b) {
                function c(a, b) {
                    var c = new RegExp("(^|;)\\s*" + a + ":([^;]+;?)", "gi");
                    d = d.replace(c, "$1"),
                    b && (d = a + ":" + e.unhtml(b) + ";" + d)
                }
                var d = this.getAttr("style");
                if (d || (d = ""), e.isObject(a)) for (var f in a) c(f, a[f]);
                else c(a, b);
                this.setAttr("style", e.trim(d))
            },
            traversal: function(a) {
                return this.children && this.children.length && k(this, a),
                this
            }
        }
    } (),
    UM.htmlparser = function(a, b) {
        function c(a, b) {
            if (o[a.tagName]) {
                var c = m.createElement(o[a.tagName]);
                a.appendChild(c),
                c.appendChild(m.createText(b)),
                a = c
            } else a.appendChild(m.createText(b))
        }
        function d(a, b, c) {
            var f;
            if (f = n[b]) {
                for (var h, j = a;
                "root" != j.type;) {
                    if (e.isArray(f) ? -1 != e.indexOf(f, j.tagName) : f == j.tagName) {
                        a = j,
                        h = !0;
                        break
                    }
                    j = j.parentNode
                }
                h || (a = d(a, e.isArray(f) ? f[0] : f))
            }
            var k = new m({
                parentNode: a,
                type: "element",
                tagName: b.toLowerCase(),
                children: g.$empty[b] ? null: []
            });
            if (c) {
                for (var l, o = {}; l = i.exec(c);) o[l[1].toLowerCase()] = e.unhtml(l[2] || l[3] || l[4]);
                k.attrs = o
            }
            return a.children.push(k),
            g.$empty[b] ? a: k
        }
        function f(a, b) {
            a.children.push(new m({
                type: "comment",
                data: b,
                parentNode: a
            }))
        }
        var h = /<(?:(?:\/([^>]+)>)|(?:!--([\S|\s]*?)-->)|(?:([^\s\/>]+)\s*((?:(?:"[^"]*")|(?:'[^']*')|[^"'<>])*)\/?>))/g,
        i = /([\w\-:.]+)(?:(?:\s*=\s*(?:(?:"([^"]*)")|(?:'([^']*)')|([^\s>]+)))|(?=\s|$))/g,
        k = {
            b: 1,
            code: 1,
            i: 1,
            u: 1,
            strike: 1,
            s: 1,
            tt: 1,
            strong: 1,
            q: 1,
            samp: 1,
            em: 1,
            span: 1,
            sub: 1,
            img: 1,
            sup: 1,
            font: 1,
            big: 1,
            small: 1,
            iframe: 1,
            a: 1,
            br: 1,
            pre: 1
        };
        a = a.replace(new RegExp(j.fillChar, "g"), ""),
        b || (a = a.replace(new RegExp("[\\r\\t\\n" + (b ? "": " ") + "]*</?(\\w+)\\s*(?:[^>]*)>[\\r\\t\\n" + (b ? "": " ") + "]*", "g"),
        function(a, c) {
            return c && k[c.toLowerCase()] ? a.replace(/(^[\n\r]+)|([\n\r]+$)/g, "") : a.replace(new RegExp("^[\\r\\n" + (b ? "": " ") + "]+"), "").replace(new RegExp("[\\r\\n" + (b ? "": " ") + "]+$"), "")
        }));
        for (var l, m = UM.uNode,
        n = {
            td: "tr",
            tr: ["tbody", "thead", "tfoot"],
            tbody: "table",
            th: "tr",
            thead: "table",
            tfoot: "table",
            caption: "table",
            li: ["ul", "ol"],
            dt: "dl",
            dd: "dl",
            option: "select"
        },
        o = {
            ol: "li",
            ul: "li"
        },
        p = 0, q = 0, r = new m({
            type: "root",
            children: []
        }), s = r; l = h.exec(a);) {
            p = l.index;
            try {
                if (p > q && c(s, a.slice(q, p)), l[3]) g.$cdata[s.tagName] ? c(s, l[0]) : s = d(s, l[3].toLowerCase(), l[4]);
                else if (l[1]) {
                    if ("root" != s.type) if (g.$cdata[s.tagName] && !g.$cdata[l[1]]) c(s, l[0]);
                    else {
                        for (var t = s;
                        "element" == s.type && s.tagName != l[1].toLowerCase();) if (s = s.parentNode, "root" == s.type) throw s = t,
                        "break";
                        s = s.parentNode
                    }
                } else l[2] && f(s, l[2])
            } catch(u) {}
            q = h.lastIndex
        }
        return q < a.length && c(s, a.slice(q)),
        r
    },
    UM.filterNode = function() {
        function a(b, c) {
            switch (b.type) {
            case "text":
                break;
            case "element":
                var d;
                if (d = c[b.tagName]) if ("-" === d) b.parentNode.removeChild(b);
                else if (e.isFunction(d)) {
                    var f = b.parentNode,
                    h = b.getIndex();
                    if (d(b), b.parentNode) {
                        if (b.children) for (var i, j = 0; i = b.children[j];) a(i, c),
                        i.parentNode && j++
                    } else for (var i, j = h; i = f.children[j];) a(i, c),
                    i.parentNode && j++
                } else {
                    var k = d.$;
                    if (k && b.attrs) {
                        var l, m = {};
                        for (var n in k) {
                            if (l = b.getAttr(n), "style" == n && e.isArray(k[n])) {
                                var o = [];
                                e.each(k[n],
                                function(a) {
                                    var c; (c = b.getStyle(a)) && o.push(a + ":" + c)
                                }),
                                l = o.join(";")
                            }
                            l && (m[n] = l)
                        }
                        b.attrs = m
                    }
                    if (b.children) for (var i, j = 0; i = b.children[j];) a(i, c),
                    i.parentNode && j++
                } else if (g.$cdata[b.tagName]) b.parentNode.removeChild(b);
                else {
                    var f = b.parentNode,
                    h = b.getIndex();
                    b.parentNode.removeChild(b, !0);
                    for (var i, j = h; i = f.children[j];) a(i, c),
                    i.parentNode && j++
                }
                break;
            case "comment":
                b.parentNode.removeChild(b)
            }
        }
        return function(b, c) {
            if (e.isEmptyObject(c)) return b;
            var d; (d = c["-"]) && e.each(d.split(" "),
            function(a) {
                c[a] = "-"
            });
            for (var f, g = 0; f = b.children[g];) a(f, c),
            f.parentNode && g++;
            return b
        }
    } (),
    UM.commands.inserthtml = {
        execCommand: function(a, b, d) {
            var f, h, i = this;
            if (b && i.fireEvent("beforeinserthtml", b) !== !0) {
                if (f = i.selection.getRange(), h = f.document.createElement("div"), h.style.display = "inline", !d) {
                    var l = UM.htmlparser(b);
                    i.options.filterRules && UM.filterNode(l, i.options.filterRules),
                    i.filterInputRule(l),
                    b = l.toHtml()
                }
                if (h.innerHTML = e.trim(b), !f.collapsed) {
                    var m = f.startContainer;
                    if (j.isFillChar(m) && f.setStartBefore(m), m = f.endContainer, j.isFillChar(m) && f.setEndAfter(m), f.txtToElmBoundary(), f.endContainer && 1 == f.endContainer.nodeType && (m = f.endContainer.childNodes[f.endOffset], m && j.isBr(m) && f.setEndAfter(m)), 0 == f.startOffset && (m = f.startContainer, j.isBoundaryNode(m, "firstChild") && (m = f.endContainer, f.endOffset == (3 == m.nodeType ? m.nodeValue.length: m.childNodes.length) && j.isBoundaryNode(m, "lastChild") && (i.body.innerHTML = "<p>" + (c.ie ? "": "<br/>") + "</p>", f.setStart(i.body.firstChild, 0).collapse(!0)))), !f.collapsed && f.deleteContents(), 1 == f.startContainer.nodeType) {
                        var n, o = f.startContainer.childNodes[f.startOffset];
                        if (o && j.isBlockElm(o) && (n = o.previousSibling) && j.isBlockElm(n)) {
                            for (f.setEnd(n, n.childNodes.length).collapse(); o.firstChild;) n.appendChild(o.firstChild);
                            j.remove(o)
                        }
                    }
                }
                var o, p, n, q, r, s = 0;
                for (f.inFillChar() && (o = f.startContainer, j.isFillChar(o) ? (f.setStartBefore(o).collapse(!0), j.remove(o)) : j.isFillChar(o, !0) && (o.nodeValue = o.nodeValue.replace(k, ""), f.startOffset--, f.collapsed && f.collapse(!0))); o = h.firstChild;) {
                    if (s) {
                        for (var t = i.document.createElement("p"); o && (3 == o.nodeType || !g.$block[o.tagName]);) r = o.nextSibling,
                        t.appendChild(o),
                        o = r;
                        t.firstChild && (o = t)
                    }
                    if (f.insertNode(o), r = o.nextSibling, !s && o.nodeType == j.NODE_ELEMENT && j.isBlockElm(o) && (p = j.findParent(o,
                    function(a) {
                        return j.isBlockElm(a)
                    }), p && "body" != p.tagName.toLowerCase() && (!g[p.tagName][o.nodeName] || o.parentNode !== p))) {
                        if (g[p.tagName][o.nodeName]) for (q = o.parentNode; q !== p;) n = q,
                        q = q.parentNode;
                        else n = p;
                        j.breakParent(o, n || q);
                        var n = o.previousSibling;
                        j.trimWhiteTextNode(n),
                        n.childNodes.length || j.remove(n),
                        !c.ie && (u = o.nextSibling) && j.isBlockElm(u) && u.lastChild && !j.isBr(u.lastChild) && u.appendChild(i.document.createElement("br")),
                        s = 1
                    }
                    var u = o.nextSibling;
                    if (!h.firstChild && u && j.isBlockElm(u)) {
                        f.setStart(u, 0).collapse(!0);
                        break
                    }
                    f.setEndAfter(o).collapse()
                }
                if (o = f.startContainer, r && j.isBr(r) && j.remove(r), j.isBlockElm(o) && j.isEmptyNode(o)) if (r = o.nextSibling) j.remove(o),
                1 == r.nodeType && g.$block[r.tagName] && f.setStart(r, 0).collapse(!0).shrinkBoundary();
                else try {
                    o.innerHTML = c.ie ? j.fillChar: "<br/>"
                } catch(v) {
                    f.setStartBefore(o),
                    j.remove(o)
                }
                try {
                    if (c.ie9below && 1 == f.startContainer.nodeType && !f.startContainer.childNodes[f.startOffset]) {
                        var w = f.startContainer,
                        n = w.childNodes[f.startOffset - 1];
                        if (n && 1 == n.nodeType && g.$empty[n.tagName]) {
                            var x = this.document.createTextNode(j.fillChar);
                            f.insertNode(x).setStart(x, 0).collapse(!0)
                        }
                    }
                    f.select(!0)
                } catch(v) {}
                setTimeout(function() {
                    f = i.selection.getRange(),
                    f.scrollIntoView(),
                    i.fireEvent("afterinserthtml")
                },
                200)
            }
        }
    },
    UM.commands.insertimage = {
        execCommand: function(a, b) {
            if (b = e.isArray(b) ? b: [b], b.length) {
                var c, d = this,
                f = [],
                g = "";
                if (c = b[0], 1 == b.length) g = '<img src="' + c.src + '" ' + (c._src ? ' _src="' + c._src + '" ': "") + (c.width ? 'width="' + c.width + '" ': "") + (c.height ? ' height="' + c.height + '" ': "") + ("left" == c.floatStyle || "right" == c.floatStyle ? ' style="float:' + c.floatStyle + ';"': "") + (c.title && "" != c.title ? ' title="' + c.title + '"': "") + (c.border && "0" != c.border ? ' border="' + c.border + '"': "") + (c.alt && "" != c.alt ? ' alt="' + c.alt + '"': "") + (c.hspace && "0" != c.hspace ? ' hspace = "' + c.hspace + '"': "") + (c.vspace && "0" != c.vspace ? ' vspace = "' + c.vspace + '"': "") + "/>",
                "center" == c.floatStyle && (g = '<p style="text-align: center">' + g + "</p>"),
                f.push(g);
                else for (var h = 0; c = b[h++];) g = "<p " + ("center" == c.floatStyle ? 'style="text-align: center" ': "") + '><img src="' + c.src + '" ' + (c.width ? 'width="' + c.width + '" ': "") + (c._src ? ' _src="' + c._src + '" ': "") + (c.height ? ' height="' + c.height + '" ': "") + ' style="' + (c.floatStyle && "center" != c.floatStyle ? "float:" + c.floatStyle + ";": "") + (c.border || "") + '" ' + (c.title ? ' title="' + c.title + '"': "") + " /></p>",
                f.push(g);
                d.execCommand("insertHtml", f.join(""), !0)
            }
        }
    },
    UM.plugins.justify = function() {
        $.each("justifyleft justifyright justifycenter justifyfull".split(" "),
        function(a, b) {
            UM.commands[b] = {
                execCommand: function(a) {
                    return this.document.execCommand(a)
                },
                queryCommandValue: function(a) {
                    var b = this.document.queryCommandValue(a);
                    return b === !0 || "true" === b ? a.replace(/justify/, "") : ""
                },
                queryCommandState: function(a) {
                    return this.document.queryCommandState(a) ? 1 : 0
                }
            }
        })
    },
    UM.plugins.font = function() {
        var a = this,
        b = {
            forecolor: "forecolor",
            backcolor: "backcolor",
            fontsize: "fontsize",
            fontfamily: "fontname"
        },
        d = {
            forecolor: "color",
            backcolor: "background-color",
            fontsize: "font-size",
            fontfamily: "font-family"
        },
        f = {
            forecolor: "color",
            fontsize: "size",
            fontfamily: "face"
        };
        a.setOpt({
            fontfamily: [{
                name: "songti",
                val: "宋体,SimSun"
            },
            {
                name: "yahei",
                val: "微软雅黑,Microsoft YaHei"
            },
            {
                name: "kaiti",
                val: "楷体,楷体_GB2312, SimKai"
            },
            {
                name: "heiti",
                val: "黑体, SimHei"
            },
            {
                name: "lishu",
                val: "隶书, SimLi"
            },
            {
                name: "andaleMono",
                val: "andale mono"
            },
            {
                name: "arial",
                val: "arial, helvetica,sans-serif"
            },
            {
                name: "arialBlack",
                val: "arial black,avant garde"
            },
            {
                name: "comicSansMs",
                val: "comic sans ms"
            },
            {
                name: "impact",
                val: "impact,chicago"
            },
            {
                name: "timesNewRoman",
                val: "times new roman"
            },
            {
                name: "sans-serif",
                val: "sans-serif"
            }],
            fontsize: [10, 12, 16, 18, 24, 32, 48]
        }),
        a.addOutputRule(function(a) {
            e.each(a.getNodesByTagName("font"),
            function(a) {
                if ("font" == a.tagName) {
                    var b = [];
                    for (var c in a.attrs) switch (c) {
                    case "size":
                        var d = a.attrs[c];
                        $.each({
                            10 : "1",
                            12 : "2",
                            16 : "3",
                            18 : "4",
                            24 : "5",
                            32 : "6",
                            48 : "7"
                        },
                        function(a, b) {
                            return b == d ? (d = a, !1) : void 0
                        }),
                        b.push("font-size:" + d + "px");
                        break;
                    case "color":
                        b.push("color:" + a.attrs[c]);
                        break;
                    case "face":
                        b.push("font-family:" + a.attrs[c]);
                        break;
                    case "style":
                        b.push(a.attrs[c])
                    }
                    a.attrs = {
                        style: b.join(";")
                    }
                }
                a.tagName = "span",
                "span" == a.parentNode.tagName && 1 == a.parentNode.children.length && ($.each(a.attrs,
                function(b, c) {
                    a.parentNode.attrs[b] = "style" == b ? a.parentNode.attrs[b] + c: c
                }), a.parentNode.removeChild(a, !0))
            })
        });
        for (var g in b) !
        function(g) {
            UM.commands[g] = {
                execCommand: function(a, e) {
                    if ("transparent" != e) {
                        var f = this.selection.getRange();
                        if (!f.collapsed) {
                            if ("fontsize" == a && (e = {
                                10 : "1",
                                12 : "2",
                                16 : "3",
                                18 : "4",
                                24 : "5",
                                32 : "6",
                                48 : "7"
                            } [(e + "").replace(/px/, "")]), this.document.execCommand(b[a], !1, e), c.gecko && $.each(this.$body.find("a"),
                            function(a, b) {
                                var c = b.parentNode;
                                if (c.lastChild === c.firstChild && /FONT|SPAN/.test(c.tagName)) {
                                    var d = c.cloneNode(!1);
                                    d.innerHTML = b.innerHTML,
                                    $(b).html("").append(d).insertBefore(c),
                                    $(c).remove()
                                }
                            }), !c.ie) {
                                var g = this.selection.getNative().getRangeAt(0),
                                h = g.commonAncestorContainer,
                                f = this.selection.getRange(),
                                i = f.createBookmark(!0);
                                $(h).find("a").each(function(a, b) {
                                    var c = b.parentNode;
                                    if ("FONT" == c.nodeName) {
                                        var d = c.cloneNode(!1);
                                        d.innerHTML = b.innerHTML,
                                        $(b).html("").append(d)
                                    }
                                }),
                                f.moveToBookmark(i).select()
                            }
                            return ! 0
                        }
                        var j = $("<span></span>").css(d[a], e)[0];
                        f.insertNode(j).setStart(j, 0).setCursor()
                    }
                },
                queryCommandValue: function(b) {
                    var c = a.selection.getStart(),
                    g = $(c).css(d[b]);
                    return void 0 === g && (g = $(c).attr(f[b])),
                    g ? e.fixColor(b, g).replace(/px/, "") : ""
                },
                queryCommandState: function(a) {
                    return this.queryCommandValue(a)
                }
            }
        } (g)
    },
    UM.plugins.link = function() {
        this.setOpt("autourldetectinie", !1),
        c.ie && this.options.autourldetectinie === !1 && this.addListener("keyup",
        function(a, b) {
            var c = this,
            d = b.keyCode;
            if (13 == d || 32 == d) {
                var e = c.selection.getRange(),
                f = e.startContainer;
                if (13 == d) {
                    if ("P" == f.nodeName) {
                        var g = f.previousSibling;
                        if (g && 1 == g.nodeType) {
                            var g = g.lastChild;
                            g && "A" == g.nodeName && !g.getAttribute("_href") && j.remove(g, !0)
                        }
                    }
                } else 32 == d && 3 == f.nodeType && /^\s$/.test(f.nodeValue) && (f = f.previousSibling, f && "A" == f.nodeName && !f.getAttribute("_href") && j.remove(f, !0))
            }
        }),
        this.addOutputRule(function(a) {
            $.each(a.getNodesByTagName("a"),
            function(a, b) {
                var c = e.html(b.getAttr("_href"));
                /^(ftp|https?|\/|file)/.test(c) || (c = "http://" + c),
                b.setAttr("href", c),
                b.setAttr("_href"),
                "" == b.getAttr("title") && b.setAttr("title")
            })
        }),
        this.addInputRule(function(a) {
            $.each(a.getNodesByTagName("a"),
            function(a, b) {
                b.setAttr("_href", e.html(b.getAttr("href")))
            })
        }),
        UM.commands.link = {
            execCommand: function(a, b) {
                var c = this,
                d = c.selection.getRange();
                if (d.collapsed) {
                    var f = d.startContainer; (f = j.findParentByTagName(f, "a", !0)) ? ($(f).attr(b), d.selectNode(f).select()) : d.insertNode($("<a>" + b.href + "</a>").attr(b)[0]).select()
                } else c.document.execCommand("createlink", !1, "_umeditor_link"),
                e.each(j.getElementsByTagName(c.body, "a",
                function(a) {
                    return "_umeditor_link" == a.getAttribute("href")
                }),
                function(a) {
                    "_umeditor_link" == $(a).text() && $(a).text(b.href),
                    j.setAttributes(a, b),
                    d.selectNode(a).select()
                })
            },
            queryCommandState: function() {
                return this.queryCommandValue("link") ? 1 : 0
            },
            queryCommandValue: function() {
                var a, b = this.selection.getStartElementPath();
                return $.each(b,
                function(b, c) {
                    return "A" == c.nodeName ? (a = c, !1) : void 0
                }),
                a
            }
        },
        UM.commands.unlink = {
            execCommand: function() {
                this.document.execCommand("unlink")
            }
        }
    },
    UM.commands.print = {
        execCommand: function() {
            var a = this,
            b = "editor_print_" + +new Date;
            $('<iframe src="" id="' + b + '" name="' + b + '" frameborder="0"></iframe>').attr("id", b).css({
                width: "0px",
                height: "0px",
                overflow: "hidden",
                "float": "left",
                position: "absolute",
                top: "-10000px",
                left: "-10000px"
            }).appendTo(a.$container.find(".edui-dialog-container"));
            var c = window.open("", b, ""),
            d = c.document;
            d.open(),
            d.write("<html><head></head><body><div>" + this.getContent(null, null, !0) + "</div><script>" + "setTimeout(function(){" + "window.print();" + "setTimeout(function(){" + "window.parent.$('#" + b + "').remove();" + "},100);" + "},200);" + "</script></body></html>"),
            d.close()
        },
        notNeedUndo: 1
    },
    UM.plugins.paragraph = function() {
        var a = this;
        a.setOpt("paragraph", {
            p: "",
            h1: "",
            h2: "",
            h3: "",
            h4: "",
            h5: "",
            h6: ""
        }),
        a.commands.paragraph = {
            execCommand: function(a, b) {
                return this.document.execCommand("formatBlock", !1, "<" + b + ">")
            },
            queryCommandValue: function() {
                try {
                    var a = this.document.queryCommandValue("formatBlock")
                } catch(b) {}
                return a
            }
        }
    },
    UM.plugins.horizontal = function() {
        var a = this;
        a.commands.horizontal = {
            execCommand: function() {
                this.document.execCommand("insertHorizontalRule");
                var b = a.selection.getRange().txtToElmBoundary(!0),
                d = b.startContainer;
                if (j.isBody(b.startContainer)) {
                    var e = b.startContainer.childNodes[b.startOffset];
                    e || (e = $("<p></p>").appendTo(b.startContainer).html(c.ie ? "&nbsp;": "<br/>")[0]),
                    b.setStart(e, 0).setCursor()
                } else {
                    for (; g.$inline[d.tagName] && d.lastChild === d.firstChild;) {
                        var f = d.parentNode;
                        f.appendChild(d.firstChild),
                        f.removeChild(d),
                        d = f
                    }
                    for (; g.$inline[d.tagName];) d = d.parentNode;
                    if (1 == d.childNodes.length && "HR" == d.lastChild.nodeName) {
                        var h = d.lastChild;
                        $(h).insertBefore(d),
                        b.setStart(d, 0).setCursor()
                    } else {
                        h = $("hr", d)[0],
                        j.breakParent(h, d);
                        var i = h.previousSibling;
                        i && j.isEmptyBlock(i) && $(i).remove(),
                        b.setStart(h.nextSibling, 0).setCursor()
                    }
                }
            }
        }
    },
    UM.commands.cleardoc = {
        execCommand: function() {
            var a = this,
            b = a.selection.getRange();
            a.body.innerHTML = "<p>" + (d ? "": "<br/>") + "</p>",
            b.setStart(a.body.firstChild, 0).setCursor(!1, !0),
            setTimeout(function() {
                a.fireEvent("clearDoc")
            },
            0)
        }
    },
    UM.plugins.undo = function() {
        function a(a, b) {
            if (a.length != b.length) return 0;
            for (var c = 0,
            d = a.length; d > c; c++) if (a[c] != b[c]) return 0;
            return 1
        }
        function d(b, c) {
            return b.collapsed != c.collapsed ? 0 : a(b.startAddress, c.startAddress) && a(b.endAddress, c.endAddress) ? 1 : 0
        }
        function f() {
            this.list = [],
            this.index = 0,
            this.hasUndo = !1,
            this.hasRedo = !1,
            this.undo = function() {
                if (this.hasUndo) {
                    if (!this.list[this.index - 1] && 1 == this.list.length) return this.reset(),
                    void 0;
                    for (; this.list[this.index].content == this.list[this.index - 1].content;) if (this.index--, 0 == this.index) return this.restore(0);
                    this.restore(--this.index)
                }
            },
            this.redo = function() {
                if (this.hasRedo) {
                    for (; this.list[this.index].content == this.list[this.index + 1].content;) if (this.index++, this.index == this.list.length - 1) return this.restore(this.index);
                    this.restore(++this.index)
                }
            },
            this.restore = function() {
                var a = this.editor,
                d = this.list[this.index],
                f = UM.htmlparser(d.content.replace(n, ""));
                a.options.autoClearEmptyNode = !1,
                a.filterInputRule(f, !0),
                a.options.autoClearEmptyNode = p,
                a.body.innerHTML = f.toHtml(),
                a.fireEvent("afterscencerestore"),
                c.ie && e.each(j.getElementsByTagName(a.document, "td th caption p"),
                function(b) {
                    j.isEmptyNode(b) && j.fillNode(a.document, b)
                });
                try {
                    var h = new b.Range(a.document, a.body).moveToAddress(d.address);
                    if (c.ie && h.collapsed && 1 == h.startContainer.nodeType) {
                        var i = h.startContainer.childNodes[h.startOffset]; (!i || 1 == i.nodeType && g.$empty[i]) && h.insertNode(a.document.createTextNode(" ")).collapse(!0)
                    }
                    h.select(o[h.startContainer.nodeName.toLowerCase()])
                } catch(k) {}
                this.update(),
                this.clearKey(),
                a.fireEvent("reset", !0)
            },
            this.getScene = function() {
                var a = this.editor,
                b = a.selection.getRange(),
                d = b.createAddress(!1, !0);
                a.fireEvent("beforegetscene");
                var e = UM.htmlparser(a.body.innerHTML, !0);
                a.options.autoClearEmptyNode = !1,
                a.filterOutputRule(e, !0),
                a.options.autoClearEmptyNode = p;
                var f = e.toHtml();
                return c.ie && (f = f.replace(/>&nbsp;</g, "><").replace(/\s*</g, "<").replace(/>\s*/g, ">")),
                a.fireEvent("aftergetscene"),
                {
                    address: d,
                    content: f
                }
            },
            this.save = function(a, b) {
                clearTimeout(i);
                var c = this.getScene(b),
                e = this.list[this.index];
                e && e.content == c.content && (a ? 1 : d(e.address, c.address)) || (this.list = this.list.slice(0, this.index + 1), this.list.push(c), this.list.length > l && this.list.shift(), this.index = this.list.length - 1, this.clearKey(), this.update())
            },
            this.update = function() {
                this.hasRedo = !!this.list[this.index + 1],
                this.hasUndo = !!this.list[this.index - 1]
            },
            this.reset = function() {
                this.list = [],
                this.index = 0,
                this.hasUndo = !1,
                this.hasRedo = !1,
                this.clearKey()
            },
            this.clearKey = function() {
                s = 0,
                q = null
            }
        }
        function h() {
            this.undoManger.save()
        }
        var i, k = this,
        l = k.options.maxUndoCount || 20,
        m = k.options.maxInputCount || 20,
        n = new RegExp(j.fillChar + "|</hr>", "gi"),
        o = {
            ol: 1,
            ul: 1,
            table: 1,
            tbody: 1,
            tr: 1,
            body: 1
        },
        p = k.options.autoClearEmptyNode;
        k.undoManger = new f,
        k.undoManger.editor = k,
        k.addListener("saveScene",
        function() {
            var a = Array.prototype.splice.call(arguments, 1);
            this.undoManger.save.apply(this.undoManger, a)
        }),
        k.addListener("beforeexeccommand", h),
        k.addListener("afterexeccommand", h),
        k.addListener("reset",
        function(a, b) {
            b || this.undoManger.reset()
        }),
        k.commands.redo = k.commands.undo = {
            execCommand: function(a) {
                this.undoManger[a]()
            },
            queryCommandState: function(a) {
                return this.undoManger["has" + ("undo" == a.toLowerCase() ? "Undo": "Redo")] ? 0 : -1
            },
            notNeedUndo: 1
        };
        var q, r = {
            16 : 1,
            17 : 1,
            18 : 1,
            37 : 1,
            38 : 1,
            39 : 1,
            40 : 1
        },
        s = 0,
        t = !1;
        k.addListener("ready",
        function() {
            j.on(this.body, "compositionstart",
            function() {
                t = !0
            }),
            j.on(this.body, "compositionend",
            function() {
                t = !1
            })
        }),
        k.addshortcutkey({
            Undo: "ctrl+90",
            Redo: "ctrl+89,shift+ctrl+z"
        });
        var u = !0;
        k.addListener("keydown",
        function(a, b) {
            function c(a) {
                a.selection.getRange().collapsed && a.fireEvent("contentchange"),
                a.undoManger.save(!1, !0),
                a.fireEvent("selectionchange")
            }
            var d = this,
            e = b.keyCode || b.which;
            if (! (r[e] || b.ctrlKey || b.metaKey || b.shiftKey || b.altKey)) {
                if (t) return;
                if (!d.selection.getRange().collapsed) return d.undoManger.save(!1, !0),
                u = !1,
                void 0;
                0 == d.undoManger.list.length && d.undoManger.save(!0),
                clearTimeout(i),
                i = setTimeout(function() {
                    if (t) var a = setInterval(function() {
                        t || (c(d), clearInterval(a))
                    },
                    300);
                    else c(d)
                },
                200),
                q = e,
                s++,
                s >= m && c(d)
            }
        }),
        k.addListener("keyup",
        function(a, b) {
            var c = b.keyCode || b.which;
            if (! (r[c] || b.ctrlKey || b.metaKey || b.shiftKey || b.altKey)) {
                if (t) return;
                u || (this.undoManger.save(!1, !0), u = !0)
            }
        })
    },
    UM.plugins.paste = function() {
        function a(a) {
            var b = this.document;
            if (!b.getElementById("baidu_pastebin")) {
                var d = this.selection.getRange(),
                e = d.createBookmark(),
                f = b.createElement("div");
                f.id = "baidu_pastebin",
                c.webkit && f.appendChild(b.createTextNode(j.fillChar + j.fillChar)),
                this.body.appendChild(f),
                e.start.style.display = "",
                f.style.cssText = "position:absolute;width:1px;height:1px;overflow:hidden;left:-1000px;white-space:nowrap;top:" + $(e.start).position().top + "px",
                d.selectNodeContents(f).select(!0),
                setTimeout(function() {
                    if (c.webkit) for (var g, h = 0,
                    i = b.querySelectorAll("#baidu_pastebin"); g = i[h++];) {
                        if (!j.isEmptyNode(g)) {
                            f = g;
                            break
                        }
                        j.remove(g)
                    }
                    try {
                        f.parentNode.removeChild(f)
                    } catch(k) {}
                    d.moveToBookmark(e).select(!0),
                    a(f)
                },
                0)
            }
        }
        function b(a) {
            var b;
            if (a.firstChild) {
                for (var f, g = j.getElementsByTagName(a, "span"), h = 0; f = g[h++];)("_baidu_cut_start" == f.id || "_baidu_cut_end" == f.id) && j.remove(f);
                if (c.webkit) {
                    for (var i, k = a.querySelectorAll("div br"), h = 0; i = k[h++];) {
                        var l = i.parentNode;
                        "DIV" == l.tagName && 1 == l.childNodes.length && (l.innerHTML = "<p><br/></p>", j.remove(l))
                    }
                    for (var m, n = a.querySelectorAll("#baidu_pastebin"), h = 0; m = n[h++];) {
                        var o = d.document.createElement("p");
                        for (m.parentNode.insertBefore(o, m); m.firstChild;) o.appendChild(m.firstChild);
                        j.remove(m)
                    }
                    for (var p, q = a.querySelectorAll("meta"), h = 0; p = q[h++];) j.remove(p);
                    var k = a.querySelectorAll("br");
                    for (h = 0; p = k[h++];) / ^apple - /i.test(p.className)&&j.remove(p)}if(c.gecko){var r=a.querySelectorAll("[_moz_dirty]");for(h=0;p=r[h++];)p.removeAttribute("_moz_dirty")}if(!c.ie)for(var p,s=a.querySelectorAll("span.Apple-style-span"),h=0;p=s[h++];)j.remove(p,!0);b=a.innerHTML,b=UM.filterWord(b);var t=UM.htmlparser(b);if(d.options.filterRules&&UM.filterNode(t,d.options.filterRules),d.filterInputRule(t),c.webkit){var u=t.lastChild();u&&"element"==u.type&&"br"==u.tagName&&t.removeChild(u),e.each(d.body.querySelectorAll("div"),function(a){j.isEmptyBlock(a)&&j.remove(a)})}if(b={html:t.toHtml()},d.fireEvent("beforepaste",b,t),!b.html)return;d.execCommand("insertHtml",b.html,!0),d.fireEvent("afterpaste",b)}}var d=this;d.addListener("ready",function(){j.on(d.body,"cut",function(){var a=d.selection.getRange();!a.collapsed&&d.undoManger&&d.undoManger.save()}),j.on(d.body,c.ie||c.opera?"keydown":"paste",function(e){(!c.ie&&!c.opera||(e.ctrlKey||e.metaKey)&&"86"==e.keyCode)&&a.call(d,function(a){b(a)})})})},UM.plugins.list=function(){var a=this;a.setOpt({insertorderedlist:{decimal:"","lower-alpha":"","lower-roman":"","upper-alpha":"","upper-roman":""},insertunorderedlist:{circle:"",disc:"",square:""}}),this.addInputRule(function(a){e.each(a.getNodesByTagName("li"),function(a){0==a.children.length&&a.parentNode.removeChild(a)})}),a.commands.insertorderedlist=a.commands.insertunorderedlist={execCommand:function(a){this.document.execCommand(a);var b=this.selection.getRange(),c=b.createBookmark(!0);return this.$body.find("ol,ul").each(function(a,b){var c=b.parentNode;"P"==c.tagName&&c.lastChild===c.firstChild&&($(b).children().each(function(a,b){var d=c.cloneNode(!1);$(d).append(b.innerHTML),$(b).html("").append(d)}),$(b).insertBefore(c),$(c).remove())}),b.moveToBookmark(c).select(),!0},queryCommandState:function(a){return this.document.queryCommandState(a)}}},function(){var a={textarea:function(a,b){var d=b.ownerDocument.createElement("textarea");return d.style.cssText="resize:none;border:0;padding:0;margin:0;overflow-y:auto;outline:0",c.ie&&c.version<8&&(d.style.width=b.offsetWidth+"px",d.style.height=b.offsetHeight+"px",b.onresize=function(){d.style.width=b.offsetWidth+"px",d.style.height=b.offsetHeight+"px"}),b.appendChild(d),{container:d,setContent:function(a){d.value=a},getContent:function(){return d.value},select:function(){var a;c.ie?(a=d.createTextRange(),a.collapse(!0),a.select()):(d.setSelectionRange(0,0),d.focus())},dispose:function(){b.removeChild(d),b.onresize=null,d=null,b=null}}}};UM.plugins.source=function(){function b(b){return a.textarea(e,b)}var d,e=this,f=this.options,h=!1;f.sourceEditor="textarea",e.setOpt({sourceEditorFirst:!1});var i,j=e.getContent;e.commands.source={execCommand:function(){if(h=!h){i=e.selection.getRange().createAddress(!1,!0),e.undoManger&&e.undoManger.save(!0),c.gecko&&(e.body.contentEditable=!1),e.body.style.cssText+=";position:absolute;left:-32768px;top:-32768px;",e.fireEvent("beforegetcontent");var a=UM.htmlparser(e.body.innerHTML);e.filterOutputRule(a),a.traversal(function(a){if("element"==a.type)switch(a.tagName){case"td":case"th":case"caption":a.children&&1==a.children.length&&"br"==a.firstChild().tagName&&a.removeChild(a.firstChild());break;case"pre":a.innerText(a.innerText().replace(/ & nbsp;
                    /g," "))}}),e.fireEvent("aftergetcontent");var f=a.toHtml(!0);d=b(e.body.parentNode),d.setContent(f);var k=function(a){return parseInt($(e.body).css(a))};$(d.container).width($(e.body).width()+k("padding-left")+k("padding-right")).height($(e.body).height()),setTimeout(function(){d.select()}),e.getContent=function(){return d.getContent()||"<p>"+(c.ie?"":"<br/ > ")+" < /p>"}}else{e.$body.css({position:"",left:"",top:""});var l=d.getContent()||"<p>"+(c.ie?"":"<br/ > ")+" < /p>";l=l.replace(new RegExp("[\\r\\t\\n ]*</ ? (\\w + )\\s * ( ? :[ ^ >] * ) > ","g "),function(a,b){return b&&!g.$inlineWithA[b.toLowerCase()]?a.replace(/(^[\n\r\t ]*)|([\n\r\t ]*$)/g,""):a.replace(/(^[\n\r\t]*)|([\n\r\t]*$)/g,"")}),e.setContent(l),d.dispose(),d=null,e.getContent=j;var m=e.body.firstChild;m||(e.body.innerHTML=" < p > "+(c.ie?"":" < br / >")+" < /p>"),e.undoManger&&e.undoManger.save(!0),c.gecko&&(e.body.contentEditable=!0);try{e.selection.getRange().moveToAddress(i).select()}catch(n){}}this.fireEvent("sourcemodechanged",h)},queryCommandState:function(){return 0|h},notNeedUndo:1};var k=e.queryCommandState;e.queryCommandState=function(a){return a=a.toLowerCase(),h?a in{source:1,fullscreen:1}?k.apply(this,arguments):-1:k.apply(this,arguments)}}}(),UM.plugins.enterkey=function(){var a,b=this,d=b.options.enterTag;b.addListener("keyup",function(d,e){var f=e.keyCode||e.which;if(13==f){var g,h=b.selection.getRange(),i=h.startContainer;if(c.ie)b.fireEvent("saveScene",!0,!0);else{if(/h\d / i.test(a)) {
                        if (c.gecko) {
                            var k = j.findParentByTagName(i, ["h1", "h2", "h3", "h4", "h5", "h6", "blockquote", "caption", "table"], !0);
                            k || (b.document.execCommand("formatBlock", !1, "<p>"), g = 1)
                        } else if (1 == i.nodeType) {
                            var l, m = b.document.createTextNode("");
                            if (h.insertNode(m), l = j.findParentByTagName(m, "div", !0)) {
                                for (var n = b.document.createElement("p"); l.firstChild;) n.appendChild(l.firstChild);
                                l.parentNode.insertBefore(n, l),
                                j.remove(l),
                                h.setStartBefore(m).setCursor(),
                                g = 1
                            }
                            j.remove(m)
                        }
                        b.undoManger && g && b.undoManger.save()
                    }
                    c.opera && h.select()
                }
            }
        }),
        b.addListener("keydown",
        function(e, f) {
            var g = f.keyCode || f.which;
            if (13 == g) {
                if (b.fireEvent("beforeenterkeydown")) return j.preventDefault(f),
                void 0;
                b.fireEvent("saveScene", !0, !0),
                a = "";
                var h = b.selection.getRange();
                if (!h.collapsed) {
                    var i = h.startContainer,
                    k = h.endContainer,
                    l = j.findParentByTagName(i, "td", !0),
                    m = j.findParentByTagName(k, "td", !0);
                    if (l && m && l !== m || !l && m || l && !m) return f.preventDefault ? f.preventDefault() : f.returnValue = !1,
                    void 0
                }
                "p" == d && (c.ie || (i = j.findParentByTagName(h.startContainer, ["ol", "ul", "p", "h1", "h2", "h3", "h4", "h5", "h6", "blockquote", "caption"], !0), i || c.opera ? (a = i.tagName, "p" == i.tagName.toLowerCase() && c.gecko && j.removeDirtyAttr(i)) : (b.document.execCommand("formatBlock", !1, "<p>"), c.gecko && (h = b.selection.getRange(), i = j.findParentByTagName(h.startContainer, "p", !0), i && j.removeDirtyAttr(i)))))
            }
        })
    },
    UM.commands.preview = {
        execCommand: function() {
            var a = window.open("", "_blank", ""),
            b = a.document;
            b.open(),
            b.write("<html><head></head><body><div>" + this.getContent(null, null, !0) + "</div></body></html>"),
            b.close()
        },
        notNeedUndo: 1
    },
    UM.plugins.basestyle = function() {
        var a = ["bold", "underline", "superscript", "subscript", "italic", "strikethrough"],
        b = this;
        b.addshortcutkey({
            Bold: "ctrl+66",
            Italic: "ctrl+73",
            Underline: "ctrl+shift+85",
            strikeThrough: "ctrl+shift+83"
        }),
        b.addOutputRule(function(a) {
            $.each(a.getNodesByTagName("b i u strike s"),
            function(a, b) {
                switch (b.tagName) {
                case "b":
                    b.tagName = "strong";
                    break;
                case "i":
                    b.tagName = "em";
                    break;
                case "u":
                    b.tagName = "span",
                    b.setStyle("text-decoration", "underline");
                    break;
                case "s":
                case "strike":
                    b.tagName = "span",
                    b.setStyle("text-decoration", "line-through")
                }
            })
        }),
        $.each(a,
        function(a, d) {
            b.commands[d] = {
                execCommand: function(a) {
                    var b = this.selection.getRange();
                    if (b.collapsed && 1 != this.queryCommandState(a)) {
                        var c = this.document.createElement({
                            bold: "strong",
                            underline: "u",
                            superscript: "sup",
                            subscript: "sub",
                            italic: "em",
                            strikethrough: "strike"
                        } [a]);
                        return b.insertNode(c).setStart(c, 0).setCursor(!1),
                        !0
                    }
                    return this.document.execCommand(a)
                },
                queryCommandState: function(a) {
                    if (c.gecko) return this.document.queryCommandState(a);
                    var b = this.selection.getStartElementPath(),
                    d = !1;
                    return $.each(b,
                    function(b, c) {
                        switch (a) {
                        case "bold":
                            if ("STRONG" == c.nodeName || "B" == c.nodeName) return d = 1,
                            !1;
                            break;
                        case "underline":
                            if ("U" == c.nodeName || "SPAN" == c.nodeName && "underline" == $(c).css("text-decoration")) return d = 1,
                            !1;
                            break;
                        case "superscript":
                            if ("SUP" == c.nodeName) return d = 1,
                            !1;
                            break;
                        case "subscript":
                            if ("SUB" == c.nodeName) return d = 1,
                            !1;
                            break;
                        case "italic":
                            if ("EM" == c.nodeName || "I" == c.nodeName) return d = 1,
                            !1;
                            break;
                        case "strikethrough":
                            if ("S" == c.nodeName || "STRIKE" == c.nodeName || "SPAN" == c.nodeName && "line-through" == $(c).css("text-decoration")) return d = 1,
                            !1
                        }
                    }),
                    d
                }
            }
        })
    },
    UM.plugins.video = function() {
        function a(a, b, d, e, f, g) {
            return g ? '<embed type="application/x-shockwave-flash" class="edui-faked-video" pluginspage="http://www.macromedia.com/go/getflashplayer" src="' + a + '" width="' + b + '" height="' + d + '"' + (f ? ' style="float:' + f + '"': "") + ' wmode="transparent" play="true" loop="false" menu="false" allowscriptaccess="never" allowfullscreen="true" >': "<img " + (e ? 'id="' + e + '"': "") + ' width="' + b + '" height="' + d + '" _url="' + a + '" class="edui-faked-video"' + ' src="' + c.options.UMEDITOR_HOME_URL + 'themes/default/images/spacer.gif" style="background:url(' + c.options.UMEDITOR_HOME_URL + "themes/default/images/videologo.gif) no-repeat center center; border:1px solid gray;" + (f ? "float:" + f + ";": "") + '" />'
        }
        function b(b, c) {
            e.each(b.getNodesByTagName(c ? "img": "embed"),
            function(b) {
                if ("edui-faked-video" == b.getAttr("class")) {
                    var d = a(c ? b.getAttr("_url") : b.getAttr("src"), b.getAttr("width"), b.getAttr("height"), null, b.getStyle("float") || "", c);
                    b.parentNode.replaceChild(UM.uNode.createElement(d), b)
                }
            })
        }
        var c = this;
        c.addOutputRule(function(a) {
            b(a, !0)
        }),
        c.addInputRule(function(a) {
            b(a)
        }),
        c.commands.insertvideo = {
            execCommand: function(b, d) {
                d = e.isArray(d) ? d: [d];
                for (var f, g = [], h = "tmpVedio", i = 0, j = d.length; j > i; i++) f = d[i],
                g.push(a(f.url, f.width || 420, f.height || 280, h + i, f.align, !1));
                c.execCommand("inserthtml", g.join(""), !0)
            },
            queryCommandState: function() {
                var a = c.selection.getRange().getClosedNode(),
                b = a && "edui-faked-video" == a.className;
                return b ? 1 : 0
            }
        }
    },
    UM.plugins.selectall = function() {
        var a = this;
        a.commands.selectall = {
            execCommand: function() {
                var a = this,
                b = a.body,
                d = a.selection.getRange();
                d.selectNodeContents(b),
                j.isEmptyBlock(b) && (c.opera && b.firstChild && 1 == b.firstChild.nodeType && d.setStartAtFirst(b.firstChild), d.collapse(!0)),
                d.select(!0)
            },
            notNeedUndo: 1
        },
        a.addshortcutkey({
            selectAll: "ctrl+65"
        })
    },
    UM.plugins.removeformat = function() {
        var a = this;
        a.commands.removeformat = {
            execCommand: function() {
                this.document.execCommand("removeformat")
            }
        }
    },
    UM.plugins.keystrokes = function() {
        var a = this,
        b = !0;
        a.addListener("keydown",
        function(d, e) {
            var f = e.keyCode || e.which,
            g = a.selection.getRange();
            if (!g.collapsed && !(e.ctrlKey || e.shiftKey || e.altKey || e.metaKey) && (f >= 65 && 90 >= f || f >= 48 && 57 >= f || f >= 96 && 111 >= f || {
                13 : 1,
                8 : 1,
                46 : 1
            } [f])) {
                var h = g.startContainer;
                if (j.isFillChar(h) && g.setStartBefore(h), h = g.endContainer, j.isFillChar(h) && g.setEndAfter(h), g.txtToElmBoundary(), g.endContainer && 1 == g.endContainer.nodeType && (h = g.endContainer.childNodes[g.endOffset], h && j.isBr(h) && g.setEndAfter(h)), 0 == g.startOffset && (h = g.startContainer, j.isBoundaryNode(h, "firstChild") && (h = g.endContainer, g.endOffset == (3 == h.nodeType ? h.nodeValue.length: h.childNodes.length) && j.isBoundaryNode(h, "lastChild")))) return a.fireEvent("saveScene"),
                a.body.innerHTML = "<p>" + (c.ie ? "": "<br/>") + "</p>",
                g.setStart(a.body.firstChild, 0).setCursor(!1, !0),
                a._selectionChange(),
                void 0
            }
            if (8 == f) {
                if (g = a.selection.getRange(), b = g.collapsed, a.fireEvent("delkeydown", e)) return;
                var i, k;
                if (g.collapsed && g.inFillChar() && (i = g.startContainer, j.isFillChar(i) ? (g.setStartBefore(i).shrinkBoundary(!0).collapse(!0), j.remove(i)) : (i.nodeValue = i.nodeValue.replace(new RegExp("^" + j.fillChar), ""), g.startOffset--, g.collapse(!0).select(!0))), i = g.getClosedNode()) return a.fireEvent("saveScene"),
                g.setStartBefore(i),
                j.remove(i),
                g.setCursor(),
                a.fireEvent("saveScene"),
                j.preventDefault(e),
                void 0;
                if (!c.ie && (i = j.findParentByTagName(g.startContainer, "table", !0), k = j.findParentByTagName(g.endContainer, "table", !0), i && !k || !i && k || i !== k)) return e.preventDefault(),
                void 0;
                if (i = g.startContainer, g.collapsed && 1 == i.nodeType) {
                    var l = i.childNodes[g.startOffset - 1];
                    l && 1 == l.nodeType && "BR" == l.tagName && (a.fireEvent("saveScene"), g.setStartBefore(l).collapse(!0), j.remove(l), g.select(), a.fireEvent("saveScene"))
                }
                if (c.chrome && g.collapsed) {
                    for (; 0 == g.startOffset && !j.isEmptyBlock(g.startContainer);) g.setStartBefore(g.startContainer);
                    var m = g.startContainer.childNodes[g.startOffset - 1];
                    m && "BR" == m.nodeName && (g.setStartBefore(m), a.fireEvent("saveScene"), $(m).remove(), g.setCursor(), a.fireEvent("saveScene"))
                }
            }
            if (c.gecko && 46 == f) {
                var n = a.selection.getRange();
                if (n.collapsed && (i = n.startContainer, j.isEmptyBlock(i))) {
                    for (var o = i.parentNode; 1 == j.getChildCount(o) && !j.isBody(o);) i = o,
                    o = o.parentNode;
                    return i === o.lastChild && e.preventDefault(),
                    void 0
                }
            }
        }),
        a.addListener("keyup",
        function(a, d) {
            var e, f = d.keyCode || d.which,
            g = this;
            if (8 == f) {
                if (g.fireEvent("delkeyup")) return;
                if (e = g.selection.getRange(), e.collapsed) {
                    var h, i = ["h1", "h2", "h3", "h4", "h5", "h6"];
                    if ((h = j.findParentByTagName(e.startContainer, i, !0)) && j.isEmptyBlock(h)) {
                        var k = h.previousSibling;
                        if (k && "TABLE" != k.nodeName) return j.remove(h),
                        e.setStartAtLast(k).setCursor(!1, !0),
                        void 0;
                        var l = h.nextSibling;
                        if (l && "TABLE" != l.nodeName) return j.remove(h),
                        e.setStartAtFirst(l).setCursor(!1, !0),
                        void 0
                    }
                    if (j.isBody(e.startContainer)) {
                        var h = j.createElement(g.document, "p", {
                            innerHTML: c.ie ? j.fillChar: "<br/>"
                        });
                        e.insertNode(h).setStart(h, 0).setCursor(!1, !0)
                    }
                }
                if (!b && (3 == e.startContainer.nodeType || 1 == e.startContainer.nodeType && j.isEmptyBlock(e.startContainer))) if (c.ie) {
                    var m = e.document.createElement("span");
                    e.insertNode(m).setStartBefore(m).collapse(!0),
                    e.select(),
                    j.remove(m)
                } else e.select()
            }
        })
    },
    UM.plugins.dropfile = function() {
        var a = this;
        a.setOpt("dropFileEnabled", !0),
        a.getOpt("dropFileEnabled") && window.FormData && window.FileReader && a.addListener("ready",
        function() {
            a.$body.on("drop",
            function(b) {
                try {
                    var c = b.originalEvent.dataTransfer.files,
                    d = !1;
                    c && ($.each(c,
                    function(b, c) {
                        if (/^image/.test(c.type)) {
                            var e = new XMLHttpRequest;
                            e.open("post", a.getOpt("imageUrl"), !0),
                            e.setRequestHeader("X-Requested-With", "XMLHttpRequest");
                            var f = new FormData;
                            f.append(a.getOpt("imageFieldName") || "upfile", c),
                            f.append("type", "ajax"),
                            e.send(f),
                            e.addEventListener("load",
                            function(b) {
                                var c = a.getOpt("imagePath") + b.target.response;
                                c && a.execCommand("insertimage", {
                                    src: c,
                                    _src: c
                                })
                            }),
                            d = !0
                        }
                    }), d && b.preventDefault())
                } catch(b) {}
            }).on("dragover",
            function(a) {
                "Files" == a.originalEvent.dataTransfer.types[0] && a.preventDefault()
            })
        })
    },
    function(a) {
        function b(b, c, d) {
            if (b.prototype = a.extend2(a.extend({},
            c), (UM.ui[d] || e).prototype, !0), b.prototype.supper = (UM.ui[d] || e).prototype, UM.ui[d] && UM.ui[d].prototype.defaultOpt) {
                var f = UM.ui[d].prototype.defaultOpt,
                g = b.prototype.defaultOpt;
                b.prototype.defaultOpt = a.extend({},
                f, g || {})
            }
            return b
        }
        function c(b, c) {
            a[f + c] = b,
            a.fn[f + c] = function(c) {
                var d, e = Array.prototype.slice.call(arguments, 1);
                return this.each(function(f, g) {
                    var h = a(g),
                    i = h.edui();
                    if (i || (b(c && a.isPlainObject(c) ? c: {},
                    h), h.edui(i)), "string" == a.type(c)) if ("this" == c) d = i;
                    else {
                        if (d = i[c].apply(i, e), d !== i && void 0 !== d) return ! 1;
                        d = null
                    }
                }),
                null !== d ? d: this
            }
        }
        a.parseTmpl = function(a, b) {
            var c = "var __p=[],print=function(){__p.push.apply(__p,arguments);};with(obj||{}){__p.push('" + a.replace(/\\/g, "\\\\").replace(/'/g, "\\'").replace(/<%=([\s\S]+?)%>/g,
            function(a, b) {
                return "'," + b.replace(/\\'/g, "'") + ",'"
            }).replace(/<%([\s\S]+?)%>/g,
            function(a, b) {
                return "');" + b.replace(/\\'/g, "'").replace(/[\r\n\t]/g, " ") + "__p.push('"
            }).replace(/\r/g, "\\r").replace(/\n/g, "\\n").replace(/\t/g, "\\t") + "');}return __p.join('');",
            d = new Function("obj", c);
            return b ? d(b) : d
        },
        a.extend2 = function(b) {
            for (var c = arguments,
            d = "boolean" == a.type(c[c.length - 1]) ? c[c.length - 1] : !1, e = "boolean" == a.type(c[c.length - 1]) ? c.length - 1 : c.length, f = 1; e > f; f++) {
                var g = c[f];
                for (var h in g) d && b.hasOwnProperty(h) || (b[h] = g[h])
            }
            return b
        },
        a.IE6 = !!window.ActiveXObject && 6 == parseFloat(navigator.userAgent.match(/msie (\d+)/i)[1]);
        var d = [],
        e = function() {},
        f = "edui";
        e.prototype = {
            on: function(b, c) {
                return this.root().on(b, a.proxy(c, this)),
                this
            },
            off: function(b, c) {
                return this.root().off(b, a.proxy(c, this)),
                this
            },
            trigger: function(a, b) {
                return this.root().trigger(a, b) === !1 ? !1 : this
            },
            root: function(a) {
                return this._$el || (this._$el = a)
            },
            destroy: function() {},
            data: function(a, b) {
                return void 0 !== b ? (this.root().data(f + a, b), this) : this.root().data(f + a)
            },
            register: function(b, c, e) {
                d.push({
                    evtname: b,
                    $els: a.isArray(c) ? c: [c],
                    handler: a.proxy(e, c)
                })
            }
        },
        a.fn.edui = function(a) {
            return a ? this.data("eduiwidget", a) : this.data("eduiwidget")
        };
        var g = 1;
        UM.ui = {
            define: function(d, e, h) {
                var i = UM.ui[d] = b(function(b, c) {
                    var e = function() {};
                    a.extend(e.prototype, i.prototype, {
                        guid: d + g++,
                        widgetName: d
                    });
                    var h = new e;
                    if ("string" == a.type(b)) return h.init && h.init({}),
                    h.root().edui(h),
                    h.root().find("a").click(function(a) {
                        a.preventDefault()
                    }),
                    h.root()[f + d].apply(h.root(), arguments);
                    c && h.root(c),
                    h.init && h.init(!b || a.isPlainObject(b) ? a.extend2(b || {},
                    h.defaultOpt || {},
                    !0) : b);
                    try {
                        h.root().find("a").click(function(a) {
                            a.preventDefault()
                        })
                    } catch(j) {}
                    return h.root().edui(h)
                },
                e, h);
                c(i, d)
            }
        },
        a(function() {
            a(document).on("click mouseup mousedown dblclick mouseover",
            function(b) {
                a.each(d,
                function(c, d) {
                    d.evtname == b.type && a.each(d.$els,
                    function(c, e) {
                        e[0] === b.target || a.contains(e[0], b.target) || d.handler(b)
                    })
                })
            })
        })
    } (jQuery), UM.ui.define("button", {
        tpl: '<<%if(!texttype){%>div class="edui-btn edui-btn-<%=icon%> <%if(name){%>edui-btn-name-<%=name%><%}%>" unselectable="on" onmousedown="return false" <%}else{%>a class="edui-text-btn"<%}%><% if(title) {%> data-original-title="<%=title%>" <%};%>> <% if(icon) {%><div unselectable="on" class="edui-icon-<%=icon%> edui-icon"></div><% }; %><%if(text) {%><span unselectable="on" onmousedown="return false" class="edui-button-label"><%=text%></span><%}%><%if(caret && text){%><span class="edui-button-spacing"></span><%}%><% if(caret) {%><span unselectable="on" onmousedown="return false" class="edui-caret"></span><% };%></<%if(!texttype){%>div<%}else{%>a<%}%>>',
        defaultOpt: {
            text: "",
            title: "",
            icon: "",
            width: "",
            caret: !1,
            texttype: !1,
            click: function() {}
        },
        init: function(a) {
            var b = this;
            return b.root($($.parseTmpl(b.tpl, a))).click(function(c) {
                b.wrapclick(a.click, c)
            }),
            b.root().hover(function() {
                b.root().hasClass("disabled") || b.root().toggleClass("hover")
            }),
            b
        },
        wrapclick: function(a, b) {
            return this.disabled() || (this.root().trigger("wrapclick"), $.proxy(a, this, b)()),
            this
        },
        label: function(a) {
            return void 0 === a ? this.root().find(".edui-button-label").text() : (this.root().find(".edui-button-label").text(a), this)
        },
        disabled: function(a) {
            return void 0 === a ? this.root().hasClass("disabled") : (this.root().toggleClass("disabled", a), this.root().hasClass("disabled") && this.root().removeClass("hover"), this)
        },
        active: function(a) {
            return void 0 === a ? this.root().hasClass("active") : (this.root().toggleClass("active", a), this)
        },
        mergeWith: function(a) {
            var b = this;
            b.data("$mergeObj", a),
            a.edui().data("$mergeObj", b.root()),
            $.contains(document.body, a[0]) || a.appendTo(b.root()),
            b.on("click",
            function() {
                b.wrapclick(function() {
                    a.edui().show()
                })
            }).register("click", b.root(),
            function() {
                a.hide()
            })
        }
    }),
    function() {
        UM.ui.define("toolbar", {
            tpl: '<div class="edui-toolbar"  ><div class="edui-btn-toolbar" unselectable="on" onmousedown="return false"  ></div></div>',
            init: function() {
                var a = this.root($(this.tpl));
                this.data("$btnToolbar", a.find(".edui-btn-toolbar"))
            },
            appendToBtnmenu: function(a) {
                var b = this.data("$btnToolbar");
                a = $.isArray(a) ? a: [a],
                $.each(a,
                function(a, c) {
                    b.append(c)
                })
            }
        })
    } (), UM.ui.define("menu", {
        show: function(a, b, c, d, e) {
            c = c || "position",
            this.trigger("beforeshow") !== !1 && (this.root().css($.extend({
                display: "block"
            },
            a ? {
                top: a[c]().top + ("right" == b ? 0 : a.outerHeight()) - (d || 0),
                left: a[c]().left + ("right" == b ? a.outerWidth() : 0) - (e || 0)
            }: {})), this.trigger("aftershow"))
        },
        hide: function(a) {
            var b;
            this.trigger("beforehide") !== !1 && ((b = this.root().data("parentmenu")) && (b.data("parentmenu") || a) && b.edui().hide(), this.root().css("display", "none"), this.trigger("afterhide"))
        },
        attachTo: function(a) {
            var b = this;
            a.data("$mergeObj") || (a.data("$mergeObj", b.root()), a.on("wrapclick",
            function() {
                b.show()
            }), b.register("click", a,
            function() {
                b.hide()
            }), b.data("$mergeObj", a))
        }
    }), UM.ui.define("dropmenu", {
        tmpl: '<ul class="edui-dropdown-menu" aria-labelledby="dropdownMenu" ><%for(var i=0,ci;ci=data[i++];){%><%if(ci.divider){%><li class="edui-divider"></li><%}else{%><li <%if(ci.active||ci.disabled){%>class="<%= ci.active|| \'\' %> <%=ci.disabled||\'\' %>" <%}%> data-value="<%= ci.value%>"><a href="#" tabindex="-1"><em class="edui-dropmenu-checkbox"><i class="edui-icon-ok"></i></em><%= ci.label%></a></li><%}%><%}%></ul>',
        defaultOpt: {
            data: [],
            click: function() {}
        },
        init: function(a) {
            var b = this,
            c = {
                click: 1,
                mouseover: 1,
                mouseout: 1
            };
            this.root($($.parseTmpl(this.tmpl, a))).on("click", 'li[class!="disabled divider dropdown-submenu"]',
            function(c) {
                $.proxy(a.click, b, c, $(this).data("value"), $(this))()
            }).find("li").each(function(d, e) {
                var f = $(this);
                if (!f.hasClass("disabled divider dropdown-submenu")) {
                    var g = a.data[d];
                    $.each(c,
                    function(a) {
                        g[a] && f[a](function(c) {
                            $.proxy(g[a], e)(c, g, b.root)
                        })
                    })
                }
            })
        },
        disabled: function(a) {
            $("li[class!=divider]", this.root()).each(function() {
                var b = $(this);
                a === !0 ? b.addClass("disabled") : $.isFunction(a) ? b.toggleClass("disabled", a(li)) : b.removeClass("disabled")
            })
        },
        val: function(a) {
            var b;
            return $('li[class!="divider disabled dropdown-submenu"]', this.root()).each(function() {
                var c = $(this);
                if (void 0 === a) {
                    if (c.find("em.edui-dropmenu-checked").length) return b = c.data("value"),
                    !1
                } else c.find("em").toggleClass("edui-dropmenu-checked", c.data("value") == a)
            }),
            void 0 === a ? b: void 0
        },
        addSubmenu: function(a, b, c) {
            c = c || 0;
            var d = $("li[class!=divider]", this.root()),
            e = $('<li class="dropdown-submenu"><a tabindex="-1" href="#">' + a + "</a></li>").append(b);
            c >= 0 && c < d.length ? e.insertBefore(d[c]) : 0 > c ? e.insertBefore(d[0]) : c >= d.length && e.appendTo(d)
        }
    },
    "menu"), UM.ui.define("splitbutton", {
        tpl: '<div class="edui-splitbutton <%if (name){%>edui-splitbutton-<%= name %><%}%>"  unselectable="on" <%if(title){%>data-original-title="<%=title%>"<%}%>><div class="edui-btn"  unselectable="on" ><%if(icon){%><div  unselectable="on" class="edui-icon-<%=icon%> edui-icon"></div><%}%><%if(text){%><%=text%><%}%></div><div  unselectable="on" class="edui-btn edui-dropdown-toggle" ><div  unselectable="on" class="edui-caret"></div></div></div>',
        defaultOpt: {
            text: "",
            title: "",
            click: function() {}
        },
        init: function(a) {
            var b = this;
            return b.root($($.parseTmpl(b.tpl, a))),
            b.root().find(".edui-btn:first").click(function() {
                b.disabled() || $.proxy(a.click, b)()
            }),
            b.root().find(".edui-dropdown-toggle").click(function() {
                b.disabled() || b.trigger("arrowclick")
            }),
            b.root().hover(function() {
                b.root().hasClass("disabled") || b.root().toggleClass("hover")
            }),
            b
        },
        wrapclick: function(a, b) {
            return this.disabled() || $.proxy(a, this, b)(),
            this
        },
        disabled: function(a) {
            return void 0 === a ? this.root().hasClass("disabled") : (this.root().toggleClass("disabled", a).find(".edui-btn").toggleClass("disabled", a), this)
        },
        active: function(a) {
            return void 0 === a ? this.root().hasClass("active") : (this.root().toggleClass("active", a).find(".edui-btn:first").toggleClass("active", a), this)
        },
        mergeWith: function(a) {
            var b = this;
            b.data("$mergeObj", a),
            a.edui().data("$mergeObj", b.root()),
            $.contains(document.body, a[0]) || a.appendTo(b.root()),
            b.root().delegate(".edui-dropdown-toggle", "click",
            function() {
                b.wrapclick(function() {
                    a.edui().show()
                })
            }),
            b.register("click", b.root().find(".edui-dropdown-toggle"),
            function() {
                a.hide()
            })
        }
    }), UM.ui.define("colorsplitbutton", {
        tpl: '<div class="edui-splitbutton <%if (name){%>edui-splitbutton-<%= name %><%}%>"  unselectable="on" <%if(title){%>data-original-title="<%=title%>"<%}%>><div class="edui-btn"  unselectable="on" ><%if(icon){%><div  unselectable="on" class="edui-icon-<%=icon%> edui-icon"></div><%}%><div class="edui-splitbutton-color-label" <%if (color) {%>style="background: <%=color%>"<%}%>></div><%if(text){%><%=text%><%}%></div><div  unselectable="on" class="edui-btn edui-dropdown-toggle" ><div  unselectable="on" class="edui-caret"></div></div></div>',
        defaultOpt: {
            color: ""
        },
        init: function(a) {
            var b = this;
            b.supper.init.call(b, a)
        },
        colorLabel: function() {
            return this.root().find(".edui-splitbutton-color-label")
        }
    },
    "splitbutton"), UM.ui.define("popup", {
        tpl: '<div class="edui-dropdown-menu edui-popup"<%if(!<%=stopprop%>){%>onmousedown="return false"<%}%>><div class="edui-popup-body" unselectable="on" onmousedown="return false"><%=subtpl%></div><div class="edui-popup-caret"></div></div>',
        defaultOpt: {
            stopprop: !1,
            subtpl: "",
            width: "",
            height: ""
        },
        init: function(a) {
            return this.root($($.parseTmpl(this.tpl, a))),
            this
        },
        mergeTpl: function(a) {
            return $.parseTmpl(this.tpl, {
                subtpl: a
            })
        },
        show: function(a, b) {
            b || (b = {});
            var c = b.fnname || "position";
            this.trigger("beforeshow") !== !1 && (this.root().css($.extend({
                display: "block"
            },
            a ? {
                top: a[c]().top + ("right" == b.dir ? 0 : a.outerHeight()) - (b.offsetTop || 0),
                left: a[c]().left + ("right" == b.dir ? a.outerWidth() : 0) - (b.offsetLeft || 0),
                position: "absolute"
            }: {})), this.root().find(".edui-popup-caret").css({
                top: b.caretTop || 0,
                left: b.caretLeft || 0,
                position: "absolute"
            }).addClass(b.caretDir || "up"), this.trigger("aftershow"))
        },
        hide: function() {
            this.root().css("display", "none"),
            this.trigger("afterhide")
        },
        attachTo: function(a, b) {
            var c = this;
            a.data("$mergeObj") || (a.data("$mergeObj", c.root()), a.on("wrapclick",
            function() {
                c.show(a, b)
            }), c.register("click", a,
            function() {
                c.hide()
            }), c.data("$mergeObj", a))
        },
        getBodyContainer: function() {
            return this.root().find(".edui-popup-body")
        }
    }), UM.ui.define("scale", {
        tpl: '<div class="edui-scale" unselectable="on"><span class="edui-scale-hand0"></span><span class="edui-scale-hand1"></span><span class="edui-scale-hand2"></span><span class="edui-scale-hand3"></span><span class="edui-scale-hand4"></span><span class="edui-scale-hand5"></span><span class="edui-scale-hand6"></span><span class="edui-scale-hand7"></span></div>',
        defaultOpt: {
            $doc: $(document),
            $wrap: $(document)
        },
        init: function(a) {
            return a.$doc && (this.defaultOpt.$doc = a.$doc),
            a.$wrap && (this.defaultOpt.$wrap = a.$wrap),
            this.root($($.parseTmpl(this.tpl, a))),
            this.initStyle(),
            this.startPos = this.prePos = {
                x: 0,
                y: 0
            },
            this.dragId = -1,
            this
        },
        initStyle: function() {
            e.cssRule("scale", ".edui-scale{display:none;position:absolute;border:1px solid #38B2CE;cursor:hand;}.edui-scale span{position:absolute;left:0;top:0;width:7px;height:7px;overflow:hidden;font-size:0px;display:block;background-color:#3C9DD0;}.edui-scale .edui-scale-hand0{cursor:nw-resize;top:0;margin-top:-4px;left:0;margin-left:-4px;}.edui-scale .edui-scale-hand1{cursor:n-resize;top:0;margin-top:-4px;left:50%;margin-left:-4px;}.edui-scale .edui-scale-hand2{cursor:ne-resize;top:0;margin-top:-4px;left:100%;margin-left:-3px;}.edui-scale .edui-scale-hand3{cursor:w-resize;top:50%;margin-top:-4px;left:0;margin-left:-4px;}.edui-scale .edui-scale-hand4{cursor:e-resize;top:50%;margin-top:-4px;left:100%;margin-left:-3px;}.edui-scale .edui-scale-hand5{cursor:sw-resize;top:100%;margin-top:-3px;left:0;margin-left:-4px;}.edui-scale .edui-scale-hand6{cursor:s-resize;top:100%;margin-top:-3px;left:50%;margin-left:-4px;}.edui-scale .edui-scale-hand7{cursor:se-resize;top:100%;margin-top:-3px;left:100%;margin-left:-3px;}")
        },
        _eventHandler: function(a) {
            var b = this,
            c = b.defaultOpt.$doc;
            switch (a.type) {
            case "mousedown":
                var d, d = a.target || a.srcElement; - 1 != d.className.indexOf("edui-scale-hand") && (b.dragId = d.className.slice( - 1), b.startPos.x = b.prePos.x = a.clientX, b.startPos.y = b.prePos.y = a.clientY, c.bind("mousemove", $.proxy(b._eventHandler, b)));
                break;
            case "mousemove":
                -1 != b.dragId && (b.updateContainerStyle(b.dragId, {
                    x: a.clientX - b.prePos.x,
                    y: a.clientY - b.prePos.y
                }), b.prePos.x = a.clientX, b.prePos.y = a.clientY, b.updateTargetElement());
                break;
            case "mouseup":
                if ( - 1 != b.dragId) {
                    b.dragId = -1,
                    b.updateTargetElement();
                    var e = b.data("$scaleTarget");
                    e.parent() && b.attachTo(b.data("$scaleTarget"))
                }
                c.unbind("mousemove", $.proxy(b._eventHandler, b))
            }
        },
        updateTargetElement: function() {
            var a = this,
            b = a.root(),
            c = a.data("$scaleTarget");
            c.css({
                width: b.width(),
                height: b.height()
            }),
            a.attachTo(c)
        },
        updateContainerStyle: function(a, b) {
            var c, d = this,
            e = d.root(),
            f = [[0, 0, -1, -1], [0, 0, 0, -1], [0, 0, 1, -1], [0, 0, -1, 0], [0, 0, 1, 0], [0, 0, -1, 1], [0, 0, 0, 1], [0, 0, 1, 1]];
            0 != f[a][0] && (c = parseInt(e.offset().left) + b.x, e.css("left", d._validScaledProp("left", c))),
            0 != f[a][1] && (c = parseInt(e.offset().top) + b.y, e.css("top", d._validScaledProp("top", c))),
            0 != f[a][2] && (c = e.width() + f[a][2] * b.x, e.css("width", d._validScaledProp("width", c))),
            0 != f[a][3] && (c = e.height() + f[a][3] * b.y, e.css("height", d._validScaledProp("height", c)))
        },
        _validScaledProp: function(a, b) {
            var c = this.root(),
            d = this.defaultOpt.$doc,
            e = function(a, c, d) {
                return a + c > d ? d - c: b
            };
            switch (b = isNaN(b) ? 0 : b, a) {
            case "left":
                return 0 > b ? 0 : e(b, c.width(), d.width());
            case "top":
                return 0 > b ? 0 : e(b, c.height(), d.height());
            case "width":
                return 0 >= b ? 1 : e(b, c.offset().left, d.width());
            case "height":
                return 0 >= b ? 1 : e(b, c.offset().top, d.height())
            }
        },
        show: function(a) {
            var b = this;
            a && b.attachTo(a),
            b.root().bind("mousedown", $.proxy(b._eventHandler, b)),
            b.defaultOpt.$doc.bind("mouseup", $.proxy(b._eventHandler, b)),
            b.root().show(),
            b.trigger("aftershow")
        },
        hide: function() {
            var a = this;
            a.root().unbind("mousedown", $.proxy(a._eventHandler, a)),
            a.defaultOpt.$doc.unbind("mouseup", $.proxy(a._eventHandler, a)),
            a.root().hide(),
            a.trigger("afterhide")
        },
        attachTo: function(a) {
            var b = this,
            c = a.offset(),
            d = b.root(),
            e = b.defaultOpt.$wrap,
            f = e.offset();
            b.data("$scaleTarget", a),
            b.root().css({
                position: "absolute",
                width: a.width(),
                height: a.height(),
                left: c.left - f.left - parseInt(e.css("border-left-width")) - parseInt(d.css("border-left-width")),
                top: c.top - f.top - parseInt(e.css("border-top-width")) - parseInt(d.css("border-top-width"))
            })
        },
        getScaleTarget: function() {
            return this.data("$scaleTarget")[0]
        }
    }), UM.ui.define("colorpicker", {
        tpl: function(a) {
            for (var b = "ffffff,000000,eeece1,1f497d,4f81bd,c0504d,9bbb59,8064a2,4bacc6,f79646,f2f2f2,7f7f7f,ddd9c3,c6d9f0,dbe5f1,f2dcdb,ebf1dd,e5e0ec,dbeef3,fdeada,d8d8d8,595959,c4bd97,8db3e2,b8cce4,e5b9b7,d7e3bc,ccc1d9,b7dde8,fbd5b5,bfbfbf,3f3f3f,938953,548dd4,95b3d7,d99694,c3d69b,b2a2c7,92cddc,fac08f,a5a5a5,262626,494429,17365d,366092,953734,76923c,5f497a,31859b,e36c09,7f7f7f,0c0c0c,1d1b10,0f243e,244061,632423,4f6128,3f3151,205867,974806,c00000,ff0000,ffc000,ffff00,92d050,00b050,00b0f0,0070c0,002060,7030a0,".split(","), c = '<div unselectable="on" onmousedown="return false" class="edui-colorpicker<%if (name){%> edui-colorpicker-<%=name%><%}%>" ><table unselectable="on" onmousedown="return false"><tr><td colspan="10">' + a.lang_themeColor + "</td> </tr>" + '<tr class="edui-colorpicker-firstrow" >', d = 0; d < b.length; d++) d && 0 === d % 10 && (c += "</tr>" + (60 == d ? '<tr><td colspan="10">' + a.lang_standardColor + "</td></tr>": "") + "<tr" + (60 == d ? ' class="edui-colorpicker-firstrow"': "") + ">"),
            c += 70 > d ? '<td><a unselectable="on" onmousedown="return false" title="' + b[d] + '" class="edui-colorpicker-colorcell"' + ' data-color="#' + b[d] + '"' + ' style="background-color:#' + b[d] + ";border:solid #ccc;" + (10 > d || d >= 60 ? "border-width:1px;": d >= 10 && 20 > d ? "border-width:1px 1px 0 1px;": "border-width:0 1px 0 1px;") + '"' + "></a></td>": "";
            return c += "</tr></table></div>"
        },
        init: function(a) {
            var b = this;
            b.root($($.parseTmpl(b.supper.mergeTpl(b.tpl(a)), a))),
            b.root().on("click",
            function(a) {
                b.trigger("pickcolor", $(a.target).data("color"))
            })
        }
    },
    "popup"),
    function() {
        var a = "combobox",
        b = "edui-combobox-item",
        c = "edui-combobox-item-hover",
        d = "edui-combobox-checked-icon",
        e = "edui-combobox-item-label";
        UM.ui.define(a,
        function() {
            return {
                tpl: '<ul class="dropdown-menu edui-combobox-menu<%if (comboboxName!==\'\') {%> edui-combobox-<%=comboboxName%><%}%>" unselectable="on" onmousedown="return false" role="menu" aria-labelledby="dropdownMenu"><%if(autoRecord) {%><%for( var i=0, len = recordStack.length; i<len; i++ ) {%><%var index = recordStack[i];%><li class="<%=itemClassName%><%if( selected == index ) {%> edui-combobox-checked<%}%>" data-item-index="<%=index%>" unselectable="on" onmousedown="return false"><span class="edui-combobox-icon" unselectable="on" onmousedown="return false"></span><label class="<%=labelClassName%>" style="<%=itemStyles[ index ]%>" unselectable="on" onmousedown="return false"><%=items[index]%></label></li><%}%><%if( i ) {%><li class="edui-combobox-item-separator"></li><%}%><%}%><%for( var i=0, label; label = items[i]; i++ ) {%><li class="<%=itemClassName%><%if( selected == i ) {%> edui-combobox-checked<%}%> edui-combobox-item-<%=i%>" data-item-index="<%=i%>" unselectable="on" onmousedown="return false"><span class="edui-combobox-icon" unselectable="on" onmousedown="return false"></span><label class="<%=labelClassName%>" style="<%=itemStyles[ i ]%>" unselectable="on" onmousedown="return false"><%=label%></label></li><%}%></ul>',
                defaultOpt: {
                    recordStack: [],
                    items: [],
                    value: [],
                    comboboxName: "",
                    selected: "",
                    autoRecord: !0,
                    recordCount: 5
                },
                init: function(a) {
                    var c = this;
                    $.extend(c._optionAdaptation(a), c._createItemMapping(a.recordStack, a.items), {
                        itemClassName: b,
                        iconClass: d,
                        labelClassName: e
                    }),
                    this._transStack(a),
                    c.root($($.parseTmpl(c.tpl, a))),
                    this.data("options", a).initEvent()
                },
                initEvent: function() {
                    var a = this;
                    a.initSelectItem(),
                    this.initItemActive()
                },
                initSelectItem: function() {
                    var a = this,
                    c = "." + e;
                    a.root().delegate("." + b, "click",
                    function() {
                        var b = $(this),
                        d = b.attr("data-item-index");
                        return a.trigger("comboboxselect", {
                            index: d,
                            label: b.find(c).text(),
                            value: a.data("options").value[d]
                        }).select(d),
                        a.hide(),
                        !1
                    })
                },
                initItemActive: function() {
                    var a = {
                        mouseenter: "addClass",
                        mouseleave: "removeClass"
                    };
                    $.IE6 && this.root().delegate("." + b, "mouseenter mouseleave",
                    function(b) {
                        $(this)[a[b.type]](c)
                    }).one("afterhide",
                    function() {})
                },
                select: function(a) {
                    var b = this.data("options").itemCount,
                    c = this.data("options").autowidthitem;
                    return c && !c.length && (c = this.data("options").items),
                    0 == b ? null: (0 > a ? a = b + a % b: a >= b && (a = b - 1), this.trigger("changebefore", c[a]), this._update(a), this.trigger("changeafter", c[a]), null)
                },
                selectItemByLabel: function(a) {
                    var b = this.data("options").itemMapping,
                    c = this,
                    d = null; ! $.isArray(a) && (a = [a]),
                    $.each(a,
                    function(a, e) {
                        return d = b[e],
                        void 0 !== d ? (c.select(d), !1) : void 0
                    })
                },
                _transStack: function(a) {
                    var b = [],
                    c = -1,
                    d = -1;
                    $.each(a.recordStack,
                    function(e, f) {
                        c = a.itemMapping[f],
                        $.isNumeric(c) && (b.push(c), f == a.selected && (d = c))
                    }),
                    a.recordStack = b,
                    a.selected = d,
                    b = null
                },
                _optionAdaptation: function(a) {
                    if (! ("itemStyles" in a)) {
                        a.itemStyles = [];
                        for (var b = 0,
                        c = a.items.length; c > b; b++) a.itemStyles.push("")
                    }
                    return a.autowidthitem = a.autowidthitem || a.items,
                    a.itemCount = a.items.length,
                    a
                },
                _createItemMapping: function(a, b) {
                    var c = {},
                    d = {
                        recordStack: [],
                        mapping: {}
                    };
                    return $.each(b,
                    function(a, b) {
                        c[b] = a
                    }),
                    d.itemMapping = c,
                    $.each(a,
                    function(a, b) {
                        void 0 !== c[b] && (d.recordStack.push(c[b]), d.mapping[b] = c[b])
                    }),
                    d
                },
                _update: function(a) {
                    var b = this.data("options"),
                    c = [],
                    d = null;
                    $.each(b.recordStack,
                    function(b, d) {
                        d != a && c.push(d)
                    }),
                    c.unshift(a),
                    c.length > b.recordCount && (c.length = b.recordCount),
                    b.recordStack = c,
                    b.selected = a,
                    d = $($.parseTmpl(this.tpl, b)),
                    this.root().html(d.html()),
                    d = null,
                    c = null
                }
            }
        } (), "menu")
    } (),
    function() {
        var a = "buttoncombobox";
        UM.ui.define(a,
        function() {
            return {
                defaultOpt: {
                    label: "",
                    title: ""
                },
                init: function(a) {
                    var b = this,
                    c = $.eduibutton({
                        caret: !0,
                        name: a.comboboxName,
                        title: a.title,
                        text: a.label,
                        click: function() {
                            b.show(this.root())
                        }
                    });
                    b.supper.init.call(b, a),
                    b.on("changebefore",
                    function(a, b) {
                        c.eduibutton("label", b)
                    }),
                    b.data("button", c),
                    b.attachTo(c)
                },
                button: function() {
                    return this.data("button")
                }
            }
        } (), "combobox")
    } (), UM.ui.define("modal", {
        tpl: '<div class="edui-modal" tabindex="-1" ><div class="edui-modal-header"><div class="edui-close" data-hide="modal"></div><h3 class="edui-title"><%=title%></h3></div><div class="edui-modal-body"  style="<%if(width){%>width:<%=width%>px;<%}%><%if(height){%>height:<%=height%>px;<%}%>"> </div><% if(cancellabel || oklabel) {%><div class="edui-modal-footer"><div class="edui-modal-tip"></div><%if(oklabel){%><div class="edui-btn edui-btn-primary" data-ok="modal"><%=oklabel%></div><%}%><%if(cancellabel){%><div class="edui-btn" data-hide="modal"><%=cancellabel%></div><%}%></div><%}%></div>',
        defaultOpt: {
            title: "",
            cancellabel: "",
            oklabel: "",
            width: "",
            height: "",
            backdrop: !0,
            keyboard: !0
        },
        init: function(a) {
            var b = this;
            b.root($($.parseTmpl(b.tpl, a || {}))),
            b.data("options", a),
            a.okFn && b.on("ok", $.proxy(a.okFn, b)),
            a.cancelFn && b.on("beforehide", $.proxy(a.cancelFn, b)),
            b.root().delegate('[data-hide="modal"]', "click", $.proxy(b.hide, b)).delegate('[data-ok="modal"]', "click", $.proxy(b.ok, b)),
            $('[data-hide="modal"],[data-ok="modal"]', b.root()).hover(function() {
                $(this).toggleClass("hover")
            })
        },
        toggle: function() {
            var a = this;
            return a[a.data("isShown") ? "hide": "show"]()
        },
        show: function() {
            var a = this;
            a.trigger("beforeshow"),
            a.data("isShown") || (a.data("isShown", !0), a.escape(), a.backdrop(function() {
                a.autoCenter(),
                a.root().show().focus().trigger("aftershow")
            }))
        },
        showTip: function(a) {
            $(".edui-modal-tip", this.root()).html(a).fadeIn()
        },
        hideTip: function() {
            $(".edui-modal-tip", this.root()).fadeOut(function() {
                $(this).html("")
            })
        },
        autoCenter: function() { ! $.IE6 && this.root().css("margin-left", -(this.root().width() / 2))
        },
        hide: function() {
            var a = this;
            a.trigger("beforehide"),
            a.data("isShown") && (a.data("isShown", !1), a.escape(), a.hideModal())
        },
        escape: function() {
            var a = this;
            a.data("isShown") && a.data("options").keyboard ? a.root().on("keyup",
            function(b) {
                27 == b.which && a.hide()
            }) : a.data("isShown") || a.root().off("keyup")
        },
        hideModal: function() {
            var a = this;
            a.root().hide(),
            a.backdrop(function() {
                a.removeBackdrop(),
                a.trigger("afterhide")
            })
        },
        removeBackdrop: function() {
            this.$backdrop && this.$backdrop.remove(),
            this.$backdrop = null
        },
        backdrop: function(a) {
            var b = this;
            b.data("isShown") && b.data("options").backdrop && (b.$backdrop = $('<div class="edui-modal-backdrop" />').click("static" == b.data("options").backdrop ? $.proxy(b.root()[0].focus, b.root()[0]) : $.proxy(b.hide, b))),
            b.trigger("afterbackdrop"),
            a && a()
        },
        attachTo: function(a) {
            var b = this;
            a.data("$mergeObj") || (a.data("$mergeObj", b.root()), a.on("click",
            function() {
                b.toggle(a)
            }), b.data("$mergeObj", a))
        },
        ok: function() {
            var a = this;
            a.trigger("beforeok"),
            a.trigger("ok", a) !== !1 && a.hide()
        },
        getBodyContainer: function() {
            return this.root().find(".edui-modal-body")
        }
    }), UM.ui.define("tooltip", {
        tpl: '<div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div>',
        init: function(a) {
            var b = this;
            b.root($($.parseTmpl(b.tpl, a || {})))
        },
        content: function(a) {
            var b = this,
            c = $(a.currentTarget).attr("data-original-title");
            b.root().find(".edui-tooltip-inner").text(c)
        },
        position: function(a) {
            var b = this,
            c = $(a.currentTarget);
            b.root().css($.extend({
                display: "block"
            },
            c ? {
                top: c.outerHeight(),
                left: (c.outerWidth() - b.root().outerWidth()) / 2
            }: {}))
        },
        show: function(a) {
            if (!$(a.currentTarget).hasClass("disabled")) {
                var b = this;
                b.content(a),
                b.root().appendTo($(a.currentTarget)),
                b.position(a),
                b.root().css("display", "block").addClass("in bottom")
            }
        },
        hide: function() {
            var a = this;
            a.root().removeClass("in bottom").css("display", "none")
        },
        attachTo: function(a) {
            function b(a) {
                var b = this;
                $.contains(document.body, b.root()[0]) || b.root().appendTo(a),
                b.data("tooltip", b.root()),
                a.each(function() {
                    $(this).attr("data-original-title") && $(this).on("mouseenter", $.proxy(b.show, b)).on("mouseleave click", $.proxy(b.hide, b))
                })
            }
            var c = this;
            "undefined" === $.type(a) ? $("[data-original-title]").each(function(a, d) {
                b.call(c, $(d))
            }) : a.data("tooltip") || b.call(c, a)
        }
    }), UM.ui.define("tab", {
        init: function(a) {
            var b = this,
            c = a.selector;
            $.type(c) && (b.root($(c, a.context)), b.data("context", a.context), $(c, b.data("context")).on("click",
            function(a) {
                b.show(a)
            }))
        },
        show: function(a) {
            var b, c, d, a, e = this,
            f = $(a.target),
            g = f.closest("ul");
            b = f.attr("href"),
            b = b && b.replace(/.*(?=#[^\s]*$)/, "");
            var h = f.parent("li");
            h.length && !h.hasClass("active") && (c = g.find(".active:last a")[0], a = $.Event("beforeshow", {
                target: f[0],
                relatedTarget: c
            }), e.trigger(a), a.isDefaultPrevented() || (d = $(b, e.data("context")), e.activate(f.parent("li"), g), e.activate(d, d.parent(),
            function() {
                e.trigger({
                    type: "aftershow",
                    relatedTarget: c
                })
            })))
        },
        activate: function(a, b, c) {
            if (void 0 === a) return $(".edui-tab-item.active", this.root()).index();
            var d = b.find("> .active");
            d.removeClass("active"),
            a.addClass("active"),
            c && c()
        }
    }), UM.ui.define("separator", {
        tpl: '<div class="edui-separator" unselectable="on" onmousedown="return false" ></div>',
        init: function(a) {
            var b = this;
            return b.root($($.parseTmpl(b.tpl, a))),
            b
        }
    }),
    function() {
        var a = {},
        b = {},
        d = [],
        f = null,
        g = {},
        h = {},
        i = {};
        e.extend(UM, {
            defaultWidth: 500,
            defaultHeight: 500,
            registerUI: function(b, c) {
                e.each(b.split(/\s+/),
                function(b) {
                    a[b] = c
                })
            },
            setEditor: function(a) { ! b[a.id] && (b[a.id] = a)
            },
            registerWidget: function(a, b, c) {
                g[a] = $.extend2(b, {
                    $root: "",
                    _preventDefault: !1,
                    root: function(a) {
                        return this.$root || (this.$root = a)
                    },
                    preventDefault: function() {
                        this._preventDefault = !0
                    },
                    clear: !1
                }),
                c && (h[a] = c)
            },
            getWidgetData: function(a) {
                return g[a]
            },
            setWidgetBody: function(a, b, c) {
                c._widgetData || (c._widgetData = {},
                c.getWidgetData = function(a) {
                    return this._widgetData[a]
                },
                c.getWidgetCallback = function(a) {
                    return h[a]
                });
                var d = g[a];
                if (!d) return null;
                d = c._widgetData[a],
                d || (d = g[a], d = c._widgetData[a] = "function" == $.type(d) ? d: e.clone(d)),
                d.root(b.edui().getBodyContainer()),
                d.initContent(c, b),
                d._preventDefault || d.initEvent(c, b),
                d.width && b.width(d.width);
                var f = h[a];
                f && !f.init && (h[a] = function() {
                    var a = Array.prototype.slice.call(arguments, 0);
                    f.apply(c, [c, b].concat(a))
                },
                h[a].init = !0)
            },
            setActiveWidget: function(a) {
                f = a
            },
            getEditor: function(a, c) {
                return b[a] || (b[a] = this.createEditor(a, c))
            },
            clearCache: function(a) {
                b[a] && delete b[a]
            },
            delEditor: function(a) {
                var c; (c = b[a]) && c.destroy()
            },
            ready: function(a) {
                d.push(a)
            },
            createEditor: function(a, b) {
                function c() {
                    var b = this.createUI("#" + a, e);
                    e.key = a,
                    e.ready(function() {
                        $.each(d,
                        function(a, b) {
                            $.proxy(b, e)()
                        })
                    });
                    var c = e.options;
                    c.minFrameWidth = c.initialFrameWidth ? c.initialFrameWidth: c.initialFrameWidth = e.$body.width() || UM.defaultWidth,
                    b.css({
                        width: c.initialFrameWidth,
                        zIndex: e.getOpt("zIndex")
                    }),
                    UM.browser.ie && 6 === UM.browser.version && document.execCommand("BackgroundImageCache", !1, !0),
                    e.render(a),
                    $.eduitooltip && $.eduitooltip("attachTo").css("z-index", e.getOpt("zIndex") + 1),
                    b.find("a").click(function(a) {
                        a.preventDefault()
                    }),
                    e.fireEvent("afteruiready")
                }
                var e = new UM.Editor(b),
                f = this;
                return e.langIsReady ? $.proxy(c, f)() : e.addListener("langReady", $.proxy(c, f)),
                e
            },
            createUI: function(b, d) {
                var e = $(b),
                f = $('<div class="edui-container"><div class="edui-editor-body"></div></div>').insertBefore(e);
                if (d.$container = f, d.container = f[0], d.$body = e, c.ie && c.ie9above) {
                    var g = $('<span style="padding:0;margin:0;height:0;width:0"></span>');
                    g.insertAfter(f)
                }
                return $.each(a,
                function(a, b) {
                    var c = b.call(d, a);
                    c && (i[a] = c)
                }),
                f.find(".edui-editor-body").append(e).before(this.createToolbar(d.options, d)),
                f.find(".edui-toolbar").append($('<div class="edui-dialog-container"></div>')),
                f
            },
            createToolbar: function(a) {
                var b = $.eduitoolbar(),
                c = b.edui();
                if (a.toolbar && a.toolbar.length) {
                    var d = [];
                    $.each(a.toolbar,
                    function(a, b) {
                        $.each(b.split(/\s+/),
                        function(a, b) {
                            if ("|" == b) $.eduiseparator && d.push($.eduiseparator());
                            else {
                                var c = i[b];
                                "fullscreen" == b ? c && d.unshift(c) : c && d.push(c)
                            }
                        }),
                        d.length && c.appendToBtnmenu(d)
                    })
                } else b.find(".edui-btn-toolbar").remove();
                return b
            }
        })
    } (), UM.registerUI("bold italic redo undo underline strikethrough superscript subscript insertorderedlist insertunorderedlist cleardoc selectall link unlink print preview justifyleft justifycenter justifyright justifyfull removeformat horizontal",
    function(a) {
        var b = this,
        c = $.eduibutton({
            icon: a,
            click: function() {
                b.execCommand(a)
            },
            title: this.getLang("labelMap")[a] || ""
        });
        return this.addListener("selectionchange",
        function() {
            var b = this.queryCommandState(a);
            c.edui().disabled( - 1 == b).active(1 == b)
        }),
        c
    }),
    function() {
        function a(a) {
            var b = this;
            if (!a) throw new Error("invalid params, notfound editor");
            b.editor = a,
            g[a.uid] = this,
            a.addListener("destroy",
            function() {
                delete g[a.uid],
                b.editor = null
            })
        }
        var b = {},
        c = ["width", "height", "position", "top", "left", "margin", "padding", "overflowX", "overflowY"],
        d = {},
        e = {},
        f = {},
        g = {};
        UM.registerUI("fullscreen",
        function(b) {
            var c = this,
            d = $.eduibutton({
                icon: "fullscreen",
                title: c.options.labelMap && c.options.labelMap[b] || c.getLang("labelMap." + b),
                click: function() {
                    c.execCommand(b)
                }
            });
            return c.addListener("selectionchange",
            function() {
                var a = this.queryCommandState(b);
                d.edui().disabled( - 1 == a).active(1 == a)
            }),
            c.addListener("ready",
            function() {
                c.options.fullscreen && a.getInstance(c).toggle()
            }),
            d
        }),
        UM.commands.fullscreen = {
            execCommand: function() {
                a.getInstance(this).toggle()
            },
            queryCommandState: function() {
                return this._edui_fullscreen_status
            },
            notNeedUndo: 1
        },
        a.prototype = {
            toggle: function() {
                var a = this.editor,
                b = this.isFullState();
                a.fireEvent("beforefullscreenchange", !b),
                this.update(!b),
                b ? this.revert() : this.enlarge(),
                a.fireEvent("afterfullscreenchange", !b),
                "true" === a.body.contentEditable && a.fireEvent("fullscreenchanged", !b),
                a.fireEvent("selectionchange")
            },
            enlarge: function() {
                this.saveSataus(),
                this.setDocumentStatus(),
                this.resize()
            },
            revert: function() {
                var a = this.editor.options,
                b = /%$/.test(a.initialFrameHeight) ? "100%": a.initialFrameHeight - this.getStyleValue("padding-top") - this.getStyleValue("padding-bottom") - this.getStyleValue("border-width");
                $.IE6 && this.getEditorHolder().style.setExpression("height", "this.scrollHeight <= " + b + ' ? "' + b + 'px" : "auto"'),
                this.revertContainerStatus(),
                this.revertContentAreaStatus(),
                this.revertDocumentStatus()
            },
            update: function(a) {
                this.editor._edui_fullscreen_status = a
            },
            resize: function() {
                var a = null,
                b = 0,
                c = 0,
                d = 0,
                e = 0,
                f = this.editor,
                g = null,
                h = null;
                this.isFullState() && (a = $(window), c = a.width(), b = a.height(), h = this.getEditorHolder(), d = parseInt(j.getComputedStyle(h, "border-width"), 10) || 0, d += parseInt(j.getComputedStyle(f.container, "border-width"), 10) || 0, e += parseInt(j.getComputedStyle(h, "padding-left"), 10) + parseInt(j.getComputedStyle(h, "padding-right"), 10) || 0, $.IE6 && h.style.setExpression("height", null), g = this.getBound(), $(f.container).css({
                    width: c + "px",
                    height: b + "px",
                    position: $.IE6 ? "absolute": "fixed",
                    top: g.top,
                    left: g.left,
                    margin: 0,
                    padding: 0,
                    overflowX: "hidden",
                    overflowY: "hidden"
                }), $(h).css({
                    width: c - 2 * d - e + "px",
                    height: b - 2 * d - (f.options.withoutToolbar ? 0 : $(".edui-toolbar", f.container).outerHeight()) - $(".edui-bottombar", f.container).outerHeight() + "px",
                    overflowX: "hidden",
                    overflowY: "auto"
                }))
            },
            saveSataus: function() {
                for (var a = this.editor.container.style,
                d = null,
                e = {},
                f = 0,
                g = c.length; g > f; f++) d = c[f],
                e[d] = a[d];
                b[this.editor.uid] = e,
                this.saveContentAreaStatus(),
                this.saveDocumentStatus()
            },
            saveContentAreaStatus: function() {
                var a = $(this.getEditorHolder());
                d[this.editor.uid] = {
                    width: a.css("width"),
                    overflowX: a.css("overflowX"),
                    overflowY: a.css("overflowY"),
                    height: a.css("height")
                }
            },
            saveDocumentStatus: function() {
                var a = $(this.getEditorDocumentBody());
                e[this.editor.uid] = {
                    overflowX: a.css("overflowX"),
                    overflowY: a.css("overflowY")
                },
                f[this.editor.uid] = {
                    overflowX: $(this.getEditorDocumentElement()).css("overflowX"),
                    overflowY: $(this.getEditorDocumentElement()).css("overflowY")
                }
            },
            revertContainerStatus: function() {
                $(this.editor.container).css(this.getEditorStatus())
            },
            revertContentAreaStatus: function() {
                var a = this.getEditorHolder(),
                b = this.getContentAreaStatus();
                this.supportMin() && (delete b.height, a.style.height = null),
                $(a).css(b)
            },
            revertDocumentStatus: function() {
                var a = this.getDocumentStatus();
                $(this.getEditorDocumentBody()).css("overflowX", a.body.overflowX),
                $(this.getEditorDocumentElement()).css("overflowY", a.html.overflowY)
            },
            setDocumentStatus: function() {
                $(this.getEditorDocumentBody()).css({
                    overflowX: "hidden",
                    overflowY: "hidden"
                }),
                $(this.getEditorDocumentElement()).css({
                    overflowX: "hidden",
                    overflowY: "hidden"
                })
            },
            isFullState: function() {
                return !! this.editor._edui_fullscreen_status
            },
            getEditorStatus: function() {
                return b[this.editor.uid]
            },
            getContentAreaStatus: function() {
                return d[this.editor.uid]
            },
            getEditorDocumentElement: function() {
                return this.editor.container.ownerDocument.documentElement
            },
            getEditorDocumentBody: function() {
                return this.editor.container.ownerDocument.body
            },
            getEditorHolder: function() {
                return this.editor.body
            },
            getDocumentStatus: function() {
                return {
                    body: e[this.editor.uid],
                    html: f[this.editor.uid]
                }
            },
            supportMin: function() {
                var a = null;
                return this._support || (a = document.createElement("div"), this._support = "minWidth" in a.style, a = null),
                this._support
            },
            getBound: function() {
                var a = {
                    html: !0,
                    body: !0
                },
                b = {
                    top: 0,
                    left: 0
                },
                c = null;
                return $.IE6 ? (c = this.editor.container.offsetParent, c && !a[c.nodeName.toLowerCase()] && (a = c.getBoundingClientRect(), b.top = -a.top, b.left = -a.left), b) : b
            },
            getStyleValue: function(a) {
                return parseInt(j.getComputedStyle(this.getEditorHolder(), a))
            }
        },
        $.extend(a, {
            listen: function() {
                var b = null;
                a._hasFullscreenListener || (a._hasFullscreenListener = !0, $(window).on("resize",
                function() {
                    null !== b && (window.clearTimeout(b), b = null),
                    b = window.setTimeout(function() {
                        for (var a in g) g[a].resize();
                        b = null
                    },
                    50)
                }))
            },
            getInstance: function(b) {
                return g[b.uid] || new a(b),
                g[b.uid]
            }
        }),
        a.listen()
    } (), UM.registerUI("link image map insertvideo",
    function(a) {
        var b, c, d = this,
        f = {
            insertvideo: "video"
        },
        g = f[a] || a,
        h = {
            title: d.options.labelMap && d.options.labelMap[a] || d.getLang("labelMap." + a),
            url: d.options.UMEDITOR_HOME_URL + "dialogs/" + g + "/" + g + ".js"
        },
        i = $.eduibutton({
            icon: a,
            title: this.getLang("labelMap")[a] || ""
        });
        return e.loadFile(document, {
            src: h.url,
            tag: "script",
            type: "text/javascript",
            defer: "defer"
        },
        function() {
            var e = UM.getWidgetData(a);
            if (e.buttons) {
                var f = e.buttons.ok;
                f && (h.oklabel = f.label || d.getLang("ok"), f.exec && (h.okFn = function() {
                    return $.proxy(f.exec, null, d, c)()
                }));
                var g = e.buttons.cancel;
                g && (h.cancellabel = g.label || d.getLang("cancel"), g.exec && (h.cancelFn = function() {
                    return $.proxy(g.exec, null, d, c)()
                }))
            }
            e.width && (h.width = e.width),
            e.height && (h.height = e.height),
            c = $.eduimodal(h),
            c.attr("id", "edui-dialog-" + a).find(".edui-modal-body").addClass("edui-dialog-" + a + "-body"),
            c.edui().on("beforehide",
            function() {
                var a = d.selection.getRange();
                a.equals(b) && a.select()
            }).on("beforeshow",
            function() {
                var e = this.root(),
                f = null,
                g = null;
                b = d.selection.getRange(),
                e.parent()[0] || d.$container.find(".edui-dialog-container").append(e),
                $.IE6 && (f = {
                    width: $(window).width(),
                    height: $(window).height()
                },
                g = e.parents(".edui-toolbar")[0].getBoundingClientRect(), e.css({
                    position: "absolute",
                    margin: 0,
                    left: (f.width - e.width()) / 2 - g.left,
                    top: 100 - g.top
                })),
                UM.setWidgetBody(a, c, d)
            }).on("afterbackdrop",
            function() {
                this.$backdrop.css("zIndex", d.getOpt("zIndex") + 1).appendTo(d.$container.find(".edui-dialog-container")),
                c.css("zIndex", d.getOpt("zIndex") + 2)
            }).on("beforeok",
            function() {
                try {
                    b.select()
                } catch(a) {}
            }).attachTo(i)
        }),
        d.addListener("selectionchange",
        function() {
            var b = this.queryCommandState(a);
            i.edui().disabled( - 1 == b).active(1 == b)
        }),
        i
    }), UM.registerUI("emotion",
    function(a) {
        var b = this,
        c = b.options.UMEDITOR_HOME_URL + "dialogs/" + a + "/" + a + ".js",
        d = $.eduibutton({
            icon: a,
            title: this.getLang("labelMap")[a] || ""
        });
        return e.loadFile(document, {
            src: c,
            tag: "script",
            type: "text/javascript",
            defer: "defer"
        },
        function() {
            var e = {
                url: c
            },
            f = UM.getWidgetData(a);
            f.width && (e.width = f.width),
            f.height && (e.height = f.height),
            $.eduipopup(e).css("zIndex", b.options.zIndex + 1).edui().on("beforeshow",
            function() {
                var c = this.root();
                c.parent().length || b.$container.find(".edui-dialog-container").append(c),
                UM.setWidgetBody(a, c, b)
            }).attachTo(d, {
                offsetTop: -5,
                offsetLeft: 10,
                caretLeft: 11,
                caretTop: -8
            }),
            b.addListener("selectionchange",
            function() {
                var a = this.queryCommandState("emotion");
                d.edui().disabled( - 1 == a).active(1 == a)
            })
        }),
        d
    }), UM.registerUI("imagescale",
    function() {
        var a, d = this;
        d.setOpt("imageScaleEnabled", !0),
        c.webkit && d.getOpt("imageScaleEnabled") && (d.addListener("click",
        function() {
            var b = d.selection.getRange(),
            c = b.getClosedNode();
            if (c && "IMG" == c.tagName) {
                if (!a) {
                    a = $.eduiscale({
                        $wrap: d.$container
                    }).css("zIndex", d.options.zIndex),
                    d.$container.append(a);
                    var e, f = function() {
                        a.edui().hide()
                    },
                    g = function(a) {
                        var b = a.target || a.srcElement;
                        b && -1 == b.className.indexOf("edui-scale") && f(a)
                    };
                    a.edui().on("aftershow",
                    function() {
                        $(document).bind("keydown", f),
                        $(document).bind("mousedown", g),
                        d.selection.getNative().removeAllRanges()
                    }).on("afterhide",
                    function() {
                        $(document).unbind("keydown", f),
                        $(document).unbind("mousedown", g);
                        var b = a.edui().getScaleTarget();
                        b.parentNode && d.selection.getRange().selectNode(b).select()
                    }).on("mousedown",
                    function(b) {
                        d.selection.getNative().removeAllRanges();
                        var c = b.target || b.srcElement;
                        c && -1 == c.className.indexOf("edui-scale-hand") && (e = setTimeout(function() {
                            a.edui().hide()
                        },
                        200))
                    }).on("mouseup",
                    function(a) {
                        var b = a.target || a.srcElement;
                        b && -1 == b.className.indexOf("edui-scale-hand") && clearTimeout(e)
                    })
                }
                a.edui().show($(c))
            } else a && "none" != a.css("display") && a.edui().hide()
        }), d.addListener("click",
        function(a, c) {
            if ("IMG" == c.target.tagName) {
                var e = new b.Range(d.document, d.body);
                e.selectNode(c.target).select()
            }
        }))
    }), UM.registerUI("autofloat",
    function() {
        var a = this,
        b = a.getLang();
        a.setOpt({
            topOffset: 0
        });
        var d = a.options.autoFloatEnabled !== !1,
        f = a.options.topOffset;
        d && a.ready(function() {
            function d() {
                return UM.ui ? 1 : (alert(b.autofloatMsg), 0)
            }
            function g() {
                var a = document.body.style;
                a.backgroundImage = 'url("about:blank")',
                a.backgroundAttachment = "fixed"
            }
            function h() {
                if (!s) {
                    var b = j.getXY(m),
                    d = j.getComputedStyle(m, "position"),
                    e = j.getComputedStyle(m, "left");
                    m.style.width = m.offsetWidth + "px",
                    m.style.zIndex = 1 * a.options.zIndex + 1,
                    m.parentNode.insertBefore(q, m),
                    o || p && c.ie ? ("absolute" != m.style.position && (m.style.position = "absolute"), m.style.top = (document.body.scrollTop || document.documentElement.scrollTop) - n + f + "px") : "fixed" != m.style.position && (m.style.position = "fixed", m.style.top = f + "px", ("absolute" == d || "relative" == d) && parseFloat(e) && (m.style.left = b.x + "px"))
                }
            }
            function i() {
                q.parentNode && q.parentNode.removeChild(q),
                m.style.cssText = l
            }
            function k() {
                var b = r(a.container),
                c = a.options.toolbarTopOffset || 0;
                b.top < 0 && b.bottom - m.offsetHeight > c ? h() : i()
            }
            var l, m, n, o = c.ie && c.version <= 6,
            p = c.quirks,
            q = document.createElement("div"),
            r = function(a) {
                var b;
                try {
                    b = a.getBoundingClientRect()
                } catch(c) {
                    b = {
                        left: 0,
                        top: 0,
                        height: 0,
                        width: 0
                    }
                }
                for (var d, e = {
                    left: Math.round(b.left),
                    top: Math.round(b.top),
                    height: Math.round(b.bottom - b.top),
                    width: Math.round(b.right - b.left)
                }; (d = a.ownerDocument) !== document && (a = j.getWindow(d).frameElement);) b = a.getBoundingClientRect(),
                e.left += b.left,
                e.top += b.top;
                return e.bottom = e.top + e.height,
                e.right = e.left + e.width,
                e
            },
            s = !1,
            t = e.defer(function() {
                k()
            },
            c.ie ? 200 : 100, !0);
            a.addListener("destroy",
            function() {
                j.un(window, ["scroll", "resize"], k),
                a.removeListener("keydown", t)
            }),
            d(a) && (m = $(".edui-toolbar", a.container)[0], a.addListener("afteruiready",
            function() {
                setTimeout(function() {
                    n = $(m).offset().top
                },
                100)
            }), l = m.style.cssText, q.style.height = m.offsetHeight + "px", o && g(), j.on(window, ["scroll", "resize"], k), a.addListener("keydown", t), a.addListener("beforefullscreenchange",
            function(a, b) {
                b && (i(), s = b)
            }), a.addListener("fullscreenchanged",
            function(a, b) {
                b || k(),
                s = b
            }), a.addListener("sourcemodechanged",
            function() {
                setTimeout(function() {
                    k()
                },
                0)
            }), a.addListener("clearDoc",
            function() {
                setTimeout(function() {
                    k()
                },
                0)
            }))
        })
    }), UM.registerUI("source",
    function(a) {
        var b = this;
        b.addListener("fullscreenchanged",
        function() {
            b.$container.find("textarea").width(b.$body.width() - 10).height(b.$body.height())
        });
        var c = $.eduibutton({
            icon: a,
            click: function() {
                b.execCommand(a)
            },
            title: this.getLang("labelMap")[a] || ""
        });
        return this.addListener("selectionchange",
        function() {
            var b = this.queryCommandState(a);
            c.edui().disabled( - 1 == b).active(1 == b)
        }),
        c
    }), UM.registerUI("paragraph fontfamily fontsize",
    function(a) {
        function b(a, c) {
            var d = $("<span>").html(a).css({
                display: "inline",
                position: "absolute",
                top: -1e7,
                left: -1e5
            }).appendTo(document.body),
            e = d.width();
            return d.remove(),
            d = null,
            50 > e ? a: (a = a.slice(0, c ? -4 : -1), a.length ? b(a + "...", !0) : "...")
        }
        function c(a) {
            var c = [];
            for (var d in a.items) a.value.push(d),
            c.push(d),
            a.autowidthitem.push(b(d));
            return a.items = c,
            a.autoRecord = !1,
            a
        }
        function d(a) {
            for (var c = null,
            d = [], e = 0, f = a.items.length; f > e; e++) c = a.items[e].val,
            d.push(c.split(/\s*,\s*/)[0]),
            a.itemStyles.push("font-family: " + c),
            a.value.push(c),
            a.autowidthitem.push(b(d[e]));
            return a.items = d,
            a
        }
        function e(a) {
            var b = null,
            c = [];
            a.itemStyles = [],
            a.value = [];
            for (var d = 0,
            e = a.items.length; e > d; d++) b = a.items[d],
            c.push(b),
            a.itemStyles.push("font-size: " + b + "px");
            return a.value = a.items,
            a.items = c,
            a.autoRecord = !1,
            a
        }
        var f = this,
        g = f.options.labelMap && f.options.labelMap[a] || f.getLang("labelMap." + a),
        h = {
            label: g,
            title: g,
            comboboxName: a,
            items: f.options[a] || [],
            itemStyles: [],
            value: [],
            autowidthitem: []
        },
        i = null,
        j = null;
        switch (a) {
        case "paragraph":
            h = c(h);
            break;
        case "fontfamily":
            h = d(h);
            break;
        case "fontsize":
            h = e(h)
        }
        return i = $.eduibuttoncombobox(h).css("zIndex", f.getOpt("zIndex") + 1),
        j = i.edui(),
        j.on("comboboxselect",
        function(b, c) {
            f.execCommand(a, c.value)
        }).on("beforeshow",
        function() {
            0 === i.parent().length && i.appendTo(f.$container.find(".edui-dialog-container"))
        }),
        this.addListener("selectionchange",
        function() {
            var b = this.queryCommandState(a),
            c = this.queryCommandValue(a);
            j.button().edui().disabled( - 1 == b).active(1 == b),
            c && (c = c.replace(/['"]/g, "").toLowerCase().split(/['|"]?\s*,\s*[\1]?/), j.selectItemByLabel(c))
        }),
        j.button().addClass("edui-combobox")
    }), UM.registerUI("forecolor backcolor",
    function(a) {
        function b() {
            return j.getComputedStyle(e[0], "background-color")
        }
        var c = this,
        d = null,
        e = null,
        f = null;
        return this.addListener("selectionchange",
        function() {
            var b = this.queryCommandState(a);
            f.edui().disabled( - 1 == b).active(1 == b)
        }),
        f = $.eduicolorsplitbutton({
            icon: a,
            caret: !0,
            name: a,
            title: c.getLang("labelMap")[a],
            click: function() {
                c.execCommand(a, b())
            }
        }),
        e = f.edui().colorLabel(),
        d = $.eduicolorpicker({
            name: a,
            lang_clearColor: c.getLang("clearColor") || "",
            lang_themeColor: c.getLang("themeColor") || "",
            lang_standardColor: c.getLang("standardColor") || ""
        }).on("pickcolor",
        function(b, d) {
            window.setTimeout(function() {
                e.css("backgroundColor", d),
                c.execCommand(a, d)
            },
            0)
        }).on("show",
        function() {
            UM.setActiveWidget(colorPickerWidget.root())
        }).css("zIndex", c.getOpt("zIndex") + 1),
        f.edui().on("arrowclick",
        function() {
            d.parent().length || c.$container.find(".edui-dialog-container").append(d),
            d.edui().show(f, {
                caretDir: "down",
                offsetTop: -5,
                offsetLeft: 8,
                caretLeft: 11,
                caretTop: -8
            })
        }).register("click", f,
        function() {
            d.edui().hide()
        }),
        f
    })
} ();