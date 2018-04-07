<?php
include ("top.php");
?>

<!DOCTYPE html>
<html lang="en">

<!-- <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>We Lost.We Found.</title>

    <!-- Bootstrap
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head> --> 

 

<body>
    

    <header class="background w3-display-container w3-grayscale-min" id="home">
  
  <div class="w3-display-middle w3-center">
    <!-- <span class="w3-text-black" style="font-size:90px">Lost</span> -->
    <a href="/lost/" class="w3-tag w3-wide" style="font-size:90px" role="button" >Lost</a>
  </div>
 
   </header>

   <header class="background w3-display-container w3-grayscale-min" id="science">
  
  <div class="w3-display-middle w3-center">
    <a href="/found/" class="w3-tag w3-wide" style="font-size:90px" role="button" >Found</a>
  </div>
 
   </header>

   <?php include ("menu.php");?>

  <!--   <div class="container">
        <h1>Welcome.</h1>
         <div><a href="templates/lost.html">
            <button class="button" style="vertical-align:middle"><span>Lost</span></button>
        </a>
        </div>
         <div><a href="templatesfound.html">
            <button class="button" style="vertical-align:middle"><span>Found</span></button>
        </a>
        </div>
        <p id="response" class="lead text-center"></p>

        <p id="databaseNames" class="lead text-center"></p>
    </div> -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    Include all compiled plugins (below), or include individual files as needed
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="public/antixss.js" type="text/javascript"></script>

    <script>
        //Submit data when enter key is pressed
        $('#user_name').keydown(function(e) {
            var name = $('#user_name').val();
            if (e.which == 13 && name.length > 0) { //catch Enter key
                //POST request to API to create a new visitor entry in the database
                $.ajax({
                  method: "POST",
                  url: "./api/visitors",
                  contentType: "application/json",
                  data: JSON.stringify({name: name })
                })
                .done(function(data) {
                    $('#response').html(AntiXSS.sanitizeInput(data));
                    $('#nameInput').hide();
                    getNames();
                });
            }
        });

        //Retreive all the visitors from the database
        function getNames(){
          $.get("./api/visitors")
              .done(function(data) {
                  if(data.length > 0) {
                    data.forEach(function(element, index) {
                      data[index] = AntiXSS.sanitizeInput(element)
                    });
                    $('#databaseNames').html("Database contents: " + JSON.stringify(data));
                  }
              });
          }

          //Call getNames on page load.
          getNames();


    </script> -->
</body>

</html>