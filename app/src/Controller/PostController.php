<?php

declare(strict_types=1);

namespace App\Controller;

use App\Database\Post;
use App\Filter\CommentFilter;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\View\PostGrid;
use App\View\PostView;
use Psr\Http\Message\ResponseInterface;
use Spiral\Core\Container\SingletonInterface;
use Spiral\DataGrid\GridFactory;
use Spiral\Http\Exception\ClientException\NotFoundException;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;

class PostController implements SingletonInterface
{
    use PrototypeTrait;

    public function __construct(
        private PostView $postView,
        private PostRepository $posts,
        private UserRepository $users,
        private PostGrid $postGrid
    ) {
    }

    #[Route(route: '/posts', name: 'post.all', methods: 'GET')]
    public function all(GridFactory $grids): string
    {
        $grid = $grids->create($this->posts->findAllWithAuthor(), $this->postGrid);

        return $this->views->render('posts', ['posts' => $grid]);
    }

    #[Route(route: '/post/<id:\d+>', name: 'post.view', methods: 'GET')]
    public function view(string $id): string
    {
        $post = $this->posts->findOneWithComments($id);
        if ($post === null) {
            throw new NotFoundException();
        }

        return $this->views->render('post', ['post' => $post]);
    }

    #[Route(route: '/api/post/<post:\d+>', name: 'post.get', methods: 'GET')]
    public function get(Post $post): ResponseInterface
    {
        return $this->postView->json($post);
    }

    #[Route(route: '/api/post/<post:\d+>/comment', name: 'post.comment', methods: 'POST')]
    public function comment(Post $post, CommentFilter $commentFilter)
    {
        $this->commentService->comment(
            $post,
            $this->users->findOne(), // todo: use current user
            $commentFilter->message
        );

        return ['status' => 201];
    }

    #[Route(route: '/api/post', name: 'post.list', methods: 'GET')]
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
