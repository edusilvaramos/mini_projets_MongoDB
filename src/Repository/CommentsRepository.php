<?php

namespace App\Repository;

use App\Connection\Connection;
use MongoDB\BSON\ObjectId;
use MongoDB\Collection as Collection;
use MongoDB\BSON\UTCDateTime;

final class CommentsRepository
{
    private Collection $collection;

    public function __construct()
    {
        $this->collection = (new Connection())->selectCollection('comments');
        $this->collection->createIndex(['postId' => 1]);
    }

    public function all(): array
    {
        return $this->collection->find([])->toArray();
    }

    public function find(string $id): ?array
    {
        $doc = $this->collection->findOne(['_id' => new ObjectId($id)]);
        return $doc ? $doc->getArrayCopy() : null;
    }

    public function userId(string $id): ObjectId
    {
        return new ObjectId($id);
    }

     public function update(string $id, array $data): void
    {
        $set = [
            'comment' => $data['comment'],
        ];
        $this->collection->updateOne(['_id' => new ObjectId($id)], ['$set' => $set]);
    }

    public function create(array $data): string
    {
        $res = $this->collection->insertOne([

            "comment" => $data['comment'],
            "createdAt" => new UTCDateTime(),
            "userId" => new ObjectId($data['userId']),
            "postId" => new ObjectId($data['postId']),

        ]);
        return (string)$res->getInsertedId();
    }
    // fix somente autor pode deletar ou editar 
    public function delete(string $id): void
    {
        $this->collection->deleteOne(['_id' => new ObjectId($id)]);
    }

    // add get repilies

    // add likes 

}
