;(function () {
  function t (t, s, i, a) {
    return new e(t, s, i, a)
  }
  function e (t, e, i, a) {
    ;(this.options = a || {}),
      (this.options.adapters = this.options.adapters || {}),
      (this.obj = t),
      (this.keypath = e),
      (this.callback = i),
      (this.objectPath = []),
      this.parse(),
      (this.updateCallback = this.update.bind(this)),
      s((this.target = this.realize())) &&
        this.set(!0, this.key, this.target, this.callback)
  }
  function s (t) {
    return 'object' == typeof t && null !== t
  }
  function i (t) {
    throw new Error('[sightglass] ' + t)
  }
  ;(t.adapters = {}),
    (e.tokenize = function (t, e, s) {
      var i,
        a,
        h = [],
        o = {
          i: s,
          path: ''
        }
      for (i = 0; i < t.length; i++)
        (a = t.charAt(i)),
          ~e.indexOf(a)
            ? (h.push(o),
              (o = {
                i: a,
                path: ''
              }))
            : (o.path += a)
      return h.push(o), h
    }),
    (e.prototype.parse = function () {
      var s,
        a,
        h = this.interfaces()
      h.length || i('Must define at least one adapter interface.'),
        ~h.indexOf(this.keypath[0])
          ? ((s = this.keypath[0]), (a = this.keypath.substr(1)))
          : (void 0 === (s = this.options.root || t.root) &&
              i('Must define a default root adapter.'),
            (a = this.keypath)),
        (this.tokens = e.tokenize(a, h, s)),
        (this.key = this.tokens.pop())
    }),
    (e.prototype.realize = function () {
      var t,
        e = this.obj,
        i = !1
      return (
        this.tokens.forEach(function (a, h) {
          s(e)
            ? (void 0 !== this.objectPath[h]
                ? e !== (t = this.objectPath[h]) &&
                  (this.set(!1, a, t, this.updateCallback),
                  this.set(!0, a, e, this.updateCallback),
                  (this.objectPath[h] = e))
                : (this.set(!0, a, e, this.updateCallback),
                  (this.objectPath[h] = e)),
              (e = this.get(a, e)))
            : (!1 === i && (i = h),
              (t = this.objectPath[h]) &&
                this.set(!1, a, t, this.updateCallback))
        }, this),
        !1 !== i && this.objectPath.splice(i),
        e
      )
    }),
    (e.prototype.update = function () {
      var t, e
      ;(t = this.realize()) !== this.target &&
        (s(this.target) && this.set(!1, this.key, this.target, this.callback),
        s(t) && this.set(!0, this.key, t, this.callback),
        (e = this.value()),
        (this.target = t),
        this.value() !== e && this.callback())
    }),
    (e.prototype.value = function () {
      if (s(this.target)) return this.get(this.key, this.target)
    }),
    (e.prototype.setValue = function (t) {
      s(this.target) &&
        this.adapter(this.key).set(this.target, this.key.path, t)
    }),
    (e.prototype.get = function (t, e) {
      return this.adapter(t).get(e, t.path)
    }),
    (e.prototype.set = function (t, e, s, i) {
      var a = t ? 'observe' : 'unobserve'
      this.adapter(e)[a](s, e.path, i)
    }),
    (e.prototype.interfaces = function () {
      var e = Object.keys(this.options.adapters)
      return (
        Object.keys(t.adapters).forEach(function (t) {
          ~e.indexOf(t) || e.push(t)
        }),
        e
      )
    }),
    (e.prototype.adapter = function (e) {
      return this.options.adapters[e.i] || t.adapters[e.i]
    }),
    (e.prototype.unobserve = function () {
      var t
      this.tokens.forEach(function (e, s) {
        ;(t = this.objectPath[s]) && this.set(!1, e, t, this.updateCallback)
      }, this),
        s(this.target) && this.set(!1, this.key, this.target, this.callback)
    }),
    'undefined' != typeof module && module.exports
      ? (module.exports = t)
      : 'function' == typeof define && define.amd
      ? define([], function () {
          return (this.sightglass = t)
        })
      : (this.sightglass = t)
}.call(this))
