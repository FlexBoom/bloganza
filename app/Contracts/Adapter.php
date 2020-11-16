<?php declare(strict_types=1);

namespace Bloganza\Contracts;

interface Adapter {

    public function find(string $sql, array $bindings = [], int $fetchMode = PDO::FETCH_ASSOC);

    public function save(string $sql, array $bindings = []);

    public function delete(string $sql, array $bindings = []);
}
