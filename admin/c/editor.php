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
    <tr>
        <th class="text-center">menu</th>
        <th></th>
        <th class="text-center">display</th>
        <th></th>
    </tr>
    <?php foreach($menu as $key=> $value){?>
    <tr>
        <td><a href="home.php?page=editor/menu_lv2&menu_id=<?php echo $value["id"];?>"><?php echo $value["name"];?></a></td>
        <td>
            <a href="home.php?page=editor/head_editor&id=<?php echo $value["id"];?>">แก้ไข</a>
        </td>
        <td class="text-center"><?php echo $value["display"]==1? "show": "hide";?></td>
        <td>
            <?php if($value["display"]==0){?><a href="home.php?page=editor/change_display&type=menu&id=<?php echo $value["id"];?>&display=1"><i class="glyphicon glyphicon-eye-open"></i></a><?php }
            else{ ?><a href="home.php?page=editor/change_display&type=menu&id=<?php echo $value["id"];?>&display=0"><i class="glyphicon glyphicon-eye-close"></i></a><?php }?>
        </td>
    </tr>
        <?php /*if(isset($value["submenu"]) && is_array($value["submenu"])) foreach($value["submenu"] as $key2=> $value2){?>
        <tr>
            <td><img src="img/cat_marker.gif"> <a href="home.php?page=editor/page&type=menu_lv2&id=<?php echo $value2["id"];?>"><?php echo $value2["name"];?></a></td>
        </tr>
        <?php }*/?>
    <?php }?>
</table>