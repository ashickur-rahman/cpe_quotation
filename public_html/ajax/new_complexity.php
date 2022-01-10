<?php

include __DIR__."/../../libraries/settings.php";
include __DIR__."/../../libraries/classes/dbConnect.php";
$db=DB::class;

if((!$_POST['service'] || !isset($_POST['service']))||(!$_POST['parent'] || !isset($_POST['parent'])))
{
    echo "error";
    exit();
}
$parent=$_POST['parent'];
$service=$_POST['service'];

$data=array("name"=>$service,
    "parent_service"=>$parent);

$checkDuplicate=$db::table("service")->select("*")->where("name",$service)->where("parent_service",$parent);
$checkDuplicate=$checkDuplicate->first();
if($checkDuplicate)
{
    echo "duplicate";
    exit();
}

if($db::table('service')->insert($data))
{
    echo "success";
}