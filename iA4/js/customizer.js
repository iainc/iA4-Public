/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
  // Site title and description.
  wp.customize( 'blogname', function( value ) {
    value.bind( function( to ) {
      $( '.header-title-text' ).text( to );
    } );
  } );
  wp.customize( 'blogdescription', function( value ) {
    value.bind( function( to ) {
      $( '.header-description-text' ).text( to );
    } );
  } );
  wp.customize( 'ia4_footer_headline', function( value ) {
    value.bind( function( to ) {
        if(($( 'footer .teaser-title' ).length)) {
            $( 'footer .teaser-title' ).text( to );
        }
    } );
  } );
  wp.customize( 'ia4_footer_message', function( value ) {
    value.bind( function( to ) {
        if(($( 'footer .message' ).length)) {
            $( 'footer .message' ).html( to );
        }
    } );
  } );
  wp.customize( 'ia4_news_headline', function( value ) {
    value.bind( function( to ) {
        if(($( '.page-title-news' ).length)) {
            $( '.page-title-news' ).text( to );
        }
    } );
  } );
  wp.customize( 'ia4_portfolio_headline', function( value ) {
    value.bind( function( to ) {
        if(($( '.portfolio-default-title' ).length)) {
            $( '.portfolio-default-title' ).text( to );
        }
    } );
  } );
  // Header text color.
  wp.customize( 'header_textcolor', function( value ) {
    value.bind( function( to ) {
      if ( 'blank' === to ) {
        $( '.site-title, .site-description' ).css( {
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        } );
      } else {
        $( '.site-title, .site-description' ).css( {
          'clip': 'auto',
          'color': to,
          'position': 'relative'
        } );
      }
    } );
  } );

} )( jQuery );
