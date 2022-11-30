<?php
header("Content-Type:text/css");
$color = "#f0f"; // Change your Color Here

function checkhexcolor($color){
    return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if (isset($_GET['color']) AND $_GET['color'] != '') {
    $color = "#" . $_GET['color'];
}

if (!$color OR !checkhexcolor($color)) {
    $color = "#336699";
}



?>

.header-bottom-area .navbar-collapse .main-menu li a:hover, .header-bottom-area .navbar-collapse .main-menu li a.active {
color: <?php echo $color ?>;
}
.header-bottom-area .navbar-collapse .main-menu li a::after {
background-color: <?php echo $color ?>;
}
.header-bottom-area .navbar-collapse .main-menu li .sub-menu {
border-top: 2px solid <?php echo $color ?>;
}
.search-bar a {
color: <?php echo $color ?>;
}
.btn--base {
background-color: <?php echo $color ?>;
border: 1px solid <?php echo $color ?>;
}
.btn--base:focus, .btn--base:hover {
color: white;
box-shadow: 0 10px 20px <?php echo $color ?>66;
}
.btn--base.active:hover {
color: <?php echo $color ?>;
}

.btn--default, .bg--base{
    background-color: <?php echo $color; ?> !important;
}

.movie-thumb .movie-thumb-overlay::before {
background-color: <?php echo $color ?>;
}

.swiper-pagination .swiper-pagination-bullet-active {
background-color: <?php echo $color ?>;
}

.slider-next:hover, .slider-prev:hover {
background-color: <?php echo $color ?>;
}

.movie-thumb .movie-badge {
background-color: <?php echo $color ?>;
}

.section-header .section-title {
border-bottom: 1px solid <?php echo $color ?>;
background-color: <?php echo $color ?>;
}

.trailer-thumb .trailer-thumb-overlay a::before {
background-color: <?php echo $color ?>;
}
.trailer-thumb .trailer-thumb-overlay a {
background-color: <?php echo $color ?>;
}

.loader-area:before, .loader-area:after {
border-top-color: <?php echo $color ?>;
}
.loader-area:before, .loader-area:after {
border-top-color: <?php echo $color ?>;
}

.footer-social li a:hover, .footer-social li a.active {
background-color: <?php echo $color ?>;
}

.footer-links li a:hover {
color: <?php echo $color ?>;
}

.subscribe-form button, .subscribe-form input[type="button"], .subscribe-form input[type="reset"], .subscribe-form input[type="submit"] {
background-color: <?php echo $color ?>;
}

.scrollToTop {
background: <?php echo $color ?>;
}

.text--base {
color: <?php echo $color ?> !important;
}

*::-webkit-scrollbar-button {
background-color: <?php echo $color ?>;
}
*::-webkit-scrollbar-thumb {
background-color: <?php echo $color ?>;
}
::selection {
background-color: <?php echo $color ?>;
}

.custom-btn {
color: <?php echo $color ?>;
}

.nav-tabs .nav-item .nav-link.active {
border-bottom: 1px solid <?php echo $color ?>;
background-color: <?php echo $color ?>;
}

.breadcrumb-item a {
color: <?php echo $color ?>;
}
.breadcrumb-item a::before {
color: <?php echo $color ?>;
}
.breadcrumb-item.active::before {
color: <?php echo $color ?>;
}

.camera__body {
background-color: <?php echo $color ?>;
}
.camera__body-optic {
background-color: <?php echo $color ?>;
}
.camera__body-k7 .tape .roll {
background-color: <?php echo $color ?>;
}
.camera__body-k7 .tape .center {
background-color: <?php echo $color ?>;
}

.header-search-form .header-search-btn {
background-color: <?php echo $color ?>;
}

.plan-item .plan-icon {
color: <?php echo $color ?>;
}

.header-right button, .header-right input[type="button"], .header-right input[type="reset"], .header-right input[type="submit"] {
background-color: <?php echo $color ?>;
border: 1px solid <?php echo $color ?>;
}

.dropdown-menu {
background-color: <?php echo $color ?>;
}

.custom--card .card-header {
background-color: <?php echo $color ?>;
}
.custom-table thead tr {
background-color: <?php echo $color ?>;
}

.checkbox-wrapper .checkbox-item label a {
color: <?php echo $color ?>;
}
.submit-btn {
background-color: <?php echo $color ?>;
}

.draw-countdown .syotimer__body .syotimer-cell{
background-color: <?php echo $color ?>;
}

.pagination .page-item.active .page-link, .pagination .page-item:hover .page-link {
background: <?php echo $color ?>;
border-color: <?php echo $color ?>;
}

.custom--file-upload ~ label {
background-color: <?php echo $color ?>;
}