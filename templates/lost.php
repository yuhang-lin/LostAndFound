

<?php
include ("top.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Found Page</title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>

<body>
    <?php include ("menu.php");?>
    <div class="container">
        <h1>Found Page</h1>
         <div>
            <a href="templates/lost.html">
            <button class="button" style="vertical-align:middle"><span>Lost</span></button>
            </a>
        </div>
         <div><a href="templatesfound.html">
            <button class="button" style="vertical-align:middle"><span>Found</span></button>
        </a>
        </div>
        <p id="response" class="lead text-center"></p>

        <p id="databaseNames" class="lead text-center"></p>
    </div>
</body>

</html>