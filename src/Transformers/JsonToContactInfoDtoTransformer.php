<?php

declare(strict_types=1);

namespace WpThrubus\Transformers;

use WpThrubus\DTOs\ContactInfoDto;

final class JsonToContactInfoDtoTransformer extends AbstractJsonTransformer
{

    /**
     * Transform single JSON string to ContactInfoDto
     * 
     * @return ContactInfoDto|null
     */
    public function transformJson(string $json): ?ContactInfoDto
    {

        if (!$this->validateJson($json)) {
            return null;
        }

        try {
            return $this->serializer->deserialize($json, ContactInfoDto::class, 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return null;
        }
    }


    /**
     * Transform single JSON string containing array to array of ContactInfoDto
     * 
     * @return ContactInfoDto[]
     */
    public function transformArrayJson(string $json): array
    {

        if (!$this->validateArrayJson($json)) {
            return [];
        }

        try {
            return $this->serializer->deserialize($json, ContactInfoDto::class . '[]', 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Transform JSON file content to array of ContactInfoDto
     * 
     * @return ContactInfoDto[]|ContactInfoDto|null
     */
    public function transformFileJson(string $filePath): array|null|ContactInfoDto
    {
        return $this->transformFromFile($filePath);
    }
}
