<?php

/**
 * Tonkin Heritage API Helper Functions
 *
 * @package kmar
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get a raw API setting value from ACF options.
 *
 * Falls back to the stored WordPress option to avoid calling ACF too early.
 *
 * @param string $field_name Field name registered in ACF.
 * @param string $default    Default value when the field is empty.
 * @return string
 */
function tonkin_get_api_setting($field_name, $default = '')
{
    $value = '';

    if (function_exists('get_field') && did_action('acf/init')) {
        $value = get_field($field_name, 'option');
    }

    if (empty($value)) {
        $value = get_option('options_' . $field_name, $default);
    }

    if (!is_string($value)) {
        return $default;
    }

    $value = trim($value);

    return $value !== '' ? $value : $default;
}

/**
 * Get the configured API base URL.
 *
 * @return string
 */
function tonkin_get_api_base_url()
{
    return untrailingslashit(tonkin_get_api_setting('api_url'));
}

/**
 * Get shared API auth payload.
 *
 * @return array
 */
function tonkin_get_api_auth_body()
{
    return array(
        'username' => tonkin_get_api_setting('api_username'),
        'password' => tonkin_get_api_setting('api_password'),
    );
}

/**
 * Get API token from Tonkin Heritage API
 * Token is cached for 24 hours
 * 
 * @return string|false The Bearer token or false on failure
 */
function tonkin_get_api_token()
{
    $api_base_url = tonkin_get_api_base_url();
    $auth_body    = tonkin_get_api_auth_body();

    if (empty($api_base_url) || empty($auth_body['username']) || empty($auth_body['password'])) {
        error_log('Tonkin API Token Error: Missing API settings in ACF options');
        return false;
    }

    // Check if token is cached
    $cached_token = get_transient('tonkin_api_token');
    if ($cached_token) {
        return $cached_token;
    }

    // Use POST method with username and password
    $response = wp_remote_post($api_base_url . '/token', array(
        'headers' => array(
            'Accept' => 'application/json',
        ),
        'body' => $auth_body,
        'timeout' => 30,
        'sslverify' => false, // Disable SSL verification for local development
    ));

    if (is_wp_error($response)) {
        error_log('Tonkin API Token Error: ' . $response->get_error_message());
        return false;
    }

    $http_code = wp_remote_retrieve_response_code($response);
    if ($http_code !== 200) {
        error_log('Tonkin API Token Error: HTTP ' . $http_code);
        return false;
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log('Tonkin API Token Error: Invalid JSON response');
        return false;
    }

    if (isset($data['access_token'])) {
        // Cache token for 24 hours
        set_transient('tonkin_api_token', $data['access_token'], DAY_IN_SECONDS);
        return $data['access_token'];
    }

    error_log('Tonkin API Token Error: No access_token in response');
    return false;
}

/**
 * Get stations list from Tonkin Heritage API
 * Stations are cached for 1 hour
 * 
 * @return array Array of stations or empty array on failure
 */
function tonkin_get_stations()
{
    // Check if stations are cached
    $cached_stations = get_transient('tonkin_stations');
    if ($cached_stations !== false) {
        return $cached_stations;
    }

    $token = tonkin_get_api_token();
    if (!$token) {
        error_log('Tonkin API Stations Error: Could not get token');
        return array();
    }

    $api_base_url = tonkin_get_api_base_url();
    if (empty($api_base_url)) {
        error_log('Tonkin API Stations Error: Missing API URL in ACF options');
        return array();
    }

    $response = wp_remote_get($api_base_url . '/booking/form-inputs', array(
        'headers' => array(
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ),
        'timeout' => 30,
        'sslverify' => false, // Disable SSL verification for local development
    ));

    if (is_wp_error($response)) {
        error_log('Tonkin API Stations Error: ' . $response->get_error_message());
        return array();
    }

    $http_code = wp_remote_retrieve_response_code($response);
    if ($http_code !== 200) {
        error_log('Tonkin API Stations Error: HTTP ' . $http_code);
        return array();
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log('Tonkin API Stations Error: Invalid JSON response');
        return array();
    }

    if (isset($data['stations']) && is_array($data['stations'])) {
        // Sort stations by order
        usort($data['stations'], function ($a, $b) {
            return ($a['order'] ?? 0) - ($b['order'] ?? 0);
        });
        // Cache stations for 1 hour
        set_transient('tonkin_stations', $data['stations'], HOUR_IN_SECONDS);
        return $data['stations'];
    }

    error_log('Tonkin API Stations Error: No stations in response. Response: ' . $body);
    return array();
}

/**
 * Get routes list from Tonkin Heritage API
 * Routes are cached for 1 hour
 *
 * @return array Array of routes or empty array on failure
 */
function tonkin_get_routes()
{
    // Check if routes are cached
    $cached_routes = get_transient('tonkin_routes');
    if ($cached_routes !== false) {
        return $cached_routes;
    }

    $token = tonkin_get_api_token();
    if (!$token) {
        error_log('Tonkin API Routes Error: Could not get token');
        return array();
    }

    $api_base_url = tonkin_get_api_base_url();
    if (empty($api_base_url)) {
        error_log('Tonkin API Routes Error: Missing API URL in ACF options');
        return array();
    }

    $response = wp_remote_get($api_base_url . '/route', array(
        'headers' => array(
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ),
        'timeout' => 30,
        'sslverify' => false, // Disable SSL verification for local development
    ));

    if (is_wp_error($response)) {
        error_log('Tonkin API Routes Error: ' . $response->get_error_message());
        return array();
    }

    $http_code = wp_remote_retrieve_response_code($response);
    if ($http_code !== 200) {
        error_log('Tonkin API Routes Error: HTTP ' . $http_code);
        return array();
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log('Tonkin API Routes Error: Invalid JSON response');
        return array();
    }

    if (isset($data['data']) && is_array($data['data'])) {
        // Sort routes by order to keep display stable.
        usort($data['data'], function ($a, $b) {
            return ($a['order'] ?? 0) - ($b['order'] ?? 0);
        });

        // Cache routes for 1 hour
        set_transient('tonkin_routes', $data['data'], HOUR_IN_SECONDS);
        return $data['data'];
    }

    error_log('Tonkin API Routes Error: No data in response. Response: ' . $body);
    return array();
}

/**
 * Get route detail from Tonkin Heritage API
 * Route detail is cached for 1 hour per route id
 *
 * @param int $route_id Route id
 * @return array Route detail data or empty array on failure
 */
function tonkin_get_route_detail($route_id)
{
    $route_id = absint($route_id);
    if ($route_id <= 0) {
        return array();
    }

    $cache_key = 'tonkin_route_detail_' . $route_id;
    $cached_route = get_transient($cache_key);
    if ($cached_route !== false) {
        return $cached_route;
    }

    $token = tonkin_get_api_token();
    if (!$token) {
        error_log('Tonkin API Route Detail Error: Could not get token');
        return array();
    }

    $api_base_url = tonkin_get_api_base_url();
    if (empty($api_base_url)) {
        error_log('Tonkin API Route Detail Error: Missing API URL in ACF options');
        return array();
    }

    $response = wp_remote_get($api_base_url . '/route/' . $route_id, array(
        'headers' => array(
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ),
        'timeout' => 30,
        'sslverify' => false, // Disable SSL verification for local development
    ));

    if (is_wp_error($response)) {
        error_log('Tonkin API Route Detail Error: ' . $response->get_error_message());
        return array();
    }

    $http_code = wp_remote_retrieve_response_code($response);
    if ($http_code !== 200) {
        error_log('Tonkin API Route Detail Error: HTTP ' . $http_code . ' for route id ' . $route_id);
        return array();
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log('Tonkin API Route Detail Error: Invalid JSON response');
        return array();
    }

    if (isset($data['data']) && is_array($data['data'])) {
        set_transient($cache_key, $data['data'], HOUR_IN_SECONDS);
        return $data['data'];
    }

    error_log('Tonkin API Route Detail Error: No data in response. Response: ' . $body);
    return array();
}

/**
 * Clear all Tonkin API transients (useful for debugging)
 */
function tonkin_clear_api_cache()
{
    delete_transient('tonkin_api_token');
    delete_transient('tonkin_stations');
    delete_transient('tonkin_routes');

    global $wpdb;

    $patterns = array(
        $wpdb->esc_like('_transient_tonkin_route_detail_') . '%',
        $wpdb->esc_like('_transient_timeout_tonkin_route_detail_') . '%',
    );

    foreach ($patterns as $pattern) {
        $wpdb->query(
            $wpdb->prepare(
                "DELETE FROM {$wpdb->options} WHERE option_name LIKE %s",
                $pattern
            )
        );
    }
}

/**
 * Clear Tonkin API cache when ACF options are updated.
 *
 * @param string|int $post_id Saved post identifier.
 * @return void
 */
function tonkin_clear_api_cache_on_options_save($post_id)
{
    if ($post_id !== 'options' && $post_id !== 'option') {
        return;
    }

    tonkin_clear_api_cache();
}
add_action('acf/save_post', 'tonkin_clear_api_cache_on_options_save', 20);

/**
 * Debug function to test API connection
 * Usage: Add ?tonkin_debug=1 to any page URL (admin only)
 */
function tonkin_debug_api()
{
    if (!isset($_GET['tonkin_debug']) || !current_user_can('manage_options')) {
        return;
    }

    // Clear cache first
    tonkin_clear_api_cache();

    echo '<div style="background:#fff;padding:20px;margin:20px;border:1px solid #ccc;font-family:monospace;">';
    echo '<h3>Tonkin API Debug</h3>';

    // Test token with detailed output
    echo '<h4>1. Getting Token...</h4>';
    $api_base_url = tonkin_get_api_base_url();
    echo '<p>API URL: ' . esc_html($api_base_url) . '/token (POST)</p>';
    
    $response = wp_remote_post($api_base_url . '/token', array(
        'headers' => array(
            'Accept' => 'application/json',
        ),
        'body' => tonkin_get_api_auth_body(),
        'timeout' => 30,
        'sslverify' => false,
    ));

    if (is_wp_error($response)) {
        echo '<p style="color:red;">✗ WP Error: ' . esc_html($response->get_error_message()) . '</p>';
    } else {
        $http_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);
        
        echo '<p>HTTP Code: ' . $http_code . '</p>';
        echo '<p>Response Body (first 500 chars):</p>';
        echo '<pre style="background:#f5f5f5;padding:10px;overflow:auto;max-height:200px;">' . esc_html(substr($body, 0, 500)) . '</pre>';
        
        $data = json_decode($body, true);
        if (isset($data['access_token'])) {
            echo '<p style="color:green;">✓ Token found!</p>';
            echo '<p>Token (first 50 chars): ' . substr($data['access_token'], 0, 50) . '...</p>';
            $token = $data['access_token'];
        } else {
            echo '<p style="color:red;">✗ No access_token in response</p>';
            $token = null;
        }
    }

    // Test stations
    echo '<h4>2. Getting Stations...</h4>';
    if (!empty($token)) {
        echo '<p>API URL: ' . esc_html($api_base_url) . '/booking/form-inputs</p>';
        
        $response = wp_remote_get($api_base_url . '/booking/form-inputs', array(
            'headers' => array(
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
            ),
            'timeout' => 30,
            'sslverify' => false,
        ));

        if (is_wp_error($response)) {
            echo '<p style="color:red;">✗ WP Error: ' . esc_html($response->get_error_message()) . '</p>';
        } else {
            $http_code = wp_remote_retrieve_response_code($response);
            $body = wp_remote_retrieve_body($response);
            
            echo '<p>HTTP Code: ' . $http_code . '</p>';
            echo '<p>Response Body (first 1000 chars):</p>';
            echo '<pre style="background:#f5f5f5;padding:10px;overflow:auto;max-height:300px;">' . esc_html(substr($body, 0, 1000)) . '</pre>';
            
            $data = json_decode($body, true);
            if (isset($data['stations']) && is_array($data['stations'])) {
                echo '<p style="color:green;">✓ Stations found: ' . count($data['stations']) . '</p>';
                echo '<ul>';
                foreach ($data['stations'] as $station) {
                    echo '<li>' . esc_html($station['name']) . ' (ID: ' . $station['id'] . ', Order: ' . ($station['order'] ?? 'N/A') . ')</li>';
                }
                echo '</ul>';
            } else {
                echo '<p style="color:red;">✗ No stations in response</p>';
            }
        }
    } else {
        echo '<p style="color:red;">✗ Skipped - No token available</p>';
    }

    echo '</div>';
    exit;
}
add_action('init', 'tonkin_debug_api');

