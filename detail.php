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


    $_SESSION["pid_detail"] = $_GET["pid_detail"];

    //$local_pid_detail = $_SESSION["pid_detail"];

    $local_pid_detail = $_SESSION["pid_detail"];

    //for getting pledgers
    $query_show_pledge_detail = "SELECT username, amount, pledgetime FROM Pledge WHERE pid = '{$local_pid_detail}'";
    if(!$result_show__pledge_detail = @ mysqli_query($connection, $query_show_pledge_detail))
        showerror();

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

    $local_funded_percent = floor(100*$local_moneysum/$local_maxfund);
    if($local_funded_percent == 0 && $local_moneysum != 0){
        $local_funded_percent = 1;
    }

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
                                    <li><a href="detail.html">Detail Page</a></li>
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
                                    <li><a href="donate.html">Donate</a></li>
                                    <li><a href="user-detail2.html">user detail2</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">News</a>
                                <ul class="sub-dropdown">
                                    <li><a href="bloglrag.html">News Listing</a></li>
                                    <li><a href="blogmedium.html">News Medium</a></li>
                                    <li><a href="blogdetail.html">News Detail</a></li>
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
                                        <li><a href="project.php"><i class="icon-flag5"></i>My project</a></li>
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
                </div>
            </div>
            <div class="mob-nav"></div>
        </div>
    </header>
    <!-- Header -->
    <!-- Main Content -->
    <main id="main-content">
        <div class="main-section">
            <section class="page-section contribute-sec" style="background:#f8f8f8;">
                <div class="container">
                    <div class="row">
                        <div class="section-fullwidth col-lg-12">
                            <div class="cs-content-holder">
                                <div class="row">
                                    <div class="post-detail">
                                        <div class="main-heading col-lg-12">
                                            <h1><?php echo $local_pname ?></h1>
                                        </div>
                                        <div class="project-detail">
                                            <div class="col-lg-9">
                                                <figure><img src="assets/extra-images/detail-img.jpg" alt=""></figure>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6">
                                                <div class="price-area">
                                                    <span class="price-raised"><span><?php echo'$'.$local_moneysum; ?></span> raised</span>
                                                    <span class="price-goal"><?php '$'.$local_maxfund.' goal' ?></span>
                                                </div>
                                                <span class="bar"><span style="width:<?php echo $local_funded_percent; ?>%;"></span></span>
                                                <span class="fund"><?php echo $local_funded_percent ?>% Funded</span>
                                                <a href="#" class="cs-btn"><span>Contribute now</span></a>
                                                <div class="detail-list">
                                                    <ul>
                                                        <li><i class="icon-clock7 cscolor"></i><a href="#"><?php echo $local_endtime; ?></a></li>
                                                        <li><i class="icon-map-marker cscolor"></i><a href="#">Brooklyn, NY, United States</a></li>
                                                        <li><i class="icon-list7 cscolor"></i><a href="#">Music art</a></li>
                                                    </ul>
                                                    <div class="user-info">
                                                        <figure><img alt="" src="assets/extra-images/img-testi.png" draggable="false"></figure>
                                                        <span class="cs-author">
															<span>Created By</span>
															<?php echo $local_username ?>
														</span>
                                                    </div>
                                                </div>
                                                <ul class="share-opts">
<!--                                                    <li>-->
<!--                                                        <i class="icon-share2"></i>-->
<!--                                                        <a href="#">Share</a>-->
<!--                                                    </li>-->
                                                    <li>
                                                        <i class="icon-star"></i>

                                                        <a href="addLike.php">like</a>

                                                    </li>
<!--                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="page-section tab-sec">
                <div class="container">
                    <div class="row">
                        <div class="section-fullwidth col-lg-12">
                            <div class="cs-content-holder">
                                <div class="row">
                                    <div class="page-content col-lg-9">
                                        <div class="post-sec">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="detail-tabs">

                                                        <!-- Nav tabs -->
                                                        <ul class="nav nav-tabs" role="tablist">
                                                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                                                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Contributions</a></li>
<!--                                                            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">FAQs</a></li>-->
                                                            <li role="presentation"><a href="#comments" aria-controls="messages" role="tab" data-toggle="tab">comments</a></li>
<!--                                                            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Testimonials</a></li>-->
                                                            <li role="presentation"><a href="#time-line" aria-controls="settings" role="tab" data-toggle="tab">Time Line</a></li>
                                                        </ul>

                                                        <!-- Tab panes -->
                                                        <div class="tab-content">
                                                            <div role="tabpanel" class="tab-pane active" id="home">
                                                                <div class="post-block summary-sec rich_editor_text">
                                                                    <h2>Project Description</h2>

                                                                    <span>created time:     <?php echo "$local_posttime"; ?></span>
                                                                    <span>minimum funding amount:       $<?php echo "$local_minfund"; ?></span>
                                                                    <span>maximum funding amount:       $<?php echo "$local_maxfund"; ?></span>
                                                                    <span>end time for crowdfunding:        <?php echo "$local_endtime"; ?></span>
                                                                    <span>aim to finish before:         <?php echo "$local_completiontime"; ?></span>

                                                                    <p><?php echo "$local_description"?></p>

                                                                    <figure>
                                                                        <img src="assets/extra-images/tab1.jpg" alt="#">
                                                                    </figure>

                                                                    <p><?php echo "$local_description"?></p>
                                                                    <p>Some effusive some misspelled groundhog rose temperate beproject well pending much and considering hello far tremendous the imprecise grew less much jeepers breathless and hey far more much belligerent hawk the placed warthog angrily outside goodness poutingly more gerbil much komodo far barring dependently but one hey reluctant salamander.</p>
                                                                    <!--<div class="tags">
                                                                        <i class="icon-tag7 cs-bgcolor"></i>
                                                                        <ul>
                                                                            <li><a href="#">Art</a></li>
                                                                            <li><a href="#">Craft</a></li>
                                                                            <li><a href="#">Photos</a></li>
                                                                            <li><a href="#">Colors</a></li>
                                                                            <li><a href="#">People</a></li>
                                                                            <li><a href="#">Thanks</a></li>
                                                                        </ul>
                                                                    </div>-->
                                                                </div>
                                                            </div>
                                                            <div role="tabpanel" class="tab-pane" id="profile">
                                                                <div class="post-block contribution-sec">
                                                                    <h2>Contributions</h2>
                                                                    <div class="contributor-list">

                                                                        <?php
                                                                        $counter_pledger = 1;

                                                                        while ($line_show__pledge_detail = mysqli_fetch_array($result_show__pledge_detail, MYSQLI_NUM)){

                                                                            $php_pledgetime_timestamp = strtotime($line_show__pledge_detail[2]);
                                                                            $pledge_time = date('Y-m-d h:i:sa', $php_pledgetime_timestamp);

                                                                            $pledge_username = $line_show__pledge_detail[0];
                                                                            $pledge_amount = $line_show__pledge_detail[1];

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
                                                                            $counter_pledger++;
                                                                        }
                                                                        $counter_pledger = $counter_pledger + 1;
                                                                        ?>

<!--                                                                        <article class="col-md-12">-->
<!--                                                                            <span class="number">01</span>-->
<!--                                                                            <figure>-->
<!--                                                                                <a href="#"><img alt="#" src="assets/extra-images/pic.png"></a>-->
<!--                                                                            </figure>-->
<!--                                                                            <div class="text">-->
<!--                                                                                <h4><a href="#">James Warsom</a></h4>-->
<!--                                                                                <span>Newyork</span>-->
<!--                                                                            </div>-->
<!--                                                                            <div class="time-sec">-->
<!--                                                                                <time datetime="2013-02-14">September 3, 2015, 08:55pm</time>-->
<!--                                                                            </div>-->
<!--                                                                            <span class="amount">$2,000.00</span>-->
<!--                                                                        </article>-->



                                                                    </div>
                                                                </div>
                                                            </div>
<!--                                                            <div role="tabpanel" class="tab-pane" id="messages">-->
<!--                                                                <div class="post-block freq-sec">-->
<!--                                                                    <h2>Frequently asked questions</h2>-->
<!--                                                                    <div class="qustion-area">-->
<!--                                                                        <p>-->
<!--                                                                            <strong>Have a question?</strong>-->
<!--                                                                            if the info above doesn't help, you can ask the projct creator directly-->
<!--                                                                        </p>-->
<!--                                                                        <a href="#">Ask a question</a>-->
<!--                                                                    </div>-->
<!--                                                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">-->
<!--                                                                        <div class="panel panel-default">-->
<!--                                                                            <div class="panel-heading" role="tab" id="headingOne">-->
<!--                                                                                <h4 class="panel-title">-->
<!--                                                                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">-->
<!--                                                                                        <i class="icon-question-circle"></i>-->
<!--                                                                                        Flirtatious angry magnificently more precise widely gosh-->
<!--                                                                                    </a>-->
<!--                                                                                </h4>-->
<!--                                                                            </div>-->
<!--                                                                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">-->
<!--                                                                                <div class="panel-body">-->
<!--                                                                                    <p>While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more. While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more much stared during ouch darn however unsociably and well beproject stole wonderfully.  While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more. While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more much stared during ouch darn however unsociably and well beproject stole wonderfully. While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more. While far jeepers this much stared during ouch</p>-->
<!--                                                                                </div>-->
<!--                                                                            </div>-->
<!--                                                                        </div>-->
<!--                                                                        <div class="panel panel-default">-->
<!--                                                                            <div class="panel-heading" role="tab" id="headingTwo">-->
<!--                                                                                <h4 class="panel-title">-->
<!--                                                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">-->
<!--                                                                                        <i class="icon-question-circle"></i>-->
<!--                                                                                        One desperate more that some darn far far octopus darn badger passably-->
<!--                                                                                    </a>-->
<!--                                                                                </h4>-->
<!--                                                                            </div>-->
<!--                                                                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">-->
<!--                                                                                <div class="panel-body">-->
<!--                                                                                    <p>While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more. While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more much stared during ouch darn however unsociably and well beproject stole wonderfully.  While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more. While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more much stared during ouch darn however unsociably and well beproject stole wonderfully. While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more. While far jeepers this much stared during ouch</p>-->
<!--                                                                                </div>-->
<!--                                                                            </div>-->
<!--                                                                        </div>-->
<!--                                                                        <div class="panel panel-default">-->
<!--                                                                            <div class="panel-heading" role="tab" id="headingThree">-->
<!--                                                                                <h4 class="panel-title">-->
<!--                                                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">-->
<!--                                                                                        <i class="icon-question-circle"></i>-->
<!--                                                                                        Busted spun wedded inside seagull nonsensically took and folded debonairly ungraceful-->
<!--                                                                                    </a>-->
<!--                                                                                </h4>-->
<!--                                                                            </div>-->
<!--                                                                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">-->
<!--                                                                                <div class="panel-body">-->
<!--                                                                                    <p>While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more. While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more much stared during ouch darn however unsociably and well beproject stole wonderfully.  While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more. While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more much stared during ouch darn however unsociably and well beproject stole wonderfully. While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more. While far jeepers this much stared during ouch</p>-->
<!--                                                                                </div>-->
<!--                                                                            </div>-->
<!--                                                                        </div>-->
<!--                                                                        <div class="panel panel-default">-->
<!--                                                                            <div class="panel-heading" role="tab" id="heading4">-->
<!--                                                                                <h4 class="panel-title">-->
<!--                                                                                    <a aria-controls="collapse4" aria-expanded="false" href="#collapse4" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">-->
<!--                                                                                        <i class="icon-question-circle"></i>-->
<!--                                                                                        Hellishly some behind moody a pernicious ardently imaginatively scurrilously beauteous hey below-->
<!--                                                                                    </a>-->
<!--                                                                                </h4>-->
<!--                                                                            </div>-->
<!--                                                                            <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4">-->
<!--                                                                                <div class="panel-body">-->
<!--                                                                                    <p>While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more. While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more much stared during ouch darn however unsociably and well beproject stole wonderfully.  While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more. While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more much stared during ouch darn however unsociably and well beproject stole wonderfully. While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more. While far jeepers this much stared during ouch</p>-->
<!--                                                                                </div>-->
<!--                                                                            </div>-->
<!--                                                                        </div>-->
<!--                                                                        <div class="panel panel-default">-->
<!--                                                                            <div class="panel-heading" role="tab" id="heading5">-->
<!--                                                                                <h4 class="panel-title">-->
<!--                                                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="false" aria-controls="collapse5">-->
<!--                                                                                        <i class="icon-question-circle"></i>-->
<!--                                                                                        Overcast and equal the blithe much between gosh concentrically when shed-->
<!--                                                                                    </a>-->
<!--                                                                                </h4>-->
<!--                                                                            </div>-->
<!--                                                                            <div id="collapse5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading5">-->
<!--                                                                                <div class="panel-body">-->
<!--                                                                                    <p>While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more. While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more much stared during ouch darn however unsociably and well beproject stole wonderfully.  While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more. While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more much stared during ouch darn however unsociably and well beproject stole wonderfully. While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more. While far jeepers this much stared during ouch</p>-->
<!--                                                                                </div>-->
<!--                                                                            </div>-->
<!--                                                                        </div>-->
<!--                                                                        <div class="panel panel-default">-->
<!--                                                                            <div class="panel-heading" role="tab" id="heading6">-->
<!--                                                                                <h4 class="panel-title">-->
<!--                                                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse6" aria-expanded="false" aria-controls="collapse6">-->
<!--                                                                                        <i class="icon-question-circle"></i>-->
<!--                                                                                        Fumed much a heron quit far following this gasped hardy ocelot-->
<!--                                                                                    </a>-->
<!--                                                                                </h4>-->
<!--                                                                            </div>-->
<!--                                                                            <div id="collapse6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading6">-->
<!--                                                                                <div class="panel-body">-->
<!--                                                                                    <p>While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more. While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more much stared during ouch darn however unsociably and well beproject stole wonderfully.  While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more. While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more much stared during ouch darn however unsociably and well beproject stole wonderfully. While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more. While far jeepers this much stared during ouch</p>-->
<!--                                                                                </div>-->
<!--                                                                            </div>-->
<!--                                                                        </div>-->
<!--                                                                        <div class="panel panel-default">-->
<!--                                                                            <div class="panel-heading" role="tab" id="heading7">-->
<!--                                                                                <h4 class="panel-title">-->
<!--                                                                                    <a aria-controls="collapse7" aria-expanded="false" href="#collapse7" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">-->
<!--                                                                                        <i class="icon-question-circle"></i>-->
<!--                                                                                        Frog some much goat affably far some jeepers above dreamed saluted-->
<!--                                                                                    </a>-->
<!--                                                                                </h4>-->
<!--                                                                            </div>-->
<!--                                                                            <div id="collapse7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading7">-->
<!--                                                                                <div class="panel-body">-->
<!--                                                                                    <p>While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more. While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more much stared during ouch darn however unsociably and well beproject stole wonderfully.  While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more. While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more much stared during ouch darn however unsociably and well beproject stole wonderfully. While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more. While far jeepers this much stared during ouch</p>-->
<!--                                                                                </div>-->
<!--                                                                            </div>-->
<!--                                                                        </div>-->
<!--                                                                        <div class="panel panel-default">-->
<!--                                                                            <div class="panel-heading" role="tab" id="heading8">-->
<!--                                                                                <h4 class="panel-title">-->
<!--                                                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse8" aria-expanded="false" aria-controls="collapse8">-->
<!--                                                                                        <i class="icon-question-circle"></i>-->
<!--                                                                                        Disbanded more more hello impassive that flexed less where-->
<!--                                                                                    </a>-->
<!--                                                                                </h4>-->
<!--                                                                            </div>-->
<!--                                                                            <div id="collapse8" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading8">-->
<!--                                                                                <div class="panel-body">-->
<!--                                                                                    <p>While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more. While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more much stared during ouch darn however unsociably and well beproject stole wonderfully.  While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more. While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more much stared during ouch darn however unsociably and well beproject stole wonderfully. While far jeepers this much stared during ouch darn however unsociably and well beproject stole wonderfully goodness reciprocatingly much more. While far jeepers this much stared during ouch</p>-->
<!--                                                                                </div>-->
<!--                                                                            </div>-->
<!--                                                                        </div>-->
<!--                                                                    </div>-->
<!--                                                                </div>-->
<!--                                                            </div>-->
                                                            <div role="tabpanel" class="tab-pane" id="comments">
                                                                <div id="comment">
                                                                    <div class="cs-section-title"><h2>324 Comments</h2></div>
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

                                                                        <!-- #comment-## -->
<!--                                                                        <li id="li-comment-52">-->
<!--                                                                            <div id="comment-52" class="thumblist">-->
<!--                                                                                <ul>-->
<!--                                                                                    <li>-->
<!--                                                                                        <figure> <a href="#"><img src="assets/extra-images/img-coment1.png" alt="#"></a> </figure>-->
<!--                                                                                        <div class="text-box">-->
<!--                                                                                            <a class="comment-reply" href="#"><i class="icon-play"></i>Reply</a>-->
<!--                                                                                            <h4>James Warson</h4>-->
<!--                                                                                            <time datetime="2011-01-12">September 23, 2014, 08:59PM</time>-->
<!--                                                                                            <p>Laughed wow lighted or harmful one beyond more ostrich lost impetuously robin fallaciously hello dolphin a flimsily nightingale quail underneath dear much cut essentially oppressively up and thus meretricious immense bet due egret conclusive that excepting with much through dear well kept.</p>-->
<!--                                                                                        </div>-->
<!--                                                                                    </li>-->
<!--                                                                                </ul>-->
<!--                                                                            </div>-->
<!--                                                                        </li>-->
                                                                        <!-- #comment-## -->
                                                                    </ul>
                                                                </div>


                                                                <div class="comment-respond" id="respond">
                                                                    <h2>Leave us a comment(no more then 140 characters)</h2>
                                                                    <form class="comment-form contact-form" id="commentform" method="POST" action = "newcomment.php">
<!--                                                                        <p class="comment-form-author">-->
<!--                                                                            <label>-->
<!--                                                                                <i class="icon-user2"></i>-->
<!--                                                                                <input type="text" value="Enter Your Name" onblur="if(this.value == '') { this.value = 'Enter Your Name'; }" onfocus="if(this.value == 'Enter Your Name') { this.value = ''; }">-->
<!--                                                                            </label>-->
<!--                                                                        </p>-->
<!--                                                                        <p class="comment-form-email">-->
<!--                                                                            <label>-->
<!--                                                                                <i class="icon-envelope-o"></i>-->
<!--                                                                                <input type="text" value="Email Address" onblur="if(this.value == '') { this.value = 'Email Address'; }" onfocus="if(this.value == 'Email Address') { this.value = ''; }" class="cs-classic">-->
<!--                                                                            </label>-->
<!--                                                                        </p>-->
<!--                                                                        <p class="comment-form-website">-->
<!--                                                                            <label>-->
<!--                                                                                <i class="icon-globe4"></i>-->
<!--                                                                                <input type="text" value="Website" onblur="if(this.value == '') { this.value = 'Website'; }" onfocus="if(this.value == 'Website') { this.value = ''; }">-->
<!--                                                                            </label>-->
                                                                        <div class="right-side">
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
                                                                                                <li><a href="project.php"><i class="icon-flag5"></i>My project</a></li>
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
<!--
</p>-->
                                                                        <p class="comment-form-comment fullwidt">
                                                                            <label>
                                                                                <i class="icon-comments-o"></i>
                                                                                <textarea name = "comment" placeholder="Enter Message"></textarea>
                                                                            </label>
                                                                        </p>
                                                                        <p class="form-submit">
                                                                            <input type="submit" value="Submit Message" name="submit" class="form-style csbg-color">
                                                                        </p>
                                                                    </form>
                                                                </div>

                                                            </div>
<!--                                                            <div role="tabpanel" class="tab-pane" id="settings">-->
<!--                                                                <div class="post-block testimonial-sec">-->
<!--                                                                    <h2>Testimonails</h2>-->
<!--                                                                    <div class="testimonial left italic-style" id="cs-testimonial-595">-->
<!--                                                                        <ul class="slides">-->
<!--                                                                            <li class="col-md-12">-->
<!--                                                                                <div class="question-mark">-->
<!--                                                                                    <p>Disagreed rode some hey wherever more avoidable and regardless a barring much but naughtily when limpet far sporadically a since this essential jay dear where avowed much far far laudable suavely that and considering. Surely logically elephant far foolishly clapped hello far derisively hence this cried craven including oh malicious oh listless antelope overlaid grasshopper beauteously.</p>-->
<!--                                                                                    <div class="ts-author">-->
<!--                                                                                        <figure>-->
<!--                                                                                            <img draggable="false" src="assets/extra-images/img-testi.png" alt="">-->
<!--                                                                                        </figure>-->
<!--                                                                                        <span class="cs-author">Rich Warnor<br>-->
<!--																					<span>CEO &amp; Founder</span>-->
<!--																				</span>-->
<!--                                                                                    </div>-->
<!--                                                                                </div>-->
<!--                                                                            </li>-->
<!--                                                                            <li class="col-md-12">-->
<!--                                                                                <div class="question-mark">-->
<!--                                                                                    <p>Over the past four years, the Classy platform has become absolutely essential to Pencils of Promise as we bring life-changing education to children around the world.</p>-->
<!--                                                                                    <div class="ts-author">-->
<!--                                                                                        <figure><img src="assets/extra-images/author-img1.jpg" alt="">-->
<!--                                                                                        </figure>-->
<!--                                                                                        <span class="cs-author">Jeena Nichole<br>-->
<!--																					<span>CEO &amp; Founder Pencils of Promise</span>-->
<!--																				</span>-->
<!--                                                                                    </div>-->
<!--                                                                                </div>-->
<!--                                                                            </li>-->
<!--                                                                            <li class="col-md-12">-->
<!--                                                                                <div class="question-mark">-->
<!--                                                                                    <p>Over the past four years, the Classy platform has become absolutely essential to Pencils of Promise as we bring life-changing education to children around the world.</p>-->
<!--                                                                                    <div class="ts-author">-->
<!--                                                                                        <figure><img src="assets/extra-images/author-img2.jpg" alt="">-->
<!--                                                                                        </figure>-->
<!--                                                                                        <span class="cs-author">Mark Benson<br>-->
<!--																					<span>CEO &amp; Founder Pencils of Promise</span>-->
<!--																				</span>-->
<!--                                                                                    </div>-->
<!--                                                                                </div>-->
<!--                                                                            </li>-->
<!--                                                                        </ul>-->
<!--                                                                    </div>-->
<!--                                                                </div>-->
<!--                                                            </div>-->
                                                            <div role="tabpanel" class="tab-pane" id="time-line">
                                                                <div class="cs-timeline">
                                                                    <div class="timiline-title">
                                                                        <h4>Project Timeline</h4>
                                                                    </div>
                                                                    <ul>
                                                                        <li>
                                                                            <article>
                                                                                <h4>Funding Finish Time</h4>
                                                                                <h4><?php echo "$local_endtime" ?></h4>
                                                                                <div class="text-box">
                                                                                    <div class="info-area">
                                                                                        <p>Thanks to our backers we’re cruising past our goal of 100k and are up to 115! Getting closer to the $150k goal of land ownership (check out the previous update... Read more</p>
                                                                                    </div>
                                                                                </div>
                                                                            </article>
                                                                            <article>
                                                                                <h4>Complete Time</h4>
                                                                                <h4><?php echo "$local_finaltime" ?></h4>
                                                                                <h4>complete status: </h4>
                                                                                <h4><?php echo "$local_status" ?></h4>
                                                                                <div class="text-box">
                                                                                    <div class="info-area">
                                                                                        <p>Thanks to our backers we’re cruising past our goal of 100k and are up to 115! Getting closer to the $150k goal of land ownership (check out the previous update... Read more</p>
                                                                                    </div>
                                                                                </div>
                                                                            </article>
                                                                        </li>
                                                                        <li>
                                                                            <article>
                                                                                <h4>Funding Start Time</h4>
                                                                                <h4><?php echo "$local_posttime" ?></h4>
                                                                                <div class="text-box">
                                                                                    <div class="info-area">
                                                                                        <p>Thanks to our backers we’re cruising past our goal of 100k and are up to 115! Getting closer to the $150k goal of land ownership (check out the previous update... Read more</p>
                                                                                    </div>
                                                                                </div>
                                                                            </article>
<!--                                                                            <article>-->
<!--                                                                                <time datetime="2013-02-14">2013 - present</time>-->
<!--                                                                                <h4>New Freelancer</h4>-->
<!--                                                                                <div class="text-box">-->
<!--                                                                                    <div class="info-area">-->
<!--                                                                                        <p>Thanks to our backers we’re cruising past our goal of 100k and are up to 115! Getting closer to the $150k goal of land ownership (check out the previous update... Read more</p>-->
<!--                                                                                    </div>-->
<!--                                                                                </div>-->
<!--                                                                            </article>-->
<!--                                                                            <article>-->
<!--                                                                                <time datetime="2013-02-14">2013 - present</time>-->
<!--                                                                                <h4>New Freelancer</h4>-->
<!--                                                                                <div class="text-box">-->
<!--                                                                                    <div class="info-area">-->
<!--                                                                                        <p>Thanks to our backers we’re cruising past our goal of 100k and are up to 115! Getting closer to the $150k goal of land ownership (check out the previous update... Read more</p>-->
<!--                                                                                    </div>-->
<!--                                                                                </div>-->
<!--                                                                            </article>-->
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
                                    <aside class="page-sidebar col-lg-3">
                                        <!--<div class="element-size-100 widget_contribution">
                                            <h4>Make Contribution</h4>
                                            <div class="btn-area">
                                                <a href="#" class="cs-btn">$5</a>
                                                <a href="#" class="cs-btn">$5</a>
                                                <a href="#" class="cs-btn">$5</a>
                                                <a href="#" class="cs-btn">$5</a>
                                            </div>
                                            <form class="contribute-form" action="">
                                                <fieldset>
                                                    <label>
                                                        <input type="text" placeholder="Add your Amount">
                                                    </label>
                                                    <input type="submit" value="Contribute Now" class="cs-btn">
                                                </fieldset>
                                            </form>
                                        </div>-->
                                        <div class="widget_phases widget">
                                            <h4>project Phases</h4>
                                            <article class="phase-block col-md-12">
                                                <h5 class="cscolor">Phase 1</h5>
                                                <span class="price">$9,500</span>
                                                <p>While far jeepers this much stared during ouch darn however unsocia- bly and well beproject stole wonder- fully goodness reciprocatingly much more.</p>
                                            </article>
                                            <article class="phase-block col-md-12">
                                                <h5 class="cscolor">Phase 1</h5>
                                                <span class="price">$9,500</span>
                                                <p>While far jeepers this much stared during ouch darn however unsocia- bly and well beproject stole wonder- fully goodness reciprocatingly much more.</p>
                                            </article>
                                            <article class="phase-block col-md-12">
                                                <h5 class="cscolor">Phase 1</h5>
                                                <span class="price">$9,500</span>
                                                <p>While far jeepers this much stared during ouch darn however unsocia- bly and well beproject stole wonder- fully goodness reciprocatingly much more.</p>
                                            </article>
                                        </div>
                                        <div class="widget_doc widget">
                                            <h4>Attached Documents</h4>
                                            <ul>
                                                <li><a href="#">Filename1.doc</a></li>
                                                <li><a href="#">Filename1.doc</a></li>
                                                <li><a href="#">Filename1.doc</a></li>
                                            </ul>
                                            <a href="#" class="cs-btn"><span>Download</span></a>
                                        </div>
                                    </aside>
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

<script src="assets/scripts/functions.js"></script>
<script>
    $('.detail-tabs').tab('show');
    $('.tab-pane').addClass('fade in');
</script>
</body>
</html>