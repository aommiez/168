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
$commentSetting = INI::read("admin/c/setting/comment.ini");
$commentSetting = $commentSetting['comment'];

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
    <?php include("layout/meta.php");?>
</head>
<body>
<div class="container">
    <?php include("layout/header.php");?>
    <div>
        <div id="leftMenu">
            <?php include("layout/left.php");?>
        </div>
        <div id="mainContent" style="padding-top: 20px;" >
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active">promotion - <?php echo $item["title"];?></li>
            </ol>
            <h1><?php echo $item["title"];?></h1>
            <p style="color: #666666;">Update on <small><?php echo date("d-m-Y",strtotime($item["updated_at"]));?></small></p>
            <div style="padding-top: 20px;">
                <?php
                echo $item["content"];
                ?>
            </div>

            <?php if($commentSetting['display']=='show'){?>
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
            <?php }?>
        </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php include_once("layout/footer.php");?>
    <!--
    <div style="position: fixed;right: 0px;bottom: 0px;height: 558px;width: 300px;z-index: 999;background-color: #ffffff" id="fbBox">
        <a href="#closeFB" id="closeFB"style="float: right"><img src="http://icons.iconarchive.com/icons/rafiqul-hassan/blogger/512/Close-icon.png" style="width: 32px;height: 32px;"> &nbsp;</a>
        <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2F198NorthTravel&amp;width&amp;height=558&amp;colorscheme=light&amp;show_faces=false&amp;header=false&amp;stream=true&amp;show_border=false&amp;appId=1438704643024175" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:558px;" allowTransparency="true"></iframe>
    </div>
    <div style="position: fixed;right: 10px;top: 0px;" id="fbIcon">
        <a href="#openFB" id="openFB"> <img src="http://giolombardi.com/images/stories/Facebook-Icon.png" style="height: 48px;width: 48px;"></a>
    </div>
    -->
</div>


<script type="text/javascript">
    $(function() {
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