<?php

/**
Template Name: Detail route
 */

$route_id = absint(get_query_var('tonkin_route_id'));
if ($route_id <= 0 && isset($_GET['route_id'])) {
    $route_id = absint(wp_unslash($_GET['route_id']));
}
$route_data = array();

if ($route_id > 0 && function_exists('tonkin_get_route_detail')) {
    $route_data = tonkin_get_route_detail($route_id);
}

if (empty($route_data) && function_exists('tonkin_get_routes')) {
    $routes = tonkin_get_routes();
    if (!empty($routes)) {
        $fallback_route = $routes[0];
        if (!empty($fallback_route['id']) && function_exists('tonkin_get_route_detail')) {
            $route_data = tonkin_get_route_detail((int) $fallback_route['id']);
        }

        if (empty($route_data)) {
            $route_data = $fallback_route;
        }
    }
}

$fallback_image = get_stylesheet_directory_uri() . '/assets/images/211129_TDV_15__RESIZED.jpg';

$from_station_name = $route_data['from_station']['name'] ?? ($route_data['from_station']['short_name'] ?? '');
$to_station_name = $route_data['to_station']['name'] ?? ($route_data['to_station']['short_name'] ?? '');

$banner_image = $route_data['banner'] ?? ($route_data['cover'] ?? $fallback_image);

$ticket_collections = (isset($route_data['ticket_collections']) && is_array($route_data['ticket_collections'])) ? $route_data['ticket_collections'] : array();
$schedules = (isset($route_data['schedules']) && is_array($route_data['schedules'])) ? $route_data['schedules'] : array();
$visible_cabin_count = 2;
$has_more_cabins = count($ticket_collections) > $visible_cabin_count;

$destination_title = $route_data['about_the_destination']['title'] ?? ($route_data['title'] ?? ($route_data['name'] ?? 'About The Destination'));
$destination_content = $route_data['about_the_destination']['content'] ?? ($route_data['description'] ?? '');
$destination_image = $route_data['about_the_destination']['image'] ?? ($route_data['banner'] ?? ($route_data['cover'] ?? $fallback_image));
$destination_plain_text = wp_strip_all_tags((string) $destination_content);
$destination_word_matches = array();
preg_match_all('/[\p{L}\p{N}]+/u', $destination_plain_text, $destination_word_matches);
$destination_word_count = !empty($destination_word_matches[0]) ? count($destination_word_matches[0]) : 0;
$destination_preview_word_count = 110;
$has_more_destination_content = $destination_word_count > $destination_preview_word_count;
$destination_preview_content = $has_more_destination_content
    ? wp_trim_words($destination_plain_text, $destination_preview_word_count, '...')
    : $destination_content;

$global_book_link = '#';
if (!empty($schedules[0]['book_link'])) {
    $global_book_link = $schedules[0]['book_link'];
}

$format_minutes = static function ($minutes) {
    $minutes = (int) $minutes;
    if ($minutes <= 0) {
        return '';
    }

    $hours = floor($minutes / 60);
    $remaining_minutes = $minutes % 60;

    if ($hours > 0 && $remaining_minutes > 0) {
        return $hours . ' hrs ' . $remaining_minutes . ' mins';
    }

    if ($hours > 0) {
        return $hours . ' hrs';
    }

    return $remaining_minutes . ' mins';
};

$format_time = static function ($time_value) {
    if (empty($time_value)) {
        return '';
    }

    $time_string = (string) $time_value;
    $date_time = DateTime::createFromFormat('H:i', $time_string);
    if ($date_time instanceof DateTime) {
        return $date_time->format('h:i A');
    }

    return $time_string;
};

get_header();
?>

<main id="page" role="main">
    <section id="slideshow_wrapper">
        <div class="slideshow">
            <div class="slide">
                <!-- Ảnh banner -->
                <div class="slide_image" style="background-image: url('<?php echo esc_url($banner_image); ?>');">
                </div>
            </div>
        </div>
        <!-- <div class="caption_wrapper">
            <div class="caption">
            </div>
        </div> -->

    </section>

    <section class="main-content">
        <div class="container-large">
            <h2 class="the-title flex-content">
                <?php // API field: data.from_station.name (fallback: data.from_station.short_name) ?>
                <?php echo esc_html($from_station_name); ?>
                <svg width="36" height="32" viewBox="0 0 36 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_4002_125)">
                        <path
                            d="M17.7999 0.928028C16.5668 2.16003 16.5668 4.16003 17.7999 5.39203L25.5028 13.088H17.6398C16.0143 13.088 14.7012 14.4 14.7012 16.024C14.7012 17.648 16.0143 18.96 17.6398 18.96H25.4627L17.7999 26.616C16.5668 27.848 16.5668 29.848 17.7999 31.08C19.033 32.312 21.0348 32.312 22.2679 31.08L35.0392 18.32C36.3204 17.04 36.3204 14.976 35.0392 13.696L22.2679 0.928028C21.0348 -0.303972 19.033 -0.303972 17.7999 0.928028Z"
                            fill="#041C2C" />
                        <path
                            d="M5.87722 16.024C5.87722 17.648 4.56406 18.96 2.93861 18.96C1.31317 18.96 0 17.648 0 16.024C0 14.4 1.31317 13.088 2.93861 13.088C4.56406 13.088 5.87722 14.4 5.87722 16.024Z"
                            fill="#041C2C" />
                        <path
                            d="M12.8035 16.024C12.8035 17.648 11.4903 18.96 9.86488 18.96C8.23944 18.96 6.92627 17.648 6.92627 16.024C6.92627 14.4 8.23944 13.088 9.86488 13.088C11.4903 13.088 12.8035 14.4 12.8035 16.024Z"
                            fill="#041C2C" />
                    </g>
                    <defs>
                        <clipPath id="clip0_4002_125">
                            <rect width="36" height="32" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
                <?php // API field: data.to_station.name (fallback: data.to_station.short_name) ?>
                <?php echo esc_html($to_station_name); ?>
            </h2>
            <div id="main_content_wrap" class="container">
                <div class="content-wrapper text-center">
                    <p>Tradition Moves Forwards</p>
                    <p>A new chapter in luxury rail — where heritage glides on polished rails.</p>
                </div>
            </div>
            <div>
                <div class="line-wrapper">
                    <div class="decoration-line"></div>
                    <h3 class="the-sub-title">Our Cabins On This Route</h3>
                    <div class="decoration-line"></div>
                </div>
                <div class="route-cabin-wrapper">
                    <div id="rooms" class="">
                        <div class="inner-route-cabin-wrapper">
                            <?php // Loop source: data.ticket_collections[] ?>
                            <?php if (!empty($ticket_collections)): ?>
                                <?php foreach ($ticket_collections as $cabin_index => $cabin): ?>
                                    <?php
                                    $cabin_cover = !empty($cabin['cover']) ? $cabin['cover'] : $fallback_image;
                                    $cabin_name = $cabin['name'] ?? '';
                                    $cabin_description = $cabin['description'] ?? ($cabin['short_description'] ?? '');
                                    $cabin_description = wp_trim_words(wp_strip_all_tags((string) $cabin_description), 40, '...');
                                    $cabin_link = !empty($cabin['article_link']) ? $cabin['article_link'] : '#';
                                    $cabin_size = $cabin['cabin_size'] ?? '';
                                    $bed_size = $cabin['bed_size'] ?? '';
                                    $restroom_notes = $cabin['restroom_notes'] ?? '';
                                    $is_hidden_cabin = $has_more_cabins && $cabin_index >= $visible_cabin_count;
                                    ?>
                                <div class="single-child-wrap<?php echo $is_hidden_cabin ? ' js-hidden-cabin' : ''; ?>" style="width: 100%;"<?php echo $is_hidden_cabin ? ' hidden' : ''; ?>>
                                    <div class="single-child">
                                        <?php // API field: data.ticket_collections[n].article_link (or route to room detail) ?>
                                        <a class="single-image thumb" href="<?php echo esc_url($cabin_link); ?>">
                                            <?php // API field: data.ticket_collections[n].cover (fallback: local placeholder image) ?>
                                            <img src="<?php echo esc_url($cabin_cover); ?>" alt="<?php echo esc_attr($cabin_name); ?>"
                                                class="img-16-9">
                                        </a>
                                        <div class="single-child-content">
                                            <?php // API field: data.ticket_collections[n].article_link (or route to room detail) ?>
                                            <a href="<?php echo esc_url($cabin_link); ?>" tabindex="-1">
                                                <h2 class="title-section">
                                                    <?php // API field: data.ticket_collections[n].name ?>
                                                    <?php echo esc_html($cabin_name); ?>
                                                </h2>
                                            </a>
                                            <div class="description">
                                                <?php // API field: data.ticket_collections[n].description (fallback: data.ticket_collections[n].short_description) ?>
                                                <?php echo esc_html($cabin_description); ?>
                                            </div>

                                            <div class="room-details">
                                                <div class="item-wrap">
                                                    <div class="item surface">
                                                        <span class="icon">
                                                            <?php echo svg('acreage', '26', '26') ?>
                                                        </span>
                                                        <span class="label">
                                                            <?php // API field: data.ticket_collections[n].cabin_size ?>
                                                            <?php echo esc_html($cabin_size); ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="item-wrap">
                                                    <div class="item bed-type">
                                                        <span class="icon">
                                                            <?php echo svg('bedroom', '28', '28') ?>
                                                        </span>
                                                        <span class="label">
                                                            <?php // API field: data.ticket_collections[n].bed_size ?>
                                                            <?php echo esc_html($bed_size); ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="item-wrap">
                                                    <div class="item view-type">
                                                        <span class="icon">
                                                            <?php echo svg('bathroom', '26', '26') ?>
                                                        </span>
                                                        <span class="label">
                                                            <?php // API field: data.ticket_collections[n].restroom_notes ?>
                                                            <?php echo esc_html($restroom_notes); ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="buttons_container vertical inline_separated">
                                                <?php // API field: data.ticket_collections[n].article_link (button: view more) ?>
                                                <a class="view-more tracking_view_more" href="<?php echo esc_url($cabin_link); ?>" aria-label="">
                                                    <?php _e('View more ', 'kmar'); ?>
                                                </a>
                                                <?php // API field: data.schedules[n].book_link (or a booking endpoint per route/cabin) ?>
                                                <a class="button blue_button" href="<?php echo esc_url($global_book_link); ?>">
                                                    <?php _e('Start Booking', 'gnws') ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p><?php esc_html_e('No cabins available for this route.', 'kmar'); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if ($has_more_cabins): ?>
                        <button type="button" class="view-more tracking_view_more view-all-btn js-view-all-cabins">
                            VIEW ALL CABINS
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <div>
                <div class="line-wrapper">
                    <div class="decoration-line"></div>
                    <h3 class="the-sub-title">Schedule & Operating Hours</h3>
                    <div class="decoration-line"></div>
                </div>

                <div class="schedule-grid">
                    <?php
                    // Loop source (to be replaced): data.schedules[]
                    ?>
                    <?php if (!empty($schedules)): ?>
                        <?php foreach ($schedules as $schedule): ?>
                            <?php
                            $pickup_name = $schedule['pickup_station']['short_name'] ?? ($schedule['pickup_station']['name'] ?? '');
                            $dropoff_name = $schedule['dropoff_station']['short_name'] ?? ($schedule['dropoff_station']['name'] ?? '');

                            $moving_time = $schedule['first_trip']['moving_time'] ?? ($schedule['last_trip']['moving_time'] ?? 0);
                            $duration_label = $format_minutes($moving_time);

                            $first_trip_time = $format_time($schedule['first_trip']['pickup_time'] ?? '');
                            $last_trip_time = $format_time($schedule['last_trip']['pickup_time'] ?? '');

                            $price_value = $schedule['lowest_price_value'] ?? '';
                            $price_type = $schedule['lowest_price_type'] ?? '';
                            $book_link = !empty($schedule['book_link']) ? $schedule['book_link'] : '#';
                            ?>
                        <div class="schedule-card">
                            <div class="schedule-card__header">
                                <?php // API field: data.schedules[n].pickup_station.short_name (fallback: pickup_station.name) ?>
                                <span class="schedule-card__city"><?php echo esc_html($pickup_name); ?></span>
                                <span class="schedule-card__line"></span>
                                <?php // API field: data.schedules[n].first_trip.moving_time / last_trip.moving_time (formatted minutes -> hrs/mins) ?>
                                <span class="schedule-card__duration"><?php echo esc_html($duration_label); ?></span>
                                <span class="schedule-card__line"></span>
                                <?php // API field: data.schedules[n].dropoff_station.short_name (fallback: dropoff_station.name) ?>
                                <span
                                    class="schedule-card__city schedule-card__city--to"><?php echo esc_html($dropoff_name); ?></span>
                            </div>
                            <div class="schedule-card__body">
                                <div class="schedule-card__row">
                                    <span class="schedule-card__label">First trip in a day</span>
                                    <?php // API field: data.schedules[n].first_trip.pickup_time ?>
                                    <span class="schedule-card__time"><?php echo esc_html($first_trip_time); ?></span>
                                </div>
                                <div class="schedule-card__row">
                                    <span class="schedule-card__label">Last trip in a day</span>
                                    <?php // API field: data.schedules[n].last_trip.pickup_time ?>
                                    <span class="schedule-card__time"><?php echo esc_html($last_trip_time); ?></span>
                                </div>
                            </div>
                            <div class="schedule-card__tear"></div>
                            <div class="schedule-card__footer">
                                <div class="schedule-card__price">
                                    <span class="schedule-card__from">From</span>
                                    <?php // API field: data.schedules[n].lowest_price_value ?>
                                    <strong class="schedule-card__amount"><?php echo esc_html($price_value); ?></strong>
                                    <?php // API field: data.schedules[n].lowest_price_type ?>
                                    <span class="schedule-card__unit"><?php echo !empty($price_type) ? esc_html('/' . $price_type) : ''; ?></span>
                                </div>
                                <?php // API field: data.schedules[n].book_link ?>
                                <a href="<?php echo esc_url($book_link); ?>" class="schedule-card__book">Book Now</a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p><?php esc_html_e('No schedule data available for this route.', 'kmar'); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div>
                <div class="line-wrapper">
                    <div class="decoration-line"></div>
                    <h3 class="the-sub-title">About The Destination</h3>
                    <div class="decoration-line"></div>
                </div>

                <div class="destination-block">
                    <div class="destination-block__text">
                        <?php // API field: data.about_the_destination.title ?>
                        <h4 class="destination-block__title"><?php echo esc_html($destination_title); ?></h4>
                        <div class="destination-block__content">
                            <?php if ($has_more_destination_content): ?>
                                <div class="js-destination-preview">
                                    <?php echo wp_kses_post(wpautop($destination_preview_content)); ?>
                                </div>
                                <div class="js-destination-full-content" hidden>
                                    <?php // API field: data.about_the_destination.content (rich text/HTML) ?>
                                    <?php echo wp_kses_post(wpautop($destination_content)); ?>
                                </div>
                            <?php else: ?>
                                <?php // API field: data.about_the_destination.content (rich text/HTML) ?>
                                <?php echo wp_kses_post(wpautop($destination_content)); ?>
                            <?php endif; ?>
                        </div>
                        <?php if ($has_more_destination_content): ?>
                            <button type="button" class="view-more tracking_view_more view-all-btn js-read-more-destination">
                                READ MORE
                            </button>
                        <?php endif; ?>
                    </div>
                    <div class="destination-block__image">
                        <?php // API field: data.about_the_destination.image (fallback: data.banner or data.cover) ?>
                        <img src="<?php echo esc_url($destination_image); ?>"
                            alt="<?php echo esc_attr($destination_title); ?>" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php if ($has_more_cabins || $has_more_destination_content): ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var viewAllButton = document.querySelector('.js-view-all-cabins');
    if (viewAllButton) {
        viewAllButton.addEventListener('click', function () {
            var hiddenCabins = document.querySelectorAll('.js-hidden-cabin');

            hiddenCabins.forEach(function (cabin) {
                cabin.hidden = false;
                cabin.classList.remove('js-hidden-cabin');
            });

            viewAllButton.remove();
        });
    }

    var readMoreButton = document.querySelector('.js-read-more-destination');
    if (readMoreButton) {
        readMoreButton.addEventListener('click', function () {
            var previewContent = document.querySelector('.js-destination-preview');
            var fullContent = document.querySelector('.js-destination-full-content');

            if (previewContent) {
                previewContent.hidden = true;
            }

            if (fullContent) {
                fullContent.hidden = false;
            }

            readMoreButton.remove();
        });
    }
});
</script>
<?php endif; ?>

<?php
get_footer();
