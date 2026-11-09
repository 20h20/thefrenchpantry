/*include /libs/jquery.core.js*/
/*include /libs/slick.js*/
/*include /libs/jquery.fancybox.js*/
/*include /libs/smoothscroll.js*/
/*include /libs/move.js*/

var Master = {
    onscroll : function(){
        cg_Move.scroll_slides();
    },
};

$(window).on( 'scroll', function(){
    Master.onscroll();
});


(function($) { 
	var Master = {
		onready : function(){


			//////////////// PICTURE HERO PARALLAX (Multi-sections) ////////////////
			(function() {
				var elems = document.querySelectorAll('.parallax-image');
				if (!elems.length) return;

				// Préférence "réduire les animations" : pas de parallaxe
				if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
			  
				// Par défaut si pas de data-speed
				var DEFAULT_SPEED = 0.1;
			  
				// On garde la liste des éléments activés (visible)
				var active = new Set();
				var ticking = false;
			  
				function onFrame() {
				  ticking = false;
				  if (active.size === 0) return;
			  
				  // Pour chaque élément visible, calcule la translation selon sa position dans le viewport
				  var viewportHeight = window.innerHeight || document.documentElement.clientHeight;
				  active.forEach(function(el) {
					var speed = parseFloat(el.dataset.speed);
					if (isNaN(speed)) speed = DEFAULT_SPEED;
			  
					var rect = el.getBoundingClientRect();
					// centre de l'élément relatif au centre du viewport (-viewportHeight/2 .. +viewportHeight/2)
					var elemCenter = rect.top + rect.height / 2;
					var viewportCenter = viewportHeight / 2;
					var distanceFromCenter = elemCenter - viewportCenter;
			  
					// Normaliser par la hauteur du viewport pour éviter translations énormes
					var normalized = distanceFromCenter / viewportHeight;
			  
					// Calcule le translateY final
					var translateY = normalized * viewportHeight * speed;
			  
					// Application (arrondi pour éviter sous-pixels fous)
					el.style.transform = 'translateY(' + translateY.toFixed(2) + 'px)';
				  });
				}
			  
				function requestTick() {
				  if (!ticking) {
					ticking = true;
					requestAnimationFrame(onFrame);
				  }
				}
			  
				// Observer : on active quand élément visible >= 0.05 (5%)
				var io = new IntersectionObserver(function(entries) {
				  entries.forEach(function(entry) {
					var el = entry.target;
					if (entry.isIntersecting) {
					  active.add(el);
					  // On calcule immédiatement une frame pour éviter latence au premier affichage
					  requestTick();
					} else {
					  // désactiver et réinitialiser la transform
					  if (active.has(el)) active.delete(el);
					  el.style.transform = 'translateY(0px)';
					}
				  });
				}, {
				  threshold: 0.05
				});
			  
				elems.forEach(function(el) {
				  // defensive: si la classe est sur le <source>, remonter jusqu'à la vidéo/image
				  if (el.tagName.toLowerCase() === 'source') {
					var parent = el.parentElement;
					if (parent) el = parent;
				  }
			  
				  // ensure block-level for videos if needed
				  if (el.tagName.toLowerCase() === 'video') {
					el.style.display = el.style.display || 'block';
				  }
			  
				  // ajout d'un hint pour perf (optionnel en CSS aussi)
				  el.style.willChange = el.style.willChange || 'transform';
			  
				  io.observe(el);
				});
			  
				// Listeners globaux pour déclencher une animation quand on scroll/resize
				window.addEventListener('scroll', requestTick, { passive: true });
				window.addEventListener('resize', requestTick);
			  
				// Optionnel : si tu veux que tout se recalcul immédiatement au chargement
				window.addEventListener('load', requestTick);
			  
			  })();
			  

			  /////////////////// GALLERY MASONRY ///////////////////
			if ($('body .gallery-list').length > 0){
				var grid = document.querySelector('.gallery-list');
				var items = Array.from(grid.children);

				function masonryLayout(grid, items, columns) {
					var columnHeights = new Array(columns).fill(0);
					var gridWidth = grid.offsetWidth;
					var itemWidth = gridWidth / columns;

					items.forEach(function(item) {
						var minHeightColumn = columnHeights.indexOf(Math.min.apply(null, columnHeights));
						item.style.position = 'absolute';
						item.style.width = itemWidth + 'px';
						item.style.top = columnHeights[minHeightColumn] + 'px';
						item.style.left = (minHeightColumn * itemWidth) + 'px';
						columnHeights[minHeightColumn] += item.offsetHeight;
					});
					grid.style.position = 'relative';
					grid.style.height = Math.max.apply(null, columnHeights) + 'px';
				}

				function initMasonry() {
					var windowWidth = window.innerWidth;
					if (windowWidth > 768) {
							masonryLayout(grid, items, 3);
					} else if (windowWidth < 768) {
								masonryLayout(grid, items, 2); 
					} else {
						items.forEach(function(item) {
							item.style.position = ''; 
							item.style.width = '';
							item.style.top = '';
							item.style.left = '';
						});
						grid.style.position = '';
						grid.style.height = '';
						grid.style.display = 'flex';
					}
				}
				initMasonry();
				window.addEventListener('resize', initMasonry);
			}


			/////////////////// GALLERY TRANSLATE Y ///////////////////
			if ($('body .gallery-list').length > 0){
				document.addEventListener('scroll', function() {
					var windowWidth = window.innerWidth;
					if (windowWidth >= 768) {
						var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
						var relationList = document.querySelector('.gallery-list');
						var rect = relationList.getBoundingClientRect();
						var windowHeight = window.innerHeight || document.documentElement.clientHeight;
				
						if (rect.top <= windowHeight && rect.bottom >= 0) {
							var articles = document.querySelectorAll('.gallery-list .list-el');
							var columnCount = 3;
							var columnWidth = relationList.offsetWidth / columnCount;
				
							articles.forEach(function(article) {
								var rect = article.getBoundingClientRect();
								var columnIndex = Math.floor(rect.left / columnWidth);
								if (columnIndex === 0) {
									article.style.transform = 'translateY(' + (scrollTop * -0.3) + 'px)';
								} else if (columnIndex === 1) {
									article.style.transform = 'translateY(' + (scrollTop * 0.1) + 'px)';
								} else if (columnIndex === 2) {
									article.style.transform = 'translateY(' + (scrollTop * -0.3) + 'px)';
								}
							});
						}
					} else {
						var articles = document.querySelectorAll('.gallery-list .list-el');
						articles.forEach(function(article) {
							article.style.transform = '';
						});
					}
				});
			}


			/////////////////// GALLERY PARALLAXE ///////////////////
			var items = document.querySelectorAll(".gallery-list .list-el");
			function updateEffects() {
				items.forEach(function(item) {
					var rect = item.getBoundingClientRect();
					var windowHeight = window.innerHeight;
					var scrollProgress = Math.max(0, Math.min(1, 1 - rect.top / windowHeight));
					var parallaxOffset = -100 + (100 * scrollProgress); // Déplace l'image vers le haut
					var image = item.querySelector(".parallax-img");
					if (image) {
						image.style.transform = "translateY(" + parallaxOffset + "px)";
					}
				});
			}
			window.addEventListener("scroll", updateEffects);
			window.addEventListener("resize", updateEffects);
			updateEffects();


			/////////////////// SLIDER GALLERY ///////////////////
			$('.cbo-galleryslider .galleryslider-list').slick({
				arrows : false,
				dots: false,
				speed: 40000,
				slidesToShow: 4,
				slidesToScroll: 4,
				infinite: true,
				adaptiveHeight: true,
				autoplay: true,
				autoplaySpeed: 0,
				cssEase: 'linear',
				responsive: [
					{
						breakpoint: 1283,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 3
						}
					},
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 767,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2,
						}
					},
				]
			});


			/////////////////// SLIDER INSTAGRAM ///////////////////
			$('.cbo-instagram .instagram-list #sbi_images').slick({
				arrows : false,
				dots: false,
				speed: 40000,
				slidesToShow: 8,
				slidesToScroll: 10,
				infinite: false,
				adaptiveHeight: true,
				// Défilement continu désactivé si "réduire les animations" (WCAG 2.2.2)
				autoplay: !(window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches),
				autoplaySpeed: 0,
				cssEase: 'linear',
				responsive: [
					{
						breakpoint: 1283,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 3
						}
					},
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 767,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2,
						}
					},
				]
			});


			/////////////////// LIGHTBOX ///////////////////
			$(".lightbox").fancybox({
				openEffect:'elastic',
				openSpeed:500,
				closeEffect:'fade',
				closeSpeed:500,
			});

			//////////////// STICKY ////////////////
			$(window).scroll(function(){
				if($(window).scrollTop()>80){
					$("header").addClass('header-scroll');
				}else{
					$("header").removeClass('header-scroll');
				}
			})
			.scroll();



























			


			


			/////////////////// SMARTPHONE NAVIGATION ///////////////////
			var $burger = $('header .burger-menu');
			var $nav = $('#header-nav');

			function toggleNav(open) {
				$nav.toggleClass('nav--open', open);
				$burger.toggleClass('burger-menu-cross', open)
					.attr('aria-expanded', open ? 'true' : 'false')
					.attr('aria-label', open ? 'Fermer la navigation principale' : 'Ouvrir la navigation principale');
				$('html').toggleClass('html--hidden', open);
			}

			$burger.on('click', function () {
				toggleNav(!$nav.hasClass('nav--open'));
			});

			// Fermeture au clavier (Échap) et retour du focus sur le bouton
			$(document).on('keydown', function (e) {
				if (e.key === 'Escape' && $nav.hasClass('nav--open')) {
					toggleNav(false);
					$burger.trigger('focus');
				}
			});


			/////////////////// HERO VIDEO - Pause / lecture ///////////////////
			(function () {
				var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

				document.querySelectorAll('.cbo-herovideo').forEach(function (hero) {
					var video = hero.querySelector('.herovideo-video');
					var toggle = hero.querySelector('.herovideo-toggle');
					if (!video || !toggle) return;

					function setState(paused) {
						toggle.setAttribute('aria-pressed', paused ? 'true' : 'false');
						toggle.setAttribute('aria-label', paused ? 'Play background video' : 'Pause background video');
					}

					// Préférence "réduire les animations" : pas de lecture auto
					if (reduceMotion) {
						video.removeAttribute('autoplay');
						video.pause();
						setState(true);
					}

					toggle.addEventListener('click', function () {
						if (video.paused) {
							var p = video.play();
							if (p && p.catch) p.catch(function () {});
							setState(false);
						} else {
							video.pause();
							setState(true);
						}
					});
				});
			})();


			/////////////////// POPIN (1 fois par session) ///////////////////
			(function () {
				var popin = document.getElementById('cbo-popin');
				if (!popin || typeof popin.showModal !== 'function') return;

				var storageKey = 'cbo-popin-' + popin.getAttribute('data-popin-id');
				var delay = parseInt(popin.getAttribute('data-popin-delay'), 10) || 0;

				// sessionStorage peut être indisponible (navigation privée, cookies bloqués)
				function isSeen() {
					try { return sessionStorage.getItem(storageKey) === '1'; } catch (e) { return false; }
				}
				function markSeen() {
					try { sessionStorage.setItem(storageKey, '1'); } catch (e) {}
				}

				if (isSeen()) return;

				function closePopin() {
					if (!popin.open || popin.classList.contains('popin--closing')) return;
					popin.classList.add('popin--closing');
					var done = function () {
						popin.classList.remove('popin--closing');
						popin.close();
					};
					var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
					reduceMotion ? done() : setTimeout(done, 300);
				}

				// Marqué comme vu dès l'ouverture : ne se rouvre pas au changement de page
				setTimeout(function () {
					if (isSeen()) return;
					popin.showModal();
					markSeen();
					$('html').addClass('html--hidden');
				}, delay * 1000);

				popin.addEventListener('close', function () {
					$('html').removeClass('html--hidden');
				});

				// Échap : on garde l'animation de sortie
				popin.addEventListener('cancel', function (e) {
					e.preventDefault();
					closePopin();
				});

				// Bouton fermer / bouton CTA
				popin.querySelectorAll('[data-popin-close]').forEach(function (el) {
					el.addEventListener('click', function () {
						closePopin();
					});
				});

				// Clic sur le fond (backdrop)
				popin.addEventListener('click', function (e) {
					if (e.target === popin) closePopin();
				});
			})();


			/////////////////// ANCRES - Défilement doux ///////////////////
			(function () {
				var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

				// Hauteur à compenser : header fixe + barre d'admin WP
				function getOffset() {
					var header = document.querySelector('header');
					var adminbar = document.getElementById('wpadminbar');
					return (header ? header.offsetHeight : 0) + (adminbar ? adminbar.offsetHeight : 0);
				}

				function getTarget(hash) {
					if (!hash || hash === '#') return null;
					try {
						return document.getElementById(decodeURIComponent(hash.slice(1)));
					} catch (e) {
						return null;
					}
				}

				function scrollToTarget(target, smooth) {
					var top = target.getBoundingClientRect().top + window.pageYOffset - getOffset();
					window.scrollTo({ top: Math.max(0, top), behavior: (smooth && !reduceMotion) ? 'smooth' : 'auto' });

					// Accessibilité : le focus clavier suit le défilement
					if (!target.hasAttribute('tabindex')) target.setAttribute('tabindex', '-1');
					target.focus({ preventScroll: true });
				}

				// Clic sur un lien vers une ancre de la page courante (#ancre ou /page/#ancre)
				document.addEventListener('click', function (e) {
					var link = e.target.closest('a[href*="#"]');
					if (!link || e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey) return;
					if (link.pathname !== window.location.pathname || link.hostname !== window.location.hostname) return;

					var target = getTarget(link.hash);
					if (!target) return;

					e.preventDefault();

					// Ferme le menu mobile s'il est ouvert
					if ($('#header-nav').hasClass('nav--open')) {
						$('header .burger-menu').trigger('click');
					}

					scrollToTarget(target, true);
					if (history.pushState) history.pushState(null, '', link.hash);
				});

				// Arrivée sur une page avec une ancre dans l'URL (lien depuis une autre page)
				if (window.location.hash) {
					window.addEventListener('load', function () {
						var target = getTarget(window.location.hash);
						if (target) scrollToTarget(target, true);
					});
				}
			})();


			/////////////////// SMOOTHSCOLL ///////////////////
			CBO_Smoothscroll.init();


			//////////////// ACCORDION ////////////////
			$('.accordion-list .list-el').on('click', function () {
				var $this = $(this);
				$this.siblings().removeClass('el--open');
				$this.toggleClass('el--open');
			});


			/////////////////// SLIDER TESTIMONIALS ///////////////////
			$('.cbo-testimonials .testimonials-list').slick({
				arrows: false,
				dots: false,
				slidesToShow: 2,
				slidesToScroll: 1,
				autoplay:true,
				infinite: false,
				adaptiveHeight: true,
				responsive: [
					{
						breakpoint: 1024,
						settings: {
							dots: true,
							arrows: false,
							slidesToShow: 2,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 767,
						settings: {
							dots: true,
							arrows: false,
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
				]
			});


			/////////////////// SECTION TEXTPICTURE - EFFECTS ///////////////////
			document.addEventListener('scroll', function () {
				if (window.innerWidth < 1024) return;
				var section = document.querySelector('.cbo-textpicture');
				if (!section) return;
				var scrollY = window.scrollY;
				var windowHeight = window.innerHeight;
				var sectionTop = section.offsetTop;
				var sectionHeight = section.offsetHeight;

				// On déclenche l'effet 700px avant l'arrivée dans la section
				var triggerOffset = 700;

				// Si on est dans la zone d'activation
				if (scrollY + windowHeight > sectionTop - triggerOffset && scrollY < sectionTop + sectionHeight) {
					var relativeScroll = scrollY - (sectionTop - triggerOffset);
					var mainBlock = section.querySelector('.textpicture-main');
					if (mainBlock) {
						var offset = relativeScroll * 0.1;
						mainBlock.style.transform = 'translateY(' + offset + 'px)';
					}
					var secondary = section.querySelector('.textpicture-secondary img');
					if (secondary) {
						var rotateDeg = relativeScroll * 0.1;
						secondary.style.transform = 'rotate(' + rotateDeg + 'deg)';
					}
				}
			});
			

			/////////////////// SECTION BLOCS - EFFECTS ///////////////////
			document.addEventListener('scroll', function () {
				if (window.innerWidth < 1024) return;
				var section = document.querySelector('.cbo-blocs');
				if (!section) return;
				var scrollY = window.scrollY;
				var windowHeight = window.innerHeight;
				var sectionTop = section.offsetTop;
				var sectionHeight = section.offsetHeight;
				var triggerOffset = 700;

				// Si on est dans la zone d'activation
				if (scrollY + windowHeight > sectionTop - triggerOffset && scrollY < sectionTop + sectionHeight) {
					var relativeScroll = scrollY - (sectionTop - triggerOffset);
					var mainBlock = section.querySelector('.blocs-apple');
					if (mainBlock) {
						var offset = relativeScroll * 0.1;
						mainBlock.style.transform = 'translateY(' + offset + 'px)';
					}
				}
			});


			//////////////// SCROLL ANIMATIONS ////////////////
			var scroll = window.requestAnimationFrame || function(callback){ window.setTimeout(callback, 1000/60)};
			var elementsToShow = document.querySelectorAll('.slide-up, .slide-up, .slide-right, .slide-left, .scale-up, .scale-down'); 
			function loop() {
				Array.prototype.forEach.call(elementsToShow, function(element){
					if (isElementInViewport(element)) {
						element.classList.add('anim-scroll');
					} else {
						element.classList.remove('anim-scroll');
					}
				});
				scroll(loop);
			}	
			loop();
			function isElementInViewport(el) {
				if (typeof jQuery === "function" && el instanceof jQuery) {
					el = el[0];
				}
				var rect = el.getBoundingClientRect();
				return (
					(rect.top <= 0&& rect.bottom >= 0)||(rect.bottom >= (window.innerHeight || document.documentElement.clientHeight) && rect.top <= (window.innerHeight || document.documentElement.clientHeight))||(rect.top >= 0 && rect.bottom <= (window.innerHeight || document.documentElement.clientHeight))
				);
			}
		},
			
		onload : function(){},
		onresize : function(){},
		onscroll : function(){},
	};
	$(document).ready( function(){
		Master.onready();
	});

})(jQuery);