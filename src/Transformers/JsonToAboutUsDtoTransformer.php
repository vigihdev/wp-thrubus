<?php

declare(strict_types=1);

namespace WpThrubus\Transformers;

use WpThrubus\DTOs\AboutUsDto;

final class JsonToAboutUsDtoTransformer extends AbstractJsonTransformer
{

    /**
     * Transform single JSON string to ContactInfoDto
     * 
     * @return AboutUsDto|null
     */
    public function transformJson(string $json): ?AboutUsDto
    {

        if (!$this->validateJson($json)) {
            return null;
        }

        try {
            return $this->serializer->deserialize($json, AboutUsDto::class, 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return null;
        }
    }


    /**
     * Transform single JSON string containing array to array of ContactInfoDto
     * 
     * @return AboutUsDto[]
     */
    public function transformArrayJson(string $json): array
    {

        if (!$this->validateArrayJson($json)) {
            return [];
        }

        try {
            return $this->serializer->deserialize($json, AboutUsDto::class . '[]', 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Transform JSON file content to array of ContactInfoDto
     * 
     * @return AboutUsDto[]|AboutUsDto|null
     */
    public function transformFileJson(string $filePath): array|null|AboutUsDto
    {
        return $this->transformFromFile($filePath);
    }
}
