jQuery(document).ready(function ($) {
    $('.bullhorn-close').each(function () {
        var $element = $(this);
        var $siblingDiv = $element.next('div');
        var backgroundColor = $siblingDiv.css('background-color');

        // Check if the background color is defined and not transparent
        if (backgroundColor && backgroundColor !== 'transparent') {
            // Convert the background color to RGB values
            var rgbValues = backgroundColor.match(
                /^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/
            );

            // Check if RGB values are valid
            if (rgbValues && rgbValues.length === 4) {
                // Calculate the luminance using the RGB values
                var luminance =
                    0.299 * rgbValues[1] +
                    0.587 * rgbValues[2] +
                    0.114 * rgbValues[3];

                // Add the appropriate class based on luminance
                if (luminance < 128) {
                    $element.addClass('dark-bkg');
                } else {
                    $element.addClass('light-bkg');
                }
            }
        }
    });
});
