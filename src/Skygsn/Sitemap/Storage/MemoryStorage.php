<?php

namespace Skygsn\Sitemap\Storage;

class MemoryStorage implements Storage
{
    /**
     * @var resource
     */
    private $resource;

    /**
     * @param string $name
     * @param string $content
     */
    public function save(string $name, string $content)
    {
        $this->resource = fopen('php://temp', 'r+');
        fwrite($this->resource, $content);
        rewind($this->resource);
    }

    /**
     * @return void
     */
    public function clean()
    {
        if (is_resource($this->resource)) {
            fclose($this->resource);
        }
    }

    /**
     * @return resource
     */
    public function getResource()
    {
        return $this->resource;
    }
}