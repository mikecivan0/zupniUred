$(window).load(function() {

	// For each instance of p.caption
	$("p.caption").each(function() {
		$(this)
		// Add the following CSS properties and values
		.css({
			// Height equal to the height of the image
			"height" : $(this).children("img").height() + "px",
			// Width equal to the width of the image
			"width" : $(this).children("img").width() + "px"
		})
		// Select the child "span" of this p.caption
		// Add the following CSS properties and values
		.children("span").css(

		// Width equal to p.caption
		// But subtract 20px to callibrate for the padding
		"width", $(this).width() - 20 + "px")

		// find the <big> tag if it exists
		// And then add the following div to break the line
		.find("big").after('<div class="clear"></div>');

		// When you hover over p.caption
		$("p.caption").hover(function() {

			// Fade in the child "span"
			$(this).children("span").stop().fadeTo(400, 1);
		}, function() {
			// Once you mouse off, fade it out
			$(this).children("span").stop().delay(600).fadeOut(400);
		});
		// End $(this)
	});

}); 