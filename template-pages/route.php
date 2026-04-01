<?php

/**
Template Name: Route
 */

$routes = function_exists('tonkin_get_routes') ? tonkin_get_routes() : array();
$fallback_image = get_stylesheet_directory_uri() . '/assets/images/211129_TDV_15__RESIZED.jpg';
$route_banners = array();

if (!empty($routes)) {
    foreach ($routes as $route) {
        $route_banner = !empty($route['banner']) ? $route['banner'] : $fallback_image;

        $route_banners[] = array(
            'image' => $route_banner,
            'title' => $route['title'] ?? ($route['name'] ?? 'Route'),
        );
    }
}

get_header();
?>

<main id="page" role="main">
    <!-- Banner slider -->
    <section>
        <div id="slideshow_wrapper">
            <div class="slideshow slider_banner">
                <?php if (!empty($route_banners)): ?>
                    <?php foreach ($route_banners as $banner): ?>
                        <div class="slide">
                            <div class="slide_image" style="background-image:url('<?php echo esc_url($banner['image']); ?>');"
                                aria-label="<?php echo esc_attr($banner['title']); ?>">
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="slide">
                        <div class="slide_image" style="background-image:url('<?php echo esc_url($fallback_image); ?>');"
                            aria-label="Route banner">
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php get_template_part('/component/breadcrumb') ?>

    <section class="main-content">
        <div class="container-large">
            <h2 class="the-title">ROUTES</h2>
            <div id="main_content_wrap" class="container">
                <div class="content-wrapper text-center">
                    <p>Tradition Moves Forwards</p>
                    <p>A new chapter in luxury rail — where heritage glides on polished rails.</p>
                </div>
            </div>
            <div class="line-wrapper">
                <div class="decoration-line"></div>
                <h3 class="the-sub-title">Please select one of the below routes</h3>
                <div class="decoration-line"></div>
            </div>
            <div class="route-wrapper">
                <?php if (!empty($routes)): ?>
                    <?php foreach ($routes as $route): ?>
                        <?php
                        $route_id = isset($route['id']) ? (int) $route['id'] : 0;
                        $route_title = $route['title'] ?? ($route['name'] ?? 'Route');

                        $from_station = $route['from_station']['short_name'] ?? ($route['from_station']['name'] ?? '');
                        $to_station = $route['to_station']['short_name'] ?? ($route['to_station']['name'] ?? '');

                        $route_description = $route['short_description'] ?? ($route['description'] ?? '');
                        $route_description = wp_trim_words(wp_strip_all_tags((string) $route_description), 24, '...');

                        $route_image = !empty($route['cover']) ? $route['cover'] : $fallback_image;

                        $route_link = function_exists('tonkin_get_route_permalink')
                            ? tonkin_get_route_permalink($route)
                            : add_query_arg(
                                array(
                                    'route_id' => $route_id,
                                ),
                                home_url('/detail-route/')
                            );
                        ?>
                        <a href="<?php echo esc_url($route_link); ?>" class="item-route-wrapper">
                            <img src="<?php echo esc_url($route_image); ?>" alt="<?php echo esc_attr($route_title); ?>"
                                loading="lazy" class="route-image">
                            <div class="route-destination-wrapper">
                                <div class="route-destination-from">
                                    <?php echo esc_html($from_station); ?>
                                </div>
                                <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_4002_27)">
                                        <path
                                            d="M10.8777 0.579941C10.1241 1.34994 10.1241 2.59994 10.8777 3.36994L15.585 8.17994H10.7798C9.78647 8.17994 8.98398 8.99994 8.98398 10.0149C8.98398 11.0299 9.78647 11.8499 10.7798 11.8499H15.5605L10.8777 16.6349C10.1241 17.4049 10.1241 18.6549 10.8777 19.4249C11.6312 20.1949 12.8545 20.1949 13.6081 19.4249L21.4128 11.4499C22.1957 10.6499 22.1957 9.35994 21.4128 8.55994L13.6081 0.579941C12.8545 -0.190059 11.6312 -0.190059 10.8777 0.579941Z"
                                            fill="white" />
                                        <path
                                            d="M3.59164 10.0151C3.59164 11.0301 2.78915 11.8501 1.79582 11.8501C0.802491 11.8501 0 11.0301 0 10.0151C0 9.00005 0.802491 8.18005 1.79582 8.18005C2.78915 8.18005 3.59164 9.00005 3.59164 10.0151Z"
                                            fill="white" />
                                        <path
                                            d="M7.8243 10.0151C7.8243 11.0301 7.02181 11.8501 6.02848 11.8501C5.03516 11.8501 4.23267 11.0301 4.23267 10.0151C4.23267 9.00005 5.03516 8.18005 6.02848 8.18005C7.02181 8.18005 7.8243 9.00005 7.8243 10.0151Z"
                                            fill="white" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_4002_27">
                                            <rect width="22" height="20" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <div class="route-destination-to"><?php echo esc_html($to_station); ?></div>
                            </div>
                            <div class="route-destination-description">
                                <?php echo esc_html($route_description); ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="content-wrapper text-center">
                        <p>Route data is currently unavailable. Please try again later.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
