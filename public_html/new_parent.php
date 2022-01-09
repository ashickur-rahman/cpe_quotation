<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Parent Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>
<div class="container ">
    <div class="row  px-5 my-5">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <form id="new-parent-form" action="#"  >
                <div class="form-floating mb-3">
                    <input class="form-control" id="parent-service-name" type="text" placeholder="Parent Service Name"/>
                    <label for="parent-service-name">Parent Service Name</label>
                </div>


                <div class="d-grid">
                    <input class="btn btn-info" type="submit" name="store" value="Save">
                </div>
            </form>
        </div>
        <div class="col-lg-3"></div>

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

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>

<script>

    $(document).ready(function() {
        // Wait for the DOM to be ready
        $(function() {
            // Initialize form validation on the registration form.
            // It has the name attribute "registration"
            $("#new-parent-form").validate({

                rules: {
                    newparent: "required"
                },
                messages: {
                    newparent: "Please enter Parent Service Name",
                },

                submitHandler: function(form) {
                    var name='';
                    $.ajax({

                        url : 'ajax/new_parent.php',
                        type : 'POST',
                        data : {
                            'parent' : $("#parent-service-name").val(),
                        },
                        success : function(data) {
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
                            name=$("#parent-service-name").val();
                            $("#new_parent").hide();

                        },
                        complete: function(data) {
                            $("#parent-service-name").val(name),
                            $("#new_parent").show();
                        }
                    });
                }
            });
        });
    });
</script>
</body>
</html>