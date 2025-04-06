<?php
return [
  'host' => 'localhost',
  'dbname' => 'gestion_lignes',
  'username' => 'root',
  'password' => 'root',
  'charset' => 'utf8mb4',
  'options' => [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES => false,
  ]
];
