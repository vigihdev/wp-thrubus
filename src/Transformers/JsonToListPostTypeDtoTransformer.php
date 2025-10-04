<?php

declare(strict_types=1);

namespace WpThrubus\Transformers;

use WpThrubus\DTOs\ListPostTypeDto;

final class JsonToListPostTypeDtoTransformer extends AbstractJsonTransformer
{

    /**
     * Transform single JSON string to ListPostTypeDto
     * 
     * @return ListPostTypeDto|null
     */
    public function transformJson(string $json): ?ListPostTypeDto
    {

        if (!$this->validateJson($json)) {
            return null;
        }

        try {
            return $this->serializer->deserialize($json, ListPostTypeDto::class, 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return null;
        }
    }


    /**
     * Transform single JSON string containing array to array of ListPostTypeDto
     * 
     * @return ListPostTypeDto[]
     */
    public function transformArrayJson(string $json): array
    {

        if (!$this->validateArrayJson($json)) {
            return [];
        }

        try {
            return $this->serializer->deserialize($json, ListPostTypeDto::class . '[]', 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Transform JSON file content to array of ListPostTypeDto
     * 
     * @return ListPostTypeDto[]|ListPostTypeDto|null
     */
    public function transformFileJson(string $filePath): array|null|ListPostTypeDto
    {
        return $this->transformFromFile($filePath);
    }
}
