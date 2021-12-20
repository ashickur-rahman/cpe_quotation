<?php
if(!function_exists("showChildServices"))
{
    function showChildServices (Array $childServices,$parentServiceId)
    {
        $return= '<div class="accordion accordion-flush" id="childServiceShow'.$parentServiceId.'">';
        foreach ($childServices as $childService)
        {
            $return.='<div class="accordion-item">
    <h2 class="accordion-header" id="child-flush-heading'.$childService->id.'">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#child-flush-collapse'.$childService->id.'" aria-expanded="false" aria-controls="child-flush-collapse'.$childService->id.'">
        '.$childService->name.'
      </button>
    </h2>
    <div id="child-flush-collapse'.$childService->id.'" class="accordion-collapse collapse" aria-labelledby="child-flush-heading'.$childService->id.'" data-bs-parent="#childServiceShow'.$parentServiceId.'">
      <div class="accordion-body">
      complexity here
</div>
    </div>
  </div>';
        }
        $return.="</div>";
        return $return;
    }
}