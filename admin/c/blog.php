<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nuiz
 * Date: 10/2/2557
 * Time: 10:04 น.
 * To change this template use File | Settings | File Templates.
 */
$db = new DB();
$blogs = $db->query("SELECT * FROM blog order by updated_at desc");
?>
<div>
    <h4>Blog <a href="home.php?page=blog/add"><i class="glyphicon glyphicon-plus-sign"></i></a></h4>
</div>
<table class="table">
    <tr>
        <th>title</th>
        <th>author</th>
        <th>add date</th>
        <th>update date</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach($blogs as $key => $value){?>
    <tr>
        <td><?php echo $value["title"];?></td>
        <td><?php echo $value["author"];?></td>
        <td><?php echo $value["created_at"];?></td>
        <td><?php echo $value["updated_at"];?></td>
        <td><a href="home.php?page=blog/edit&id=<?php echo $value["id"];?>">edit</a></td>
        <td><a class="delete-btn" href="home.php?page=blog/delete&id=<?php echo $value["id"];?>">delete</a></td>
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