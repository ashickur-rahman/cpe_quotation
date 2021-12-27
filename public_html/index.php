<?php
include __DIR__ . "/../libraries/classes/dbConnect.php";
include __DIR__ . "/../libraries/settings.php";
include __DIR__ . "/../libraries/classes/compexityPictures.php";
include __DIR__ . "/../libraries/classes/complexityBlock.php";

include "child-services.php";

$db=DB::class;
//$allCategory=$pdo->query("select * from cpe_service")->fetchall();
$parentServices=$db::table('parent_service')->select(array("name","id"))->get();

$allData=array();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Quote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        .justify-content-start {
            justify-content: flex-start !important;
        }

        .col {
            flex-basis: 0;
            flex-grow: 1;
            max-width: 100%;
        }
        .card-complexity{
            border: 0;
            border-radius: 8px !important;
            width: 275px;
            height: 137px;
        }
        .thumbnails .thumbnail{
            border-radius: 8px;
            position: relative;
            text-align: center;
            color: #fff;
            box-shadow: 10px 22px 60px rgba(43,27,154,0.06);
        }

        .thumbnails .thumbnail img{
            border-radius:8px;
            width:71px;
            height:71px
        }
        .thumbnails .view-more{
            cursor: pointer;
        }
        .thumbnails .view-more .view-more-background {
            background-color: rgba(103, 182, 244, 0.75);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 8px;
        }
        .thumbnails .view-more .view-more-text {
            font-size: 11px;
            line-height: 130%;
            font-weight: 700;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }


    </style>
</head>

<body class="">
<main role="main" class="col-md-8 ml-sm-auto px-md-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11 col-md-10 py-5 tab-content">

                <div class="row mb-5">
                    <div class="col">
                        <div class="form-inline float-right">
                            <div class="form-group">
                                <label class="my-1 mr-2" for="currencies">Pick a currency</label>
                                <select class="currency-picker custom-select form-control" name="currencies" id="currencies"><option value="USD" selected="selected">USD</option><option value="EUR">EUR</option><option value="GBP">GBP</option><option value="AUD">AUD</option><option value="ANG">ANG</option><option value="CAD">CAD</option><option value="SEK">SEK</option><option value="DKK">DKK</option><option value="NZD">NZD</option><option value="BRL">BRL</option><option value="CHF">CHF</option><option value="ATS">ATS</option><option value="NOK">NOK</option><option value="HKD">HKD</option><option value="ILS">ILS</option><option value="ZAR">ZAR</option><option value="SGD">SGD</option><option value="HUF">HUF</option><option value="CZK">CZK</option><option value="ARS">ARS</option><option value="DOP">DOP</option><option value="AED">AED</option><option value="SIT">SIT</option><option value="MXN">MXN</option><option value="RUB">RUB</option></select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <p>CHOOSE SERVICE</p>
                    <p>
                        What kind of edits do you need today?
                    </p>
                    <p>
                        You can add multiple services for each set of edits. If you have images that require different edits, please request a separate quote for each set.
                    </p>
                    <div class="accordion accordion-flush" id="parentServiceShow">

                        <?php
                        
                            foreach ($parentServices as $pService) {

                                $childServices=$db::table('service')->select("id","name")
                                    ->where("parent_service",$pService->id)
                                    ->get();

                                ?>
                                    <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-heading<?=$pService->id?>">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?=$pService->id?>" aria-expanded="false" aria-controls="flush-collapse<?=$pService->id?>">
                                            <?=$pService->name?>

                                        </button>
                                    </h2>
                                    <div id="flush-collapse<?=$pService->id?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?=$pService->id?>" data-bs-parent="#parentServiceShow">

                                        <?php

                                            if(count($childServices)==1)
                                            {
                                                $childService=$childServices['0'];

                                                $childServiceDetails=$db::table('service_all')->select("*")
                                                    ->where("service_id",$childService->id)
                                                    ->orderBy ("service_complexity_id")
                                                    ->get();
                                                ?>
                                                    <div class="accordion-body" style="background-color:aqua">

                                                        <div class="row justify-content-start d-flex card-complexity-wrapper">
                                                            <?php
                                                                foreach ($childServiceDetails as $detail)
                                                                {
                                                                    $allData["srv-".$childService->id]["cmp-".$detail->service_complexity_id]["h-".$detail->time_price]=$detail->price;

                                                                    if($detail->show_default==1)
                                                                    {
                                                                        echo complexity_bloc_show($pService->name,$detail,$imageLocation);

                                                                    }
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                                <?
                                            }
                                            else
                                            {
                                                $childServiceData= showChildServices($childServices,$pService->id,$imageLocation);
                                                echo $childServiceData['cmplx_block'];
                                                $allData=array_merge($allData,$childServiceData['all_data']);

                                            }
                                        ?>

                                    </div>
                                </div>
                                <?
                            }
                            //var_dump(json_decode(json_encode($allData),true)); ;
                        ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</main>
<div class="modal fade" id="complexityPicModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="complexityPicModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-lg my-3">
<!--                    <div id="carousel" class="carousel slide" data-ride="carousel">-->
<!--                        <ol class="carousel-indicators"></ol>-->
<!--                        <div class="carousel-inner"></div>-->
<!--                        <a class="carousel-control-prev" href="#demo" data-slide="prev">-->
<!--                            <span class="carousel-control-prev-icon"></span>-->
<!--                        </a>-->
<!--                        <a class="carousel-control-next" href="#demo" data-slide="next">-->
<!--                            <span class="carousel-control-next-icon"></span>-->
<!--                        </a>-->
<!--                    </div>-->
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" >
                        <div id="bbb" class="carousel-indicators">

                        </div>
                        <div class="carousel-inner" id="aaa" >

                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="icon-arrow-with-circle-left nav-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="icon-arrow-with-circle-right nav-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
<script>

$(document).ready(function (){
    $('.complexity-select').prop('checked', false);
})
$(".complexity-select").on("change",function (){
    price=$(this).parent().parent().parent().find(".complexity-price").html();
    console.log(price)

})


</script>
</body>
</html>