<?php

namespace Blog\Service;

use Blog\Entity\Comment;
use Blog\Entity\Post;
use Blog\Repository\CommentRepository;
use Doctrine\Common\Persistence\ObjectManager;

class CommentService
{

    /** @var ObjectManager */
    private $em;

    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
    }

    public function addComment(Comment $comment, Post $post)
    {
        $comment->setPost($post);

        $this->em->persist($comment);
        $this->em->flush($comment);
    }

    public function getCommentBySlug($slug)
    {
        return $this->getRepository()->findOneBy(array(
                'slug' => $slug,
            ));
    }

    public function getCommentById($id)
    {
        return $this->getRepository()->findOneBy(array('id' => $id));
    }

    public function getLastComment()
    {
        return $this->getRepository()->findLastPost();
    }

    public function updateComment(Comment $comment)
    {
        if (!$post->getSlug()) {
            $post->setSlug(str_replace(' ', '-', strtolower($comment->getName())));
        }

        $this->em->flush($comment);

        $this->cacheService->generateCache($this);
    }

    public function deletePost(Comment $comment)
    {
        $this->em->remove($comment);
        $this->em->flush($comment);

        $this->cacheService->generateCache($this);
    }

    /**
     * @return CommentRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository('Blog\Entity\Comment');
    }
}
