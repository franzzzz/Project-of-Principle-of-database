<?php
    session_start();
    echo $_GET["s"];
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
    $_SESSION["loginRestDay"] = $restday;
    $createtime = date('F d, Y', $php_createtime_timestamp);
    $_SESSION["loginCreateTime"] = $createtime;

    //assume the loggin user is looking the user file of 'B'
    $_SESSION["view_username"] = 'A'; //to be deleted

    $view_username = $_SESSION["view_username"];

    $query_show_viewed_user_pro = "SELECT * FROM User WHERE username = '{$view_username}'";

    if (!$result_show_viewed_user_pro = @ mysqli_query($connection, $query_show_viewed_user_pro))
        header("Location: 404.php");
    $line_show_viewed_user_pro = mysqli_fetch_array($result_show_viewed_user_pro, MYSQLI_NUM);

    $view_email = $line_show_viewed_user_pro[3];
    $view_hometown = $line_show_viewed_user_pro[5];

    $view_createtime = strtotime($line_show_viewed_user_pro[6]);
    $view_createtime =date('F d, Y', $view_createtime);

    //donations & donated
    $query_sum_donation = "SELECT sum(moneysum) FROM Project WHERE username = '{$view_username}'";
    $result_sum_donation = @ mysqli_query($connection, $query_sum_donation);
    $donation = mysqli_fetch_array($result_sum_donation)[0];
    $query_sum_donated = "SELECT sum(amount) FROM Pledge WHERE username = '{$view_username}'";
    $result_sum_donated = @ mysqli_query($connection, $query_sum_donated);
    $donated = mysqli_fetch_array($result_sum_donated)[0];

    //get create projects
    $query_create_pro = "SELECT pname, username, maxfund, endtime, moneysum, pid FROM project WHERE username = '{$view_username}' ";
    $result_create_pro = @ mysqli_query($connection, $query_create_pro);

    //get donate projects
    $query_donate_pro = "SELECT DISTINCT pname, P.username, maxfund, endtime, moneysum, pid FROM project join pledge P using (pid) WHERE P.username = '{$view_username}';";
    if(!$result_donate_pro = @ mysqli_query($connection, $query_donate_pro))
        showerror();

    //for getting comments
    $query_comment_detail = "SELECT username, commenttime, content FROM comments WHERE username = '{$view_username}'";
    if(!$result_comment_detail = @ mysqli_query($connection, $query_comment_detail))
        showerror();


//
//echo $view_email;

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

<!-- jQuery (necessary JavaScript) --> 
<script src="assets/scripts/jquery.js"></script> 
<script src="assets/scripts/bootstrap.min.js"></script> 
<script src="assets/scripts/modernizr.js"></script>
<script src="assets/scripts/menu.js"></script> 
 
<script src="assets/scripts/functions.js"></script>
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
                                    <li><a href="viewOtherUser.php">user detail2</a></li>
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
                                    <a class="sign-btn" href="#" onclick="window.location.href='sign.php'"><i class="icon-logout"></i>Sign Out</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- <a href="sign.php" class="free-btn">Start for Free</a>  -->
                </div>
            </div>
            <div class="mob-nav"></div>
        </div>
    </header>
  <!-- Header -->
	
	<!-- Main Content -->
	<main id="main-content">
		<div class="main-section user-detail2">
			<div class="page-section bg-author">
				<div class="container">
					<div class="row">
						<div class="section-fullwidth col-lg-12">
							<div class="cs-content-holder">
								<div class="row">
									<div class="col-lg-12">
										<div class="author-info">



											<figure>
												<img src="assets/extra-images/author-img3.jpg" alt="#">
											</figure>
											<div class="info-text">
												<time datetime="2008-02-14">Member Since :  <?php echo $view_createtime; ?></time>
												<div class="heading-sec">
													<h2><?php echo $_SESSION["view_username"]; ?> </h2>
													<span>Creator!</span>
												</div>
												<ul class="post-options">
													<li><i class="cscolor icon-map-marker"></i><?php echo $view_hometown; ?></li>
													<li><i class="cscolor icon-phone8"></i><?php echo $view_email; ?></li>
												</ul>
												<p>Some effusive some misspelled groundhog beproject well pending much and considering-<br> hello far tremendous the imprecise grew less much jeepers jeepers jeepers.</p>
												<div class="social-media">
													<ul>
														<li><a href="#"><i class="icon-facebook-square"></i></a></li>
														<li><a href="#"><i class="icon-twitter6"></i></a></li>
														<li><a href="#"><i class="icon-instagram4"></i></a></li>
														<li><a href="#"><i class="icon-skype"></i></a></li>
													</ul>
												</div>
											</div>
											<div class="price-box">
												<ul>
													<li>
														<p class="colected-box">
															<span>Donation Collected</span>
															<strong><small>$</small><?php echo $donated ?></strong>
														</p>
													</li>
													<li>
														<p class="projects-box">
															<span>Donation give out</span>
															<strong><small>$</small><?php echo $donation ?></strong>
														</p>
													</li>
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
			<div class="page-section" style="padding:0;">
				<div class="container">
					<div class="row">
						<div class="section-fullwidth">
							<div class="cs-content-holder">
								<div class="row">
									<div class="col-lg-12">
										<div class="detail-tabs">
											<ul role="tablist" class="nav nav-tabs">
												<li class="active" role="presentation"><a data-toggle="tab" role="tab" aria-controls="home" href="#home" aria-expanded="false">Backed </a></li>
												<li role="presentation" class=""><a data-toggle="tab" role="tab" aria-controls="profile" href="#profile" aria-expanded="false">Created </a></li>
												<li role="presentation" class=""><a data-toggle="tab" role="tab" href="#comments" aria-expanded="false">comments</a></li>
												<li role="presentation" class=""><a data-toggle="tab" role="tab" aria-controls="settings" href="#settings" aria-expanded="false">Full Bio</a></li>
											  </ul>
											<div class="tab-content">
												<div id="home" class="tab-pane active fade in" role="tabpanel">
													<div class="listing_grid">
														<div class="row">

                                                            <?php

                                                            while ($line_show_all_pro = mysqli_fetch_array($result_donate_pro, MYSQLI_NUM)){


                                                                $php_endtime_timestamp = strtotime($line_show_all_pro[3]);
                                                                $endtime = date('m/d, Y', $php_endtime_timestamp);
                                                                //maxsum != 0
                                                                $funded_percent = floor(100*$line_show_all_pro[4]/$line_show_all_pro[2]);
                                                                if($funded_percent == 0 && $line_show_all_pro[4] != 0){
                                                                    $funded_percent = 1;
                                                                }

                                                                echo "
                                                                        <article class=\"col-lg-4 col-md-4 col-sm-6\">
                                                                          <div class=\"directory-section\">
                                                                            <div class=\"cs_thumbsection\">
                                                                              <figure><a href=\"#\" onclick=\"window.location.href='detail.php?pid_detail=".$line_show_all_pro[5]."'\"><img src=\"assets/extra-images/listing-grid-1.jpg\" alt=\"\"></a></figure>
                                                                            </div>
                                                                            <div class=\"content_info\">
                                                                              <div class=\"title\">
                                                                                <h3><a href=\"#\" onclick=\"window.location.href='detail.php?pid_detail=".$line_show_all_pro[5]."'\">".$line_show_all_pro[0]."</a></h3>
                                                                                <span class=\"addr\">".$line_show_all_pro[1]."</span> </div>
                                                                              <div class=\"dr_info\">
                                                                                <ul>
                                                                                  <li> <i class=\"cscolor icon-target5\"></i> $".$line_show_all_pro[2]." goal </li>
                                                                                  <li> <i class=\"cscolor icon-clock7\"></i> ".$endtime." </li>
                                                                                </ul>
                                                                                <span class=\"bar\"><span style=\"width:".$funded_percent."%;\"></span></span>
                                                                                <div class=\"detail\"> <span class=\"fund\">".$funded_percent."% Funded</span> <a href=\"#\" class=\"star icon-star\"></a> </div>
                                                                              </div>
                                                                            </div>
                                                                          </div>
                                                                        </article>
                                                                    ";
                                                            }
                                                            ?>


														</div>
													</div>
												</div>
												<div id="profile" class="tab-pane fade in" role="tabpanel">
													<div class="listing_grid">
														<div class="row">



                                                            <?php

                                                                while ($line_show_all_pro = mysqli_fetch_array($result_create_pro, MYSQLI_NUM)){


                                                                    $php_endtime_timestamp = strtotime($line_show_all_pro[3]);
                                                                    $endtime = date('m/d, Y', $php_endtime_timestamp);
                                                                    //maxsum != 0
                                                                    $funded_percent = floor(100*$line_show_all_pro[4]/$line_show_all_pro[2]);
                                                                    if($funded_percent == 0 && $line_show_all_pro[4] != 0){
                                                                        $funded_percent = 1;
                                                                    }

                                                                    echo "
                                                                        <article class=\"col-lg-4 col-md-4 col-sm-6\">
                                                                          <div class=\"directory-section\">
                                                                            <div class=\"cs_thumbsection\">
                                                                              <figure><a href=\"#\" onclick=\"window.location.href='detail.php?pid_detail=".$line_show_all_pro[5]."'\"><img src=\"assets/extra-images/listing-grid-1.jpg\" alt=\"\"></a></figure>
                                                                            </div>
                                                                            <div class=\"content_info\">
                                                                              <div class=\"title\">
                                                                                <h3><a href=\"#\" onclick=\"window.location.href='detail.php?pid_detail=".$line_show_all_pro[5]."'\">".$line_show_all_pro[0]."</a></h3>
                                                                                <span class=\"addr\">".$line_show_all_pro[1]."</span> </div>
                                                                              <div class=\"dr_info\">
                                                                                <ul>
                                                                                  <li> <i class=\"cscolor icon-target5\"></i> $".$line_show_all_pro[2]." goal </li>
                                                                                  <li> <i class=\"cscolor icon-clock7\"></i> ".$endtime." </li>
                                                                                </ul>
                                                                                <span class=\"bar\"><span style=\"width:".$funded_percent."%;\"></span></span>
                                                                                <div class=\"detail\"> <span class=\"fund\">".$funded_percent."% Funded</span> <a href=\"#\" class=\"star icon-star\"></a> </div>
                                                                              </div>
                                                                            </div>
                                                                          </div>
                                                                        </article>
                                                                    ";
                                                                    }
                                                            ?>


<!--														<article class="col-lg-3 col-md-3 col-sm-6">-->
<!--															<div class="directory-section">-->
<!--																<div class="cs_thumbsection">-->
<!--																	<figure>-->
<!--																		<a href="#">-->
<!--																			<img alt="#" src="assets/extra-images/listing-grid-1.jpg">-->
<!--																		</a>-->
<!--																	</figure>-->
<!--																</div>-->
<!--																<div class="content_info">-->
<!--																	<div class="title">-->
<!--																		<h3><a href="#">We Are Cove Point - Stop Gas Export Plant</a></h3>-->
<!--																		<span class="addr">214 Greene Avenue</span> </div>-->
<!--																	<div class="dr_info">-->
<!--																		<ul>-->
<!--																			<li> <i class="cscolor icon-target5"></i> $84,000 goal </li>-->
<!--																			<li> <i class="cscolor icon-clock7"></i> July 27, 2014 </li>-->
<!--																		</ul>-->
<!--																		<span class="bar"><span style="width:84%;"></span></span>-->
<!--																		<div class="detail"> <span class="fund">84% Funded</span> <a data-original-title="Mark as Favorite" data-toggle="tooltip" data-placement="top" class="tolbtn close star"><i class="icon-star"></i></a> </div>-->
<!--																	</div>-->
<!--																</div>-->
<!--															</div>-->
<!--														</article>-->


														</div>
													</div>
												</div>
												<div id="comments" class="tab-pane fade in" role="tabpanel">
													<div id="comment">
													  <div class="cs-section-title"><h2>His Comments History</h2></div>
													  <!-- Ul Start -->
													  <ul>


                                                          <?php
                                                          $counter_pledger = 1;

                                                          while ($line_comment_detail = mysqli_fetch_array($result_comment_detail, MYSQLI_NUM)){

                                                              $local_comment_username = $line_comment_detail[0];
                                                              $local_comment_commenttime = $line_comment_detail[1];
                                                              $local_comment_content = $line_comment_detail[2];




                                                              echo "
                                                                                <li >
                                                                                    <div class=\"thumblist\">
                                                                                        <ul>
                                                                                            <li>
                                                                                                <figure> <a href=\"#\"><img src=\"assets/extra-images/img-coment2.png\" alt=\"#\"></a> </figure>
                                                                                                <div class=\"text-box\">
                                                                                                    
                                                                                                    <h4>"."$local_comment_username"."</h4>
                                                                                                    <time>"."$local_comment_commenttime"."</time>
                                                                                                    <p>"."$local_comment_content"."</p>
                                                                                                </div>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </li>
                                                                            ";
                                                          }
                                                          ?>


													  </ul>
													</div>

												</div>
												<div id="settings" class="tab-pane fade in" role="tabpanel">
													<div class="post-block summary-sec rich_editor_text">
														<span>Some effusive some misspelled groundhog rose temperate beproject well<br> pending much and considering hello far tremendous the imprecise grew less much jeepers breathless and hey</span>
														<p>Some effusive some misspelled groundhog rose temperate beproject well pending much and considering hello far tremendous the imprecise grew less much jeepers breathless and hey far more much belligerent hawk the placed warthog angrily outside goodness poutingly more gerbil much komodo far barring dependently but one hey reluctant salamander overrode this moth while in foresaw much handsomely ineffective muttered covetous a thanks that but moth well wherever less a rode abrasively oh much more steadily rid far immediate grouped vulgar jeez wanly.While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more overpaid deer.</p>
														<p>Some effusive some misspelled groundhog rose temperate beproject well pending much and considering hello far tremendous the imprecise grew less much jeepers breathless and hey far more much belligerent hawk the placed warthog angrily outside goodness poutingly more gerbil much komodo far barring dependently but one hey reluctant salamander overrode this moth while in foresaw much handsomely ineffective muttered covetous a thanks that but moth well wherever less a rode abrasively oh much more steadily,</p>
														<p>Some effusive some misspelled groundhog rose temperate beproject well pending much and considering hello far tremendous the imprecise grew less much jeepers breathless and hey far more much belligerent hawk the placed warthog angrily outside goodness poutingly more gerbil much komodo far barring dependently but one hey reluctant salamander. </p>
														<p>Some effusive some misspelled groundhog rose temperate beproject well pending much and considering hello far tremendous the imprecise grew less much jeepers breathless and hey far more much belligerent hawk the placed warthog angrily outside goodness poutingly more gerbil much komodo far barring dependently but one hey reluctant salamander overrode this moth while in foresaw much handsomely ineffective muttered covetous a thanks that but moth well wherever less a rode abrasively oh much more steadily,</p>
														<p>Some effusive some misspelled groundhog rose temperate beproject well pending much and considering hello far tremendous the imprecise grew less much jeepers breathless and hey far more much belligerent hawk the placed warthog angrily outside goodness poutingly more gerbil much komodo far barring dependently but one hey reluctant salamander.</p>
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
</body>
</html>