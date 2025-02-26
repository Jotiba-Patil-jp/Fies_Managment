!function(e) {
    function t(t, r, i) {
        var a = "mbr-background-video-preview";
        function s(t, r) {
            if ("IMG" == t.prop("tagName")) {
                t.attr("src", r);
                var i = t.parents(".app-video-wrapper:eq(0)");
                /no-video/g.test(r) ? i.length && t.unwrap() : i.length || t.wrap('<div class="app-video-wrapper">')
            } else
                $img = t.find("." + a),
                $img.length || ($img = e('<div class="' + a + '">').css({
                    backgroundSize: "cover",
                    backgroundPosition: "center"
                }),
                t.find("> *:eq(0)").before($img)),
                $img.css("background-image", 'url("' + r + '")')
        }
        var o = e(t);
        if (i)
            "IMG" == (n = o).prop("tagName") || n.find("." + a).remove();
        else {
            var n, l = "images/no-video.jpg", c = r.match(/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(shorts\/|video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/);
            if (c && /youtube/g.test(c[3])) {
                var d = e("<img>");
                d.on("load", (function() {
                    if (120 == (this.naturalWidth || this.width)) {
                        var e = this.src.split("/").pop();
                        switch (e) {
                        case "maxresdefault.jpg":
                            this.src = this.src.replace(e, "sddefault.jpg");
                            break;
                        case "sddefault.jpg":
                            this.src = this.src.replace(e, "hqdefault.jpg");
                            break;
                        default:
                            s(o, l),
                            d.remove()
                        }
                    } else
                        s(o, this.src),
                        d.remove()
                }
                )),
                d.attr("src", "http://img.youtube.com/vi/" + c[6] + "/maxresdefault.jpg")
            } else
                c && /vimeo/g.test(c[3]) ? e.ajax({
                    type: "GET",
                    url: "http://vimeo.com/api/v2/video/" + c[6] + ".json",
                    dataType: "json",
                    success: function(e) {
                        s(o, e[0].thumbnail_large)
                    },
                    error: function() {
                        s(o, l)
                    }
                }) : s(o, "images/video-placeholder.jpg")
        }
    }
    rivets.configure({
        prefix: "mbr",
        preloadData: !0,
        rootInterface: ".",
        templateDelimiters: ["{", "}"],
        handler: function(e, t, r) {
            this.call(e, t, r.view.models)
        }
    }),
    rivets.formatters.if = function(e, t) {
        return !!t && e
    }
    ,
    rivets.formatters.unless = function(e, t) {
        return !t && e
    }
    ,
    rivets.formatters.else = function(e, t) {
        return e || t
    }
    ,
    rivets.formatters.pref = function(e, t, r) {
        return void 0 === r && (r = !0),
        (r ? t + "" : "") + e
    }
    ,
    rivets.formatters["!pref"] = function(e, t, r) {
        return void 0 === r && (r = !0),
        ((r = !r) ? t + "" : "") + e
    }
    ,
    rivets.formatters.suff = function(e, t, r) {
        return void 0 === r && (r = !0),
        e + (r ? "" + t : "")
    }
    ,
    rivets.formatters["!suff"] = function(e, t, r) {
        return void 0 === r && (r = !0),
        e + ((r = !r) ? "" + t : "")
    }
    ,
    rivets.formatters.eq = function(e, t) {
        return e == t
    }
    ,
    rivets.formatters.not_eq = function(e, t) {
        return e != t
    }
    ,
    rivets.formatters.gt = function(e, t) {
        return e > t
    }
    ,
    rivets.formatters.gte = function(e, t) {
        return e >= t
    }
    ,
    rivets.formatters.lt = function(e, t) {
        return e < t
    }
    ,
    rivets.formatters.lte = function(e, t) {
        return e <= t
    }
    ,
    rivets.formatters["/"] = function(e, t) {
        return isNaN(Number(e)) || isNaN(Number(t)) ? e : 0 == t ? "infinite" : Number(e) / Number(t)
    }
    ,
    rivets.formatters["*"] = function(e, t) {
        return isNaN(Number(e)) || isNaN(Number(t)) ? e : Number(e) * Number(t)
    }
    ,
    rivets.binders.opacity = function(e, t) {
        e.style.opacity = t
    }
    ,
    rivets.binders["add-class"] = function(t, r) {
        t.addedClass && (e(t).removeClass(t.addedClass),
        delete t.addedClass),
        r && (e(t).addClass(r),
        t.addedClass = r)
    }
    ,
    rivets.binders["bg-image"] = function(e, t) {
        t ? (e.style.backgroundImage = "url('" + t + "')",
        e.style.backgroundColor = "") : e.style.backgroundImage = ""
    }
    ,
    rivets.binders["bg-color"] = function(e, t) {
        t ? (e.style.backgroundColor = t,
        e.style.backgroundImage = "") : e.style.backgroundColor = ""
    }
    ,
    rivets.binders["bg-video"] = function(e, r) {
        e[(r ? "set" : "remove") + "Attribute"]("data-video-src", r),
        this.view.models._checkPublish() || t(e, r && r.url || r, !r)
    }
    ,
    rivets.binders["pure-media"] = function(t, r) {
        for (var i in r) {
            var a = r[i];
            if (a.active && "image" == i) {
                var s = e(t);
                /^img$/i.test(t.tagName) || (t = e(t.outerHTML.replace(/^<[^\s]+/, "<IMG")).get(0),
                s.replaceWith(t),
                s = e(t));
                var o = e(t).parents("a");
                a.link && !o.length && (o = e("<a href='#'>" + t.outerHTML + "</a>"),
                s.replaceWith(o),
                s = o.find("img"),
                o.addClass(s.attr("class")),
                s.attr("class", "")),
                a.class && s.addClass(a.class),
                s.attr("src", a.src),
                s.attr("alt", a.alt),
                s.attr("title", a.title),
                o.attr("href", a.link),
                o.attr("target", a.linkInNewWindow ? "_blank" : "")
            }
        }
    }
    ,
    rivets.binders.media = function r(i, a) {
        if (a) {
            for (var s in a) {
                var o = a[s];
                if (o.active) {
                    if ("image" == s) {
                        var n = '<img src="' + o.src + '"';
                        o.class && (n += ' class="' + o.class + '"'),
                        o.alt && (n += ' alt="' + o.alt + '"'),
                        o.title && (n += ' title="' + o.title + '"'),
                        n += " />",
                        o.link && (n = '<a href="' + o.link + '" ' + (o.linkInNewWindow ? 'target="_blank"' : "") + ">" + n + "</a>"),
                        e(i).html(n)
                    } else if ("video" == s) {
                        var l = e('<img src="images/video-placeholder.jpg" class="mbr-figure__img" alt="">')
                          , c = o.src
                          , d = c.match(/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/)
                          , u = c.includes("nocookie")
                          , v = c.includes("dnt")
                          , m = d ? 11 == d["embed/" == d[2] ? 3 : 2].length : 0
                          , f = c.match(/https?:\/\/(?:www\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|)(\d+)(?:$|\/|\?)/);
                        d && m ? c = "https://www.youtube" + (u ? "-nocookie" : "") + ".com/embed/" + d[2] + "?rel=0&amp;" + (o.autoplay ? "mute=1" : "") + "&showinfo=0&autoplay=" + (o.autoplay ? 1 : 0) + "&loop=" + (o.loop ? "1&playlist=" + d[2] : 0) : f && f[3] && (c = "https://player.vimeo.com/video/" + f[3] + "?autoplay=" + (o.autoplay ? 1 : 0) + "&loop=" + (o.loop ? 1 : 0) + (v ? "dnt=1" : "")),
                        l.attr("data-video-src", c),
                        l.attr("data-video-width", "4:3" == o.aspectratio ? 800 : 1280),
                        l.attr("data-video-height", "4:3" == o.aspectratio ? 600 : 720),
                        l.attr("data-video-aspectratio", o.aspectratio),
                        l.attr("data-video-autoplay", o.autoplay),
                        l.attr("data-video-loop", o.loop),
                        l.attr("class", o.class),
                        e(i).html(l);
                        var p = this.view.models._checkPublish();
                        t(l[0], c, p)
                    } else
                        "iconFont" == s && e(i).html(mbrAppCore.APP.createIconFont(a.iconFont));
                    return
                }
            }
            a.image && "object" == typeof a.image && (a.image.active = !0,
            r.call(this, i, a))
        }
    }
    ,
    rivets.binders.video = function(r, i) {
        if (i) {
            var a = this.view.models._checkPublish();
            e(r).attr("data-data-video-src", i.url),
            e(r).attr("data-app-width", i.width),
            e(r).attr("data-app-height", i.height),
            t(r, i.url, a)
        }
    }
    ,
    rivets.binders["show-if"] = rivets.binders.if,
    rivets.binders["show-unless"] = rivets.binders.unless,
    rivets.binders["show-if"].block = !1,
    rivets.binders["show-unless"].block = !1,
    rivets.binders.if = function(t, r) {
        return e(t)[r ? "removeAttr" : "attr"]("data-app-remove-it", "true"),
        t.style.display = r ? "" : "none"
    }
    ,
    rivets.binders.unless = function(e, t) {
        return rivets.binders.if(e, !t)
    }
    ,
    rivets.binders["content-edit"] = {
        bind: function(t) {
            var r, i = this, a = "";
            this.callback = function(s) {
                clearTimeout(r),
                r = setTimeout((function() {
                    if (!s.isDefaultPrevented()) {
                        if ("delete" !== s.type && s.relatedTarget) {
                            var r = a && e(s.relatedTarget).parents().is(t)
                              , o = e(s.relatedTarget).parents(".note-mbr-link-dialog:eq(0)").length;
                            if (r || o)
                                return
                        }
                        var n = t.innerHTML;
                        a && (n = mbrAppCore.cleanHTMLplease(n, !0)),
                        i.observer.setValue(n),
                        mbrAppCore.fire("rivetsBlur", t)
                    }
                }
                ), 0)
            }
            ,
            (e(t).is('[data-app-edit="buttons"]') || e(t).is('[data-app-edit="menu"]')) && (a = "[data-app-btn]"),
            setTimeout((function() {
                e(t).on("blur.rivets", a, i.callback),
                a && e(t).on("delete.rivets", i.callback)
            }
            ), 0)
        },
        unbind: function(t) {
            e(t).off(".rivets", this.callback)
        }
    }
}(jQuery);
