/* ------------------------------------------------------------------------------
 *
 *  # CSS3 animations
 *
 *  Demo JS code for animations_css3.html page
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var AnimationsCSS3 = function() {


    // CSS3 animations
    var _componentAnimationCSS = function() {

        // Toggle animations
        $('body').on('click', '.animation', function (e) {

            // Get animation class from 'data' attribute
            var animation = $(this).data('animation');

            // Apply animation once per click
            $(this).parents('.box').addClass('animated ' + animation).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                $(this).removeClass('animated ' + animation);
            });
            e.preventDefault();
        });
        
        $('body').on('click', '.animateHeader', function (e) {

            // Get animation class from 'data' attribute
            var animateType = $(this).data('id');
            
            if(animateType=="in")
            {
                // Apply animation once per click
                $('.animateOutHeader').addClass('animated flipInX').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                    $('.animateOutHeader').removeClass('animated flipInX');
                });
                
                $('.animateInHeader').hide();
                $('.animateOutHeader').show();
                
                $(this).data('id', "out");
            }
            else
            {
                // Apply animation once per click
                $('.animateInHeader').addClass('animated flipInX').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                    $('.animateInHeader').removeClass('animated flipInX');
                });
                
                $('.animateOutHeader').hide();
                $('.animateInHeader').show();
                
                $(this).data('id', "in");
            }
            
            e.preventDefault();
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentAnimationCSS();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    AnimationsCSS3.init();
});
