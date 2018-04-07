<?php
    
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
    echo "Connected successfully\n";
    
    
    
    
    #echo insertFound($conn, $description='aaaaa', $contact=1);
    
    //echo insertFound($conn, NULL, NULL, 1, 'aaaaa', NULL, NULL);
    
    
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
        echo passQuery($conn, $query);
        return $query;
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
    
    /*
    SELECT LostAndFound.datetime, LostAndFound.URL, Contact.name, Contact.email, Contact.phone, Contact.office, LostAndFound.description,LostAndFound.location, Type.name, count(LostAndFound.id) as counts 
    FROM LostAndFound 
    LEFT JOIN IDtoKeyword ON LostAndFound.id = IDtoKeyword.id
    LEFT JOIN Type ON LostAndFound.id = Type.id 
    LEFT JOIN Contact ON LostAndFound.id = Contact.id 
    WHERE LostAndFound.type = 'lost' and(IDtoKeyword.keyword = 'blue' or IDtoKeyword.keyword = 'Bottle' or IDtoKeyword.keyword = 'not mine') 
    GROUP BY LostAndFound.id 
    ORDER BY counts DESC

    */


    /**
     * Retrive the infomation from database
     */

    function selectFromFound($conn,$keywords,$type){

        $keywordStr = "";
       foreach($keywords as $keyword) {
           $keywordStr = $keywordStr ."IDtoKeyword.keyword = ". "'" . $keyword ."'". " OR ";
       }

        $keywordStr = substr($keywordStr,0,strlen($keywordStr)-3);

        // echo "<br>".$keywordStr."<br>";

        $query = "SELECT LostAndFound.datetime, LostAndFound.URL, Contact.name, Contact.email, Contact.phone, Contact.office, LostAndFound.description,LostAndFound.location, Type.name, count(LostAndFound.id) as counts 
            FROM LostAndFound 
            LEFT JOIN IDtoKeyword ON LostAndFound.id = IDtoKeyword.id
            LEFT JOIN Type ON LostAndFound.type = Type.id 
            LEFT JOIN Contact ON LostAndFound.contact = Contact.id 
            WHERE LostAndFound.type = $type and ($keywordStr) 
            GROUP BY LostAndFound.id 
            ORDER BY counts DESC";


       $result = passQuery($conn, $query);

       $row = $result->fetch_array(MYSQLI_ASSOC);
        print_r($row);
    }

    // $keywords = array('Bottle', 'blue');
    // $type = 0;
    // selectFromFound($conn,$keywords,$type)
?>
