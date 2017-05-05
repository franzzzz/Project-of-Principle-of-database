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

  //show all project here
$query_show_all_pro = "SELECT pname, username, maxfund, endtime, moneysum, pid FROM project WHERE status = 'funding'";
$result_show_all_pro = @ mysqli_query($connection, $query_show_all_pro);

  //donations & donated
$query_sum_donation = "SELECT sum(moneysum) FROM Project WHERE username = '{$loginUsername}'";
$result_sum_donation = @ mysqli_query($connection, $query_sum_donation);
$donation = mysqli_fetch_array($result_sum_donation)[0];
if($donation == null) $donation=0;
$query_sum_donated = "SELECT sum(amount) FROM Pledge WHERE username = '{$loginUsername}'";
$result_sum_donated = @ mysqli_query($connection, $query_sum_donated);
$donated = mysqli_fetch_array($result_sum_donated)[0];
if($donated == null) $donated = 0;
  //all project you may like
$query_show_like_pro = "SELECT * FROM project JOIN follow WHERE project.username = follow.followedusername AND fanusername = '{$loginUsername}'";
$result_show_like_pro = @ mysqli_query($connection, $query_show_like_pro);

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
                                      <li class="active"><a href="home.php"><i class="icon-star-o"></i>Home</a></li>
                                      <li><a href="project.php"><i class="icon-star-o"></i>My Project</a></li>
                                      <li><a href="saved.php"><i class=" icon-save"></i>Saved project</a></li>
                                      <li><a href="my-donation.php"><i class="icon-money"></i>My Donation</a></li>
                                      <li><a href="follow.php"><i class="icon-money"></i>Follow</a></li>
                                      <li><a href="create-new-project.php"><i class="icon-gear"></i>Create New</a></li>

                                    </ul>
                                    <div class="cs-profile-area">
                                      <div class="cs-title no-border">
                                        <h3>projects you may concern</h3>
                                      </div>
                                      <div class="cs-profile-holder">
                                        <div class="cs-ads-area">
                                         <?php
                                         while($line_show_like_pro = mysqli_fetch_array($result_show_like_pro)){
                                          $query_count_like = "SELECT count(username) From likes Group by pid having pid = '{$line_show_like_pro[0]}'";
                                          $result_count_like = @ mysqli_query($connection, $query_count_like);
                                          $count_like = mysqli_fetch_array($result_count_like)[0];
                                          if($count_like==null) $count_like=0;

                                          $php_endtime_timestamp = strtotime($line_show_like_pro[7]);
                                          $endtime = date('m/d, Y', $php_endtime_timestamp);
                                          
                                          $funded_percent = floor(100*$line_show_like_pro[9]/$line_show_like_pro[6]);
                                          if($funded_percent == 0 && $line_show_like_pro[9] != 0){
                                            $funded_percent = 1;
                                          } 

                                          $query_count_pldge = "SELECT count(*) From pledge WHERE pid = '{$line_show_like_pro[0]}'";
                                          $result_count_pldge = @ mysqli_query($connection, $query_count_pldge); 
                                          $count_pldge = mysqli_fetch_array($result_count_pldge)[0];                                            
                                          echo "
                                          <article>
                                            <div class=\"post-main\">
                                              <a href=\"#\" class=\"cs-fav-btn\"></a>
                                              <figure>
                                                <a href=\"#\" onclick=\"window.location.href='detail.php?pid_detail=".$line_show_like_pro[0]."'\"><img alt=\"\" src=\"assets/extra-images/img.jpg\"></a>
                                              </figure>
                                              <div class=\"detail-area\">
                                                <div class=\"ads-title\">
                                                  <a href=\"#\" class=\"fav-btn\"><i class=\"icon-star-o\"></i><span>".$count_like."</span></a>
                                                  <a href=\"#\" class=\"del icon-trash-o\"></a>
                                                </div>  
                                                <div class=\"text\">
                                                  <h3><a href=\"#\" onclick=\"window.location.href='detail.php?pid_detail=".$line_show_like_pro[0]."'\">".$line_show_like_pro[2]."</a></h3>
                                                  <span class=\"loc\">".$line_show_like_pro[3]."</span>
                                                  <ul class=\"post-details\">
                                                    <li>".$funded_percent."% Funded</li>
                                                    <li><i class=\"cscolor icon-target5\"></i> $ ".$line_show_like_pro[6]." goal</li>
                                                    <li><i class=\"cscolor icon-clock7\"></i> ".$endtime." </li>
                                                  </ul>
                                                  <span class=\"bar\"><span style=\"width:".$funded_percent."%;\"></span></span>
                                                </div>
                                              </div>
                                            </div>
                                            <div class=\"edit-area\">
                                              <a href=\"#\" class=\"coll\">".$count_pldge." Donations Collected</a>
                                              <div class=\"cs-profile-holder\">
                                                <div class=\"cs-table-holder\">
                                                  <table>
                                                    <thead>
                                                      <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Amount</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                      ";
                                                      $query_show_all_pledge = "SELECT * From pledge WHERE pid = '{$line_show_like_pro[0]}'";
                                                      $result_show_all_pledge = @ mysqli_query($connection, $query_show_all_pledge); 
                                                      $count_show_all_pledge = 0;
                                                      while($line_show_all_pledge = mysqli_fetch_array($result_show_all_pledge)){
                                                        $count_show_all_pledge+=1;
                                                        echo "
                                                        <tr>
                                                          <td>".$count_show_all_pledge."</td>
                                                          <td>".$line_show_all_pledge[3]."</td>
                                                          <td>".$line_show_all_pledge[2]."</td>
                                                          ";
                                                          if($line_show_all_pledge[5] == 0) echo "<td>pending</td>";
                                                          else echo"<td>excuted</td>";
                                                          echo "
                                                          <td>$".$line_show_all_pledge[4]."</td>
                                                        </tr>
                                                        ";
                                                      }
                                                      echo "
                                                    </tbody>
                                                  </table>
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

          <!-- jQuery (necessary JavaScript) --> 
          <script src="assets/scripts/jquery.js"></script> 
          <script src="assets/scripts/bootstrap.min.js"></script> 
          <script src="assets/scripts/modernizr.js"></script>
          <script src="assets/scripts/menu.js"></script>
          <script src="assets/scripts/jquery.flexslider-min.js"></script> 
          <script src="assets/scripts/functions.js"></script>
          <script type="text/javascript">
            jQuery(document).ready(function(){
              jQuery('.edit-area').find('.cs-table-holder').hide();
              jQuery('.edit-area').on('click', '.coll', function(e){
                e.preventDefault();
                var target = jQuery(this).parents('.edit-area').find('.cs-table-holder');
                var active = jQuery(this);
                if(active.hasClass('active')){
                  active.removeClass('active');
                  target.slideUp();
                }else{
                  active.addClass('active');
                  target.slideDown();
                }
              });
            });
          </script>
        </body>
        </html>