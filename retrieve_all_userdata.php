<?php

require_once __DIR__ . '/vendor/autoload.php';  // If you're using Composer's autoloader

try {
    // Establish database connection
    $client = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    
    // Create a query to retrieve documents
    $dbname = 'ugcall';
    $collection = 'Users';
    $query = new MongoDB\Driver\Query([]);
    
    // Execute the query
    $cursor = $client->executeQuery("$dbname.$collection", $query);

} catch (MongoDB\Driver\Exception\Exception $e) {
    die("Error: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MongoDB Results</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <!-- Modify this based on your document structure -->
                <th>ID</th>
                <th>Email</th>
                <th>First Name</th>
				<th>Last Name</th>
                <th>Telephone</th>
                <th>Role</th>
                <th>Status</th>
                <th>Active</th>
                <th>Leg Count</th>
                <th>Login Time</th>
                <th>Last Logout</th>
                <!-- Add more headers as needed -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cursor as $document): ?>
                <tr>
                    <!-- Modify this based on your document structure -->
                    <td><?php echo $document->_id; ?></td>
                    <td><?php echo $document->email; ?></td>
                    <td><?php echo $document->ftname; ?></td>
					<td><?php echo $document->ltname; ?></td>
                    <td><?php echo $document->tel; ?></td>
                    <td><?php echo $document->role; ?></td>
                    <td><?php echo $document->status; ?></td>
                    <td><?php echo $document->active; ?></td>
                    <td><?php echo $document->leg_count; ?></td>
                    <td><?php echo $document->login_time; ?></td>
                    <td><?php echo $document->last_logout; ?></td>
                    <!-- Add more columns as needed -->
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
