<?php

declare(strict_types=1);

namespace WpThrubus\Transformers;

use WpThrubus\DTOs\Posts\RecentPostDto;

final class JsonToRecentPostDtoTransformer extends AbstractJsonTransformer
{

    /**
     * Transform single JSON string to RecentPostDto
     * 
     * @return RecentPostDto|null
     */
    public function transformJson(string $json): ?RecentPostDto
    {

        if (!$this->validateJson($json)) {
            return null;
        }

        try {
            return $this->serializer->deserialize($json, RecentPostDto::class, 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return null;
        }
    }


    /**
     * Transform single JSON string containing array to array of RecentPostDto
     * 
     * @return RecentPostDto[]
     */
    public function transformArrayJson(string $json): array
    {

        if (!$this->validateArrayJson($json)) {
            return [];
        }

        try {
            return $this->serializer->deserialize($json, RecentPostDto::class . '[]', 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Transform JSON file content to array of RecentPostDto
     * 
     * @return RecentPostDto[]|RecentPostDto|null
     */
    public function transformFileJson(string $filePath): array|null|RecentPostDto
    {
        return $this->transformFromFile($filePath);
    }
}
