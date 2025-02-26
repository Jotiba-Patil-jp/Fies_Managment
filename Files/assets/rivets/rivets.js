(function() {
    var t, e, i, n, r = function(t, e) {
        return function() {
            return t.apply(e, arguments)
        }
    }, s = [].slice, o = {}.hasOwnProperty, u = function(t, e) {
        for (var i in e)
            o.call(e, i) && (t[i] = e[i]);
        function n() {
            this.constructor = t
        }
        return n.prototype = e.prototype,
        t.prototype = new n,
        t.__super__ = e.prototype,
        t
    }, l = [].indexOf || function(t) {
        for (var e = 0, i = this.length; e < i; e++)
            if (e in this && this[e] === t)
                return e;
        return -1
    }
    ;
    t = {
        options: ["prefix", "templateDelimiters", "rootInterface", "preloadData", "handler"],
        extensions: ["binders", "formatters", "components", "adapters"],
        public: {
            binders: {},
            components: {},
            formatters: {},
            adapters: {},
            prefix: "rv",
            templateDelimiters: ["{", "}"],
            rootInterface: ".",
            preloadData: !0,
            handler: function(t, e, i) {
                return this.call(t, e, i.view.models)
            },
            configure: function(e) {
                var i, n, r, s;
                for (r in null == e && (e = {}),
                e)
                    if (s = e[r],
                    "binders" === r || "components" === r || "formatters" === r || "adapters" === r)
                        for (n in s)
                            i = s[n],
                            t[r][n] = i;
                    else
                        t.public[r] = s
            },
            bind: function(e, i, n) {
                var r;
                return null == i && (i = {}),
                null == n && (n = {}),
                (r = new t.View(e,i,n)).bind(),
                r
            },
            init: function(e, i, n) {
                var r, s;
                return null == n && (n = {}),
                null == i && (i = document.createElement("div")),
                e = t.public.components[e],
                i.innerHTML = e.template.call(this, i),
                r = e.initialize.call(this, i, n),
                (s = new t.View(i,r)).bind(),
                s
            }
        }
    },
    window.jQuery || window.$ ? (n = "on"in jQuery.prototype ? ["on", "off"] : ["bind", "unbind"],
    e = n[0],
    i = n[1],
    t.Util = {
        bindEvent: function(t, i, n) {
            return jQuery(t)[e](i, n)
        },
        unbindEvent: function(t, e, n) {
            return jQuery(t)[i](e, n)
        },
        getInputValue: function(t) {
            var e;
            return "checkbox" === (e = jQuery(t)).attr("type") ? e.is(":checked") : e.val()
        }
    }) : t.Util = {
        bindEvent: "addEventListener"in window ? function(t, e, i) {
            return t.addEventListener(e, i, !1)
        }
        : function(t, e, i) {
            return t.attachEvent("on" + e, i)
        }
        ,
        unbindEvent: "removeEventListener"in window ? function(t, e, i) {
            return t.removeEventListener(e, i, !1)
        }
        : function(t, e, i) {
            return t.detachEvent("on" + e, i)
        }
        ,
        getInputValue: function(t) {
            var e, i, n, r;
            if ("checkbox" === t.type)
                return t.checked;
            if ("select-multiple" === t.type) {
                for (r = [],
                i = 0,
                n = t.length; i < n; i++)
                    (e = t[i]).selected && r.push(e.value);
                return r
            }
            return t.value
        }
    },
    t.TypeParser = function() {
        function t() {}
        return t.types = {
            primitive: 0,
            keypath: 1
        },
        t.parse = function(t) {
            return /^'.*'$|^".*"$/.test(t) ? {
                type: this.types.primitive,
                value: t.slice(1, -1)
            } : "true" === t ? {
                type: this.types.primitive,
                value: !0
            } : "false" === t ? {
                type: this.types.primitive,
                value: !1
            } : "null" === t ? {
                type: this.types.primitive,
                value: null
            } : "undefined" === t ? {
                type: this.types.primitive,
                value: void 0
            } : !1 === isNaN(Number(t)) ? {
                type: this.types.primitive,
                value: Number(t)
            } : {
                type: this.types.keypath,
                value: t
            }
        }
        ,
        t
    }(),
    t.TextTemplateParser = function() {
        function t() {}
        return t.types = {
            text: 0,
            binding: 1
        },
        t.parse = function(t, e) {
            var i, n, r, s, o, u, l;
            for (u = [],
            s = t.length,
            i = 0,
            n = 0; n < s; ) {
                if ((i = t.indexOf(e[0], n)) < 0) {
                    u.push({
                        type: this.types.text,
                        value: t.slice(n)
                    });
                    break
                }
                if (i > 0 && n < i && u.push({
                    type: this.types.text,
                    value: t.slice(n, i)
                }),
                n = i + e[0].length,
                (i = t.indexOf(e[1], n)) < 0) {
                    o = t.slice(n - e[1].length),
                    (null != (r = u[u.length - 1]) ? r.type : void 0) === this.types.text ? r.value += o : u.push({
                        type: this.types.text,
                        value: o
                    });
                    break
                }
                l = t.slice(n, i).trim(),
                u.push({
                    type: this.types.binding,
                    value: l
                }),
                n = i + e[1].length
            }
            return u
        }
        ,
        t
    }(),
    t.View = function() {
        function e(e, i, n) {
            var s, o, u, l, h, a, p, d, c, f, b, v, y;
            for (this.els = e,
            this.models = i,
            null == n && (n = {}),
            this.update = r(this.update, this),
            this.publish = r(this.publish, this),
            this.sync = r(this.sync, this),
            this.unbind = r(this.unbind, this),
            this.bind = r(this.bind, this),
            this.select = r(this.select, this),
            this.traverse = r(this.traverse, this),
            this.build = r(this.build, this),
            this.buildBinding = r(this.buildBinding, this),
            this.bindingRegExp = r(this.bindingRegExp, this),
            this.options = r(this.options, this),
            this.els.jquery || this.els instanceof Array || (this.els = [this.els]),
            h = 0,
            p = (c = t.extensions).length; h < p; h++) {
                if (this[o = c[h]] = {},
                n[o])
                    for (s in f = n[o])
                        u = f[s],
                        this[o][s] = u;
                for (s in b = t.public[o])
                    u = b[s],
                    null == (l = this[o])[s] && (l[s] = u)
            }
            for (a = 0,
            d = (v = t.options).length; a < d; a++)
                this[o = v[a]] = null != (y = n[o]) ? y : t.public[o];
            this.build()
        }
        return e.prototype.options = function() {
            var e, i, n, r, s;
            for (i = {},
            n = 0,
            r = (s = t.extensions.concat(t.options)).length; n < r; n++)
                i[e = s[n]] = this[e];
            return i
        }
        ,
        e.prototype.bindingRegExp = function() {
            return new RegExp("^" + this.prefix + "-")
        }
        ,
        e.prototype.buildBinding = function(e, i, n, r) {
            var s, o, u, l, h, a, p;
            return h = {},
            p = function() {
                var t, e, i, n;
                for (n = [],
                t = 0,
                e = (i = r.split("|")).length; t < e; t++)
                    a = i[t],
                    n.push(a.trim());
                return n
            }(),
            l = (s = function() {
                var t, e, i, n;
                for (n = [],
                t = 0,
                e = (i = p.shift().split("<")).length; t < e; t++)
                    o = i[t],
                    n.push(o.trim());
                return n
            }()).shift(),
            h.formatters = p,
            (u = s.shift()) && (h.dependencies = u.split(/\s+/)),
            this.bindings.push(new t[e](this,i,n,l,h))
        }
        ,
        e.prototype.build = function() {
            var e, i, n, r, s, o;
            for (this.bindings = [],
            o = this,
            i = function(e) {
                var n, r, s, u, l, h, a, p, d, c, f, b, v, y;
                if (3 === e.nodeType) {
                    if (l = t.TextTemplateParser,
                    (s = o.templateDelimiters) && (p = l.parse(e.data, s)).length && (1 !== p.length || p[0].type !== l.types.text)) {
                        for (d = 0,
                        f = p.length; d < f; d++)
                            a = p[d],
                            h = document.createTextNode(a.value),
                            e.parentNode.insertBefore(h, e),
                            1 === a.type && o.buildBinding("TextBinding", h, null, a.value);
                        e.parentNode.removeChild(e)
                    }
                } else
                    1 === e.nodeType && (n = o.traverse(e));
                if (!n) {
                    for (v = function() {
                        var t, i, n, r;
                        for (r = [],
                        t = 0,
                        i = (n = e.childNodes).length; t < i; t++)
                            u = n[t],
                            r.push(u);
                        return r
                    }(),
                    y = [],
                    c = 0,
                    b = v.length; c < b; c++)
                        r = v[c],
                        y.push(i(r));
                    return y
                }
            }
            ,
            n = 0,
            r = (s = this.els).length; n < r; n++)
                e = s[n],
                i(e);
            this.bindings.sort((function(t, e) {
                var i, n;
                return ((null != (i = e.binder) ? i.priority : void 0) || 0) - ((null != (n = t.binder) ? n.priority : void 0) || 0)
            }
            ))
        }
        ,
        e.prototype.traverse = function(e) {
            var i, n, r, s, o, u, l, h, a, p, d, c, f, b, v;
            for (s = this.bindingRegExp(),
            o = "SCRIPT" === e.nodeName || "STYLE" === e.nodeName,
            a = 0,
            d = (f = e.attributes).length; a < d; a++)
                if (i = f[a],
                s.test(i.name)) {
                    if (l = i.name.replace(s, ""),
                    !(r = this.binders[l]))
                        for (u in b = this.binders)
                            h = b[u],
                            "*" !== u && -1 !== u.indexOf("*") && new RegExp("^" + u.replace(/\*/g, ".+") + "$").test(l) && (r = h);
                    r || (r = this.binders["*"]),
                    r.block && (o = !0,
                    n = [i])
                }
            for (p = 0,
            c = (v = n || e.attributes).length; p < c; p++)
                i = v[p],
                s.test(i.name) && (l = i.name.replace(s, ""),
                this.buildBinding("Binding", e, l, i.value));
            return o || (l = e.nodeName.toLowerCase(),
            this.components[l] && !e._bound && (this.bindings.push(new t.ComponentBinding(this,e,l)),
            o = !0)),
            o
        }
        ,
        e.prototype.select = function(t) {
            var e, i, n, r, s;
            for (s = [],
            i = 0,
            n = (r = this.bindings).length; i < n; i++)
                t(e = r[i]) && s.push(e);
            return s
        }
        ,
        e.prototype.bind = function() {
            var t, e, i, n, r;
            for (r = [],
            e = 0,
            i = (n = this.bindings).length; e < i; e++)
                t = n[e],
                r.push(t.bind());
            return r
        }
        ,
        e.prototype.unbind = function() {
            var t, e, i, n, r;
            for (r = [],
            e = 0,
            i = (n = this.bindings).length; e < i; e++)
                t = n[e],
                r.push(t.unbind());
            return r
        }
        ,
        e.prototype.sync = function() {
            var t, e, i, n, r;
            for (r = [],
            e = 0,
            i = (n = this.bindings).length; e < i; e++)
                t = n[e],
                r.push("function" == typeof t.sync ? t.sync() : void 0);
            return r
        }
        ,
        e.prototype.publish = function() {
            var t, e, i, n, r;
            for (r = [],
            e = 0,
            i = (n = this.select((function(t) {
                var e;
                return null != (e = t.binder) ? e.publishes : void 0
            }
            ))).length; e < i; e++)
                t = n[e],
                r.push(t.publish());
            return r
        }
        ,
        e.prototype.update = function(t) {
            var e, i, n, r, s, o, u;
            for (i in null == t && (t = {}),
            t)
                n = t[i],
                this.models[i] = n;
            for (u = [],
            r = 0,
            s = (o = this.bindings).length; r < s; r++)
                e = o[r],
                u.push("function" == typeof e.update ? e.update(t) : void 0);
            return u
        }
        ,
        e
    }(),
    t.Binding = function() {
        function e(t, e, i, n, s) {
            this.view = t,
            this.el = e,
            this.type = i,
            this.keypath = n,
            this.options = null != s ? s : {},
            this.getValue = r(this.getValue, this),
            this.update = r(this.update, this),
            this.unbind = r(this.unbind, this),
            this.bind = r(this.bind, this),
            this.publish = r(this.publish, this),
            this.sync = r(this.sync, this),
            this.set = r(this.set, this),
            this.eventHandler = r(this.eventHandler, this),
            this.formattedValue = r(this.formattedValue, this),
            this.parseTarget = r(this.parseTarget, this),
            this.observe = r(this.observe, this),
            this.setBinder = r(this.setBinder, this),
            this.formatters = this.options.formatters || [],
            this.dependencies = [],
            this.formatterObservers = {},
            this.model = void 0,
            this.setBinder()
        }
        return e.prototype.setBinder = function() {
            var t, e, i;
            if (!(this.binder = this.view.binders[this.type]))
                for (t in i = this.view.binders)
                    e = i[t],
                    "*" !== t && -1 !== t.indexOf("*") && new RegExp("^" + t.replace(/\*/g, ".+") + "$").test(this.type) && (this.binder = e,
                    this.args = new RegExp("^" + t.replace(/\*/g, "(.+)") + "$").exec(this.type),
                    this.args.shift());
            if (this.binder || (this.binder = this.view.binders["*"]),
            this.binder instanceof Function)
                return this.binder = {
                    routine: this.binder
                }
        }
        ,
        e.prototype.observe = function(e, i, n) {
            return t.sightglass(e, i, n, {
                root: this.view.rootInterface,
                adapters: this.view.adapters
            })
        }
        ,
        e.prototype.parseTarget = function() {
            var e;
            return 0 === (e = t.TypeParser.parse(this.keypath)).type ? this.value = e.value : (this.observer = this.observe(this.view.models, this.keypath, this.sync),
            this.model = this.observer.target)
        }
        ,
        e.prototype.formattedValue = function(e) {
            var i, n, r, o, u, l, h, a, p, d, c, f, b, v;
            for (o = d = 0,
            f = (v = this.formatters).length; d < f; o = ++d) {
                for (u = v[o],
                l = (r = u.match(/[^\s']+|'([^']|'[^\s])*'|"([^"]|"[^\s])*"/g)).shift(),
                u = this.view.formatters[l],
                r = function() {
                    var e, i, s;
                    for (s = [],
                    e = 0,
                    i = r.length; e < i; e++)
                        n = r[e],
                        s.push(t.TypeParser.parse(n));
                    return s
                }(),
                a = [],
                i = c = 0,
                b = r.length; c < b; i = ++c)
                    n = r[i],
                    a.push(0 === n.type ? n.value : ((p = this.formatterObservers)[o] || (p[o] = {}),
                    (h = this.formatterObservers[o][i]) || (h = this.observe(this.view.models, n.value, this.sync),
                    this.formatterObservers[o][i] = h),
                    h.value()));
                (null != u ? u.read : void 0)instanceof Function ? e = u.read.apply(u, [e].concat(s.call(a))) : u instanceof Function && (e = u.apply(null, [e].concat(s.call(a))))
            }
            return e
        }
        ,
        e.prototype.eventHandler = function(t) {
            var e, i;
            return i = (e = this).view.handler,
            function(n) {
                return i.call(t, this, n, e)
            }
        }
        ,
        e.prototype.set = function(t) {
            var e;
            return t = t instanceof Function && !this.binder.function ? this.formattedValue(t.call(this.model)) : this.formattedValue(t),
            null != (e = this.binder.routine) ? e.call(this, this.el, t) : void 0
        }
        ,
        e.prototype.sync = function() {
            var t, e;
            return this.set(function() {
                var i, n, r, s, o, u, l;
                if (this.observer) {
                    if (this.model !== this.observer.target) {
                        for (i = 0,
                        r = (o = this.dependencies).length; i < r; i++)
                            (e = o[i]).unobserve();
                        if (this.dependencies = [],
                        null != (this.model = this.observer.target) && (null != (u = this.options.dependencies) ? u.length : void 0))
                            for (n = 0,
                            s = (l = this.options.dependencies).length; n < s; n++)
                                t = l[n],
                                e = this.observe(this.model, t, this.sync),
                                this.dependencies.push(e)
                    }
                    return this.observer.value()
                }
                return this.value
            }
            .call(this))
        }
        ,
        e.prototype.publish = function() {
            var t, e, i, n, r, o, u, l;
            if (this.observer) {
                for (i = this.getValue(this.el),
                n = 0,
                r = (o = this.formatters.slice(0).reverse()).length; n < r; n++)
                    e = (t = o[n].split(/\s+/)).shift(),
                    (null != (u = this.view.formatters[e]) ? u.publish : void 0) && (i = (l = this.view.formatters[e]).publish.apply(l, [i].concat(s.call(t))));
                return this.observer.setValue(i)
            }
        }
        ,
        e.prototype.bind = function() {
            var t, e, i, n, r, s, o;
            if (this.parseTarget(),
            null != (r = this.binder.bind) && r.call(this, this.el),
            null != this.model && (null != (s = this.options.dependencies) ? s.length : void 0))
                for (i = 0,
                n = (o = this.options.dependencies).length; i < n; i++)
                    t = o[i],
                    e = this.observe(this.model, t, this.sync),
                    this.dependencies.push(e);
            if (this.view.preloadData)
                return this.sync()
        }
        ,
        e.prototype.unbind = function() {
            var t, e, i, n, r, s, o, u, l;
            for (null != (s = this.binder.unbind) && s.call(this, this.el),
            null != (o = this.observer) && o.unobserve(),
            n = 0,
            r = (u = this.dependencies).length; n < r; n++)
                u[n].unobserve();
            for (i in this.dependencies = [],
            l = this.formatterObservers)
                for (t in e = l[i])
                    e[t].unobserve();
            return this.formatterObservers = {}
        }
        ,
        e.prototype.update = function(t) {
            var e, i;
            return null == t && (t = {}),
            this.model = null != (e = this.observer) ? e.target : void 0,
            null != (i = this.binder.update) ? i.call(this, t) : void 0
        }
        ,
        e.prototype.getValue = function(e) {
            return this.binder && null != this.binder.getValue ? this.binder.getValue.call(this, e) : t.Util.getInputValue(e)
        }
        ,
        e
    }(),
    t.ComponentBinding = function(e) {
        function i(t, e, i) {
            var n, s, o, u, h, a, p;
            for (this.view = t,
            this.el = e,
            this.type = i,
            this.unbind = r(this.unbind, this),
            this.bind = r(this.bind, this),
            this.locals = r(this.locals, this),
            this.component = this.view.components[this.type],
            this.static = {},
            this.observers = {},
            this.upstreamObservers = {},
            s = t.bindingRegExp(),
            u = 0,
            h = (a = this.el.attributes || []).length; u < h; u++)
                n = a[u],
                s.test(n.name) || (o = this.camelCase(n.name),
                l.call(null != (p = this.component.static) ? p : [], o) >= 0 ? this.static[o] = n.value : this.observers[o] = n.value)
        }
        return u(i, e),
        i.prototype.sync = function() {}
        ,
        i.prototype.update = function() {}
        ,
        i.prototype.publish = function() {}
        ,
        i.prototype.locals = function() {
            var t, e, i, n, r, s;
            for (t in i = {},
            r = this.static)
                n = r[t],
                i[t] = n;
            for (t in s = this.observers)
                e = s[t],
                i[t] = e.value();
            return i
        }
        ,
        i.prototype.camelCase = function(t) {
            return t.replace(/-([a-z])/g, (function(t) {
                return t[1].toUpperCase()
            }
            ))
        }
        ,
        i.prototype.bind = function() {
            var e, i, n, r, s, o, u, l, h, a, p, d, c, f, b, v, y, g, m, w, k;
            if (!this.bound) {
                for (i in f = this.observers)
                    n = f[i],
                    this.observers[i] = this.observe(this.view.models, n, function(t) {
                        return function(e) {
                            return function() {
                                return t.componentView.models[e] = t.observers[e].value()
                            }
                        }
                    }(this).call(this, i));
                this.bound = !0
            }
            if (null != this.componentView)
                return this.componentView.bind();
            for ($(this.el).html("").append(this.component.template.call(this, this.locals())),
            u = this.component.initialize.call(this, this.el, this.locals()),
            this.el._bound = !0,
            o = {},
            a = 0,
            d = (b = t.extensions).length; a < d; a++) {
                if (o[s = b[a]] = {},
                this.component[s])
                    for (e in v = this.component[s])
                        l = v[e],
                        o[s][e] = l;
                for (e in y = this.view[s])
                    l = y[e],
                    null == (h = o[s])[e] && (h[e] = l)
            }
            for (p = 0,
            c = (g = t.options).length; p < c; p++)
                o[s = g[p]] = null != (m = this.component[s]) ? m : this.view[s];
            for (i in this.componentView = new t.View(this.el,u,o),
            this.componentView.bind(),
            k = [],
            w = this.observers)
                r = w[i],
                k.push(this.upstreamObservers[i] = this.observe(this.componentView.models, i, function(t) {
                    return function(e, i) {
                        return function() {
                            return i.setValue(t.componentView.models[e])
                        }
                    }
                }(this).call(this, i, r)));
            return k
        }
        ,
        i.prototype.unbind = function() {
            var t, e, i, n;
            for (t in e = this.upstreamObservers)
                e[t].unobserve();
            for (t in i = this.observers)
                i[t].unobserve();
            return null != (n = this.componentView) ? n.unbind.call(this) : void 0
        }
        ,
        i
    }(t.Binding),
    t.TextBinding = function(t) {
        function e(t, e, i, n, s) {
            this.view = t,
            this.el = e,
            this.type = i,
            this.keypath = n,
            this.options = null != s ? s : {},
            this.sync = r(this.sync, this),
            this.formatters = this.options.formatters || [],
            this.dependencies = [],
            this.formatterObservers = {}
        }
        return u(e, t),
        e.prototype.binder = {
            routine: function(t, e) {
                return t.data = null != e ? e : ""
            }
        },
        e.prototype.sync = function() {
            return e.__super__.sync.apply(this, arguments)
        }
        ,
        e
    }(t.Binding),
    t.public.binders.text = function(t, e) {
        return null != t.textContent ? t.textContent = null != e ? e : "" : t.innerText = null != e ? e : ""
    }
    ,
    t.public.binders.html = function(t, e) {
        return t.innerHTML = null != e ? e : ""
    }
    ,
    t.public.binders.show = function(t, e) {
        return t.style.display = e ? "" : "none"
    }
    ,
    t.public.binders.hide = function(t, e) {
        return t.style.display = e ? "none" : ""
    }
    ,
    t.public.binders.enabled = function(t, e) {
        return t.disabled = !e
    }
    ,
    t.public.binders.disabled = function(t, e) {
        return t.disabled = !!e
    }
    ,
    t.public.binders.checked = {
        publishes: !0,
        priority: 2e3,
        bind: function(e) {
            return t.Util.bindEvent(e, "change", this.publish)
        },
        unbind: function(e) {
            return t.Util.unbindEvent(e, "change", this.publish)
        },
        routine: function(t, e) {
            var i;
            return "radio" === t.type ? t.checked = (null != (i = t.value) ? i.toString() : void 0) === (null != e ? e.toString() : void 0) : t.checked = !!e
        }
    },
    t.public.binders.unchecked = {
        publishes: !0,
        priority: 2e3,
        bind: function(e) {
            return t.Util.bindEvent(e, "change", this.publish)
        },
        unbind: function(e) {
            return t.Util.unbindEvent(e, "change", this.publish)
        },
        routine: function(t, e) {
            var i;
            return "radio" === t.type ? t.checked = (null != (i = t.value) ? i.toString() : void 0) !== (null != e ? e.toString() : void 0) : t.checked = !e
        }
    },
    t.public.binders.value = {
        publishes: !0,
        priority: 3e3,
        bind: function(e) {
            if ("INPUT" !== e.tagName || "radio" !== e.type)
                return this.event = "SELECT" === e.tagName ? "change" : "input",
                t.Util.bindEvent(e, this.event, this.publish)
        },
        unbind: function(e) {
            if ("INPUT" !== e.tagName || "radio" !== e.type)
                return t.Util.unbindEvent(e, this.event, this.publish)
        },
        routine: function(t, e) {
            var i, n, r, s, o, u, h;
            if ("INPUT" === t.tagName && "radio" === t.type)
                return t.setAttribute("value", e);
            if (null != window.jQuery) {
                if (t = jQuery(t),
                (null != e ? e.toString() : void 0) !== (null != (s = t.val()) ? s.toString() : void 0))
                    return t.val(null != e ? e : "")
            } else if ("select-multiple" === t.type) {
                if (null != e) {
                    for (h = [],
                    n = 0,
                    r = t.length; n < r; n++)
                        i = t[n],
                        h.push(i.selected = (o = i.value,
                        l.call(e, o) >= 0));
                    return h
                }
            } else if ((null != e ? e.toString() : void 0) !== (null != (u = t.value) ? u.toString() : void 0))
                return t.value = null != e ? e : ""
        }
    },
    t.public.binders.if = {
        block: !0,
        priority: 4e3,
        bind: function(t) {
            var e, i;
            if (null == this.marker)
                return e = [this.view.prefix, this.type].join("-").replace("--", "-"),
                i = t.getAttribute(e),
                this.marker = document.createComment(" rivets: " + this.type + " " + i + " "),
                this.bound = !1,
                t.removeAttribute(e),
                t.parentNode ? (t.parentNode.insertBefore(this.marker, t),
                t.parentNode.removeChild(t)) : t
        },
        unbind: function() {
            var t;
            return null != (t = this.nested) ? t.unbind() : void 0
        },
        routine: function(e, i) {
            var n, r, s, o;
            if (!!i == !this.bound) {
                if (i) {
                    for (n in s = {},
                    o = this.view.models)
                        r = o[n],
                        s[n] = r;
                    return (this.nested || (this.nested = new t.View(e,s,this.view.options()))).bind(),
                    this.marker.parentNode.insertBefore(e, this.marker.nextSibling),
                    this.bound = !0
                }
                return e.parentNode && e.parentNode.removeChild(e),
                this.nested.unbind(),
                this.bound = !1
            }
        },
        update: function(t) {
            var e;
            return null != (e = this.nested) ? e.update(t) : void 0
        }
    },
    t.public.binders.unless = {
        block: !0,
        priority: 4e3,
        bind: function(e) {
            return t.public.binders.if.bind.call(this, e)
        },
        unbind: function() {
            return t.public.binders.if.unbind.call(this)
        },
        routine: function(e, i) {
            return t.public.binders.if.routine.call(this, e, !i)
        },
        update: function(e) {
            return t.public.binders.if.update.call(this, e)
        }
    },
    t.public.binders["on-*"] = {
        function: !0,
        priority: 1e3,
        unbind: function(e) {
            if (this.handler)
                return t.Util.unbindEvent(e, this.args[0], this.handler)
        },
        routine: function(e, i) {
            return this.handler && t.Util.unbindEvent(e, this.args[0], this.handler),
            t.Util.bindEvent(e, this.args[0], this.handler = this.eventHandler(i))
        }
    },
    t.public.binders["each-*"] = {
        block: !0,
        priority: 4e3,
        bind: function(t) {
            var e, i, n, r;
            if (null == this.marker)
                e = [this.view.prefix, this.type].join("-").replace("--", "-"),
                this.marker = document.createComment(" rivets: " + this.type + " "),
                this.iterated = [],
                t.removeAttribute(e),
                t.parentNode.insertBefore(this.marker, t),
                t.parentNode.removeChild(t);
            else
                for (i = 0,
                n = (r = this.iterated).length; i < n; i++)
                    r[i].bind()
        },
        unbind: function(t) {
            var e, i, n, r, s;
            if (null != this.iterated) {
                for (s = [],
                i = 0,
                n = (r = this.iterated).length; i < n; i++)
                    e = r[i],
                    s.push(e.unbind());
                return s
            }
        },
        routine: function(e, i) {
            var n, r, s, o, u, l, h, a, p, d, c, f, b, v, y, g, m, w, k, x;
            if (l = this.args[0],
            i = i || [],
            this.iterated.length > i.length)
                for (c = 0,
                v = (m = Array(this.iterated.length - i.length)).length; c < v; c++)
                    m[c],
                    (d = this.iterated.pop()).unbind(),
                    this.marker.parentNode.removeChild(d.els[0]);
            for (s = f = 0,
            y = i.length; f < y; s = ++f)
                if (u = i[s],
                (r = {
                    index: s
                })[l] = u,
                null == this.iterated[s]) {
                    for (o in w = this.view.models)
                        u = w[o],
                        null == r[o] && (r[o] = u);
                    a = this.iterated.length ? this.iterated[this.iterated.length - 1].els[0] : this.marker,
                    (h = this.view.options()).preloadData = !0,
                    p = e.cloneNode(!0),
                    (d = new t.View(p,r,h)).bind(),
                    this.iterated.push(d),
                    this.marker.parentNode.insertBefore(p, a.nextSibling)
                } else
                    this.iterated[s].models[l] !== u && this.iterated[s].update(r);
            if ("OPTION" === e.nodeName) {
                for (x = [],
                b = 0,
                g = (k = this.view.bindings).length; b < g; b++)
                    (n = k[b]).el === this.marker.parentNode && "value" === n.type ? x.push(n.sync()) : x.push(void 0);
                return x
            }
        },
        update: function(t) {
            var e, i, n, r, s, o, u, l;
            for (i in e = {},
            t)
                n = t[i],
                i !== this.args[0] && (e[i] = n);
            for (l = [],
            s = 0,
            o = (u = this.iterated).length; s < o; s++)
                r = u[s],
                l.push(r.update(e));
            return l
        }
    },
    t.public.binders["class-*"] = function(t, e) {
        var i;
        if (!e == (-1 !== (i = " " + t.className + " ").indexOf(" " + this.args[0] + " ")))
            return t.className = e ? t.className + " " + this.args[0] : i.replace(" " + this.args[0] + " ", " ").trim()
    }
    ,
    t.public.binders["*"] = function(t, e) {
        return null != e ? t.setAttribute(this.type, e) : t.removeAttribute(this.type)
    }
    ,
    t.public.adapters["."] = {
        id: "_rv",
        counter: 0,
        weakmap: {},
        weakReference: function(t) {
            var e, i, n;
            return t.hasOwnProperty(this.id) || (e = this.counter++,
            Object.defineProperty(t, this.id, {
                value: e,
                configurable: !0
            })),
            (i = this.weakmap)[n = t[this.id]] || (i[n] = {
                callbacks: {}
            })
        },
        cleanupWeakReference: function(t, e) {
            if (!(Object.keys(t.callbacks).length || t.pointers && Object.keys(t.pointers).length))
                return delete this.weakmap[e]
        },
        stubFunction: function(t, e) {
            var i, n, r;
            return n = t[e],
            i = this.weakReference(t),
            r = this.weakmap,
            t[e] = function() {
                var e, s, o, u, l, h, a, p, d;
                for (s in o = n.apply(t, arguments),
                h = i.pointers)
                    for (e = h[s],
                    u = 0,
                    l = (d = null != (a = null != (p = r[s]) ? p.callbacks[e] : void 0) ? a : []).length; u < l; u++)
                        (0,
                        d[u])();
                return o
            }
        },
        observeMutations: function(t, e, i) {
            var n, r, s, o, u, h;
            if (Array.isArray(t)) {
                if (null == (s = this.weakReference(t)).pointers)
                    for (s.pointers = {},
                    u = 0,
                    h = (r = ["push", "pop", "shift", "unshift", "sort", "reverse", "splice"]).length; u < h; u++)
                        n = r[u],
                        this.stubFunction(t, n);
                if (null == (o = s.pointers)[e] && (o[e] = []),
                l.call(s.pointers[e], i) < 0)
                    return s.pointers[e].push(i)
            }
        },
        unobserveMutations: function(t, e, i) {
            var n, r, s;
            if (Array.isArray(t) && null != t[this.id] && (r = this.weakmap[t[this.id]]) && (s = r.pointers[e]))
                return (n = s.indexOf(i)) >= 0 && s.splice(n, 1),
                s.length || delete r.pointers[e],
                this.cleanupWeakReference(r, t[this.id])
        },
        observe: function(t, e, i) {
            var n, r, s, o;
            return null == (n = this.weakReference(t).callbacks)[e] && (n[e] = [],
            (null != (r = Object.getOwnPropertyDescriptor(t, e)) ? r.get : void 0) || (null != r ? r.set : void 0) || (s = t[e],
            Object.defineProperty(t, e, {
                configurable: !0,
                enumerable: !0,
                get: function() {
                    return s
                },
                set: (o = this,
                function(r) {
                    var u, h, a, p;
                    if (r !== s && (o.unobserveMutations(s, t[o.id], e),
                    s = r,
                    u = o.weakmap[t[o.id]])) {
                        if ((n = u.callbacks)[e])
                            for (h = 0,
                            a = (p = n[e].slice()).length; h < a; h++)
                                i = p[h],
                                l.call(n[e], i) >= 0 && i();
                        return o.observeMutations(r, t[o.id], e)
                    }
                }
                )
            }))),
            l.call(n[e], i) < 0 && n[e].push(i),
            this.observeMutations(t[e], t[this.id], e)
        },
        unobserve: function(t, e, i) {
            var n, r, s;
            if ((s = this.weakmap[t[this.id]]) && (n = s.callbacks[e]))
                return (r = n.indexOf(i)) >= 0 && (n.splice(r, 1),
                n.length || delete s.callbacks[e]),
                this.unobserveMutations(t[e], t[this.id], e),
                this.cleanupWeakReference(s, t[this.id])
        },
        get: function(t, e) {
            return t[e]
        },
        set: function(t, e, i) {
            return t[e] = i
        }
    },
    t.factory = function(e) {
        return t.sightglass = e,
        t.public._ = t,
        t.public
    }
    ,
    "object" == typeof ("undefined" != typeof module && null !== module ? module.exports : void 0) ? module.exports = t.factory(require("sightglass")) : "function" == typeof define && define.amd ? define(["sightglass"], (function(e) {
        return this.rivets = t.factory(e)
    }
    )) : this.rivets = t.factory(sightglass)
}
).call(this);
