<?php

/**
 * {project-name}
 *
 * @author {author-name}
 */
declare(strict_types=1);

namespace App\Controller;

use App\Annotation\Route;
use App\Database\Post;
use App\Filter\CommentFilter;
use App\Repository\PostRepository;
use App\View\PostGrid;
use App\View\PostView;
use Psr\Http\Message\ResponseInterface;
use Spiral\Core\Container\SingletonInterface;
use Spiral\DataGrid\GridFactory;
use Spiral\Http\Exception\ClientException\NotFoundException;
use Spiral\Prototype\Traits\PrototypeTrait;

class PostController implements SingletonInterface
{
    use PrototypeTrait;

    /** @var PostView */
    private $postView;

    /** @var PostRepository */
    private $posts;

    /** @var PostGrid */
    private $postGrid;

    /**
     * @param PostView       $postView
     * @param PostRepository $posts
     * @param PostGrid       $postGrid
     */
    public function __construct(PostView $postView, PostRepository $posts, PostGrid $postGrid)
    {
        $this->postGrid = $postGrid;
        $this->posts = $posts;
        $this->postView = $postView;
    }

    /**
     * @Route(action="/posts", verbs={"GET"})
     * @param GridFactory $grids
     * @return string
     */
    public function all(GridFactory $grids): string
    {
        $grid = $grids->create($this->posts->findAllWithAuthor(), $this->postGrid);

        return $this->views->render('posts', ['posts' => $grid]);
    }

    /**
     * @Route(action="/post/<id:\d+>", verbs={"GET"})
     * @param string $id
     * @return string
     */
    public function view(string $id): string
    {
        $post = $this->posts->findOneWithComments($id);
        if ($post === null) {
            throw new NotFoundException();
        }

        return $this->views->render('post', ['post' => $post]);
    }

    /**
     * @Route(action="/api/post/<post:\d+>", verbs={"GET"})
     * @param Post $post
     * @return ResponseInterface
     */
    public function get(Post $post): ResponseInterface
    {
        return $this->postView->json($post);
    }

    /**
     * @Route(action="/api/post/<post:\d+>/comment", verbs={"POST"})
     * @param Post          $post
     * @param CommentFilter $commentFilter
     * @return array
     */
    public function comment(Post $post, CommentFilter $commentFilter)
    {
        $this->commentService->comment(
            $post,
            $this->users->findOne(), // todo: use current user
            $commentFilter->getMessage()
        );

        return ['status' => 201];
    }

    /**
     * @Route(action="/api/post", verbs={"GET"})
     * @param GridFactory $grids
     * @return array
     */
    public function list(GridFactory $grids): array
    {
        $grid = $grids->create($this->posts->findAllWithAuthor(), $this->postGrid);

        return [
            'posts' => array_map(
                [$this->postView, 'map'],
                iterator_to_array($grid->getIterator())
            )
        ];
    }
}
