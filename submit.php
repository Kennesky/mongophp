<?php
require 'vendor/autoload.php'; // Assuming you've installed the MongoDB PHP Library via Composer

// Connect to MongoDB
//$client = new MongoDB\Driver\Manager("mongodb://localhost:27017");
//$collection = $client->demo->users; // "demo" is the database name and "users" is the collection

try {
    // Establish database connection
    $client = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    
    // Create a query to retrieve documents
    $dbname = 'mydatabase';
    $collection = 'mycollection2';
    $query = new MongoDB\Driver\Query([]);
    
    // Execute the query
    $cursor = $client->executeQuery("$dbname.$collection", $query);

} catch (MongoDB\Driver\Exception\Exception $e) {
    die("Error: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    if (!empty($name) && !empty($email)) {
	
	// Create a new bulk write object	
	$bulk = new MongoDB\Driver\BulkWrite;

    // Insert a new document
    //$bulk->insert(['name' => 'Alice', 'age' => 25, 'email' => 'alice25@yahoo.com']);
	$bulk->insert(['name' => $name, 'email' => $email]);

    // Execute the bulk write
    $client->executeBulkWrite("$dbname.$collection", $bulk);
		
		
     /*   $insertOneResult = $collection->insertOne([
            'name' => $name,
            'email' => $email,
        ]); */
        echo "Inserted with Object ID '{$insertOneResult->getInsertedId()}'";
    } else {
        echo "Both fields are required!";
    }
}
?>
