<?php
include __DIR__ . "/../libraries/classes/dbConnect.php";
include __DIR__ . "/../libraries/settings.php";
include __DIR__ . "/../libraries/classes/compexityPictures.php";
if (!function_exists("complexity_bloc_show"))
{
    function complexity_bloc_show($parentServiceName,$detail,$db=DB::class)
    {
        ?>
            <div class="col">
            <div class="card card-complexity my-2">
                <div class="card-body">

                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <div class="custom-control custom-radio">
                                <input type="radio"
                                       name="<?=serviceNameShort($parentServiceName)?>"
                                       id="complex-<?=$detail->service_complexity_id?>" value="<?=$detail->service_complexity_id?>" class="custom-control-input product complexity-select" data-price="<?=$detail->price?>">
                                <label class="custom-control-label" for="complex-<?=$detail->service_complexity_id?>">Complexity <?=$detail->complexity_name?></label>
                            </div>
                        </div>
                        <div class="col-auto text-right">
                            <span class="complexity-amount money" >$<span class="complexity-price"><?=$detail->price?></span> USD</span>
                        </div>
                    </div>

                    <div class="row mt-2 ">
                        <div class="col thumbnails d-flex justify-content-between">
                            <?php
                            $complexityPictures=$db::table('complexity_picture')->select("picture_name","show_in")
                                ->where("complexity_id",$detail->service_complexity_id)
                                ->orderBy('show_in')
                                ->get();
                            //var_dump
                            ($complexityPictures);
                            $showThumbnail='';
                            $showViewMore='';
                            $modalPicture=array();


                            foreach
                            ($complexityPictures as
                             $picture)
                            {
                                if($picture->show_in=="b")
                                {
                                    $showThumbnail.='<div class="thumbnail"><img src="'.$imageLocation.complexityNameGenerate($detail->service_complexity_id)."-".$picture->picture_name.'_after.png"></div>';
                                }
                                else if
                                ($picture->show_in=="v")
                                {
                                    $showViewMore=$imageLocation.complexityNameGenerate($detail->service_id).'-'.$picture->picture_name.'_after.png';
                                }

                                array_push($modalPicture,
                                    $picture->picture_name);

                            }
                            echo $showThumbnail;

                            $modalPicture=json_encode($modalPicture);

                            ?>


                            <div class="thumbnail view-more" data-picture='<?=$modalPicture?>'
                                 data-service-complexity="<?=complexityNameGenerate($detail->service_complexity_id)?>" data-modal-title="<?=$parentServiceName?>, Complexity <?=$detail->complexity_name?>">
                                <img
                                    src="<?=$showViewMore?>">
                                <div class="view-more-background"></div>
                                <div class="view-more-text small">VIEW MORE</div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php
    }

}