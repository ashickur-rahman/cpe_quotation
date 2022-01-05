<?php

include __DIR__ . "/../libraries/classes/dbConnect.php";
include __DIR__ . "/../libraries/settings.php";

$db=DB::class;



exit();
echo dirname($_SERVER['HTTP_HOST']) . '/images/quotation_files/';
//echo $_SERVER['HTTP_HOST']."/images/quotation_files/";
echo "<pre>";
print_r($_SERVER);
exit();
function array_key_exists_r($needle, $haystack)
{
    $result = array_key_exists($needle, $haystack);
    if ($result) return $result;
    foreach ($haystack as $v) {
        if (is_array($v)) {
            $result = array_key_exists_r($needle, $v);
        }
        if ($result) return $result;
    }
    return $result;
}
?>


<script>
    function picShow(value,index)
    {
        //    $imageLocation.complexityNameGenerate($detail->service_complexity_id)."-".$picture->picture_name.'_after.png"
        var imaeLocation="<?php echo $imageLocation ?>";
        var afterPic=imaeLocation;
    }

    $(document).on('click','.view-more',function(){
        var allPics=$(this).data('picture');
        var serviceComplexity=$(this).data('service-complexity');
        var imaeLocation="<?php echo $imageLocation ?>";
        var allPictures='';
        var j=0;
        for (let pictureName of allPics)
        {

            afterPic=imaeLocation+serviceComplexity+"-"+pictureName+"_after.png"
            BeforePic=imaeLocation+serviceComplexity+"-"+pictureName+"_before.png"


            afterBefore='<div class="carousel-item"> <figure class="figure mx-3"> <img src="'+afterPic+'" class="figure-img img-fluid rounded shadow" alt="Original image" width="366" height="366"> <figcaption class="figure-caption small mt-3">BEFORE</figcaption> </figure> <figure class="figure mx-3"> <img src="'+BeforePic+'" class="figure-img img-fluid rounded shadow" alt="Edited image" width="366" height="366"> <figcaption class="figure-caption small mt-3">AFTER</figcaption> </figure> </div>';
            images='<div class="carousel-item" <img src="'+afterPic+'" class="figure-img img-fluid rounded shadow" alt="Original image" width="366" height="366"> ></div>';
            $(afterBefore).appendTo("#aaa");
            $('<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="'+j+'" aria-label="Slide 2"></button>').appendTo('#bbb')
            j++;

        }
        serviceComplexityA=name.split('_');
        var ComplexityId=serviceComplexityA[serviceComplexityA.length - 1];
        $("#complexityPicModalTitle").html($(this).data("modal-title"))

        $('.carousel-inner').first().addClass('active');
        $('.carousel-indicators > li').first().addClass('active');
        $('#carouselExampleIndicators').carousel();
        $("#complexityPicModal").modal('toggle');

    });
</script>

<!--<div class="col">-->
<!--    <div class="card card-complexity my-2">-->
<!--        <div class="card-body">-->
<!---->
<!--            <div class="row justify-content-between">-->
<!--                <div class="col-auto">-->
<!--                    <div class="custom-control custom-radio">-->
<!--                        <input type="radio"-->
<!--                               name="--><?//=serviceNameShort($pService->name)?><!--"-->
<!--                               id="complex---><?//=$detail->service_complexity_id?><!--" value="--><?//=$detail->service_complexity_id?><!--" class="custom-control-input product complexity-select" data-price="--><?//=$detail->price?><!--">-->
<!--                        <label class="custom-control-label" for="complex---><?//=$detail->service_complexity_id?><!--">Complexity --><?//=$detail->complexity_name?><!--</label>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-auto text-right">-->
<!--                                                                                        <span-->
<!--                                                                                                class="complexity-amount money" >$<span class="complexity-price">--><?//=$detail->price?><!--</span> USD</span>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="row mt-2 ">-->
<!--                <div class="col thumbnails d-flex justify-content-between">-->
<!--                    --><?php
//                    $complexityPictures=$db::table('complexity_picture')->select("picture_name","show_in")
//                        ->where("complexity_id",$detail->service_complexity_id)
//                        ->orderBy('show_in')
//                        ->get();
//
//                    $showThumbnail='';
//                    $showViewMore='';
//                    $modalPicture=array();
//
//
//                    foreach
//                    ($complexityPictures as
//                     $picture)
//                    {
//                        if($picture->show_in=="b")
//                        {
//                            $showThumbnail.='<div class="thumbnail"><img src="'.$imageLocation.complexityNameGenerate($detail->service_complexity_id)."-".$picture->picture_name.'_after.png"></div>';
//                        }
//                        else if
//                        ($picture->show_in=="v")
//                        {
//                            $showViewMore=$imageLocation.complexityNameGenerate($detail->service_id).'-'.$picture->picture_name.'_after.png';
//                        }
//
//                        array_push($modalPicture,
//                            $picture->picture_name);
//
//                    }
//                    echo $showThumbnail;
//
//                    $modalPicture=json_encode($modalPicture);
//
//                    ?>
<!---->
<!---->
<!--                    <div class="thumbnail-->
<!--                                                                                        view-more" data-picture='--><?//=$modalPicture?><!--'-->
<!--                         data-service-complexity="--><?//=complexityNameGenerate($detail->service_complexity_id)?><!--" data-modal-title="--><?//=$pService->name?><!--, Complexity --><?//=$detail->complexity_name?><!--">-->
<!--                        <img-->
<!--                                src="--><?//=$showViewMore?><!--">-->
<!--                        <div class="view-more-background"></div>-->
<!--                        <div class="view-more-text small">VIEW MORE</div>-->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->