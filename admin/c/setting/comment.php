<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nuiz
 * Date: 3/4/2557
 * Time: 11:19 น.
 * To change this template use File | Settings | File Templates.
 */
$path = __DIR__.'/comment.ini';

require_once("../class/INI.class.php");

$read = INI::read($path);
$read = @$read["comment"];
if(!$read)
    $read = array();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $write['comment'] = array_merge($read, $_POST);
    INI::write($path, $write);
}

$read = INI::read($path);
$read = @$read["comment"];
?>
<ol class="breadcrumb">
    <li><a href="home.php?page=setting">Setting</a></li>
    <li class="active">Page style</li>
</ol>

<form method="post" enctype="multipart/form-data" style="width: 900px; padding-bottom: 20px;">
    <fieldset>
        <legend>Comment</legend>
        <div class="form-group">
            <label class="col-md-4 control-label">display</label>
            <div class="col-md-4">
                <input type="radio" name="display" value="show" <?php if(@$read["display"]=="show") echo "checked";?>> show<br />
                <input type="radio" name="display" value="hide" <?php if(@$read["display"]=="hide") echo "checked";?>> hide
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for=""></label>
            <div class="col-md-4">
                <button id="" name="" type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </fieldset>
</form>