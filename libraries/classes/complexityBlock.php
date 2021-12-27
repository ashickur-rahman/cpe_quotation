<?php
include __DIR__ . "/../classes/dbConnect.php";
include __DIR__ . "/../settings.php";
include __DIR__ . "/compexityPictures.php";

if (!function_exists("complexity_bloc_show"))
{
    function complexity_bloc_show($parentServiceName,$detail,$imageLocation,$db=DB::class)
    {
        $block='';
//        serviceNameShort($parentServiceName),serviceNameShort($parentServiceName),$detail->price,
//        $detail->complexity_name,$showThumbnail,$modalPicture,complexityNameGenerate
//        ($detail->service_complexity_id),$parentServiceName,$showViewMore

            $block.='<div class="col">
            <div class="card card-complexity my-2">
                <div class="card-body">

                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <div class="custom-control custom-radio">
                                <input type="radio"
                                       name="%1$s"
                                       id="complex-%2$s" value="%2$s" class="custom-control-input product complexity-select" data-currency="usd" data-price="%3$s">
                                <label class="custom-control-label" for="complex-%2$s">Complexity %4$s</label>
                            </div>
                        </div>
                        <div class="col-auto text-right">
                            <span class="complexity-amount money" >$<span class="complexity-price">%3$s</span> USD</span>
                        </div>
                    </div>

                    <div class="row mt-2 ">
                        <div class="col thumbnails d-flex justify-content-between">';

                            $complexityPictures=$db::table('complexity_picture')->select("picture_name","show_in")
                                ->where("complexity_id",$detail->service_complexity_id)
                                ->orderBy('show_in')
                                ->get();
                            //var_dump
                            ($complexityPictures);
                            $showThumbnail='';
                            $showViewMore='';
                            $modalPicture=array();
                            foreach ($complexityPictures as $picture)
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
                            $modalPicture=json_encode($modalPicture);



                            $block.='%5$s
                            <div class="thumbnail view-more" data-picture=\'%6$s\'
                                 data-service-complexity="%7$s" data-modal-title="%8$s, Complexity %4$s">
                                <img
                                    src="%9$s">
                                <div class="view-more-background"></div>
                                <div class="view-more-text small">VIEW MORE</div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>';
        return sprintf($block,serviceNameShort($parentServiceName),$detail->service_complexity_id,$detail->price,
            $detail->complexity_name,$showThumbnail,$modalPicture,complexityNameGenerate
            ($detail->service_complexity_id),$parentServiceName,$showViewMore);
    }

}