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
    <title>New Parent Service</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container ">
    <div class="row  px-5 my-5">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <form id="new-service" >
                <div class="form-floating mb-3">
                    <select class="form-select" name="parent_servie" id="parent-service" aria-label="Parent Service">
                        <?=$allParest?>
                    </select>
                    <label for="parent-service">Parent Service</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" name="service" id="service-name" type="text" placeholder="Service
                    Name"/>
                    <label for="service-name">Service Name</label>
                </div>

                <div class="d-grid">
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

    $(document).ready(function() {

        //$('#parent-service').select2();
        // Wait for the DOM to be ready
        $("#new-service").validate({

            rules: {
                parent_servie: "required",
                service: "required"
            },
            messages: {
                parent_servie: "Please Select Parent Service ",
                service: "Please Enter Service Name"
            },

            submitHandler: function(form) {
                var name='';
                $.ajax({

                    url : 'ajax/new_service.php',
                    type : 'POST',
                    data : {
                        'parent' : $("#parent-service").val(),
                        'service' : $("#service-name").val(),
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
</script>
</body>
</html>