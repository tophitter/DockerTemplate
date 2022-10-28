<?php
    return array (
        "USER"=>getenv("MYSQL_GLOBAL_USER"),
        "PASSWORD"=>getenv("MYSQL_GLOBAL_PASSWORD"),
        "DATABASE"=>getenv("MYSQL_GLOBAL_DATABASE"),
        "HOST"=>getenv("MYSQL_GLOBAL_HOST"),
        "PORT"=>getenv("MYSQL_GLOBAL_PORT"),
        "DISPLAY_NAME"=>"Global Database",
    );