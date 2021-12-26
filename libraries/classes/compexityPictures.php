<?php
include __DIR__ . "/../settings.php";
if(!class_exists("DB"))
{
    include __DIR__ . "/../classes/dbConnect.php";

}
if(!function_exists("complexityNameGenerate"))
{
    function complexityNameGenerate($complexityId, $db=DB::class)
    {
        $complexityDetails=$db::table('service_all')->select("service_name","complexity_name")
            ->where("service_complexity_id",$complexityId)
            ->get();
        return strtolower(str_replace(" ","_",$complexityDetails[0]->service_name))."-complexity_"
            .$complexityDetails[0]->complexity_name;
    }
}
if(!function_exists("serviceNameShort"))
{
    function serviceNameShort($name)
    {

        return strtolower(str_replace(" ","_",$name));
    }
}
