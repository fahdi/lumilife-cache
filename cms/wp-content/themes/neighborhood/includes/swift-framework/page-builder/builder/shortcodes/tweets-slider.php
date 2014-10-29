<?php

class SwiftPageBuilderShortcode_tweets_slider extends SwiftPageBuilderShortcode {

    public function content( $atts, $content = null ) {

        $title = $order = $text_size = $items = $el_class = $width = $el_position = '';

        extract(shortcode_atts(array(
        	'title' => '',
        	'twitter_username' => '',
        	'text_size' => 'normal',
           	'tweets_count'	=> '6',
           	'animation'		=> 'fade',
           	'autoplay'		=> 'yes',
            'el_class' => '',
            'alt_background'	=> 'none',
            'el_position' => '',
            'width' => '1/1'
        ), $atts));

        $output = '';
        
        if ($autoplay == "yes") {
        $items .= '<div class="flexslider tweets-slider content-slider" data-animation="'.$animation.'" data-autoplay="yes"><ul class="slides">';
        } else {
        $items .= '<div class="flexslider tweets-slider content-slider" data-animation="'.$animation.'" data-autoplay="no"><ul class="slides">';
        }
        
       	$items .= sf_get_tweets($twitter_username, $tweets_count);
        		
        $items .= '</ul></div>';
       	       				        
        $el_class = $this->getExtraClass($el_class);
        $width = spb_translateColumnWidthToSpan($width);

        $el_class .= ' testimonial';
        
        if ($alt_background == "none") {
		$output .= "\n\t".'<div class="spb_tweets_slider_widget '.$width.$el_class.'">';
        } else {
        $output .= "\n\t".'<div class="spb_tweets_slider_widget alt-bg '.$alt_background.' '.$width.$el_class.'">';            
        }
        $output .= "\n\t\t".'<div class="spb_wrapper slider-wrap text-'.$text_size.'">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<div class="heading-wrap"><h4 class="spb_heading spb_text_heading"><span>'.$title.'</span></h4></div>' : '';
        $output .= "\n\t\t\t".$items;
        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
        $output .= "\n\t".'</div> '.$this->endBlockComment($width);

        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        
        global $include_carousel;
        $include_carousel = true;
        
        return $output;
    }
}

SPBMap::map( 'tweets_slider', array(
    "name"		=> __("Tweets Slider", "swift_page_builder"),
    "base"		=> "tweets_slider",
    "class"		=> "spb-tweets-slider",
    "icon"      => "spb-icon-tweets-slider",
    "wrapper_class" => "clearfix",
    "params"	=> array(
    	array(
    	    "type" => "textfield",
    	    "heading" => __("Widget title", "swift_page_builder"),
    	    "param_name" => "title",
    	    "value" => "",
    	    "description" => __("Heading text. Leave it empty if not needed.", "swift_page_builder")
    	),
        array(
            "type" => "textfield",
            "heading" => __("Twitter username", "swift_page_builder"),
            "param_name" => "twitter_username",
            "value" => "",
            "description" => __("The twitter username you'd like to show the latest tweet for. Make sure to not include the @.", "swift_page_builder")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Text size", "swift_page_builder"),
            "param_name" => "text_size",
            "value" => array(__('Normal', "swift_page_builder") => "normal", __('Large', "swift_page_builder") => "large"),
            "description" => __("Choose the size of the text.", "swift_page_builder")
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of tweets", "swift_page_builder"),
            "param_name" => "tweets_count",
            "value" => "6",
            "description" => __("The number of tweets to show.", "swift_page_builder")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Slider animation", "swift_page_builder"),
            "param_name" => "animation",
            "value" => array(__('Fade', "swift_page_builder") => "fade", __('Slide', "swift_page_builder") => "slide"),
            "description" => __("Choose the animation for the slider.", "swift_page_builder")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Slider autoplay", "swift_page_builder"),
            "param_name" => "autoplay",
            "value" => array(__('Yes', "swift_page_builder") => "yes", __('No', "swift_page_builder") => "no"),
            "description" => __("Select if you want the slider to autoplay or not.", "swift_page_builder")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show alt background", "swift_page_builder"),
            "param_name" => "alt_background",
            "value" => array(__("None", "swift_page_builder") => "none", __("Alt 1", "swift_page_builder") => "alt-one", __("Alt 2", "swift_page_builder") => "alt-two", __("Alt 3", "swift_page_builder") => "alt-three", __("Alt 4", "swift_page_builder") => "alt-four", __("Alt 5", "swift_page_builder") => "alt-five", __("Alt 6", "swift_page_builder") => "alt-six", __("Alt 7", "swift_page_builder") => "alt-seven", __("Alt 8", "swift_page_builder") => "alt-eight", __("Alt 9", "swift_page_builder") => "alt-nine", __("Alt 10", "swift_page_builder") => "alt-ten"),
            "description" => __("Show an alternative background around the asset. These can all be set in Neighborhood Options > Asset Background Options.", "swift_page_builder")
        ),
        array(
            "type" => "altbg_preview",
            "heading" => __("Alt Background Preview", "swift_page_builder"),
            "param_name" => "altbg_preview",
            "value" => "",
            "description" => __("", "swift_page_builder")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "swift_page_builder"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swift_page_builder")
        )
    )
) );

?>