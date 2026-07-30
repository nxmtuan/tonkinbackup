jQuery(document).ready(function($) {
    function loadPosts(paged, postType, $target) {
        $.ajax({
            type: 'POST',
            url: ajaxurl.ajaxurl,
            data: {
                action: 'load_rooms',
                paged: paged,
                post_type: postType,
                security: ajaxurl.security,
            },

            success: function(response) {
                $target.html(response);
                $(document).trigger('content:updated', [$target]);
            },
            
        });
    }

    $(document).on('click', '.pagination-cus a', function(e) {
        e.preventDefault();

        if ($(this).closest('.page-item').hasClass('disabled')) {
            return;
        }

        var paged = $(this).data('paged');
        var $pagination = $(this).closest('.pagination-cus');
        var postType = $pagination.data('post-type');
        var $target = $pagination.closest('.container-large').find('.ajax-wrap').first();

        if (!$target.length || !paged) {
            return;
        }

        loadPosts(paged, postType, $target);
        $pagination.find('a').removeClass('active');
        $(this).addClass('active');
    });
});
