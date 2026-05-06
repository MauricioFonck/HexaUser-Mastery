<?php

declare(strict_types=1);

final class Connection
{
    private string $host;
    private int $port;
    private string $dbName;
    private string $user;
    private string $password;
    private string $charset;

    public function __construct(
        string $host = 'localhost',
        int $port = 3306,
        string $dbName = 'hexa_user_mastery',
        string $user = 'root',
        string $password = '',
        string $charset = 'utf8mb4'
    ) {
        $this->host     = $host;
        $this->port     = $port;
        $this->dbName   = $dbName;
        $this->user     = $user;
        $this->password = $password;
        $this->charset  = $charset;
    }

    public function createPdo(): PDO
    {
        $dsn = sprintf(
            'mysql:host=%s;port=%d;dbname=%s;charset=%s',
            $this->host,
            $this->port,
            $this->dbName,
            $this->charset
        );

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        return new PDO($dsn, $this->user, $this->password, $options);
    }
}
