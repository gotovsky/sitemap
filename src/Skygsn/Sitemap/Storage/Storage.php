<?php

namespace Skygsn\Sitemap\Storage;

interface Storage
{
    /**
     * @param string $name
     * @param string $content
     */
    public function save(string $name, string $content);
}