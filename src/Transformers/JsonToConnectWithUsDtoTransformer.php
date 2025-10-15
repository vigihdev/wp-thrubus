<?php

declare(strict_types=1);

namespace WpThrubus\Transformers;

use WpThrubus\DTOs\ConnectWithUsDto;

final class JsonToConnectWithUsDtoTransformer extends AbstractJsonTransformer
{

    /**
     * Transform single JSON string to ContactInfoDto
     * 
     * @return ConnectWithUsDto|null
     */
    public function transformJson(string $json): ?ConnectWithUsDto
    {

        if (!$this->validateJson($json)) {
            return null;
        }

        try {
            return $this->serializer->deserialize($json, ConnectWithUsDto::class, 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return null;
        }
    }


    /**
     * Transform single JSON string containing array to array of ContactInfoDto
     * 
     * @return ConnectWithUsDto[]
     */
    public function transformArrayJson(string $json): array
    {

        if (!$this->validateArrayJson($json)) {
            return [];
        }

        try {
            return $this->serializer->deserialize($json, ConnectWithUsDto::class . '[]', 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Transform JSON file content to array of ContactInfoDto
     * 
     * @return ConnectWithUsDto[]|ConnectWithUsDto|null
     */
    public function transformFileJson(string $filePath): array|null|ConnectWithUsDto
    {
        return $this->transformFromFile($filePath);
    }
}
