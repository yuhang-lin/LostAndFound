<?php
include("top.php");
?>

<!DOCTYPE html>
<html lang="en">


<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#response").hide();
        $("#btnHide").prop('disabled', true);
        $("#btnSubmit").click(function(){
            $name = $("#name").val();
            $email = $("#email").val();
            $phone = $("#phone").val();
            $office = $("#office").val();
            $fileToUpload = $("#fileToUpload").val();
            $inputlg = $("#inputlg").val();
            if(true){
                $.post("https://ylin19.w3.uvm.edu/codefest/lnf/upload.php", {name:$name, email: $email, phone: $phone, office:$office, fileToUpload:$fileToUpload,inputlg:$inputlg}, function(data){
                    $("#response").html(data);
                    $("#response").show();
                    success: {
                        $("#response").delay(2000).fadeOut();
                        if ($("#tblRecord").is(":visible")){
                            $("#btnShow").click();
                        }
                    }
                    error: $("#response").delay(5000).fadeOut("slow");
                });
            }
        });
        $("#btnShow").click(function(){
            $.post("getrecord.php", {}, function(data){
                $("#record").show();
                $("#record").html(data);
                $("#btnHide").prop('disabled', false);
                $('#tblRecord').dataTable( {
                    "aaSorting": [[2,'desc']]
                } );
            });
        });
    });
</script>


<header class="background w3-display-container w3-grayscale-min" id="home1">


    <div class="w3-display-middle w3-center">
        <!-- <span class="w3-text-black" style="font-size:90px">Lost</span> -->
        <form class="form-horizontal" action="https://ylin19.w3.uvm.edu/codefest/lnf/upload.php" method="post" enctype="multipart/form-data">
            <div class="w3-display-t w3-center">

                <div class="form-group">
                    <label class="control-label col-sm-2" for="name">Your Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" placeholder="Enter name">
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
                    <button type="submit" class="btn btn-default" id="btnSubmit">Submit</button>
                </div>
            </div>

        </form>

    </div>


</header>


<?php include("menu.php"); ?>


</body>

</html>