<?php

namespace SA_EL_ADDONS\Elements\Instagram_Feed\Files;

if (!defined('ABSPATH')) {
    exit;
}

Class Instagram_Query {

    public function __construct() {
        
    }

    public static function __ajax_template($args, $settings, $optional) {
        if (!is_array($settings)):
            $settings = json_decode(stripslashes($settings), TRUE);
        endif;
        echo json_encode(self::__template($settings, $optional));
    }

    public static function __template($settings, $page = 0) {

        $key = 'sa_el_instafeed_' . str_replace('.', '_', $settings['sa_el_instafeed_access_token']);
        $html = '';

        if (get_transient($key) === false) {
            $instagram_data = wp_remote_retrieve_body(wp_remote_get('https://api.instagram.com/v1/users/self/media/recent/?access_token=' . $settings['sa_el_instafeed_access_token']));
            set_transient($key, $instagram_data, 1800);
        } else {
            $instagram_data = get_transient($key);
        }

        $instagram_data = json_decode($instagram_data, true);

        if (empty($instagram_data['data'])) {
            return;
        }


        if (empty($settings['sa_el_instafeed_image_count']['size'])) {
            return;
        }


        switch ($settings['sa_el_instafeed_sort_by']) {
            case 'most-recent':
                sort($instagram_data['data']);
                break;

            case 'least-recent':
                rsort($instagram_data['data']);
                break;

            case 'most-liked':
                usort($instagram_data['data'], function ($a, $b) {
                    return $a['likes']['count'] <= $b['likes']['count'];
                });
                break;

            case 'least-liked':
                usort($instagram_data['data'], function ($a, $b) {
                    return $a['likes']['count'] >= $b['likes']['count'];
                });
                break;

            case 'most-commented':
                usort($instagram_data['data'], function ($a, $b) {
                    return $a['comments']['count'] <= $b['comments']['count'];
                });
                break;

            case 'least-commented':
                usort($instagram_data['data'], function ($a, $b) {
                    return $a['comments']['count'] >= $b['comments']['count'];
                });
                break;
        }


        $items = $instagram_data['data'];

        // return $page * $settings['sa_el_instafeed_image_count']['size'];
        $items = array_splice($items, ($page * $settings['sa_el_instafeed_image_count']['size']), $settings['sa_el_instafeed_image_count']['size']);

        foreach ($items as $item) {
            $html .= '<div class="sa-el-insta-feed sa-el-insta-box">
                    <div class="sa-el-insta-feed-inner">
                        <div class="sa-el-insta-feed-wrap">
                            <div class="sa-el-insta-img-wrap">
                                <img src="' . $item['images'][$settings['sa_el_instafeed_image_resolution']]['url'] . '">
                            </div>';

            $html .= '<div class="sa-el-insta-info-wrap">
                                <div class="sa-el-insta-info-wrap-inner">
                                    <div class="sa-el-insta-likes-comments">';
            if ($settings['sa_el_instafeed_likes']) {
                $html .= '<p class="sa-el-insta-post-likes"> <i class="fa fa-heart-o" aria-hidden="true"></i> ' . $item['likes']['count'] . '</p>';
            }
            if ($settings['sa_el_instafeed_comments']) {
                $html .= '<p class="sa-el-insta-post-comments"><i class="fa fa-comment-o" aria-hidden="true"></i> ' . $item['comments']['count'] . '</p>';
            }
            $html .= '</div>';

            if ($settings['sa_el_instafeed_caption']) {
                $html .= '<p class="insta-caption">' . $item['caption']['text'] . '</p>';
            }
            $html .= '</div>
                            </div>';

            if ($settings['sa_el_instafeed_link']) {
                $html .= '<a href="' . $item['link'] . '" target="' . ($settings['sa_el_instafeed_link_target'] ? '_blank' : '_self') . '"></a>';
            }
            $html .= '</div>
                    </div>
                </div>';
        }

        $response = [
            'html' => $html,
            'pages' => ceil(count($instagram_data['data']) / $settings['sa_el_instafeed_image_count']['size']),
        ];
        return $response;
    }

}
