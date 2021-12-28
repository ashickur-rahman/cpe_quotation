<?php
include __DIR__ . "/../libraries/classes/dbConnect.php";
include __DIR__ . "/../libraries/settings.php";
include __DIR__ . "/../libraries/classes/compexityPictures.php";
include __DIR__ . "/../libraries/classes/complexityBlock.php";


if(!function_exists("showChildServices"))
{
    function showChildServices (Array $childServices,$parentServiceId,$imageLocation,$db=DB::class)
    {

        $return= '<div class="accordion accordion-flush" id="childServiceShow'.$parentServiceId.'">';
        foreach ($childServices as $childService)
        {
            //var_dump($childService);
            //$allData["srv-".$childService->id]["cmp-".$detail->service_complexity_id]=array();

            $return.='<div class="accordion-item">
    <h2 class="accordion-header" id="child-flush-heading'.$childService->id.'">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#child-flush-collapse'.$childService->id.'" aria-expanded="false" aria-controls="child-flush-collapse'.$childService->id.'">
        '.$childService->name.'
      </button>
    </h2>
    <div id="child-flush-collapse'.$childService->id.'" class="accordion-collapse collapse" aria-labelledby="child-flush-heading'.$childService->id.'" data-bs-parent="#childServiceShow'.$parentServiceId.'">
      <div class="accordion-body" style="background-color:aqua">
      <div class="row justify-content-start d-flex card-complexity-wrapper service-id"
                                                             data-service-id="srv-'
                                                             .$childService->id.'">';
//complexity code
            $childServiceDetails=$db::table('service_all')->select("*")
                ->where("service_id",$childService->id)
                ->orderBy ("service_complexity_id")
                ->get();
            foreach ($childServiceDetails as $detail)
            {
                $allData["srv-".$childService->id]["cmp-".$detail->service_complexity_id]["h-".$detail->time_price]=$detail->price;
                if($detail->show_default==1) {
                    $return .= complexity_bloc_show($childService->name, $detail, $imageLocation);
                }
            }
$return.='</div>
    </div>
  </div></div>';
        }
        $return.="</div>";
        $returnArr['cmplx_block']=$return;
        $returnArr['all_data']=$allData;
        return $returnArr;
    }
}