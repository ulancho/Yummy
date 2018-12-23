$(document).ready(function() {
	$(".regular").slick({
		dots: false,
		arrows:true,
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 3,
		responsive: [
		{
			breakpoint: 880,
			settings: {
				slidesToShow: 2,
				slidesToScroll: 2,
			}
		},
		{
			breakpoint: 400,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			}
		}
		]
	});
	$('.menu-toggle-icon').click(function(){
		$('.mob-links-overlay').toggleClass('open');
		$('body').toggleClass('overflowHid');
		$('.mob-menu').toggleClass('dNone');
		return false;
	});
	$('.mob-close').click(function(){
		$('.mob-links-overlay').removeClass('open');
		$('body').removeClass('overflowHid');
		$('.mob-menu').removeClass('dNone');
		return false;
	});
	$('.productItem').click(function(){
		$(this).toggleClass('flipProd');
	});
});