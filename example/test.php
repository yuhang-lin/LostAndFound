<!DOCTYPE html>
<html>
<body>

<form class="form-horizontal" action="https://ylin19.w3.uvm.edu/codefest/lnf/upload.php" method="post" enctype="multipart/form-data">
            <div class="w3-display-t w3-center">

                <div class="form-group">
                    <label class="control-label col-sm-2" for="name">Your Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="phone">Phone:</label>
                    <div class="col-sm-10">
                        <input type="phone" class="form-control" name="phone" id="phone" placeholder="Enter phone">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="office">Office:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="office" id="office" placeholder="Enter office">
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
                        <input class="form-control input-lg" name="inputlg" id="inputlg" type="text">
                    </div>
                </div>

            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" id="btnSubmit">Submit</button>
                </div>
            </div>

        </form>

</body>
</html>