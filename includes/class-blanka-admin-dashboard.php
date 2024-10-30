
	<?php
	

    $url = constant('BLANKA_API') . '/woocommerce/check-connected/?shop='. urlencode(get_site_url());
    
    $response = wp_remote_get( esc_url_raw( $url ) );

    if ( is_array( $response ) && ! is_wp_error( $response ) ) {
        $api_response = json_decode( wp_remote_retrieve_body( $response ), true );
        $is_connected = $api_response['connected'];
    }else{
        $is_error = true;
        $is_connected = false;
    }
  

?>

<div class="blanka__main">

    <?php if($is_connected == 'true'): ?>

        <div class="blanka__card blanka__card--connected">
            <div class="blanka__title">
                <h1>Congrats, your WooCommerce store is now connected to <span> <img src=" <?php echo esc_url(Blanka::get_asset_url() . 'images/blanka_teal.png'); ?>" class="connect-image" alt="woocommerce logo"></span></h1>
               
            </div>

            <div class="blanka__logos">
                <img src=" <?php echo esc_url(Blanka::get_asset_url() . 'images/woocommerce.png'); ?>" class="connect-image" alt="woocommerce logo">
                <p><?php echo get_site_url(); ?></p>
                <img src=" <?php echo esc_url(Blanka::get_asset_url() . 'images/green-checkbox.png'); ?>" class="connect-image-check" alt="check mark">

            </div>  

            <a class="blanka__button" target="__blank" href="<?php echo constant('BLANKA_APP_URL'); ?>">Launch Blanka</a>
        </div>  

        <div class="blanka__footer_icon">
            <img src=" <?php echo esc_url(Blanka::get_asset_url() . 'images/blanka_logo_peach.png'); ?>" class="connect-image" alt="woocommerce logo">
        </div>

    <?php else: ?>

        <div class="blanka__card">
            <div class="blanka__title">
                <h1>Connect to </h1>
                <img src=" <?php echo esc_url(Blanka::get_asset_url() . 'images/blanka_teal.png'); ?>" class="connect-image" alt="woocommerce logo">
            </div>

            <div class="blanka__logos">
                <img src=" <?php echo esc_url(Blanka::get_asset_url() . 'images/woocommerce.png'); ?>" class="connect-image" alt="woocommerce logo">
                <img src=" <?php echo esc_url(Blanka::get_asset_url() . 'images/connection_icon.png'); ?>" class="connect-image" alt="blanka logo">
                <img src=" <?php echo esc_url(Blanka::get_asset_url() . 'images/logo_peach.png'); ?>" class="connect-image" alt="blanka logo">
            </div>  

            <p class="blanka__description">In just a few quick steps, we’ll connect your store to Blanka.
            This will sync up your Blanka products and orders.</p>


            <a class="blanka__button" href="<?php echo constant('BLANKA_API'); ?>/woocommerce/connect?shop=<?php echo get_site_url() ?>">Connect &#x3e;</a>
        </div>  

        <div class="blanka__footer_icon">
            <img src=" <?php echo esc_url(Blanka::get_asset_url() . 'images/blanka_logo_peach.png'); ?>" class="connect-image" alt="woocommerce logo">
        </div>

    <?php endif ?>
   

</div>  


<?php

?>