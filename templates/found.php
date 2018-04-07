<?php
include("top.php");
?>

<!DOCTYPE html>
<html lang="en">


<body>


<header class="background w3-display-container w3-grayscale-min" id="home1">


    <div class="w3-display-middle w3-center">
        <!-- <span class="w3-text-black" style="font-size:90px">Lost</span> -->
        <form class="form-horizontal" action="https://ylin19.w3.uvm.edu/codefest/lnf/upload.php" method="post" enctype="multipart/form-data">
            <div class="w3-display-t w3-center">

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Your Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" placeholder="Enter name">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" placeholder="Enter email">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="phone">Phone:</label>
                    <div class="col-sm-10">
                        <input type="phone" class="form-control" id="phone" placeholder="Enter phone">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="office">Office:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="office" placeholder="Enter office">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="fileToUpload">Upload the picture</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputlg">Describe the item you found</label>
                    <div class="col-lg-10">
                        <input class="form-control input-lg" id="inputlg" type="text">
                    </div>
                </div>

            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>

        </form>

    </div>


</header>


<?php include("menu.php"); ?>


</body>

</html>