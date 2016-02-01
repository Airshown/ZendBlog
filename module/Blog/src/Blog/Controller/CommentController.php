<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Blog\Controller;

use Blog\Form\AddPostForm;
use Blog\Service\CommentService;
use Blog\Service\PostService;
use Zend\View\Model\ViewModel;

use Blog\Form\CommentForm;
use Blog\Entity\Comment;
use Blog\Form\EditPostForm;
use Blog\Entity\Post;

class CommentController extends CoreController
{
    /** @var  CommentService */
    private $commentService;

    /** @var  CommentForm */
    private $commentForm;

    /** @var  EditPostForm */
    private $editCommentForm;

    /** @var  AddPostForm */
    private $addCommentForm;

    public function __construct(CommentService $commentService, CommentForm $commentForm,
        EditCommentForm $editCommentForm, AddCommentForm $addCommentForm)
    {
        $this->postService    = $postService;
        $this->commentService = $commentService;
        $this->commentForm    = $commentForm;
        $this->editPostForm   = $editPostForm;
        $this->addPostForm    = $addPostForm;
    }

    public function indexAction()
    {
        $criteria = array();

        $page     = $this->params('page', 1);
        $post     = $this->params('post', null);
        $author   = $this->params('author', null);

        if ($post) {
            $criteria['post'] = $post;
        }

        if ($author) {
            $criteria['author'] = $author;
        }

        $comments = $this->commentService->getActiveComment($criteria);
        $comments->setItemCountPerPage(5)->setCurrentPageNumber($page);

        return new ViewModel(array(
            'comments'    => $comments,
            'post'        => (isset($criteria['post']) ? $criteria['post'] : null),
            'author'      => (isset($criteria['author']) ? $criteria['author'] : null),
        ));
    }
}
