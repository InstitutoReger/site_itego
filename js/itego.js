jQuery('.sandwich').on('click', function(){
	jQuery(this).find('i').toggleClass('fa-bars fa-times');
	jQuery('#menu-internas-mobile').slideToggle();
});

jQuery('#menu-internas-mobile li.menu-item-has-children').click(function(){
	jQuery(this).find('.sub-menu').toggleClass("show");
});