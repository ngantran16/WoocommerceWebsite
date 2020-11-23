jQuery('#menu').slicknav({
	label: '',
	duration: 300,	
	prependto:'.site-header'
});

jQuery(document).ready(function() {
jQuery(".property-gallery-preview").ready(function(){            
    jQuery(".property-gallery-preview img").removeAttr("srcset");
    jQuery(".property-gallery-preview img").attr("width", "1000");
    jQuery(".property-gallery-preview img").attr("height", "400");
    jQuery(".property-gallery-preview img").removeAttr("sizes");
});
});
