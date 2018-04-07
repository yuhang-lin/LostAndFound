<?php
include "lib/constants.php";
require_once(BIN_PATH . '/Database.php');

$dbUserName = get_current_user() . '_reader';
$whichPass = "r"; //flag for which one to use.
$dbName = DATABASE_NAME;
$thisDatabaseReader = new Database($dbUserName, $whichPass, $dbName);

$dbUserName = get_current_user() . '_writer';
$whichPass = "w"; //flag for which one to use.
$thisDatabaseWriter = new Database($dbUserName, $whichPass, $dbName);


$target_dir = "images/";
$date = new DateTime();
$timestamp = $date->getTimestamp();
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
print_r($_POST);
$name = $_POST["name"];
$email = $_POST['email'];
$phone = $_POST['phone'];
$office = $_POST['office'];
$inputlg = $_POST['inputlg'];
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    $target_file = $target_dir . $timestamp . "." . $imageFileType;
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
$pic_path = "https://ylin19.w3.uvm.edu/codefest/lnf/images/" . $timestamp . "." . $imageFileType;

$url = "https://gateway-a.watsonplatform.net/visual-recognition/api/v3/classify?api_key=1321672755ab136b9f9cfb5d44b81bf736ace50b&url=" . $pic_path . "&version=2016-05-20";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$output = curl_exec($ch);
$curl_error = curl_error($ch);
curl_close($ch);

$myjsons = json_decode($output);
//print_r($myjsons);
$associ_array = $myjsons->images[0]->classifiers[0]->classes;
print_r($associ_array);

// Create connection
$conn = connectDB();

echo "Your name: " . $name . "<br>";
echo "Email: " . $email . "<br>";
echo "phone: " . $phone. "<br>";
echo "Office: " . $office. "<br>";
echo "Describe: " . $inputlg. "<br>";

// Change datetime format to string
$UTC = new DateTimeZone("UTC");
$time = new datetime("2018-04-07 13:59:01", $UTC);
$formattedTime = "\"".$time->format('Y-m-d H:i:s')."\"";

// Insert a row with these parameters to database
//$id = findContactID($conn, $name, $email,$phone, $office);
//insertLostAndFound($conn, $formattedTime, NULL, $id, "\"I'm not Amy\"", $office, 0);


//insertIDtoKeyword($conn, $id, $keywords)
//insertIDtoKeyword($conn, array("PEN"));
//insertIDtoKeyword($conn, array("paper"));
//insertIDtoKeyword($conn, array("black", "shoes"));

disconnectDB($conn);


/**
 * Insert keywords
 */
function insertIDtoKeyword($conn, $keywords)
{
    $query = "SELECT MAX(id) FROM LostAndFound";
    $result = passQuery($conn, $query);
    $row = $result->fetch_assoc();

    $id = $row["MAX(id)"];

    try {
        foreach ($keywords as $keyword){
            $query = "INSERT INTO IDtoKeyword (id, keyword) VALUES ($id, \"$keyword\")";
            passQuery($conn, $query);
        }
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

/**
 * Transform input parameters including NULL to a string type query
 */
function insertLostAndFound($conn, $datetime, $URL, $contact, $description, $location, $type)
{
    // Original data
    $columnArray = array("datetime", "URL", "contact", "description", "location", "type");
    $passedArray = array($datetime, $URL, $contact, $description, $location, $type);

    // Store existing data to arrays
    $queryArray = array();
    $valueArray = array();
    for ($i=0; $i<6; $i++){
        if ($passedArray[$i] !== NULL){
            array_push($queryArray, $columnArray[$i]);
            array_push($valueArray, $passedArray[$i]);
        }
    }

    // Generate the query string
    $query = "INSERT INTO LostAndFound (";
    $query = $query . implode(',',$queryArray);
    $query = $query . ") VALUES (";
    $query = $query . implode(',',$valueArray);
    $query = $query . ")";

    // Pass the query to database
    passQuery($conn, $query);
    return;
}

/**
 * Get contact ID
 */
function findContactID($conn, $name, $email, $phone, $office)
{
    $query = "SELECT id, name, email FROM Contact WHERE name = $name AND email = $email";
    $result = $conn->query($query);

    if ($result->num_rows>0) {
        #echo "There's something\n";
        $row = $result->fetch_assoc();
        return $row["id"];
    }
    else {
        #echo "No result\n";

        // Original data
        $columnArray = array("name", "email", "phone", "office");
        $passedArray = array($name, $email, $phone, $office);

        // Store existing data to arrays
        $queryArray = array();
        $valueArray = array();
        for ($i=0; $i<4; $i++){
            if ($passedArray[$i] !== NULL){
                array_push($queryArray, $columnArray[$i]);
                array_push($valueArray, $passedArray[$i]);
            }
        }

        // Generate the query string
        $insertQuery = "INSERT INTO Contact (";
        $insertQuery = $insertQuery . implode(',',$queryArray);
        $insertQuery = $insertQuery . ") VALUES (";
        $insertQuery = $insertQuery . implode(',',$valueArray);
        $insertQuery = $insertQuery . ")";


        // Pass the query to database
        passQuery($conn, $insertQuery);

        $result = passQuery($conn, $query);
        $row = $result->fetch_assoc();

        return $row["id"];
    }
}

/**
 * Create connection to database
 */
function connectDB(){
    $servername = "hanghang.tk";
    $username = "aaron";
    $password = "HxOQgaO7ZMi4feC0";
    $dbname = "codefest";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    //echo "Connected successfully\n";

    return $conn;
}

/**
 * Execute the query to database
 */
function passQuery($conn, $query){
    #echo $query."\n";

    //echo "[pass the query]".$query."\n";

    if (($result = $conn->query($query))) {
        //echo "Query passed successfully\n";
        return $result;
    } else {
        echo "Error description: " . $conn->error . "\n";
        return NULL;
    }

}
/**
 * Disconnect from database
 */
function disconnectDB($conn)
{
    $conn->close();
}
?>