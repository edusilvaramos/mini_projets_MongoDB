<?php

namespace App\Repository;

use App\Connection\Connection;
use MongoDB\BSON\ObjectId;
use MongoDB\Collection;

class AdminRepository
{
    private Collection $user;
    private Collection $posts;
    private Collection $comments;
    private Collection $likes;

    public function __construct(Connection $connection)
    {
        // get the collections from mongo
        $this->user = $connection->selectCollection('user');
        $this->posts = $connection->selectCollection('posts');
        $this->comments = $connection->selectCollection('comments');
        $this->likes = $connection->selectCollection('likes');
    }

    // get global stats for admin dashboard
    public function getGlobalStats(): array
    {
        return [
            'totalUsers' => $this->user->countDocuments([]),
            'totalPosts' => $this->posts->countDocuments([]),
            'totalComments' => $this->comments->countDocuments([]),
            'totalLikes' => $this->likes->countDocuments([])
        ];
    }
    public function userGlobalStats(string $userId): array
    {
        $userObjectId = new ObjectId($userId);

        $postsCount = $this->posts->countDocuments(['authorId' => $userObjectId]);
        $commentsCount = $this->comments->countDocuments(['authorId' => $userObjectId]);
        $likesGiven = $this->likes->countDocuments(['userId' => $userObjectId]);

        $cursor = $this->likes->aggregate([
            [
                '$lookup' => [
                    'from' => $this->posts->getCollectionName(),
                    'localField' => 'postId',
                    'foreignField' => '_id',
                    'as' => 'post',
                ],
            ],
            ['$unwind' => '$post'],
            [
                '$match' => [
                    'post.authorId' => $userObjectId,
                ],
            ],
            [
                '$group' => [
                    '_id'   => null,
                    'total' => ['$sum' => 1],
                ],
            ],
        ]);

        $result = current(iterator_to_array($cursor, false)) ?: null;
        $likesReceived = $result['total'] ?? 0;

        return [
            'postsCount' => $postsCount,
            'commentsCount' => $commentsCount,
            'likesGiven' => $likesGiven,
            'likesReceived' => $likesReceived,
        ];
    }


    public function userPostsStats(string $userId): array
    {
        $userObjectId = new ObjectId($userId);

        $cursor = $this->posts->aggregate([
            [
                '$match' => [
                    'authorId' => $userObjectId,
                ],
            ],
            [
                '$lookup' => [
                    'from' => $this->comments->getCollectionName(),
                    'localField' => '_id',
                    'foreignField' => 'postId',
                    'as' => 'comments',
                ],
            ],
            [
                '$lookup' => [
                    'from' => $this->likes->getCollectionName(),
                    'localField' => '_id',
                    'foreignField' => 'postId',
                    'as' => 'likes',
                ],
            ],
            [
                '$addFields' => [
                    'commentsCount' => ['$size' => '$comments'],
                    'likesCount' => ['$size' => '$likes'],
                    'participants'  => [
                        '$setUnion' => [
                            ['$authorId'],
                            '$comments.authorId',
                            '$likes.userId',
                        ],
                    ],
                ],
            ],
            [
                '$addFields' => [
                    'participantsCount' => ['$size' => '$participants'],
                ],
            ],
            [
                '$project' => [
                    'title' => 1,
                    'commentsCount' => 1,
                    'likesCount' => 1,
                    'participantsCount' => 1,
                ],
            ],
        ]);

        return iterator_to_array($cursor, false);
    }
}
