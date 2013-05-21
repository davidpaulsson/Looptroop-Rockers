/*	
 *	jQuery mmenu 1.2.2
 *	
 *	Copyright (c) 2013 Fred Heusschen
 *	www.frebsite.nl
 *
 *	Dual licensed under the MIT and GPL licenses.
 *	http://en.wikipedia.org/wiki/MIT_License
 *	http://en.wikipedia.org/wiki/GNU_General_Public_License
 */


(function( $ ) {
	
	var $html = null,
		$body = null,
		$page = null,
		$blck = null;

	$.fn.mmenu = function( o )
	{
		if ( !$html )
		{
			$html = $('html');
			$body = $('body');
		}

		return this.each(
			function()
			{

				//	STORE VARIABLES
				var $menu = $(this),
					opts = $.extend( true, {}, $.fn.mmenu.defaultOptions, o );

				opts.configuration.opened	 	= false;
				opts.configuration.direction	= ( opts.slidingSubmenus ) ? 'horizontal' : 'vertical';


				//	INIT PAGE, MENU, LINKS & LABELS
				$page = _initPage( $page, opts.configuration );
				$menu = _initMenu( $menu, opts.configuration );
				$menu = _initSubmenus( $menu, opts.configuration );
				$blck = _initBlocker( $blck, $menu, opts.configuration );

				if ( opts.closeOnClick )
				{
					_initLinks( $menu, opts.configuration );
				}

				_initCounters( $menu, opts, opts.configuration );


				//	BIND EVENTS
				var $subs = $menu.find( 'ul' );
				$menu.add( $subs )
					.bind(
						evt( 'toggle' ) + ' ' + evt( 'open' ) + ' ' + evt( 'close' ),
						function( e )
						{
							e.preventDefault();
							e.stopPropagation();
						}
					);

				//	menu-events
				$menu
					.bind(
						evt( 'toggle' ),
						function( e )
						{
							return $menu.triggerHandler( evt( opts.configuration.opened ? 'close' : 'open' ) );
						}
					)
					.bind(
						evt( 'open' ),
						function( e )
						{
							if ( opts.configuration.opened )
							{
								return false;
							}
							opts.configuration.opened = true;
							return openMenu( $menu, opts );
						}
					)
					.bind(
						evt( 'close' ),
						function( e )
						{
							if ( !opts.configuration.opened )
							{
								return false;
							}
							opts.configuration.opened = false;
							return closeMenu( $menu, opts );
						}
					);


				//	submenu-events
				if ( opts.configuration.direction == 'horizontal' )
				{
					$subs
						.bind(
							evt( 'toggle' ),
							function( e )
							{								
								return $(this).triggerHandler( evt( 'open' ) );
							}
						)
						.bind(
							evt( 'open' ),
							function( e )
							{
								return openSubmenuHorizontal( $(this), opts );
							}
						)
						.bind(
							evt( 'close' ),
							function( e )
							{
								return closeSubmenuHorizontal( $(this), opts );
							}
						);
				}
				else
				{
					$subs
						.bind(
							evt( 'toggle' ),
							function( e )
							{
								var $t = $(this);
								return $t.triggerHandler( evt( ( $t.parent().hasClass( cls( 'opened' ) ) ) ? 'close' : 'open' ) );
							}
						)
						.bind(
							evt( 'open' ),
							function( e )
							{
								$(this).parent().addClass( cls( 'opened' ) );
								return 'open';
							}
						)
						.bind(
							evt( 'close' ),
							function( e )
							{
								$(this).parent().removeClass( cls( 'opened' ) );
								return 'close';
							}
						);
				}


				//	OPEN + CLOSE MENU LINKS
				var id = $menu.attr( 'id' );
				if ( id && id.length )
				{
					click( 'a[href="#' + id + '"]',
						function()
						{
							$menu.trigger( evt( 'open' ) );
						}
					);
				}

				var id = $page.attr( 'id' );
				if ( id && id.length )
				{
					click( 'a[href="#' + id + '"]',
						function()
						{
							$menu.trigger( evt( 'close' ) );
						}
					);
				}


				//	OPEN SUBMENU LINKS
				click( $( 'a.' + cls( 'subopen' ) + ', ' + 'a.' + cls( 'subclose' ), $menu ),
					function()
					{
						$( $(this).attr( 'href' ) ).trigger( evt( 'toggle' ) );
					}
				);

			}
		);
	};

	$.fn.mmenu.defaultOptions = {
		slidingSubmenus	: true,
		closeOnClick	: true,
		addCounters		: false,
		position		: 'left',
		configuration	: {
			selectedClass	: 'Selected',
			labelClass		: 'Label',
			counterClass	: 'Counter',
			pageNodetype	: 'div',
			menuNodetype	: 'nav',
			slideDuration	: 500
		}
	};

	$.fn.mmenu.debug = function( msg )
	{
		if ( typeof console != 'undefined' && typeof console.log != 'undefined' )
		{
			console.log( 'MMENU: ' + msg );
		}
	};
	$.fn.mmenu.deprecated = function( depr, repl )
	{
		if ( typeof console != 'undefined' && typeof console.warn != 'undefined' )
		{
			console.warn( 'MMENU: ' + depr + ' is deprecated, use ' + repl + ' instead.' );
		}
	};

	function _initPage( $p, conf )
	{
		if ( !$p )
		{
			$p = $( '> ' + conf.pageNodetype, $body );
			if ( $p.length > 1 )
			{
				$p = $p.wrapAll( '<' + conf.pageNodetype + ' />' ).parent();
			}
			$p.addClass( cls( 'page' ) );
		}
		return $p;
	}

	function _initMenu( $m, conf )
	{
		if ( !$m.is( conf.menuNodetype ) )
		{
			$m = $( '<' + conf.menuNodetype + ' />' ).append( $m );
		}
	//	$_dummy = $( '<div class="mmenu-dummy" />' ).insertAfter( $m ).hide();
		$m.addClass( cls( '' ).slice( 0, -1 ) ).prependTo( 'body' );
		
		//	Refactor selected class
		$( 'li.' + conf.selectedClass, $m ).removeClass( conf.selectedClass ).addClass( cls( 'selected' ) );

		//	Refactor label class
		$( 'li.' + conf.labelClass, $m ).removeClass( conf.labelClass ).addClass( cls( 'label' ) );

		return $m;
	}

	function _initSubmenus( $m, conf )
	{
		$m.addClass( cls( conf.direction ) );

		$( 'ul ul', $m )
			.addClass( cls( 'submenu' ) )
			.each(
				function( i )
				{
					var $t = $(this)
						$a = $t.parent().find( '> a, > span' ),
						id = $t.attr( 'id' ) || cls( 's' + i );

					$t.attr( 'id', id );

					var $btn = $( '<a class="' + cls( 'subopen' ) + '" href="#' + id + '" />' ).insertBefore( $a );
					if ( !$a.is( 'a' ) )
					{
						$btn.addClass( cls( 'fullsubopen' ) );
					}

					if ( conf.direction == 'horizontal' )
					{
						var $p = $t.parent().parent(),
							id = $p.attr( 'id' ) || cls( 'p' + i );
	
						$p.attr( 'id', id );
						$t.prepend( '<li class="' + cls( 'subtitle' ) + '"><a class="' + cls( 'subclose' ) + '" href="#' + id + '">' + $a.text() + '</a></li>' );
					}
				}
			);

		if ( conf.direction == 'horizontal' )
		{
			//	Add opened-classes
			$( 'li.' + cls( 'selected' ), $m )
				.parents( 'li.' + cls( 'selected' ) ).removeClass( cls( 'selected' ) )
				.end().each(
					function()
					{
						var $t = $(this),
							$u = $t.find( '> ul' );
	
						if ( $u.length )
						{
							$t.parent().addClass( cls( 'subopened' ) );
							$u.addClass( cls( 'opened' ) );
						}
					}
				)
				.parent().addClass( cls( 'opened' ) )
				.parents( 'ul' ).addClass( cls( 'subopened' ) );
	
			//	Rearrange markup
			$( 'ul ul', $m ).appendTo( $m );

		}
		else
		{
			//	Replace Selected-class with opened-class in parents from .Selected
			$( 'li.' + cls( 'selected' ), $m )
				.addClass( cls( 'opened' ) )
				.parents( '.' + cls( 'selected' ) ).removeClass( cls( 'selected' ) );
		}

		return $m;
	}
	function _initBlocker( $b, $m, conf )
	{
		if ( !$b )
		{
			$b = $( '<div id="' + cls( 'blocker' ) + '" />' ).appendTo( $body );
		}
		click( $b,
			function()
			{
				$m.trigger( evt( 'close' ) );
			}
		);
		return $b;
	}
	function _initLinks( $m, conf )
	{
		var $a = $('a', $m)
			.not( '.' + cls( 'subopen' ) )
			.not( '.' + cls( 'subclose' ) );

		click( $a,
			function()
			{
				var $t = $(this),
					href = $t.attr( 'href' );

				$m.trigger( evt( 'close' ) );
				$a.parent().removeClass( cls( 'selected' ) );
				$t.parent().addClass( cls( 'selected' ) );

				if ( href.slice( 0, 1 ) != '#' )
				{
					setTimeout(
						function()
						{
							window.location.href = href;
						}, conf.slideDuration - 100
					);
				}
			}
		);
	}
	function _initCounters( $m, o, conf )
	{
		//	Refactor counter class
		$('em.' + conf.counterClass, $m).removeClass( conf.counterClass ).addClass( cls( 'counter' ) );
		if ( o.addCounters )
		{
			$('.' + cls( 'submenu' ), $m).each(
				function()
				{
					var $s = $(this),
						id = $s.attr( 'id' );
	
					if ( id && id.length )
					{
						var $c = $( '<em class="' + cls( 'counter' ) + '" />' ),
							$a = $('a.' + cls( 'subopen' ), $m).filter( '[href="#' + id + '"]' );

						if ( !$a.parent().find( 'em.' + cls( 'counter' ) ).length )
						{
							$a.before( $c );
						}
					}
				}
			);
		}

		//	Bind count event
		$('em.' + cls( 'counter' )).each(
			function()
			{
				var $c = $(this),
					$s = $('ul' + $c.next().attr( 'href' ), $m);

				$c.bind(
					evt( 'count' ),
					function( e )
					{
						e.preventDefault();
						e.stopPropagation();

						var $lis = $s.children()
							.not( '.' + cls( 'label' ) )
							.not( '.' + cls( 'subtitle' ) )
							.not( '.' + cls( 'hidden' ) );

						$c.html( $lis.length );
					}
				);
			}
		).trigger( evt( 'count' ) );
	}

	function openMenu( $m, o )
	{
		$page
			.data( dta( 'style' ), $page.attr( 'style' ) || '' )
			.width( $page.outerWidth() );

		$m.addClass( cls( 'opened' ) );
		$html.addClass( cls( 'opened' ) ).addClass( cls( o.position ) );
		setTimeout(
			function()
			{
				$html.addClass( cls( 'opening' ) );
			}, 25
		);

		return 'open';
	}
	function closeMenu( $m, o )
	{
		$html.removeClass( cls( 'opening' ) );
		setTimeout(
			function()
			{
				$html.removeClass( cls( 'opened' ) ).removeClass( cls( o.position ) );
				$m.removeClass( cls( 'opened' ) );
				$page.attr( 'style', $page.data( dta( 'style' ) ) );
			}, o.configuration.slideDuration + 25
		);

		return 'close';
	}

	function openSubmenuHorizontal( $t, o )
	{
		$t.prevAll().addClass( cls( 'subopened' ) );
		$t.nextAll().removeClass( cls( 'subopened' ) );
		$t.removeClass( cls( 'subopened' ) ).addClass( cls( 'opened' ) );
		setTimeout(
			function()
			{
				$t.nextAll().removeClass( cls( 'opened' ) );
			}, o.configuration.slideDuration + 25
		);
		return 'open';
	}
	function closeSubmenuHorizontal( $t, o )
	{
		$t.prevAll( '.' + cls( 'opened' ) ).first().trigger( evt( 'open' ) );
		return 'close';
	}

	function click( $b, fn )
	{
		if ( typeof $b == 'string' )
		{
			$b = $( $b );
		}
		$b.bind(
			evt( 'click' ),
			function( e )
			{
				e.preventDefault();
				e.stopPropagation();

				fn.call( this, e );
			}
		);
	}

	function cls( c )
	{
		return 'mmenu-' + c;
	}
	function dta( d )
	{
		return 'mmenu-' + d;
	}
	function evt( e )
	{
		return e + '.mmenu';
	}

})( jQuery );