<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include __DIR__ . "/../libraries/classes/dbConnect.php";
include __DIR__ . "/../libraries/settings.php";
$db=DB::class;
$parentServices=$db::table('parent_service')
    ->select(array("name","id"))
    ->get();

$allParent=array ();

foreach ($parentServices as $parent) {

    $allParent[$parent->id]=$parent->name;
}
$services=$db::table('service')
    ->select(array("name","id","parent_service"))
    ->get();
$allServices=array();
foreach ($services as $service) {

    $allServices[$service->parent_service][$service->id]=$service->name;
}

$allParest='<option>Select One</option>';

foreach ($parentServices as $parent) {

    $allParest.="<option value='".$parent->id."'>".$parent->name."</option>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Service Complexity</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container ">
    <div class="row  px-5 my-5">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <form id="new-complexity" >
                <div class="form-floating mb-3">
                    <select class="form-select" name="parent_servie" id="parent-service" aria-label="Parent Service">
                        <?=$allParest?>
                    </select>
                    <label for="parent-service">Parent Service</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="service" id="service-name" aria-label="Service
                    Name"></select>
                    <label for="service-name">Service Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" name="complexity" id="complexity-name" type="text" placeholder="complexity
                    Name"/>
                    <label for="complexity-name">complexity Name</label>
                </div>
                <fieldset class="border p-2 border-dark rounded">
                    <legend style="float: none; padding: inherit;" class="w-auto">Price</legend>
                    <div class="row">
                    <div class=" form-floating col mb-3">
                        <input class="form-control " name="price18" id="price-18" type="text"
                               placeholder="18"/>
                        <label for="price-181">18</label>
                    </div>
                    <div class="form-floating col">
                        <input class="form-control " name="price36" id="price-36" type="text"
                               placeholder="36"/>
                        <label for="price-36">36</label>
                    </div>
                    <div class="form-floating col">
                        <input class="form-control " name="price48" id="price-48" type="text"
                               placeholder="48"/>
                        <label for="price-48">48</label>
                    </div>
                    <div class="form-floating col">
                        <input class="form-control " name="price72" id="price-72" type="text"
                               placeholder="72"/>
                        <label for="price-72">72</label>
                    </div>

                </div>
                </fieldset>

                <div id="sample-pic-row">
                    <div class="form-floating mb-3 mt-3">
                        <input class="form-control sample_pic" name="pictures[]" id="picture1" type="text"
                               placeholder="Picture Link"/>
                        <label for="picture1">Sample Image Link</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input class="form-control sample_pic" name="pictures[]" id="picture2" type="text"
                               placeholder="Picture Link"/>
                        <label for="picture2">Sample Image Link</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input class="form-control sample_pic" name="pictures[]" id="picture3" type="text"
                               placeholder="Picture Link"/>
                        <label for="picture3">Sample Image Link</label>
                    </div>
                </div>


                <div class="d-grid mt-3 col-sm-6">
                    <button class="btn btn-info" id="new-image" type="button" name="new_image" > New Image </button>
                </div>
                <div class="d-grid mt-3">
                    <input class="btn btn-info" type="submit" name="store" value="Save">
                </div>
            </form>

        </div>
        <div class="col-lg-3"></div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Section JavaScript -->
<!-- jQuery and jQuery UI (REQUIRED) -->
<!--[if lt IE 9]>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<![endif]-->
<!--[if gte IE 9]><!-->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!--<![endif]-->

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $.validator.prototype.checkForm = function (){
        this.prepareForm();
        for ( var i = 0, elements = (this.currentElements = this.elements()); elements[i]; i++ ) {
            if (this.findByName( elements[i].name ).length != undefined && this.findByName( elements[i].name ).length > 1) {
                for (var cnt = 0; cnt < this.findByName( elements[i].name ).length; cnt++) {
                    this.check( this.findByName( elements[i].name )[cnt] );
                }
            }
            else {
                this.check( elements[i] );
            }
        }
        return this.valid();
    };
    var allServices=<?php echo json_encode($allServices) ?>;
    var totalPic=parseInt(4);
    // allServices = JSON.stringify(allServices);
    // allServices=JSON.parse(allServices);
    //console.log(allServices)

    $("#new-image").on("click",function (){


        var html = '';
        html += '<div class="form-floating mb-3">';
        html += '<input class="form-control" name="pictures[]" id="picture'+totalPic+'" type="text" placeholder="Picture ' +
        'Link"/>';
        html += '<label for="picture'+totalPic+'">Sample Image Link</label>';
        html += '</div>';
        totalPic++;
        $("#sample-pic-row").append(html);

    })
    $(document).ready(function() {

        //$('#parent-service').select2();
        // Wait for the DOM to be ready
        $("#new-complexity").validate({

            rules: {
                service: "required",
                complexity: "required",
                'pictures[]': {
                    required: true
                }
            },
            messages: {
                service: "Select A Service",
                complexity: "Please Enter Complexity Name"
            },

            submitHandler: function(form) {
                var name='';

                var sample_picture=($("input[name='pictures[]']")
                    .map(function(){return $(this).val();}).get());
                $.ajax({

                    url : 'ajax/new_complexity.php',
                    type : 'POST',
                    data : {
                        'service' : $("#service-name").val(),
                        'name': $("#complexity-name").val(),
                        'h18':$("#price-18").val(),
                        'h36':$("#price-36").val(),
                        'h48':$("#price-48").val(),
                        'h72':$("#price-72").val(),
                        'sample_images':sample_picture

                    },
                    success : function(data) {
                        console.log(data)
                        if(data=="duplicate")
                        {
                            $.notify("Already Saved as Same Name!", "error");
                        }
                        else if(data=="error")
                        {
                            $.notify("Unknown Error Occur!", "error");
                        }
                        else if(data=="success")
                        {
                            $.notify("Saved Successfully", "success");
                            name='';
                        }
                        else
                        {
                            $.notify("Unknown Error Occur!", "error");
                        }

                    },
                    beforeSend : function (){
                        name=$("#parentServiceName").val();
                        $("#new_parent").hide();

                    },
                    complete: function(data) {
                        $("#parentServiceName").val(name),
                            $("#new_parent").show();
                    }
                });
            }
        });
    });
    $("#parent-service").on("change",function (){
        parentService=$(this).val();
        $('#service-name').empty()
        $('#service-name').append($('<option>').val('').text("Select One"))
        let serviceS='';
        for (const [id, name] of Object.entries(allServices[parentService])){
            serviceS+="<option value='"+id+"'>"+name+"</option>"
            $('#service-name').append($('<option>').val(id).text(name))
        }

    })
</script>
</body>
</html>