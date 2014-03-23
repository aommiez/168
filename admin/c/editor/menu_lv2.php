<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nuiz
 * Date: 23/3/2557
 * Time: 8:19 น.
 * To change this template use File | Settings | File Templates.
 */

$db = new DB();
$item = $db->row("select * from menu WHERE id={$_GET['menu_id']}");
$menu_lv2 = $db->query("select * from menu_lv2 WHERE menu_id={$_GET['menu_id']}");
?>
<ol class="breadcrumb">
    <li><a href="home.php?page=editor">Editor</a></li>
    <li class="active"><?php echo $item["name"];?></li>
</ol>
<table class="table">
    <tr>
        <th class="text-center">menu</th>
        <th class="text-center">display</th>
        <th></th>
    </tr>
    <?php foreach($menu_lv2 as $key=> $value){?>
        <tr>
            <td><a href="home.php?page=editor/page&type=menu_lv2&id=<?php echo $value["id"];?>"><?php echo $value["name"];?></a></td>
            <td class="text-center"><?php echo $value["display"]==1? "show": "hide";?></td>
            <td>
                <?php if($value["display"]==0){?><a href="home.php?page=editor/change_display&type=menu_lv2&id=<?php echo $value["id"];?>&display=1"><i class="glyphicon glyphicon-eye-open"></i></a><?php }
                else{ ?><a href="home.php?page=editor/change_display&type=menu_lv2&id=<?php echo $value["id"];?>&display=0"><i class="glyphicon glyphicon-eye-close"></i></a><?php }?>
            </td>
        </tr>
    <?php }?>
</table>