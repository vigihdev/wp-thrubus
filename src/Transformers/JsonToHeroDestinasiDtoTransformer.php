<?php

declare(strict_types=1);

namespace WpThrubus\Transformers;

use WpThrubus\DTOs\Hero\HeroDestinasiDto;

final class JsonToHeroDestinasiDtoTransformer extends AbstractJsonTransformer
{

    /**
     * Transform single JSON string to HeroDestinasiDto
     * 
     * @return HeroDestinasiDto|null
     */
    public function transformJson(string $json): ?HeroDestinasiDto
    {

        if (!$this->validateJson($json)) {
            return null;
        }

        try {
            return $this->serializer->deserialize($json, HeroDestinasiDto::class, 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return null;
        }
    }


    /**
     * Transform single JSON string containing array to array of HeroDestinasiDto
     * 
     * @return HeroDestinasiDto[]
     */
    public function transformArrayJson(string $json): array
    {

        if (!$this->validateArrayJson($json)) {
            return [];
        }

        try {
            return $this->serializer->deserialize($json, HeroDestinasiDto::class . '[]', 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Transform JSON file content to array of HeroDestinasiDto
     * 
     * @return HeroDestinasiDto[]|HeroDestinasiDto|null
     */
    public function transformFileJson(string $filePath): array|null|HeroDestinasiDto
    {
        return $this->transformFromFile($filePath);
    }
}
