<?php
session_start();
include __DIR__ . "/../libraries/classes/dbConnect.php";
include __DIR__ . "/../libraries/settings.php";
include __DIR__ . "/../libraries/classes/compexityPictures.php";
include __DIR__ . "/../libraries/classes/complexityBlock.php";

include "child-services.php";
$_SESSION['fileuploader_show']='uploadonly';
$_SESSION['file_server']="dropbox";
$db=DB::class;
//$allCategory=$pdo->query("select * from cpe_service")->fetchall();
$parentServices=$db::table('parent_service')->select(array("name","id"))->get();

$allData=array();
$allTime=array();
$defaultTime=0;

try {
    $folderName=time();
    mkdir($filePath.$folderName,0777);
}catch (Exception ){
    $folderName=time()."1";
    mkdir($filePath.$folderName,0777);
}
$_SESSION['target_directory']=$filePath.$folderName;
$_SESSION['folder_name']=$folderName;
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
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="el/css/elfinder.min.css">
    <link rel="stylesheet" type="text/css" href="el/css/theme.css">
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

        .checked{
            background-color: chocolate;
        }

    </style>
</head>

<body class="d-flex flex-column">
    <div id="page-content">
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
                    <div id="main-show" data-next="price-by-time"  data-previous="#" class="row ">
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
                                if(!$childServices)
                                {
                                    continue;
                                }
                                ?>
                                <div class="accordion-item" >
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

                                                <div class="row justify-content-start d-flex
                                                        card-complexity-wrapper service-id"
                                                     data-service-id="srv-<?=$childServiceDetails[0]->service_id?>">
                                                    <?php
                                                    foreach ($childServiceDetails as $detail)
                                                    {

                                                        if (!in_array($detail->time_price, $allTime)) {
                                                            $allTime[] = $detail->time_price;
                                                        }
                                                        $allData["srv-".$childService->id]["cmp-".$detail->service_complexity_id]["h-".$detail->time_price]=$detail->price;
                                                        if($detail->show_default==1)
                                                        {
                                                            $defaultTime=$detail->time_price;
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
                                            if(isset($childServiceData['all_data']))
                                            {
                                                $allData=array_merge($allData,$childServiceData['all_data']);
                                            }


                                        }
                                        $allTime['default_time']=$defaultTime;
                                        ?>

                                    </div>
                                </div>
                                <?
                            }
                            //var_dump(json_decode(json_encode($allData),true)); ;
                            ?>

                        </div>
                    </div>

                    <div class="row " style="display: none" id="price-by-time" data-next="images-block" data-previous="main-show" >
                        <div id="priceselectradio">

                        </div>
                        <div>
                            <textarea id="notes" name="notes" placeholder="Add Extra Notes"></textarea>
                        </div>

                    </div>


                    <div class="row " id="images-block" data-previous="price-by-time" style="display:
                    none" data-next="final-submit">
                        <div class="row">
                            <div class="col-lg-6 col-xl-6">
                                <div class="card">
                                    <div class="card-block">
                                        <!-- Element where elFinder will be created (REQUIRED) -->
                                        <label for="quantity">Number of Images</label>
                                        <input type="number" id="quantity" name="quantity" min="1" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-xl-6">
                                <div class="card">
                                    <div class="card-block">
                                        <!-- Element where elFinder will be created (REQUIRED) -->
                                        <div id="elfinder"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row " id="final-submit" data-next="submit" style="display:
                    none"  data-previous="images-block" >
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Name</label>
                                <input type="customer_name" class="form-control" id="customer-name" placeholder="Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Email</label>
                                <input type="customer_email" class="form-control" id="customer-email"
                                       placeholder="Email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Contact Number</label>
                                <input type="customer_mobile" class="form-control" id="customer-mobile"
                                       placeholder="Contact Number">
                            </div>

                        </div>
                    </div>

                    <div id="buttons">
                        <button type="button" disabled id="previous-button" data-previous="" data-current="main-show"
                                class="btn
                        btn-primary ">Previous</button>
                        <button type="button"  id="next-button" data-next="" data-current="main-show" class="btn
                        btn-primary ">Next</button>

                    </div>

                </div>
            </div>
        </div>
        <footer id="sticky-footer" class="flex-shrink-0 py-4 bg-dark text-white-50">
            <div class="container text-center">
                <small>Price: <span id="total-price-show"></span></small>
            </div>
        </footer>
    </div>

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

    <!-- Section JavaScript -->
    <!-- jQuery and jQuery UI (REQUIRED) -->
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <![endif]-->
    <!--[if gte IE 9]><!-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!--<![endif]-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!-- elFinder JS (REQUIRED) -->
    <script src="el/js/elfinder.min.js"></script>


<script src="https://cdn.tiny.cloud/1/72ntt7nspailiho7v22bp1v16ad10axou6itsni3f3387sn5/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>

    $(document).ready(function() {
        var elFinderInstance = $('#elfinder').elfinder({
            url : 'el/php/connector.minimal.php',
            ui : [],

        }).elfinder('instance');

        $('.complexity-select').prop('checked', false);
    });
    tinymce.init({
        selector: '#notes',
        plugins: 'lists',
        toolbar: false,
        branding: false,
        menubar: false,
        statusbar: false,
        setup: function (editor) {
            editor.ui.registry.addContextToolbar('textselection', {
                predicate: function (node) {
                    return !editor.selection.isCollapsed();
                },
                items: 'bold italic | bullist numlist',
                position: 'selection',
                scope: 'node'
            });
        },
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
    var bb='';
    var allData='<?php echo json_encode($allData) ?>'
    var allTime='<?php echo json_encode($allTime) ?>'
    allData= JSON.parse(allData);
    allTime= JSON.parse(allTime);

    var selectedData= {};
    var totalPrice=parseFloat(0);
    var cmpPriceByHour={}; //complexity all price store as hour
    var defaultPriceHour="h-"+allTime['default_time'];
    var defaultPriceHour2=allTime['default_time'];
    var selectedPrice={};

    function serviceSelected(selectedData,serviceId)
    {
        return selectedData.hasOwnProperty(serviceId)
    }
    function selectedServicePrice (selectedData,serviceId,allData)
    {
        if(serviceSelected(selectedData,serviceId))
        {
            var cmp=selectedData[serviceId];
            return allData[serviceId][cmp][defaultPriceHour];

        }
    }

    $(".complexity-select").on("change",function (){
        serviceId=$(this).parent().closest('.service-id').attr("data-service-id")
        cmpId=$(this).attr("data-complexity-id")
        // price=$(this).parent().parent().parent().find(".complexity-price").html();
        price=$(this).attr("data-price");

        if(selectedServicePrice (selectedData,serviceId,allData))
        {
            totalPrice-=parseFloat(selectedServicePrice (selectedData,serviceId,allData))
        }
        totalPrice+=parseFloat(price)
        selectedData[serviceId]=cmpId;

        cmpPriceByHour[serviceId]=allData[serviceId][cmpId];
        selectedPrice[serviceId]=($(this).val());
        console.log(selectedPrice)
        $("#total-price-show").html(parseFloat(totalPrice).toFixed(2))

    });

    $("#next-button").on("click",function (){

        var currentDiv=$(this).attr("data-current");
        var nextDiv=$("#"+currentDiv).attr("data-next")
        var radio='';
        if(currentDiv=="main-show")
        {
            if(Object.keys(cmpPriceByHour).length==0)
            {
                jQuery("#parentServiceShow button:first").click()
                return
            }
            else
            {
                var t_allTime=allTime;
                delete t_allTime.default_time;

                var aa={};
                for (const [service, complexity] of Object.entries(selectedData)) {
                    var i= (allData[service][complexity])
                    for (const  [timeIndex,time] of Object.entries(t_allTime)){
                        console.log("time: "+time+"  "+i["h-"+time])
                        if(aa.hasOwnProperty(time))
                        {
                            aa[time]=i["h-"+time]+aa[time];
                        }
                        else
                        {
                            aa[time]=i["h-"+time];
                        }

                        //aa[time]=parseFloat(Math.round(aa[time] * 100) / 100).toFixed(2);
                    }

                }
                for (const [time, price] of Object.entries(aa)){
                    var selectedRadio='';
                    if(time==defaultPriceHour2)
                    {
                        selectedRadio="checked";
                    }
                    var rrr=price.toString(10);
                    var rrr2=parseFloat(rrr).toFixed(2)
                    radio+='<div class="form-check"><input '+selectedRadio+' class="form-check-input deliverytime" ' +
                        'value="'+time+'" ' +
                        'type="radio" ' +
                        'name="timetodelivery" ' +
                        'id="timechoose'+time+'">' +
                        '<label ' +
                        'class="form-check-label" for="timechoose'+time+'">'+time+' hours - <span ' +
                        'id="timetodelivery'+time+'">'+parseFloat(rrr2)+'</span> </label></div>';
                }
                $("#priceselectradio").html(radio)

                var $checked = $('input[type=radio][name=timetodelivery]:checked');
                $checked.next('label').addClass('checked');
                jQuery('input[type=radio][name=timetodelivery]').change(function() {
                    var tt=(jQuery(this).val())
                    $("#total-price-show").html($("#timetodelivery"+tt).html())
                    $checked.prop('checked', false).next('label').removeClass('checked');
                    $checked = $(this);
                    $checked.next('label').addClass('checked');
                })
            }
        }
        // var previousDiv=$("#"+currentDiv).attr("data-previous")



        if(nextDiv=="final-submit")
        {
            $("#next-button").html("Submit")
        }
        if(nextDiv=="submit")
        {
            var selectedPricePass=new Array();
            for( [service, cmpPrice] of Object.entries(selectedPrice)){
                selectedPricePass.push(cmpPrice)
            }
            console.log(selectedPricePass)
            $.ajax({

                url : 'ajax/quote_submit.php',
                type : 'POST',
                data : {
                    'selected_' : selectedPricePass,
                    'delivery_time': $(".deliverytime").val(),
                    'notes' : tinymce.get("notes").getContent(),
                    'quantity' : $("#quantity").val(),
                    'folder' : <?php echo $folderName ;?>,
                    'c_name' : $("#customer-name").val(),
                    'c_email' : $("#customer-email").val(),
                    'c_mobile' : $("#customer-mobile").val(),

                },
                success : function(data) {
                    console.log('Data: '+data);
                },
                beforeSend : function (){
                    $("#final-submit").hide();
                    $("#sticky-footer").hide();
                    $("#buttons").hide();
                }
            });

            return;
        }
        $("#previous-button").attr("data-previous",currentDiv)
        $("#previous-button").attr("data-current",nextDiv)
        $("#previous-button").prop('disabled', false);
        $(this).attr("data-current",nextDiv)
        $("#"+currentDiv).hide();
        $("#"+nextDiv).show();
    });
    $("#previous-button").on("click",function (){
        var currentDiv=$(this).attr("data-current");

        var previousDiv=$("#"+currentDiv).attr("data-previous")


        $("#next-button").attr("data-current",previousDiv)
        $(this).attr("data-current",previousDiv)

        if(previousDiv=="main-show")
        {
            $(this).prop('disabled', true);
        }
        $("#"+currentDiv).hide();
        $("#"+previousDiv).show();
    });



</script>
</body>
</html>