<?php

declare(strict_types=1);

namespace WpThrubus\Transformers;

use WpThrubus\DTOs\ReviewCustomerDto;

final class JsonToReviewCustomerDtoTransformer extends AbstractJsonTransformer
{

    /**
     * Transform single JSON string to ReviewCustomerDto
     * 
     * @return ReviewCustomerDto|null
     */
    public function transformJson(string $json): ?ReviewCustomerDto
    {

        if (!$this->validateJson($json)) {
            return null;
        }

        try {
            return $this->serializer->deserialize($json, ReviewCustomerDto::class, 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return null;
        }
    }


    /**
     * Transform single JSON string containing array to array of ReviewCustomerDto
     * 
     * @return ReviewCustomerDto[]
     */
    public function transformArrayJson(string $json): array
    {

        if (!$this->validateArrayJson($json)) {
            return [];
        }

        try {
            return $this->serializer->deserialize($json, ReviewCustomerDto::class . '[]', 'json');
        } catch (\Throwable $e) {
            error_log("Failed to deserialize: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Transform JSON file content to array of ReviewCustomerDto
     * 
     * @return ReviewCustomerDto[]|ReviewCustomerDto|null
     */
    public function transformFileJson(string $filePath): array|null|ReviewCustomerDto
    {
        return $this->transformFromFile($filePath);
    }
}
