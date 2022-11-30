<?php
	header("Content-Type:text/css");
	if ( isset( $_GET[ 'color1' ] ) && $_GET[ 'color1' ] != '' ) {
		$color1 = "#".$_GET['color1'];
	}
	if ( isset( $_GET[ 'color2' ] ) && $_GET[ 'color2' ] != '' ) {
		$color2 = "#".$_GET['color2'];
	}

	function checkhexcolor($color) {
	  return preg_match('/^#[a-f0-9]{6}$/i', $color);
	}

	if( !$color1 || !checkhexcolor( $color1 ) ) {
	  $color1 = "#EA0117";
	}

	if( !$color2 || !checkhexcolor( $color2 ) ) {
	  $color2 = "#0C01EA";
	}
?>


.loader {
    border-top: 4px solid <?php echo $color1 ;?>;
}
.hero__slider .slick-dots li.slick-active button {
    background-color: <?php echo $color1; ?>;
}
.video-btn .icon, .bg--base {
    background-color: <?php echo $color1; ?>;
}
.video-btn .icon::before, .video-btn .icon::after {
    position: absolute;
    content: "";
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    border-radius: 74px;
    background-color: <?php echo $color1; ?>;
    opacity: 0.15;
    z-index: -10;
}
.video-btn .icon::before, .video-btn .icon::after {
    position: absolute;
    content: "";
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    border-radius: 74px;
    background-color: <?php echo $color1; ?>;
    opacity: 0.15;
    z-index: -10;
}
.header .main-menu li a:hover, .header .main-menu li a:focus {
    color: <?php echo $color1; ?>;
}
.header .main-menu li .sub-menu {
    background-color: <?php echo $color1; ?>;
    border-top: 2px solid <?php echo $color1; ?>;
}
.header-search-form button {
    background-color: <?php echo $color1; ?>;
}
.dropdown-menu {
    background-color: <?php echo $color1; ?>;
}
.movie-slider-one .slick-arrow {
    background-color: <?php echo $color1; ?>;
}
.movie-card__thumb .icon {
    color: <?php echo $color1; ?>;
}
a:hover {
    color: <?php echo $color1; ?>;
}
.cmn-btn {
    background-color: <?php echo $color1; ?>;
}
.package-card__btn:hover {
    color: #ffffff;
    background-color: <?php echo $color1; ?>;
}
.base--color {
    color: <?php echo $color1; ?>;
}
.list-group-item {
    border: 1px dashed <?php echo $color1; ?>69;
}
.social-links li a:hover {
    background-color: <?php echo $color1; ?>;
    border-color: <?php echo $color1; ?>;
}
.subscribe-form button {
    background-color: <?php echo $color1; ?>;
}
.links li a:hover {
    color: <?php echo $color1; ?>;
}
.subscription-clock > div {
    background-color: <?php echo $color1; ?>;
}
.table .thead-dark th {
    background-color: <?php echo $color1; ?>;
    border-color: <?php echo $color1; ?>;
}
.table {
    border: 1px solid <?php echo $color1; ?>;
}
.page-breadcrumb li:first-child::before {
    content: "\f015";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    color: <?php echo $color1; ?>;
    margin-right: 6px;
}
.cmn-btn:hover {
    background-color: <?php echo $color1; ?>;
}
.form-control:focus {
    border-color: <?php echo $color1; ?>;
}
.card-header {
    background-color: <?php echo $color2; ?>;
    border-bottom: 1px solid <?php echo $color1; ?>6e;
}
.package-card__icon i {
    color: <?php echo $color1; ?>;
}
.package-card__btn {
    background-color: <?php echo $color1; ?>;
}
.card {
    border-color: <?php echo $color2; ?>;
    background-color: <?php echo $color2; ?>;
}


.card-header {
    background-color: <?php echo $color2; ?>;
}

.card-body {
    background-color: <?php echo $color2; ?>;
}
.pagination .page-item {
    background-color: <?php echo $color2; ?>;
}
.input-group-text {
    background-color: <?php echo $color2; ?>;
    border-color: <?php echo $color2; ?>;
}
@media (max-width: 1199px) {
    .header__bottom {
        background-color: <?php echo $color2; ?>;
        padding: 15px 30px;
    }
}
.movie-card__content {
    padding: 20px;
    background-color: <?php echo $color2; ?>;
}
#preloader {
    background: <?php echo $color2; ?>;
}
.footer {
    background-color: <?php echo $color2; ?>;
}
.movie-small::after {
    position: absolute;
    content: attr(data-text);
    top: 15px;
    left: 30px;
    background-color: <?php echo $color1; ?> !important;
    color: #fff;
    font-size: 12px;
    padding: 1px 6px;
    border-radius: 0 3px 3px 0;
    animation: pulse 1s infinite;
}
.movie-card::after {
    position: absolute;
    content: attr(data-text);
    top: 0;
    left: 0;
    background-color: <?php echo $color1; ?> !important;
    color: #fff;
    font-size: 13px;
    padding: 2px 10px;
    border-radius: 0 3px 3px 0;
    animation: pulse 1s infinite;
}