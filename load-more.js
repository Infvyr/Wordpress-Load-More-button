let page = 2;
jQuery(function($) {
    $('body').on('click', '.loadmore', function() {
        const data = {
            'action': 'load_posts_by_ajax',
            'page': page,
            'security': blog.security
        };

        $.post(blog.ajaxurl, data, function(response) {
            if($.trim(response) != '') {
                $('.posts-grid').append(response);
                page++;
            } else {
                $('.loadmore').hide();
            }
        });
    });
});
