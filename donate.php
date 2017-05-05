<?php
    session_start();
    require 'dbFNS.php';

    if (!$connection = mysqli_connect($hostName, $userName, $password))
        die("Cannot connect");
    mysqli_select_db($connection, $databaseName);
    $loginUsername = $_SESSION["loginUsername"];

    //user's profile
    $restday = $_SESSION["loginRestDay"];
    $createtime = $_SESSION["loginCreateTime"];

    //show the specific  project here


    $local_pid_detail = $_SESSION["pid_detail"];


    //for getting project description
    $query_description_detail = "SELECT * FROM project WHERE pid = '{$local_pid_detail}'";
    if(!$result_description_detail = @ mysqli_query($connection, $query_description_detail))
        showerror();

    $line_description_detail = mysqli_fetch_array($result_description_detail, MYSQLI_NUM);

    $local_username = $line_description_detail[1];
    $local_pname = $line_description_detail[2];
    $local_description = $line_description_detail[3];
    $local_posttime = $line_description_detail[4];
    $local_minfund = $line_description_detail[5];
    $local_maxfund = $line_description_detail[6];
    $local_endtime_timestamp = strtotime($line_description_detail[7]);
    $local_endtime = date('F d, Y',$local_endtime_timestamp);
    $local_completiontime_timestamp = strtotime($line_description_detail[8]);
    $local_completiontime =date('F d, Y', $local_completiontime_timestamp);
    $local_moneysum = $line_description_detail[9];
    $local_status = $line_description_detail[10];
    $local_finaltime = $line_description_detail[11];

    $_SESSION["pname"] = $local_pname;

    $local_funded_percent = floor(100*$local_moneysum/$local_maxfund);
    if($local_funded_percent == 0 && $local_moneysum != 0){
        $local_funded_percent = 1;
    }

    $max_donate_amount = $local_maxfund - $local_moneysum;

    //for getting comments
    $query_comment_detail = "SELECT username, commenttime, content FROM comments WHERE pid = '{$local_pid_detail}'";
    if(!$result_comment_detail = @ mysqli_query($connection, $query_comment_detail))
        showerror();

    //for getting project step time
    $query_project_time = "SELECT posttime, endtime, completiontime,status,finaltime FROM project WHERE pid = '{$local_pid_detail}'";
    if(!$result_project_time = @ mysqli_query($connection, $query_project_time))
        showerror();

    $line_project_time = mysqli_fetch_array($result_project_time, MYSQLI_NUM);

    $local_posttime = date('F d, Y',strtotime($line_project_time[0]));
    $local_endtime = date('F d, Y',strtotime($line_project_time[1]));
    $local_completiontime = date('F d, Y',strtotime($line_project_time[2]));
    $local_status = $line_project_time[3];
    $local_finaltime = $line_project_time[4];

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Crowdfunding</title>

<!-- Css (necessary Css) -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/bootstrap-theme.css" rel="stylesheet">
<link href="assets/css/language-selector-remove-able-css.css" rel="stylesheet">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link href="assets/css/flexslider.css" rel="stylesheet">
<link href="style.css" rel="stylesheet">
<link href="plugin.css" rel="stylesheet">
<link href="assets/css/responsive.css" rel="stylesheet">
<link href="assets/css/menu.css" rel="stylesheet">
<link href="assets/css/color.css" rel="stylesheet">
<link href="assets/css/iconmoon.css" rel="stylesheet">
<link href="assets/css/themetypo.css" rel="stylesheet">
<link href="assets/css/widget.css" rel="stylesheet">
<link href="assets/css/sumoselect.css" rel="stylesheet">


<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
            <li><a href="#">Discover</a>
              <ul class="sub-dropdown">
                <li><a href="listing-grid.html">Grid View</a></li>
                <li><a href="listing.php">List view</a></li>
                <li><a href="detail.php">Detail Page</a></li>
              </ul>
            </li>
            <li><a href="creators.html">Creators</a></li>
            <li><a href="supporters.html">Supporters</a></li>
            <li><a href="#">Pages</a>
              <ul class="sub-dropdown">
                <li><a href="about.html">About us</a></li>
                <li><a href="faq.html">FAQ’s</a></li>
                <li><a href="contect.html">Contect</a></li>
                <li><a href="sign.php">Create an Account</a></li>
                <li><a href="sign.php">Sign In</a></li>
                <li><a href="404.php">404 Page</a></li>
                <li><a href="under.html">under-construction</a></li>
                <li><a href="terms.html">Terms &amp; Conditions</a></li>
                <li><a href="pricing.html">Price &amp; Packges</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="site-map.html">Site Map</a></li>
                <li><a href="result.html">Result</a></li>
                <li><a href="donate.php">Donate</a></li>
                <li><a href="user-detail2.html">user detail2</a></li>
              </ul>
            </li>
            <li>
				<a href="#">News</a>
				<ul class="sub-dropdown">
					<li><a href="bloglrag.html">News Listing</a></li>
					<li><a href="blogmedium.html">News Medium</a></li>
					<li><a href="blogdetail.php">News Detail</a></li>
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
                  <!-- add a session to post value here -->
                  <h5> <?php echo $_SESSION["loginUsername"]; ?> </h5>
                  <span> <?php echo 'Member Since '.$createtime; ?> </span>
                  <span> <?php echo $restday.'days ago.  Great!'; ?> </span>
                <ul class="dropdown">
                  <li><a href="home.php"><i class="icon-flag5"></i>My project</a></li>
                  <li><a href="saved.html"><i class="icon-file-text-o"></i>Saved project</a></li>
                  <li><a href="my-donation.php"><i class="icon-file-text-o"></i>My Donations</a></li>
                  <li><a href="donation.html"><i class="icon-ticket6"></i>Donations</a></li>
                  <li><a href="profilesetting.html"><i class="icon-pie2"></i>Profile Settings</a></li>
                  <li><a href="create-new-project.php"><i class="icon-plus6"></i>Create New</a></li>
                </ul>
                <a class="sign-btn" href="#"><i class="icon-logout"></i>Sign Out</a>
              </div>
            </li>
          </ul>
        </div> 

    </div>
    <div class="mob-nav"></div>
    </div>
  </header>
  <!-- Header -->
	<div class="breadcrumb-sec donate-sec" style="background: url(assets/extra-images/bg-counter.jpg) no-repeat; background-size:100% auto; min-height:250px;">
		<div class="absolute-sec">
			<div class="container">
				<div class="cs-table">
					<div class="cs-tablerow">
						<div class="pageinfo page-title-align-left">
							<h1 style="color:#fff !important; text-transform:none;"><?php echo $local_pname ?></h1>
							<strong style="text-align:center; display:block; color:#fff; font-weight:normal;" class="title">People just like you have used their money to make the change.</strong>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Main Content -->
	<main id="main-content">
		<div class="main-section" style="padding:0;">
			<section class="page-section bg-donate">
				<div class="container">
					<div class="row">
						<div class="section-fullwidth">
							<div class="cs-content-holder">
								<div class="row">
									<div class="col-lg-12">
										<div class="donate-area">
											<ul class="nav nav-tabs" role="tablist">
												<li class="active" role="presentation"><a data-toggle="tab" role="tab" aria-controls="home" >01. Donate</a></li>
												<li role="presentation"><a aria-controls="profile" >02. Payment</a></li>
												<li role="presentation"><a aria-controls="messages">03. Confirmation</a></li>
											</ul>
											<div class="tab-content">
												<div id="home" class="tab-pane active fade in" role="tabpanel">
													<f class="donate-holder">
                                                        <form method="POST" action="donatePage2.php">
                                                            <h3>Your Donation</h3>
                                                            <div class="cs-holder">
                                                                <div class="slider-value">

                                                                        <span>$</span>
                                                                        <input type="text" name = "donate_amount" value="1">

                                                                </div>
                                                            </div>
                                                            <div class="cs-holder">
                                                                <div id="slider"></div>
                                                            </div>
<!--                                                            <div class="spreator3">-->
<!--                                                                <span>Or</span>-->
<!--                                                            </div>-->
<!--                                                            <h3>Enter your Amount</h3>-->
<!--                                                            <div class="form-area">-->
<!--                                                                    <div class="input-area">-->
<!--                                                                        <span>$</span>-->
<!--                                                                        <input type="text" placeholder="--><?php //echo $max_donate_amount; ?><!--">-->
<!--                                                                    </div>-->
<!--                                                            </div>-->
    <!--														<div class="amount-area">-->
    <!--															<div class="left-side">-->
    <!--																<p>-->
    <!--																	<span>$</span>-->
    <!--																	Total Amount-->
    <!--																</p>-->
    <!--															</div>-->
    <!--															<div class="right-side">-->
    <!--																<input type="text" value="$0.00">-->
    <!--															</div>-->
    <!--														</div>-->
<!--                                                            <div class="cs-holder">-->
<!--                                                                <div class="Sigup-btn">-->
<!--                                                                    <span>Or</span>-->
<!--                                                                    <a href="#" class="account-btn">Have and Account?</a>-->
<!--                                                                    <a href="#">Sigup for a new account</a>-->
<!--                                                                </div>-->
<!--                                                            </div>-->
                                                            <div class="cs-holder">
                                                                <input type="submit" value="Go to Payments">
                                                            </div>
                                                        </form>
                                                    </f>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</section>
		</div>
	</main>
	<!--// Main Content //--> 
	
	<!--// Footer Widget //-->
	<footer id="footer-sec">
		<div class="container">
			<div class="row">
				<div class="ads-sec col-lg-12"> <img src="assets/images/ads.jpg" alt="" > </div>
				<div class="col-lg-12">
					<div class="tweet-sec">
						<p><i class="twitter-icon icon-twitter2"></i> Thing anyone did today was get ready for #Scandal <a href="#">http://t.co/UfiNiBLWlZ http://t.co/Fvggnf320f</a> <span class="by">Boxtheme</span> <span class="time">10 hours ago</span></p>
					</div>
				</div>
				<aside class="col-lg-4 col-md-4 col-sm-6 widget widget_categories">
					<div class="widget-section-title"> <strong class="title">Campaigning</strong> </div>
					<ul>
						<li><a href="#">Contributing</a></li>
						<li><a href="#">Publishing</a></li>
						<li><a href="#">Explore Partner Pages</a></li>
						<li><a href="#">Music</a></li>
						<li><a href="#">Daily Inspiration</a></li>
						<li><a href="#">Film and Theatre</a></li>
						<li><a href="#">Sign Up Now</a></li>
						<li><a href="#">Food and Drink</a></li>
						<li><a href="#">Private, secure, spam-free</a></li>
						<li><a href="#">Sports</a></li>
						<li><a href="#">School</a></li>
					</ul>
				</aside>
				<aside class="widget col-lg-4 col-md-4 col-sm-6 widget_categories">
					<div class="widget-section-title"> <strong class="title">Contributing</strong> </div>
					<ul>
						<li><a href="#">Crowdfunder API - Beta</a>
						<li><a href="#">How crowdfunding works</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#">Creating a project</a></li>
						<li><a href="#">Guides</a></li>
						<li><a href="#">Supporting a project</a></li>
						<li><a href="#">Blog</a></li>
						<li><a href="#">Guidelines</a></li>
						<li><a href="#">Contact</a></li>
						<li><a href="#">Jobs</a></li>
						<li><a href="#">Partners</a></li>
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
								<li><a href="#">Categories</a></li>
								<li><a href="#">Showrooms</a></li>
								<li><a href="#">Agents</a></li>
								<li><a href="#">Blog</a></li>
								<li><a href="#">Contact us</a></li>
							</ul>
						</nav>
						<p>©2014 Box Theme All rights reserved. Design by <a href="http://www.jqueryfuns.com">Chimp Studio</a></p>
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
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="assets/scripts/functions.js"></script>
  <script>
  $(function() {
	jQuery("#slider").slider({
      range: "min",
      min: 1,
      max: <?php echo $max_donate_amount; ?>,
      slide: function(event, ui) {
        jQuery('.slider-value input').val(ui.value);

        //try
         $.post("donatePage2.php", ui.value);
      },
  });  
	  
    //$( "#slider" ).slider({
//		change: function(event, ui) {
//			jQuery('.slider-value input').val(ui.value);
//		}
//	});
  });
  </script>
</body>
</html>