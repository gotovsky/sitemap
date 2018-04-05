<?php

namespace Skygsn\Sitemap\Storage;

interface Storage
{
    /**
     * @param string $name
     * @param string $content
     * @return string
     */
    public function save(string $name, string $content): string;
}