<?php declare(strict_types=1);

namespace Bloganza\Contracts;

use Bloganza\Entities;

interface Repository {

    public function findById(int $id);

    public function findBySlug(string $slug);

    public function findAll();

    public function save(Entities\Post $post);

    public function delete(Entities\Post $post);
}
