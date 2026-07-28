/**
 * Customizer live preview (postMessage transport) for instant color/typography.
 *
 * @package AquaPro
 */
( function ( wp ) {
	if ( ! wp || ! wp.customize ) {
		return;
	}
	const root = document.documentElement;

	function setToken( name, value ) {
		root.style.setProperty( name, value );
	}

	const presets = {
		aqua:   [ '#1d6fe0', '#06b6d4' ],
		navy:   [ '#1e3a8a', '#3b82f6' ],
		teal:   [ '#0d9488', '#14b8a6' ],
		sunset: [ '#ea580c', '#f59e0b' ],
		forest: [ '#15803d', '#65a30d' ],
	};

	wp.customize( 'aquapro_preset', ( v ) => v.bind( ( val ) => {
		const p = presets[ val ] || presets.aqua;
		setToken( '--aqua-accent', p[ 0 ] );
		setToken( '--aqua-accent-2', p[ 1 ] );
	} ) );

	wp.customize( 'aquapro_accent', ( v ) => v.bind( ( val ) => { if ( val ) setToken( '--aqua-accent', val ); } ) );
	wp.customize( 'aquapro_accent2', ( v ) => v.bind( ( val ) => { if ( val ) setToken( '--aqua-accent-2', val ); } ) );
	wp.customize( 'aquapro_radius', ( v ) => v.bind( ( val ) => setToken( '--aqua-radius', parseInt( val, 10 ) + 'px' ) ) );
	wp.customize( 'aquapro_font_scale', ( v ) => v.bind( ( val ) => setToken( '--aqua-font-scale', ( parseInt( val, 10 ) || 100 ) / 100 ) ) );
}( window.wp ) );
