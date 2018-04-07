<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include ("top.php");
?>
<html>
    <head>
        <title>Uploading the picture</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
         <?php include ("menu.php");?>
        <div id="nameInput" class="input-group-lg center-block helloInput">
            <p class="lead">Please upload the picture</p>
            <input id="user_name" type="text" class="form-control" placeholder="picture" aria-describedby="sizing-addon1" value="" />
        </div>
        <div><a>
            <button class="button" style="vertical-align:middle"><span>Upload</span></button>
        </a>
        </div>
    </body>
</html>
