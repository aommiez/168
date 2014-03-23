<?php
session_start();
include_once("class/Db.class.php");
include_once("class/INI.class.php");

$promotion_style = INI::read("admin/c/setting/promotion_style.ini");
$promotion_style = @$promotion_style["promotion_style"];

$db = new DB();

$page = 0;
$limit = (@$promotion_style["display_per_page"])? $promotion_style["display_per_page"]: 5;
if(isset($_GET["page"])){
    $page = $_GET["page"];
}
$offset = $page*$limit;

if(empty($_GET['tag'])){
    $pcount = $db->row("SELECT COUNT(*) as c FROM promotion WHERE is_main=0");
    $pcount = $pcount["c"]/$limit;
    $promotions = $db->query("SELECT * FROM promotion WHERE is_main=0 order by updated_at desc limit {$offset},{$limit}");
}
else {
    $pcount = $db->row("SELECT COUNT(*) as c FROM promotion WHERE is_main=0 AND tags LIKE '%".$_GET["tag"]."%'");
    $pcount = $pcount["c"]/$limit;
    $promotions = $db->query("SELECT * FROM promotion WHERE is_main=0 AND tags LIKE '%".$_GET["tag"]."%' order by updated_at desc limit {$offset},{$limit}");
}
$tags = $db->query("SELECT distinct(name) as name FROM tags");

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
                        <a href="promotion.php?id=<?php echo $value["id"];?>" style="color: <?php echo $promotion_style["title_color"];?>"><img src="picture/<?php echo $value["picture"];?>"></a>
                    </div>
                    <div class="offer-content">
                        <h3 class="lead">
                            <a href="promotion.php?id=<?php echo $value["id"];?>" style="color: <?php echo $promotion_style["title_color"];?>"><?php echo $value["title"];?></a>
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