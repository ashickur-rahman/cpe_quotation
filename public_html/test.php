<?php
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
