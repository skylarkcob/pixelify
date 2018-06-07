/* ------------------------------------------------------------------------ */
/* Javascripts
 /* ------------------------------------------------------------------------ */

(function ($) {

    $(document).ready(function () {
        "use strict";

        $(".ap-form-field-wrapper .label-wrap label:contains('Google Captcha')").css("display", "none");

        jQuery('.searchform.on-menu i').each(function () {
            var $currSearchIcon = jQuery(this);
            var $currInput = $currSearchIcon.siblings('input');
            $currSearchIcon.click(function () {
                var $currInput = jQuery(this).siblings('input');
                if (jQuery('body').hasClass('search-opened')) {
                    $currInput.focusout();
                } else {
                    $currInput.focus().select();
                }
            });
            $currInput.focus(function () {
                jQuery('body').addClass('search-opened');
            });
            $currInput.focusout(function () {
                jQuery('body').removeClass('search-opened');
            });
        });


        // Floating Share
        $("body.single-post").floatingSocialShare({
            place: "top-left",
            buttons: ["pinterest", "facebook", "twitter", "google-plus"],
            twitter_counter: false,
            counter: false,
            title: document.title,
            url: window.location.href,
            text: "Share with: ",
            description: $('meta[name="description"]').attr("content"),
            media: $('meta[property="og:image"]').attr("content") || "",
            popup_width: 600,
            popup_height: 455
        });

        $(window).scroll(function () {
            var fssTopLeft = $("#floatingSocialShare").find(".top-left");
            var threshold = 550; // number of pixels before bottom of page that you want to start fading
            var op = (($(document).height() - $(window).height()) - $(window).scrollTop()) / threshold;
            if (op <= 0) {
                fssTopLeft.hide();
            } else {
                fssTopLeft.show();
            }
            fssTopLeft.css("opacity", op);
        });

        // Sticky Widget
        jQuery('.sidebar').theiaStickySidebar({
            // Settings
            additionalMarginTop: 80
        });

        // Search Animation
        $('.search-open, .search-close').on('click', function (e) {
            e.preventDefault();
            $('.header-search ').toggleClass('open-search');
            $('.header-search').toggleClass('open');
            $(this).find($(".fa")).toggleClass('fa-times');
        });

        // Move Image in Post
        $('.single .post .entry-body .col-sm-8 p').has('img').addClass('image');
        $('.single .post .entry-body .col-sm-8 p.image').appendTo('.single .post .entry-image.standart');
        $('.entry-body .col-sm-8 p:empty').remove();

        // Slideshow
        $("#owl-demo").owlCarousel({
            navigation: true,
            navigationText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
            pagination: false,
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,
            autoHeight: true
        });

        $("#featured-slide").owlCarousel({
            navigation: false,
            pagination: true,
            autoPlay: false,
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,
            autoHeight: true
        });

        // Tab Content
        $(".tab_content").hide(); //Hide all content
        $(".tabs_links ul li:first").addClass("active").show(); //Activate first tab
        $(".tab_content:first").show(); //Show first tab content
        //On Click Event
        $(".tabs_links ul li").click(function () {
            $(".tabs_links ul li").removeClass("active"); //Remove any "active" class
            $(this).addClass("active"); //Add "active" class to selected tab
            $(".tab_content").hide(); //Hide all tab content
            var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
            $(activeTab).fadeIn(); //Fade in the active content
            return false;
        });

        // navigation
        $('.fdr-menu ul.sf-menu').superfish({
            delay: 10,
            animation: {
                opacity: 'show',
                height: 'show'
            },
            speed: 'fast',
            autoArrows: false,
            dropShadows: false
        });

        // Mobile Menu Action
        jQuery('.mobile-menu-icon').click(function () {
            if (jQuery(this).hasClass('active')) {
                jQuery(this).removeClass('active');
                jQuery('body').removeClass('show-mobile-menu');
            } else {
                jQuery(this).addClass('active');
                jQuery('body').addClass('show-mobile-menu');
            }
            return false;
        });

        jQuery('.fdr-mobile-menu>i').click(function () {
            jQuery('.mobile-menu-icon.active').click();
        });

        // Mobile Menu - Sub Menu Action
        jQuery('.fdr-mobile-menu>nav ul.sub-menu').each(function () {
            var $subMenu = jQuery(this);
            var $parMenuLink = $subMenu.siblings('a');
            $parMenuLink.click(function (e) {
                e.preventDefault();
                var $parMenu = jQuery(this).closest('li');
                $parMenu.siblings('li.menu-open').removeClass('menu-open').children('.sub-menu').slideUp('fast');
                $parMenu.toggleClass('menu-open');
                if ($parMenu.hasClass('menu-open')) {
                    $parMenu.children('.sub-menu').slideDown('fast');
                } else {
                    $parMenu.children('.sub-menu').slideUp('fast');
                }
                return false;
            });
        });

        // Modal
        $('[data-toggle=modal]').on('click', function () {
            var $target = $($(this).data('target'));
            $target.data('triggered', true);
            setTimeout(function () {
                if ($target.data('triggered')) {
                    $target.modal('show').data('triggered', false);
                }
            }, 1000); // milliseconds
            return false;
        });

        $('#myModal').on('show.bs.modal', function () {
            $('#download')[0].click();
        });

        // Mailchimp Validation
        ajaxMailChimpForm($("#subscribe-form"), $("#subscribe-result"));
        // Turn the given MailChimp form into an ajax version of it.
        // If resultElement is given, the subscribe result is set as html to
        // that element.
        function ajaxMailChimpForm($form, $resultElement) {
            // Hijack the submission. We'll submit the form manually.
            $form.submit(function (e) {
                e.preventDefault();
                if (!isValidEmail($form)) {
                    var error = "A valid email address must be provided.";
                    $resultElement.html(error);
                    $resultElement.css("color", "red");
                } else {
                    $resultElement.css("color", "black");
                    $resultElement.html("Subscribing...");
                    submitSubscribeForm($form, $resultElement);
                }
            });
        }

        // Validate the email address in the form
        function isValidEmail($form) {
            // If email is empty, show error message.
            // contains just one @
            var email = $form.find("input[type='email']").val();
            if (!email || !email.length) {
                return false;
            } else if (email.indexOf("@") == -1) {
                return false;
            }
            return true;
        }

        // Submit the form with an ajax/jsonp request.
        // Based on http://stackoverflow.com/a/15120409/215821
        function submitSubscribeForm($form, $resultElement) {
            $.ajax({
                type: "GET",
                url: $form.attr("action"),
                data: $form.serialize(),
                cache: false,
                dataType: "jsonp",
                jsonp: "c", // trigger MailChimp to return a JSONP response
                contentType: "application/json; charset=utf-8",
                error: function (error) {
                    // According to jquery docs, this is never called for cross-domain JSONP requests
                },
                success: function (data) {
                    if (data.result != "success") {
                        var message = data.msg || "Sorry. Unable to subscribe. Please try again later.";
                        $resultElement.css("color", "red");
                        if (data.msg && data.msg.indexOf("already subscribed") >= 0) {
                            message = "You're already subscribed. Thank you.";
                            $resultElement.css("color", "black");
                        }
                        $resultElement.html(message);
                    } else {
                        $resultElement.css("color", "black");
                        $resultElement.html("Thank you!<br>You must confirm the subscription in your inbox.");
                    }
                }
            });
        }

        // Download formatting number
        function numberWithCommas(number) {
            var parts = number.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return parts.join(".");
        }

        $(document).ready(function () {
            $(".download-counter .download-total").each(function () {
                var num = $(this).text();
                var commaNum = numberWithCommas(num);
                $(this).text(commaNum);
            });
        });


        // Search form

        var resizing = false,
            navigationWrapper = $('.top-header'),
            navigation = navigationWrapper.children('.primary-menu'),
            searchForm = $('.monstr-main-search'),
            pageContent = $('.site-content'),
            searchTrigger = $('.monstr-search-trigger'),
            coverLayer = $('.monstr-cover-layer'),
            navigationTrigger = $('.monstr-nav-trigger'),
            mainHeader = $('.site-header');

        function checkWindowWidth() {
            return window.getComputedStyle(mainHeader.get(0), '::before').getPropertyValue('content').replace(/"/g, '').replace(/'/g, "");
        }

        function checkResize() {
            if (!resizing) {
                resizing = true;
                (!window.requestAnimationFrame) ? setTimeout(moveNavigation, 300) : window.requestAnimationFrame(moveNavigation);
            }
        }

        function moveNavigation() {
            var screenSize = checkWindowWidth();
            if (screenSize == 'desktop' && (navigationTrigger.siblings('.monstr-main-search').length == 0)) {
                //desktop screen - insert navigation and search form inside <header>
                searchForm.detach().insertBefore(navigationTrigger);
                navigationWrapper.detach().insertBefore(searchForm).find('.monstr-serch-wrapper').remove();
            } else if (screenSize == 'mobile' && !(mainHeader.children('.top-header').length == 0)) {
                //mobile screen - move navigation and search form after .site-content element
                navigationWrapper.detach().insertAfter('.site-content');
                var newListItem = $('<li class="monstr-serch-wrapper"></li>');
                searchForm.detach().appendTo(newListItem);
                newListItem.appendTo(navigation);
            }

            resizing = false;
        }

        function closeSearchForm() {
            searchTrigger.removeClass('search-form-visible');
            searchForm.removeClass('is-visible');
            coverLayer.removeClass('search-form-visible');
        }

        //add the .no-pointerevents class to the <html> if browser doesn't support pointer-events property
        ( !Modernizr.testProp('pointerEvents') ) && $('html').addClass('no-pointerevents');

        //move navigation and search form elements according to window width
        moveNavigation();
        $(window).on('resize', checkResize);

        //mobile version - open/close navigation
        navigationTrigger.on('click', function (event) {
            event.preventDefault();
            mainHeader.add(navigation).add(pageContent).toggleClass('nav-is-visible');
        });

        searchTrigger.on('click', function (event) {
            event.preventDefault();
            if (searchTrigger.hasClass('search-form-visible')) {
                searchForm.find('form').submit();
            } else {
                searchTrigger.addClass('search-form-visible');
                coverLayer.addClass('search-form-visible');
                searchForm.addClass('is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
                    searchForm.find('input[type="search"]').focus().end().off('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend');
                });
            }
        });

        //close search form
        searchForm.on('click', '.close', function () {
            closeSearchForm();
        });

        coverLayer.on('click', function () {
            closeSearchForm();
        });

        $(document).keyup(function (event) {
            if (event.which == '27') closeSearchForm();
        });

        //upadate span.selected-value text when user selects a new option
        searchForm.on('change', 'select', function () {
            searchForm.find('.selected-value').text($(this).children('option:selected').text());
        });

        $("#form-filter").find("input").on("change", function () {
            $(this).closest("form").submit();
        });
    });

})(jQuery);