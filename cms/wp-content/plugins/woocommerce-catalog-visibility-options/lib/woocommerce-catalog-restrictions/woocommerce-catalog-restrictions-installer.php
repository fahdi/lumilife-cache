<?php

function activate_woocommerce_catalog_restrictions() {
    install_woocommerce_catalog_restrictions();
}

function install_woocommerce_catalog_restrictions() {
    global $woocommerce, $wc_catalog_restrictions;
    
    include_once $woocommerce->plugin_path() . '/admin/woocommerce-admin-install.php';
    
    if (!get_option('woocommerce_choose_location_page_id') ) {
        woocommerce_create_page( esc_sql( _x('choose-location', 'page_slug', 'wc_catalog_restrictions') ), 'woocommerce_choose_location_page_id', __('Your Location', 'wc_catalog_restrictions'), '[location_picker /]' );
    }
    
    update_option("woocommerce_catalog_restrictions_db_version", $wc_catalog_restrictions->version);
}

?>