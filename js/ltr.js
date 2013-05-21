// Import (prepend) js files
// @codekit-prepend "jquery.mmenu.js", "skip-link-focus-fix.js", "jquery.fitvids.js", "jquery.scrollUp.js";

// Facebook
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=231463461638";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// jQuery
jQuery(document).ready(function($) {
    
	// mmenu
	if ( $(window).width() < 650) {
		$('#site-navigation').mmenu();
	}

	// Fitvids
	$('.widget, .entry-content, .format-video').fitVids();

	// Make Instagram pictures play nice with Fancybox
	$('a.instagram-photo-link').attr('rel', 'fancybox[instagram]');

	// Scroll to top
	$.scrollUp({
		animation: 'slide',
		scrollImg: true
	});
	
});