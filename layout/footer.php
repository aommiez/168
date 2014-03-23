<?php
include_once("class/INI.class.php");
$read = INI::read("admin/c/setting/footer.ini");
?>
<div id="footer">
    <div class="container">
        <?php
        echo @$read["footer"]["footer_text"];
        ?>
    </div>
</div>