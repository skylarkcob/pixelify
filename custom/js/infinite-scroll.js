(function ($) {
    var is;
    is = {
        init: function () {
            var body = $("body"),
                prefix = ["popular", "recent", "exclusive"];

            $(document).ready(function () {
                var count = 1;
                prefix.forEach(function (key) {
                    var pagination = $('body .' + key + '-pagination');

                    if (pagination.length) {
                        pagination.before('<div id="sb-infinite-scroll-load-more-' + count + '" class="sb-infinite-scroll-load-more btn "><a data-sb-processing="0">' + ajax_var.text.show_me_more + '</a><br class="sb-clear" /></div>');
                        pagination.addClass('sb-hide');

                        $('body .' + key + '-post-item').addClass('sb-added');

                        body.on('click', '#sb-infinite-scroll-load-more-' + count + ' a', function (e) {
                            e.preventDefault();
                            var element = $(this),
                                container = element.parent(),
                                nextPage = pagination.find('a.next');

                            if (nextPage.length) {
                                element.attr('data-sb-processing', 1);
                                var href = nextPage.attr('href');

                                container.hide();

                                pagination.before('<div id="sb-infinite-scroll-loader-' + count + '" class="sb-infinite-scroll-loader"><img src="' + ajax_var.loading + '" alt="" /><span>' + ajax_var.text.loading + '</span></div>');

                                $.get(href, function (response) {
                                    pagination.html($(response).find('.' + key + '-pagination').html());

                                    $(response).find('.' + key + '-post .' + key + '-post-item').each(function () {
                                        $('body .' + key + '-post .' + key + '-post-item:last').after($(this));
                                    });

                                    $('#sb-infinite-scroll-loader-' + count).remove();

                                    container.show();

                                    element.attr('data-sb-processing', 0);

                                    $('body .' + key + '-post-item').not('.sb-added').addClass('animated fadeIn').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                                        $(this).removeClass('animated fadeIn').addClass('sb-added');
                                    });
                                });
                            } else {
                                container.addClass('finished').removeClass('sb-hide');
                                element.show().html(ajax_var.text.no_more_posts_available).css('cursor', 'default');
                            }
                        });
                    }

                    count++;
                });
            });
        }
    };
    is.init();

})(jQuery);