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
        string $host = 'db',
        int $port = 3306,
        string $dbName = 'hexa_user_mastery',
        string $user = 'root',
        string $password = 'secret',
        string $charset = 'utf8mb4'
    ) {
        $this->host     = getenv('DB_HOST') ?: $host;
        $this->port     = (int)(getenv('DB_PORT') ?: $port);
        $this->dbName   = getenv('DB_NAME') ?: $dbName;
        $this->user     = getenv('DB_USER') ?: $user;
        $this->password = getenv('DB_PASS') ?: $password;
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
