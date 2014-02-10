<?php
/**
 * Created by JetBrains PhpStorm.
 * User: P2DC
 * Date: 22/1/2557
 * Time: 12:22 น.
 * To change this template use File | Settings | File Templates.
 */
session_start();

$directory = 'uploads';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(!isset($_FILES["picture"])){
        echo "need file upload";
        echo '<meta http-equiv="refresh" content="2">';
        exit();
    }
    $explo = explode(".", $_FILES["picture"]["name"]);
    $ext = array_pop($explo);
    $allowed = array("jpg", "png", "jpeg", "gif");
    if(!in_array(strtolower($ext), $allowed)){
        echo "support only jpg,png,jpeg,gif";
        echo '<meta http-equiv="refresh" content="2">';
        exit();
    }

    if(!move_uploaded_file($_FILES["picture"]["tmp_name"], $directory."/".time().".".$ext)){
        echo "can't save file ".$directory."/".time().".".$ext;
        echo '<meta http-equiv="refresh" content="2">';
        exit();
    }
    echo '<meta http-equiv="refresh" content="0">';
    exit();
}
else if(isset($_GET["method"]) && $_GET["method"]=="remove"){
    unlink($_GET["file"]);
    echo '<meta http-equiv="refresh" content="0; url=uploads.php" />';
    exit();
}

$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

$uri = "http://".$_SERVER["SERVER_NAME"].substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], "uploads.php"));
$files = array();
$it->beginChildren();
while($it->valid()) {
    if (!$it->isDot() && $it->getSubPath() == "") {
        $pathinfo = pathinfo($it->key());
        if($pathinfo['extension']!="db"){
            $files[] = array("path"=> $uri.$it->key(), "name"=> $it->getSubPathName(), "upload_path"=> $it->key(), "info"=> $pathinfo);
        }
    }
    $it->next();
}
if(count($files)> 1 && $files[0]["name"]==$files[1]["name"]){
    unset($files[0]);
}
$fn = isset($_GET["fn"])? $_GET["fn"]: "";
?>
<!DOCTYPE html>
<html>
<head>
    <title>File Browser</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
</head>
<body>
<div class="wrap">
    <h4>Upload new image</h4>
    <form method="post" enctype="multipart/form-data">
        <div class="input-group pull-left" style="width: 400px;">
            <span class="input-group-btn">
                <span class="btn btn-primary btn-file">
                    Browse… <input type="file" name="picture" class="input-file">
                </span>
            </span>
            <input type="text" class="form-control" readonly="">
        </div>
        <input type="submit" class="pull-left btn btn-primary">
        <div class="clearfix"></div>
    </form>

    <hr />
    <h4>Image on store</h4>
    <div>
        <table class="table">
            <!--
                        <tr>
                            <th>image</th>
                            <th>file name</th>
                            <th>insert</th>
                            <th>delete</th>
                        </tr>
            -->
            <?php foreach($files as $key => $value){?>
                <tr>
                    <td><img src="<?php echo $value["path"];?>" width="100"></td>
                    <!--<td><?php echo $value["name"];?></td>-->
                    <td><a class="insert_file btn btn-info" href="<?php echo $value["path"];?>">insert</a></td>
                    <td><a class="btn btn-danger" href="?method=remove&file=<?php echo urlencode($value["upload_path"]);?>">delete</a></td>
                </tr>
            <?php }?>
        </table>
    </div>
</div>
<style type="text/css">
    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        width: 100%;
        height: 100%;
        font-size: 999px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        background: red;
        cursor: inherit;
        display: block;
    }
    input[readonly] {
        background-color: white !important;
        cursor: text !important;
    }
</style>
<script type="text/javascript">
    var win = window.dialogArguments || opener || parent || top;
    <?php if($fn=="picture"){?>
    $(".insert_file").click(function(e) {
        e.preventDefault();
        var path = $(this).attr("href");
        win.$.file_upload(path);
        win.$.fancybox.close();
    });
    <?php }?>
    <?php if($fn=="text_edit"){?>
    $(".insert_file").click(function(e) {
        e.preventDefault();
        var path = $(this).attr("href");
        win.tinyMCE.execCommand('mceInsertContent',false,'<img src="'+path+'" />');
        win.$.fancybox.close();
    });
    <?php }?>
    $(function(){
        $('.btn-file :file').on('change', function() {
            var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });

        $('.btn-file :file').on('fileselect', function(event, numFiles, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;

            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }
        });
    });
</script>
</body>
</html>