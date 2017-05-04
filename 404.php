<?php
  session_start();
  require 'dbFNS.php';
  if (!$connection = mysqli_connect($hostName, $userName, $password))
    die("Cannot connect");
  mysqli_select_db($connection, $databaseName);
  $loginUsername = $_SESSION["loginUsername"];
  
  //user's profile
  $query_my_profile = "SELECT createtime FROM user WHERE username = '{$loginUsername}'";
  $result_my_profile = @ mysqli_query($connection, $query_my_profile);
  $line_my_profile = mysqli_fetch_array($result_my_profile);
  $_SESSION["loginTime"] = $line_my_profile[0];
  $php_createtime_timestamp = strtotime($_SESSION["loginTime"]);
  date_default_timezone_set('America/New_York');
  $restday = floor((time()-$php_createtime_timestamp)/3600);
  $createtime = date('F d, Y', $php_createtime_timestamp);

<<<<<<< Updated upstream:404.php
=======
  //show all project here
  $query_show_all_pro = "SELECT pname, username, maxfund, endtime, moneysum FROM project WHERE status = 'funding'";
  $result_show_all_pro = @ mysqli_query($connection, $query_show_all_pro);

>>>>>>> Stashed changes:404.php
?>

<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CrowdFunding</title>

<!-- Css (necessary Css) -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/bootstrap-theme.css" rel="stylesheet">
<link href="assets/css/language-selector-remove-able-css.css" rel="stylesheet">
<link href="assets/css/flexslider.css" rel="stylesheet">
<link href="style.css" rel="stylesheet">
<link href="plugin.css" rel="stylesheet">
<link href="assets/css/menu.css" rel="stylesheet">
<link href="assets/css/responsive.css" rel="stylesheet">
<link href="assets/css/color.css" rel="stylesheet">
<link href="assets/css/iconmoon.css" rel="stylesheet">
<link href="assets/css/themetypo.css" rel="stylesheet">
<link href="assets/css/widget.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
</head>
<body>
<div class="wrapper"> 
	
	<!-- Header -->
  <header id="main-header">
    <div class="container">
    <div class="main-head">
      <div class="left-side">
        <div class="logo"><a href="discover.php"><img src="assets/images/logo.png" alt=""></a></div>
        <nav class="navigation">
          <ul>
            <li><a href="discover.php">Home</a></li>
            <li><a href="listing.php">Discover</a></li>
            <li><a href="creators.html">Creators</a></li>
            <li><a href="supporters.html">Supporters</a></li>
            <li><a href="#">Pages</a>
              <ul class="sub-dropdown">
                <!--<li><a href="about.html">About us</a></li>-->
                <!--<li><a href="faq.html">FAQ’s</a></li>-->
                <!--<li><a href="contect.html">Contect</a></li>-->
                <li><a href="sign.php">Create an Account</a></li>
                <li><a href="sign.php">Sign In</a></li>
                <li><a href="404.php">404 Page</a></li>
                <!--<li><a href="under.html">under-construction</a></li>-->
                <!--<li><a href="terms.html">Terms &amp; Conditions</a></li>-->
                <!--<li><a href="pricing.html">Price &amp; Packges</a></li>-->
                <!--<li><a href="services.html">Services</a></li>-->
                <!--<li><a href="site-map.html">Site Map</a></li>-->
                <li><a href="result.html">Result</a></li>
                <li><a href="donate.php">Donate</a></li>
                <li><a href="user-detail2.html">user detail2</a></li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
      <div class="right-side">
        <div class="cs-search-block">
            <form method="post" action="searchResult.php">
                <input type="text" id="s" name="search_key" value="Search Project" onfocus="if(this.value =='Search Project') { this.value = ''; }" onblur="if(this.value == '') { this.value ='Search Project'; }" class="form-control">
                <label>
                    <input type="submit" value="Search">
                </label>
            </form>
        </div>
        <div class="profile-view">
          <ul>
            <li>
              <img alt="#" src="assets/extra-images/user-img.jpg">
              <i class="icon-arrow-down8"></i>
              <div class="dropdown-area">
                <h5> <?php echo $_SESSION["loginUsername"]; ?> </h5>
                <span> <?php echo 'Member Since '.$createtime; ?> </span>
                <span> <?php echo $restday.'days ago.  Great!'; ?> </span>
                <ul class="dropdown">
                  <li><a href="home.php"><i class="icon-flag5"></i>My project</a></li>
                  <li><a href="saved.html"><i class="icon-file-text-o"></i>Saved project</a></li>
                  <li><a href="my-donation.html"><i class="icon-file-text-o"></i>My Donations</a></li>
                  <li><a href="donation.html"><i class="icon-ticket6"></i>Donations</a></li>
                  <li><a href="profilesetting.html"><i class="icon-pie2"></i>Profile Settings</a></li>
                  <li><a href="create-new-project.php"><i class="icon-plus6"></i>Create New</a></li>
                </ul>
                <a class="sign-btn" href="#" onclick="window.location.href='sign.php'"><i class="icon-logout"></i>Sign Out</a>
              </div>
            </li>
          </ul>
        </div> 
    </div>
    <div class="mob-nav"></div>
    </div>
  </header>
  <!-- Header --> 
	<div class="breadcrumb-sec" style="background:url(assets/extra-images/banner.jpg) no-repeat; background-size:100% auto; min-height:157px!important;">
		<div class="absolute-sec">
			<div class="container">
				<div class="cs-table">
					<div class="cs-tablerow">
						<div class="pageinfo page-title-align-left">
							<h1 style="color:#fff !important; text-transform:none;">to be written</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Main Content -->
	<main id="main-content">
		<div class="main-section">
			<div class="page-section">
				<div class="container">
					<div class="row">
						 <div class="section-fullwidth col-lg-12">
						 	<div class="cs-content-holder">
								<div class="row">
									<div class="col-lg-12">
										<div class="page-not-found">
										  <div class="cs-icon">
											<img src="assets/extra-images/error-img.png" alt="#">
										  </div>
										  <div class="cs-content404">
											<h2>Oops, the page you are looking for might have<br>been removed</h2>
										  <div class="desc">
											  <div class="site-maps-links">
													<h6>Visit some of our working pages</h6>
													  <ul>
														  <li><a href="#" onclick="window.location.href='discover.php'">Home Page</a></li>
														  <!--<li><a href="#">About us</a></li>-->
														  <!--<li><a href="#">Services</a></li>-->
														  <!--<li><a href="#">Portfolio</a></li>-->
													  </ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						 </div> 
					</div>
				</div>
			</div>
		</div>
	</main>
	<!--// Main Content //--> 
	
	<!--// Footer Widget //-->
	<footer id="footer-sec">
		<div class="container">
			<div class="row">
				<div class="ads-sec col-lg-12"><a href="http://www.nike.com/us/en_us/c/jordan"><img src="assets/images/ads.jpg" alt="" ></a> </div>
				<div class="col-lg-12">
					<div class="tweet-sec">
						<p><i class="twitter-icon icon-twitter2"></i> Share my passion and meet with others that love #Jordans <a href="https://twitter.com/ajordanrelease">  For More ... </a></p>
					</div>
				</div>
				<aside class="col-lg-4 col-md-4 col-sm-6 widget widget_categories">
					<div class="widget-section-title"> <strong class="title">Campaigning</strong> </div>
					<ul>
						<li><a href="#">something to write?</a></li>
						<li><a href="#">Publishing</a></li>
						<!--<li><a href="#">Explore Partner Pages</a></li>-->
						<!--<li><a href="#">Music</a></li>-->
						<!--<li><a href="#">Daily Inspiration</a></li>-->
						<!--<li><a href="#">Film and Theatre</a></li>-->
						<!--<li><a href="#">Sign Up Now</a></li>-->
						<!--<li><a href="#">Food and Drink</a></li>-->
						<!--<li><a href="#">Private, secure, spam-free</a></li>-->
						<!--<li><a href="#">Sports</a></li>-->
						<!--<li><a href="#">School</a></li>-->
					</ul>
				</aside>
				<aside class="widget col-lg-4 col-md-4 col-sm-6 widget_categories">
					<div class="widget-section-title"> <strong class="title">Contributing</strong> </div>
					<ul>
						<li><a href="#">something to write?</a>
						<!--<li><a href="#">How crowdfunding works</a></li>-->
						<!--<li><a href="#">About</a></li>-->
						<!--<li><a href="#">Creating a project</a></li>-->
						<!--<li><a href="#">Guides</a></li>-->
						<!--<li><a href="#">Supporting a project</a></li>-->
						<!--<li><a href="#">Blog</a></li>-->
						<!--<li><a href="#">Guidelines</a></li>-->
						<!--<li><a href="#">Contact</a></li>-->
						<!--<li><a href="#">Jobs</a></li>-->
						<!--<li><a href="#">Partners</a></li>-->
					</ul>
				</aside>
				<aside class="widget col-lg-4 col-md-4 col-sm-6 widget_newsletter">
					<div class="widget-section-title"> <strong class="title">Weekly Newsletter</strong> </div>
					<form>
						<fieldset>
							<input type="submit" value="Submit" name="submit" class="cs-btn">
							<input class="email" type="email" placeholder="Your Email Address">
						</fieldset>
						<span>Private, secure, spam-free</span>
					</form>
				</aside>
			</div>
		</div>
	</footer>
	<!--// Footer Widget //--> 
	
	<!--// CopyRight //-->
	<div id="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6">
					<div class="footer_icon"><a href="#"><img src="assets/images/footer-logo.png" alt=""></a></div>
					<div class="fnav-area">
						<nav class="footer-nav">
							<ul>
								<li><a href="#">Home</a></li>
								<li><a href="#">something to write</a></li>
								<!--<li><a href="#">Showrooms</a></li>-->
								<!--<li><a href="#">Agents</a></li>-->
								<!--<li><a href="#">Blog</a></li>-->
								<!--<li><a href="#">Contact us</a></li>-->
							</ul>
						</nav>
						<p>©2017  All rights reserved by MXB</p>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6">
					<div class="social-media">
						<ul>
							<li><a href="#"><i class="icon-facebook7"></i></a></li>
							<li><a href="#"><i class="icon-twitter6"></i></a></li>
							<li><a href="#"><i class="icon-googleplus7"></i></a></li>
							<li><a href="#"><i class="icon-instagram4"></i></a></li>
							<li><a href="#"><i class="icon-youtube-play"></i></a></li>
							<li><a href="#"><i class="icon-skype"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--// CopyRight //--> 
	
</div>

<!-- jQuery (necessary JavaScript) --> 
<script src="assets/scripts/jquery.js"></script> 
<script src="assets/scripts/bootstrap.min.js"></script> 
<script src="assets/scripts/modernizr.js"></script>
<script src="assets/scripts/menu.js"></script>
<script src="assets/scripts/counter.js"></script> 
<script src="assets/scripts/jquery.flexslider-min.js"></script> 
<script src="assets/scripts/functions.js"></script>
<script type="text/javascript">
	   jQuery(window).load(function(){
        jQuery('.flexslider').flexslider({
          animation: "slide",
          prevText:"<em class='icon-arrow-left9'></em>",
          nextText:"<em class='icon-arrow-right9'></em>",
          start: function(slider){
            jQuery('body').removeClass('loading');
          }
        });
      });
</script>
</body>
</html>