<?php declare(strict_types=1);

namespace Bloganza\Entities;

class Post
{
    private int $id;
    private string $slug;
    private string $title;
    private string $content;

    public function getId(int $id)
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getSlug(string $slug)
    {
        return $this->slug;
    }

    public function setSlug(string $slug)
    {
        $this->slug = $slug;
    }

    public function getTitle(string $title)
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getContent(string $content)
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }
}
