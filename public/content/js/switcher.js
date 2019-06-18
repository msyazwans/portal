jQuery(function($){
	var m_post = getCookie('themeple_position');
	 if(m_post == 'center'){
			$('nav .menu').each(function(){
				var width = $(this).width();
				var half = width/2;
				$(this).css('margin-left', -half+'px');
				$(this).css('left', '50%');
			});	
	}else{
		$('nav .menu').each(function(){
				var width = $(this).width();
				var half = width/2;
				$(this).css('margin-left','0px');
				$(this).css('left', '0%');
			});
	}

	checkCookie();
	$("#color-skin a").live('click', function(){
			var button = $(this);
			
			var color = button.data('value');
			

			document.cookie = 'themeple_skin='+color ; 
			setTimeout(function(){
									    window.location.hash = "#wpwrap";
							 			window.location.reload(true);
									
	        }, 1000);




			/*}else if(title[0] == 'blog'){
				document.cookie = 'themeple_blog='+title[1] ; 
				setTimeout(function(){
									    window.location.hash = "#wpwrap";
							 			window.location.reload(true);
									
	             }, 1000);
			}else if(title[0] == 'layout'){
				document.cookie = 'themeple_layout='+title[1] ; 
				setTimeout(function(){
									    window.location.hash = "#wpwrap";
							 			window.location.reload(true);
									
	             }, 1000);
			}*/
	});

	$("#reset").live('click', function(e){
			e.preventDefault();
			del_cookie("themeple_pattern");
			del_cookie("themeple_skin");
			del_cookie("themeple_bg_img");
			del_cookie("themeple_bg");
			del_cookie("themeple_position");
			del_cookie("themeple_layout");
			del_cookie("themeple_greyscale");
			del_cookie("themeple_top_widget");
			setTimeout(function(){
									    window.location.hash = "#wpwrap";
							 			window.location.reload(true);
									
	        }, 500);
	}); 

	$("#headers").live('change', function(){
		var value = $(this).val();
		if(value == 'header_2'){
			setTimeout(function(){
									    window.location.href = "http://olympus2.themeple.co";
							 		  
									
	       	}, 1000 );
		}else{
				document.cookie = 'themeple_header='+value ; 
			setTimeout(function(){
									    window.location.hash = "#wpwrap";
							 			window.location.reload(true);
									
	       	}, 1000 );
		}
	});
       $("#top-widget").live('change', function(){
		var value = $(this).val();
		if(value == 'yes'){
			$('.top_nav').show();	
		}else{$('.top_nav').hide();}
		document.cookie = 'themeple_top_widget='+value ; 
		setTimeout(function(){
									    window.location.hash = "#wpwrap";
							 			window.location.reload(true);
									
	       }, 1000);
	});

	$("#image-processing").live('change', function(){
		var value = $(this).val();
		if(value == 'image-none'){
			$('.recent_portfolio').removeClass('image-desaturate');
			$('.filterable').removeClass('image-desaturate');
		}else{
			$('.recent_portfolio').addClass('image-desaturate');
			$('.filterable').addClass('image-desaturate');
		}
		document.cookie = 'themeple_greyscale='+value ; 
	});

	$("#layout").live('change', function(){
		var value = $(this).val();
		if(value == 'fullwidth'){
			del_cookie("themeple_pattern");
			del_cookie("themeple_bg_img");
			del_cookie("themeple_bg");
		}else
		   document.cookie = 'themeple_bg=color-default' ;

		document.cookie = 'themeple_layout='+value ; 
				setTimeout(function(){
									    window.location.hash = "#wpwrap";
							 			window.location.reload(true);
									
	    }, 1000);
	});
 
	$("#bgpattern a").live('click', function(){
		var value = $(this).data('class');
		$('#page-bg img').remove();

		document.cookie = 'themeple_pattern='+value ; 
		$("body").addClass(value);
		del_cookie("themeple_bg_img");
		del_cookie("themeple_bg");
		if(getCookie('themeple_layout') != 'boxed'){
			document.cookie = 'themeple_layout=boxed' ; 
					setTimeout(function(){
										    window.location.hash = "#wpwrap";
								 			window.location.reload(true);
										
		    }, 1000);
		}
	});




	$("#bgimage a").live('click', function(){
		var value = $(this).data('src');
		$('#page-bg img').remove();
		var img = $('<img >'); //Equivalent: $(document.createElement('img'))
		img.attr('src', value);
		img.appendTo('#page-bg');
		document.cookie = 'themeple_bg_img='+value ; 
		del_cookie("themeple_pattern");
		del_cookie("themeple_bg");
		if(getCookie('themeple_layout') != 'boxed'){
			document.cookie = 'themeple_layout=boxed' ; 
					setTimeout(function(){
										    window.location.hash = "#wpwrap";
								 			window.location.reload(true);
										
		    }, 1000);
		}
		
	});

	$("#bgcolor a").live('click', function(){
		var value = $(this).data('class');
		$('#page-bg img').remove();
		$("body").addClass(value);
		document.cookie = 'themeple_bg='+value ; 
		del_cookie("themeple_pattern");
		del_cookie("themeple_bg_img");
		if(getCookie('themeple_layout') != 'boxed'){
			document.cookie = 'themeple_layout=boxed' ; 
					setTimeout(function(){
										    window.location.hash = "#wpwrap";
								 			window.location.reload(true);
										
		    }, 1000);
		}
	});



	function getCookie(c_name)
	{
		var i,x,y,ARRcookies=document.cookie.split(";");
		for (i=0;i<ARRcookies.length;i++)
		{
		  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
		  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
		  x=x.replace(/^\s+|\s+$/g,"");
		  if (x==c_name)
		    {
		    return unescape(y);
		    }
		  }
	}

	function checkCookie()
	{
		
		var layout=getCookie("themeple_layout");
		
		  if (layout!=null && layout=="boxed")
		  {
			  $("#layout option").each(function(){
		        if($(this).val()==layout){ // EDITED THIS LINE
		            $(this).attr("selected","selected");    
		        }
	    	   });
		  }
		var pattern= getCookie("themeple_pattern");
			if(pattern!= null && pattern != ""){
				
				$('#page-bg img').remove();
				$("body").addClass(pattern);
			}
		var bg_img= getCookie("themeple_bg_img");
			if(bg_img!= null && bg_img != ""){

				$('#page-bg img').remove();
				var img = $('<img >'); //Equivalent: $(document.createElement('img'))
				img.attr('src', bg_img);
				img.appendTo('#page-bg');
			}
		var greyscale= getCookie("themeple_greyscale");
			if(greyscale!= null && greyscale != ""){
				if(greyscale == 'image-none'){
					$('.recent_portfolio').removeClass('image-desaturate');
				}else
					$('.recent_portfolio').addClass('image-desaturate');

				 $("#image-processing option").each(function(){
			        if($(this).val()==greyscale){ // EDITED THIS LINE
			            $(this).attr("selected","selected");    
			        }
		    	 });
			}
		var bg= getCookie("themeple_bg");
			if(bg!= null && bg != ""){

				$('#page-bg img').remove();
				$("body").addClass(bg);
			}

		var header=getCookie("themeple_header");
		
		  
			  
		  	 $("#headers option").each(function(){
		        	if($(this).val()==header){ 
		            		$(this).attr("selected","selected");    
		        	}
	    	   	 });
		 		  

		var widget=getCookie("themeple_top_widget");
		
		  if ( widget=="no")
		  {
			  
		  	 $("#top-widget option").each(function(){
		        	if($(this).val()==widget){ 
		            		$(this).attr("selected","selected");    
		        	}
	    	   	 });
		  }else if ( widget=="yes")
		  {
			  
		  	 $("#top-widget option").each(function(){
		        	if($(this).val()==widget){ 
		            		$(this).attr("selected","selected");    
		        	}
	    	   	 });
		  }




	}

	function del_cookie(name)
	{
	    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
	}


});