<?php
require 'bootstrap.php';

$statement = <<<EOS
    CREATE TABLE IF NOT EXISTS `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(100) NOT NULL,
 `latitude` decimal(8,6) NOT NULL,
 `longitude` decimal(9,6) NOT NULL,
 `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB;

    INSERT INTO users
        (username, latitude, longitude, timestamp)
    VALUES
        ('tony', -2.342590, 55.778419, CURRENT_TIMESTAMP),
        ('adam', -2.819247, 55.615761, CURRENT_TIMESTAMP),
        ('ross', -2.433930, 55.599491, CURRENT_TIMESTAMP),
        ('robert', -3.809266, 51.988263, CURRENT_TIMESTAMP),
        ('liam', -2.416452, 55.605990, CURRENT_TIMESTAMP);
EOS;

try {
    $createTable = $dbConnection->exec($statement);
    echo "Success!";
} catch (PDOException $e) {
    exit($e->getMessage());
}