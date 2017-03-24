
(function ($, window, document, undefined) {

	var pluginName = "bonno",
		defaults = {
			sliderFx: 'fade',		// Slider effect. Can be 'slide', 'fade', 'crossfade'
			sliderInterval: 6000,		// Interval
			speedAnimation: 600,        // Default speed of the animation
			teamHeight : 450            // Team extend height
		},
		$win = $(window),
		$doc = $(document),
		$html = $('html'),
		onMobile = false,
		scrT;

	// The plugin constructor
	function Plugin(element, options) {
		var that = this;
		that.element = $(element);
		that.options = $.extend({}, defaults, options);

		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			onMobile = true;
			$win.scrollTop(0);
			$('body').addClass('mobile');
		} else {
			$('body').addClass('no_mobile');
		}

		that.init();

		// onLoad function
		$win.load(function(){
			if ($('#preloader').length) {
				$('#status').fadeOut();
				$('#preloader').delay(300).fadeOut(200, function() {
					that.activate();
					that.sliders();
					that.onesliders();
					setTimeout( function(){
						that.fNum();
					}, 250);
					$('body').removeClass('loading');
				});
			}
			that.activate();
			that.sliders();
			that.onesliders();
			$.each(that.mask, function(index, mask) {
				$(mask).height($(mask).parent().actual('height'));
				$(mask).width($(mask).parent().actual('width'));
			});
			setTimeout( function(){
				that.fNum();
			}, 250);
			$('body').removeClass('loading');
			that.setMenuAlignment();
		}).scroll(function(){   // onScroll function
			that.fNum();
		}).resize(function(){  // onResize function
			$.each(that.mask, function(index, mask) {
				$(mask).height($(mask).parent().actual('height'));
				$(mask).width($(mask).parent().actual('width'));
			})
			that.onesliders();
			if ($win.actual('width') > 800){
				$html.css('overflow', 'auto');
				$('.header').removeClass('opened').css('height','auto');
				$('.slicknav_btn').removeClass('slicknav_open').addClass('slicknav_collapsed');
				$('.slicknav_nav').addClass('slicknav_hidden');
			}
			that.setMenuAlignment();
		});

	}

	Plugin.prototype = {
		init: function () {
			this.body = $(document.body);
			this.wrapper = $('.wrapper');
			this.mainmenu = $('.mainmenu');

			this.slider = $('.slider');
			this.oneslider = $('.oneslider');
			this.popupslider = $('.popupslider');
			this.history = $('.history');
			this.gallery = $('.gallery');
			this.heading = $('.heading');
			this.navPortfolio = $('.nav-portfolio');
			this.portfolio = $('.portfolio');
			this.worksContainer = $('.works-container');
			this.num = $('[data-num]');
			this.maps = $('.map');

			this.team = $('.team');
			this.mask = $('.mask');

			this.internal = $('.internal');
			this.loadmore = $('.loadmore');

			this.blogroll = $('.blogroll');
			this.blogpost = this.blogroll.find('.col');

			this.sel = $('select');

			this.contactForm = $('.wpcf7-form');
			this.contactFormName = $('.wpcf7-text');
			this.contactFormEmail = $('.wpcf7-email');
			this.contactFormMessage = $('.wpcf7-textarea');

			this.commentsForm = $('#commentform');
			this.commentsFormName = $('.comment-form-author #author');
			this.commentsFormEmail = $('.comment-form-email #email');
			this.commentsFormMessage = $('.comment-form-comment #comment');


			this.emailValidationRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		},
		activate: function () {
			var instance = this;

			if (instance.sel.length > 0) {
				instance.sel.chosen();
			}

			// Starting animation
			$('.header').animate({'opacity': 1}, sp, 'easeInOutQuad');
			var sp = instance.options.speedAnimation/1.5;

			if( instance.heading.length > 0)
				instance.heading.find('h1').delay(sp).animate({'opacity': 1}, sp/1.2, 'easeInOutSine');

			if (instance.body.hasClass('page404')){
				instance.heading.find('hr').delay(sp*2.2).animate({
				   'width': '100%',
					'left': 0
				}, sp*1.5, 'easeOutQuart');
				$('.content, footer').delay(sp*1.5).animate({'opacity': 1}, sp, 'easeInOutQuad');
			} else {
				instance.heading.find('hr').delay(sp*2.2).animate({
					'width': '100%',
					'left': 0
				}, sp*1.5, 'easeOutQuart');
				$('.content, footer').delay(sp*2.5).animate({'opacity': 1}, sp, 'easeInOutQuad');
			}

			//instance.mainmenu.find('.menu-item-has-children > a').on('click', function(e){ e.preventDefault(); });

			instance.internal.on('click', function(e){
				e.preventDefault();
				var $this = $(this),
					url = $this.attr('href'),
					urlTop = $(url).offset().top;

				$('body, html').stop(true,true).animate({scrollTop: urlTop }, instance.options.speedAnimation);
			});

			$(document).on('mouseover', '.blogroll .col h4', function(){
				$(this).parents('.col').addClass('hover');
			});
			$(document).on('mouseout', '.blogroll .col h4', function(){
				$(this).parents('.col').removeClass('hover');
			});

			$.each(instance.mask, function(index, mask) {
				$(mask).height($(mask).parent().actual('height'));
			})

			// portfolio items sortable
			if ( instance.blogroll.length === 1){
				var posts = instance.blogroll[0];
				var msnry = new Masonry( posts, {
					itemSelector: '.col'
				});

				$(document).on('click', '.loadmore a', function(e) {
					e.preventDefault();
					var nextposts = $('<div class="next-posts">');
					instance.blogroll.append(nextposts);
					var button = $(this);
					$.get('/wp-admin/admin-ajax.php', {
						action: 'load_more',
						category: button.data('category'),
						author: button.data('author'),
						tag: button.data('tag'),
						limit: button.data('limit'),
						offset: button.data('offset'),
						page: button.data('page')
					}, function(data) {
						data = jQuery.parseJSON(data);
						nextposts.append(data.markup);
						button.data('page', data.page);
						var addmsnry = new Masonry( posts, {
							itemSelector: '.col'
						});
						$('html, body').animate({ scrollTop: $(nextposts).find('div').first().offset().top - 100}, 1000);
						if (data.hide == true)
							instance.loadmore.find('a').hide();
						nextposts.animate({'opacity': 1}, instance.options.speedAnimation, 'easeOutSine');
					});
				});
			}

			instance.mainmenu.slicknav({
				label: '',
				prependTo: '.header .slicknav_target',
				allowParentLinks: true
			});

			$(document).on('click', '.slicknav_collapsed', function (e) {
				$html.css('overflow-y','auto');
			});

			$(document).on('click', '.slicknav_open', function(e){
				$html.css('overflow','hidden');
			});

			// Mixup portfolio
			if (instance.worksContainer.length){

				var hsh = window.location.hash.replace('#','.'),
					worksNavArr = [],
					worksIndex,
					worksEq;

				instance.navPortfolio.find('li').each(function(){
					worksNavArr.push($(this).children().data('filter'));
				});

				worksIndex = worksNavArr.indexOf(hsh.replace('#','.'));

				if (worksIndex < 0)
					worksIndex = 0;

				if (hsh == '.all')
					hsh = 'all';


				instance.worksContainer.mixItUp({
					load: {
						filter: hsh != '' ? hsh : 'all'
					},
					callbacks: {
						onMixStart: function(state, futureState) {
							instance.navPortfolio.find('ins').removeAttr('style');
						},
						onMixEnd: function(state) {
							instance.navPortfolio.find('a.active ins').animate({
								'width': '100%',
								'left': 0
							}, instance.options.speedAnimation, 'easeOutQuart', function() {
								if (!$(this).parent('a').hasClass('active'))
									$(this).animate({
										'width': '0%',
										'left': '50%'
									}, instance.options.speedAnimation, 'easeOutQuart');
							});
						}
					}
				});

			}

			// Google Map
			if(instance.maps.length > 0) {
				var maps = [];
				$.each(instance.maps, function(index, map) {
					var x = $(map).data('lat'),
						y = $(map).data('long'),
						zoom = $(map).data('zoom'),
						myLatlng = new google.maps.LatLng(x,y);

					var mapOptions = {
						zoom: zoom,
						scrollwheel: false,
						navigationControl: false,
						mapTypeControl: false,
						scaleControl: false,
						draggable: true,
						mapTypeId: google.maps.MapTypeId.ROADMAP,
						center: new google.maps.LatLng(x, y)
					};
					maps[index] = new google.maps.Map(map, mapOptions);

					var marker = new google.maps.Marker({
						position: myLatlng,
						map: maps[index]
					});
				})

			}

			// Contact map
			instance.contactFormName.focusout(function(){
				if (!!$(this).attr('aria-required') != true)
					return;
				if ($(this).val() == '')
					$(this).addClass('invalid');
			}).focusin(function(){
				$(this).removeClass('invalid');
			});

			instance.contactFormMessage.focusout(function(){
				if (!!$(this).attr('aria-required') != true)
					return;
				if ($(this).val() == '')
					$(this).addClass('invalid');
			}).focusin(function(){
				$(this).removeClass('invalid');
			});

			instance.contactFormEmail.focusout(function(){
				if (!!$(this).attr('aria-required') != true)
					return;
				if (($(this).val() == '') || (!instance.emailValidationRegex.test($(this).val()))) {
					$(this).addClass('invalid');
				}
			}).focusin(function(){
				$(this).removeClass('invalid');
			});

			instance.contactForm.on('submit', function(){
				var hasErrors = false;

				if (instance.contactFormName.val() === '') {
					hasErrors = true;
					instance.contactFormName.addClass('invalid');
				}

				if (instance.contactFormMessage.val() === '') {
					hasErrors = true;
					instance.contactFormMessage.addClass('invalid');
				}

				if ((instance.contactFormEmail.val() === '')
					|| (!instance.emailValidationRegex.test(instance.contactFormEmail.val()))) {
					hasErrors = true;
					instance.contactFormEmail.addClass('invalid');
				}

				if (hasErrors) {
					return false;
				}
			});


			// Comments form
			instance.commentsFormName.focusout(function(){
				if (!!$(this).attr('aria-required') != true)
					return;
				if ($(this).val() == '') {
					$(this).addClass('invalid');
					$('label[for="' + $(this).attr('id') + '"]').addClass('invalid');
				}
			}).focusin(function(){
				$(this).removeClass('invalid');
				$('label[for="' + $(this).attr('id') + '"]').removeClass('invalid');
			});

			instance.commentsFormMessage.focusout(function(){
				if (!!$(this).attr('aria-required') != true)
					return;
				if ($(this).val() == '') {
					$(this).addClass('invalid');
					$('label[for="' + $(this).attr('id') + '"]').addClass('invalid');
				}
			}).focusin(function(){
				$(this).removeClass('invalid');
				$('label[for="' + $(this).attr('id') + '"]').removeClass('invalid');
			});

			instance.commentsFormEmail.focusout(function(){
				if (!!$(this).attr('aria-required') != true)
					return;
				if (($(this).val() == '') || (!instance.emailValidationRegex.test($(this).val()))) {
					$(this).addClass('invalid');
					$('label[for="' + $(this).attr('id') + '"]').addClass('invalid');
				}
			}).focusin(function(){
				$(this).removeClass('invalid');
				$('label[for="' + $(this).attr('id') + '"]').removeClass('invalid');
			});

			instance.commentsForm.on('submit', function(){
				var hasErrors = false;

				if (!!instance.commentsFormName.attr('aria-required') == true && instance.commentsFormName.val() == '' ) {
					hasErrors = true;
					instance.commentsFormName.addClass('invalid');
					$('label[for="' + instance.commentsFormName.attr('id') + '"]').addClass('invalid');
				}

				if (!!instance.commentsFormMessage.attr('aria-required') == true && instance.commentsFormMessage.val() == '' ) {
					hasErrors = true;
					instance.commentsFormMessage.addClass('invalid');
					$('label[for="' + instance.commentsFormMessage.attr('id') + '"]').addClass('invalid');
				}

				if (!!instance.commentsFormEmail.attr('aria-required') == true && ( instance.commentsFormEmail.val() === ''
					|| (!instance.emailValidationRegex.test(instance.commentsFormEmail.val())) ) ) {
					hasErrors = true;
					instance.commentsFormEmail.addClass('invalid');
					$('label[for="' + instance.commentsFormEmail.attr('id') + '"]').addClass('invalid');
				}

				if (hasErrors) {
					return false;
				}
			});

			// TEAM
			if (instance.team.length > 0){
				var speed = instance.options.speedAnimation/1.5,
					itemH = instance.team.find('.profile').actual('height');

				instance.team.find('.img').on('click', function(e) {
					e.preventDefault();

					if ($(this).parents('.profile').hasClass('no_content')) {
						instance.team.find('.expandteam').removeClass('active');
						closeExpand();
						return false;
					}

					var $this = $(this),
						$expand = $this.parent().find('.expandteam'),
						leftPos = $this.offset().left,
						topPos = +$this.parent().offset().top,
						wid = $this.outerWidth(),
						hei = $this.outerHeight(),
						expndHei = $expand.actual('height'),
						corner = $expand.find('.corner'),
						actPos;

					$('.corner').css({'display': 'none'});
					corner.css({'left': leftPos + wid/2, 'display': 'block'});

					instance.team.find('.active').addClass('before');
					instance.team.find('.expandteam').removeClass('active');
					$expand.addClass('active');


					if (instance.team.find('.before').length > 0){
						actPos = +instance.team.find('.before').parent().offset().top;
					}

					instance.team.find('.expandteam').removeClass('before');
					if ( topPos != actPos){
						closeExpand();

						$this.parent().stop(true,true).animate({'height': (instance.options.teamHeight+327)}, speed, 'easeInQuad');
						$expand.css('overflow', 'visible').stop(true,true).animate({'height': instance.options.teamHeight}, speed, 'easeInQuad');
						$expand.find('.inner').stop(true,true).animate({'height': instance.options.teamHeight}, speed, 'easeInQuad');
					} else {
						$this.parent().css({'height': (instance.options.teamHeight+327)});
						$expand.css('overflow', 'visible').css({'height': instance.options.teamHeight});
						$expand.find('.inner').css({'height': instance.options.teamHeight});
						setTimeout(closeExpand, 1);
					}

				});

				function closeExpand(){
					$('.expandteam').not(".active").css('overflow', 'hidden').stop(true,true).animate({'height': 0, 'overflow': 'hidden'}, speed, 'easeInQuad');
					$('.expandteam').not(".active").find('.inner').stop(true,true).animate({'height': 0}, speed, 'easeInQuad');
					$('.expandteam').not(".active").parents('.col').stop(true,true).animate({'height': itemH}, speed, 'easeInQuad');
				}

				$win.resize( function(){
					$('.expandteam').removeClass('active');
					closeExpand();
				});

				$('.expandteam .close').on('click', function(e){
					e.preventDefault();
					$(this).parents('.expandteam').removeClass('active');
					closeExpand();

				});
			}

			// Popup Gallery
			if (instance.popupslider.length > 0) {
				$.each(instance.popupslider, function(index, popupslider) {
					$(popupslider).find('> ul').magnificPopup({
						delegate: 'a',
						type: 'image',
						tLoading: '',
						mainClass: 'popup-gallery',
						gallery: {
							enabled: true,
							navigateByImgClick: true,
							preload: [0, 1]
						},
						image: {
							tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
							titleSrc: function (item) {
								return item.el.attr('title');
							}
						}
					});
				});
			}
			if (instance.gallery.length > 0) {
				$.each(instance.gallery, function(index, gallery) {
					$(gallery).magnificPopup({
						delegate: 'a',
						type: 'image',
						tLoading: '',
						gallery: {
							enabled: true,
							navigateByImgClick: true,
							preload: [0, 1]
						},
						image: {
							tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
							titleSrc: function (item) {
								return item.el.attr('title');
							}
						}
					});
				})

			}
		},
		sliders: function(){
			var instance = this;

			if (instance.slider.length > 0){
				instance.slider.each(function(e){
					var $this = $(this),
						slidewrap = $this.find('ul'),
						sliderFx = slidewrap.data('fx'),
						sliderAuto = slidewrap.data('auto'),
						maxItems = ($this.hasClass('popupslider') || $this.hasClass('history')) ? 3 : 4,
						scrollItems = ($this.hasClass('history')) ? 1 : 'auto',
						sliderCircular = slidewrap.data('circular');

					$this.attr('id', 'slider-'+e);

					slidewrap.carouFredSel({
						infinite: (typeof sliderCircular) ? sliderCircular : true,
						circular: (typeof sliderCircular) ? sliderCircular : true,
						width: '100%',
						auto : sliderAuto ? sliderAuto : false,
						scroll : {
							fx : sliderFx ? sliderFx : 'crossfade',
							duration : instance.options.speedAnimation,
							timeoutDuration : instance.options.sliderInterval,
							items: scrollItems
						},

						swipe : {
							onTouch : true,
							onMouse : false
						},
						prev : $('#slider-'+e).find('.prev'),
						next : $('#slider-'+e).find('.next'),
						pagination : $('#slider-'+e).find('.pagination')
					}).parent().css('margin', 'auto');

					if ( $this.hasClass('logos') ) {
						var elements = $this.find('li');
						var height = 0;
						$.each(elements, function(index, element) {
							var elementHeight = $(element).actual('height');
							if (elementHeight > height)
								height = elementHeight;
						})
						elements.css({
							height: height + 5,
							lineHeight: height - 5 + 'px'
						});
						elements.find('a').css('line-height', height + 'px');
					}
				});
			}
		},
		onesliders: function(){
			var instance = this;

			if (instance.oneslider.length > 0){
				instance.oneslider.each(function(e){
					var $this = $(this),
						slidewrap = $this.find('ul'),
						sliderFx = slidewrap.data('fx'),
						sliderAuto = slidewrap.data('auto');

					$this.attr('id', 'oneslider-'+e);

					slidewrap.carouFredSel({
						responsive: true,
						auto : sliderAuto ? sliderAuto : false,
						scroll : {
							fx : sliderFx ? sliderFx : 'crossfade',
							duration : instance.options.speedAnimation,
							timeoutDuration : instance.options.sliderInterval
						},
						items : {
							visible : 1,
							height: 'auto',
							width: 1200
						},
						swipe : {
							onTouch : true,
							onMouse : false
						},
						prev : $('#oneslider-'+e).find('.prev'),
						next : $('#oneslider-'+e).find('.next'),
						pagination: {
							container: $('#oneslider-'+e).find('.pagination'),
							anchorBuilder: function() {
								if ($(this).parents(instance.oneslider.hasClass('pricing'))) {
									var per = $(this).data('period');
									return '<a href="#"><span>'+ per +'</span></a>';
								}
							}
						}
					}).parent().css('margin', 'auto');
				});
			}
		},
		fNum: function(){
			var instance = this,
				numbS;

			if (instance.num.length > 0){

				instance.num.parent().each(function(){
					var self = $(this),
						winTop = $win.scrollTop(),
						topPos = self.offset().top - $win.actual('height'),
						blHeight = self.actual('height') - 100,
						sectionTop = self.offset().top;

					if (!self.hasClass('target')) {
						self.find(instance.num).each(function(){
							var $this = $(this),
								numb = $this.data('num'),
								incr = $this.data('increment'),
								fractional = $this.data('fractional') ? $this.data('fractional') : 0,
								i = 0,
								timer;

							if ( (winTop >= topPos) && !onMobile || (winTop === sectionTop)){
								timer = setTimeout(function run() {
									if ( i < numb) i+=incr;
									else {
										i = numb;
										$this.text(i.toFixed(fractional).replace('.',',').replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 '));
										return i;
									}
									$this.text(i.toFixed(fractional).replace('.',',').replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 '));

									timer = setTimeout(run, 20);
								}, 20);

								$this.parent().addClass('target');
							} else {
								numbS = numb.toString().replace('.',',');
								$this.text(numbS.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 '));
							}
						});
					}
				});

			}
		},
		setMenuAlignment: function() {
			var instance = this;
			$.each(instance.mainmenu.find('.menu-item-has-children > a'), function(index, el) {
				offs = $(el).offset().left,
				dropW = $(el).next().outerWidth(),
				ww = $win.actual('width');

				$(el).next().delay(100).fadeIn(instance.options.speedAnimation/2);

				if (ww <= (offs + dropW)){
					$(el).next().addClass('otherwise');
				} else {
					$(el).next().removeClass('otherwise');
				}
			});
		}
	};

	$.fn[pluginName] = function (options) {
		return this.each(function () {
			if (!$.data(this, "plugin_" + pluginName)) {
				$.data(this, "plugin_" + pluginName,
					new Plugin(this, options));
			}
		});
	};
})(jQuery, window, document);

(function ($) {
	$(document.body).bonno();

	// Fix pricing titles
	if ($('.pricing').length) {
		$.each($('.pricing').not('section, .oneslider').parent('div'), function(index, pricingtab) {
			var titles = '';
			$.each($(pricingtab).find('> div').not('.plan-titles-divider'), function(index, column) {
				titles += '<div class="col ' + $(column).data('class') + ' plan-title empty eq">' + ( $(column).data('title').length ? '<h5 class="color">' + $(column).data('title') + '</h5>' : '&nbsp;' ) + '</div>';
			})
			if ($(pricingtab).hasClass('equal'))
				$('<div class="pricing-titles equal">' + titles + '</div>').insertBefore($(pricingtab));
			else
				$(pricingtab).prepend($(titles + '<div class="plan-titles-divider" style="clear: both;"></div>'));
		})
	}

	function fixPricingPlansHeights(){
		$.each($('.pricing').not('section, .oneslider').parent('div'), function(index, pricingtab) {
			var maxHeight = 0;
			var columns = $(pricingtab).find('> div').not('.plan-title, .plan-titles-divider');
			$.each(columns, function(index, column) {
				var columnOuterHeight = $(column).outerHeight();
				if (columnOuterHeight > maxHeight )
					maxHeight = columnOuterHeight;
			})
			columns.css('height', maxHeight);
		})
	}
	fixPricingPlansHeights();

	$(window).resize(function() {
		fixPricingPlansHeights();
	});

	var contactForm = $('.wpcf7-form');
	contactForm.find('br').remove();

	if ($("input[type=file]").length) {
		$("input[type=file]").nicefileinput();
	}

	var touch = ('ontouchstart' in window)
      || (navigator.MaxTouchPoints > 0)
      || (navigator.msMaxTouchPoints > 0);

	if ( touch) {
		$( 'body' ).addClass('touch');
	} else {
		$( 'body' ).addClass('no-touch');
	}

})(jQuery);
