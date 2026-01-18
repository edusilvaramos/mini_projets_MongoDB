<?php

namespace App\Repository;

use App\Connection\Connection;
use MongoDB\BSON\ObjectId;
use \MongoDB\Collection as Collection;
use App\Model\Post;
use MongoDB\BSON\UTCDateTime;

final class PostRepository
{
    /* TACHES
        Ajouter tags dans create et update.
        Implémenter getComments avec aggregation.
        Implémenter findByTag pour filtrer par tag.
        Implementer si cest un brouillon ou publie;
     */
    private Collection $collection;

    public function __construct(Connection $connection)
    {
        $this->collection = $connection->selectCollection('post');
        $this->collection->createIndex(['authorId' => 1, 'createdAt' => -1]);
    }

    public function all(): array
    {
        return $this->collection->find([])->toArray();
    }

    
    public function find(string $id)
    {
        $doc = $this->collection->findOne(['_id' => new ObjectId($id)]);
        return $doc ? $doc->getArrayCopy() : null;
    }


    public function findByAuthor(string $authorId): ? array
    {
        $doc = $this->collection->find(['authorId' => new ObjectId($authorId)]);
        return $doc ? $doc->toArray() : null;
    }

    public function create(array $data): string
    {
        $res = $this->collection->insertOne([
            'title' => $data['title'],
            'content' => $data['content'],
            'category' => $data['category'],
            'authorId' => new ObjectId($data['authorId']),
            'createdAt' => new UTCDateTime(),
            'isPublished' => true,
            'likes' => 0,
            'views' => 0,
            'commentsCounter' => 0,

            //falta as tags e fazer rascunho
        ]);
        return (string)$res->getInsertedId();
    }

    public function update(string $id, array $data): void
    {
        $set = [
            'title' => $data['title'],
            'content'  => $data['content'],
        ];
        //fazer update das tags tb
        $this->collection->updateOne(['_id' => new ObjectId($id)], ['$set' => $set]);
    }

    public function delete(string $id): void
    {
        $this->collection->deleteOne(['_id' => new ObjectId($id)]);
    }

    public function getComments(string $postId)
    {
        //aggregation com os commentarios;
    }
   
    //Methode de Triage et Filtrage
    public function sortBy(string $sortingChoice, int $direction = -1, string $tag = 'all')
    {
        $pipeline = [];

        if ($tag !== 'all') {
            $pipeline[] = [
                '$match' => [
                    'tags' => $tag
                ]
            ];
        }

        $pipeline[] = ['$sort' => [$sortingChoice => $direction]];


        $pipeline = array_merge($pipeline, [
            ['$sort' => [$sortingChoice => $direction]],
            [
                '$lookup' => [
                    'from' => 'user',
                    'localField' => 'authorId',
                    'foreignField' => '_id',
                    'as' => 'author'
                ]
            ],
            [
                '$unwind' => [
                    'path' => '$author',
                    'preserveNullAndEmptyArrays' => true
                ]
            ]
        ]);
        $results = $this->collection->aggregate($pipeline)->toArray();

        return $results;
    }

    //Incrementation 
    public function incrementValue($id, $field)
    {
        $this->collection->updateOne(['_id' => new ObjectId($id)], ['$inc' => [$field => 1]]);
    }

    public function incrementLike($id) 
    {
        $this->incrementValue($id, 'likes');
    } 
    public function decreaseLike($id)
    {
        $this->collection->updateOne(['_id' => new ObjectId($id)], ['$inc' => ['likes' => -1]]);
    }
    public function increaseCommentsCounter($id) 
    {
        $this->incrementValue($id, 'commentsCounter');
    }
    public function increaseViews($id) 
    {
        $this->incrementValue($id, 'views');
    }

    public function findWithAuthor(string $postId)
    {
        $pipeline = [
            [
                '$match' => [
                    '_id' => new ObjectId($postId)
                ]
            ],
            [
                '$lookup' => [
                    'from' => 'user',           // users collection
                    'localField' => 'authorId', // post field
                    'foreignField' => '_id',    // user field
                    'as' => 'author'
                ]
            ],
            [
                '$unwind' => '$author'          // get single author object instead of array
            ]
        ];

        $result = $this->collection->aggregate($pipeline)->toArray();
        return $result[0];
    }



}
