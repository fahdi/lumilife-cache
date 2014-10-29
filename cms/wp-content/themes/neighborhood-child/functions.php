<?php

// Redirect users who arent logged in...
function login_redirect_lumilife() {

    // Current Page
    global $pagenow;
    // Check to see if user in not logged in and not on the login page
    if (!is_user_logged_in() && $pagenow != 'wp-login.php' && !is_page('login') && !is_page('register') && is_page('agents-distributors') ){
          // If user is, Redirect to Login form.
          auth_redirect();
       }
    if(is_user_logged_in() and (is_page('login') or is_page('register') or is_home())) {
      // Redirect to thier settings
      global $current_user;
      //print_r( $current_user->roles);
        if( isset( $current_user->roles ) && is_array( $current_user->roles ) ) {
         
        //check for admins
          if( in_array( "distributor", $current_user->roles ) ) {
               // redirect them to the default place
               wp_redirect("agents-distributors");
               exit();   
                // Let the admin do anything he/ she wants to 
          }
        }  

    }
          
          
}
// add the block of code above to the WordPress template
add_action( 'wp', 'login_redirect_lumilife' );


/*
  The follwing three filters, if uncommented, will hide the free label on the price
*/

//add_filter( 'woocommerce_variable_free_price_html',  'hide_free_price_notice' );
 
//add_filter( 'woocommerce_free_price_html',           'hide_free_price_notice' );
 
//add_filter( 'woocommerce_variation_free_price_html', 'hide_free_price_notice' );
 
 
 
/**
 * Hides the 'Free!' price notice
 */
function hide_free_price_notice( $price ) {
 
  return '';
}


add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
 
function woo_remove_product_tabs( $tabs ) {
 
    unset( $tabs['description'] );        // Remove the description tab
    unset( $tabs['reviews'] );      // Remove the reviews tab
    unset( $tabs['additional_information'] );   // Remove the additional information tab
 
    return $tabs;
 
}



/** 
 * Change on single product panel "Additional Information"
 */

//add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
 
function woo_rename_tabs( $tabs ) {
 
  global $product;
  
  
    $tabs['additional_information']['title'] = __( 'Salient Features' );  // Rename the additional information tab
  
 
  return $tabs;
 
}

add_filter( 'woocommerce_product_tabs', 'woo_salient_features_tab', 98 );
function woo_salient_features_tab( $tabs ) {

  $tabs['description']['title'] = __( 'Salient Features' );  // Rename the additional information tab

  $tabs['description']['callback'] = 'woo_custom_description_tab_content';  // Custom description callback
 
  return $tabs;
}
 
function woo_custom_description_tab_content() {
  
  global $post;
  $terms = get_the_terms( $post->ID, 'product_cat' );

/*
  echo "<pre>";
    print_r($terms);
  echo "</pre>";
*/

  foreach ( $terms as $term ){
    $category_id = $term->term_id;
    $category_name = $term->name;
    $category_description = $term->description;
    $category_slug = $term->slug;

  //  echo $category_id;

    $templateCategory = "product_cat_$category_id";
    $template = get_field('salient_features', $templateCategory );

    echo $template;
    break; 
  }

}

?>