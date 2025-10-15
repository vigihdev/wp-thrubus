<?php

declare(strict_types=1);

namespace WpThrubus\Transformers;

use WpThrubus\DTOs\GoogleMaps\MarkerDto;

final class JsonToMarkerDtoTransformer extends AbstractJsonTransformer
{

    /**
     * Transform single JSON string to MarkerDto
     * 
     * @return MarkerDto|null
     */
    public function transformJson(string $json): ?MarkerDto
    {

        if (!$this->validateJson($json)) {
            return null;
        }

        try {
            return $this->serializer->deserialize($json, MarkerDto::class, 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return null;
        }
    }


    /**
     * Transform single JSON string containing array to array of MarkerDto
     * 
     * @return MarkerDto[]
     */
    public function transformArrayJson(string $json): array
    {

        if (!$this->validateArrayJson($json)) {
            return [];
        }

        try {
            return $this->serializer->deserialize($json, MarkerDto::class . '[]', 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Transform JSON file content to array of MarkerDto
     * 
     * @return MarkerDto[]|MarkerDto|null
     */
    public function transformFileJson(string $filePath): array|null|MarkerDto
    {
        return $this->transformFromFile($filePath);
    }
}
