<?php

declare(strict_types=1);

namespace WpThrubus\Transformers;

use WpThrubus\DTOs\FastResponseDto;

final class JsonToFastResponseDtoTransformer extends AbstractJsonTransformer
{

    /**
     * Transform single JSON string to FastResponseDto
     * 
     * @return FastResponseDto|null
     */
    public function transformJson(string $json): ?FastResponseDto
    {

        if (!$this->validateJson($json)) {
            return null;
        }

        try {
            return $this->serializer->deserialize($json, FastResponseDto::class, 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return null;
        }
    }


    /**
     * Transform single JSON string containing array to array of FastResponseDto
     * 
     * @return FastResponseDto[]
     */
    public function transformArrayJson(string $json): array
    {

        if (!$this->validateArrayJson($json)) {
            return [];
        }

        try {
            return $this->serializer->deserialize($json, FastResponseDto::class . '[]', 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Transform JSON file content to array of FastResponseDto
     * 
     * @return FastResponseDto[]|FastResponseDto|null
     */
    public function transformFileJson(string $filePath): array|null|FastResponseDto
    {
        return $this->transformFromFile($filePath);
    }
}
