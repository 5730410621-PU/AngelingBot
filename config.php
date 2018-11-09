<?php

function sql(){
    $servername = "den1.mysql5.gear.host";
    $username = "poporingbot";
    $password = "umbangtalad123!";
    $dbname = "poporingbot";
    return new mysqli($servername, $username, $password,$dbname);
}