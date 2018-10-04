<?php

$dsn = 'mysql:host=127.0.0.1;dbname=test';
$user = 'root';
$password = 'a2kp09';
$create_tables = false;

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($create_tables)
    {

        $pdo->exec('DROP DATABASE IF EXISTS test');
        $pdo->exec('CREATE DATABASE test');
        $pdo->exec('USE test');
        $pdo->exec('CREATE TABLE a (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(32),
            meta VARCHAR(64)
        )');
        $pdo->exec('CREATE TABLE b (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            a_id INTEGER REFERENCES a(id),
            name VARCHAR(32),
            meta VARCHAR(64)
        )');
        $pdo->exec('CREATE TABLE b_c (
            b_id INTEGER REFERENCES b(id),
            c_id INTEGER REFERENCES c(id)
        )');
        $pdo->exec('CREATE TABLE c (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(32),
            meta VARCHAR(64)
        )');

        $rows = 100000;
        echo "Setting up environment";
        $ids = range(1,$rows);
        foreach (range(1,$rows) as $i)
        {
            $pdo->query('INSERT INTO a (name, meta) VALUES("hello", "meta what")');
            if ($i % 1000 == 0)
                echo ".";
        }
        foreach (range(1,$rows) as $i)
        {
            $pdo->query('INSERT INTO b (a_id, name, meta) VALUES('.rand(1,$rows-1).', "hello", "meta what")');
            if ($i % 1000 == 0)
                echo ".";
        }
        foreach (range(1,$rows) as $i)
        {
            $pdo->query('INSERT INTO c (name, meta) VALUES("hello", "meta what")');
            if ($i % 1000 == 0)
                echo ".";
        }
        foreach (range(1,$rows) as $i)
        {
            $id = array_shift($ids);
            $pdo->query('INSERT INTO b_c (b_id, c_id) VALUES('.$id.', '.$id.')');
            if ($i % 1000 == 0)
                echo ".";
        }
        echo "\n\n";
    }

} catch (PDOException $e) {
    echo $e->getMessage();
}


try {
    echo "Testing separate queries:\n";
    $time_start = microtime(true);

    $sth = $pdo->query('SELECT * FROM a');
    $res = $sth->fetchAll(PDO::FETCH_COLUMN);

    $sth = $pdo->query('SELECT * FROM b WHERE a_id IN ('. implode(',', $res). ')');
    $res = $sth->fetchAll(PDO::FETCH_COLUMN);

    $sth = $pdo->query('SELECT c_id FROM b_c WHERE b_id IN ('. implode(',', $res). ')');
    $res = $sth->fetchAll(PDO::FETCH_COLUMN);

    $sth = $pdo->query('SELECT * FROM c WHERE id IN ('. implode(',', $res). ')');
    $res = $sth->fetchAll();

    $time_end = microtime(true);
    $time = $time_end - $time_start;
    echo "Resulted in " . count($res) . " rows\n";
    echo "Process Time: {$time}\n\n";

} catch (PDOException $e) {
    echo $e->getMessage();
}


try {
    echo "Testing JOIN query:\n";
    $time_start = microtime(true);

    $sth = $pdo->query('SELECT
        c.*
        FROM a
        JOIN b ON a_id = a.id
        JOIN b_c ON b_id = b.id
        JOIN c ON c.id = b_c.c_id
    ');
    $res = $sth->fetchAll();

    $time_end = microtime(true);
    $time = $time_end - $time_start;
    echo "Process Time: {$time}\n";
    echo "Resulted in " . count($res) . "rows\n";

} catch (PDOException $e) {
    echo $e->getMessage();
}

echo "\n";
