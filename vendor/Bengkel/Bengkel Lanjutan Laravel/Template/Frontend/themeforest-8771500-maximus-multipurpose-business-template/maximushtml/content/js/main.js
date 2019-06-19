jQuery(function($) {
		"use strict";
		$('[rel=tooltip]').tooltip();
              $('input, textarea').placeholder();
        $('#mc_mv_EMAIL').attr('placeholder', 'Type your email address');
		if($('#testimonials').length){
			$('#testimonials').cycle();
        }
		
		$('.one-staff').hover(function(){
			$(this).parent().parent().find('.one-staff').not($(this)).find('img').stop().css('opacity', '0.6');	 
	
		}, function(){
			$(this).parent().parent().find('.one-staff').find('img').stop().css('opacity', '1');
		});
		
		$('.latest_blog_effect .blog-article').mouseover(function(){
			var $parent = $(this).parent();
			$parent.find('.blog-article').removeClass('active');
			$(this).addClass('active');
		});

		var head = $('header#header');
		$(window).scroll(function(){ 
			var st = $(this).scrollTop();
			if(st > 35){
				$('header#header').css('top', '0px');
				$('header#header').addClass('adjustsub');
            }else{
				$('header#header').css('top', 'auto');
				$('header#header').removeClass('adjustsub');
			}
            st = st/2;
			var $el = $('header#header .row-fluid'); 
			var $logo = $el.find('#logo img');
			if(st <= 15){
				$el.css('padding-bottom', 15-st + 'px');
				$('nav .menu > li').not('.sub-menu li').css('height', 50-st + 'px');		 
				$el.css('padding-top', 15-st + 'px');
				//$logo.css('height', 46-(st*6/10));
			}else{
				$el.css('padding-bottom', 0 + 'px');
				$('nav .menu > li').not('.sub-menu li').css('height', 35 + 'px');			 
				$el.css('padding-top', 0 + 'px');
				//$logo.css('height', 32);
			}
		
		});

		$('.services_large .btn-system').hover(function(){
			$(this).addClass('all_');
		}, function(){
			$(this).removeClass('all_');
		});

		$(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        }); 
		
		$('.dynamic_page_header .btns').each(function(){
			var width = $(this).width();
			$(this).css('width', (width+10)+'px');
			$(this).css('float', 'none');
		});



		$('#header #search-form input').toggle(function(){
			$(this).animate({width:'100px'}, 400);
			$(this).addClass('opened');
		}, function(){
			$(this).animate({width:'0px'}, 400);
			$(this).removeClass('opened');
		});
 
        $('.scrollup').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });
				$('.row-dynamic-el').each(function(){
			var $row = $(this);
			var $services = $row.find('.services_table');
			if($services.length){

				var $next = $row.next('.row-dynamic-el');

				if($row.length && $next.find('.services_table').length){

					$row.addClass('first_row_table');
					var $next_2 = $next.next('.row-dynamic-el');
					if($next_2.find('.services_table').length){
						$next.addClass('another_row_table');
						$next_2.addClass('last_row_table');
					}else{
						$next.addClass('last_row_table');
					}
				}
			}
		});

		$('.blog_categories').each(function(){
	    	var $container = $(this);
	    	var $ac = $(this).find('ul .active a');
	    	var cat = $ac.data('id');
              
	    	var $first = $(this).find('.blog_cat_[data-cat*="'+cat+'"]:first');
	    	
	    	$(this).find('.blog_cat_').fadeOut();
	    	setTimeout(function(){
	    		$first.fadeIn();
	    		$container.find('.blog_cat_[data-cat*="'+cat+'"]').not($first).fadeIn();
	    	}, 500);
	    	

	    	$container.find('li a').live('click', function(e){
		    	e.preventDefault();
		    	$(this).parent().parent().find('li').removeClass('active');
		    	$(this).parent().addClass('active');
		    	var cat = $(this).data('id');
		    	var $first = $container.find('.blog_cat_[data-cat*="'+cat+'"]:first');
		    	$container.find('.blog_cat_').fadeOut();
		    	setTimeout(function(){
		    		$first.fadeIn(); 
		    		$container.find('.blog_cat_[data-cat*="'+cat+'"]').not($first).fadeIn();
		    	}, 500);
	    	});
	    });

	 
          
	



		$(".accordion-group .accordion-toggle").live('click', function(){
			var $self = $(this).parent().parent();
			if($self.find('.accordion-heading').hasClass('in_head')){
				$self.parent().find('.accordion-heading').removeClass('in_head');
			}else{  
				$self.parent().find('.accordion-heading').removeClass('in_head');
				$self.find('.accordion-heading').addClass('in_head');
			}
		});
		
		if($('.recent_sc_portfolio').length){
			$('.recent_sc_portfolio').imagesLoaded(function(){

				$(this).carouFredSel( 
					{
					
						items:6,
						responsive:true,
						scroll : { items : 6 },
						prev : {
						button : $(this).parent().parent().find('.prev')
					},

					next : {
						button : $(this).parent().parent().find('.next')
					}
						

					});
					
			});
		}

		if($('.testimonials_block').length){
			

				$(this).find('#dynamic_testimonial').carouFredSel( 
					{
						

						items:4,
						responsive:true,
						scroll : { items : 1, fx : "scroll", easing  : "swing" },
						prev : {
							button : $(this).find('.prev')
						},

						next : {
							button : $(this).find('.next')
						},
						auto : { play : false}

						

					});
					
			
		} 

	$('.small_widget a').not('.aaaa a').toggle(function(e){
		$('.small_widget').removeClass('active'); 
              e.preventDefault();
		var box = $(this).data('box');
		$('.top_nav_sub').hide();
		$('.top_nav_sub.'+box).fadeIn("400");
              $(this).parent().addClass('active'); 

	}, function(e){
		e.preventDefault();
		var box = $(this).data('box');
              $('.small_widget').removeClass('active');  
		$('.top_nav_sub').fadeOut('400');
		$('.top_nav_sub.'+box).fadeOut('400'); 
            
              
	});
	

    $("audio,video").mediaelementplayer();               



    /* Great Gallery */
    $(".great_gallery").each(function(){

    	var $container = $(this);
    	var $first = $('.item:first', $container);
    	var first_id = $first.data('id');
	$first.addClass('active');
    	$('.single_slide_gallery[data-id="'+first_id+'"]', $container).fadeIn('slow');
    	 

    	
    	$('.item', $container).live('click', function(e){
    		e.preventDefault();
		$container.find('.item').removeClass('active');
		$(this).addClass('active');
    		var $item = $(this);
    		var id = $item.data('id'); 
    		
    				$('.single_slide_gallery', $container).stop(true, true).fadeOut(700);
    				
    				
    				
    				setTimeout( function(){$('.single_slide_gallery[data-id="'+id+'"]', $container).stop(true, true).fadeIn(800)}, 1500);
    				

    		
    				
    			
    		
    	});

    });


    /* End Great Gallery */




	$(".lightbox-gallery").fancybox();
	$('.lightbox-media').fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		helpers : {
			media : {}
		}
	});
	
	

    
	
	$("#tweet_footer").each(function(){
		var $self = $(this);
			$self.carouFredSel( 
				{
					circular : true,
					infinite : true,
					auto : false,
					scroll : {
						items : 1,
						fx : "fade"
					},
					prev : {
						button : $self.parent().parent().find('.back')
					},

					next : {
						button : $self.parent().parent().find('.next')
					}

					

					
				});
       
          
		});


	

	$(".carousel_staff").each(function(){
		var $self = $(this);
		$self.imagesLoaded(function(){
			$self.carouFredSel( 
					{
						circular : true,
						infinite : true,
						auto : false,

						scroll : {
							items : 1
						},
						prev : {
							button : $self.parents('.team_carousel').first().find('.prev')
						},
						next : {
							button : $self.parents('.team_carousel').first().find('.next')
						}

							
					});
			});
	});

     $(".carousel_blog").each(function(event){
	        var $self = $(this);
	     
	        
	       			if( $('li img', $self).size() ) {
	  					$('li img', $self).one("load", function(){
		       				$self.carouFredSel( 
							{
								
								circular: true,
								infinite: true,
								auto 	: false,

								scroll  : {

			        				items           : 1
			        			},

								prev : {

							        button : $self.parents('.latest_blog').find('.prev')

							    },

							    next : {

							        button : $self.parents('.latest_blog').find('.next')

							    }

								
							}, {debug:true});
						}).each(function() {
	  		    			if(this.complete) $(this).trigger("load");
	  					});
					}else{
						$self.carouFredSel( 
							{
								
								circular: true,
								infinite: true,
								auto 	: false,

								scroll  : {

			        				items           : 1 
			        			},

								prev : {

							        button : $self.parents('.latest_blog').find('.prev')

							    },

							    next : {

							        button : $self.parents('.latest_blog').find('.next')

							    }

								
							});
					}
						
	       		
	       			
			
	       	
	          
		});		

$(".carousel_blog_single").each(function(){
	        var $self = $(this);
	        
	        
	       			if( $('li img', $self).size() ) {
	  					$('li img', $self).one("load", function(){
		       				$self.carouFredSel( 
							{
								
								circular: true,
								infinite: true,
								auto 	: false,
								items: 1,
								scroll  : {

			        				items           : 1
			        			},

								prev : {

							        button : $self.parents('.latest_blog_carousel').find('.prev')

							    },

							    next : {

							        button : $self.parents('.latest_blog_carousel').find('.next')

							    }

								
							}, {debug:true});
						}).each(function() {
	  		    			if(this.complete) $(this).trigger("load");
	  					});
					}else{
						$self.carouFredSel( 
							{
								
								circular: true,
								infinite: true,
								auto 	: false,
								items: 1,
								scroll  : {

			        				items           : 1 
			        			},

								prev : {

							        button : $self.parents('.latest_blog_carousel').find('.prev')

							    },

							    next : {

							        button : $self.parents('.latest_blog_carousel').find('.next')

							    }

								
							});
					}
						
	       		
	       			
			
	       	
	          
		});	
							
    if($('.clients').length){
    	$('.clients').imagesLoaded(function(){
			$(this).carouFredSel( 
				{
					items:4,
					auto: false,
					scroll: { items : 1 },
					prev : {
							button : $(this).parent().find('.prev')
					},

					next : {
							button : $(this).parent().find('.next')
					}
					

				});
			});
    }

    if($('.great_gallery .carousel').length){
    	$('.great_gallery .carousel').imagesLoaded(function(){
			$(this).carouFredSel( 
				{
					items:5, 
					auto: false,
					scroll: { items : 1 },
					prev : {
							button : $('.prev', $(this).parent())
					},

					next : {
							button : $('.next', $(this).parent())
					}
					

				});
			});
    }
	

	$("#portfolio-preview-items .portfolio-item .project").hover(function(){
		var $item = $(this).parents('.portfolio-item').first();
		$item.addClass('border_colored');

	}, function(){
		var $item = $(this).parents('.portfolio-item').first();
		$item.removeClass('border_colored');
	});
	function carousel_port_init(){
		$(".carousel_portfolio").each(function(){
			var $self = $(this);
			var cl = 3;
            if($self.parent().hasClass('three-cols')){
				cl = 3;
            }
            if($self.parent().hasClass('four-cols')){
				cl = 4;
            }
            if($self.parent().hasClass('two-cols')){
                cl = 2;
            }
            if($self.parent().hasClass('one-cols')){
				cl = 1;
			}
			$self.imagesLoaded(function(){
				$self.carouFredSel( 
					{
						
						circular: false,
						infinite: false,
						auto: false,

						scroll: {
							items: 1
						},

						prev : {
							button : $self.parents('.recent_portfolio').first().find('.prev')
						},

						next : {
							button : $self.parents('.recent_portfolio').first().find('.next')
						}
					});
			});
		});
	}

    carousel_port_init();
    
    

    $('.testimonials .content li:first-child').addClass('active');   
	$('.testimonials .list li:first-child').addClass('active');
	$('.testimonials .list li').live('click', function(){
		var id = $(this).data('id');
		$(this).parent().find('li').removeClass('active');
		$(this).parent().parent().find('.content').find('li').removeClass('active');
		$(this).parent().parent().find('.content').find('li[data-id="'+id+'"]').addClass('active');
		$(this).addClass('active');
	});
   
	
		
	
	/*$('.big_portfolio').live('click', function(e){
		e.preventDefault();
		
		$.ajax({
					type: "POST",
					url: themeple_global.ajaxurl,
					data: 
					{
						action: 'get_big_portfolio',
						
						
					},
                   
					success: function(response)
					{
						
                        	$('.page').prepend(response);
                        
                        
					},
                    complete: function(response){
                        
                    }
                    
                    
				});
			
		$('<a></a>').prependTo('.page').attr({'class':'close_icon', 'href': '#'});
		$('<i class="icon-remove"></i>').prependTo('.close_icon');
		var curr = get_first_big_item();
		active_big_item(get_first_big_item());
		
			curr = next_big_item(curr)
			active_big_item(curr);
		
		
		
	});
	
	function active_big_item(id){

		$('.big_portfolio_container').fadeOut();
		$('#page-bg img').fadeOut();
		$('.big_portfolio_container').livequery(function(){			
			$('.big_portfolio_container[data-id='+id+'] img').prependTo('#page-bg').css('display', 'none').fadeIn();
			$('.big_portfolio_container[data-id='+id+'] img').remove();
			$('.big_portfolio_container[data-id='+id+']').css('display', 'block').fadeIn();
			$('#page-bg img[data-id='+id+']').css('display', 'block').fadeIn();
		}, function(){});
	}
		
	function get_first_big_item(){
		var id = $('.portfolio-item:first').data('id');
		
		return id;
	}

	function next_big_item(curr){
		var id = $('.portfolio-item[data-id='+curr+']').next().data('id');
		if(!id)
			id = get_first_big_item();
		return id;
	}

	$('.close_icon').live('click',function(e){
		e.preventDefault();
		$('#page-bg img').fadeOut('fast');
		$('.big_portfolio_container').fadeOut('fast');
		$('.top_nav').removeClass('transition_height');
		$('header#header').removeClass('fixed_header ').css('opacity', '0.90');
		$('.top_wrapper').show();
		$('footer').show();
		$('#copyright').show();
	});
	
	*/
	
	
	
	if($().mobileMenu) {
		$('#navigation nav').each(function(){
			$(this).mobileMenu();
			$('.select-menu').customSelect();
		});
		
	}

 

	$('.flexslider').each(function(){ 
		var $s = $(this);
		$s.flexslider({
			slideshowSpeed: 6000,
			animationSpeed: 800,
                     
			controlNav: true,
			pauseOnAction: true,
			pauseOnHover: false,
			start: function(slider) {

				$s.find(" .slides > li .flex-caption").each(function(){
					var effect_in = $(this).attr("data-effect-in");
					var effect_out = $(this).attr("data-effect-out");
					$(this).addClass("animated " + effect_in);
					

				});
			},
			before: function(slider) {
				var current_slide = $s.find(".slides > li").eq(slider.currentSlide);
				$s.find(".slides > li .flex-caption").removeClass('animated');				
				$(".flex-caption", current_slide).each(function(){
					var effect_in = $(this).attr("data-effect-in");
					var effect_out = $(this).attr("data-effect-out");

					$(this).removeClass("animated "+effect_in).addClass("animated " + effect_out);
				});
			},
			after: function(slider) {
				var current_slide = $s.find(".slides > li").eq(slider.currentSlide);
				$s.find(".slides > li .flex-caption").removeClass('animated');				
				$(".flex-caption", current_slide).each(function(){
					var effect_in = $(this).attr("data-effect-in");
					var effect_out = $(this).attr("data-effect-out");

					$(this).removeClass("animated "+effect_out).addClass("animated " + effect_in);
				});
			}		
		});
	});
 
	$('.flexslider_with_thumbnails').flexslider({
		animationSpeed: 400,
		animation: "fade",
		pauseOnHover: false,
		controlNav: "thumbnails"
	});
	$("#attention button.close_button").click(function(){
		$("#attention").height(4);
		$(this).parent().parent().parent().find('.open_button').css('top', 3);
	});
	$("#attention span.open_button").mouseenter(function(){
		$("#attention").height(60);
		$(this).css('top', 59);
	});
	$(".menu a").live('click', function(e){
		var button = $(this);
		
		if($(button).attr('title').length > 0){
			
			e.preventDefault();
			var title = button.attr('title').split("-");
			var blog  = title[0].split("_");
			if(title[1]) 
			var sidebar = title[1].split("_");
			var sidebar_pos = '';
			var blog_type = '';
			if(blog[0] === 'blog'){
				sidebar_pos = sidebar[1];
				blog_type = blog[1];
				document.cookie = 'themeple_blog='+blog_type ;
				document.cookie = 'themeple_sidebar='+sidebar_pos;
				setTimeout(function(){
					window.location.hash = "#wpwrap";
					window.location.href = $(button).attr("href");
								
				}, 1000);
			} 
 
			if(blog[0] === 'header'){
				
				blog_type = blog[1];
				document.cookie = 'themeple_header='+blog_type ;
				setTimeout(function(){
					window.location.hash = "#wpwrap";
					window.location.reload(true);
								 
				}, 1000);
			}
                     
			if(title[0] === 'portfolio_single'){
				 
				
                            
				document.cookie = 'portfolio_single='+title[1] ;
				setTimeout(function(){
					
					window.location.href = $(button).attr("href");
								 
				}, 1000);
			}
        }else{
			window.location.href = $(button).attr("href");
        }
	});

	var $container = $('.filterable');
    
    
    if( $('.tpl2 img', $container).size() ) {
		$('.tpl2 img', $container).one("load", function(){
			$container.isotope({
				filter: '*',
				resizeble: true,
				animationOptions: {
					duration: 750,
					easing: 'linear',
					queue: false
				}
			});
		});

		setTimeout(function(){
			$container.isotope({
				filter: '*',
				resizeble: true,
				animationOptions: {
					duration: 750,
					easing: 'linear',
					queue: false
				}
			});
		}, 100);
   
}
  

 $('nav#portfolio-filter ul li').click(function(){
    var selector = $(this).find('a').attr('data-filter');
    $(this).parent().find('.active').removeClass('active');
    $(this).addClass('active');
    $container.isotope({ 
    filter: selector,
    
	resizeble: true,
    animationOptions: {
		duration: 750,
		easing: 'linear',
		queue: false    
     }
    });
    return false;
  });
	 


	
	$('nav#faq-filter li a').click(function(e){
		e.preventDefault();

		var selector = $(this).attr('data-filter');

		$('.faq .accordion-group').fadeOut();
		$('.faq .accordion-group'+selector).fadeIn();

		$(this).parents('ul').find('li').removeClass('active');
		$(this).parent().addClass('active');
	});

	
	
});