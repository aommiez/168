<?php
include_once("class/Db.class.php");
include_once("class/INI.class.php");
$gallery = INI::read("admin/gallery.ini");
$db = new DB();
$blogs = $db->query("SELECT * FROM blog");
if(empty($_GET['tag'])){
    $promotions = $db->query("SELECT * FROM promotion");
}
else {
    $promotions = $db->query("SELECT * FROM promotion WHERE tags LIKE '%".$_GET["tag"]."%'");
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



$type = "menu";
if(isset($_GET["type"]))
    $type = $_GET["type"];

if($type=="menu"){
    $item = $db->row("select * from menu WHERE id=:id", array("id"=> $_GET["id"]));
}
else {
    $item = $db->row("select * from menu_lv2 WHERE id=:id", array("id"=> $_GET["id"]));
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

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="js/jquery.eislideshow.js"></script>
    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>

    <script type="text/javascript" src="js/jquery.resizecrop-1.0.3.min.js"></script>
    <script src="js/jquery.eventCalendar.js" type="text/javascript"></script>

    <!-- Core CSS File. The CSS code needed to make eventCalendar works -->
    <link rel="stylesheet" href="css/eventCalendar.css">

    <!-- Theme CSS file: it makes eventCalendar nicer -->
    <link rel="stylesheet" href="css/eventCalendar_theme_responsive.css">
</head>
<body>
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
                        <a href="<?php echo $value["title"];?>" target="_blank">
                            <img src="gallery/<?php echo $value["img"];?>" alt="<?php echo $key;?>"/>
                        </a>

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
                <div style="font-size: 22px;color: #6E6E6E;border-bottom: 1px solid #ddd;">Contact</div>
                <ul>
                    <li><img src="images/MapPin.png" />39 sadssad sads ad asd adsa</li>
                    <li><img src="images/TelIcon.png" />087-123-5678</li>
                    <li><img src="images/EmailIcon.png" />info@abc.com</li>
                </ul>
            </div>
            <div class="leftBlock" style="margin-top: 20px;margin-bottom: 20px;">
                <div style="font-size: 22px;color: #6E6E6E;border-color: #999999;border-bottom: 1px solid #ddd;">Blogs</div>
                <ul>
                    <?php foreach($blogs as $key => $value){?>
                        <li><a href="blog.php?id=<?php echo $value["id"];?>"><?php echo $value["title"];?></a></li>
                    <?php }?>
                </ul>
            </div>
            <div class="leftBlockCar" style="margin-top: 20px;margin-bottom: 20px;">
                <div id="eventCalendarDefault"></div>
            </div>
        </div>
        <div id="mainContent" style="padding-top: 20px;">
            <?php echo $item["content"];?>
        </div>
    </div>
    <div class="clearfix"></div>
    <div id="footer">
        <div class="container">
            <p class="muted credit">Made by 168NorthTravel 2014 </p>
        </div>
    </div>
    <div style="position: fixed;right: 0px;bottom: 0px;height: 558px;width: 300px;z-index: 999;background-color: #ffffff" id="fbBox">
        <a href="#closeFB" id="closeFB"style="float: right"><img src="http://icons.iconarchive.com/icons/rafiqul-hassan/blogger/512/Close-icon.png" style="width: 32px;height: 32px;"> &nbsp;</a>
        <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2F198NorthTravel&amp;width&amp;height=558&amp;colorscheme=light&amp;show_faces=false&amp;header=false&amp;stream=true&amp;show_border=false&amp;appId=1438704643024175" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:558px;" allowTransparency="true"></iframe>
    </div>
    <div style="position: fixed;right: 10px;top: 0px;" id="fbIcon">
        <a href="#openFB" id="openFB"> <img src="http://giolombardi.com/images/stories/Facebook-Icon.png" style="height: 48px;width: 48px;"></a>
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
        $("#eventCalendarDefault").eventCalendar({
            eventsjson: 'json/events.json.php' // link to events json
        });
        $("#fbBox").hide();
        $("#openFB").click(function(){
            $("#fbBox").slideDown();
            $("#openFB").hide();
        });
        $("#closeFB").click(function(){
            $("#fbBox").slideUp();
            $("#openFB").show();
        });
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