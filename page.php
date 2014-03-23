<?php
session_start();
include_once("class/Db.class.php");
include_once("class/INI.class.php");
$db = new DB();

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
    <?php include("layout/meta.php");?>
</head>
<body>
<div class="container">
    <?php include("layout/header.php");?>
    <div>
        <div id="leftMenu">
            <?php include("layout/left.php");?>
        </div>
        <div id="mainContent" style="padding-top: 20px;">
            <?php echo $item["content"];?>
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