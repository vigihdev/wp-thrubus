```php
use WpThrubus\DTOs\ListPostTypeDto;
use WpThrubus\DTOs\VehicleDto;
use WpThrubus\Factory\JsonTransformerFactory;
use WpThrubus\Transformers\JsonToListPostTypeDtoTransformer;

$jsonData = '
    {
        "title": "Sewa Mobil",
        "snippet": "Sewa Mobil Gannet Trans menyediakan berbagai pilihan mobil, dari mobil city car hingga mobil mewah, dengan harga sewa yang terjangkau dan layanan profesional untuk berbagai keperluan perjalanan.",
        "imageUrl": "/images/layanan-kami/sewa-mobil.png",
        "actionUrl": ""
    }
';

$factory = JsonTransformerFactory::create(ListPostTypeDto::class);
/** @var ListPostTypeDto $model  */
$model = $factory->transformJson($jsonData);

$file = __DIR__ . '/stroge/data/json/list-post-type.json';
$transformer = new JsonToListPostTypeDtoTransformer();
$result = $transformer->transformJson($jsonData);
$results = $transformer->transformFileJson($file);

echo "=== TRANSFORM RESULT ===<br>";
echo "Total items: " . count($results) . "<br><br>";

foreach ($results as $index => $dto) {
    echo "Item " . ($index + 1) . ":<br>";
    echo "  Title: " . $dto->getTitle() . "<br>";
    echo "  Image: " . $dto->getImageUrl() . "<br>";
    echo "  Action: " . ($dto->getActionUrl() ?: 'N/A') . "<br>";
    echo "  Snippet: " . substr($dto->getSnippet(), 0, 50) . "...<br>";
    echo "  --------------------<br>";
}

```
