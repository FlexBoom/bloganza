<?php declare(strict_types=1);

namespace Bloganza\Services;

use Bloganza\Contracts;

class Posts
{
    private $repository;

    public function __construct(Contracts\Repository $repository) {
        $this->repository = $repository;
    }

    public function getPost(int $id) {
        return $this->repository->findById($id);
    }
}
