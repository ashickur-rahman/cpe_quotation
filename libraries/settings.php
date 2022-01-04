<?php
if(!session_id())
{
    session_start();
}
error_reporting(E_ALL ^ E_DEPRECATED);
$imageLocation="images/complexity_image_sample/";
$filePath=__DIR__."/../public_html/images/quotation_files/";
$db=[
    "host"=>"localhost",
    "db"=>"cpe_quotation",
    "username"=>"root",
    "password"=>"Q!w2e3r4",
    "table_prefix"=>"cpe_"
];