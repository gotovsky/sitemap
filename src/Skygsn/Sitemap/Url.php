<?php

namespace Skygsn\Sitemap;

class Url
{
    /**
     * @var string
     */
    private $location;

    /**
     * @var string
     */
    private $lastModified;

    /**
     * @var string
     */
    private $changeFrequency;

    /**
     * @var float
     */
    private $priority;

    /**
     * @param string $location
     * @param string $lastModified
     * @param string $changeFrequency
     * @param float $priority
     */
    public function __construct($location, $lastModified, $changeFrequency = 'weekly', $priority = 0.5)
    {
        $this->location = $location;
        $this->lastModified = $lastModified;
        $this->changeFrequency = $changeFrequency;
        $this->priority = $priority;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return string
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * @return string
     */
    public function getChangeFrequency()
    {
        return $this->changeFrequency;
    }

    /**
     * @return float
     */
    public function getPriority()
    {
        return $this->priority;
    }
}