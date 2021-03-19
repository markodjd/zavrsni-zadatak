<?php

$servername = '127.0.0.1';
$username = 'root';
$password = 'root';
$dbname = 'blog';

try {
    $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}

function query($connection, $sql, $method, $multi = false) {
    $statement = $connection->prepare($sql);

    $statement->execute();

    if ($method === 'GET') {
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        if ($multi) {
            return $statement->fetchAll();
        }
        return $statement->fetch();
    }
}
