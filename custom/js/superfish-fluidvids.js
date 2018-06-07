/*
 *  jQuery Superfish menu
 */
(function ($) {
    $.fn.superfish = function (op) {
        var sf = $.fn.superfish, c = sf.c, $arrow = $(['<span class="', c.arrowClass, '"> &#187;</span>'].join('')), over = function () {
            var $$ = $(this), menu = getMenu($$);
            clearTimeout(menu.sfTimer);
            $$.showSuperfishUl().siblings().hideSuperfishUl();
        }, out = function () {
            var $$ = $(this), menu = getMenu($$), o = sf.op;
            clearTimeout(menu.sfTimer);
            menu.sfTimer = setTimeout(function () {
                o.retainPath = ($.inArray($$[0], o.$path) > -1);
                $$.hideSuperfishUl();
                if (o.$path.length && $$.parents(['li.', o.hoverClass].join('')).length < 1) {
                    over.call(o.$path);
                }
            }, o.delay);
        }, getMenu = function ($menu) {
            var menu = $menu.parents(['ul.', c.menuClass, ':first'].join(''))[0];
            sf.op = sf.o[menu.serial];
            return menu;
        }, addArrow = function ($a) {
            $a.addClass(c.anchorClass).append($arrow.clone());
        };
        return this.each(function () {
            var s = this.serial = sf.o.length;
            var o = $.extend({}, sf.defaults, op);
            o.$path = $('li.' + o.pathClass, this).slice(0, o.pathLevels).each(function () {
                $(this).addClass([o.hoverClass, c.bcClass].join(' ')).filter('li:has(ul)').removeClass(o.pathClass);
            });
            sf.o[s] = sf.op = o;
            $('li:has(ul)', this)[($.fn.hoverIntent && !o.disableHI) ? 'hoverIntent' : 'hover'](over, out).each(function () {
                if (o.autoArrows)addArrow($('>a:first-child', this));
            }).not('.' + c.bcClass).hideSuperfishUl();
            var $a = $('a', this);
            $a.each(function (i) {
                var $li = $a.eq(i).parents('li');
                $a.eq(i).focus(function () {
                    over.call($li);
                }).blur(function () {
                    out.call($li);
                });
            });
            o.onInit.call(this);
        }).each(function () {
            var menuClasses = [c.menuClass];
            if (sf.op.dropShadows && !($.browser.msie && $.browser.version < 7))menuClasses.push(c.shadowClass);
            $(this).addClass(menuClasses.join(' '));
        });
    };
    var sf = $.fn.superfish;
    sf.o = [];
    sf.op = {};
    sf.IE7fix = function () {
        var o = sf.op;
        if ($.browser.msie && $.browser.version > 6 && o.dropShadows && o.animation.opacity != undefined)
            this.toggleClass(sf.c.shadowClass + '-off');
    };
    sf.c = {
        bcClass: 'sf-breadcrumb',
        menuClass: 'sf-js-enabled',
        anchorClass: 'sf-with-ul',
        arrowClass: 'sf-sub-indicator',
        shadowClass: 'sf-shadow'
    };
    sf.defaults = {
        hoverClass: 'sfHover',
        pathClass: 'overideThisToUse',
        pathLevels: 1,
        delay: 800,
        animation: {opacity: 'show'},
        speed: 'normal',
        autoArrows: true,
        dropShadows: true,
        disableHI: false,
        onInit: function () {
        },
        onBeforeShow: function () {
        },
        onShow: function () {
        },
        onHide: function () {
        }
    };
    $.fn.extend({
        hideSuperfishUl: function () {
            var o = sf.op, not = (o.retainPath === true) ? o.$path : '';
            o.retainPath = false;
            var $ul = $(['li.', o.hoverClass].join(''), this).add(this).not(not).removeClass(o.hoverClass).find('>ul').hide().css('visibility', 'hidden');
            o.onHide.call($ul);
            return this;
        }, showSuperfishUl: function () {
            var o = sf.op, sh = sf.c.shadowClass + '-off', $ul = this.addClass(o.hoverClass).find('>ul:hidden').css('visibility', 'visible');
            sf.IE7fix.call($ul);
            o.onBeforeShow.call($ul);
            $ul.animate(o.animation, o.speed, function () {
                sf.IE7fix.call($ul);
                o.onShow.call($ul);
            });
            return this;
        }
    });
})(jQuery);


/*!
 *  FluidVids.js v2.1.0
 *  Responsive and fluid YouTube/Vimeo video embeds.
 *  Project: https://github.com/toddmotto/fluidvids
 *  by Todd Motto: http://toddmotto.com
 *
 *  Copyright 2013 Todd Motto. MIT licensed.
 */
window.Fluidvids = function (a, b) {
    "use strict";
    var c, d, e = b.head || b.getElementsByTagName("head")[0], f = ".fluidvids-elem{position:absolute;top:0px;left:0px;width:100%;height:100%;}.fluidvids{width:100%;position:relative;}", g = function (a) {
        return c = new RegExp("^(https?:)?//(?:" + d.join("|") + ").*$", "i"), c.test(a)
    }, h = function (a) {
        var c = b.createElement("div"), d = a.parentNode, e = 100 * (parseInt(a.height ? a.height : a.offsetHeight, 10) / parseInt(a.width ? a.width : a.offsetWidth, 10));
        d.insertBefore(c, a), a.className += " fluidvids-elem", c.className += " fluidvids", c.style.paddingTop = e + "%", c.appendChild(a)
    }, i = function () {
        var a = b.createElement("div");
        a.innerHTML = "<p>x</p><style>" + f + "</style>", e.appendChild(a.childNodes[1])
    }, j = function (a) {
        var c = a || {}, e = c.selector || "iframe";
        d = c.players || ["www.youtube.com", "player.vimeo.com"];
        for (var f = b.querySelectorAll(e), j = 0; j < f.length; j++) {
            var k = f[j];
            g(k.src) && h(k)
        }
        i()
    };
    return {init: j}
}(window, document);