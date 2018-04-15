<?php

namespace Skygsn\Sitemap\Storage;

use Skygsn\Sitemap\Exception\StorageException;

class FileSystemStorage implements Storage
{
    /**
     * @var string[]
     */
    private $usedNames = [];

    /**
     * @var string
     */
    private $directory;

    /**
     * @param string $directory
     */
    public function __construct(string $directory)
    {
        $this->directory = $directory;

        if (!is_dir($this->directory)) {
            throw new StorageException(sprintf('%s is not a directory', $this->directory));
        }

        if (!is_writable($this->directory)) {
            throw new StorageException(sprintf('Directory %s is not writable', $this->directory));
        }
    }

    /**
     * @param string $name
     * @param string $content
     * @return string
     */
    public function save(string $name, string $content): string
    {
        $name = $this->fetchCurrentName($name);
        $file = fopen(sprintf('%s/%s', $this->directory, $name), 'w+');

        fputs($file, $content);
        fclose($file);

        return $name;
    }

    /**
     * @param string $name
     * @return string
     */
    private function fetchCurrentName(string $name): string
    {
        if (empty($name)) {
            $name = 'urls';
        }

        if (in_array($name, $this->usedNames)) {
            $name = $name . count($this->usedNames);
            $this->usedNames[] = $name;
        }

        return sprintf('%s.xml', $name);
    }
}
