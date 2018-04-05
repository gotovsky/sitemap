<?php

namespace Skygsn\Sitemap\Validator;

class ValidationResultsBag
{
    /**
     * @var string[]
     */
    private $warnings = [];

    /**
     * @var string[]
     */
    private $errors = [];

    /**
     * @return string[]
     */
    public function getWarnings(): array
    {
        return $this->warnings;
    }

    /**
     * @return string[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    /**
     * @param string $error
     */
    public function addError(string $error)
    {
        $this->errors[] = $error;
    }

    /**
     * @param string $warning
     */
    public function addWarning(string $warning)
    {
        $this->warnings[] = $warning;
    }

    /**
     * @return void
     */
    public function clean()
    {
        $this->warnings = [];
        $this->errors = [];
    }
}