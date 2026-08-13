jQuery(document).ready(function($) {
    function getTermId(filterValue) {
        var match = (filterValue || '').match(/^\.filter_(\d+)$/);
        return match ? parseInt(match[1], 10) : 0;
    }

    function loadPosts(paged, postType, $target, termId) {
        $.ajax({
            type: 'POST',
            url: ajaxurl.ajaxurl,
            data: {
                action: 'load_rooms',
                paged: paged,
                post_type: postType,
                term_id: termId || 0,
                security: ajaxurl.security,
            },

            success: function(response) {
                if (!response.success) {
                    return;
                }

                $target.html(response.data.html);
                $target.closest('.container-large').children('nav[aria-label="Page navigation"]').remove();
                if (response.data.pagination) {
                    $target.after(response.data.pagination);
                }
                $(document).trigger('content:updated', [$target]);
            },
            
        });
    }

    function getListingForFilter($filter) {
        return $filter.closest('.filter_wrapper').nextAll('.children').first();
    }

    function getActiveFilterForListing($listing) {
        return $listing.prevAll('.filter_wrapper').first()
            .find('.filter_container a.active').attr('data-category') || '.all-items';
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
        var $listing = $pagination.closest('.children');
        var filterValue = getActiveFilterForListing($listing);

        if (!$target.length || !paged) {
            return;
        }

        loadPosts(paged, postType, $target, getTermId(filterValue));
        $pagination.find('a').removeClass('active');
        $(this).addClass('active');
    });

    $(document).on('click', '.filter_wrapper .filter_container a', function(e) {
        e.preventDefault();

        var $filter = $(this);
        var $listing = getListingForFilter($filter);
        var $pagination = $listing.find('.pagination-cus').first();
        var $target = $listing.find('.ajax-wrap').first();
        var postType = $pagination.data('post-type') || $listing.data('post-type');

        if (!$target.length || !postType) {
            return;
        }

        $filter.siblings().removeClass('active');
        $filter.addClass('active');
        loadPosts(1, postType, $target, getTermId($filter.attr('data-category')));
    });

    $(document).on('change', '.filter_wrapper .filter-wrap-mobile select', function() {
        var $listing = getListingForFilter($(this));
        var $pagination = $listing.find('.pagination-cus').first();
        var $target = $listing.find('.ajax-wrap').first();
        var postType = $pagination.data('post-type') || $listing.data('post-type');

        if (!$target.length || !postType) {
            return;
        }

        loadPosts(1, postType, $target, getTermId($(this).val()));
    });
});
