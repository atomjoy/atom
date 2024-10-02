<?php

/**
 * Create shareable social links for url.
 * 
 * Fontawesome required for icons
 * <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 *
 * @param string $url Post url get_permalink()
 * @param string $class Css class
 */
function shareSocial($url, $class = 'social-link-share') {
    $socials = [        
        'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=',
        'x-twitter' => 'https://x.com/intent/tweet?url=',
        'pinterest' => 'https://pinterest.com/pin/create/button/?url=',
        'linkedin' => 'https://www.linkedin.com/shareArticle?mini=true&url=',
        'reddit' => 'https://reddit.com/submit?url=',
        'tumblr' => 'https://www.tumblr.com/widgets/share/tool?canonicalUrl=',
        'weibo' => 'https://service.weibo.com/share/share.php?url=',
        'telegram' => 'https://t.me/share/url?url=',
        'vk' => 'https://vk.com/share.php?url=',
        'whatsapp' => 'https://api.whatsapp.com/send?text=',
    ];

    echo '<a href="mailto:?subject=Shared link&body='.urlencode($url).'" class="'.$class.'"><i class="fa-regular fa-envelope"></i></a>';

    foreach ($socials as $k => $v) {
        echo '<a href="'.$v.urlencode($url).'" class="'.$class.'" target="_blank" title="Share '.$k.'"><i class="fa-brands fa-'.$k.'"></i></a>';
    }    
}