<?php

namespace App\Repository;

use App\Connection\Connection;
use MongoDB\BSON\ObjectId;
use MongoDB\Collection as Collection;
use MongoDB\BSON\UTCDateTime;

final class CommentsRepository
{
    private Collection $collection;

    public function __construct(Connection $connection)
    {
        $this->collection = $connection->selectCollection('comments');
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

    public function findByPost(string $postId)
    {
        $comments = $this->collection->find(['postId' => new ObjectId($postId)])->toArray();
        return $comments;
    }

    public function userId(string $id): ObjectId
    {
        return new ObjectId($id);
    }

     public function update(string $id, array $data): void
    {
        $set = [
            'title' => $data['title'],
            'content' => $data['contnet'],
        ];
        $this->collection->updateOne(['_id' => new ObjectId($id)], ['$set' => $set]);
    }

    public function create(array $data): string
    {
        $res = $this->collection->insertOne([
            "content" => $data['content'],
            "createdAt" => new UTCDateTime(),
            "userId" => new ObjectId($data['userId']),
            "postId" => new ObjectId($data['postId']),
            'parentId' => isset($data['parentId']) && $data['parentId'] ? new ObjectId($data['parentId']) : null,
            'likes' => 0,
        ]);
        return (string)$res->getInsertedId();
    }

    public function like(string $id): void
    {
        $this->collection->updateOne(['_id' => new ObjectId($id)], ['$inc' => ['likes' => 1]]);
    }

    // fix somente autor pode deletar ou editar
    public function delete(string $id): void
    {
        $this->collection->deleteOne(['_id' => new ObjectId($id)]);
    }

    // add get repilies

    // add likes

}
