<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nuiz
 * Date: 10/2/2557
 * Time: 10:04 น.
 * To change this template use File | Settings | File Templates.
 */
$db = new DB();
$items = $db->query("SELECT * FROM promotion order by updated_at desc");
?>
<div>
    <h4>Promotion <a href="home.php?page=promotion/add"><i class="glyphicon glyphicon-plus-sign"></i></a></h4>
</div>
<table class="table">
    <tr>
        <th></th>
        <th>color</th>
        <th>title</th>
        <th>tags</th>
        <th>type</th>
        <th>update date</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach($items as $key => $value){?>
        <tr>
            <td><img src="../picture/<?php echo empty($value["picture"])? "default.jpg": $value["picture"];?>" style="max-height: 100px; max-width: 100px;"></td>
            <td><div style="width: 20px; height: 20px; background-color: <?php echo $value["color"];?>"></div></td>
            <td><?php echo $value["title"];?></td>
            <td><?php echo $value["tags"];?></td>
            <td><?php echo $value["is_main"]==1? "main": "normal";?></td>
            <td><?php echo $value["updated_at"];?></td>
            <td><a href="home.php?page=promotion/edit&id=<?php echo $value["id"];?>">edit</a></td>
            <td><a class="delete-btn" href="home.php?page=promotion/delete&id=<?php echo $value["id"];?>">delete</a></td>
        </tr>
    <?php }?>
</table>
<script type="text/javascript">
    $(function(){
        $(".delete-btn").click(function(e){
            if(!window.confirm("Are you shure?")){
                return false;
            }
        });
    });
</script>