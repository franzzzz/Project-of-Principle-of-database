<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Crowdfunding</title>

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

  //show all project here
  $query_show_all_pro = "SELECT pname, username, maxfund, endtime, moneysum, description, pid FROM project WHERE status = 'funding'";
  $result_show_all_pro = @ mysqli_query($connection, $query_show_all_pro);

?>

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
        <!-- <a href="sign.php" class="free-btn">Start for Free</a> </div> -->
    </div>
    <div class="mob-nav"></div>
    </div>
  </header>
  <!-- Header -->  
<!-- 	<div class="breadcrumb-sec" style="background:url(assets/extra-images/banner.jpg) no-repeat; background-size:100% auto; min-height:157px!important;">
		<div class="absolute-sec">
			<div class="container">
				<div class="cs-table">
					<div class="cs-tablerow">
						<div class="pageinfo page-title-align-left">
							<h1 style="color:#fff !important; text-transform:none;">Explore Projects</h1>
							<strong style="text-align:center; display:block; color:#fff; font-weight:normal;" class="title">People just like you have used Razoo to create more than 90,000 fundraising websites<br>and to give over $250,000,000 to the project they care about.</strong>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<!-- Main Content -->
	<main id="main-content">
		<div class="main-section">
			<div class="page-section">
				<div class="container">
					<div class="row">
						<div class="section-fullwidth col-lg-12">
							<div class="cs-content-holder">
								<div class="row">
									<aside class="page-sidebar col-lg-3">
										<div class="widget cs_directory_categories">
										<div class="cs-search-area">
                                            <form method="post" action="searchResult.php">

                                                <fieldset>
                                                    <label class="search">
                                                        <input type="search" name="search_key" placeholder="Search Project">
                                                    </label>
                                                    <input type="submit" value="Search" >

                                                </fieldset>

                                            </form>
											</div>
                                            <div class="widget-section-title">
                                                <h4><i class="icon-globe4"></i>All Diverse Tags</h4>
                                            </div>
                                            <ul class="menu">



                                                <li><a href="searchTagResult.php?tag=Art"><i class="icon-user9 cscolor"></i>Art</a></li>
                                                <li><a href="searchTagResult.php?tag=Comics"><i class="icon-heart11 cscolor"></i>Comics</a> </li>
                                                <li><a href="searchTagResult.php?tag=Craft"><i class="icon-brush2 cscolor"></i>Craft</a> </li>
                                                <li><a href="searchTagResult.php?tag=Dance"><i class="icon-circle-thin cscolor"></i>Dance</a> </li>
                                                <li><a href="searchTagResult.php?tag=Design"><i class="icon-key7 cscolor"></i>Design</a> </li>
                                                <li><a href="searchTagResult.php?tag=Fashion"><i class="icon-sun4 cscolor"></i>Fashion</a> </li>
                                                <li><a href="searchTagResult.php?tag=Film"><i class="icon-light-bulb cscolor"></i>Film</a></li>
                                                <li><a href="searchTagResult.php?tag=Food"><i class="icon-clipboard6 cscolor"></i>Food</a> </li>
                                                <li><a href="searchTagResult.php?tag=Games"><i class="icon-archive2 cscolor"></i>Games</a> </li>
                                                <li><a href="searchTagResult.php?tag=Journalism"><i class="icon-pie2 cscolor"></i>Journalism</a> </li>
                                                <li><a href="searchTagResult.php?tag=Music"><i class="icon-lock6 cscolor"></i>Music</a> </li>
                                                <li><a href="searchTagResult.php?tag=Photography"><i class="icon-upload10 cscolor"></i>Photography</a> </li>
                                                <li><a href="searchTagResult.php?tag=Publishing"><i class="icon-archive3 cscolor"></i>Publishing</a> </li>
                                                <li><a href="searchTagResult.php?tag=Technology"><i class="icon-sound4 cscolor"></i>Technology</a> </li>
                                                <li><a href="searchTagResult.php?tag=Theatre"><i class="icon-evernote cscolor"></i>Theatre</a> </li>



                                            </ul>
										</div>
										<div class="widget_advertisment widget"> <img src="assets/extra-images/adv2.jpg" alt=""> 
										</div>
									</aside>
									<div class="page-content col-lg-9">
										<div class="row">
											<div class="col-lg-12 main-filter">
												<nav class="wow filter-nav">
												<!--Sorting Navigation-->
													<ul class="cs-filter-menu pull-left">
														<li><a href="javascript:void(0)">Newest</a></li>
														<li><a href="javascript:void(0)">Popularity</a></li>
														<li><a href="javascript:void(0)">End Date</a></li>
														<li><a href="javascript:void(0)">Most Funded</a></li>
														<li><a href="javascript:void(0)">Magic</a></li>
													</ul>
												<!--Sorting Navigation End-->
													<ul class="grid-filter">
                            <li><a href="javascript:void(0)" onclick="window.location.href='discover.php'"><i class="icon-layout15"></i></a></li>
														<li class="active"><a href="javascript:void(0)"><i class="icon-list7"></i></a></li>
													</ul>
												</nav>
											</div>
											<div class="listing_default">

                        <?php  
                          while ($line_show_all_pro = mysqli_fetch_array($result_show_all_pro, MYSQLI_NUM)){
                            
                            $php_endtime_timestamp = strtotime($line_show_all_pro[3]);
                            $endtime = date('m/d, Y', $php_endtime_timestamp);
                            //maxsum != 0
                            $funded_percent = floor(100*$line_show_all_pro[4]/$line_show_all_pro[2]);
                            if($funded_percent == 0 && $line_show_all_pro[4] != 0){
                              $funded_percent = 1;
                            }
                            
                            echo "
                            <article class=\"col-lg-12\">
                              <div class=\"directory-section\">
                                <div class=\"cs_thumbsection\">
                                  <figure><a href=\"#\" onclick=\"window.location.href='detail.php?pid_detail=".$line_show_all_pro[6]."'\"><img src=\"assets/extra-images/listing-grid-1.jpg\" alt=\"#\"></a></figure>
                                </div>
                                <div class=\"content_info\">
                                  <div class=\"title\">
                                    <h3><a href=\"#\" onclick=\"window.location.href='detail.php?pid_detail=".$line_show_all_pro[6]."'\">".$line_show_all_pro[0]."</a></h3>
                                    <span class=\"addr\">".$line_show_all_pro[1]."</span>
                                    <p>".$line_show_all_pro[5]."</p> 
                                  </div>
                                  <div class=\"dr_info\">
                                    <ul>
                                      <li> <i class=\"cscolor icon-target5\"></i> $".$line_show_all_pro[2]." goal </li>
                                      <li> <i class=\"cscolor icon-clock7\"></i> ".$endtime." </li>
                                    </ul>
                                    <span class=\"bar\"><span style=\"width:".$funded_percent."%;\"></span></span>
                                    <div class=\"detail\"> <span class=\"fund\">".$funded_percent."% Funded</span> <a href=\"tolbtn close star\" data-placement=\"top\" data-toggle=\"tooltip\" data-original-title=\"Mark as Favorite\"><i class=\"icon-star\"></i></a> </div>
                                  </div>
                                </div>
                              </div>
                            </article>
                            ";
                          }
                        ?>
<!-- 
												<article class="col-lg-12">
													<div class="directory-section">
														<div class="cs_thumbsection">
															<figure><a href="#"><img src="assets/extra-images/img.jpg" alt="#"></a></figure>
														</div>
														<div class="content_info">
															<div class="title">
																<h3><a href="#">We Are Cove Point - Stop Gas Export Plant</a></h3>
																<span class="addr">214 Greene Avenue</span> 
																<p></p>
															</div>
															<div class="dr_info">
																<ul>
																	<li> <i class="cscolor icon-target5"></i> $84,000 goal </li>
																	<li> <i class="cscolor icon-clock7"></i> July 27, 2014 </li>
																</ul>
																<span class="bar"><span style="width:12%;"></span></span>
																<div class="detail"> <span class="fund">12% Funded</span> <a class="tolbtn close star" data-placement="top" data-toggle="tooltip" data-original-title="Mark as Favorite"><i class="icon-star"></i></a> </div>
															</div>
														</div>
													</div>
												</article>
												<article class="col-lg-12">
													<div class="directory-section">
														<div class="cs_thumbsection">
															<figure>
																<a href="#">
																	<img src="assets/extra-images/listing-grid-1.jpg" alt="#">
																</a>
															</figure>
														</div>
														<div class="content_info">
															<div class="title">
																<h3><a href="#">We Are Cove Point - Stop Gas Export Plant</a></h3>
																<span class="addr">214 Greene Avenue</span> 
																<p>That sneered vivaciously that thus hey porpoise uncritical gosh be and much and this haughgosh be and much and this haughtily broadcast goodness.</p>
															</div>
															<div class="dr_info">
																<ul>
																	<li> <i class="cscolor icon-target5"></i> $84,000 goal </li>
																	<li> <i class="cscolor icon-clock7"></i> July 27, 2014 </li>
																</ul>
																<div class="spreator"></div>
																<div class="detail"> <span class="unsuccess">Funding Unsuccessful</span> <a class="tolbtn close star" data-placement="top" data-toggle="tooltip" data-original-title="Mark as Favorite"><i class="icon-star"></i></a> </div>
															</div>
														</div>
													</div>
												</article>
												<article class="col-lg-12">
													<div class="directory-section">
														<div class="cs_thumbsection">
															<figure>
																<a href="#">
																	<img src="assets/extra-images/listing-grid-2.jpg" alt="#">
																</a>
															</figure>
														</div>
														<div class="content_info">
															<div class="title">
																<h3><a href="#">We Are Cove Point - Stop Gas Export Plant</a></h3>
																<span class="addr">214 Greene Avenue</span> 
																<p>That sneered vivaciously that thus hey porpoise uncritical gosh be and much and this haughgosh be and much and this haughtily broadcast goodness.</p>
															</div>
															<div class="dr_info">
																<ul>
																	<li> <i class="cscolor icon-target5"></i> $84,000 goal </li>
																	<li> <i class="cscolor icon-clock7"></i> July 27, 2014 </li>
																</ul>
																<span class="bar"><span style="width:12%;"></span></span>
																<div class="detail"> <span class="fund">12% Funded</span> <a class="tolbtn close star" data-placement="top" data-toggle="tooltip" data-original-title="Mark as Favorite"><i class="icon-star"></i></a> </div>
															</div>
														</div>
													</div>
												</article> -->
											</div>
											<div class="col-lg-12">
												<nav class="pagination">
													<ul>
														<li class="pgprev"><a href="#"><i class="cscolor icon-angle-left"></i> Previous</a></li>
														<li><a href="#">1</a></li>
														<li><a class="active">2</a></li>
														<li><a href="#">3</a></li>
														<li><a href="#">4</a></li>
														<li><a href="#">5</a></li>
														<li class="pgnext"><a href="#" class="icon">Next <i class="cscolor icon-angle-right"></i></a></li>
													</ul>
												</nav>
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

<!-- jQuery (necessary JavaScript) --> 
<script src="assets/scripts/jquery.js"></script> 
<script src="assets/scripts/bootstrap.min.js"></script> 
<script src="assets/scripts/modernizr.js"></script>
<script src="assets/scripts/menu.js"></script> 

<script src="assets/scripts/jquery.flexslider-min.js"></script> 
<script src="assets/scripts/functions.js"></script>
<script src="assets/scripts/masonary.js"></script>
<script src="assets/scripts/jquery.sumoselect.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(e) {
		var $container = $('.masonary-sec');
		$container.masonry({
			gutter: 10,
			itemSelector: '.post-854'
		});
		$('.sumoselect').SumoSelect();
	});
</script>
<script >
	jQuery(window).load(function(){
		jQuery('.flexslider').flexslider({
			animation: "slide",
			controlNav: false,
			prevText:"<em class='icon-arrow-left10'></em>",
			nextText:"<em class='icon-arrow-right10'></em>",
			start: function(slider){
				jQuery('body').removeClass('loading');
			}
		});
	});

      jQuery(document).ready(function($) {
        jQuery('.tolbtn').tooltip('hide');
      });

</script>
</body>
</html>