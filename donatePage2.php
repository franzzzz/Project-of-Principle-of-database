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

$donate_amount  = $_POST["donate_amount"];
$_SESSION["donate_amount"] = $donate_amount;

$local_pname=$_SESSION["pname"];

//get loginUsers' credit cards
$query_cardnumber = "SELECT cardnumber FROM creditcard WHERE username = '{$loginUsername}'";
if(!$result_cardnumber = @ mysqli_query($connection, $query_cardnumber))
    showerror();


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
                                                <li role="presentation"><a aria-controls="home" >01. Donate</a></li>
                                                <li class="active" role="presentation"><a data-toggle="tab" role="tab" aria-controls="profile">02. Payment</a></li>
                                                <li role="presentation"><a aria-controls="messages">03. Confirmation</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div id="home" class="tab-pane active fade in" role="tabpanel">
                                                    <div class="donate-holder">



                                                        <div id="profile" class="tab-pane fade in" role="tabpanel">
                                                            <div class="pyment-area">
                                                                <div class="donate-holder">

                                                                    <form method="post" action="donatePage3.php">

                                                                        <div class="amount-area">
                                                                            <div class="left-side">
                                                                                <p>
                                                                                    <span>$</span>
                                                                                    Total Amount
                                                                                </p>
                                                                            </div>
                                                                            <div class="right-side">
                                                                                <input type="text" value= "<?php echo "$".$donate_amount; ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="select-payments">
                                                                            <ul class="cs-gateway-wrap">


                                                                                <li>
                                                                                    <!--
                                                                                     <div class="radio-image-wrapper">-->
                                                                                    <!--                                                                                    <input type="radio" id="cs_paypal_gateway" value="cs_paypal_gateway" name="cs_payment_gateway" checked="checked" class="cs-gateway-calculation">-->
                                                                                    <!--                                                                                    <label for="cs_paypal_gateway">-->
                                                                                    <!--																				<span><img alt="#" src="assets/extra-images/pyment1.png">-->
                                                                                    <!--																				</span>-->
                                                                                    <!--                                                                                    </label>-->
                                                                                    <!--                                                                                </div>-->
                                                                                    <!--                                                                                <div class="radio-image-wrapper"><input type="radio" id="cs_authorizedotnet_gateway" value="cs_authorizedotnet_gateway" name="cs_payment_gateway" class="cs-gateway-calculation"><label for="cs_authorizedotnet_gateway"><span><img alt="#" src="assets/extra-images/pyment2.png">-->
                                                                                    <!--																				</span> </label>-->
                                                                                    <!--                                                                                </div>-->
                                                                                    <!--                                                                                <div class="radio-image-wrapper"><input type="radio" id="cs_pre_bank_transfer" value="cs_pre_bank_transfer" name="cs_payment_gateway" class="cs-gateway-calculation"><label for="cs_pre_bank_transfer"><span><img alt="#" src="assets/extra-images/pyment3.png">-->
                                                                                    <!--																				</span> </label></div>-->
                                                                                    <!--                                                                                <div class="radio-image-wrapper"><input type="radio" id="cs_skrill_gateway" value="cs_skrill_gateway" name="cs_payment_gateway" class="cs-gateway-calculation"><label for="cs_skrill_gateway"><span><img alt="#" src="assets/extra-images/pyment4.png">-->
                                                                                    <!--																				</span> </label>-->
                                                                                    <!--                                                                                </div>-->

                                                                                <li class="col-lg-6 col-md-6 col-sm-6">
                                                                                    <label>Please choose one creditcard:</label>
                                                                                    <!-- <input type="text" placeholder="" name="signupGender"> -->
                                                                                    <select placeholder = "" name = "donate_creditcard">

                                                                                        <?php

                                                                                        while ($line_cardnumber = mysqli_fetch_array($result_cardnumber, MYSQLI_NUM) ){
                                                                                            $cardnumber = $line_cardnumber[0];

                                                                                            echo "
                                                                                                    <option value= $cardnumber >".$cardnumber."</option>
                                                                                                                             
                                                                                                ";

                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </li>


                                                                                <?php

                                                                                $line_cardnumber = mysqli_fetch_array($result_cardnumber, MYSQLI_NUM);

                                                                                while ($line_cardnumber = mysqli_fetch_array($result_cardnumber, MYSQLI_NUM) ){


                                                                                    echo "    
                                                                                            <article class=\"col-md-12\">
                                                                                            <span class=\"number\">".$counter_pledger."</span>
                                                                                            <figure>
                                                                                                <a href=\"#\"><img alt=\"#\" src=\"assets/extra-images/pic.png\"></a> 
                                                                                            </figure>
                                                                                            <div class=\"text\">
                                                                                                <h4><a href=\"#\">".$pledge_username."</a></h4>
                                                                                            </div>
                                                                                            <div class=\"time-sec\">
                                                                                                <time datetime=\"2013-02-14\">".$pledge_time."</time>
                                                                                            </div>
                                                                                            <span class=\"amount\">"."$".$pledge_amount."</span>
                                                                                            </article>                                          
                                                                                        ";

                                                                                }
                                                                                ?>





                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                        <div class="cs-holder">
                                                                            <div class="infotext">
                                                                                <p>Please choose one of your credit card for this payment </p>
                                                                            </div>
                                                                        </div>

                                                                        <div class="cs-holder">
                                                                            <input type="submit" value="Go to Payments">
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
                $.post("donate.php", ui.value);
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