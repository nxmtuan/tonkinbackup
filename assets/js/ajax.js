jQuery(document).ready(function($) {
    function loadRooms(paged,postType) {
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
                $('.ajax-wrap').html(response);
            },
            
        });
    }

    $(document).on('click', '.pagination-cus a', function(e) {
        e.preventDefault();
        var paged = $(this).data('paged');
        var postType = $('.pagination-cus').data('post-type');
        loadRooms(paged, postType);
        $('.pagination-cus a').removeClass('active');
        $(this).addClass('active');
    });
});
