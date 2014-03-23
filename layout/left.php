<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nuiz
 * Date: 23/3/2557
 * Time: 10:27 น.
 * To change this template use File | Settings | File Templates.
 */

include_once("class/INI.class.php");
$page_style = INI::read("admin/c/setting/page_style.ini");
$page_style = @$page_style["page_style"];
$blogs = $db->query("SELECT * FROM blog");
?>

<style type="text/css">
.leftBlock, .leftBlockCar, .eventCalendar-wrap {
    background-color: <?php echo @$page_style["left_block_color"];?>;
}
</style>
<div class="leftBlock">
    <div style="font-size: 22px;color: #6E6E6E;border-bottom: 1px solid #ddd;">Contact</div>
    <ul>
        <li><img src="images/MapPin.png" />39 sadssad sads ad asd adsa</li>
        <li><img src="images/TelIcon.png" />087-123-5678</li>
        <li style="position: relative; cursor: pointer;">
            <span class="triggerMailBlock"><img src="images/EmailIcon.png" />info@abc.com</span>
            <div class="mailBlock" style="padding: 20px; position: absolute; background: white; top: 100%; left: 0; z-index: 100; border: 1px solid #bdc6ba; display: none;">
                <form class="mailForm">
                    <span class="glyphicon glyphicon-remove-circle close" style="position: absolute; top: -10px; right: -10px; cursor: pointer;"></span>
                    <h3>ติดต่อเรา</h3>
                    <hr>
                    <div class="form-group">
                        <input name="name" type="text" placeholder="ชื่อผู้ส่ง" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <input name="email" type="text" placeholder="email ผู้ส่ง" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <textarea name="message" placeholder="ข้อความ" class="form-control" required="" style="width: 240px; height: 160px;"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </li>
        <li><img src="images/facebook-circle-512.png" /><a href="http://www.facebook.com/168destinationstravelandtours">168destinationstravelandtours</a></li>
    </ul>
</div>
<div class="leftBlock" style="margin-top: 20px;margin-bottom: 20px;">
    <div style="font-size: 22px;color: #6E6E6E;border-color: #999999;border-bottom: 1px solid #ddd;">Blogs</div>
    <ul>
        <?php foreach($blogs as $key => $value){?>
            <li><a href="blog.php?id=<?php echo $value["id"];?>"><?php echo $value["title"];?></a></li>
        <?php }?>
    </ul>
</div>
<div class="leftBlockCar" style="margin-top: 20px;margin-bottom: 20px;">
    <div id="eventCalendarDefault"></div>
</div>
<script type="text/javascript">
    $(function(){
        var form = $('.mailForm');
        var block = $('.mailBlock');
        form.submit(function(e){
            e.preventDefault();
            var data = form.serialize();
            $.post('mailto.php', data, function(data){
                alert(data.message);
            }, 'json');
        });

        $('.triggerMailBlock').hover(function(){
            block.slideDown();
        });

        $('.close', form).click(function(e){
            e.preventDefault();
            block.slideUp();
        });
    });
</script>