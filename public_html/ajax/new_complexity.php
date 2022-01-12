<?php


include __DIR__."/../../libraries/settings.php";
include __DIR__."/../../libraries/classes/dbConnect.php";
$db=DB::class;




if((!$_POST['service'] || !isset($_POST['service']))||(!$_POST['name'] || !isset($_POST['name'])))
{
    echo "error";
    exit();
}
$name=$_POST['name'];
$service=$_POST['service'];
$h18=$_POST['h18'];
$h36=$_POST['h36'];
$h48=$_POST['h48'];
$h72=$_POST['h72'];

$data=array("name"=>$name,
    "service_id"=>$service);

$checkDuplicate=$db::table("service_complexity")->select("*")->where("name",$name)->where("service_id",$service);
$checkDuplicate=$checkDuplicate->first();
if($checkDuplicate)
{
    echo "duplicate";
    exit();
}

$cmpId='';
$cmpId=$db::table('service_complexity')->insert($data);
if($cmpId)
{
    $prArray=array(
        array("service_complexity_id"=>$cmpId,"time_price"=>18,"price"=>$h18),
        array("service_complexity_id"=>$cmpId,"time_price"=>36,"price"=>$h36),
        array("service_complexity_id"=>$cmpId,"time_price"=>48,"price"=>$h48),
        array("service_complexity_id"=>$cmpId,"time_price"=>72,"price"=>$h72)
    );
    try {
        $db::table('service_complexity_price')->insert($prArray);
    }catch (PDOException $e)
    {
        $db::table('service_complexity')->where('id', $cmpId)->delete();
        echo "error";
        exit();
    }


    $smArray=array();
    $count=1;
    foreach ($_POST['sample_images'] as $sample)
    {
        $view='';
        if($count<3)
        {
            $view="b";
        }
        elseif ($count==3)
        {
            $view="v";
        }

        $count++;
        $tsmArray=array("complexity_id"=>$cmpId,"picture_name"=>$sample,"show_in"=>$view);
        array_push($smArray,$tsmArray);
        unset($tsmArray);
    }
    try {
        $db::table('complexity_picture')->insert($smArray);
    }catch (PDOException $e)
    {
        $db::table('service_complexity_price')->where('service_complexity_id', $cmpId)->delete();
        $db::table('service_complexity')->where('id', $cmpId)->delete();
        echo "error";
        exit();
    }

    echo "success";

}
else
{
    echo "error";
    exit();
}