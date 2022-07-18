if (!dtGlobals) {
    var dtGlobals = {}
}
if (!dtDemostand) {
    var dtDemostand = {}
}
dtGlobals.demostandCookiesSettings = {
    expires: 1,
    path: dtDemostand.cookiePath || '/'
};
(function($, document, undefined) {
    var pluses = /\+/g;

    function raw(s) {
        return s
    }

    function decoded(s) {
        return unRfc2068(decodeURIComponent(s.replace(pluses, ' ')))
    }

    function unRfc2068(value) {
        if (value.indexOf('"') === 0) {
            value = value.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\')
        }
        return value
    }

    function fromJSON(value) {
        return config.json ? JSON.parse(value) : value
    }
    var config = $.cookie = function(key, value, options) {
        if (value !== undefined) {
            options = $.extend({}, config.defaults, options);
            if (value === null) {
                options.expires = -1
            }
            if (typeof options.expires === 'number') {
                var days = options.expires,
                    t = options.expires = new Date();
                t.setDate(t.getDate() + days)
            }
            value = config.json ? JSON.stringify(value) : String(value);
            return (document.cookie = [encodeURIComponent(key), '=', config.raw ? value : encodeURIComponent(value), options.expires ? '; expires=' + options.expires.toUTCString() : '', options.path ? '; path=' + options.path : '', options.domain ? '; domain=' + options.domain : '', options.secure ? '; secure' : ''].join(''))
        }
        var decode = config.raw ? raw : decoded;
        var cookies = document.cookie.split('; ');
        var result = key ? null : {};
        for (var i = 0, l = cookies.length; i < l; i++) {
            var parts = cookies[i].split('=');
            var name = decode(parts.shift());
            var cookie = decode(parts.join('='));
            if (key && key === name) {
                result = fromJSON(cookie);
                break
            }
            if (!key) {
                result[name] = fromJSON(cookie)
            }
        }
        return result
    };
    config.defaults = {};
    $.removeCookie = function(key, options) {
        if ($.cookie(key) !== null) {
            $.cookie(key, null, options);
            return !0
        }
        return !1
    }
})(jQuery, document);
jQuery(function($) {
    if (!dtDemostand.skinURI) {
        return
    }

    function addParameter(url, parameterName, parameterValue, atStart) {
        replaceDuplicates = !0;
        if (url.indexOf('#') == 0) {
            return url
        } else if (url.indexOf('#') > 0) {
            var cl = url.indexOf('#');
            urlhash = url.substring(url.indexOf('#'), url.length)
        } else {
            urlhash = '';
            cl = url.length
        }
        sourceUrl = url.substring(0, cl);
        var urlParts = sourceUrl.split("?");
        var newQueryString = "";
        if (urlParts.length > 1) {
            var parameters = urlParts[1].split("&");
            for (var i = 0;
                (i < parameters.length); i++) {
                var parameterParts = parameters[i].split("=");
                if (!(replaceDuplicates && parameterParts[0] == parameterName)) {
                    if (newQueryString == "")
                        newQueryString = "?";
                    else newQueryString += "&";
                    newQueryString += parameterParts[0] + "=" + (parameterParts[1] ? parameterParts[1] : '')
                }
            }
        }
        if (newQueryString == "")
            newQueryString = "?";
        if (atStart) {
            newQueryString = '?' + parameterName + "=" + parameterValue + (newQueryString.length > 1 ? '&' + newQueryString.substring(1) : '')
        } else {
            if (newQueryString !== "" && newQueryString != '?')
                newQueryString += "&";
            newQueryString += parameterName + "=" + (parameterValue ? parameterValue : '')
        }
        return urlParts[0] + newQueryString + urlhash
    };
    var reloadPage = function(uri) {
        var baseUrl = location.origin + location.pathname;
        var targetUrl = baseUrl;
        if (uri) {
            targetUrl = addParameter(baseUrl, dtDemostand.skinURI.key, dtDemostand.skinURI.value)
        }
        location.assign(targetUrl)
    }
    var constructSkinId = function(href, demo) {
        demo.skin = demo.skin || dtDemostand.skin;
        demo.layout = demo.layout || dtDemostand.layout;
        return addParameter(href, dtDemostand.skinURI.key, encodeURIComponent([demo.skin, demo.layout].join('+')))
    }
    var updatePageLinks = function() {
        var $this = $(this);
        if (this.host === location.host && dtDemostand.skinURI.value) {
            $this.attr('href', addParameter($this.attr('href'), dtDemostand.skinURI.key, dtDemostand.skinURI.value))
        }
    }
    dtDemostand.skin = dtDemostand.skin || 'skin07s';
    dtDemostand.layout = dtDemostand.layout || 'wide';
    var $skins = $(".skins-box .demo-thumb");
    var $layout = $(".layouts-box .demo-thumb");
    $skins.filter("[data-value=" + dtDemostand.skin + "]").addClass('act');
    $layout.filter("[data-value=" + dtDemostand.layout + "]").addClass('act');
    $skins.each(function() {
        var $this = $(this);
        var skin = $this.data('value');
        $this.attr('href', constructSkinId($this.attr('href'), {
            skin: skin
        }))
    });
    $layout.each(function() {
        var $this = $(this);
        var layout = $this.data('value');
        $this.attr('href', constructSkinId($this.attr('href'), {
            layout: layout
        }))
    });
    $('#page a').each(updatePageLinks);
    $(window).on('dt.ajax.content.appended', function() {
        dtGlobals.ajaxContainerItems.find('a').each(updatePageLinks)
    });
    $skins.on("click", function(e) {
        if ('cookie' == dtDemostand.transport) {
            var $this = $(this);
            var value = $this.attr("data-value");
            e.preventDefault();
            $.cookie("skin", value, dtGlobals.demostandCookiesSettings);
            reloadPage()
        }
    });
    $layout.on("click", function(e) {
        if ('cookie' == dtDemostand.transport) {
            var $this = $(this);
            var value = $this.attr("data-value");
            e.preventDefault();
            if ('wide' == val) {
                $("#page").removeClass("boxed");
                $('#phantom .ph-wrap').removeClass("boxed");
                $('body').addClass('no-bg')
            } else if ('boxed' == val) {
                $("#page").addClass("boxed");
                $('#phantom .ph-wrap').addClass("boxed");
                $('body').removeClass('no-bg')
            } else {
                return
            }
            $(window).trigger("resize");
            $.cookie("layout", value, dtGlobals.demostandCookiesSettings);
            reloadPage()
        }
    });
    var $demoPanel = $(".demo-panel"),
        $demoSwitch = $(".demo-switch", $demoPanel),
        $demoOverlay = $(".demo-overlay"),
        $contentPanel = $(".content-panel"),
        $demoTeaser = $(".demo-teaser"),
        $html = $("html"),
        $phantom = $("#phantom");
    var scrollable = document.querySelector('.content-panel');
    // scrollable.addEventListener('wheel', function(event) {
    //     var deltaY = event.deltaY;
    //     var contentHeight = scrollable.scrollHeight;
    //     var visibleHeight = scrollable.offsetHeight;
    //     var scrollTop = scrollable.scrollTop;
    //     if (scrollTop === 0 && deltaY < 0)
    //         event.preventDefault();
    //     else if (visibleHeight + scrollTop === contentHeight && deltaY > 0)
    //         event.preventDefault()
    // });
    var touchStartEvent;
    $contentPanel.on({
        touchstart: function(e) {
            touchStartEvent = e
        },
        touchmove: function(e) {
            if ((e.originalEvent.pageY > touchStartEvent.originalEvent.pageY && this.scrollTop == 0) || (e.originalEvent.pageY < touchStartEvent.originalEvent.pageY && this.scrollTop + this.offsetHeight >= this.scrollHeight))
                e.preventDefault()
        }
    });

    function paintImages() {
        $thumbnails = $(".load-on-click", $demoPanel)
        $thumbnails.each(function(i) {
            var $this = $(this);
            $this.attr("src", $this.attr("data-src"))
        });
        $thumbnails.loaded(function() {
            $(this).parent().addClass("thumb-loaded")
        })
    };
    var imagesTimeout;
    $demoSwitch.one("click.paintImages", function() {
        paintImages()
    });
    $demoSwitch.on("click", function() {
        if (!$demoPanel.hasClass("act")) {
            if (!$.cookie("panel_used")) $.cookie("panel_used", !0, dtGlobals.demostandCookiesSettings);
            $contentPanel.scrollTop(0);
            $demoPanel.css("width", 500).addClass("act");
            $demoTeaser.removeClass("act");
            $demoOverlay.addClass("act")
        } else {
            $demoPanel.css("width", 0).removeClass("act");
            $demoOverlay.removeClass("act")
        };
        return
    });
    $contentPanel.on("mouseenter", function(e) {
        $contentPanel.css("overflow-y", "auto")
    });
    $contentPanel.on("mouseleave", function(e) {
        $contentPanel.css("overflow-y", "hidden")
    });
    $demoTeaser.on("click", function() {
        $demoSwitch.trigger("click")
    });
    $demoOverlay.on("click touchstart", function() {
        $demoSwitch.trigger("click")
    });
    setTimeout(function() {
        if (!$demoPanel.hasClass("act") && !$.cookie("panel_used")) {
            $demoTeaser.addClass("act")
        }
    }, 5000);
    var $skinBox = $(".skins-box"),
        classString = "info-box skins-box",
        $filterLinks = $(".demo-filter a");
    $filterLinks.on("click", function() {
        var $this = $(this),
            filterClass = $this.attr("data-filter");
        $filterLinks.removeClass("act");
        $this.addClass("act");
        $skinBox.attr("class", classString).addClass(filterClass)
    })
})
