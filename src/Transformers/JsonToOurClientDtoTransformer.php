<?php

declare(strict_types=1);

namespace WpThrubus\Transformers;

use WpThrubus\DTOs\OurClientDto;

final class JsonToOurClientDtoTransformer extends AbstractJsonTransformer
{

    /**
     * Transform single JSON string to OurClientDto
     * 
     * @return OurClientDto|null
     */
    public function transformJson(string $json): ?OurClientDto
    {

        if (!$this->validateJson($json)) {
            return null;
        }

        try {
            return $this->serializer->deserialize($json, OurClientDto::class, 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return null;
        }
    }


    /**
     * Transform single JSON string containing array to array of OurClientDto
     * 
     * @return OurClientDto[]
     */
    public function transformArrayJson(string $json): array
    {

        if (!$this->validateArrayJson($json)) {
            return [];
        }

        try {
            return $this->serializer->deserialize($json, OurClientDto::class . '[]', 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Transform JSON file content to array of OurClientDto
     * 
     * @return OurClientDto[]|OurClientDto|null
     */
    public function transformFileJson(string $filePath): array|null|OurClientDto
    {
        return $this->transformFromFile($filePath);
    }
}