<?php

declare(strict_types=1);

namespace WpThrubus\Transformers;

use WpThrubus\DTOs\GoogleMaps\LatLngDto;

final class JsonToLatLngDtoTransformer extends AbstractJsonTransformer
{

    /**
     * Transform single JSON string to ContactInfoDto
     * 
     * @return LatLngDto|null
     */
    public function transformJson(string $json): ?LatLngDto
    {

        if (!$this->validateJson($json)) {
            return null;
        }

        try {
            return $this->serializer->deserialize($json, LatLngDto::class, 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return null;
        }
    }


    /**
     * Transform single JSON string containing array to array of ContactInfoDto
     * 
     * @return LatLngDto[]
     */
    public function transformArrayJson(string $json): array
    {

        if (!$this->validateArrayJson($json)) {
            return [];
        }

        try {
            return $this->serializer->deserialize($json, LatLngDto::class . '[]', 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Transform JSON file content to array of ContactInfoDto
     * 
     * @return LatLngDto[]|LatLngDto|null
     */
    public function transformFileJson(string $filePath): array|null|LatLngDto
    {
        return $this->transformFromFile($filePath);
    }
}
