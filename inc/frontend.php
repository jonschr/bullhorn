<?php

add_action( 'wp_footer', 'bh_output_buttons' );
function bh_output_buttons() {
    
    if ( is_singular( 'promotions' ) )
        return;
    
    $button_positions = bh_get_meta_values( 'button_position', 'promotions' );

    // Check if any unique values are found
    if (!empty($button_positions)) {
        
        // Loop through the unique values
        foreach ($button_positions as $position) {

            // Query posts for each button position
            $args = array(
                'post_type'      => 'promotions',
                'posts_per_page' => -1,
                'meta_query'     => array(
                    array(
                        'key'     => 'button_position',
                        'value'   => $position,
                        'compare' => '='
                    )
                )
            );
            $query = new WP_Query($args);

            // Check if any posts are found for the current position
            if ($query->have_posts()) {
                
                printf( '<div class="bullhorn-button-wrap %s">', $position );
                
                    // Loop through the posts
                    while ($query->have_posts()) {
                        $query->the_post();
                        
                        $label = esc_html( get_post_meta( get_the_ID(), 'button_label', true ) );
                        
                        // display a button using the meta value for button_label
                        printf( '<a href="#" class="bullhorn-button" data-button="%s">%s</a>', get_the_ID(), $label );    
                    
                    }
                
                echo '</div>'; // End .bullhorn-button-wrap
                
                // Loop through the posts again to display the content
                while ($query->have_posts()) {
                    
                    $width = esc_html( get_post_meta( get_the_ID(), 'width', true ) );
                    
                    printf( '<div class="bullhorn-container %s" style="max-width:%spx !important;" data-promotion="%s">', $position, $width, get_the_ID() );
                
                        $query->the_post();
                        
                        the_content();
                                            
                    echo '</div>'; // End .bullhorn-button-wrap
                }
            }

            // End wrapping div
            echo '</div>';

            // Restore original post data
            wp_reset_postdata();
        }
    }

}