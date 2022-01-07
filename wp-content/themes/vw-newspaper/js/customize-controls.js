( function( api ) {

	// Extends our custom "vw-newspaper" section.
	api.sectionConstructor['vw-newspaper'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );