<?php

declare(strict_types=1);

namespace WpThrubus\Transformers;

use WpThrubus\DTOs\VehicleDto;

final class JsonToVehicleDtoTransformer extends AbstractJsonTransformer
{

    /**
     * Transform single JSON string to VehicleDto
     * 
     * @return VehicleDto|null
     */
    public function transformJson(string $json): ?VehicleDto
    {

        if (!$this->validateJson($json)) {
            return null;
        }

        try {
            return $this->serializer->deserialize($json, VehicleDto::class, 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return null;
        }
    }


    /**
     * Transform single JSON string containing array to array of VehicleDto
     * 
     * @return VehicleDto[]
     */
    public function transformArrayJson(string $json): array
    {

        if (!$this->validateArrayJson($json)) {
            return [];
        }

        try {
            return $this->serializer->deserialize($json, VehicleDto::class . '[]', 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Transform JSON file content to array of VehicleDto
     * 
     * @return VehicleDto[]|VehicleDto|null
     */
    public function transformFileJson(string $filePath): array|null|VehicleDto
    {
        return $this->transformFromFile($filePath);
    }
}
