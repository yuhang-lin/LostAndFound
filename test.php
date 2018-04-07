<!DOCTYPE html>
<html>
<body>

<h1>My first PHP page</h1>

<?php
//$a = curl "https://gateway-a.watsonplatform.net/visual-recognition/api/v3/classify?api_key={1321672755ab136b9f9cfb5d44b81bf736ace50b}&url=https://watson-developer-cloud.github.io/doc-tutorial-downloads/visual-recognition/fruitbowl.jpg&version=2016-05-20";

//$request = curl "https://gateway-a.watsonplatform.net/visual-recognition/api/v3/classify?api_key={1321672755ab136b9f9cfb5d44b81bf736ace50b}&url=http://yzhang27.w3.uvm.edu/lnf/shirt.jpg&version=2016-05-20";

$pic_path = "http://yzhang27.w3.uvm.edu/lnf/shirt.jpg";

$url = "https://gateway-a.watsonplatform.net/visual-recognition/api/v3/classify?api_key=1321672755ab136b9f9cfb5d44b81bf736ace50b&url=" . $pic_path . "&version=2016-05-20";
//$url = "https://gateway-a.watsonplatform.net/visual-recognition/api/v3/classify?api_key=1321672755ab136b9f9cfb5d44b81bf736ace50b&url=http://yzhang27.w3.uvm.edu/lnf/shirt.jpg&version=2016-05-20";

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

$associ_array = $myjsons->images[0]->classifiers[0]->classes);

//print_r($curl_error);


?>



</body>
</html>