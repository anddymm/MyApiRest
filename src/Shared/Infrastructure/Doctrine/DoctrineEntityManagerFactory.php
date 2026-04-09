<?php
namespace App\Shared\Infrastructure\Doctrine;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class DoctrineEntityManagerFactory {
    public static function create(): EntityManager {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: [__DIR__ . '/../../../'],
            isDevMode: (getenv('APP_ENV') ?: 'development') !== 'production',
            proxyDir: sys_get_temp_dir() . '/doctrine-proxies',
        );

        $connection = DriverManager::getConnection([
            'driver'   => 'pdo_mysql',
            'host'     => getenv('DB_HOST')     ?: 'localhost',
            'dbname'   => getenv('DB_NAME')     ?: 'hotel',
            'user'     => getenv('DB_USER')     ?: 'root',
            'password' => getenv('DB_PASS') ?: '',
            'charset'  => 'utf8mb4',
        ]);

        return new EntityManager($connection, $config);
    }
}
