<?php

namespace App\Repository;

use App\Connection\Connection;
use MongoDB\Collection;

class FeaturesRepository
{
    private Collection $features;

    public function __construct(Connection $connection)
    {
        $this->features = $connection->selectCollection('features');
    }

    public function findAll(): array
    {
        $cursor = $this->features->find([], ['sort' => ['id' => 1]]);
        return iterator_to_array($cursor, false);
    }

    public function create(array $data): void
    {
        $lastFeature = $this->features->findOne([], ['sort' => ['id' => -1]]);
        $nextId = $lastFeature ? ($lastFeature['id'] + 1) : 1;

        $this->features->insertOne([
            'id' => $nextId,
            'name' => $data['name'] ?? '',
            'description' => $data['description'] ?? '',
            'category' => $data['category'] ?? '',
            'status' => $data['status'] ?? 'Non développée',
        ]);
    }
    public function delete(int $id): void
    {
        $this->features->deleteOne(['id' => $id]);
    }

}
