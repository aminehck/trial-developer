<?php 
$pdo = new PDO("mysql:host=localhost;dbname=trial-dev", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function clearT()
{
    $sql = "DELETE FROM transactions";
    $result = $GLOBALS['pdo']->query($sql);
}

//Check if client ID exist 
function checkClient($id) {
    $sql = "SELECT id from clients where id = $id limit 1";
    $result = $GLOBALS['pdo']->query($sql);
    return $result->rowCount();
}

function addClient(array $client)
{
    if(!checkClient($client[1])) {
        //New Client 
        try {
            $sql = "INSERT INTO clients (id, client) VALUES('$client[1]', '$client[0]')";
            $GLOBALS['pdo']->exec($sql);
            echo "New client added\n";
        } catch(PDOException $e){
            die($e->getMessage());
        }
    } else {
        echo "Client existe \n";
    }
}

//Check if client ID exist 
function checkDeal($id) {
    $sql = "SELECT id from deals where id = $id limit 1";
    $result = $GLOBALS['pdo']->query($sql);
    return $result->rowCount();
}

function addDeal(array $deal)
{
    if(!checkDeal($deal[1])) {
        //New Deal 
        try {
            $sql = "INSERT INTO deals (id, deal) VALUES('$deal[1]', '$deal[0]')";
            $GLOBALS['pdo']->exec($sql);
            echo "New deal added\n";
        } catch(PDOException $e){
            die($e->getMessage());
        }
    } else {
        echo "Deal existe \n";
    }
}

function addTransaction($clientId, $dealId, $hour, $accepted, $refused)
{
    try {
        //Convert $hour to mysql datetime format
        $hour = date('Y-m-d H:i:s', strtotime($hour));
        $sql = "INSERT INTO transactions (client_id, deal_id, created_at, accepted, refused) VALUES('$clientId', '$dealId', '$hour', '$accepted', '$refused')";
        $GLOBALS['pdo']->exec($sql);
        echo "New transaction added\n";
    } catch(PDOException $e){
        die($e->getMessage());
    }
}

//Check if file exists
if(file_exists($argv[1])) {
    //Check file extension 
    $infoFile = pathinfo($argv[1]);
    if(strcmp($infoFile['extension'], 'csv')){
        echo 'Please enter a CSV File !';
        exit();
    }
    //Open the csv file    
    $file = fopen($infoFile['basename'], 'r');
    fgetcsv($file); // Ignore first row *header*
    while($data = fgetcsv($file)){
        $client = explode('@', $data[0]);
        $deal = explode('#', $data[1]);
        $hour = $data[2];
        $accepted = $data[3];
        $refused = $data[4];
        addClient($client);
        addDeal($deal);
        addTransaction($client[1], $deal[1], $hour, $accepted, $refused);
    }
    fclose($file);
} else {
    echo "File not found !";
} 


