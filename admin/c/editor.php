<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nuiz
 * Date: 18/2/2557
 * Time: 10:33 น.
 * To change this template use File | Settings | File Templates.
 */
$db = new DB();
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
<table class="table">
    <?php foreach($menu as $key=> $value){?>
    <tr>
        <td><a href="home.php?page=editor/page&type=menu&id=<?php echo $value["id"];?>"><?php echo $value["name"];?></a></td>
    </tr>
        <?php if(isset($value["submenu"]) && is_array($value["submenu"])) foreach($value["submenu"] as $key2=> $value2){?>
        <tr>
            <td><img src="img/cat_marker.gif"> <a href="home.php?page=editor/page&type=menu_lv2&id=<?php echo $value2["id"];?>"><?php echo $value2["name"];?></a></td>
        </tr>
        <?php }?>
    <?php }?>
</table>