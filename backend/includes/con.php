<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../'); 
$dotenv->load();

$DB_HOST = getenv('DB_HOST');
$DB_PORT = getenv('DB_PORT');
$DB_DATABASE = getenv('POSTGRES_DB');
$DB_USERNAME = getenv('PGADMIN_EMAIL');
$DB_PASSWORD = getenv('PGADMIN_PASSWORD');

$con = "host=$DB_HOST port=$DB_PORT dbname=$DB_DATABASE user=$DB_USERNAME password=$DB_PASSWORD";

try {
    $dbconn = pg_connect($con);

    if ($dbconn) {
        echo "Conexão ao PostgreSQL realizada com sucesso!";
    } else {
        echo "Falha ao conectar ao PostgreSQL.";
    }
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
