<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<!-- content security for android -->
	<!-- look here: http://stackoverflow.com/questions/30212306/no-content-security-policy-meta-tag-found-error-in-my-phonegap-application -->
	<meta http-equiv="Content-Security-Policy" content="default-src * data: gap: https://ssl.gstatic.com 'unsafe-eval'; style-src 'self' 'unsafe-inline'; media-src *; script-src * 'unsafe-inline' 'unsafe-eval';">
	<title>Shuffle - The Music App</title>
	<link href="mainstyle.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/functions.js"></script>

</head>

<body>
	<section id="header">

		<button class="js-menu-show header__menu-toggle material-icons">
			<div id="burgermenu">
				<h1>☰</h1>
			</div>
		</button>
		<div id="headerlogo">
			<img src="images/ShuffleLogo.png" width="100%" height="" alt=""/>
		</div>
		<aside class="js-side-nav side-nav">
			<nav class="js-side-nav-container side-nav__container">
				<button class="js-menu-hide side-nav__hide material-icons">&#10006;</button>
				<header class="side-nav__header"></header>
				<ul class="side-nav__content">
					<li>Alternative</li>
					<li>Hip-Hop</li>
					<li>Indie</li>
					<li>Pop</li>
					<li>Rock</li>
					<li>Latest Songs</li>
					<br>

					<li>Log Out</li>
				</ul>
			</nav>
		</aside>
	</section>


	<section id="main">
		
		<div id="genres">
			<a href="#">
				<div class="rollover">
					<p>Alternative</p>
				</div>
			</a>

			<a href="#">
				<div class="rollover">
					<p>Hip-Hop</p>
				</div>
			</a>

			<a href="#">
				<div class="rollover">
					<p>Indie</p>
				</div>
			</a>


			<a href="#">
				<div class="rollover">
					<p>Rock</p>
				</div>
			</a>

			<a href="#">
				<div class="rollover">
					<p>Pop</p>
				</div>
			</a>

			<a href="#">
				<div class="rollover">
					<p>Latest Songs</p>
				</div>
			</a>
		</div>



	</section>

	<script>
		$( window ).load( function () {
			$( "#loader" ).delay( 4000 );
			$( "#loader" ).fadeOut( 200 );

		} )
	</script>



	<script>
		( () => {
			const factorySideNav = function factorySideNav() {
				// DOM
				const showButtonEl = document.querySelector( '.js-menu-show' );
				const hideButtonEl = document.querySelector( '.js-menu-hide' );
				const sideNavEl = document.querySelector( '.js-side-nav' );
				const sideNavContainerEl = document.querySelector( '.js-side-nav-container' );

				// State
				let startX = 0;
				let currentX = 0;
				let touchingSideNav = false;

				const onTransitionEnd = function onTransitionEnd( evt ) {
					sideNavEl.classList.remove( 'side-nav--animatable' );
					sideNavEl.removeEventListener( 'transitionend', onTransitionEnd );
				};

				const showSideNav = function showSideNav() {
					sideNavEl.classList.add( 'side-nav--animatable' );
					sideNavEl.classList.add( 'side-nav--visible' );
					sideNavEl.addEventListener( 'transitionend', onTransitionEnd );
				};

				const hideSideNav = function hideSideNav() {
					sideNavEl.classList.add( 'side-nav--animatable' );
					sideNavEl.classList.remove( 'side-nav--visible' );
					sideNavEl.addEventListener( 'transitionend', onTransitionEnd );
				};

				const update = function update() {
					if ( !touchingSideNav ) return;

					requestAnimationFrame( update );

					const translateX = Math.min( 0, currentX - startX );
					sideNavContainerEl.style.transform = `translateX( ${ translateX }px )`;
				};

				const onTouchStart = function onTouchStart( evt ) {
					if ( !sideNavEl.classList.contains( 'side-nav--visible' ) ) return;

					startX = evt.touches[ 0 ].pageX;
					currentX = startX;

					touchingSideNav = true;
					requestAnimationFrame( update );
				};

				const onTouchMove = function onTouchMove( evt ) {
					if ( !touchingSideNav ) return;

					currentX = evt.touches[ 0 ].pageX;
				};

				const onTouchEnd = function onTouchEnd( evt ) {
					if ( !touchingSideNav ) return;

					touchingSideNav = false;

					const translateX = Math.min( 0, currentX - startX );
					sideNavContainerEl.style.transform = '';

					if ( translateX < 0 ) hideSideNav();
				}

				const blockClicks = function blockClicks( evt ) {
					evt.stopPropagation();
				};

				const addEventListeners = function addEventListeners() {
					showButtonEl.addEventListener( 'click', showSideNav );
					hideButtonEl.addEventListener( 'click', hideSideNav );
					sideNavEl.addEventListener( 'click', hideSideNav );
					sideNavContainerEl.addEventListener( 'click', blockClicks );

					sideNavEl.addEventListener( 'touchstart', onTouchStart );
					sideNavEl.addEventListener( 'touchmove', onTouchMove );
					sideNavEl.addEventListener( 'touchend', onTouchEnd );
				};

				return {
					addEventListeners,
				};
			}

			const sideNav = factorySideNav();

			sideNav.addEventListeners();
		} )()
	</script><br>

	<?	include('footer.inc.php'); ?>
</body>
</html>