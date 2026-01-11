<?php

namespace App\Repository;

use App\Connection\Connection;
use MongoDB\BSON\ObjectId;
use \MongoDB\Collection as Collection;
use App\Model\User;

final class UserRepository
{
    private Collection $collection;

    public function __construct(Connection $connection)
    {
        $this->collection = $connection->selectCollection('user');
    }

    private function hydrateUser($doc): User
    {
        $user = new User(
            $doc['firstName'],
            $doc['lastName'],
            $doc['userName'],
            $doc['email'],
            $doc['passwordHash'] ?? '',
            $doc['role'] ?? 'ROLE_USER',
            $doc['conectedAt'],
            $doc['isConnected']
        );
        $user->id = (string) $doc['_id'];

        return $user;
    }

    public function findAllUsers(): array
    {
        $users = $this->collection->find([]);
        $userList = [];
        // cada user no mongo e um objeto do tipo user
        foreach ($users as $doc) {
            $userList[] = $this->hydrateUser($doc);
        }

        return $userList;
    }

    public function findByID(string $id): ?User
    {
        $doc = $this->collection->findOne(['_id' => new ObjectId($id)]);
        if (!$doc) {
            return null;
        }
        return $this->hydrateUser($doc);
    }

    public function findByEmail(string $email): ?User
    {
        $doc = $this->collection->findOne(['email' => mb_strtolower($email)]);
        if (!$doc) {
            return null;
        }
        return $this->hydrateUser($doc);
    }

    public function findByuserName(string $userName): ?User
    {
        $doc = $this->collection->findOne(['userName' => $userName]);
        if (!$doc) {
            return null;
        }
        return $this->hydrateUser($doc);
    }

    public function createUser(array $data): User
    {
        $res = $this->collection->insertOne([
            'firstName'    => $data['firstName'],
            'lastName'     => $data['lastName'],
            'userName'     => $data['userName'],
            'email'        => mb_strtolower(trim($data['email'])),
            'passwordHash' => password_hash($data['passwordHash'], PASSWORD_DEFAULT),
            'role'         => $data['role'] ?? 'ROLE_USER',
            'conectedAt'   => date('d/m/Y H:i'),
            'isConnected'  => false
        ]);

        $insertedId = $res->getInsertedId();
        $doc = $this->collection->findOne(['_id' => $insertedId]);

        return $this->hydrateUser($doc);
    }

    public function update(string $id, array $data): void
    {
        $set = [
            'firstName' => $data['firstName'],
            'lastName'  => $data['lastName'],
            'userName'  => $data['userName'],
            'email'     => mb_strtolower(trim($data['email'])),
        ];
        // get new password if not empty
        if (!empty($data['passwordHash'])) {
            $set['passwordHash'] = password_hash($data['passwordHash'], PASSWORD_DEFAULT);
        }

        $this->collection->updateOne(
            ['_id' => new ObjectId($id)],
            ['$set' => $set]
        );
    }

    public function delete(string $id): void
    {
        $this->collection->deleteOne(['_id' => new ObjectId($id)]);
    }
    public function updateConnection(string $id, bool $isConnected): void
    {
        $set = ['isConnected' => $isConnected,];
        if ($isConnected) { $set['conectedAt'] = date('d/m/Y H:i');}

        $this->collection->updateOne(
            ['_id' => new ObjectId($id)],
            ['$set' => $set]
        );
    }

    // make one admin user
    public function ensureAdminUser(): void
    {
        $doc = $this->collection->findOne(['role' => 'ROLE_ADMIN']);
        if ($doc) {
            return;
        }

        $email = 'admin';
        $password = 'admin';

        $this->collection->insertOne([
            'firstName'    => 'Admin',
            'lastName'     => 'User',
            'userName'     => 'admin',
            'email'        => mb_strtolower(trim($email)),
            'passwordHash' => password_hash($password, PASSWORD_DEFAULT),
            'role'         => 'ROLE_ADMIN',
            'conectedAt'   => date('d/m/Y H:i'),
            'isConnected'  => false
        ]);
    }
}
