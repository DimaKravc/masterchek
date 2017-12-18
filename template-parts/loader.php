<?php
$posts_array = get_posts(array('post_type' => 'loader', 'posts_per_page' => 1));
foreach ($posts_array as $post) {
    $gallery = get_post_gallery_images($post);

    if (count($gallery)):
        ?>
        <div class="loader" data-js="loader">
            <svg class="loader__svg" height="200" viewBox="0 0 1024 200" xmlns="http://www.w3.org/2000/svg">
                <?php foreach ($gallery as $key => $url): ?>
                    <defs>
                        <pattern x="0" y="0" width="1024" height="686" patternUnits="userSpaceOnUse"
                                 id="pattern<?php echo $key + 1; ?>" viewBox="0 0 1024 300">
                            <image xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo esc_url($url) ?>"
                                   preserveAspectRatio="none" x="0" y="-200" width="1024" height="686"></image>
                        </pattern>
                    </defs>
                <?php endforeach; ?>
                <text x="50%" id="letter" dy="140" style="text-anchor: middle; font-size: 110px; font-weight: bold;"
                      fill="url('#pattern1')"><?php echo $post->post_title ? $post->post_title : 'MASTERCHEK' ?></text>
            </svg>
        </div>
        <?php
    endif;
}
?>