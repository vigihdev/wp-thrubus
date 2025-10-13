<?php

declare(strict_types=1);

namespace WpThrubus\Transformers;

use WpThrubus\DTOs\Posts\PopularPostDto;

final class JsonToPopularPostDtoTransformer extends AbstractJsonTransformer
{

    /**
     * Transform single JSON string to PopularPostDto
     * 
     * @return PopularPostDto|null
     */
    public function transformJson(string $json): ?PopularPostDto
    {

        if (!$this->validateJson($json)) {
            return null;
        }

        try {
            return $this->serializer->deserialize($json, PopularPostDto::class, 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return null;
        }
    }


    /**
     * Transform single JSON string containing array to array of PopularPostDto
     * 
     * @return PopularPostDto[]
     */
    public function transformArrayJson(string $json): array
    {

        if (!$this->validateArrayJson($json)) {
            return [];
        }

        try {
            return $this->serializer->deserialize($json, PopularPostDto::class . '[]', 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Transform JSON file content to array of PopularPostDto
     * 
     * @return PopularPostDto[]|PopularPostDto|null
     */
    public function transformFileJson(string $filePath): array|null|PopularPostDto
    {
        return $this->transformFromFile($filePath);
    }
}
