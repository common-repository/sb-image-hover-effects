<?php

namespace SA_EL_ADDONS\Elements\Facebook_Feed\Files;

if (!defined('ABSPATH')) {
    exit;
}

Class Facebook_Query {

    public function __construct() {
        
    }

    public static function __ajax_template($args, $settings, $optional) {
        if (!is_array($settings)):
            $settings = json_decode(stripslashes($settings), TRUE);
        endif;
        echo json_encode(self::__template($settings, $optional));
    }

    public static function __template($settings, $page = 0) {

        $html = '';
        $page_id = $settings['sa_el_facebook_feed_page_id'];
        $token = $settings['sa_el_facebook_feed_access_token'];
        
        if(empty($page_id) || empty($token)) {
            return;
        }
        
        $key = 'sa_el_facebook_feed_' . substr(str_rot13(str_replace('.', '', $page_id . $token)), 32);

        if (get_transient($key) === false) {
            $facebook_data = wp_remote_retrieve_body(wp_remote_get("https://graph.facebook.com/v4.0/{$page_id}/posts?fields=status_type,created_time,from,message,story,full_picture,permalink_url,attachments.limit(1){type,media_type,title,description,unshimmed_url},comments.summary(total_count),reactions.summary(total_count)&access_token={$token}"));
            set_transient($key, $facebook_data, 1800);
        } else {
            $facebook_data = get_transient($key);
        }

        $facebook_data = json_decode($facebook_data, true);
        
        if (isset($facebook_data['data'])) {
            $facebook_data = $facebook_data['data'];
        } else {
            return;
        }
        
        switch ($settings['sa_el_facebook_feed_sort_by']) {
            case 'least-recent':
            $facebook_data = array_reverse($facebook_data);
            break;
        }


        $items = $facebook_data['data'];

        // return $page * $settings['sa_el_instafeed_image_count']['size'];
        $items = array_splice($items, ($page * $settings['sa_el_facebook_feed_image_count']['size']), $settings['sa_el_facebook_feed_image_count']['size']);
        
        foreach($items as $item) {
            $message = wp_trim_words((isset($item['message']) ? $item['message'] : (isset($item['story']) ? $item['story'] : '')), $settings['sa_el_facebook_feed_message_max_length']['size'], '...');
            $photo = (isset($item['full_picture']) ? $item['full_picture'] : '');
            $likes = (isset($item['reactions']) ? $item['reactions']['summary']['total_count'] : 0);
            $comments = (isset($item['comments']) ? $item['comments']['summary']['total_count'] : 0);

            if($settings['sa_el_facebook_feed_layout'] == 'card') {
                $html .= '<div class="sa-el-facebook-feed-item">
                    <div class="sa-el-facebook-feed-item-inner">
                        <header class="sa-el-facebook-feed-item-header clearfix">
                            <div class="sa-el-facebook-feed-item-user clearfix">
                                <a href="https://www.facebook.com/' . $page_id . '" target="' . ($settings['sa_el_facebook_feed_link_target'] == 'yes' ? '_blank' : '_self') . '"><img src="https://graph.facebook.com/v4.0/' . $page_id . '/picture" alt="' . $item['from']['name'] . '" class="sa-el-facebook-feed-avatar"></a>
                                <a href="https://www.facebook.com/' . $page_id . '" target="' . ($settings['sa_el_facebook_feed_link_target'] == 'yes' ? '_blank' : '_self') . '"><p class="sa-el-facebook-feed-username">' . $item['from']['name'] . '</p></a>
                            </div>';

                            if ($settings['sa_el_facebook_feed_date']) {
                                $html .= '<a href="' . $item['permalink_url'] . '" target="' . ($settings['sa_el_facebook_feed_link_target'] ? '_blank' : '_self') . '" class="sa-el-facebook-feed-post-time"><i class="far fa-clock" aria-hidden="true"></i> ' . date("d M Y", strtotime($item['created_time'])) . '</a>';
                            }
                        $html .= '</header>';
                        
                        if ($settings['sa_el_facebook_feed_message'] && !empty($message)) {
                            $html .= '<div class="sa-el-facebook-feed-item-content">
                                <p class="sa-el-facebook-feed-message">' . esc_html($message) . '</p>
                            </div>';
                        }

                        if(!empty($photo) || isset($item['attachments']['data'])) {
                            $html .= '<div class="sa-el-facebook-feed-preview-wrap">';
                                if($item['status_type'] == 'shared_story') {
                                    $html .= '<a href="' . $item['permalink_url'] . '" target="' . ($settings['sa_el_facebook_feed_link_target'] == 'yes' ? '_blank' : '_self') . '" class="sa-el-facebook-feed-preview-img">';
                                        if($item['attachments']['data'][0]['media_type'] == 'video') {
                                            $html .= '<img class="sa-el-facebook-feed-img" src="' . $photo . '">
                                            <div class="sa-el-facebook-feed-preview-overlay"><i class="far fa-play-circle" aria-hidden="true"></i></div>';
                                        } else {
                                            $html .= '<img class="sa-el-facebook-feed-img" src="' . $photo . '">';
                                        }
                                    $html .= '</a>';
    
                                    $html .= '<div class="sa-el-facebook-feed-url-preview">
                                        <p class="sa-el-facebook-feed-url-host">' . parse_url($item['attachments']['data'][0]['unshimmed_url'])['host'] . '</p>
                                        <h2 class="sa-el-facebook-feed-url-title">' . $item['attachments']['data'][0]['title'] . '</h2>
                                        <p class="sa-el-facebook-feed-url-description">' . @$item['attachments']['data'][0]['description'] . '</p>
                                    </div>';
                                } else if ($item['status_type'] == 'added_video') {
                                    $html .= '<a href="' . $item['permalink_url'] . '" target="' . ($settings['sa_el_facebook_feed_link_target'] == 'yes' ? '_blank' : '_self') . '" class="sa-el-facebook-feed-preview-img">
                                        <img class="sa-el-facebook-feed-img" src="' . $photo . '">
                                        <div class="sa-el-facebook-feed-preview-overlay"><i class="far fa-play-circle" aria-hidden="true"></i></div>
                                    </a>';
                                } else {
                                    $html .= '<a href="' . $item['permalink_url'] . '" target="' . ($settings['sa_el_facebook_feed_link_target'] == 'yes' ? '_blank' : '_self') . '" class="sa-el-facebook-feed-preview-img">
                                        <img class="sa-el-facebook-feed-img" src="' . $photo . '">
                                    </a>';
                                }
                            $html .= '</div>';
                        }

                        if ($settings['sa_el_facebook_feed_likes'] || $settings['sa_el_facebook_feed_comments']) {
                            $html .= '<footer class="sa-el-facebook-feed-item-footer">
                                <div class="clearfix">';
                                    if ($settings['sa_el_facebook_feed_likes']) {
                                        $html .= '<span class="sa-el-facebook-feed-post-likes"><i class="far fa-thumbs-up" aria-hidden="true"></i> ' . $likes . '</span>';
                                    }
                                    if ($settings['sa_el_facebook_feed_comments']) {
                                        $html .= '<span class="sa-el-facebook-feed-post-comments"><i class="far fa-comments" aria-hidden="true"></i> ' . $comments . '</span>';
                                    }
                                $html .= '</div>
                            </footer>';
                        }
                    $html .= '</div>
                </div>';
            } else {
                $html .= '<a href="' . $item['permalink_url'] . '" target="' . ($settings['sa_el_facebook_feed_link_target'] ? '_blank' : '_self') . '" class="sa-el-facebook-feed-item">
                    <div class="sa-el-facebook-feed-item-inner">
                        <img class="sa-el-facebook-feed-img" src="' . (empty($photo) ? SA_EL_ADDONS_PATH . 'assets/front-end/img/flexia-preview.jpg' : $photo) . '">';
                        
                        if ($settings['sa_el_facebook_feed_likes'] || $settings['sa_el_facebook_feed_comments']) {
                            $html .= '<div class="sa-el-facebook-feed-item-overlay">
                                <div class="sa-el-facebook-feed-item-overlay-inner">
                                    <div class="sa-el-facebook-feed-meta">';
                                        if ($settings['sa_el_facebook_feed_likes']) {
                                            $html .= '<span class="sa-el-facebook-feed-post-likes"><i class="far fa-thumbs-up" aria-hidden="true"></i> ' . $likes . '</span>';
                                        }
                                        if ($settings['sa_el_facebook_feed_comments']) {
                                            $html .= '<span class="sa-el-facebook-feed-post-comments"><i class="far fa-comments" aria-hidden="true"></i> ' . $comments . '</span>';
                                        }
                                    $html .= '</div>
                                </div>
                            </div>';
                        }
                    $html .= '</div>
                </a>';
            }
        }

        $response = [
            'html' => $html,
            'pages' => ceil(count($facebook_data['data']) / $settings['sa_el_facebook_feed_image_count']['size']),
        ];
        return $response;
    }

}
