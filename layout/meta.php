<?php
include_once("class/INI.class.php");
$page_style = INI::read("admin/c/setting/page_style.ini");
$page_style = @$page_style["page_style"];
?>

<title>Welcome to 198North.com</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link href="css/168travel.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css" />
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

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<link href="css/bootstrap-select.min.css" rel="stylesheet">
<script src="js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="js/jquery.eislideshow.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.resizecrop-1.0.3.min.js"></script>
<script src="js/jquery.eventCalendar.js" type="text/javascript"></script>

<!-- Core CSS File. The CSS code needed to make eventCalendar works -->
<link rel="stylesheet" href="css/eventCalendar.css">

<!-- Theme CSS file: it makes eventCalendar nicer -->
<link rel="stylesheet" href="css/eventCalendar_theme_responsive.css">

<style type="text/css">
    ul.nav li.dropdown:hover > ul.dropdown-menu {
        display: block;
    }

    body {
        <?php if(@$page_style["background_type"]=="color"){?>
        background-color: <?php echo @$page_style["background_color"];?>;
        <?php }else if(@$page_style["background_type"]=="picture"){?>
        background-image: url('picture/<?php echo @$page_style["background_picture"];?>');\
        background-position: center;
        <?php }?>
    }
    .container {
        width: 960px;
    }
</style>