<?php

declare(strict_types=1);

namespace WpThrubus\Factory;

use WpThrubus\Transformers\AbstractJsonTransformer;

final class JsonTransformerFactory
{

    public static function create(string $dtoClass): AbstractJsonTransformer
    {
        return new class($dtoClass) extends AbstractJsonTransformer {

            public function __construct(private string $dtoClass)
            {
                parent::__construct();
            }

            public function transformJson(string $json): ?object
            {
                return $this->serializer->deserialize($json, $this->dtoClass, 'json');
            }

            public function transformArrayJson(string $json): array
            {
                return $this->serializer->deserialize($json, $this->dtoClass . '[]', 'json');
            }
        };
    }
}
