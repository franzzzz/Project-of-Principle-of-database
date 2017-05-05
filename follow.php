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
$_SESSION["loginRestDay"] = $restday;
$createtime = date('F d, Y', $php_createtime_timestamp);
$_SESSION["loginCreateTime"] = $createtime;

  //donations & donated
$query_sum_donation = "SELECT sum(moneysum) FROM Project WHERE username = '{$loginUsername}'";
$result_sum_donation = @ mysqli_query($connection, $query_sum_donation);
$donation = mysqli_fetch_array($result_sum_donation)[0];
if($donation == null) $donation=0;
$query_sum_donated = "SELECT sum(amount) FROM Pledge WHERE username = '{$loginUsername}'";
$result_sum_donated = @ mysqli_query($connection, $query_sum_donated);
$donated = mysqli_fetch_array($result_sum_donated)[0];
if($donated == null) $donated = 0;

$query_show_all_follow = "SELECT * FROM user join follow where follow.followedusername = user.username AND follow.fanusername = '{$loginUsername}'";
$result_show_all_follow = @ mysqli_query($connection, $query_show_all_follow);

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
                <div class="logo"><a href="home.php"><img src="assets/images/logo.png" alt=""></a></div>
                <nav class="navigation">
                  <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="discover.php">Discover</a></li>
                  </ul>
                </nav>
              </div>
              <div class="right-side">
                <div class="cs-search-block">
                  <form>
                    <input type="text" id="s" name="s" value="Search Project" onfocus="if(this.value =='Search Project') { this.value = ''; }" onblur="if(this.value == '') { this.value ='Search Project'; }" class="form-control">
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
                          <li><a href="home.php"><i class="icon-flag5"></i>Project you may like</a></li>
                          <li><a href="project.php"><i class="icon-ticket6"></i>My project</a></li>
                          <li><a href="saved.php"><i class="icon-file-text-o"></i>Saved project</a></li>
                          <li><a href="my-donation.php"><i class="icon-file-text-o"></i>My Donations</a></li>
                          <li><a href="follow.php"><i class="icon-pie2"></i>Follows</a></li>
                          <li><a href="create-new-project.php"><i class="icon-plus6"></i>Create New</a></li>
                        </ul>
                        <a class="sign-btn" href="#" onclick="window.location.href='sign.php'"><i class="icon-logout"></i>Sign Out</a>
                      </div>
                    </li>
                  </ul>
                </div> 
                <div class="mob-nav"></div>
              </div>
            </header>
            <!-- Header -->
<!--   <div class="breadcrumb-sec" style="background:url(assets/images/bg-signup.jpg) no-repeat; background-size:100% auto; min-height:157px!important;">
    <div class="absolute-sec">
      <div class="container">
        <div class="cs-table">
          <div class="cs-tablerow">
            <div class="pageinfo page-title-align-left">
              <h1 style="color:#fff !important; text-transform:none;">Active Members</h1>
              <strong style="text-align:center; display:block; color:#fff; font-weight:normal;" class="title">People just like you have used Razoo to create more than 90,000 fundraising websites.</strong>
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
                  <div class="profile-pages">
                    <div class="container">
                      <div class="row">
                        <div class="section-fullwidth col-lg-12">
                          <div class="cs-content-holder">
                            <div class="row">
                              <div class="project-holder">
                                <div class="col-lg-12">
                                  <div class="cs-auther">
                                    <figure>
                                      <a href="#"><img src="assets/extra-images/auther1.jpg" alt="#"></a>
                                    </figure>
                                    <div class="text">
                                      <h3><?php echo $_SESSION["loginUsername"]; ?></h3>
                                      <span><?php echo 'Member Since '.$createtime; ?></span>
                                    </div>
                                  </div>
                                  <div class="right-sec">
                                    <ul class="cs-donations">
                                      <li>
                                        <span>Donations</span>
                                        <strong><?php echo "$ ".$donation ?></strong>
                                      </li>
                                      <li>
                                        <span>Donated</span>
                                        <strong><?php echo "$ ".$donated ?></strong>
                                      </li>
                                    </ul>
                                  </div>
                                </div>
                                <div class="col-lg-12">
                                  <div class="profile-block">
                                    <ul class="scroll-nav">
                                      <li><a href="home.php"><i class="icon-star-o"></i>Home</a></li>
                                      <li><a href="project.php"><i class="icon-star-o"></i>My Project</a></li>
                                      <li><a href="saved.php"><i class=" icon-save"></i>Saved project</a></li>
                                      <li><a href="my-donation.php"><i class="icon-money"></i>My Donation</a></li>
                                      <li class="active"><a href="follow.php"><i class="icon-money"></i>Follow</a></li>
                                      <li><a href="create-new-project.php"><i class="icon-gear"></i>Create New</a></li>

                                    </ul>
                                    <div class="cs-profile-area">
                                      <div class="cs-title no-border">
                                        <h3>My donations</h3>
                                      </div>
                              <div class="cs-profile-holder">
                                  <?php 
                          if($result_show_all_follow==null) echo "You do not have any follow";
                          while($line_show_all_follow = mysqli_fetch_array($result_show_all_follow)){
                            $php_jointime_timestamp = strtotime($line_show_all_follow[6]);
                            $jointime = date('F Y', $php_jointime_timestamp);

                            $query_count_backed = "SELECT count(distinct pid) From pledge Where username = '{$line_show_all_follow[0]}'";
                            $result_count_backed = @ mysqli_query($connection, $query_count_backed);
                            $count_backed = mysqli_fetch_array($result_count_backed)[0];

                            $query_count_create = "SELECT count(distinct pid) From project Where username = '{$line_show_all_follow[0]}'";
                            $result_count_create = @ mysqli_query($connection, $query_count_create);
                            $count_create = mysqli_fetch_array($result_count_create)[0];

                            echo "
                              <div class=\"agentinfo-detail col-lg-12\">
                                <div class=\"about-info\">
                                  <figure>
                                    <a href=\"#\"><img alt=\"\" src=\"assets/extra-images/Supporters1.jpg\"></a>
                                  </figure>
                                  <div class=\"agentdetail-info\">
                                    <div class=\"left-info\">
                                      <a style=\"display:none\" href=\"javascript:void(0)\">".$line_show_all_follow[0]."</a>
                                      <h3>".$line_show_all_follow[0]."</h3>
                                      <span class=\"by\">Joined ".$jointime."</span>
                                      <span class=\"location\"><i class=\"cscolor icon-map-marker\"></i>".$line_show_all_follow[5]."</span>
                                    </div>
                                    <div class=\"right-info\">
                                      <div class=\"backed\">
                                        <a href=\"#\">Backed (".$count_backed.")</a>
                                      </div>
                                      <a href=\"#\" class=\"category-list\">Created (".$count_create.")</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            ";
                          }
                        ?>
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
      </div>
  </main>
  
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

<script src="assets/scripts/masonary.js"></script>
<script src="assets/scripts/jquery.sumoselect.min.js"></script> 
<script src="assets/scripts/functions.js"></script>
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
</body>
</html>