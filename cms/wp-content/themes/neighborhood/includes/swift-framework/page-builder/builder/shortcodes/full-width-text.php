<?php
	
class SwiftPageBuilderShortcode_fullwidth_text extends SwiftPageBuilderShortcode {

    public function content( $atts, $content = null ) {

        $title = $el_class = $width = $el_position = '';

        extract(shortcode_atts(array(
        	'title' => '',
        	'alt_background'	=> 'none',
            'el_class' => '',
            'el_position' => '',
            'width' => '1/1'
        ), $atts));

        $output = '';

        $el_class = $this->getExtraClass($el_class);
        $width = spb_translateColumnWidthToSpan($width);

        $el_class .= ' spb_text_column';
        
        $sidebar_config = get_post_meta(get_the_ID(), 'sf_sidebar_config', true);
        
        $sidebars = '';
        if (($sidebar_config == "left-sidebar") || ($sidebar_config == "right-sidebar")) {
        $sidebars = 'one-sidebar';
        } else if ($sidebar_config == "both-sidebars") {
        $sidebars = 'both-sidebars';
        } else {
        $sidebars = 'no-sidebars';
        }
                        
        if ($alt_background == "none" || $sidebars != "no-sidebars") {
        $output .= "\n\t".'<div class="full-width-text spb_content_element '.$width.$el_class.'">';
        } else {
        $output .= "\n\t".'<div class="full-width-text spb_content_element alt-bg '.$alt_background.' '.$width.$el_class.'">';
        }

        $output .= "\n\t\t".'<div class="spb_wrapper clearfix">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<div class="heading-wrap"><h4 class="spb_heading spb_text_heading"><span>'.$title.'</span></h4></div>' : '';
        $output .= "\n\t\t\t".do_shortcode($content);
        $output .= "\n\t\t".'</div> ' . $this->endBlockComment('.spb_wrapper');
        $output .= "\n\t".'</div> ' . $this->endBlockComment($width);

        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}

SPBMap::map( 'fullwidth_text', array(
    "name"		=> __("Text Block (Full Width)", "swift_page_builder"),
    "base"		=> "fullwidth_text",
    "class"		=> "fullwidth_text",
    "icon"      => "spb-icon-full-width-text",
    "params"	=> array(
	    array(
	        "type" => "textfield",
	        "heading" => __("Widget title", "swift_page_builder"),
	        "param_name" => "title",
	        "value" => "",
	        "description" => __("Heading text. Leave it empty if not needed.", "swift_page_builder")
	    ),
	    array(
	        "type" => "textarea_html",
	        "holder" => "div",
	        "class" => "",
	        "heading" => __("Text", "swift_page_builder"),
	        "param_name" => "content",
	        "value" => __("<p>This is a full width text block. Click the edit button to change this text.</p>", "swift_page_builder"),
	        "description" => __("Enter your content.", "swift_page_builder")
	    ),
	    array(
	        "type" => "dropdown",
	        "heading" => __("Show alt background", "swift_page_builder"),
	        "param_name" => "alt_background",
	        "value" => array(__("None", "swift_page_builder") => "none", __("Alt 1", "swift_page_builder") => "alt-one", __("Alt 2", "swift_page_builder") => "alt-two", __("Alt 3", "swift_page_builder") => "alt-three", __("Alt 4", "swift_page_builder") => "alt-four", __("Alt 5", "swift_page_builder") => "alt-five", __("Alt 6", "swift_page_builder") => "alt-six", __("Alt 7", "swift_page_builder") => "alt-seven", __("Alt 8", "swift_page_builder") => "alt-eight", __("Alt 9", "swift_page_builder") => "alt-nine", __("Alt 10", "swift_page_builder") => "alt-ten"),
	        "description" => __("Show an alternative background around the asset. These can all be set in Neighborhood Options > Asset Background Options. NOTE: This is only available on a page with the no sidebar setup.", "swift_page_builder")
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