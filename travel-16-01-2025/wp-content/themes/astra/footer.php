<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<?php astra_content_bottom(); ?>
	</div> <!-- ast-container -->
	</div><!-- #content -->
<?php 
	astra_content_after();
		
	astra_footer_before();
		
	astra_footer();
		
	astra_footer_after(); 
?>
	</div><!-- #page -->
<?php 
	astra_body_bottom();    
	wp_footer(); 
?>

<script>
	jQuery(document).ready(function($) {
    $('.grid-container').slick({
        slidesToShow: 2,
        slidesToScroll: 2,
        autoplay: true,
        autoplaySpeed: 7000,
        infinite: true,
        arrows: false,
        responsive: [
            {
                breakpoint: 650,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});


</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

            var userAuthData = JSON.parse(localStorage.getItem('AUTH_CURRENT-USER'));

        var buttonsignupid = document.querySelector('#signupid'); // Replace with the button’s class
        var buttonTextsignupid = document.querySelector('#signupid .elementor-button-text');

        if (buttonsignupid && buttonText) {
            if (userAuthData && userAuthData.state === 'IsLoggedIn') {
                buttonTextsignupid.textContent = 'Logout';
		buttonsignupid.href = 'void:javascript(0)';
                buttonsignupid.addClass = 'logout-button';
            } else {
                buttonTextsignupid.textContent = 'Sign Up';
                buttonsignupid.href = 'https://tradebloccorporatetravel.com/auth/register';
		buttonsignupid.removeClass = 'logout-button';
            }
        }

	var buttonloginid = document.querySelector('#signupid'); // Replace with the button’s class
        var buttonTextloginid = document.querySelector('#signupid .elementor-button-text');

        if (buttonsignupid && buttonText) {
	   if (userAuthData && userAuthData.state === 'IsLoggedIn') {
                buttonTextloginid.textContent = 'Logout';
                buttonloginid.href = 'https://tradebloccorporatetravel.com/profile';
            } else {
                buttonTextloginid.textContent = 'Login';
                buttonloginid.href = 'https://tradebloccorporatetravel.com/auth/login';
            }
        }

	// Select the logout button by its class name
	    var logoutButton = document.querySelector('.logout-button');

	    // Check if the logout button exists on the page
	    if (logoutButton) {
		// Add a click event listener to the logout button
		logoutButton.addEventListener('click', function() {
		    // Update the AUTH_CURRENT-USER item in localStorage
		    localStorage.setItem('AUTH_CURRENT-USER', JSON.stringify({ state: "IsNotLoggedIn", data: null }));
		    console.log('User logged out, AUTH_CURRENT-USER updated in localStorage');
		});
	    }
    });
</script>

	</body>

</html>
