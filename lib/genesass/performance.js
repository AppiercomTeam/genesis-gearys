// remove no-js once javascript is enabled.
jQuery( 'body' ).removeClass( 'no-js' );

let interval = null;

function fontLoadListener() {
	var hasLoaded = false;
	/*
	 * If anything goes wrong with the font loading API,
	 * just change styles to the web font without handling FOUT
	 */
	try {
		hasLoaded = document.fonts.check( '20px "Amatic SC"' );
		console.info( 'hasLoaded' );
		console.info( hasLoaded );
	} catch ( error ) {
		console.error( `document.fonts API error: ${error}` );
		fontLoadedSuccess();
		return;
	}

	if ( hasLoaded ) {
		console.info( `document.fonts API loaded ` );
		fontLoadedSuccess();
	}
}

function fontLoadedSuccess() {
	if ( interval ) {
		clearInterval( interval );
	}

	document.getElementsByTagName( "body" )[ 0 ].classList.add( "wf-amatic-sc--loaded" );
}

interval = setInterval( fontLoadListener, 500 );
