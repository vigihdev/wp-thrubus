<?php

declare(strict_types=1);

namespace WpThrubus\Transformers;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;

abstract class AbstractJsonTransformer
{

    protected readonly Serializer $serializer;

    abstract public function transformJson(string $json): ?object;
    abstract public function transformArrayJson(string $json): array;

    public function __construct()
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [
            new ObjectNormalizer(),
            new ArrayDenormalizer()
        ];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    protected function isValidJson(string $json): bool
    {
        json_decode($json);
        return json_last_error() === JSON_ERROR_NONE;
    }

    protected function validateJson(string $json): bool
    {
        $json = trim($json);
        return substr($json, 0, 1) === '{' && substr($json, -1) === '}' && $this->isValidJson($json);
    }

    protected function validateArrayJson(string $json): bool
    {
        $json = trim($json);
        return substr($json, 0, 1) === '[' && substr($json, -1) === ']';
    }

    protected function transformFromFile(string $filePath): object|array
    {

        if (!file_exists($filePath)) {
            throw new \InvalidArgumentException("File not found: {$filePath}");
        }

        $jsonContent = file_get_contents($filePath);
        if ($this->validateJson($jsonContent)) {
            return $this->transformJson($jsonContent);
        } else if ($this->validateArrayJson($jsonContent)) {
            return $this->transformArrayJson($jsonContent);
        }
        throw new \InvalidArgumentException("Invalid Json File : {$filePath}");
    }

    protected function transformFileAsObject(string $filePath): ?object
    {
        if (!file_exists($filePath)) {
            throw new \InvalidArgumentException("File not found: {$filePath}");
        }

        $jsonContent = file_get_contents($filePath);
        if (!$this->validateJson($jsonContent)) {
            throw new \InvalidArgumentException("Invalid Json File : {$filePath}");
        }

        try {
            return $this->transformJson($jsonContent);
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return null;
        }
    }

    protected function transformFileAsArray(string $filePath): array
    {

        if (!file_exists($filePath)) {
            throw new \InvalidArgumentException("File not found: {$filePath}");
        }

        $jsonContent = file_get_contents($filePath);
        if (!$this->validateArrayJson($jsonContent)) {
            throw new \InvalidArgumentException("Invalid Json File : {$filePath}");
        }

        try {
            return $this->transformArrayJson($jsonContent);
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return [];
        }
    }
}
