<?php
include_once("class/Db.class.php");
include_once("class/INI.class.php");
$gallery = INI::read("admin/gallery.ini");
$db = new DB();
$blogs = $db->query("SELECT * FROM blog");

$page = 0;
$limit = 5;
if(isset($_GET["page"])){
    $page = $_GET["page"];
}
$offset = $page*$limit;

if(empty($_GET['tag'])){
    $pcount = $db->row("SELECT COUNT(*) as c FROM promotion");
    $pcount = $pcount["c"]/$limit;
    $promotions = $db->query("SELECT * FROM promotion order by updated_at desc limit {$offset},{$limit}");
}
else {
    $pcount = $db->row("SELECT COUNT(*) as c FROM promotion WHERE tags LIKE '%".$_GET["tag"]."%'");
    $pcount = $pcount["c"]/$limit;
    $promotions = $db->query("SELECT * FROM promotion WHERE tags LIKE '%".$_GET["tag"]."%' order by updated_at desc limit {$offset},{$limit}");
}
$tags = $db->query("SELECT distinct(name) as name FROM tags");

$menu = $db->query("select * from menu");
$menu_lv2 = $db->query("select * from menu_lv2");
foreach($menu as $key => $value){
    $submenu = array();
    foreach($menu_lv2 as $key2 => $value2){
        if($value["id"]==$value2["menu_id"]){
            $submenu[] = $value2;
        }
        if(count($submenu)>0){
            $menu[$key]["submenu"] = $submenu;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome to 198North.com</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/168travel.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link href="css/bootstrap-select.min.css" rel="stylesheet">
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
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="js/jquery.eislideshow.js"></script>
    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>

    <script type="text/javascript" src="js/jquery.resizecrop-1.0.3.min.js"></script>
</head>
<body style="background-color: #f1f1f1;">
<div class="container">
    <div><img src="images/logobanner.png"/> </div>
    <div id="topMenu" class="navbar-collapse">
        <ul class="nav navbar-nav pull-right">
            <li><a href="index.php">หน้าแรก</a></li>
            <?php foreach($menu as $key=> $value){?>
            <li class="dropdown">
                <?php if(isset($value["submenu"]) && is_array($value["submenu"])){?>
                <a class="dropdown-toggle" data-toggle="dropdown"><?php echo $value["name"];?></a>
                <ul class="dropdown-menu" role="menu">
                    <?php foreach($value["submenu"] as $key2=> $value2){?>
                    <li><a href="page.php?type=menu_lv2&id=<?php echo $value2["id"];?>"><?php echo $value2["name"];?></a></li>
                    <?php }?>
                </ul>
                <?php }else{?>
                <a href="page.php?type=menu&id=<?php echo $value["id"];?>"><?php echo $value["name"];?></a>
                <?php }?>
            </li>
            <?php }?>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div>
        <div id="ei-slider" class="ei-slider">
            <ul class="ei-slider-large">
                <?php foreach($gallery["img"] as $key=> $value){?>
                <li>
                    <img src="gallery/<?php echo $value["img"];?>" alt="<?php echo $key;?>"/>
                    <div class="ei-title">
                        <h2><?php echo $value["title"];?></h2>
                        <h3><?php echo $value["description"];?></h3>
                    </div>
                </li>
                <?php }?>
            </ul><!-- ei-slider-large -->
            <ul class="ei-slider-thumbs">
                <li class="ei-slider-element">Current</li>
                <?php foreach($gallery["img"] as $key=> $value){?>
                <li><a href="#"><?php echo $value["title"];?></a><img src="gallery/<?php echo $value["img"];?>" alt="<?php echo $key;?>" /></li>
                <?php }?>

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
                    <option value="0" <?php if(!isset($_GET["tag"])) echo "selected";?>>all</option>
                    <?php foreach($tags as $key => $value){?>
                    <option value="<?php echo $value["name"];?>" <?php if(@$_GET["tag"]==$value["name"]) echo "selected";?>><?php echo $value["name"];?></option>
                    <?php }?>
                </select
            </div>
            <div class="rightBlock">
                <?php foreach($promotions as $key => $value){
                    if(empty($value["picture"])){
                        $value["picture"] = "default.jpg";
                    }
                    ?>
                <div class="offer offer-default">
                    <div class="shape" style="border-color: rgba(255,255,255,0) <?php echo $value["color"];?> rgba(255,255,255,0) rgba(255,255,255,0);">
                        <div class="shape-text">

                        </div>
                    </div>
                    <div class="imgoffer">
                        <img src="picture/<?php echo $value["picture"];?>">
                    </div>
                    <div class="offer-content">
                        <h3 class="lead">
                            <a href="promotion.php?id=<?php echo $value["id"];?>"><?php echo $value["title"];?></a>
                        </h3>
                        <p>
                            <?php echo $value["description"];?>
                        </p>
                    </div>
                </div>
                <?php }?>

                <ul class="pagination">
                    <?php for($i=0; $i<$pcount; $i++){?>
                    <li <?php if($page==$i) echo "class='active'";?>>
                        <a href="index.php?<?php
                        $bq = array("page"=> $i);
                        if(isset($_GET["tags"])){
                            $bq["tabs"]=$_GET["tags"];
                        }

                        echo http_build_query($bq);?>"

                        ><?php echo $i+1;?></a></li>
                    <?php }?>
                </ul>
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


<script type="text/javascript">
    $(function() {
        $('#ei-slider').eislideshow({
            animation			: 'center',
            autoplay			: true,
            slideshow_interval	: 3000,
            titlesFactor		: 0
        });
        // $('.selectpicker').selectpicker();
    });
</script>
<script type="text/javascript">
$(function(){
    $('.selectpicker').selectpicker();
    $('.selectpicker').change(function(e){
        var val = $(this).val();
        if(val==0){
            window.location.replace("index.php");
            return;
        }
        window.location.replace("index.php?tag="+$(this).val());
    });

    $(".imgoffer img").resizecrop({
        width: 100,
        height: 100
    });
});
</script>
</body>
</html>