<?php
/**
 * Created by JetBrains PhpStorm.
 * User: P2DC
 * Date: 22/2/2557
 * Time: 11:37 น.
 * To change this template use File | Settings | File Templates.
 */

class Comment {
    protected $type = "blog";
    protected $table = "blog_comment";

    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
        $this->setTable($type."_comment");
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    public function __construct($type){
        $this->setType($type);
    }

    public function getComments($objId){
        $db = new DB();
        $list = $db->query("select * from ".$this->getTable()." where obj_id=:obj_id", array("obj_id"=> $objId));
        return $list;
    }

    public function insertComment($objId, $name, $message){
        $db = new DB();
        $rs = $db->query("insert into ".$this->getTable()."(name, message, obj_id) VALUES(:name, :message, :obj_id)", array(
            "name"=> $name,
            "obj_id"=> $objId,
            "message"=> $message
        ));
        return $rs;
    }

    public function deleteComment($id){
        $db = new DB();
        $rs = $db->query("delete from ".$this->getTable()." where id=:id", array(
            "id"=> $id
        ));
        return $rs;
    }
}