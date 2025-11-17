<?php

namespace App\Repository;

use App\Connection\Connection;
use MongoDB\BSON\ObjectId;
use \MongoDB\Collection as Collection;

final class UserRepository
{
    private Collection $collection;

    public function __construct()
    {
        $this->collection = (new Connection())->selectCollection('user');
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

    public function findByEmail(string $email): ?array
    {
        $doc = $this->collection->findOne(['email' => mb_strtolower($email)]);
        return $doc ? $doc->getArrayCopy() : null;
    }

    public function findByUsername(string $username): ?array
    {
        $doc = $this->collection->findOne(['userName' => $username]);
        return $doc ? $doc->getArrayCopy() : null;
    }


    public function create(array $data): string
    {
        $res = $this->collection->insertOne([
            'firstname'    => $data['firstname'],
            'lastName'     => $data['lastName'],
            'userName'     => $data['username'],
            'email'        => mb_strtolower(trim($data['email'])),
            'passwordHash' => password_hash($data['password'], PASSWORD_DEFAULT),
        ]);
        return (string)$res->getInsertedId();
    }

    public function update(string $id, array $data): void
    {
        $set = [
            'firstname' => $data['firstname'],
            'lastName'  => $data['lastName'],
            'email'     => mb_strtolower(trim($data['email'])),
        ];
        if (!empty($data['password'])) {
            $set['passwordHash'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        $this->collection->updateOne(['_id' => new ObjectId($id)], ['$set' => $set]);
    }

    public function delete(string $id): void
    {
        $this->collection->deleteOne(['_id' => new ObjectId($id)]);
    }
}
