jQuery(document).ready(function() {

// Scroll page with easing effect
    $('.navbar ul li a, .navbar-brand,.callHome, .back-to-top').bind('click', function(e) {
        //e.preventDefault();
        target = this.hash;
        $.scrollTo(target, 800, {
        	easing: 'easeOutCubic'
        });

   	});

	// Apply Bootstrap Scrollspy to show active navigation link based on page scrolling
	$('.navbar').scrollspy();
    
        jQuery("#nav").sticky({topSpacing:0});
    
	// Show/Hide Sticky "Go top" button
	$(window).scroll(function(){
		if($(this).scrollTop()>200){
			$(".go-top").fadeIn(200);
		}
		else{
			$(".go-top").fadeOut(200);	
		}
	}); 
	
	// Scroll Page to Top when clicked on "go top" button
	$(".go-top").click(function(event){
		event.preventDefault();

		$.scrollTo('#home', 1500, {
        	easing: 'easeOutCubic'
        });
	}); 
	
	});