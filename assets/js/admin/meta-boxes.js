jQuery( function ( $ ) {

	// Tabbed Panels
	$( document.body ).on( 'flash-toolkit-init-tabbed-panels', function() {
		$( 'ul.flash-toolkit-tabs' ).show();
		$( 'ul.flash-toolkit-tabs a' ).click( function() {
			var panel_wrap = $( this ).closest( 'div.panel-wrap' );
			$( 'ul.flash-toolkit-tabs li', panel_wrap ).removeClass( 'active' );
			$( this ).parent().addClass( 'active' );
			$( 'div.panel', panel_wrap ).hide();
			$( $( this ).attr( 'href' ) ).show();
			return false;
		});
		$( 'div.panel-wrap' ).each( function() {
			$( this ).find( 'ul.flash-toolkit-tabs li' ).eq( 0 ).find( 'a' ).click();
		});
	}).trigger( 'flash-toolkit-init-tabbed-panels' );
});
