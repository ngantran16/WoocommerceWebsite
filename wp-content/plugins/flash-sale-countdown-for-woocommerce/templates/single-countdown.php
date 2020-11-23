<?php
global $product;
$id = $product->get_id();
$sale_price_dates_to = get_post_meta($id, '_sale_price_dates_to', true);
if (!$sale_price_dates_to) {
    return;
}
$date_sale_to = date( 'Y-m-d 23:59:59', $sale_price_dates_to );
wp_enqueue_style( 'flash-sale-countdown' );
wp_enqueue_script( 'flash-sale-countdown' );
?>
<div class="flash-sale-countdown fs-single" data-date="<?php echo esc_attr($date_sale_to); ?>">
    <div class="sale--title"><?php esc_html_e('Flash Sale', 'flash-sale-countdown'); ?></div>
    <div class="sale--countdown">
        <div class="countdown--label">
            <?php
            echo wp_kses( __( '<span class="label-text">Offer ends in:</span>', 'flash-sale-countdown' ), array(  'span' => array( 'class' => array() ) ) );
            ?>
        </div>
        <div class="countdown--counter"></div>
    </div>  
</div>