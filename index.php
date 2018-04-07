<?php
/*
 * Copyright IBM Corp. 2016
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

 /**
  * This PHP file uses the Slim Framework to construct a REST API.
  * See Cloudant.php for the database functionality
  */
require 'vendor/autoload.php';
require_once('./QueryPageData.php');

$servername = "hanghang.tk";
$username = "aaron";
$password = "HxOQgaO7ZMi4feC0";
$dbname = "codefest";

$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    echo 'hello';
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo 'hello';
}

/**
 * Execute the query to database
 */
function passQuery($conn, $query){
    if ($result = $conn->query($query)) {
        echo "Table MyGuests created successfully";
        return $result;
    } else {
        echo "Error description: " . $conn->error;
    }
}

/**
 * Transform input parameters including NULL to a string type query
 */
function insertFound($conn, $datetime, $URL, $contact, $description, $location, $type)
{
    $columnArray = array('datetime', 'URL', 'contact', 'description', 'location', 'type');
    $passedArray = array($datetime, $URL, $contact, $description, $location, $type);
    
    $queryArray = array();
    $valueArray = array();
    
    for ($i=0; $i<6; $i++){
        if ($passedArray[$i] != NULL){
            array_push($queryArray, $columnArray[$i]);
            array_push($valueArray, $passedArray[$i]);
        }
    }

    $query = "INSERT INTO LostAndFound (";
    $query = $query . implode(',',$queryArray);
    $query = $query . ") VALUES (";
    $query = $query . implode(',',$valueArray);
    $query = $query . ")";
    
    
    echo $query."\n";
    echo $this->passQuery($conn, $query);
    return $query;
}

/**
 * Retrieve the information from database
 */

function selectFromFound($conn, $keywords, $type){

    $keywordStr = "";
    foreach($keywords as $keyword) {
        $keywordStr = $keywordStr ."IDtoKeyword.keyword = ". "'" . $keyword ."'". " OR ";
    }

    $keywordStr = substr($keywordStr,0,strlen($keywordStr)-3);

    $query = "SELECT LostAndFound.datetime, LostAndFound.URL, Contact.name, Contact.email, Contact.phone, Contact.office, LostAndFound.description, Type.name as type, count(LostAndFound.id) as counts 
        FROM LostAndFound 
        LEFT JOIN IDtoKeyword ON LostAndFound.id = IDtoKeyword.id
        LEFT JOIN Type ON LostAndFound.type = Type.id 
        LEFT JOIN Contact ON LostAndFound.contact = Contact.id 
        WHERE LostAndFound.type = $type and ($keywordStr) 
        GROUP BY LostAndFound.id 
        ORDER BY counts DESC";

    $result = passQuery($conn, $query);
    return $result;
    
}

function fillTemplate($templateName, $result) {
  $html = "";
  while ($row = mysqli_fetch_assoc($result)) {
    $htmlContent = file_get_contents($templateName);
    $htmlContent = str_replace('{dateTime}', $row['datetime'], $htmlContent);
    $htmlContent = str_replace('{url}', $row['URL'], $htmlContent);
    $htmlContent = str_replace('{name}', $row['name'], $htmlContent);
    $htmlContent = str_replace('{email}', $row['email'], $htmlContent);
    $htmlContent = str_replace('{phone}', $row['phone'], $htmlContent);
    $htmlContent = str_replace('{office}', $row['office'], $htmlContent);
    $htmlContent = str_replace('{description}', $row['description'], $htmlContent);
    $htmlContent = str_replace('{type}', $row['type'], $htmlContent);
    $html .= $htmlContent;
  }
  return $html;
}

$app = new \Slim\Slim();
$dotenv = new Dotenv\Dotenv(__DIR__);
try {
  $dotenv->load();
} catch (Exception $e) {
    error_log("No .env file found");
}
$app->get('/', function () {
  global $app;
    $app->render('homepage.php');
    $app->render('footer.php');
});

$app->get('/queryPageData', function() {
  global $conn;
  global $app;
  $res = selectFromFound($conn, array('blue', 'Bottle'), 0);
//   $app->render(fillTemplate('./templates/t.html', $res));
});

$app->get('/lost/', function () {
    global $app;
    $app->render('lost.php');
    $app->render('footer.php');
});

$app->get('/found/', function () {
    global $app;
    $app->render('found.php');
    $app->render('footer.php');
});

$app->get('/api/visitors', function () {
  global $app;
  $app->contentType('application/json');
  $visitors = array();
  if(Cloudant::Instance()->isConnected()) {
    $visitors = Cloudant::Instance()->get();
  }
  echo json_encode($visitors);
});

$app->post('/api/visitors', function() {
	global $app;
  $visitor = json_decode($app->request()->getBody(), true);
  if(Cloudant::Instance()->isConnected()) {
    Cloudant::Instance()->post($visitor);
    echo sprintf("Hello %s, I've added you to the database!", $visitor['name']);
  } else {
    echo sprintf("Hello %s!", $visitor['name']);
  }
});

$app->delete('/api/visitors/:id', function($id) {
	global $app;
	Cloudant::Instance()->delete($id);
    $app->response()->status(204);
});

$app->put('/api/visitors/:id', function($id) {
	global $app;
	$visitor = json_decode($app->request()->getBody(), true);
    echo json_encode(Cloudant::Instance()->put($id, $visitor));
});

$app->run();
