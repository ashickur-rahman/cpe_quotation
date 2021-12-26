<?php

    $search_array=array(
        "first"=>array(
            "second"=>array(
                "third"=>"3"
            )
        )
    );

    echo array_key_exists('second', $search_array["first"]);
?>