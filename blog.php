<?php
session_start();
include_once("class/Db.class.php");
include_once("class/INI.class.php");
include_once("class/Comment.php");

$commentCTL = new Comment("blog");
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
$item = $db->row("SELECT * FROM blog WHERE id=:id", array("id"=> $_GET["id"]));

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
            <li class="active">Blog - <?php echo $item["title"];?></li>
        </ol>
        <h1><?php echo $item["title"];?></h1>
        <p style="color: #666666;">แก้ไขล่าสุด <small><?php echo date("d-m-Y H:i",strtotime($item["updated_at"]));?></small></p>
        <div style="padding-top: 20px;">
            <?php
            echo $item["content"];
            ?>
        </div>
        <hr>

        <?php if(false){?>
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
                        <a class="del-comment" href="delete_comment.php?type=blog&id=<?php echo $value["id"];?>">delete</a>
                    </div>
                <?php }?>
            </div>
            <hr>
            <?php }?>
        </div>
        <?php }?>
    </div>
</div>
<div class="clearfix"></div>
<?php include_once("layout/footer.php");?>

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