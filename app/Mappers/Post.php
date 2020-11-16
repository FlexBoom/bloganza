<?php declare(strict_types=1);

namespace Bloganza\Mappers;

use Bloganza\Entities;
use Bloganza\Contracts;

class Post implements Contracts\Repository
{
    private $adapter;

    public function __construct(Contracts\Adapter $adapter) {
        $this->adapter = $adapter;
    }

    public function findById(int $id) {
        $sql = "SELECT * FROM posts WHERE id = :id";
        $bindings = [':id' => $id];

        return $this->adapter->find($sql, $bindings);
    }

    public function findBySlug(string $slug) {
        $sql = "SELECT * FROM posts WHERE slug = :slug";
        $bindings = [':slug' => $slug];

        return $this->adapter->find($sql, $bindings);
    }

    public function findAll() {
        $sql = "SELECT * FROM posts";

        return $this->adapter->find($sql);
    }

    public function save(Entities\Post $post) {
        $sql = "SELECT * FROM posts WHERE slug = :slug";
        $bindings = [':slug' => $slug];

        return $this->adapter->save($country);
    }

    public function delete(Entities\Post $post) {
        $sql = "DELETE FROM posts WHERE id = :id";
        $bindings = [':slug' => $post->id];

        return $this->adapter->delete($sql, $bindings);
    }
}
