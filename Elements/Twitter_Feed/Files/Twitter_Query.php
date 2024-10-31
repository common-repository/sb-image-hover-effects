<?php

namespace SA_EL_ADDONS\Elements\Twitter_Feed\Files;

if (!defined('ABSPATH')) {
    exit;
}

Class Twitter_Query {

    public static function twitter_feed_items($id, $settings, $class = '')
    {
        $token = get_option($id . '_' . $settings['sa_el_twitter_feed_ac_name'] . '_tf_token');
        $items = get_transient($id . '_' . $settings['sa_el_twitter_feed_ac_name'] . '_tf_cache');
        $html = '';

        if (empty($settings['sa_el_twitter_feed_consumer_key']) || empty($settings['sa_el_twitter_feed_consumer_secret'])) {
            return;
        }

        if ($items === false) {
            if (empty($token)) {
                $credentials = base64_encode($settings['sa_el_twitter_feed_consumer_key'] . ':' . $settings['sa_el_twitter_feed_consumer_secret']);

                add_filter('https_ssl_verify', '__return_false');

                $response = wp_remote_post('https://api.twitter.com/oauth2/token', [
                    'method' => 'POST',
                    'httpversion' => '1.1',
                    'blocking' => true,
                    'headers' => [
                        'Authorization' => 'Basic ' . $credentials,
                        'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8',
                    ],
                    'body' => ['grant_type' => 'client_credentials'],
                ]);

                $body = json_decode(wp_remote_retrieve_body($response));

                if ($body) {
                    update_option($id . '_' . $settings['sa_el_twitter_feed_ac_name'] . '_tf_token', $body->access_token);
                    $token = $body->access_token;
                }
            }

            $args = array(
                'httpversion' => '1.1',
                'blocking' => true,
                'headers' => array(
                    'Authorization' => "Bearer $token",
                ),
            );

            add_filter('https_ssl_verify', '__return_false');

            $response = wp_remote_get('https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=' . $settings['sa_el_twitter_feed_ac_name'] . '&count=999&tweet_mode=extended', [
                'httpversion' => '1.1',
                'blocking' => true,
                'headers' => [
                    'Authorization' => "Bearer $token",
                ],
            ]);

            if (!is_wp_error($response)) {
                $items = json_decode(wp_remote_retrieve_body($response), true);
                set_transient($id . '_' . $settings['sa_el_twitter_feed_ac_name'] . '_tf_cache', $items, 1800);
            }
        }

        if (empty($items)) {
            return;
        }

        if ($settings['sa_el_twitter_feed_hashtag_name']) {
            foreach ($items as $key => $item) {
                $match = false;

                if ($item['entities']['hashtags']) {
                    foreach ($item['entities']['hashtags'] as $tag) {
                        if (strcasecmp($tag['text'], $settings['sa_el_twitter_feed_hashtag_name']) == 0) {
                            $match = true;
                        }
                    }
                }

                if ($match == false) {
                    unset($items[$key]);
                }
            }
        }

        $items = array_splice($items, 0, $settings['sa_el_twitter_feed_post_limit']);

        foreach ($items as $item) {
            $html .= '<div class="sa-el-twitter-feed-item ' . $class . '">
				<div class="sa-el-twitter-feed-item-inner">
				    <div class="sa-el-twitter-feed-item-header clearfix">';
            if ($settings['sa_el_twitter_feed_show_avatar'] == 'true') {
                $html .= '<a class="sa-el-twitter-feed-item-avatar avatar-' . $settings['sa_el_twitter_feed_avatar_style'] . '" href="//twitter.com/' . $settings['sa_el_twitter_feed_ac_name'] . '" target="_blank">
                                <img src="' . $item['user']['profile_image_url_https'] . '">
                            </a>';
            }
            $html .= '<a class="sa-el-twitter-feed-item-meta" href="//twitter.com/' . $settings['sa_el_twitter_feed_ac_name'] . '" target="_blank">';
            if ($settings['sa_el_twitter_feed_show_icon'] == 'true') {
                $html .= '<i class="fab fa-twitter sa-el-twitter-feed-item-icon"></i>';
            }

            $html .= '<span class="sa-el-twitter-feed-item-author">' . $item['user']['name'] . '</span>
                        </a>';
            if ($settings['sa_el_twitter_feed_show_date'] == 'true') {
                $html .= '<span class="sa-el-twitter-feed-item-date">' . sprintf(__('%s ago', SA_EL_ADDONS_TEXTDOMAIN), human_time_diff(strtotime($item['created_at']))) . '</span>';
            }
            $html .= '</div>
                    <div class="sa-el-twitter-feed-item-content">
                        <p>' . substr(str_replace(@$item['entities']['urls'][0]['url'], '', $item['full_text']), 0, $settings['sa_el_twitter_feed_content_length']) . '...</p>';

            if ($settings['sa_el_twitter_feed_show_read_more'] == 'true') {
                $html .= '<a href="//twitter.com/' . @$item['user']['screen_name'] . '/status/' . $item['id'] . '" target="_blank" class="read-more-link">Read More <i class="fas fa-angle-double-right"></i></a>';
            }
            $html .= '</div>
                    ' . (isset($item['extended_entities']['media'][0]) && $settings['sa_el_twitter_feed_media'] == 'true' ? ($item['extended_entities']['media'][0]['type'] == 'photo' ? '<img src="' . $item['extended_entities']['media'][0]['media_url_https'] . '">' : '') : '') . '
                </div>
			</div>';
        }

        return $html;
    }

}
