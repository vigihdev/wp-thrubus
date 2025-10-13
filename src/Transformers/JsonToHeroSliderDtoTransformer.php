<?php

declare(strict_types=1);

namespace WpThrubus\Transformers;

use WpThrubus\DTOs\Hero\HeroSliderDto;

final class JsonToHeroSliderDtoTransformer extends AbstractJsonTransformer
{

    /**
     * Transform single JSON string to HeroSliderDto
     * 
     * @return HeroSliderDto|null
     */
    public function transformJson(string $json): ?HeroSliderDto
    {

        if (!$this->validateJson($json)) {
            return null;
        }

        try {
            return $this->serializer->deserialize($json, HeroSliderDto::class, 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return null;
        }
    }


    /**
     * Transform single JSON string containing array to array of HeroSliderDto
     * 
     * @return HeroSliderDto[]
     */
    public function transformArrayJson(string $json): array
    {

        if (!$this->validateArrayJson($json)) {
            return [];
        }

        try {
            return $this->serializer->deserialize($json, HeroSliderDto::class . '[]', 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Transform JSON file content to array of HeroSliderDto
     * 
     * @return HeroSliderDto[]|HeroSliderDto|null
     */
    public function transformFileJson(string $filePath): array|null|HeroSliderDto
    {
        return $this->transformFromFile($filePath);
    }
}
