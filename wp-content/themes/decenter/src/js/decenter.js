(function($) {
		
	$(document).ready(function () {
		$('.submit-subscribe').click(function(e) {
			e.preventDefault();
			var load_email = $(this).siblings().find( $(".subscribe-input") ).val();		
			var pattern = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			if(pattern.test(load_email)){
				
				$('input[name="EMAIL"]').css({'border' : '1px solid #fff'});
				
				var isDisabled = $(this).is(':disabled');
				if (isDisabled) {
					return false;	
				} else {
					$(this).prop('disabled', true);
					console.log ('ok');
					let subscribe_post_data = {
						action  : 'subscribe_post_handler',
						subscribe_email: $(this).siblings().find( $(".subscribe-input") ).val(),
						subscriber_id: $(this).siblings().find( $(".subscribe-input") ).attr('data-user-id'),
						security: $(this).siblings("#_wpnonce").val(),
					};
					Subscribe.send_email(subscribe_post_data);
				}
				
			} else {
				$('input[name="EMAIL"]').css({'border' : '1px solid #ff0000'});
				return false;
			}
			return true;
		})
		
		var Subscribe = {
			
			subscribe_post_request: false,
			load_post_event  : false,
			
			send_email: function (subscribe_post_data) {
				
				if (self.subscribe_post_request === true) {
					self.load_post_event.abort();
				}
				
				self.load_post_event = jQuery.ajax({
					type      : 'POST',
					url       : "/wp-admin/admin-ajax.php",
					dataType  : 'json',
					data      : subscribe_post_data,
					beforeSend: function () {
						self.subscribe_post_request = true;
					},
					success   : function (response) {
						if (response.data.success) {	
							$('input[name="EMAIL"]').val('');
							$('.subscribe-message').html('<p>'+ response.data.msg +'</p>');
							
						} else { 
							$('input[name="load_post"]').prop('disabled', false);
							$('.subscribe-message').html('<p>'+ response.data.msg +'</p>');
						}
						self.subscribe_post_request = false;
					},
					error     : function (e) {
						$('.subscribe-message').html('<p>'+ response.data.msg +'</p>');
						$('input[name="load_post"]').prop('disabled', false);
						response.data.subscribe
						self.subscribe_post_request = false;
					}
				});
			},
		}
		
		if ( localStorage.getItem('light') ) {
			var e = document.createElement("div");
				e.innerHTML = '<link id="night_css" rel="stylesheet" href="/wp-content/themes/decenter/src/css/night.css">';
				var n = e.childNodes[0];
				document.getElementsByTagName("head")[0].appendChild(n);
				localStorage.setItem("light", !0)
		}	
		
		$('.light').click(function(e) {
			if ( localStorage.getItem('light') ) {
				document.getElementById("night_css").remove();
				localStorage.removeItem("light")
			} else {
				var e = document.createElement("div");
				e.innerHTML = '<link id="night_css" rel="stylesheet" href="/wp-content/themes/decenter/src/css/night.css">';
				var n = e.childNodes[0];
				document.getElementsByTagName("head")[0].appendChild(n);
				localStorage.setItem("light", !0);
			}
		});
		
		$(window).scroll(function() {
			if ($(document).scrollTop() > 500) {
				$('.arrow-top').addClass('active');
				$('#share').css({'position' : 'fixed', 'top' : '40px'});
			} else {
				$('.arrow-top').removeClass('active');
				$('#share').css({'position' : 'absolute', 'top' : 'unset'});
			}
		});
					
		$('.arrow-top').click(function() {
			$('html, body').animate({scrollTop: 0},1000);
			return false;
		})
		
		/*
		if (  $("#share").length ) {
			var target = $('.comments');
			var targetPos = target.offset().top;
			var winHeight = $(window).height() - 400;
			var scrollToElem = targetPos - winHeight;
			$(window).scroll(function(){
			  var winScrollTop = $(this).scrollTop();
			  var targetPosTop = targetPos - 300;
			  if(winScrollTop > scrollToElem){
				 $('#share').css({'position' : 'absolute', 'top' : '' + targetPosTop +'px'});
			  }
			});
		}
		
		*/
		
		$('#search-bar input').on('input', function () {
			var msg = $(this).val();
			$('.control').addClass('active');
			var value = $('#search-bar input').val();
			if (value == '') {
				$('.control').removeClass('active');
			}
		});
		/*
		$('#search-bar input').keydown(function(e) {
		if(e.keyCode === 13) {
			console.log($(this).val());
		  
		}
		});
		*/
		
		$('.control .clear').on('click', function () {
			$('#search-bar input').val('');
			$('.control').removeClass('active');
		});
		

	});
	
	
})(jQuery)