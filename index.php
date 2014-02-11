<?php
include_once("class/Db.class.php");
$db = new DB();
$blogs = $db->query("SELECT * FROM blog");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome to 198North.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/168travel.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link href="js/bootstrap-select.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Playfair+Display:400italic' rel='stylesheet' type='text/css' />
    <noscript>
        <link rel="stylesheet" type="text/css" href="css/noscript.css" />
    </noscript>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    <div><img src="images/logobanner.png"/> </div>
    <div id="topMenu" class="navbar-collapse">
        <ul class="nav navbar-nav pull-right">
            <li><a href="">Home</a></li>
            <li class="dropdown active">
                <a class="dropdown-toggle" data-toggle="dropdown">Menu2</a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Menu2 - 1</a></li>
                    <li><a href="#">Menu2 - 2</a></li>
                    <li><a href="#">Menu2 - 3</a></li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" data-toggle="dropdown">Menu3</a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Menu3 - 1</a></li>
                    <li><a href="#">Menu4 - 2</a></li>
                    <li><a href="#">Menu5 - 3</a></li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" data-toggle="dropdown">Menu4</a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Menu3 - 1</a></li>
                    <li><a href="#">Menu4 - 2</a></li>
                    <li><a href="#">Menu5 - 3</a></li>
                </ul>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div>
        <div id="ei-slider" class="ei-slider">
            <ul class="ei-slider-large">
                <li>
                    <img src="images/large/01.png" alt="image06"/>
                    <div class="ei-title">
                        <h2>Passionate</h2>
                        <h3>Seeker</h3>
                    </div>
                </li>
                <li>
                    <img src="images/large/02.png" alt="image01" />
                    <div class="ei-title">
                        <h2>Creative</h2>
                        <h3>Duet</h3>
                    </div>
                </li>
                <li>
                    <img src="images/large/03.png" alt="image02" />
                    <div class="ei-title">
                        <h2>Friendly</h2>
                        <h3>Devil</h3>
                    </div>
                </li>
                <li>
                    <img src="images/large/04.png" alt="image03"/>
                    <div class="ei-title">
                        <h2>Tranquilent</h2>
                        <h3>Compatriot</h3>
                    </div>
                </li>
                <li>
                    <img src="images/large/05.png" alt="image04"/>
                    <div class="ei-title">
                        <h2>Insecure</h2>
                        <h3>Hussler</h3>
                    </div>
                </li>
                <li>
                    <img src="images/large/05.png" alt="image04"/>
                    <div class="ei-title">
                        <h2>Insecure</h2>
                        <h3>Hussler</h3>
                    </div>
                </li>
                <li>
                    <img src="images/large/05.png" alt="image04"/>
                    <div class="ei-title">
                        <h2>Insecure</h2>
                        <h3>Hussler</h3>
                    </div>
                </li>

            </ul><!-- ei-slider-large -->
            <ul class="ei-slider-thumbs">
                <li class="ei-slider-element">Current</li>

                <li><a href="#">Slide 6</a><img src="images/thumbs/m01.png" alt="thumb06" /></li>
                <li><a href="#">Slide 1</a><img src="images/thumbs/m02.png" alt="thumb01" /></li>
                <li><a href="#">Slide 2</a><img src="images/thumbs/m03.png" alt="thumb02" /></li>
                <li><a href="#">Slide 3</a><img src="images/thumbs/m04.png" alt="thumb03" /></li>
                <li><a href="#">Slide 4</a><img src="images/thumbs/m05.png" alt="thumb04" /></li>
                <li><a href="#">Slide 3</a><img src="images/thumbs/m04.png" alt="thumb03" /></li>
                <li><a href="#">Slide 4</a><img src="images/thumbs/m05.png" alt="thumb04" /></li>

            </ul><!-- ei-slider-thumbs -->
        </div><!-- ei-slider -->
    </div>
    <div>
        <div id="leftMenu">
        <div class="leftBlock">
            <ul>
                <li><img src="images/MapPin.png" />39 sadssad sads ad asd adsa</li>
                <li><img src="images/TelIcon.png" />087-123-5678</li>
                <li><img src="images/EmailIcon.png" />info@abc.com</li>
                <li><img src="images/WebSiteIcon.png" />www.google.co.th</li>
            </ul>
        </div>
        <div class="leftBlock" style="margin-top: 20px;margin-bottom: 20px;">
            <ul>
                <?php foreach($blogs as $key => $value){?>
                <li><a href="blog.php?id=<?php echo $value["id"];?>"><?php echo $value["title"];?></a></li>
                <?php }?>
            </ul>
        </div>
        </div>
        <div id="mainContent" >
            <div class="rightBlockTop">
                <select class="selectpicker">
                    <option>Mustard</option>
                    <option>Ketchup</option>
                    <option>Relish</option>
                </select
            </div>
            <div class="rightBlock">

                <div class="offer offer-default">
                    <div class="shape">
                        <div class="shape-text">
                            top
                        </div>
                    </div>
                    <div>
                        <img src="images/EmailIcon.png" class="imgoffer">
                    </div>
                    <div class="offer-content">
                        <h3 class="lead">
                            A default offer
                        </h3>
                        <p>
                            And a little description.
                            <br> and so one
                        </p>
                    </div>
                </div>
                <div class="offer offer-success">
                    <div class="shape">
                        <div class="shape-text">
                            top
                        </div>
                    </div>
                    <div>
                        <img src="images/EmailIcon.png" class="imgoffer">
                    </div>
                    <div class="offer-content">
                        <h3 class="lead">
                            A success offer
                        </h3>
                        <p>
                            And a little description.
                            <br> and so one
                        </p>
                    </div>
                </div>

                <div class="offer offer-radius offer-primary">
                    <div class="shape">
                        <div class="shape-text">
                            top
                        </div>
                    </div>
                    <div>
                        <img src="images/EmailIcon.png" class="imgoffer">
                    </div>
                    <div class="offer-content">
                        <h3 class="lead">
                            A primary-radius
                        </h3>
                        <p>
                            And a little description.
                            <br> and so one
                        </p>
                    </div>
                </div>

                <div class="offer offer-info">
                    <div class="shape">
                        <div class="shape-text">
                            top
                        </div>
                    </div>
                    <div>
                        <img src="images/EmailIcon.png" class="imgoffer">
                    </div>
                    <div class="offer-content">
                        <h3 class="lead">
                            An info offer
                        </h3>
                        <p>
                            And a little description.
                            <br> and so one
                        </p>
                    </div>
                </div>

                <div class="offer offer-warning">
                    <div class="shape">
                        <div class="shape-text">
                            top
                        </div>
                    </div>
                    <div>
                        <img src="images/EmailIcon.png" class="imgoffer">
                    </div>
                    <div class="offer-content">
                        <h3 class="lead">
                            A warning offer
                        </h3>
                        <p>
                            And a little description.
                            <br> and so one
                        </p>
                    </div>
                </div>

                <div class="offer offer-radius offer-danger">
                    <div class="shape">
                        <div class="shape-text">
                            top
                        </div>
                    </div>
                    <div>
                        <img src="images/EmailIcon.png" class="imgoffer">
                    </div>
                    <div class="offer-content">
                        <h3 class="lead">
                            A danger-radius
                        </h3>
                        <p>
                            And a little description.
                            <br> and so one
                        </p>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div id="footer">
        <div class="container">
            <p class="muted credit">Made by 168NorthTravel 2014 </p>
        </div>
    </div>

</div>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="js/jquery.eislideshow.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript">
    $(function() {
        $('#ei-slider').eislideshow({
            animation			: 'center',
            autoplay			: true,
            slideshow_interval	: 3000,
            titlesFactor		: 0
        });
        $('.selectpicker').selectpicker();
    });
</script>
</body>
</html>