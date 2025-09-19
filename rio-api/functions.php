<?php
class RioAPI{

    public function getPrimaryKeyColumn($database, $table){

    }
    
    public function setTenantId($tenant_id){

    }

}

trait RioAPIDatabase{
    private PDO $pdo;

    public function __construct(array $config) {
        $dsn = $this->buildDsn($config);
        $this->pdo = new PDO($dsn, $config['user'] ?? '', $config['pass'] ?? '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    private function buildDsn(array $config): string {
        $type = $config['type'] ?? 'mysql';
        switch ($type) {
            case 'mysql':
                return "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4";
            case 'pgsql':
                return "pgsql:host={$config['host']};dbname={$config['dbname']}";
            case 'sqlite':
                return "sqlite:{$config['path']}";
            default:
                throw new Exception("Unsupported database type: $type");
        }
    }

    public function query(string $sql, array $params = []): array {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function execute(string $sql, array $params = []): int {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->rowCount();
    }

    public function getPdo(): PDO {
        return $this->pdo;
    }
}