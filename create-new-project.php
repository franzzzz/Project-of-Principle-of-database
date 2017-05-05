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

<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/bootstrap-theme.css" rel="stylesheet">
<link href="assets/css/language-selector-remove-able-css.css" rel="stylesheet">
<link href="assets/css/ui.multiselect.css" rel="stylesheet">
<link href="style.css" rel="stylesheet">
<link href="plugin.css" rel="stylesheet">
<link href="assets/css/responsive.css" rel="stylesheet">
<link href="assets/css/menu.css" rel="stylesheet">
<link href="assets/css/color.css" rel="stylesheet">
<link href="assets/css/iconmoon.css" rel="stylesheet">
<link href="assets/css/themetypo.css" rel="stylesheet">

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
                                      <li><a href="home.php"><i class="icon-star-o"></i>Home</a></li>
                                      <li><a href="project.php"><i class="icon-star-o"></i>My Project</a></li>
                                      <li><a href="saved.php"><i class=" icon-save"></i>Saved project</a></li>
                                      <li><a href="my-donation.php"><i class="icon-money"></i>My Donation</a></li>
                                      <li><a href="follow.php"><i class="icon-money"></i>Follow</a></li>
                                      <li class="active"><a href="create-new-project.php"><i class="icon-gear"></i>Create New</a></li>

                                    </ul>
                                    <div class="cs-profile-area">
                                      <div class="cs-title no-border">
                                        <h3>Create a new project!</h3>
                                      </div>
                                      <div class="cs-profile-holder">
                                        <div class="gallery-area">
                                         <ul class="cs-element-list has-border wout-label">
                                          <li>
                                            <div class="fields-area">
                                             <div class="field-col col-md-12">
                                               <ul class="galleryupload">
                                                <li class="featured-image image-1">
                                                 <div class="upload-file-container">
                                                   <img src="assets/extra-images/gallry1.jpg" alt="#">								
                                                   <a title="Delete image" class="delete" data-id="1" href="javascript:;"><i class="icon-times"></i></a>
                                                 </div>
                                               </li>
                                               <li class="gallery-thumb">
                                                 <div id="Crowdfunding_images_container">
                                                  <ul class="Crowdfunding_images">
                                                   <li class="image-2"><img src="assets/extra-images/gallry2.jpg" alt="#">
                                                    <a title="Delete image" class="delete" data-id="2" href="javascript:;"><i class="icon-times"></i></a>							  															</li>
                                                    <li class="image-2"><img src="assets/extra-images/gallry3.jpg" alt="#">
                                                      <a title="Delete image" class="delete" data-id="2" href="javascript:;"><i class="icon-times"></i></a>							  															</li>
                                                      <li class="image-2"><img src="assets/extra-images/gallry4.jpg" alt="#">
                                                        <a title="Delete image" class="delete" data-id="2" href="javascript:;"><i class="icon-times"></i></a>							  															</li>
                                                        <li class="image-2"><img src="assets/extra-images/gallry5.jpg" alt="#">
                                                          <a title="Delete image" class="delete" data-id="2" href="javascript:;"><i class="icon-times"></i></a>							  															</li>
                                                          <li class="image-2"><img src="assets/extra-images/gallry6.jpg" alt="#">
                                                            <a title="Delete image" class="delete" data-id="2" href="javascript:;"><i class="icon-times"></i></a>							  															</li>
                                                            <li class="image-2"><img src="assets/extra-images/gallry7.jpg" alt="#">
                                                              <a title="Delete image" class="delete" data-id="2" href="javascript:;"><i class="icon-times"></i></a>							  															</li>
                                                              <li class="image-2"><img src="assets/extra-images/gallry8.jpg" alt="#">
                                                                <a title="Delete image" class="delete" data-id="2" href="javascript:;"><i class="icon-times"></i></a>							  															</li>
                                                                <li class="image-2">
                                                                 <figure>
                                                                   <img src="assets/extra-images/gallry9.jpg" alt="#">
                                                                   <figcaption>
                                                                    <input type="file" id="browse" name="fileupload" style="display: none" onChange="Handlechange();"/>
                                                                    <input type="button" value="Upload More" id="fakeBrowse" onclick="HandleBrowseClick();"/>
                                                                  </figcaption>
                                                                </figure>
                                                                <a title="Delete image" class="delete" data-id="2" href="javascript:;"><i class="icon-times"></i></a>							  															</li>
                                                              </ul>
                                                            </div>
                                                          </li>
                                                        </ul>
                                                      </div>
                                                    </div>
                                                  </li>
                                                </ul>
                                              </div>
                                              <ul class="cs-element-list has-border">
                                               <li>
                                                <label>project Title</label>
                                                <div class="fields-area">
                                                 <div class="field-col col-md-12">
                                                  <input type="text">
                                                  <span class="char-remain">Strong orca harshly exuberantly oh bird wherever </span>
                                                </div>
                                              </div>
                                            </li>
                                            <li>
                                              <label>project Description</label>
                                              <div class="fields-area">
                                               <div class="field-col col-md-12">
                                                <textarea></textarea>
                                              </div>
                                            </div>
                                          </li>
                                          <li class="multiselect-holder">
                                            <label>Catergories</label>
                                            <div class="fields-area">
                                             <div class="field-col col-md-6">
                                              <select id="categories" class="multiselect" multiple="multiple" name="countries[]">
                                               <option value="AFG">Afghanistan</option>
                                               <option value="ALB">Albania</option>
                                               <option value="DZA">Algeria</option>
                                               <option value="AND">Andorra</option>
                                               <option value="ARG">Argentina</option>
                                               <option value="ARM">Armenia</option>
                                               <option value="ABW">Aruba</option>
                                               <option value="AUS">Australia</option>
                                               <option value="AUT" selected="selected">Austria</option>

                                               <option value="AZE">Azerbaijan</option>
                                               <option value="BGD">Bangladesh</option>
                                               <option value="BLR">Belarus</option>
                                               <option value="BEL">Belgium</option>
                                               <option value="BIH">Bosnia and Herzegovina</option>
                                               <option value="BRA">Brazil</option>
                                               <option value="BRN">Brunei</option>
                                               <option value="BGR">Bulgaria</option>
                                               <option value="CAN">Canada</option>

                                               <option value="CHN">China</option>
                                               <option value="COL">Colombia</option>
                                               <option value="HRV">Croatia</option>
                                               <option value="CYP">Cyprus</option>
                                               <option value="CZE">Czech Republic</option>
                                               <option value="DNK">Denmark</option>
                                               <option value="EGY">Egypt</option>
                                               <option value="EST">Estonia</option>
                                               <option value="FIN">Finland</option>

                                               <option value="FRA">France</option>
                                               <option value="GEO">Georgia</option>
                                               <option value="DEU" selected="selected">Germany</option>
                                               <option value="GRC">Greece</option>
                                               <option value="HKG">Hong Kong</option>
                                               <option value="HUN">Hungary</option>
                                               <option value="ISL">Iceland</option>
                                               <option value="IND">India</option>
                                               <option value="IDN">Indonesia</option>

                                               <option value="IRN">Iran</option>
                                               <option value="IRL">Ireland</option>
                                               <option value="ISR">Israel</option>
                                               <option value="ITA">Italy</option>
                                               <option value="JPN">Japan</option>
                                               <option value="JOR">Jordan</option>
                                               <option value="KAZ">Kazakhstan</option>
                                               <option value="KWT">Kuwait</option>
                                               <option value="KGZ">Kyrgyzstan</option>

                                               <option value="LVA">Latvia</option>
                                               <option value="LBN">Lebanon</option>
                                               <option value="LIE">Liechtenstein</option>
                                               <option value="LTU">Lithuania</option>
                                               <option value="LUX">Luxembourg</option>
                                               <option value="MAC">Macau</option>
                                               <option value="MKD">Macedonia</option>
                                               <option value="MYS">Malaysia</option>
                                               <option value="MLT">Malta</option>

                                               <option value="MEX">Mexico</option>
                                               <option value="MDA">Moldova</option>
                                               <option value="MNG">Mongolia</option>
                                               <option value="NLD" selected="selected">Netherlands</option>
                                               <option value="NZL">New Zealand</option>
                                               <option value="NGA">Nigeria</option>
                                               <option value="NOR">Norway</option>
                                               <option value="PER">Peru</option>
                                               <option value="PHL">Philippines</option>

                                               <option value="POL">Poland</option>
                                               <option value="PRT">Portugal</option>
                                               <option value="QAT">Qatar</option>
                                               <option value="ROU">Romania</option>
                                               <option value="RUS">Russia</option>
                                               <option value="SMR">San Marino</option>
                                               <option value="SAU">Saudi Arabia</option>
                                               <option value="CSG">Serbia and Montenegro</option>
                                               <option value="SGP">Singapore</option>

                                               <option value="SVK">Slovakia</option>
                                               <option value="SVN">Slovenia</option>
                                               <option value="ZAF">South Africa</option>
                                               <option value="KOR">South Korea</option>
                                               <option value="ESP">Spain</option>
                                               <option value="LKA">Sri Lanka</option>
                                               <option value="SWE">Sweden</option>
                                               <option value="CHE">Switzerland</option>
                                               <option value="SYR">Syria</option>

                                               <option value="TWN">Taiwan</option>
                                               <option value="TJK">Tajikistan</option>
                                               <option value="THA">Thailand</option>
                                               <option value="TUR">Turkey</option>
                                               <option value="TKM">Turkmenistan</option>
                                               <option value="UKR">Ukraine</option>
                                               <option value="ARE">United Arab Emirates</option>
                                               <option value="GBR">United Kingdom</option>
                                               <option value="USA" selected="selected">United States</option>

                                               <option value="UZB">Uzbekistan</option>
                                               <option value="VAT">Vatican City</option>
                                               <option value="VNM">Vietnam</option>
                                             </select>	
                                           </div>
                                         </div>
                                       </li>
                                     </ul>
                                     <ul class="cs-element-list has-border">
                                       <li>
                                        <label>Prospective amount</label>
                                        <div class="fields-area">
                                         <div class="field-col col-md-6">
                                          <input type="text">
                                        </div>
                                        <div class="field-col col-md-2">
                                          <div class="select-holder">
                                           <select>
                                            <option>$</option>
                                            <option>¥</option>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                  </li>
                                  <li>
                                    <label>Deadline</label>
                                    <div class="fields-area">
                                     <div class="field-col col-md-2">
                                      <input type="text" placeholder="D D">
                                    </div>
                                    <div class="field-col col-md-2">
                                      <input type="text" placeholder="M M">
                                    </div>
                                    <div class="field-col col-md-3">
                                      <input type="text" placeholder="Y Y Y Y">
                                    </div>
                                  </div>
                                </li>
                                <li>
                                 <label>Add Tags</label>
                                 <div class="fields-area">
                                  <div class="field-col col-md-6">
                                    <span class="icon-input">
                                     <a href="#" id="csload_list"><i class="icon-plus3"></i></a>
                                     <input id="csappend" placeholder="Type text and Press Enter" type="text" class="text-input">
                                   </span>
                                   <ul class="cs-tags-selection">

                                   </ul>
                                 </div>
                               </div>
                             </li>
                           </ul>
                           <ul class="cs-element-list has-border paypal">
                             <li>
                              <label>Paypal Setting</label>
                              <div class="fields-area">
                               <div class="field-col col-md-6">
                                <input type="email">
                                <span class="char-remain">Strong orca harshly exuberantly oh bird wherever </span>
                              </div>
                            </div>
                          </li>
                        </ul>
                        <ul class="cs-element-list term-condition-area">
                         <li>
                          <label>Terms &amp;<br> Conditions</label>
                          <div class="fields-area">
                           <div class="field-col col-md-12">
                            <p>Asome decently militantly versus that a enormous less treacherous genially well upon until fishy audaciously where fabulously underneath toucan armadillo far toward illustratively flawlessly shark much a emoted hey tersely pointedly much that hey quetzal up trenchant abundant made alas wildebeest overate overhung during busily burst as jeez much beproject more added on some thrust out.</p>
                            <div class="checkbox-area">
                             <input type="checkbox" id="conditions">
                             <label for="conditions">Accept <a href="#">terms and conditions</a></label>
                           </div>
                         </div>
                       </div>
                     </li>
                   </ul>
                   <ul class="cs-element-list cs-submit-form">
                     <li>
                      <div class="fields-area">
                       <div class="field-col col-md-4">
                        <input class="csbg-color cs-btn" type="submit" value="Create new project">
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </form>
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
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/jquery-ui.min.js"></script>
<script src="assets/scripts/bootstrap.min.js"></script> 
<script src="assets/scripts/modernizr.js"></script>
<script src="assets/scripts/jquery.nanoscroller.js"></script>
<script src="assets/scripts/ui.multiselect.js"></script>
<script src="assets/scripts/functions.js"></script>
<script type="text/javascript">
  $(function(){
    $(".multiselect").multiselect();
  });
</script>
<script>
	$(document).ready(function() {
   $('#csload_list').click(function() {
     var append = $('#csappend').val();
     $('ul.cs-tags-selection').append('<li class="alert alert-warning"><a data-dismiss="alert" class="close" href="#">×</a> <span>'+append+'</span></li>');
     return false;
   });
 });
</script>
<script>
	function HandleBrowseClick()
	{
   var fileinput = document.getElementById("browse");
   fileinput.click();
 }
 function Handlechange()
 {
   var fileinput = document.getElementById("browse");
   var textinput = document.getElementById("filename");
   textinput.value = fileinput.value;
 }
</script>
</body>
</html>