<?php

declare(strict_types=1);

namespace WpThrubus\Transformers;

use WpThrubus\DTOs\GoogleMaps\InfoWindowContentDto;

final class JsonToInfoWindowContentDtoTransformer extends AbstractJsonTransformer
{

    /**
     * Transform single JSON string to InfoWindowContentDto
     * 
     * @return InfoWindowContentDto|null
     */
    public function transformJson(string $json): ?InfoWindowContentDto
    {

        if (!$this->validateJson($json)) {
            return null;
        }

        try {
            return $this->serializer->deserialize($json, InfoWindowContentDto::class, 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return null;
        }
    }


    /**
     * Transform single JSON string containing array to array of InfoWindowContentDto
     * 
     * @return InfoWindowContentDto[]
     */
    public function transformArrayJson(string $json): array
    {

        if (!$this->validateArrayJson($json)) {
            return [];
        }

        try {
            return $this->serializer->deserialize($json, InfoWindowContentDto::class . '[]', 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Transform JSON file content to array of InfoWindowContentDto
     * 
     * @return InfoWindowContentDto[]|InfoWindowContentDto|null
     */
    public function transformFileJson(string $filePath): array|null|InfoWindowContentDto
    {
        return $this->transformFromFile($filePath);
    }
}
