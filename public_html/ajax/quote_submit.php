<?php

include __DIR__."/../../libraries/settings.php";
include __DIR__."/../../libraries/classes/dbConnect.php";

$db=DB::class;

$reqId='';
$senderName=htmlentities($_POST['c_name']);
$senderContact=htmlentities($_POST['c_mobile']);
$senderEmail=htmlentities($_POST['c_email']);
$senderEmail=htmlentities($_POST['c_email']);
$senderIp=$_SERVER['HTTP_CLIENT_IP']
    ?? $_SERVER["HTTP_CF_CONNECTING_IP"] # when behind cloudflare
    ?? $_SERVER['HTTP_X_FORWARDED']
    ?? $_SERVER['HTTP_X_FORWARDED_FOR']
    ?? $_SERVER['HTTP_FORWARDED']
    ?? $_SERVER['HTTP_FORWARDED_FOR']
    ?? $_SERVER['REMOTE_ADDR']
    ?? '0.0.0.0';
$totalImage=htmlentities($_POST['quantity']);
$location=htmlentities($_POST['folder']);
$location=htmlentities($_POST['folder']);
$notes=htmlentities($_POST['notes']);
$deliveryTime=htmlentities($_POST['delivery_time']);


$lastId=$db::table('request_receive')->select("id")
    ->orderBy('id', 'desc');
$lastId=$lastId->first();
if(!$lastId)
{
    $lastId=0;
}
else
{
    $lastId=($lastId->id);
}
$request_no=date("dmY").$lastId++;
$data = array(
    'request_no' => $request_no,
    'sender_name' => $senderName,
    'sender_contact' => $senderContact,
    'sender_email' => $senderEmail,
    'sender_ip' => $senderIp,
    'total_image' => $totalImage,
    'sample_location' => $location,
    'notes' => $notes,
    'delivery_time' => $deliveryTime,
);
do {

    try
    {
        $reqId = $db::table('request_receive')->insert($data);
    } catch (PDOException $exception) {
        if (str_contains($exception->errorInfo[2],"req_no_uindex")){
            $data['request_no']=$data['request_no'].rand("1","9");
        }
        continue;
    }
    break;

} while(1);

 $complexity=$_POST['selected_'];
$requestMetaArray=array();
 foreach ($complexity as $product){
    $tempArray=array("request_id"=>$reqId,
        "service_complexity_price_id"=>$product);
    array_push($requestMetaArray,$tempArray);
    unset($tempArray);

 }
$db::table('request_meta')->insert($requestMetaArray);
 echo $request_no;