<?php
session_start();
include_once("class/Db.class.php");
include_once("class/INI.class.php");
include_once("class/Comment.php");

$commentCTL = new Comment("promotion");
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $rs = $commentCTL->insertComment($_GET["id"], $_POST["name"], $_POST["message"]);
    if($rs){
        //header("refresh:2; url=../index.php");
        header("refresh:0;");
    }
    else {
        header("refresh:0;");
    }
    exit();
}
$comments = $commentCTL->getComments($_GET["id"]);

$gallery = INI::read("admin/gallery.ini");
$db = new DB();
$blogs = $db->query("SELECT * FROM blog");
$item = $db->row("SELECT * FROM promotion WHERE id=:id", array("id"=> $_GET["id"]));

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
        <div id="mainContent" style="padding-top: 20px;" >
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active">promotion - <?php echo $item["title"];?></li>
            </ol>
            <h1><?php echo $item["title"];?></h1>
            <p style="color: #666666;">แก้ไขล่าสุด <small><?php echo date("d-m-Y H:i",strtotime($item["updated_at"]));?></small></p>
            <div style="padding-top: 20px;">
                <?php
                echo $item["content"];
                ?>
            </div>

            <hr>
            <div class="comments-block">
                <?php foreach($comments as $key=> $value){?>
                    <div class="comment-item">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">
                                <strong><?php echo $value["name"];?></strong>
                            </label>
                            <div class="col-sm-10">
                                <?php echo nl2br($value["message"]);?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <?php if(!empty($_SESSION["login"])){?>
                        <div class="text-right">
                            <a class="del-comment" href="delete_comment.php?type=promotion&id=<?php echo $value["id"];?>">delete</a>
                        </div>
                        <?php }?>
                    </div>
                    <hr>
                <?php }?>
                <div class="comment-form" role="form">
                    <h3>แสดงความคิดเห็น</h3>
                    <form method="post" style="margin-top: 20px;">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="inputEmail3" placeholder="Name">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Message</label>
                            <div class="col-sm-10">
                                <textarea name="message" class="form-control"></textarea>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
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

        $('.del-comment').click(function(e){
            e.preventDefault();
            if(!window.confirm("are you shure?")){
                return;
            }
            var el = $(this).closest(".comment-item");
            var href = $(this).attr("href");
            $.get(href, function(data){
                el.fadeOut(function(){
                    el.remove();
                });
            }, "json");
        });
    });
</script>
</body>
</html>