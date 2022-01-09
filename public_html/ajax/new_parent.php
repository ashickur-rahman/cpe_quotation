<?php

include __DIR__."/../../libraries/settings.php";
include __DIR__."/../../libraries/classes/dbConnect.php";
$db=DB::class;

if(!$_POST['parent'] || !isset($_POST['parent']))
{
    echo "error";
    exit();
}
$parent=$_POST['parent'];

$data=array("name"=>$parent);

$checkDuplicate=$db::table("parent_service")->select("*")->where("name",$parent);
$checkDuplicate=$checkDuplicate->first();
if($checkDuplicate)
{
    echo "duplicate";
    exit();
}

if($db::table('parent_service')->insert($data))
{
    echo "success";
}