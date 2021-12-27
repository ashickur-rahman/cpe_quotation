<?php
include __DIR__ . "/../libraries/classes/dbConnect.php";
include __DIR__ . "/../libraries/settings.php";
include __DIR__ . "/../libraries/classes/compexityPictures.php";

if(!function_exists("showChildServices"))
{
    function showChildServices (Array $childServices,$parentServiceId,$db=DB::class)
    {

        $return= '<div class="accordion accordion-flush" id="childServiceShow'.$parentServiceId.'">';
        foreach ($childServices as $childService)
        {
            //$allData["srv-".$childService->id]["cmp-".$detail->service_complexity_id]=array();

            $return.='<div class="accordion-item">
    <h2 class="accordion-header" id="child-flush-heading'.$childService->id.'">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#child-flush-collapse'.$childService->id.'" aria-expanded="false" aria-controls="child-flush-collapse'.$childService->id.'">
        '.$childService->name.'
      </button>
    </h2>
    <div id="child-flush-collapse'.$childService->id.'" class="accordion-collapse collapse" aria-labelledby="child-flush-heading'.$childService->id.'" data-bs-parent="#childServiceShow'.$parentServiceId.'">
      <div class="accordion-body">';
//complexity code
            $childServiceDetails=$db::table('service_all')->select("*")
                ->where("service_id",$childService->id)
                ->orderBy ("service_complexity_id")
                ->get();
            foreach ($childServiceDetails as $detail)
            {
                $allData["srv-".$childService->id]["cmp-".$detail->service_complexity_id]["h-".$detail->time_price]=$detail->price;
            }
$return.='</div>
    </div>
  </div>';
        }
        $return.="</div>";
        $returnArr['cmplx_block']=$return;
        $returnArr['all_data']=$allData;
        return $returnArr;
    }
}