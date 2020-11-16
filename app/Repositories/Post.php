<?php declare(strict_types=1);

namespace Bloganza\Repositories;

use Bloganza\Contracts;
use Bloganza\Entities;
use Bloganza\Mappers;

class Post implements Contracts\Repository {

    private $mapper;

    public function __construct(Mappers\Post $mapper) {
        $this->mapper = $mapper;
    }

    public function findById(int $id) {
        return $this->mapper->findById($id);
    }

    public function findBySlug(string $slug) {
        return $this->mapper->findBySlug($slug);
    }

    public function findAll() {
        return $this->mapper->findAll();
    }

    public function save(Entities\Post $post) {
        return $this->mapper->save($country);
    }

    public function delete(Entities\Post $post) {
        return $this->mapper->delete($country);
    }

}