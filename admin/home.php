<?php
ob_start();
session_start();

/*
 * magic ",' to normal
 */
if (get_magic_quotes_gpc()) {
    function stripslashes_gpc(&$value)
    {
        $value = stripslashes($value);
    }
    array_walk_recursive($_GET, 'stripslashes_gpc');
    array_walk_recursive($_POST, 'stripslashes_gpc');
    array_walk_recursive($_COOKIE, 'stripslashes_gpc');
    array_walk_recursive($_REQUEST, 'stripslashes_gpc');
}


require("../class/Db.class.php");
$page = isset($_GET["page"])? $_GET["page"]: "blog";
$module = explode("/", $page);
$module = $module[0];
?>
<!DOCTYPE html>
<html>
<head>
    <title>admin - 198North.com</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="admin.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Playfair+Display:400italic' rel='stylesheet' type='text/css' />
    <link href='http://fonts.googleapis.com/css?family=Denk+One|Seymour+One|Gilda+Display|Sonsie+One|Quintessential|Coda+Caption:800|Tienne|Elsie|Playfair+Display+SC|Ceviche+One|Sofadi+One|Cinzel|Englebert|Special+Elite|Share+Tech+Mono|Lemon|Audiowide|Iceland|Nova+Square|Hammersmith+One' rel='stylesheet' type='text/css'>
    <link href='../font/font.css' rel='stylesheet' type='text/css'>
    <noscript>
        <link rel="stylesheet" type="text/css" href="../css/noscript.css" />
    </noscript>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>



    <script type="text/javascript" src="../js/jquery.eislideshow.js"></script>
    <script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>

    <script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    <script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js"></script>
    <link type="text/css" rel="stylesheet" href="fancybox/source/jquery.fancybox.css" />
    <link type="text/css" rel="stylesheet" href="tagsintput/jquery.tagsinput.css" />

    <script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
    <script type="text/javascript" src="tagsintput/jquery.tagsinput.min.js"></script>

    <link rel="stylesheet" type="text/css" href="bootstrap-colorselector.css" />
    <script src="bootstrap-colorselector.js"></script>
</head>
<body style="background-color: #f1f1f1;">

<div class="container">
    <div class="row">
        <div class="col-sm-2">
            <nav class="nav-sidebar">
                <ul class="nav">
                    <li><a href="../">Home Website</a></li>
                    <li <?php if($module=="blog") echo 'class="active"';?>><a href="home.php?page=blog">Blog</a></li>
                    <li <?php if($module=="promotion") echo 'class="active"';?>><a href="home.php?page=promotion">Promotion</a></li>
                    <li <?php if($module=="gallery") echo 'class="active"';?>><a href="home.php?page=gallery">Gallery</a></li>
                    <li <?php if($module=="editor") echo 'class="active"';?>><a href="home.php?page=editor">Editor</a></li>
                    <li <?php if($module=="setting") echo 'class="active"';?>><a href="home.php?page=setting">Setting</a></li>
                    <li class="nav-divider"></li>
                    <li><a href="s/AdminLogOut.php"><i class="glyphicon glyphicon-off"></i> Sign Out</a></li>
                </ul>
            </nav>
        </div>
        <div class="col-sm-10">
            <?php
            include("c/".$page.".php");
            ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {

    });
</script>
</body>
</html>