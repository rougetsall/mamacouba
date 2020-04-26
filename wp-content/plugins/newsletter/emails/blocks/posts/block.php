<?php
/*
 * Name: Last posts
 * Section: content
 * Description: Last posts list with different layouts
 */

/* @var $options array */
/* @var $wpdb wpdb */

$defaults = array(
    'title' => 'Last news',
    'color' => '#999999',
    'font_family' => 'Helvetica, Arial, sans-serif',
    'font_size' => '16',
    'font_color' => '#333333',
    'title_font_family' => 'Helvetica, Arial, sans-serif',
    'title_font_size' => '25',
    'title_font_color' => '#333333',
    'max' => 4,
    'button_label' => __('Read more...', 'newsletter'),
    'categories' => '',
    'tags' => '',
    'block_background' => '#ffffff',
    'layout' => 'one',
    'language' => '',
    'button_background' => '#256F9C',
    'button_font_color' => '#ffffff',
    'button_font_family' => 'Helvetica, Arial, sans-serif',
    'button_font_size' => 16,
    'block_padding_left' => 15,
    'block_padding_right' => 15,
    'block_padding_top' => 15,
    'block_padding_bottom' => 15,
    'excerpt_length' => 30,
    'post_offset' => 0,
    'automated_include' => 'new',
    'inline_edits' => [],
    'automated_no_contents' => 'No new posts by now!',
    'automated' => '1'
);

// Backward compatibility
if (isset($options['automated_required'])) {
    $defaults['automated'] = '1';
}

$options = array_merge($defaults, $options);

$font_family = $options['font_family'];
$font_size = $options['font_size'];
$excerpt_length = $options['excerpt_length'];

$title_font_family = $options['title_font_family'];
$title_font_size = $options['title_font_size'];

$show_image = !empty($options['show_image']);

$filters = array();
$filters['posts_per_page'] = (int) $options['max'];
$filters['offset'] = max((int) $options['post_offset'], 0);

if (!empty($options['categories'])) {
    $filters['category__in'] = $options['categories'];
}

if (!empty($options['tags'])) {
    $filters['tag'] = $options['tags'];
}

// Filter by time?
//$options['block_last_run'] = time();
if (!empty($context['last_run'])) {
    $filters['date_query'] = array(
        'after' => gmdate('c', $context['last_run'])
    );
}

$posts = Newsletter::instance()->get_posts($filters, $options['language']);

// This is a block regeneration with a timestamp
if ($context['type'] == 'automated' && !empty($context['last_run'])) {
    // We don't care the timestamp of the last newsletter sent, we want to send only future events
    if (empty($posts)) {
        // I this block was marked as required, we tell the regenerator to return an empty message
        if ($options['automated'] == '1') {
            $out['stop'] = true;
            return;
        } else if ($options['automated'] == '2') {
            $out['skip'] = true;
            return;
        }
    }

    // We have something new but we need to reload the posts without filtering by date
    if ($options['automated_include'] == 'max') {
        unset($filters['date_query']);
        $posts = Newsletter::instance()->get_posts($filters, $options['language']);
    }
}

if ($posts) {
    $out['subject'] = $posts[0]->post_title;
}

$button_background = $options['button_background'];
$button_label = $options['button_label'];
$button_font_family = $options['button_font_family'];
$button_font_size = $options['button_font_size'];
$button_color = $options['button_font_color'];

$alternative = plugins_url('newsletter') . '/emails/blocks/posts/images/blank.png';
$alternative_2 = plugins_url('newsletter') . '/emails/blocks/posts/images/blank-240x160.png';

remove_all_filters('excerpt_more');

?>

<?php if (!$posts) { ?>


    <div inline-class="nocontents"><?php echo $options['automated_no_contents'] ?></div>


    <?php
    return;
}
?>

<?php if ($options['layout'] == 'one') { ?>
    <style>
        .posts-post-date {
            padding: 0 0 5px 0; 
            font-size: 13px;
            font-family: <?php echo $font_family ?>; 
            font-weight: normal; 
            color: #aaaaaa;
        }

        .posts-post-title {
            padding: 0 0 5px 0; 
            font-size: <?php echo $title_font_size ?>px; 
            font-family: <?php echo $title_font_family ?>;
            font-weight: normal; 
            color: <?php echo $options['title_font_color'] ?>;
            line-height: normal;
        }

        .posts-post-excerpt {
            padding: 10px 0 15px 0;
            font-family: <?php echo $font_family ?>; 
            color: <?php echo $options['font_color'] ?>;
            font-size: <?php echo $font_size ?>px; 
            line-height: 1.5em;
        }

        .posts-button-table {
            background-color: <?php echo $button_background ?>; 
            /*border:1px solid #353535;*/
            border-radius:5px;
            align: right;
        }
        .posts-button-td {
            color: <?php echo $button_color ?>;
            font-family:<?php echo $font_family ?>; 
            font-size:<?php echo $button_font_size ?>px;
            font-weight:normal; 
            letter-spacing:normal;
            line-height:normal; 
            padding-top:10px; 
            padding-right:15px; 
            padding-bottom:10px; 
            padding-left:15px;
            text-align: right;
        }
        .posts-button-a {
            color:<?php echo $button_color ?>;
            font-size:<?php echo $button_font_size ?>px;
            font-weight:normal; 
            text-decoration:none;
        }
    </style>
    <!-- COMPACT ARTICLE SECTION -->



    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="responsive-table">

        <?php foreach ($posts as $post) { ?>
            <?php
            $url = tnp_post_permalink($post);
            $media = null;
            if ($show_image) {
                $media = tnp_composer_block_posts_get_media($post, ['width' => 300, 'height' => 0]);
                if ($media) $media->set_width(105);
            }
            ?>

            <tr>

                <td valign="top" style="padding: 20px 0 0 0;" class="posts-td-1">

                    <?php if ($media) { ?>
                    <table width="20%" cellpadding="0" cellspacing="0" border="0" align="left" class="posts-1-column" style="margin-bottom: 20px">
                            <tr>
                                <td>
                                    <a href="<?php echo tnp_post_permalink($post) ?>" target="_blank">
                                        <img src="<?php echo $media->url ?>"
                                             width="<?php echo $media->width ?>"
                                             height="<?php echo $media->height ?>"
                                             alt="<?php echo esc_attr($media->alt) ?>"
                                             border="0"
                                             class="posts-1-image"
                                             style="display: block; max-width: 100%; width: <?php echo $media->width ?>px" width="<?php echo $media->width ?>">
                                    </a>
                                </td>
                            </tr>
                        </table>

                   
        <?php } ?>

            <table width="<?php echo $media?'78%':'100%'?>" cellpadding="0" cellspacing="0" border="0" class="posts-1-column" align="right">
                <tr>
                    <td>

                        <!-- ARTICLE -->
                        <table border="0" cellspacing="0" cellpadding="0" width="100%">
        <?php if (!empty($options['show_date'])) { ?>
                                <tr>
                                    <td align="left" inline-class="posts-post-date">
            <?php echo tnp_post_date($post) ?>
                                    </td>
                                </tr>
        <?php } ?>
                            <tr>
                                <td align="left" 
                                    inline-class="posts-post-title" 
                                    class="tnpc-row-edit tnpc-inline-editable" 
                                    data-type="title" data-id="<?php echo $post->ID ?>">
                                        <?php
                                        echo TNP_Composer::is_post_field_edited_inline($options['inline_edits'], 'title', $post->ID) ?
                                                TNP_Composer::get_edited_inline_post_field($options['inline_edits'], 'title', $post->ID) :
                                                tnp_post_title($post)
                                        ?>
                                </td>  
                            </tr>
                            <tr>
                                <td align="left"
                                    inline-class="posts-post-excerpt"
                                    class="padding-copy tnpc-row-edit tnpc-inline-editable"
                                    data-type="text" data-id="<?php echo $post->ID ?>">
                                        <?php
                                        echo TNP_Composer::is_post_field_edited_inline($options['inline_edits'], 'text', $post->ID) ?
                                                TNP_Composer::get_edited_inline_post_field($options['inline_edits'], 'text', $post->ID) :
                                                tnp_post_excerpt($post, $excerpt_length)
                                        ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" class="padding">
                                    <table border="0" cellpadding="0" cellspacing="0" inline-class="posts-button-table" align="right">
                                        <tr>
                                            <td align="center" valign="middle" inline-class="posts-button-td">
                                                <a href="<?php echo esc_attr($url) ?>" target="_blank" inline-class="posts-button-a"><?php echo $button_label ?></a>
                                            </td>
                                        </tr>
                                    </table>    
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>
            </table>

        </td>
        </tr>

    <?php } ?>

    </table>



<?php } else { ?>

    <style>
        .posts-post-date {
            padding: 10px 0 0 15px; 
            font-size: 13px;
            font-family: <?php echo $font_family ?>; 
            font-weight: normal; 
            color: #aaaaaa;
        }        
        .posts-post-title {
            padding: 15px 0 0 0; 
            font-family: <?php echo $title_font_family ?>; 
            color: <?php echo $options['title_font_color'] ?>;
            font-size: <?php echo $title_font_size ?>px; 
            line-height: 1.3em; 
        }
        .posts-post-excerpt {
            padding: 5px 0 0 0; 
            font-family: <?php echo $font_family ?>; 
            color: <?php echo $options['font_color'] ?>;
            font-size: <?php echo $font_size ?>px; 
            line-height: 1.4em;
        }
        .posts-button-table {
            background-color: <?php echo $button_background ?>; 
            /*border:1px solid #353535;*/
            border-radius:5px;
            align: right;
        }
        .posts-button-td {
            color: <?php echo $button_color ?>;
            font-family:<?php echo $font_family ?>; 
            font-size:<?php echo $button_font_size ?>px;
            font-weight:normal; 
            letter-spacing:normal;
            line-height:normal; 
            padding-top:15px; 
            padding-right:30px; 
            padding-bottom:15px; 
            padding-left:30px;
            text-align: right;
        }
        .posts-button-a {
            color:<?php echo $button_color ?>;
            font-size:<?php echo $button_font_size ?>px;
            font-weight:normal; 
            text-decoration:none;
        }        
    </style>
    <!-- TWO COLUMN SECTION -->


    <!-- TWO COLUMNS -->
    <table cellspacing="0" cellpadding="0" border="0" width="100%">
    <?php foreach (array_chunk($posts, 2) AS $row) { ?>        
            <tr>
                <td valign="top" style="padding: 10px;" class="mobile-wrapper two-columns">

                    <!-- LEFT COLUMN -->
                    <table cellpadding="0" cellspacing="0" border="0" width="47%" align="left" class="responsive-table">
                        <tr>
                            <td style="padding: 20px 0 40px 0;">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <?php if ($show_image) { ?>
                                        <?php
                                        $size = array('width' => 240, 'height' => 160, "crop" => true);
                                        $media = tnp_composer_block_posts_get_media($row[0], $size, $alternative_2);
                                        ?>
                                        <tr>
                                            <td align="center" valign="middle" class="tnpc-row-edit" data-type="image">
                                                <a href="<?php echo tnp_post_permalink($row[0]) ?>" target="_blank">
                                                    <img src="<?php echo $media->url ?>"
                                                         width="<?php echo $media->width ?>"
                                                         height="<?php echo $media->height ?>"
                                                         alt="Image"
                                                         border="0"
                                                         class="img-max">
                                                </a>
                                            </td>
                                        </tr>
        <?php } ?>
                                    <tr>
                                        <td align="center"
                                            inline-class="posts-post-title"
                                            class="tnpc-row-edit tnpc-inline-editable"
                                            data-type="title" data-id="<?php echo $row[0]->ID ?>">
                                                <?php
                                                echo TNP_Composer::is_post_field_edited_inline($options['inline_edits'], 'title', $row[0]->ID) ?
                                                        TNP_Composer::get_edited_inline_post_field($options['inline_edits'], 'title', $row[0]->ID) :
                                                        tnp_post_title($row[0])
                                                ?>
                                        </td>
                                    </tr>
        <?php if (!empty($options['show_date'])) { ?>
                                        <tr>
                                            <td  align="center" inline-class="posts-post-date">
            <?php echo tnp_post_date($row[0]) ?>
                                            </td>
                                        </tr>
        <?php } ?>
                                    <tr>
                                        <td align="center"
                                            inline-class="posts-post-excerpt"
                                            class="tnpc-row-edit tnpc-inline-editable"
                                            data-type="text" data-id="<?php echo $row[0]->ID ?>">
                                                <?php
                                                echo TNP_Composer::is_post_field_edited_inline($options['inline_edits'], 'text', $row[0]->ID) ?
                                                        TNP_Composer::get_edited_inline_post_field($options['inline_edits'], 'text', $row[0]->ID) :
                                                        tnp_post_excerpt($row[0], $excerpt_length)
                                                ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <br>
                                            <table border="0" cellpadding="0" cellspacing="0" inline-class="posts-button-table" align="center">
                                                <tr>
                                                    <td align="center" valign="middle" inline-class="posts-button-td">
                                                        <a href="<?php echo tnp_post_permalink($row[0]) ?>" target="_blank" inline-class="posts-button-a"><?php echo $button_label ?></a>
                                                    </td>
                                                </tr>
                                            </table> 
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>

        <?php if (!empty($row[1])) { ?>
                        <!-- RIGHT COLUMN -->
                        <table cellpadding="0" cellspacing="0" border="0" width="47%" align="right" class="responsive-table">
                            <tr>
                                <td style="padding: 20px 0 40px 0;">
                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                        <?php if ($show_image) { ?>
                                            <?php
                                            $size = array('width' => 240, 'height' => 160, "crop" => true);
                                            $media = tnp_composer_block_posts_get_media($row[1], $size, $alternative_2);
                                            ?>
                                            <tr>
                                                <td align="center" valign="middle" class="tnpc-row-edit" data-type="image">
                                                    <a href="<?php echo tnp_post_permalink($row[1]) ?>" target="_blank">
                                                        <img src="<?php echo $media->url ?>"
                                                             width="<?php echo $media->width ?>" 
                                                             height="<?php echo $media->height ?>"
                                                             alt="Image" border="0" class="img-max">
                                                    </a>
                                                </td>
                                            </tr>
            <?php } ?>
                                        <tr>
                                            <td align="center"
                                                inline-class="posts-post-title"
                                                class="tnpc-row-edit tnpc-inline-editable"
                                                data-type="title" data-id="<?php echo $row[1]->ID ?>">
                                                    <?php
                                                    echo TNP_Composer::is_post_field_edited_inline($options['inline_edits'], 'title', $row[1]->ID) ?
                                                            TNP_Composer::get_edited_inline_post_field($options['inline_edits'], 'title', $row[1]->ID) :
                                                            tnp_post_title($row[1])
                                                    ?>
                                            </td>
                                        </tr>
            <?php if (!empty($options['show_date'])) { ?>
                                            <tr>
                                                <td  align="center" inline-class="posts-post-date">
                <?php echo tnp_post_date($row[1]) ?>
                                                </td>
                                            </tr>
            <?php } ?>
                                        <tr>
                                            <td align="center"
                                                inline-class="posts-post-excerpt"
                                                class="tnpc-row-edit tnpc-inline-editable"
                                                data-type="text" data-id="<?php echo $row[1]->ID ?>">
                                                    <?php
                                                    echo TNP_Composer::is_post_field_edited_inline($options['inline_edits'], 'text', $row[1]->ID) ?
                                                            TNP_Composer::get_edited_inline_post_field($options['inline_edits'], 'text', $row[1]->ID) :
                                                            tnp_post_excerpt($row[1], $excerpt_length)
                                                    ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                <br>
                                                <table border="0" cellpadding="0" cellspacing="0" inline-class="posts-button-table" align="center">
                                                    <tr>
                                                        <td align="center" valign="middle" inline-class="posts-button-td">
                                                            <a href="<?php echo tnp_post_permalink($row[1]) ?>" target="_blank" inline-class="posts-button-a"><?php echo $button_label ?></a>
                                                        </td>
                                                    </tr>
                                                </table> 
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
        <?php } ?>

                </td>
            </tr>

    <?php } ?>

    </table>



<?php } ?>
