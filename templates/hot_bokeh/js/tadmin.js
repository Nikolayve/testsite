/*------------------------------------------------------------------------
# "Sparky Framework" - Joomla Template Framework
# Copyright (C) 2013 HotThemes. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotThemes
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/
$ = jQuery;



if(!jQuery.fn.tooltip){
	//jQuery.fn.tooltip = function(){};
	!function(e){"use strict";e(function(){e.support.transition=function(){var e=function(){var e=document.createElement("bootstrap"),t={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"},n;for(n in t)if(e.style[n]!==undefined)return t[n]}();return e&&{end:e}}()})}(window.jQuery),!function(e){"use strict";var t='[data-dismiss="alert"]',n=function(n){e(n).on("click",t,this.close)};n.prototype.close=function(t){function s(){i.trigger("closed").remove()}var n=e(this),r=n.attr("data-target"),i;r||(r=n.attr("href"),r=r&&r.replace(/.*(?=#[^\s]*$)/,"")),i=e(r),t&&t.preventDefault(),i.length||(i=n.hasClass("alert")?n:n.parent()),i.trigger(t=e.Event("close"));if(t.isDefaultPrevented())return;i.removeClass("in"),e.support.transition&&i.hasClass("fade")?i.on(e.support.transition.end,s):s()};var r=e.fn.alert;e.fn.alert=function(t){return this.each(function(){var r=e(this),i=r.data("alert");i||r.data("alert",i=new n(this)),typeof t=="string"&&i[t].call(r)})},e.fn.alert.Constructor=n,e.fn.alert.noConflict=function(){return e.fn.alert=r,this},e(document).on("click.alert.data-api",t,n.prototype.close)}(window.jQuery),!function(e){"use strict";var t=function(t,n){this.$element=e(t),this.options=e.extend({},e.fn.button.defaults,n)};t.prototype.setState=function(e){var t="disabled",n=this.$element,r=n.data(),i=n.is("input")?"val":"html";e+="Text",r.resetText||n.data("resetText",n[i]()),n[i](r[e]||this.options[e]),setTimeout(function(){e=="loadingText"?n.addClass(t).attr(t,t):n.removeClass(t).removeAttr(t)},0)},t.prototype.toggle=function(){var e=this.$element.closest('[data-toggle="buttons-radio"]');e&&e.find(".active").removeClass("active"),this.$element.toggleClass("active")};var n=e.fn.button;e.fn.button=function(n){return this.each(function(){var r=e(this),i=r.data("button"),s=typeof n=="object"&&n;i||r.data("button",i=new t(this,s)),n=="toggle"?i.toggle():n&&i.setState(n)})},e.fn.button.defaults={loadingText:"loading..."},e.fn.button.Constructor=t,e.fn.button.noConflict=function(){return e.fn.button=n,this},e(document).on("click.button.data-api","[data-toggle^=button]",function(t){var n=e(t.target);n.hasClass("btn")||(n=n.closest(".btn")),n.button("toggle")})}(window.jQuery),!function(e){"use strict";var t=function(t,n){this.$element=e(t),this.$indicators=this.$element.find(".carousel-indicators"),this.options=n,this.options.pause=="hover"&&this.$element.on("mouseenter",e.proxy(this.pause,this)).on("mouseleave",e.proxy(this.cycle,this))};t.prototype={cycle:function(t){return t||(this.paused=!1),this.interval&&clearInterval(this.interval),this.options.interval&&!this.paused&&(this.interval=setInterval(e.proxy(this.next,this),this.options.interval)),this},getActiveIndex:function(){return this.$active=this.$element.find(".item.active"),this.$items=this.$active.parent().children(),this.$items.index(this.$active)},to:function(t){var n=this.getActiveIndex(),r=this;if(t>this.$items.length-1||t<0)return;return this.sliding?this.$element.one("slid",function(){r.to(t)}):n==t?this.pause().cycle():this.slide(t>n?"next":"prev",e(this.$items[t]))},pause:function(t){return t||(this.paused=!0),this.$element.find(".next, .prev").length&&e.support.transition.end&&(this.$element.trigger(e.support.transition.end),this.cycle(!0)),clearInterval(this.interval),this.interval=null,this},next:function(){if(this.sliding)return;return this.slide("next")},prev:function(){if(this.sliding)return;return this.slide("prev")},slide:function(t,n){var r=this.$element.find(".item.active"),i=n||r[t](),s=this.interval,o=t=="next"?"left":"right",u=t=="next"?"first":"last",a=this,f;this.sliding=!0,s&&this.pause(),i=i.length?i:this.$element.find(".item")[u](),f=e.Event("slide",{relatedTarget:i[0],direction:o});if(i.hasClass("active"))return;this.$indicators.length&&(this.$indicators.find(".active").removeClass("active"),this.$element.one("slid",function(){var t=e(a.$indicators.children()[a.getActiveIndex()]);t&&t.addClass("active")}));if(e.support.transition&&this.$element.hasClass("slide")){this.$element.trigger(f);if(f.isDefaultPrevented())return;i.addClass(t),i[0].offsetWidth,r.addClass(o),i.addClass(o),this.$element.one(e.support.transition.end,function(){i.removeClass([t,o].join(" ")).addClass("active"),r.removeClass(["active",o].join(" ")),a.sliding=!1,setTimeout(function(){a.$element.trigger("slid")},0)})}else{this.$element.trigger(f);if(f.isDefaultPrevented())return;r.removeClass("active"),i.addClass("active"),this.sliding=!1,this.$element.trigger("slid")}return s&&this.cycle(),this}};var n=e.fn.carousel;e.fn.carousel=function(n){return this.each(function(){var r=e(this),i=r.data("carousel"),s=e.extend({},e.fn.carousel.defaults,typeof n=="object"&&n),o=typeof n=="string"?n:s.slide;i||r.data("carousel",i=new t(this,s)),typeof n=="number"?i.to(n):o?i[o]():s.interval&&i.pause().cycle()})},e.fn.carousel.defaults={interval:5e3,pause:"hover"},e.fn.carousel.Constructor=t,e.fn.carousel.noConflict=function(){return e.fn.carousel=n,this},e(document).on("click.carousel.data-api","[data-slide], [data-slide-to]",function(t){var n=e(this),r,i=e(n.attr("data-target")||(r=n.attr("href"))&&r.replace(/.*(?=#[^\s]+$)/,"")),s=e.extend({},i.data(),n.data()),o;i.carousel(s),(o=n.attr("data-slide-to"))&&i.data("carousel").pause().to(o).cycle(),t.preventDefault()})}(window.jQuery),!function(e){"use strict";var t=function(t,n){this.$element=e(t),this.options=e.extend({},e.fn.collapse.defaults,n),this.options.parent&&(this.$parent=e(this.options.parent)),this.options.toggle&&this.toggle()};t.prototype={constructor:t,dimension:function(){var e=this.$element.hasClass("width");return e?"width":"height"},show:function(){var t,n,r,i;if(this.transitioning||this.$element.hasClass("in"))return;t=this.dimension(),n=e.camelCase(["scroll",t].join("-")),r=this.$parent&&this.$parent.find("> .accordion-group > .in");if(r&&r.length){i=r.data("collapse");if(i&&i.transitioning)return;r.collapse("hide"),i||r.data("collapse",null)}this.$element[t](0),this.transition("addClass",e.Event("show"),"shown"),e.support.transition&&this.$element[t](this.$element[0][n])},hide:function(){var t;if(this.transitioning||!this.$element.hasClass("in"))return;t=this.dimension(),this.reset(this.$element[t]()),this.transition("removeClass",e.Event("hideme"),"hidden"),this.$element[t](0)},reset:function(e){var t=this.dimension();return this.$element.removeClass("collapse")[t](e||"auto")[0].offsetWidth,this.$element[e!==null?"addClass":"removeClass"]("collapse"),this},transition:function(t,n,r){var i=this,s=function(){n.type=="show"&&i.reset(),i.transitioning=0,i.$element.trigger(r)};this.$element.trigger(n);if(n.isDefaultPrevented())return;this.transitioning=1,this.$element[t]("in"),e.support.transition&&this.$element.hasClass("collapse")?this.$element.one(e.support.transition.end,s):s()},toggle:function(){this[this.$element.hasClass("in")?"hide":"show"]()}};var n=e.fn.collapse;e.fn.collapse=function(n){return this.each(function(){var r=e(this),i=r.data("collapse"),s=e.extend({},e.fn.collapse.defaults,r.data(),typeof n=="object"&&n);i||r.data("collapse",i=new t(this,s)),typeof n=="string"&&i[n]()})},e.fn.collapse.defaults={toggle:!0},e.fn.collapse.Constructor=t,e.fn.collapse.noConflict=function(){return e.fn.collapse=n,this},e(document).on("click.collapse.data-api","[data-toggle=collapse]",function(t){var n=e(this),r,i=n.attr("data-target")||t.preventDefault()||(r=n.attr("href"))&&r.replace(/.*(?=#[^\s]+$)/,""),s=e(i).data("collapse")?"toggle":n.data();n[e(i).hasClass("in")?"addClass":"removeClass"]("collapsed"),e(i).collapse(s)})}(window.jQuery),!function(e){"use strict";function r(){e(t).parent().parent().removeClass("nav-hover"),e(".dropdown-backdrop").remove(),e(t).each(function(){i(e(this)).removeClass("open")})}function i(t){var n=t.attr("data-target"),r;n||(n=t.attr("href"),n=n&&/#/.test(n)&&n.replace(/.*(?=#[^\s]*$)/,"")),r=n&&e(n);if(!r||!r.length)r=t.parent();return r}var t="[data-toggle=dropdown]",n=function(t){var n=e(t).on("click.dropdown.data-api",this.toggle).on("mouseover.dropdown.data-api",this.toggle);e("html").on("click.dropdown.data-api",function(){n.parent().parent().removeClass("nav-hover"),n.parent().removeClass("open")})};n.prototype={constructor:n,toggle:function(t){var n=e(this),s,o,u,a;if(n.is(".disabled, :disabled"))return;s=i(n),o=s.hasClass("open"),a=s.parent().hasClass("nav-hover");if(!a&&t.type=="mouseover")return;u=n.attr("href");if(t.type=="click"&&u&&u!=="#"){window.location=u;return}r();if(!o&&t.type!="mouseover"||a&&t.type=="mouseover")"ontouchstart"in document.documentElement&&(e('<div class="dropdown-backdrop"/>').insertBefore(e(this)).on("click",r),n.on("hover",function(){e(".dropdown-backdrop").remove()})),s.parent().toggleClass("nav-hover"),s.toggleClass("open");return n.focus(),!1},keydown:function(n){var r,s,o,u,a,f;if(!/(38|40|27)/.test(n.keyCode))return;r=e(this),n.preventDefault(),n.stopPropagation();if(r.is(".disabled, :disabled"))return;u=i(r),a=u.hasClass("open");if(!a||a&&n.keyCode==27)return n.which==27&&u.find(t).focus(),r.click();s=e("[role=menu] li:not(.divider):visible a",u);if(!s.length)return;f=s.index(s.filter(":focus")),n.keyCode==38&&f>0&&f--,n.keyCode==40&&f<s.length-1&&f++,~f||(f=0),s.eq(f).focus()}};var s=e.fn.dropdown;e.fn.dropdown=function(t){return this.each(function(){var r=e(this),i=r.data("dropdown");i||r.data("dropdown",i=new n(this)),typeof t=="string"&&i[t].call(r)})},e.fn.dropdown.Constructor=n,e.fn.dropdown.noConflict=function(){return e.fn.dropdown=s,this},e(document).on("click.dropdown.data-api",r).on("click.dropdown.data-api",".dropdown form",function(e){e.stopPropagation()}).on("click.dropdown.data-api",t,n.prototype.toggle).on("keydown.dropdown.data-api",t+", [role=menu]",n.prototype.keydown).on("mouseover.dropdown.data-api",t,n.prototype.toggle)}(window.jQuery),!function(e){"use strict";var t=function(t,n){this.options=n,this.$element=e(t).delegate('[data-dismiss="modal"]',"click.dismiss.modal",e.proxy(this.hide,this)),this.options.remote&&this.$element.find(".modal-body").load(this.options.remote)};t.prototype={constructor:t,toggle:function(){return this[this.isShown?"hide":"show"]()},show:function(){var t=this,n=e.Event("show");this.$element.trigger(n);if(this.isShown||n.isDefaultPrevented())return;this.isShown=!0,this.escape(),this.backdrop(function(){var n=e.support.transition&&t.$element.hasClass("fade");t.$element.parent().length||t.$element.appendTo(document.body),t.$element.show(),n&&t.$element[0].offsetWidth,t.$element.addClass("in").attr("aria-hidden",!1),t.enforceFocus(),n?t.$element.one(e.support.transition.end,function(){t.$element.focus().trigger("shown")}):t.$element.focus().trigger("shown")})},hide:function(t){t&&t.preventDefault();var n=this;t=e.Event("hide"),this.$element.trigger(t);if(!this.isShown||t.isDefaultPrevented())return;this.isShown=!1,this.escape(),e(document).off("focusin.modal"),this.$element.removeClass("in").attr("aria-hidden",!0),e.support.transition&&this.$element.hasClass("fade")?this.hideWithTransition():this.hideModal()},enforceFocus:function(){var t=this;e(document).on("focusin.modal",function(e){t.$element[0]!==e.target&&!t.$element.has(e.target).length&&t.$element.focus()})},escape:function(){var e=this;this.isShown&&this.options.keyboard?this.$element.on("keyup.dismiss.modal",function(t){t.which==27&&e.hide()}):this.isShown||this.$element.off("keyup.dismiss.modal")},hideWithTransition:function(){var t=this,n=setTimeout(function(){t.$element.off(e.support.transition.end),t.hideModal()},500);this.$element.one(e.support.transition.end,function(){clearTimeout(n),t.hideModal()})},hideModal:function(){var e=this;this.$element.hide(),this.backdrop(function(){e.removeBackdrop(),e.$element.trigger("hidden")})},removeBackdrop:function(){this.$backdrop&&this.$backdrop.remove(),this.$backdrop=null},backdrop:function(t){var n=this,r=this.$element.hasClass("fade")?"fade":"";if(this.isShown&&this.options.backdrop){var i=e.support.transition&&r;this.$backdrop=e('<div class="modal-backdrop '+r+'" />').appendTo(document.body),this.$backdrop.click(this.options.backdrop=="static"?e.proxy(this.$element[0].focus,this.$element[0]):e.proxy(this.hide,this)),i&&this.$backdrop[0].offsetWidth,this.$backdrop.addClass("in");if(!t)return;i?this.$backdrop.one(e.support.transition.end,t):t()}else!this.isShown&&this.$backdrop?(this.$backdrop.removeClass("in"),e.support.transition&&this.$element.hasClass("fade")?this.$backdrop.one(e.support.transition.end,t):t()):t&&t()}};var n=e.fn.modal;e.fn.modal=function(n){return this.each(function(){var r=e(this),i=r.data("modal"),s=e.extend({},e.fn.modal.defaults,r.data(),typeof n=="object"&&n);i||r.data("modal",i=new t(this,s)),typeof n=="string"?i[n]():s.show&&i.show()})},e.fn.modal.defaults={backdrop:!0,keyboard:!0,show:!0},e.fn.modal.Constructor=t,e.fn.modal.noConflict=function(){return e.fn.modal=n,this},e(document).on("click.modal.data-api",'[data-toggle="modal"]',function(t){var n=e(this),r=n.attr("href"),i=e(n.attr("data-target")||r&&r.replace(/.*(?=#[^\s]+$)/,"")),s=i.data("modal")?"toggle":e.extend({remote:!/#/.test(r)&&r},i.data(),n.data());t.preventDefault(),i.modal(s).one("hide",function(){n.focus()})})}(window.jQuery),!function(e){"use strict";var t=function(e,t){this.init("tooltip",e,t)};t.prototype={constructor:t,init:function(t,n,r){var i,s,o,u,a;this.type=t,this.$element=e(n),this.options=this.getOptions(r),this.enabled=!0,o=this.options.trigger.split(" ");for(a=o.length;a--;)u=o[a],u=="click"?this.$element.on("click."+this.type,this.options.selector,e.proxy(this.toggle,this)):u!="manual"&&(i=u=="hover"?"mouseenter":"focus",s=u=="hover"?"mouseleave":"blur",this.$element.on(i+"."+this.type,this.options.selector,e.proxy(this.enter,this)),this.$element.on(s+"."+this.type,this.options.selector,e.proxy(this.leave,this)));this.options.selector?this._options=e.extend({},this.options,{trigger:"manual",selector:""}):this.fixTitle()},getOptions:function(t){return t=e.extend({},e.fn[this.type].defaults,this.$element.data(),t),t.delay&&typeof t.delay=="number"&&(t.delay={show:t.delay,hide:t.delay}),t},enter:function(t){var n=e.fn[this.type].defaults,r={},i;this._options&&e.each(this._options,function(e,t){n[e]!=t&&(r[e]=t)},this),i=e(t.currentTarget)[this.type](r).data(this.type);if(!i.options.delay||!i.options.delay.show)return i.show();clearTimeout(this.timeout),i.hoverState="in",this.timeout=setTimeout(function(){i.hoverState=="in"&&i.show()},i.options.delay.show)},leave:function(t){var n=e(t.currentTarget)[this.type](this._options).data(this.type);this.timeout&&clearTimeout(this.timeout);if(!n.options.delay||!n.options.delay.hide)return n.hide();n.hoverState="out",this.timeout=setTimeout(function(){n.hoverState=="out"&&n.hide()},n.options.delay.hide)},show:function(){var t,n,r,i,s,o,u=e.Event("show");if(this.hasContent()&&this.enabled){this.$element.trigger(u);if(u.isDefaultPrevented())return;t=this.tip(),this.setContent(),this.options.animation&&t.addClass("fade"),s=typeof this.options.placement=="function"?this.options.placement.call(this,t[0],this.$element[0]):this.options.placement,t.detach().css({top:0,left:0,display:"block"}),this.options.container?t.appendTo(this.options.container):t.insertAfter(this.$element),n=this.getPosition(),r=t[0].offsetWidth,i=t[0].offsetHeight;switch(s){case"bottom":o={top:n.top+n.height,left:n.left+n.width/2-r/2};break;case"top":o={top:n.top-i,left:n.left+n.width/2-r/2};break;case"left":o={top:n.top+n.height/2-i/2,left:n.left-r};break;case"right":o={top:n.top+n.height/2-i/2,left:n.left+n.width}}this.applyPlacement(o,s),this.$element.trigger("shown")}},applyPlacement:function(e,t){var n=this.tip(),r=n[0].offsetWidth,i=n[0].offsetHeight,s,o,u,a;n.offset(e).addClass(t).addClass("in"),s=n[0].offsetWidth,o=n[0].offsetHeight,t=="top"&&o!=i&&(e.top=e.top+i-o,a=!0),t=="bottom"||t=="top"?(u=0,e.left<0&&(u=e.left*-2,e.left=0,n.offset(e),s=n[0].offsetWidth,o=n[0].offsetHeight),this.replaceArrow(u-r+s,s,"left")):this.replaceArrow(o-i,o,"top"),a&&n.offset(e)},replaceArrow:function(e,t,n){this.arrow().css(n,e?50*(1-e/t)+"%":"")},setContent:function(){var e=this.tip(),t=this.getTitle();e.find(".tooltip-inner")[this.options.html?"html":"text"](t),e.removeClass("fade in top bottom left right")},hide:function(){function i(){var t=setTimeout(function(){n.off(e.support.transition.end).detach()},500);n.one(e.support.transition.end,function(){clearTimeout(t),n.detach()})}var t=this,n=this.tip(),r=e.Event("hideme");this.$element.trigger(r);if(r.isDefaultPrevented())return;return n.removeClass("in"),e.support.transition&&this.$tip.hasClass("fade")?i():n.detach(),this.$element.trigger("hidden"),this},fixTitle:function(){var e=this.$element;(e.attr("title")||typeof e.attr("data-original-title")!="string")&&e.attr("data-original-title",e.attr("title")||"").attr("title","")},hasContent:function(){return this.getTitle()},getPosition:function(){var t=this.$element[0];return e.extend({},typeof t.getBoundingClientRect=="function"?t.getBoundingClientRect():{width:t.offsetWidth,height:t.offsetHeight},this.$element.offset())},getTitle:function(){var e,t=this.$element,n=this.options;return e=t.attr("data-original-title")||(typeof n.title=="function"?n.title.call(t[0]):n.title),e},tip:function(){return this.$tip=this.$tip||e(this.options.template)},arrow:function(){return this.$arrow=this.$arrow||this.tip().find(".tooltip-arrow")},validate:function(){this.$element[0].parentNode||(this.hide(),this.$element=null,this.options=null)},enable:function(){this.enabled=!0},disable:function(){this.enabled=!1},toggleEnabled:function(){this.enabled=!this.enabled},toggle:function(t){var n=t?e(t.currentTarget)[this.type](this._options).data(this.type):this;n.tip().hasClass("in")?n.hide():n.show()},destroy:function(){this.hide().$element.off("."+this.type).removeData(this.type)}};var n=e.fn.tooltip;e.fn.tooltip=function(n){return this.each(function(){var r=e(this),i=r.data("tooltip"),s=typeof n=="object"&&n;i||r.data("tooltip",i=new t(this,s)),typeof n=="string"&&i[n]()})},e.fn.tooltip.Constructor=t,e.fn.tooltip.defaults={animation:!0,placement:"top",selector:!1,template:'<div class="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',trigger:"hover focus",title:"",delay:0,html:!0,container:!1},e.fn.tooltip.noConflict=function(){return e.fn.tooltip=n,this}}(window.jQuery),!function(e){"use strict";var t=function(e,t){this.init("popover",e,t)};t.prototype=e.extend({},e.fn.tooltip.Constructor.prototype,{constructor:t,setContent:function(){var e=this.tip(),t=this.getTitle(),n=this.getContent();e.find(".popover-title")[this.options.html?"html":"text"](t),e.find(".popover-content")[this.options.html?"html":"text"](n),e.removeClass("fade top bottom left right in")},hasContent:function(){return this.getTitle()||this.getContent()},getContent:function(){var e,t=this.$element,n=this.options;return e=(typeof n.content=="function"?n.content.call(t[0]):n.content)||t.attr("data-content"),e},tip:function(){return this.$tip||(this.$tip=e(this.options.template)),this.$tip},destroy:function(){this.hide().$element.off("."+this.type).removeData(this.type)}});var n=e.fn.popover;e.fn.popover=function(n){return this.each(function(){var r=e(this),i=r.data("popover"),s=typeof n=="object"&&n;i||r.data("popover",i=new t(this,s)),typeof n=="string"&&i[n]()})},e.fn.popover.Constructor=t,e.fn.popover.defaults=e.extend({},e.fn.tooltip.defaults,{placement:"right",trigger:"click",content:"",template:'<div class="popover"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'}),e.fn.popover.noConflict=function(){return e.fn.popover=n,this}}(window.jQuery),!function(e){"use strict";function t(t,n){var r=e.proxy(this.process,this),i=e(t).is("body")?e(window):e(t),s;this.options=e.extend({},e.fn.scrollspy.defaults,n),this.$scrollElement=i.on("scroll.scroll-spy.data-api",r),this.selector=(this.options.target||(s=e(t).attr("href"))&&s.replace(/.*(?=#[^\s]+$)/,"")||"")+" .nav li > a",this.$body=e("body"),this.refresh(),this.process()}t.prototype={constructor:t,refresh:function(){var t=this,n;this.offsets=e([]),this.targets=e([]),n=this.$body.find(this.selector).map(function(){var n=e(this),r=n.data("target")||n.attr("href"),i=/^#\w/.test(r)&&e(r);return i&&i.length&&[[i.position().top+(!e.isWindow(t.$scrollElement.get(0))&&t.$scrollElement.scrollTop()),r]]||null}).sort(function(e,t){return e[0]-t[0]}).each(function(){t.offsets.push(this[0]),t.targets.push(this[1])})},process:function(){var e=this.$scrollElement.scrollTop()+this.options.offset,t=this.$scrollElement[0].scrollHeight||this.$body[0].scrollHeight,n=t-this.$scrollElement.height(),r=this.offsets,i=this.targets,s=this.activeTarget,o;if(e>=n)return s!=(o=i.last()[0])&&this.activate(o);for(o=r.length;o--;)s!=i[o]&&e>=r[o]&&(!r[o+1]||e<=r[o+1])&&this.activate(i[o])},activate:function(t){var n,r;this.activeTarget=t,e(this.selector).parent(".active").removeClass("active"),r=this.selector+'[data-target="'+t+'"],'+this.selector+'[href="'+t+'"]',n=e(r).parent("li").addClass("active"),n.parent(".dropdown-menu").length&&(n=n.closest("li.dropdown").addClass("active")),n.trigger("activate")}};var n=e.fn.scrollspy;e.fn.scrollspy=function(n){return this.each(function(){var r=e(this),i=r.data("scrollspy"),s=typeof n=="object"&&n;i||r.data("scrollspy",i=new t(this,s)),typeof n=="string"&&i[n]()})},e.fn.scrollspy.Constructor=t,e.fn.scrollspy.defaults={offset:10},e.fn.scrollspy.noConflict=function(){return e.fn.scrollspy=n,this},e(window).on("load",function(){e('[data-spy="scroll"]').each(function(){var t=e(this);t.scrollspy(t.data())})})}(window.jQuery),!function(e){"use strict";var t=function(t){this.element=e(t)};t.prototype={constructor:t,show:function(){var t=this.element,n=t.closest("ul:not(.dropdown-menu)"),r=t.attr("data-target"),i,s,o;r||(r=t.attr("href"),r=r&&r.replace(/.*(?=#[^\s]*$)/,""));if(t.parent("li").hasClass("active"))return;i=n.find(".active:last a")[0],o=e.Event("show",{relatedTarget:i}),t.trigger(o);if(o.isDefaultPrevented())return;s=e(r),this.activate(t.parent("li"),n),this.activate(s,s.parent(),function(){t.trigger({type:"shown",relatedTarget:i})})},activate:function(t,n,r){function o(){i.removeClass("active").find("> .dropdown-menu > .active").removeClass("active"),t.addClass("active"),s?(t[0].offsetWidth,t.addClass("in")):t.removeClass("fade"),t.parent(".dropdown-menu")&&t.closest("li.dropdown").addClass("active"),r&&r()}var i=n.find("> .active"),s=r&&e.support.transition&&i.hasClass("fade");s?i.one(e.support.transition.end,o):o(),i.removeClass("in")}};var n=e.fn.tab;e.fn.tab=function(n){return this.each(function(){var r=e(this),i=r.data("tab");i||r.data("tab",i=new t(this)),typeof n=="string"&&i[n]()})},e.fn.tab.Constructor=t,e.fn.tab.noConflict=function(){return e.fn.tab=n,this},e(document).on("click.tab.data-api",'[data-toggle="tab"], [data-toggle="pill"]',function(t){t.preventDefault(),e(this).tab("show")})}(window.jQuery),!function(e){"use strict";var t=function(t,n){this.$element=e(t),this.options=e.extend({},e.fn.typeahead.defaults,n),this.matcher=this.options.matcher||this.matcher,this.sorter=this.options.sorter||this.sorter,this.highlighter=this.options.highlighter||this.highlighter,this.updater=this.options.updater||this.updater,this.source=this.options.source,this.$menu=e(this.options.menu),this.shown=!1,this.listen()};t.prototype={constructor:t,select:function(){var e=this.$menu.find(".active").attr("data-value");return this.$element.val(this.updater(e)).change(),this.hide()},updater:function(e){return e},show:function(){var t=e.extend({},this.$element.position(),{height:this.$element[0].offsetHeight});return this.$menu.insertAfter(this.$element).css({top:t.top+t.height,left:t.left}).show(),this.shown=!0,this},hide:function(){return this.$menu.hide(),this.shown=!1,this},lookup:function(t){var n;return this.query=this.$element.val(),!this.query||this.query.length<this.options.minLength?this.shown?this.hide():this:(n=e.isFunction(this.source)?this.source(this.query,e.proxy(this.process,this)):this.source,n?this.process(n):this)},process:function(t){var n=this;return t=e.grep(t,function(e){return n.matcher(e)}),t=this.sorter(t),t.length?this.render(t.slice(0,this.options.items)).show():this.shown?this.hide():this},matcher:function(e){return~e.toLowerCase().indexOf(this.query.toLowerCase())},sorter:function(e){var t=[],n=[],r=[],i;while(i=e.shift())i.toLowerCase().indexOf(this.query.toLowerCase())?~i.indexOf(this.query)?n.push(i):r.push(i):t.push(i);return t.concat(n,r)},highlighter:function(e){var t=this.query.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g,"\\$&");return e.replace(new RegExp("("+t+")","ig"),function(e,t){return"<strong>"+t+"</strong>"})},render:function(t){var n=this;return t=e(t).map(function(t,r){return t=e(n.options.item).attr("data-value",r),t.find("a").html(n.highlighter(r)),t[0]}),t.first().addClass("active"),this.$menu.html(t),this},next:function(t){var n=this.$menu.find(".active").removeClass("active"),r=n.next();r.length||(r=e(this.$menu.find("li")[0])),r.addClass("active")},prev:function(e){var t=this.$menu.find(".active").removeClass("active"),n=t.prev();n.length||(n=this.$menu.find("li").last()),n.addClass("active")},listen:function(){this.$element.on("focus",e.proxy(this.focus,this)).on("blur",e.proxy(this.blur,this)).on("keypress",e.proxy(this.keypress,this)).on("keyup",e.proxy(this.keyup,this)),this.eventSupported("keydown")&&this.$element.on("keydown",e.proxy(this.keydown,this)),this.$menu.on("click",e.proxy(this.click,this)).on("mouseenter","li",e.proxy(this.mouseenter,this)).on("mouseleave","li",e.proxy(this.mouseleave,this))},eventSupported:function(e){var t=e in this.$element;return t||(this.$element.setAttribute(e,"return;"),t=typeof this.$element[e]=="function"),t},move:function(e){if(!this.shown)return;switch(e.keyCode){case 9:case 13:case 27:e.preventDefault();break;case 38:e.preventDefault(),this.prev();break;case 40:e.preventDefault(),this.next()}e.stopPropagation()},keydown:function(t){this.suppressKeyPressRepeat=~e.inArray(t.keyCode,[40,38,9,13,27]),this.move(t)},keypress:function(e){if(this.suppressKeyPressRepeat)return;this.move(e)},keyup:function(e){switch(e.keyCode){case 40:case 38:case 16:case 17:case 18:break;case 9:case 13:if(!this.shown)return;this.select();break;case 27:if(!this.shown)return;this.hide();break;default:this.lookup()}e.stopPropagation(),e.preventDefault()},focus:function(e){this.focused=!0},blur:function(e){this.focused=!1,!this.mousedover&&this.shown&&this.hide()},click:function(e){e.stopPropagation(),e.preventDefault(),this.select(),this.$element.focus()},mouseenter:function(t){this.mousedover=!0,this.$menu.find(".active").removeClass("active"),e(t.currentTarget).addClass("active")},mouseleave:function(e){this.mousedover=!1,!this.focused&&this.shown&&this.hide()}};var n=e.fn.typeahead;e.fn.typeahead=function(n){return this.each(function(){var r=e(this),i=r.data("typeahead"),s=typeof n=="object"&&n;i||r.data("typeahead",i=new t(this,s)),typeof n=="string"&&i[n]()})},e.fn.typeahead.defaults={source:[],items:8,menu:'<ul class="typeahead dropdown-menu"></ul>',item:'<li><a href="#"></a></li>',minLength:1},e.fn.typeahead.Constructor=t,e.fn.typeahead.noConflict=function(){return e.fn.typeahead=n,this},e(document).on("focus.typeahead.data-api",'[data-provide="typeahead"]',function(t){var n=e(this);if(n.data("typeahead"))return;n.typeahead(n.data())})}(window.jQuery),!function(e){"use strict";var t=function(t,n){this.options=e.extend({},e.fn.affix.defaults,n),this.$window=e(window).on("scroll.affix.data-api",e.proxy(this.checkPosition,this)).on("click.affix.data-api",e.proxy(function(){setTimeout(e.proxy(this.checkPosition,this),1)},this)),this.$element=e(t),this.checkPosition()};t.prototype.checkPosition=function(){if(!this.$element.is(":visible"))return;var t=e(document).height(),n=this.$window.scrollTop(),r=this.$element.offset(),i=this.options.offset,s=i.bottom,o=i.top,u="affix affix-top affix-bottom",a;typeof i!="object"&&(s=o=i),typeof o=="function"&&(o=i.top()),typeof s=="function"&&(s=i.bottom()),a=this.unpin!=null&&n+this.unpin<=r.top?!1:s!=null&&r.top+this.$element.height()>=t-s?"bottom":o!=null&&n<=o?"top":!1;if(this.affixed===a)return;this.affixed=a,this.unpin=a=="bottom"?r.top-n:null,this.$element.removeClass(u).addClass("affix"+(a?"-"+a:""))};var n=e.fn.affix;e.fn.affix=function(n){return this.each(function(){var r=e(this),i=r.data("affix"),s=typeof n=="object"&&n;i||r.data("affix",i=new t(this,s)),typeof n=="string"&&i[n]()})},e.fn.affix.Constructor=t,e.fn.affix.defaults={offset:0},e.fn.affix.noConflict=function(){return e.fn.affix=n,this},e(window).on("load",function(){e('[data-spy="affix"]').each(function(){var t=e(this),n=t.data();n.offset=n.offset||{},n.offsetBottom&&(n.offset.bottom=n.offsetBottom),n.offsetTop&&(n.offset.top=n.offsetTop),t.affix(n)})})}(window.jQuery);
}
var jqSet = 0;
var jqSetInterval =  setInterval(function(){
	$ = jQuery;
	jqSet++;
	if(jqSet == 50)
		clearInterval(jqSetInterval);
},100);
 
var TabsInit = false;
var HORTabsInit = false;
var surogatID = 0; 
var stabitem_n = 0;

function getSurogateID(){
  surogatID++;
  return String(surogatID);
}

function doExport(base,handlerurl,withName){

    if(!withName || withName == '' || withName == undefined){
	   alert('Please enter a valid name for template!');
	   return;
	}

	jQuery.ajax({
	  url: base + handlerurl,
	  type: 'POST',
	  data: jQuery('#style-form').serialize(),
	  cache: false
	}).done(function( html ) {
	   var vals = html.split("|");
	   if(vals[0] == "OK"){
	        window.location = base + "templates/" + TADMIN_TEMPLATE_FOLDER + "/export/" + vals[1];
	   }else{
	   	alert(html);
	   }
	   
	});
	return false;
}

jQuery(window).load(function(){
   jQuery('LI.active').removeClass('active');
   
   jQuery('ul.nav-tabs LI')
						   .removeClass('ui-tabs-selected')
						   .removeClass('ui-state-active');
    
   
    if(jQuery("nav.navbar")[0]){
	   //joomla 3
	    var optContainer = jQuery('DIV.tab-pane#options'); 
	    
        var menu = null;
		var dtlPanel = null;
		var fieldpanels = null;
		var maPanel = null;
		
		
		
		if(!optContainer[0]){//j3.2+
		   
		   jQuery('DIV.tab-content').attr('id','options').addClass('tab-pane');
		   
		   optContainer = jQuery('.tab-content#options');
		   
		   menu = jQuery("<ul id='tadmin_menu'></ul>").prependTo(optContainer);
		   
		   fieldpanels = optContainer.find('> DIV.tab-pane');
			
		   fieldpanels.each(function(ind){
		        var tTilte = jQuery('ul.nav-tabs a[href="#' + jQuery(this).attr('id') + '"]').text();
				jQuery('ul.nav-tabs a[href="#' + jQuery(this).attr('id') + '"]').parent().remove();
				menu.append(jQuery('<li><a href="#' +  jQuery(this).attr('id') + '" >' + tTilte + '</a></li>'));	
                jQuery(this).removeClass('tab-pane').addClass('tadmin_tab');	
				jQuery(this).append(jQuery('#help_tab' + String(2 + ind)).show());
		   });
			
		   jQuery(window).load(function(){
			   jQuery('.curvedContainer').css('float','left').css('margin-left','0');
			   jQuery('.tabcontent:not(:first)').css('display','none');
			   
			   jQuery(window).resize(function(){
			      jQuery('.curvedContainer').each(function(i){
						jQuery(this).innerWidth(jQuery(this).parent().innerWidth() - jQuery('.curvedContainer').parent().find('.hortabs').innerWidth() - 20);
				  });
			   });
			   
			   jQuery(window).trigger('resize');
		   });
		}else{
		    optContainer.addClass('tab-pane');
			menu = jQuery("<ul id='tadmin_menu'></ul>").prependTo(optContainer);;
			menu.append(jQuery('<li><a href="#tadmin_tab_details" >' + TADMIN_LANG.details + '</a></li>'));			 
			dtlPanel = jQuery("<div class='tadmin_tab' id='tadmin_tab_details'></div>").appendTo(optContainer);
			jQuery(".tab-content #details").appendTo(dtlPanel);
			menu.append(jQuery('<li><a href="#tadmin_tab_menusassignment" >' + TADMIN_LANG.menusassignment + '</a></li>'));
			maPanel = jQuery("<div class='tadmin_tab' id='tadmin_tab_menusassignment'></div>").appendTo(optContainer);
			jQuery(".tab-content #assignment").appendTo(maPanel);
			
		}
		
		
		
		optContainer.find('> .accordion').remove();
		
		optContainer.tabs({ 
		   fx: { opacity: 'toggle' },
		   show: function (event, ui) {
		            if (TabsInit) {
						jQuery.cookie('tadmin_tab_cookie', optContainer.tabs("option", "selected") || optContainer.tabs("option", "active"), { expires: 7, path: '/' });
						jQuery(window).trigger('resize');
					} else TabsInit = true;
				},
		   selected: (jQuery.cookie('tadmin_tab_cookie') != null)? 	parseInt(jQuery.cookie('tadmin_tab_cookie')) : 0,
		   active: (jQuery.cookie('tadmin_tab_cookie') != null)? 	parseInt(jQuery.cookie('tadmin_tab_cookie')) : 0
		});
		
		
		
		
		jQuery('DIV#options div.tadmin_tab').each(function(ind){
		  if(jQuery(this).find('.subtabstart')[0]){
		     var htabs = jQuery('<div class="hortabscontainer"></div>');
			 jQuery(this).prepend(htabs);
			 var htabs_menu = jQuery('<div class="hortabs"></div>');
			 var htabs_tabs = jQuery('<div class="curvedContainer"></div>');
			 htabs.append(htabs_menu);
			 htabs.append(htabs_tabs);
			 
			 var Title = TADMSCRIPTTRANS.general;
		     if(jQuery(this).find('> .control-group:first .subtabstart')[0]){
				Title = jQuery(this).find('.control-group:first label').text();
				jQuery(this).find('> .control-group:first').remove();
			 }	
			 
			 var menu_item = jQuery('<div id="stid' + (stabitem_n++) + '" class="tab selected first subtab_menu_item" ><div class="hortabslink">' + Title + '</div><div class="hortabsarrow"></div></div>');
			 var tab_item  = jQuery('<div class="tabcontent" style="display:block"><div class="adminformlist" ></div></div>');
			 menu_item.appendTo(htabs_menu);
			 tab_item.appendTo(htabs_tabs);
			 
			 jQuery(this).find('> .control-group').each(function(index){
			 
				if(jQuery(this).find('.subtabstart')[0]){
				   Title = jQuery(this).find('label').text();
				   if(!jQuery.trim(Title))
						Title = jQuery(this).find('h3').text();
				   
				   menu_item = jQuery('<div id="stid' + (stabitem_n++) + '"  class="tab subtab_menu_item" ><div class="hortabslink">' + Title + '</div><div class="hortabsarrow"></div></div>');
				   tab_item  = jQuery('<div class="tabcontent"  style="display:none"><div class="adminformlist" ></div></div>');
				   
				   menu_item.appendTo(htabs_menu);
				   tab_item.appendTo(htabs_tabs);
				   
				   jQuery(this).remove();
				}else{
				   jQuery(this).appendTo(tab_item.find('.adminformlist'));
				}
			 
			 });
			 menu_item.addClass('last');	
			 
		  
		  }
		});
		
		jQuery('.tadmin_tab .control-group').append(jQuery('<div style="clear:both;" ></div>'));
/////////////////////////////////////////////////////////////////////////////////	
	}else{
/////////////////////////////////////////////////////////////////////////////////
	jQuery("<ul id='tadmin_menu'><li><a href='#tadmin_tab1' ><span>" + TADMSCRIPTTRANS.general + "</span></a></li></ul>").appendTo(jQuery('FORM#style-form'));
	
	var fieldpanels = jQuery('.pane-sliders > .panel');
	fieldpanels.each(function(ind){
	   jQuery("#tadmin_menu").append(jQuery('<li><a href="#tadmin_tab' + String(2 + ind) + '" >' + jQuery(jQuery(this).find('.title a')[0]).html() + '</a></li>'));			 
	});

	var jpan = jQuery("FORM#style-form > DIV[class != 'clr']");
	var dcont = jQuery('<div class="tadmin_tab" id="tadmin_tab1" ></div>');
	dcont.appendTo(jQuery('FORM#style-form'));
	dcont.append(jQuery(jpan[0]).children());
	dcont.append(jQuery(jpan[2]).children());
    dcont.children('fieldset').first().css('float','left');
	
	dcont.append(jQuery('#help_tab1'));
	jQuery('#help_tab1').css({
	 'position': 'absolute',
     'top': '260px'
	}).show();
	
	
	jQuery(jQuery(jpan[1]).children()[0]).children('.panel').each(function(ind){
	    var ffc = jQuery("<div class='tadmin_tab' id='tadmin_tab" + String(2 + ind) + "'></div>");
	    ffc.appendTo(jQuery('FORM#style-form'));
	    var fset = jQuery(this).find('.pane-slider .panelform');
		fset.appendTo(ffc);
		fset.append( jQuery('#help_tab' + String(2 + ind)));
		jQuery('#help_tab' + String(2 + ind)).show();
	});
	
	jQuery(jpan[0]).remove();
	jQuery(jpan[1]).remove();
	jQuery(jpan[2]).remove();
	jQuery('FORM#style-form >.clr').remove();

	/* Moving Assignments Tab to the end - START */
	jQuery('#tadmin_menu li a').first().attr("href","#tadmin_tab8");
	jQuery('#tadmin_menu li').first().clone(true).appendTo('#tadmin_menu');
	jQuery("#tadmin_menu li").first().remove();
	jQuery('div#tadmin_tab1').attr("id","tadmin_tab8");
	/* Moving Assignments Tab to the end - END */
	
    jQuery('FORM#style-form').tabs({ 
	   fx: { opacity: 'toggle' },
	   show: function (event, ui) {
				if (TabsInit) {
					jQuery.cookie('tadmin_tab_cookie', jQuery('FORM#style-form').tabs("option", "selected") || optContainer.tabs("option", "active"), { expires: 7, path: '/' });
				} else TabsInit = true;
			},
	   selected: (jQuery.cookie('tadmin_tab_cookie') != null)? 	parseInt(jQuery.cookie('tadmin_tab_cookie')) : 0,
       active: (jQuery.cookie('tadmin_tab_cookie') != null)? 	parseInt(jQuery.cookie('tadmin_tab_cookie')) : 0	   
    });
	
	
	jQuery('FORM#style-form > div[id != "tadmin_tab1"]').each(function(ind){
	  var ul = jQuery(this).find('fieldset > ul').first();
	  if(ul[0]){
	    if(ul.find('.subtabstart')[0]){
		 var htabs = jQuery('<div class="hortabscontainer"></div>');
		 ul.parent().prepend(htabs);
		 var htabs_menu = jQuery('<div class="hortabs"></div>');
		 var htabs_tabs = jQuery('<div class="curvedContainer"></div>');
		 htabs.append(htabs_menu);
		 htabs.append(htabs_tabs);
		 
		 var Title = TADMSCRIPTTRANS.general; 
	     if(  ul.children('LI').first().find('.subtabstart')[0]){
		    Title = ul.find('LI').first().find('.subtabstart').text();
			ul.children('LI').first().remove();
		 }
		 
		 var menu_item = jQuery('<div  id="stid' + (stabitem_n++) + '" class="tab selected first subtab_menu_item" ><div class="hortabslink">' + Title + '</div><div class="hortabsarrow"></div></div>');
		 var tab_item  = jQuery('<div class="tabcontent"  style="display:block"><ul class="adminformlist" ></ul></div>');
		 menu_item.appendTo(htabs_menu);
		 tab_item.appendTo(htabs_tabs);
		 
         ul.children('LI').each(function(index){
		    if(jQuery(this).find('.subtabstart')[0]){
			   Title = jQuery(this).find('.subtabstart').text();
			   menu_item = jQuery('<div  id="stid' + (stabitem_n++) + '"  class="tab subtab_menu_item" ><div class="hortabslink">' + Title + '</div><div class="hortabsarrow"></div></div>');
		       tab_item  = jQuery('<div class="tabcontent"  style="display:none"><ul class="adminformlist" ></ul><div style="clear:both;"></div></div>');
			   menu_item.appendTo(htabs_menu);
		       tab_item.appendTo(htabs_tabs);
			   jQuery(this).remove();
			}else{
			   jQuery(this).appendTo(tab_item.find('.adminformlist'));
			}
		 });
		 menu_item.addClass('last');
		 
		}
	  }
	});
/////////////////////////////////////////////////////////////////////////////////	
	}
	
	
	jQuery('.subtab_menu_item').click(function(){
		jQuery.cookie('subtab_tab_cookie', jQuery(this).attr("id"), { expires: 7, path: '/' });
		jQuery(window).trigger('resize');
	});
	
	if(jQuery('#' + jQuery.cookie('subtab_tab_cookie') )[0]){
	  jQuery(window).load(function(){
		jQuery('#' + jQuery.cookie('subtab_tab_cookie') ).trigger('click');
	  });
	}
	
	
});

jQuery(window).load(function() {
 
    if(!HORTabsInit){	
	   
	    window.hortabswap = function(tab){
		    var curMenu= tab;
			
			
			curMenu.parent().find('*').removeClass("selected")
			                          .removeClass('ui-tabs-selected')
						              .removeClass('ui-state-active');
										 
			curMenu.addClass("selected")
			       .addClass('ui-tabs-selected')
				   .addClass('ui-state-active');

			var index = curMenu.index();
			
			curMenu.parent().parent().find(".curvedContainer .tabcontent").css("display","none");
			
			jQuery(curMenu.parent().parent().find(".curvedContainer .tabcontent")[index]).css("display","block");
			
			jQuery(curMenu.attr('href')).show();
			
			var designation = curMenu.closest('.tadmin_tab').attr('id');
			jQuery.cookie(designation, curMenu.index(), { expires: 7, path: '/' });
		}; 
	
		jQuery(".hortabs .tab").click(function() {
			window.hortabswap(jQuery(this));
		});
		
		
		/*
		jQuery('FORM#style-form > div[id != "tadmin_tab1"]').each(function(i){
		  if(jQuery.cookie(jQuery(this).attr('id'))){
		    window.hortabswap(jQuery(jQuery(this).find('.hortabs .tab')[ parseInt(jQuery.cookie(jQuery(this).attr('id')))]));
		  }
		});
		
		*/
		
		
		
		jQuery('.tadmin_tab').each(function(i){
		  if(jQuery.cookie(jQuery(this).attr('id'))){
		    window.hortabswap(jQuery(jQuery(this).find('.hortabs .tab')[ parseInt(jQuery.cookie(jQuery(this).attr('id')))]));
		  }
		});
		
		
		
		/*
		jQuery('UL.nav.nav-tabs a').click(function(){
		  jQuery.cookie("j3menu_pos", jQuery(this).parent().index(), { expires: 7, path: '/' });
		});
		
		if(jQuery.cookie("j3menu_pos")){
		  
		  jQuery('.tab-content .tab-pane.ui-state-active')
		                                                  .removeClass('ui-tabs-selected')
						                                  .removeClass('ui-state-active');
		
		
		  jQuery('UL.nav.nav-tabs li.ui-state-active')
		                                     .removeClass('ui-tabs-selected')
						                     .removeClass('ui-state-active');
											 
		  
		  jQuery(jQuery('fieldset .tab-content .tab-pane')[jQuery.cookie("j3menu_pos")])
																						.addClass('ui-tabs-selected')
																						.addClass('ui-state-active');
																						
																						
		  var activeLI = jQuery(jQuery('UL.nav.nav-tabs li')[jQuery.cookie("j3menu_pos")]);
			activeLI
				   .addClass('ui-tabs-selected')
				   .addClass('ui-state-active');
				   
		  jQuery(activeLI.find('a').attr('href')).show();		   
				   
		}
		*/
		
		HORTabsInit = true;



	}
});



jQuery.cookie = function (key, value, options) {

        // key and at least value given, set cookie...
        if (arguments.length > 1 && String(value) !== "[object Object]") {
            options = jQuery.extend({}, options);

            if (value === null || value === undefined) {
                options.expires = -1;
            }

            if (typeof options.expires === 'number') {
                var days = options.expires, t = options.expires = new Date();
                t.setDate(t.getDate() + days);
            }

            value = String(value);

            return (document.cookie = [
            encodeURIComponent(key), '=',
            options.raw ? value : encodeURIComponent(value),
            options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
            options.path ? '; path=' + options.path : '',
            options.domain ? '; domain=' + options.domain : '',
            options.secure ? '; secure' : ''
        ].join(''));
        }

        // key and possibly options given, get cookie...
        options = value || {};
        var result, decode = options.raw ? function (s) { return s; } : decodeURIComponent;
        return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;
};

jQuery(document).ready(function(){

	if(!window.checkColor){
	  window.checkColor = function(jEL){
	   try{
	   var rgbArr = jEL.css('backgroundColor').toLowerCase().replace('rgb(','').replace(')','').split(',');
	   rgbArr[0] = parseInt(rgbArr[0]);
	   rgbArr[1] = parseInt(rgbArr[1]);
	   rgbArr[2] = parseInt(rgbArr[2]);
		if( rgbArr[0] + rgbArr[1] + rgbArr[2] <  380){
			jEL.css('color','white');
		  }else{
			jEL.css('color','black');
		  }
		}catch(e){}
	  };
	  
	  window.createpckcolor = function(obj){
	     var self = jQuery(obj);
		 if(!self.attr('id')){
		   self.attr('id','cpick_' + getSurogateID());
		 }
				 
		 self.ColorPicker({
		        onSubmit: function(hsb, hex, rgb, el) {
					jQuery(el).ColorPickerHide();
				},
				onBeforeShow: function () {
					jQuery(obj).ColorPickerSetColor(((jQuery(obj).val().indexOf('#') < 0 && jQuery(obj).val().toLowerCase() != "transparent")?  "#" : "") + jQuery(obj).val());
				},
				onChange: function (hsb, hex, rgb) {
					jQuery(obj).val("#" + hex);
					jQuery(obj).css({'backgroundColor': '#' + hex});
					window.checkColor(jQuery(obj));
	            }
			})
			.keyup(function(){
						    var newVal = ((jQuery(obj).val().indexOf('#') < 0 && jQuery(obj).val().toLowerCase().indexOf("transparent") < 0) ?  "#" : "") + jQuery(obj).val();
                            if(newVal != jQuery(obj).val()){ 							
								jQuery(obj).ColorPickerSetColor(((jQuery(obj).val().indexOf('#') < 0 && jQuery(obj).val().toLowerCase() != "transparent")?  "#" : "") + jQuery(obj).val());
								jQuery(obj).val(newVal);
							}
							if(jQuery(obj).val().toLowerCase().indexOf("transparent") >= 0) jQuery(obj).val(jQuery(obj).val().replace('#',''));
					 });
	     jQuery("#" + jQuery(obj).data('colorpickerId')).mouseleave(function(){jQuery(obj).focus();});
	     jQuery(obj).css('backgroundColor',(((jQuery(obj).val().indexOf('#') < 0 && jQuery(obj).val().toLowerCase() != "transparent")?  "#" : "") + jQuery(obj).val()));
         window.checkColor(jQuery(obj));
	  };
	  
	  jQuery('.pckcolor').each(function(ind){
	     window.createpckcolor(jQuery(this));
	  });
	}
});

var flipcounter = 0;
jQuery(document).ready(function(){

 if(!window.createFlipYesNo){
   window.createFlipYesNo = function(obj){
       flipcounter++;
	   obj = jQuery(obj);
	   if(String(obj.attr('flipcreated')) == "1") return;
	   obj.attr('flipcreated','1');
	   
	   var sHtml = '<ul id="flip' + String(flipcounter) + '" class="flipyesno" style="list-style:none;background: url(' + TADMIN_JOOMLABASE + '/templates/' + TADMIN_TEMPLATE_FOLDER + '/images/ipbutton.png' + ') no-repeat 0 0;width:66px;height:19px;margin:2px 0;padding:0;float:left;overflow:hidden;">' +
		              '<li style="position:relative;left:' + (obj.val() == "1" ? "0px" : "-38px" ) + ';background: url(' + TADMIN_JOOMLABASE + '/templates/' + TADMIN_TEMPLATE_FOLDER + '/images/ipbutton.png' + ') no-repeat 0 -19px;width: 103px;height:19px;margin:0;padding:0;"><span></span></li>' +
		           '</ul>';
	   var flip_obj = jQuery(sHtml);
       flip_obj.insertAfter(obj);	   
       flip_obj.disableSelection();
 	   
	   flip_obj.find('LI').click(function(){
			if( parseInt(jQuery(this).css('left')) == 0){
			  jQuery(this).animate({left:'-38px'},300);
			  obj.val(0);
			}else{
			  jQuery(this).animate({left:'0px'},300);
			  obj.val(1);
			}
	   }).disableSelection(); 
	  
       	  
   };
   
   jQuery('.flipyesno').each(function(ind){
     if(!jQuery(this).closest('.menu_parms_panel')[0])
		window.createFlipYesNo(jQuery(this));
   });
   
 }
});


jQuery(document).ready(function(){

jQuery('.width_value INPUT').each(function(ind){
    var WIDTH_ID = jQuery(this).attr('id');
	jQuery("#width" + WIDTH_ID).slider({
		value:jQuery(this).val(),
		min: 312,
		max: 1872,
		step: 12,
		slide: function( event, ui ) {
			jQuery("#" + WIDTH_ID).val(  ui.value );
			jQuery("#disp" + WIDTH_ID).html( ui.value + "px");
		},
		orientation: "horizontal"
	});
});

});

jQuery(document).ready(function(){
	// making tabs in Menus Settings
	jQuery('div.menusSettingsContainer').hide();
	jQuery('h4.menusSettingsTab').click(function() {
		jQuery(this).next().slideToggle(300);
	});

});

jQuery(document).ready(function(){
	// fixes bug in Firefox
	if(jQuery.browser.mozilla){
		setTimeout(function(){
			jQuery('.LayoutModel *').enableSelection();
		},500);
	}
})		   