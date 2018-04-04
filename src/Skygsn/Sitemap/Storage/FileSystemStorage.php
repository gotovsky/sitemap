<?php

namespace Skygsn\Sitemap\Storage;

use Skygsn\Sitemap\Exception\StorageException;

class FileSystemStorage implements Storage
{
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
     */
    public function save(string $name, string $content)
    {
        $file = fopen(dirname($_SERVER['SCRIPT_FILENAME']) . '/../web/sitemap/' . $name . '.xml', 'w+');
        fputs($file, $content);
        fclose($file);
    }
}
