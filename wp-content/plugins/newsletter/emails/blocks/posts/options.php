<?php

/* @var $options array contains all the options the current block we're ediging contains */
/* @var $controls NewsletterControls */
/* @var $fields NewsletterFields */

?>

<?php if ($context['type'] == 'automated') { ?>

    <?php $fields->select('automated', __('If there are no new posts...', 'newsletter'), [''=>'Show the message below', '1'=>'Do not send the newsletter', '2'=>'Remove the block'],
            ['description' => 'Works only on automatic newsletter creation']) ?>
    <?php $fields->text('automated_no_contents', 'No posts text') ?>

    <?php $fields->select('automated_include', __('What to include', 'newsletter'), array('new' => __('New posts after last newsletter', 'newsletter'), 
        'max' => __('Always max posts if at least one is new', 'newsletter')),
            array('description'=>'This option is effective only when the newsletter is generated, not while composing')) ?>
<?php } ?>


<?php $fields->select('layout', __('Layout', 'newsletter'), array('one' => __('One column', 'newsletter'), 'two' => __('Two columns', 'newsletter'))) ?>

<?php $fields->font('title_font', __('Title font', 'newsletter')) ?>

<?php $fields->number( 'excerpt_length', __( 'Excerpt words', 'newsletter' ), array( 'min' => 0 ) ); ?>

<?php $fields->font('font', __('Excerpt font', 'newsletter')) ?>

<div class="tnp-field">
<label class="tnp-label"><?php _e('Dates and images', 'newsletter')?></div>
<div class="tnp-field-row">
    <div class="tnp-field-col-2">
        <?php $fields->checkbox('show_image', __('Show image', 'newsletter')) ?>
    </div>
    <div class="tnp-field-col-2">
        <?php $fields->checkbox('show_date', __('Show date', 'newsletter')) ?>
    </div>
    <div style="clear: both"></div>
</div>
</div>

<div class="tnp-field-row">
    <div class="tnp-field-col-2">
        <?php $fields->select_number('max', __('Max posts', 'newsletter'), 1, 40); ?>
    </div>
        <div class="tnp-field-col-2">
        <?php $fields->select_number( 'post_offset', __( 'Posts offset', 'newsletter' ), 0, 20); ?>
    </div>
</div>

<?php $fields->language(); ?>

<?php $fields->button('button', 'Button', array('url' => false)) ?>

<?php $fields->section(__('Filters', 'newsletter')) ?>
<?php $fields->categories(); ?>
<?php $fields->text('tags', __('Tags', 'newsletter'), ['description'=>__('Comma separated')]); ?>

<?php $fields->block_commons() ?>

