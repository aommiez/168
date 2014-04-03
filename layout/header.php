<?php
include_once("class/INI.class.php");
$menu_style = INI::read("admin/c/setting/menu_style.ini");
$menu_style = @$menu_style["menu_style"];

$page_style = INI::read("admin/c/setting/page_style.ini");
$page_style = @$page_style["page_style"];

$gallery = INI::read("admin/gallery.ini");
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
$main_pro = $db->query("select * from promotion where is_main=1 order by updated_at desc limit 3");
?>
<style type="text/css">
    .dropdown-menu {
        background-color: <?php echo @$menu_style["menu_color"];?>;
    }
    .dropdown-menu>li>a {
        color: <?php echo @$menu_style["font_color"];?>;
    }
    .dropdown-menu>li>a:hover {
        background-color: <?php echo @$menu_style["highlight_menu_color"];?>;
        color: <?php echo @$menu_style["highlight_font_color"];?>;
    }
</style>
<?php
if (!empty($_SESSION['login'])) {?>
    <div style="position: fixed; right: 4px; top: 4px;">
        <a href="admin/index.php" class="btn btn-primary">กลับไปยังหน้า admin</a>
    </div>
<?php
}
?>
<div>
    <?php $srcHeader = "images/logobanner.png";
    if(@$page_style["header_picture"]){
        $srcHeader = "picture/".$page_style["header_picture"];
    }?>
    <img src="<?php echo $srcHeader;?>" style="width: 960px;">
</div>
<div id="topMenu" class="navbar-collapse">
    <ul class="nav navbar-nav pull-right">
        <li><a href="index.php">หน้าแรก</a></li>
        <?php foreach($menu as $key=> $value){ if($value['display']==0) continue; ?>
            <li class="dropdown">
                <?php if(isset($value["submenu"]) && is_array($value["submenu"])){?>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $value["name"];?></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php foreach($value["submenu"] as $key2=> $value2){ if($value2['display']==0) continue; ?>
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
    <style type="text/css">
        .ei-slider-thumbs li img {
            display: none;
        }
        .ei-slider-thumbs li:hover img {
            opacity: 0;
            bottom: 50px;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
        }
    </style>
    <div id="ei-slider" class="ei-slider" style="height: 260px;">
        <ul class="ei-slider-large">
            <?php foreach($gallery["img"] as $key=> $value){?>
                <li>
                    <a href="<?php echo $value["title"];?>" target="_blank">
                        <img src="gallery/<?php echo $value["img"];?>" alt="<?php echo $key;?>"/>
                    </a>
                    <div class="ei-title">
                        <!--<h2><?php //echo $value["title"];?></h2>-->
                        <!--<h3><?php// echo $value["description"];?></h3>-->
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
    <div class="" style="width: 960px;">
        <?php foreach($main_pro as $key => $value){
            if(empty($value["picture"])){
                $value["picture"] = "default.jpg";
            }?>
        <div class="offer offer-default pull-left" style="width: 295px; height: 170px; padding: 10px; margin: 10px; position: relative;">
            <div class="shape" style="border-color: rgba(255,255,255,0) <?php echo $value["color"];?> rgba(255,255,255,0) rgba(255,255,255,0); position: absolute; right: 0; top: 0; z-index: 1;">
                <div class="shape-text">

                </div>
            </div>
            <div class="imgoffer-1">
                <a href="promotion.php?id=<?php echo $value["id"];?>"><img src="picture/<?php echo $value["picture"];?>"></a>
            </div>
        </div>
        <?php }?>
        <div class="clearfix"></div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        $('.dropdown-toggle').click(function(e){
            e.preventDefault();
            e.stopPropagation();
        });

    });
</script>

<script type="text/javascript">
    $(function() {
        $('#ei-slider').eislideshow({
            animation			: 'center',
            autoplay			: true,
            slideshow_interval	: 3000,
            titlesFactor		: 0,
            thumbMaxWidth       : 120
        });
        // $('.selectpicker').selectpicker();
        $('.ei-slider-thumbs li a').bind('mousemove',function(e){
            $(this).click();
        });
        $(".imgoffer-1 img").resizecrop({
            width: 150,
            height: 150
        });
    });
</script>