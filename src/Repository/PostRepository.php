<?php

namespace App\Repository;

use App\Connection\Connection;
use MongoDB\BSON\ObjectId;
use \MongoDB\Collection as Collection;
use App\Model\Post;

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

    public function find(string $id): ? array
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
            'createdAt' => date('d/m/Y H:i'),
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
   

    //Methodes de Triage
    public function sortRecent() 
    {
        return $this->collection->find([])->sort(['createdAt' => -1])->toArray();
    }

    public function sortMostLiked() 
    {
        return $this->collection->find([])->sort(['likes' => -1])->toArray();
    }
    public function sortMostViewed() 
    {
        return $this->collection->find([])->sort(['views' => -1])->toArray();
    }

    public function sortMostCommented() 
    {
        return $this->collection->find([])->sort(['commentsCounter' => -1])->toArray();
    }

    public function reverse($postArray) 
    {
        return array_reverse($postArray);
    }

    //Methode de Filtrage
    public function findByTag() 
    {

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
}
