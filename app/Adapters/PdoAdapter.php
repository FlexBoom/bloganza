<?php declare(strict_types=1);

namespace Bloganza\Adapters;

use Bloganza\Contracts;
use PDO;

class PdoAdapter implements Contracts\Adapter {

    private $connection;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    public function find(string $sql, array $bindings = [], int $fetchMode = PDO::FETCH_ASSOC) {
        $statement = $this->connection->prepare($sql);
        $statement->execute($bindings);

        return $statement->fetchAll($fetchMode);
    }

    public function save(string $sql, array $bindings = []) {
        $statement = $this->connection->prepare($sql);
        $statement->execute($bindings);
    }

    public function delete(string $sql, array $bindings = []) {
        $statement = $this->connection->prepare($sql);
        $statement->execute($bindings);
    }
}
