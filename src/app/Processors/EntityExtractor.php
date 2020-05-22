<?php

namespace App\Processors;

use App\Prototypes\Entity\EntityType;
use Arr;

/**
 * Class EntityExtractor
 * @package App\Processors
 */
class EntityExtractor
{
    protected string $string;

    const HASHTAG_REGEX = '/(?!\s)#([a-zA-Z0-9ぁ-んァ-ヶー一-龠０-９]\w*)\b/u';
    const MENTIONS_REGEX = '/(?=[^\w!]|[ぁ-んァ-ヶー一-龠０-９])@(\w+)\b/u';

    /**
     * EntityExtractor constructor.
     * @param $string
     */
    public function __construct($string)
    {
        $this->string = $string;
    }

    public function getAllEntities(): array
    {
        return array_merge(
            $this->getHashtagEntities(),
            $this->getMentionEntities()
        );
    }

    protected function getHashtagEntities(): array
    {
        return $this->buildEntityCollection(
            $this->match(self::HASHTAG_REGEX),
            EntityType::HASHTAG
        );
    }

    protected function getMentionEntities(): array
    {
        return $this->buildEntityCollection(
            $this->match(self::MENTIONS_REGEX),
            EntityType::MENTION
        );
    }

    protected function buildEntityCollection(array $entities, string $type): array
    {
        return array_map(function ($entity, $index) use ($entities, $type) {
            return [
                'body'       => $body = Arr::first($entity),
                'body_plain' => Arr::first($entities[1][$index]),
                'start'      => $start = $entity[1],
                'end'        => $start + strlen($body),
                'type'       => $type
            ];
        }, Arr::first($entities), array_keys(Arr::first($entities)));
    }

    protected function match(string $pattern): array
    {
        preg_match_all($pattern, $this->string, $matches, PREG_OFFSET_CAPTURE);

        return $matches;
    }
}
