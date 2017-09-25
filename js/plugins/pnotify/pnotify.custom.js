/*
PNotify 2.1.0 sciactive.com/pnotify/
(C) 2015 Hunter Perrin
license GPL/LGPL/MPL
*/
/*
 * ====== PNotify ======
 *
 * http://sciactive.com/pnotify/
 *
 * Copyright 2009-2015 Hunter Perrin
 *
 * Triple licensed under the GPL, LGPL, and MPL.
 * 	http://gnu.org/licenses/gpl.html
 * 	http://gnu.org/licenses/lgpl.html
 * 	http://mozilla.org/MPL/MPL-1.1.html
 */

(function (factory) {
    if (typeof exports === 'object' && typeof module !== 'undefined') {
        // CommonJS
        module.exports = factory(require('jquery'));
    } else if (typeof define === 'function' && define.amd) {
        // AMD. Register as a module.
        define('pnotify', ['jquery'], factory);
    } else {
        // Browser globals
        factory(jQuery);
    }
}(function($){
    var default_stack = {
        dir1: "down",
        dir2: "left",
        push: "bottom",
        spacing1: 25,
        spacing2: 25,
        context: $("body")
    };
    
    var posTimer, // Position all timer.
        body,
        jwindow = $(window);
    // Set global variables.
    var do_when_ready = function(){
        body = $("body");
        PNotify.prototype.options.stack.context = body;
        jwindow = $(window);
        // Reposition the notices when the window resizes.
        jwindow.bind('resize', function(){
            if (posTimer) {
                clearTimeout(posTimer);
            }
            posTimer = setTimeout(function(){
                PNotify.positionAll(true);
            }, 10);
        });
    };
    PNotify = function(options){
        this.parseOptions(options);
        this.init();
    };
    $.extend(PNotify.prototype, {
        // The current version of PNotify.
        version: "2.1.0",

        // === Options ===

        // Options defaults.
        options: {
            // The notice's title.
            title: false,
            // Whether to escape the content of the title. (Not allow HTML.)
            title_escape: false,
            // The notice's text.
            text: false,
            // Whether to escape the content of the text. (Not allow HTML.)
            text_escape: false,
            // What styling classes to use. (Can be either "brighttheme", "jqueryui", "bootstrap2", "bootstrap3", or "fontawesome".)
            styling: "brighttheme",
            // Additional classes to be added to the notice. (For custom styling.)
            addclass: "",
            // Class to be added to the notice for corner styling.
            cornerclass: "",
            // Display the notice when it is created.
            auto_display: true,
            // Width of the notice.
            width: "300px",
            // Minimum height of the notice. It will expand to fit content.
            min_height: "16px",
            // Type of the notice. "notice", "info", "success", or "error".
            type: "notice",
            // Set icon to true to use the default icon for the selected
            // style/type, false for no icon, or a string for your own icon class.
            icon: true,
            // Opacity of the notice.
            opacity: 1,
            // The animation to use when displaying and hiding the notice. "none",
            // "show", "fade", and "slide" are built in to jQuery. Others require jQuery
            // UI. Use an object with effect_in and effect_out to use different effects.
            animation: "fade",
            // Speed at which the notice animates in and out. "slow", "def" or "normal",
            // "fast" or number of milliseconds.
            animate_speed: "slow",
            // Specify a specific duration of position animation
            position_animate_speed: 500,
            // Display a drop shadow.
            shadow: true,
            // After a delay, remove the notice.
            hide: true,
            // Delay in milliseconds before the notice is removed.
            delay: 8000,
            // Reset the hide timer if the mouse moves over the notice.
            mouse_reset: true,
            // Remove the notice's elements from the DOM after it is removed.
            remove: true,
            // Change new lines to br tags.
            insert_brs: true,
            // Whether to remove notices from the global array.
            destroy: true,
            // The stack on which the notices will be placed. Also controls the
            // direction the notices stack.
            stack: default_stack
        },

        // === Modules ===

        // This object holds all the PNotify modules. They are used to provide
        // additional functionality.
        modules: {},
        // This runs an event on all the modules.
        runModules: function(event, arg){
            var curArg;
            for (var module in this.modules) {
                curArg = ((typeof arg === "object" && module in arg) ? arg[module] : arg);
                if (typeof this.modules[module][event] === 'function') {
                    this.modules[module][event](this, typeof this.options[module] === 'object' ? this.options[module] : {}, curArg);
                }
            }
        },

        // === Class Variables ===

        state: "initializing", // The state can be "initializing", "opening", "open", "closing", and "closed".
        timer: null, // Auto close timer.
        styles: null,
        elem: null,
        container: null,
        title_container: null,
        text_container: null,
        animating: false, // Stores what is currently being animated (in or out).
        timerHide: false, // Stores whether the notice was hidden by a timer.

        // === Events ===

        init: function(){
            var that = this;

            // First and foremost, we don't want our module objects all referencing the prototype.
            this.modules = {};
            $.extend(true, this.modules, PNotify.prototype.modules);

            // Get our styling object.
            if (typeof this.options.styling === "object") {
                this.styles = this.options.styling;
            } else {
                this.styles = PNotify.styling[this.options.styling];
            }

            // Create our widget.
            // Stop animation, reset the removal timer when the user mouses over.
            this.elem = $("<div />", {
                "class": "ui-pnotify "+this.options.addclass,
                "css": {"display": "none"},
                "aria-live": "assertive",
                "mouseenter": function(e){
                    if (that.options.mouse_reset && that.animating === "out") {
                        if (!that.timerHide) {
                            return;
                        }
                        that.cancelRemove();
                    }
                    // Stop the close timer.
                    if (that.options.hide && that.options.mouse_reset) {
                        that.cancelRemove();
                    }
                },
                "mouseleave": function(e){
                    // Start the close timer.
                    if (that.options.hide && that.options.mouse_reset && that.animating !== "out") {
                        that.queueRemove();
                    }
                    PNotify.positionAll();
                }
            });
            // Create a container for the notice contents.
            this.container = $("<div />", {
                "class": this.styles.container+" ui-pnotify-container "+(this.options.type === "error" ? this.styles.error : (this.options.type === "info" ? this.styles.info : (this.options.type === "success" ? this.styles.success : this.styles.notice))),
                "role": "alert"
            }).appendTo(this.elem);
            if (this.options.cornerclass !== "") {
                this.container.removeClass("ui-corner-all").addClass(this.options.cornerclass);
            }
            // Create a drop shadow.
            if (this.options.shadow) {
                this.container.addClass("ui-pnotify-shadow");
            }


            // Add the appropriate icon.
            if (this.options.icon !== false) {
                $("<div />", {"class": "ui-pnotify-icon"})
                .append($("<span />", {"class": this.options.icon === true ? (this.options.type === "error" ? this.styles.error_icon : (this.options.type === "info" ? this.styles.info_icon : (this.options.type === "success" ? this.styles.success_icon : this.styles.notice_icon))) : this.options.icon}))
                .prependTo(this.container);
            }

            // Add a title.
            this.title_container = $("<h4 />", {
                "class": "ui-pnotify-title"
            })
            .appendTo(this.container);
            if (this.options.title === false) {
                this.title_container.hide();
            } else if (this.options.title_escape) {
                this.title_container.text(this.options.title);
            } else {
                this.title_container.html(this.options.title);
            }

            // Add text.
            this.text_container = $("<div />", {
                "class": "ui-pnotify-text"
            })
            .appendTo(this.container);
            if (this.options.text === false) {
                this.text_container.hide();
            } else if (this.options.text_escape) {
                this.text_container.text(this.options.text);
            } else {
                this.text_container.html(this.options.insert_brs ? String(this.options.text).replace(/\n/g, "<br />") : this.options.text);
            }

            // Set width and min height.
            if (typeof this.options.width === "string") {
                this.elem.css("width", this.options.width);
            }
            if (typeof this.options.min_height === "string") {
                this.container.css("min-height", this.options.min_height);
            }


            // Add the notice to the notice array.
            if (this.options.stack.push === "top") {
                PNotify.notices = $.merge([this], PNotify.notices);
            } else {
                PNotify.notices = $.merge(PNotify.notices, [this]);
            }
            // Now position all the notices if they are to push to the top.
            if (this.options.stack.push === "top") {
                this.queuePosition(false, 1);
            }




            // Mark the stack so it won't animate the new notice.
            this.options.stack.animation = false;

            // Run the modules.
            this.runModules('init');

            // Display the notice.
            if (this.options.auto_display) {
                this.open();
            }
            return this;
        },

        // This function is for updating the notice.
        update: function(options){
            // Save old options.
            var oldOpts = this.options;
            // Then update to the new options.
            this.parseOptions(oldOpts, options);
            // Update the corner class.
            if (this.options.cornerclass !== oldOpts.cornerclass) {
                this.container.removeClass("ui-corner-all "+oldOpts.cornerclass).addClass(this.options.cornerclass);
            }
            // Update the shadow.
            if (this.options.shadow !== oldOpts.shadow) {
                if (this.options.shadow) {
                    this.container.addClass("ui-pnotify-shadow");
                } else {
                    this.container.removeClass("ui-pnotify-shadow");
                }
            }
            // Update the additional classes.
            if (this.options.addclass === false) {
                this.elem.removeClass(oldOpts.addclass);
            } else if (this.options.addclass !== oldOpts.addclass) {
                this.elem.removeClass(oldOpts.addclass).addClass(this.options.addclass);
            }
            // Update the title.
            if (this.options.title === false) {
                this.title_container.slideUp("fast");
            } else if (this.options.title !== oldOpts.title) {
                if (this.options.title_escape) {
                    this.title_container.text(this.options.title);
                } else {
                    this.title_container.html(this.options.title);
                }
                if (oldOpts.title === false) {
                    this.title_container.slideDown(200)
                }
            }
            // Update the text.
            if (this.options.text === false) {
                this.text_container.slideUp("fast");
            } else if (this.options.text !== oldOpts.text) {
                if (this.options.text_escape) {
                    this.text_container.text(this.options.text);
                } else {
                    this.text_container.html(this.options.insert_brs ? String(this.options.text).replace(/\n/g, "<br />") : this.options.text);
                }
                if (oldOpts.text === false) {
                    this.text_container.slideDown(200)
                }
            }
            // Change the notice type.
            if (this.options.type !== oldOpts.type)
                this.container.removeClass(
                    this.styles.error+" "+this.styles.notice+" "+this.styles.success+" "+this.styles.info
                ).addClass(this.options.type === "error" ?
                    this.styles.error :
                    (this.options.type === "info" ?
                        this.styles.info :
                        (this.options.type === "success" ?
                            this.styles.success :
                            this.styles.notice
                        )
                    )
                );
            if (this.options.icon !== oldOpts.icon || (this.options.icon === true && this.options.type !== oldOpts.type)) {
                // Remove any old icon.
                this.container.find("div.ui-pnotify-icon").remove();
                if (this.options.icon !== false) {
                    // Build the new icon.
                    $("<div />", {"class": "ui-pnotify-icon"})
                    .append($("<span />", {"class": this.options.icon === true ? (this.options.type === "error" ? this.styles.error_icon : (this.options.type === "info" ? this.styles.info_icon : (this.options.type === "success" ? this.styles.success_icon : this.styles.notice_icon))) : this.options.icon}))
                    .prependTo(this.container);
                }
            }
            // Update the width.
            if (this.options.width !== oldOpts.width) {
                this.elem.animate({width: this.options.width});
            }
            // Update the minimum height.
            if (this.options.min_height !== oldOpts.min_height) {
                this.container.animate({minHeight: this.options.min_height});
            }
            // Update the opacity.
            if (this.options.opacity !== oldOpts.opacity) {
                this.elem.fadeTo(this.options.animate_speed, this.options.opacity);
            }
            // Update the timed hiding.
            if (!this.options.hide) {
                this.cancelRemove();
            } else if (!oldOpts.hide) {
                this.queueRemove();
            }
            this.queuePosition(true);

            // Run the modules.
            this.runModules('update', oldOpts);
            return this;
        },

        // Display the notice.
        open: function(){
            this.state = "opening";
            // Run the modules.
            this.runModules('beforeOpen');

            var that = this;
            // If the notice is not in the DOM, append it.
            if (!this.elem.parent().length) {
                this.elem.appendTo(this.options.stack.context ? this.options.stack.context : body);
            }
            // Try to put it in the right position.
            if (this.options.stack.push !== "top") {
                this.position(true);
            }
            // First show it, then set its opacity, then hide it.
            if (this.options.animation === "fade" || this.options.animation.effect_in === "fade") {
                // If it's fading in, it should start at 0.
                this.elem.show().fadeTo(0, 0).hide();
            } else {
                // Or else it should be set to the opacity.
                if (this.options.opacity !== 1) {
                    this.elem.show().fadeTo(0, this.options.opacity).hide();
                }
            }
            this.animateIn(function(){
                that.queuePosition(true);

                // Now set it to hide.
                if (that.options.hide) {
                    that.queueRemove();
                }

                that.state = "open";

                // Run the modules.
                that.runModules('afterOpen');
            });

            return this;
        },

        // Remove the notice.
        remove: function(timer_hide) {
            this.state = "closing";
            this.timerHide = !!timer_hide; // Make sure it's a boolean.
            // Run the modules.
            this.runModules('beforeClose');

            var that = this;
            if (this.timer) {
                window.clearTimeout(this.timer);
                this.timer = null;
            }
            this.animateOut(function(){
                that.state = "closed";
                // Run the modules.
                that.runModules('afterClose');
                that.queuePosition(true);
                // If we're supposed to remove the notice from the DOM, do it.
                if (that.options.remove)
                    that.elem.detach();
                // Run the modules.
                that.runModules('beforeDestroy');
                // Remove object from PNotify.notices to prevent memory leak (issue #49)
                // unless destroy is off
                if (that.options.destroy) {
                    if (PNotify.notices !== null) {
                        var idx = $.inArray(that,PNotify.notices);
                        if (idx !== -1) {
                            PNotify.notices.splice(idx,1);
                        }
                    }
                }
                // Run the modules.
                that.runModules('afterDestroy');
            });

            return this;
        },

        // === Class Methods ===

        // Get the DOM element.
        get: function(){
            return this.elem;
        },

        // Put all the options in the right places.
        parseOptions: function(options, moreOptions){
            this.options = $.extend(true, {}, PNotify.prototype.options);
            // This is the only thing that *should* be copied by reference.
            this.options.stack = PNotify.prototype.options.stack;
            var optArray = [options, moreOptions], curOpts;
            for (var curIndex=0; curIndex < optArray.length; curIndex++) {
                curOpts = optArray[curIndex];
                if (typeof curOpts == "undefined") {
                    break;
                }
                if (typeof curOpts !== 'object') {
                    this.options.text = curOpts;
                } else {
                    for (var option in curOpts) {
                        if (this.modules[option]) {
                            // Avoid overwriting module defaults.
                            $.extend(true, this.options[option], curOpts[option]);
                        } else {
                            this.options[option] = curOpts[option];
                        }
                    }
                }
            }
        },

        // Animate the notice in.
        animateIn: function(callback){
            // Declare that the notice is animating in. (Or has completed animating in.)
            this.animating = "in";
            var animation;
            if (typeof this.options.animation.effect_in !== "undefined") {
                animation = this.options.animation.effect_in;
            } else {
                animation = this.options.animation;
            }
            if (animation === "none") {
                this.elem.show();
                callback();
            } else if (animation === "show") {
                this.elem.show(this.options.animate_speed, callback);
            } else if (animation === "fade") {
                this.elem.show().fadeTo(this.options.animate_speed, this.options.opacity, callback);
            } else if (animation === "slide") {
                this.elem.slideDown(this.options.animate_speed, callback);
            } else if (typeof animation === "function") {
                animation("in", callback, this.elem);
            } else {
                this.elem.show(animation, (typeof this.options.animation.options_in === "object" ? this.options.animation.options_in : {}), this.options.animate_speed, callback);
            }
            if (this.elem.parent().hasClass('ui-effects-wrapper')) {
                this.elem.parent().css({
                    "position": "fixed",
                    "overflow": "visible"
                });
            }
            if (animation !== "slide") {
                this.elem.css("overflow", "visible");
            }
            this.container.css("overflow", "hidden");
        },

        // Animate the notice out.
        animateOut: function(callback){
            // Declare that the notice is animating out. (Or has completed animating out.)
            this.animating = "out";
            var animation;
            if (typeof this.options.animation.effect_out !== "undefined") {
                animation = this.options.animation.effect_out;
            } else {
                animation = this.options.animation;
            }
            if (animation === "none") {
                this.elem.hide();
                callback();
            } else if (animation === "show") {
                this.elem.hide(this.options.animate_speed, callback);
            } else if (animation === "fade") {
                this.elem.fadeOut(this.options.animate_speed, callback);
            } else if (animation === "slide") {
                this.elem.slideUp(this.options.animate_speed, callback);
            } else if (typeof animation === "function") {
                animation("out", callback, this.elem);
            } else {
                this.elem.hide(animation, (typeof this.options.animation.options_out === "object" ? this.options.animation.options_out : {}), this.options.animate_speed, callback);
            }
            if (this.elem.parent().hasClass('ui-effects-wrapper')) {
                this.elem.parent().css({
                    "position": "fixed",
                    "overflow": "visible"
                });
            }
            if (animation !== "slide") {
                this.elem.css("overflow", "visible");
            }
            this.container.css("overflow", "hidden");
        },

        // Position the notice. dont_skip_hidden causes the notice to
        // position even if it's not visible.
        position: function(dontSkipHidden){
            // Get the notice's stack.
            var s = this.options.stack,
                e = this.elem;
            if (e.parent().hasClass('ui-effects-wrapper')) {
                e = this.elem.css({
                    "left": "0",
                    "top": "0",
                    "right": "0",
                    "bottom": "0"
                }).parent();
            }
            if (typeof s.context === "undefined") {
                s.context = body;
            }
            if (!s) {
                return;
            }
            if (typeof s.nextpos1 !== "number") {
                s.nextpos1 = s.firstpos1;
            }
            if (typeof s.nextpos2 !== "number") {
                s.nextpos2 = s.firstpos2;
            }
            if (typeof s.addpos2 !== "number") {
                s.addpos2 = 0;
            }
            var hidden = e.css("display") === "none";
            // Skip this notice if it's not shown.
            if (!hidden || dontSkipHidden) {
                var curpos1, curpos2;
                // Store what will need to be animated.
                var animate = {};
                // Calculate the current pos1 value.
                var csspos1;
                switch (s.dir1) {
                    case "down":
                        csspos1 = "top";
                        break;
                    case "up":
                        csspos1 = "bottom";
                        break;
                    case "left":
                        csspos1 = "right";
                        break;
                    case "right":
                        csspos1 = "left";
                        break;
                }
                curpos1 = parseInt(e.css(csspos1).replace(/(?:\..*|[^0-9.])/g, ''));
                if (isNaN(curpos1)) {
                    curpos1 = 0;
                }
                // Remember the first pos1, so the first visible notice goes there.
                if (typeof s.firstpos1 === "undefined" && !hidden) {
                    s.firstpos1 = curpos1;
                    s.nextpos1 = s.firstpos1;
                }
                // Calculate the current pos2 value.
                var csspos2;
                switch (s.dir2) {
                    case "down":
                        csspos2 = "top";
                        break;
                    case "up":
                        csspos2 = "bottom";
                        break;
                    case "left":
                        csspos2 = "right";
                        break;
                    case "right":
                        csspos2 = "left";
                        break;
                }
                curpos2 = parseInt(e.css(csspos2).replace(/(?:\..*|[^0-9.])/g, ''));
                if (isNaN(curpos2)) {
                    curpos2 = 0;
                }
                // Remember the first pos2, so the first visible notice goes there.
                if (typeof s.firstpos2 === "undefined" && !hidden) {
                    s.firstpos2 = curpos2;
                    s.nextpos2 = s.firstpos2;
                }
                // Check that it's not beyond the viewport edge.
                if ((s.dir1 === "down" && s.nextpos1 + e.height() > (s.context.is(body) ? jwindow.height() : s.context.prop('scrollHeight')) ) ||
                    (s.dir1 === "up" && s.nextpos1 + e.height() > (s.context.is(body) ? jwindow.height() : s.context.prop('scrollHeight')) ) ||
                    (s.dir1 === "left" && s.nextpos1 + e.width() > (s.context.is(body) ? jwindow.width() : s.context.prop('scrollWidth')) ) ||
                    (s.dir1 === "right" && s.nextpos1 + e.width() > (s.context.is(body) ? jwindow.width() : s.context.prop('scrollWidth')) ) ) {
                    // If it is, it needs to go back to the first pos1, and over on pos2.
                    s.nextpos1 = s.firstpos1;
                    s.nextpos2 += s.addpos2 + (typeof s.spacing2 === "undefined" ? 25 : s.spacing2);
                    s.addpos2 = 0;
                }
                // Animate if we're moving on dir2.
                if (s.animation && s.nextpos2 < curpos2) {
                    switch (s.dir2) {
                        case "down":
                            animate.top = s.nextpos2+"px";
                            break;
                        case "up":
                            animate.bottom = s.nextpos2+"px";
                            break;
                        case "left":
                            animate.right = s.nextpos2+"px";
                            break;
                        case "right":
                            animate.left = s.nextpos2+"px";
                            break;
                    }
                } else {
                    if (typeof s.nextpos2 === "number") {
                        e.css(csspos2, s.nextpos2+"px");
                    }
                }
                // Keep track of the widest/tallest notice in the column/row, so we can push the next column/row.
                switch (s.dir2) {
                    case "down":
                    case "up":
                        if (e.outerHeight(true) > s.addpos2) {
                            s.addpos2 = e.height();
                        }
                        break;
                    case "left":
                    case "right":
                        if (e.outerWidth(true) > s.addpos2) {
                            s.addpos2 = e.width();
                        }
                        break;
                }
                // Move the notice on dir1.
                if (typeof s.nextpos1 === "number") {
                    // Animate if we're moving toward the first pos.
                    if (s.animation && (curpos1 > s.nextpos1 || animate.top || animate.bottom || animate.right || animate.left)) {
                        switch (s.dir1) {
                            case "down":
                                animate.top = s.nextpos1+"px";
                                break;
                            case "up":
                                animate.bottom = s.nextpos1+"px";
                                break;
                            case "left":
                                animate.right = s.nextpos1+"px";
                                break;
                            case "right":
                                animate.left = s.nextpos1+"px";
                                break;
                        }
                    } else {
                        e.css(csspos1, s.nextpos1+"px");
                    }
                }
                // Run the animation.
                if (animate.top || animate.bottom || animate.right || animate.left) {
                    e.animate(animate, {
                        duration: this.options.position_animate_speed,
                        queue: false
                    });
                }
                // Calculate the next dir1 position.
                switch (s.dir1) {
                    case "down":
                    case "up":
                        s.nextpos1 += e.height() + (typeof s.spacing1 === "undefined" ? 25 : s.spacing1);
                        break;
                    case "left":
                    case "right":
                        s.nextpos1 += e.width() + (typeof s.spacing1 === "undefined" ? 25 : s.spacing1);
                        break;
                }
            }
            return this;
        },
        // Queue the position all function so it doesn't run repeatedly and
        // use up resources.
        queuePosition: function(animate, milliseconds){
            if (posTimer) {
                clearTimeout(posTimer);
            }
            if (!milliseconds) {
                milliseconds = 10;
            }
            posTimer = setTimeout(function(){
                PNotify.positionAll(animate);
            }, milliseconds);
            return this;
        },


        // Cancel any pending removal timer.
        cancelRemove: function(){
            if (this.timer) {
                window.clearTimeout(this.timer);
            }
            if (this.state === "closing") {
                // If it's animating out, animate back in really quickly.
                this.elem.stop(true);
                this.state = "open";
                this.animating = "in";
                this.elem.css("height", "auto").animate({
                    "width": this.options.width,
                    "opacity": this.options.opacity
                }, "fast");
            }
            return this;
        },
        // Queue a removal timer.
        queueRemove: function(){
            var that = this;
            // Cancel any current removal timer.
            this.cancelRemove();
            this.timer = window.setTimeout(function(){
                that.remove(true);
            }, (isNaN(this.options.delay) ? 0 : this.options.delay));
            return this;
        }
    });
    // These functions affect all notices.
    $.extend(PNotify, {
        // This holds all the notices.
        notices: [],
        removeAll: function () {
            $.each(PNotify.notices, function(){
                if (this.remove) {
                    this.remove(false);
                }
            });
        },
        positionAll: function (animate) {
            // This timer is used for queueing this function so it doesn't run
            // repeatedly.
            if (posTimer) {
                clearTimeout(posTimer);
            }
            posTimer = null;
            // Reset the next position data.
            if (PNotify.notices && PNotify.notices.length) {
                $.each(PNotify.notices, function(){
                    var s = this.options.stack;
                    if (!s) {
                        return;
                    }
                    s.nextpos1 = s.firstpos1;
                    s.nextpos2 = s.firstpos2;
                    s.addpos2 = 0;
                    s.animation = animate;
                });
                $.each(PNotify.notices, function(){
                    this.position();
                });
            } else {
                var s = PNotify.prototype.options.stack;
                if (s) {
                    delete s.nextpos1;
                    delete s.nextpos2;
                }
            }
        },
        styling: {
            bootstrap3: {
                container: "alert",
                notice: "alert-warning",
                notice_icon: "oi oi-bullhorn",
                info: "alert-info",
                info_icon: "oi oi-info",
                success: "alert-success",
                success_icon: "oi oi-circle-check",
                error: "alert-danger",
                error_icon: "oi oi-warning"
            }
        }
    });
    /*
     * uses icons from http://fontawesome.io/
     * version 4.0.3
     */
    PNotify.styling.fontawesome = $.extend({}, PNotify.styling.bootstrap3);
    $.extend(PNotify.styling.fontawesome, {
        notice_icon: "fa fa-exclamation-circle",
        info_icon: "fa fa-info",
        success_icon: "fa fa-check",
        error_icon: "fa fa-warning"
    });

    if (document.body) {
        do_when_ready();
    } else {
        $(do_when_ready);
    }
    return PNotify;
}));
// Buttons
// Uses AMD or browser globals for jQuery.
(function (factory) {
    if (typeof exports === 'object' && typeof module !== 'undefined') {
        // CommonJS
        module.exports = factory(require('jquery'), require('pnotify'));
    } else if (typeof define === 'function' && define.amd) {
        // AMD. Register as a module.
        define('pnotify.buttons', ['jquery', 'pnotify'], factory);
    } else {
        // Browser globals
        factory(jQuery, PNotify);
    }
}(function($, PNotify){
    PNotify.prototype.options.buttons = {
        // Provide a button for the user to manually close the notice.
        closer: true,
        // Only show the closer button on hover.
        closer_hover: true,
        // Provide a button for the user to manually stick the notice.
        sticker: true,
        // Only show the sticker button on hover.
        sticker_hover: true,
        // Show the buttons even when the nonblock module is in use.
        show_on_nonblock: false,
        // The various displayed text, helps facilitating internationalization.
        labels: {
            close: "Close",
            stick: "Stick"
        }
    };
    PNotify.prototype.modules.buttons = {
        // This lets us update the options available in the closures.
        myOptions: null,

        closer: null,
        sticker: null,

        init: function(notice, options){
            var that = this;
            this.myOptions = options;
            notice.elem.on({
                "mouseenter": function(e){
                    // Show the buttons.
                    if (that.myOptions.sticker && (!(notice.options.nonblock && notice.options.nonblock.nonblock) || that.myOptions.show_on_nonblock)) {
                        that.sticker.trigger("pnotify_icon").css("visibility", "visible");
                    }
                    if (that.myOptions.closer && (!(notice.options.nonblock && notice.options.nonblock.nonblock) || that.myOptions.show_on_nonblock)) {
                        that.closer.css("visibility", "visible");
                    }
                },
                "mouseleave": function(e){
                    // Hide the buttons.
                    if (that.myOptions.sticker_hover) {
                        that.sticker.css("visibility", "hidden");
                    }
                    if (that.myOptions.closer_hover) {
                        that.closer.css("visibility", "hidden");
                    }
                }
            });

            // Provide a button to stick the notice.
            this.sticker = $("<div />", {
                "class": "ui-pnotify-sticker",
                "css": {
                    "cursor": "pointer",
                    "visibility": options.sticker_hover ? "hidden" : "visible"
                },
                "click": function(){
                    notice.options.hide = !notice.options.hide;
                    if (notice.options.hide) {
                        notice.queueRemove();
                    } else {
                        notice.cancelRemove();
                    }
                    $(this).trigger("pnotify_icon");
                }
            })
            .bind("pnotify_icon", function(){
                $(this).children().removeClass(notice.styles.pin_up+" "+notice.styles.pin_down).addClass(notice.options.hide ? notice.styles.pin_up : notice.styles.pin_down);
            })
            .append($("<span />", {"class": notice.styles.pin_up, "title": options.labels.stick}))
            .prependTo(notice.container);
            if (!options.sticker || (notice.options.nonblock && notice.options.nonblock.nonblock && !options.show_on_nonblock)) {
                this.sticker.css("display", "none");
            }

            // Provide a button to close the notice.
            this.closer = $("<div />", {
                "class": "ui-pnotify-closer",
                "css": {"cursor": "pointer", "visibility": options.closer_hover ? "hidden" : "visible"},
                "click": function(){
                    notice.remove(false);
                    that.sticker.css("visibility", "hidden");
                    that.closer.css("visibility", "hidden");
                }
            })
            .append($("<span />", {"class": notice.styles.closer, "title": options.labels.close}))
            .prependTo(notice.container);
            if (!options.closer || (notice.options.nonblock && notice.options.nonblock.nonblock && !options.show_on_nonblock)) {
                this.closer.css("display", "none");
            }
        },
        update: function(notice, options){
            this.myOptions = options;
            // Update the sticker and closer buttons.
            if (!options.closer || (notice.options.nonblock && notice.options.nonblock.nonblock && !options.show_on_nonblock)) {
                this.closer.css("display", "none");
            } else if (options.closer) {
                this.closer.css("display", "block");
            }
            if (!options.sticker || (notice.options.nonblock && notice.options.nonblock.nonblock && !options.show_on_nonblock)) {
                this.sticker.css("display", "none");
            } else if (options.sticker) {
                this.sticker.css("display", "block");
            }
            // Update the sticker icon.
            this.sticker.trigger("pnotify_icon");
            // Update the hover status of the buttons.
            if (options.sticker_hover) {
                this.sticker.css("visibility", "hidden");
            } else if (!(notice.options.nonblock && notice.options.nonblock.nonblock && !options.show_on_nonblock)) {
                this.sticker.css("visibility", "visible");
            }
            if (options.closer_hover) {
                this.closer.css("visibility", "hidden");
            } else if (!(notice.options.nonblock && notice.options.nonblock.nonblock && !options.show_on_nonblock)) {
                this.closer.css("visibility", "visible");
            }
        }
    };
    $.extend(PNotify.styling.bootstrap3, {
        closer: "oi oi-x",
        pin_up: "oi oi-media-pause",
        pin_down: "oi oi-media-play"
    });
}));
// Callbacks
(function (factory) {
    if (typeof exports === 'object' && typeof module !== 'undefined') {
        // CommonJS
        module.exports = factory(require('jquery'), require('pnotify'));
    } else if (typeof define === 'function' && define.amd) {
        // AMD. Register as a module.
        define('pnotify.callbacks', ['jquery', 'pnotify'], factory);
    } else {
        // Browser globals
        factory(jQuery, PNotify);
    }
}(function($, PNotify){
    var _init   = PNotify.prototype.init,
        _open   = PNotify.prototype.open,
        _remove = PNotify.prototype.remove;
    PNotify.prototype.init = function(){
        if (this.options.before_init) {
            this.options.before_init(this.options);
        }
        _init.apply(this, arguments);
        if (this.options.after_init) {
            this.options.after_init(this);
        }
    };
    PNotify.prototype.open = function(){
        var ret;
        if (this.options.before_open) {
            ret = this.options.before_open(this);
        }
        if (ret !== false) {
            _open.apply(this, arguments);
            if (this.options.after_open) {
                this.options.after_open(this);
            }
        }
    };
    PNotify.prototype.remove = function(timer_hide){
        var ret;
        if (this.options.before_close) {
            ret = this.options.before_close(this, timer_hide);
        }
        if (ret !== false) {
            _remove.apply(this, arguments);
            if (this.options.after_close) {
                this.options.after_close(this, timer_hide);
            }
        }
    };
}));
// Confirm
(function (factory) {
    if (typeof exports === 'object' && typeof module !== 'undefined') {
        // CommonJS
        module.exports = factory(require('jquery'), require('pnotify'));
    } else if (typeof define === 'function' && define.amd) {
        // AMD. Register as a module.
        define('pnotify.confirm', ['jquery', 'pnotify'], factory);
    } else {
        // Browser globals
        factory(jQuery, PNotify);
    }
}(function($, PNotify){
    PNotify.prototype.options.confirm = {
        // Make a confirmation box.
        confirm: false,
        // Make a prompt.
        prompt: false,
        // Classes to add to the input element of the prompt.
        prompt_class: "",
        // The default value of the prompt.
        prompt_default: "",
        // Whether the prompt should accept multiple lines of text.
        prompt_multi_line: false,
        // Where to align the buttons. (right, center, left, justify)
        align: "right",
        // The buttons to display, and their callbacks.
        buttons: [
            {
                text: "Ok",
                addClass: "",
                // Whether to trigger this button when the user hits enter in a single line prompt.
                promptTrigger: true,
                click: function(notice, value){
                    notice.remove();
                    notice.get().trigger("pnotify.confirm", [notice, value]);
                }
            },
            {
                text: "Cancel",
                addClass: "",
                click: function(notice){
                    notice.remove();
                    notice.get().trigger("pnotify.cancel", notice);
                }
            }
        ]
    };
    PNotify.prototype.modules.confirm = {
        // The div that contains the buttons.
        container: null,
        // The input element of a prompt.
        prompt: null,

        init: function(notice, options){
            this.container = $('<div style="margin-top:5px;clear:both;" />').css('text-align', options.align).appendTo(notice.container);

            if (options.confirm || options.prompt)
                this.makeDialog(notice, options);
            else
                this.container.hide();
        },

        update: function(notice, options){
            if (options.confirm) {
                this.makeDialog(notice, options);
                this.container.show();
            } else {
                this.container.hide().empty();
            }
        },

        afterOpen: function(notice, options){
            if (options.prompt)
                this.prompt.focus();
        },

        makeDialog: function(notice, options) {
            var already = false, that = this, btn, elem;
            this.container.empty();
            if (options.prompt) {
                this.prompt = $('<'+(options.prompt_multi_line ? 'textarea rows="5"' : 'input type="text"')+' style="margin-bottom:5px;clear:both;" />')
                .addClass(notice.styles.input+' '+options.prompt_class)
                .val(options.prompt_default)
                .appendTo(this.container);
            }
            for (var i in options.buttons) {
                btn = options.buttons[i];
                if (already)
                    this.container.append(' ');
                else
                    already = true;
                elem = $('<button type="button" />')
                .addClass(notice.styles.btn+' '+btn.addClass)
                .text(btn.text)
                .appendTo(this.container)
                .on("click", (function(btn){ return function(){
                    if (typeof btn.click == "function") {
                        btn.click(notice, options.prompt ? that.prompt.val() : null);
                    }
                }})(btn));
                if (options.prompt && !options.prompt_multi_line && btn.promptTrigger)
                    this.prompt.keypress((function(elem){ return function(e){
                        if (e.keyCode == 13)
                            elem.click();
                    }})(elem));
                if (notice.styles.text) {
                    elem.wrapInner('<span class="'+notice.styles.text+'"></span>');
                }
                if (notice.styles.btnhover) {
                    elem.hover((function(elem){ return function(){
                        elem.addClass(notice.styles.btnhover);
                    }})(elem), (function(elem){ return function(){
                        elem.removeClass(notice.styles.btnhover);
                    }})(elem));
                }
                if (notice.styles.btnactive) {
                    elem.on("mousedown", (function(elem){ return function(){
                        elem.addClass(notice.styles.btnactive);
                    }})(elem)).on("mouseup", (function(elem){ return function(){
                        elem.removeClass(notice.styles.btnactive);
                    }})(elem));
                }
                if (notice.styles.btnfocus) {
                    elem.on("focus", (function(elem){ return function(){
                        elem.addClass(notice.styles.btnfocus);
                    }})(elem)).on("blur", (function(elem){ return function(){
                        elem.removeClass(notice.styles.btnfocus);
                    }})(elem));
                }
            }
        }
    };
    $.extend(PNotify.styling.bootstrap3, {
        btn: "btn btn-default",
        input: "form-control"
    });
}));
// Desktop
(function (factory) {
    if (typeof exports === 'object' && typeof module !== 'undefined') {
        // CommonJS
        module.exports = factory(require('jquery'), require('pnotify'));
    } else if (typeof define === 'function' && define.amd) {
        // AMD. Register as a module.
        define('pnotify.desktop', ['jquery', 'pnotify'], factory);
    } else {
        // Browser globals
        factory(jQuery, PNotify);
    }
}(function($, PNotify){
    var permission;
    var notify = function(title, options){
        // Memoize based on feature detection.
        if ("Notification" in window) {
            notify = function (title, options) {
                return new Notification(title, options);
            };
        } else if ("mozNotification" in navigator) {
            notify = function (title, options) {
                // Gecko < 22
                return navigator.mozNotification
                    .createNotification(title, options.body, options.icon)
                    .show();
            };
        } else if ("webkitNotifications" in window) {
            notify = function (title, options) {
                return window.webkitNotifications.createNotification(
                    options.icon,
                    title,
                    options.body
                );
            };
        } else {
            notify = function (title, options) {
                return null;
            };
        }
        return notify(title, options);
    };


    PNotify.prototype.options.desktop = {
        // Display the notification as a desktop notification.
        desktop: false,
        // If desktop notifications are not supported or allowed, fall back to a regular notice.
        fallback: true,
        // The URL of the icon to display. If false, no icon will show. If null, a default icon will show.
        icon: null,
        // Using a tag lets you update an existing notice, or keep from duplicating notices between tabs.
        // If you leave tag null, one will be generated, facilitating the "update" function.
        // see: http://www.w3.org/TR/notifications/#tags-example
        tag: null
    };
    PNotify.prototype.modules.desktop = {
        tag: null,
        icon: null,
        genNotice: function(notice, options){
            if (options.icon === null) {
                this.icon = "http://sciactive.com/pnotify/includes/desktop/"+notice.options.type+".png";
            } else if (options.icon === false) {
                this.icon = null;
            } else {
                this.icon = options.icon;
            }
            if (this.tag === null || options.tag !== null) {
                this.tag = options.tag === null ? "PNotify-"+Math.round(Math.random() * 1000000) : options.tag;
            }
            notice.desktop = notify(notice.options.title, {
                icon: this.icon,
                body: notice.options.text,
                tag: this.tag
            });
            if (!("close" in notice.desktop) && ("cancel" in notice.desktop)) {
                notice.desktop.close = function(){
                    notice.desktop.cancel();
                };
            }
            notice.desktop.onclick = function(){
                notice.elem.trigger("click");
            };
            notice.desktop.onclose = function(){
                if (notice.state !== "closing" && notice.state !== "closed") {
                    notice.remove();
                }
            };
        },
        init: function(notice, options){
            if (!options.desktop)
                return;
            permission = PNotify.desktop.checkPermission();
            if (permission !== 0) {
                // Keep the notice from opening if fallback is false.
                if (!options.fallback) {
                    notice.options.auto_display = false;
                }
                return;
            }
            this.genNotice(notice, options);
        },
        update: function(notice, options, oldOpts){
            if ((permission !== 0 && options.fallback) || !options.desktop)
                return;
            this.genNotice(notice, options);
        },
        beforeOpen: function(notice, options){
            if ((permission !== 0 && options.fallback) || !options.desktop)
                return;
            notice.elem.css({'left': '-10000px', 'display': 'none'});
        },
        afterOpen: function(notice, options){
            if ((permission !== 0 && options.fallback) || !options.desktop)
                return;
            notice.elem.css({'left': '-10000px', 'display': 'none'});
            if ("show" in notice.desktop) {
                notice.desktop.show();
            }
        },
        beforeClose: function(notice, options){
            if ((permission !== 0 && options.fallback) || !options.desktop)
                return;
            notice.elem.css({'left': '-10000px', 'display': 'none'});
        },
        afterClose: function(notice, options){
            if ((permission !== 0 && options.fallback) || !options.desktop)
                return;
            notice.elem.css({'left': '-10000px', 'display': 'none'});
            if ("close" in notice.desktop) {
                notice.desktop.close();
            }
        }
    };
    PNotify.desktop = {
        permission: function(){
            if (typeof Notification !== "undefined" && "requestPermission" in Notification) {
                Notification.requestPermission();
            } else if ("webkitNotifications" in window) {
                window.webkitNotifications.requestPermission();
            }
        },
        checkPermission: function(){
            if (typeof Notification !== "undefined" && "permission" in Notification) {
                return (Notification.permission === "granted" ? 0 : 1);
            } else if ("webkitNotifications" in window) {
                return window.webkitNotifications.checkPermission() == 0 ? 0 : 1;
            } else {
                return 1;
            }
        }
    };
    permission = PNotify.desktop.checkPermission();
}));
// Mobile
(function (factory) {
    if (typeof exports === 'object' && typeof module !== 'undefined') {
        // CommonJS
        module.exports = factory(require('jquery'), require('pnotify'));
    } else if (typeof define === 'function' && define.amd) {
        // AMD. Register as a module.
        define('pnotify.mobile', ['jquery', 'pnotify'], factory);
    } else {
        // Browser globals
        factory(jQuery, PNotify);
    }
}(function($, PNotify){

}));


// Stacks
var stack_topleft = {"dir1": "down", "dir2": "right", "push": "top"};
var stack_bottomleft = {"dir1": "right", "dir2": "up", "push": "top"};
var stack_custom = {"dir1": "right", "dir2": "down"};
var stack_custom2 = {"dir1": "left", "dir2": "up", "push": "top"};
var stack_bar_top = {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0};
var stack_bar_bottom = {"dir1": "up", "dir2": "right", "spacing1": 0, "spacing2": 0};
/*********** Positioned Stack ***********
 * This stack is initially positioned through code instead of CSS.
 * This is done through two extra variables. firstpos1 and firstpos2
 * are pixel values, relative to a viewport edge. dir1 and dir2,
 * respectively, determine which edge. It is calculated as follows:
 *
 * - dir = "up" - firstpos is relative to the bottom of viewport.
 * - dir = "down" - firstpos is relative to the top of viewport.
 * - dir = "right" - firstpos is relative to the left of viewport.
 * - dir = "left" - firstpos is relative to the right of viewport.
 */
var stack_bottomright = {"dir1": "up", "dir2": "left", "firstpos1": 25, "firstpos2": 25};

// Default to bootstrap3 styling
PNotify.prototype.options.styling = "bootstrap3";