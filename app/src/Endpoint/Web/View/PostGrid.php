<?php

declare(strict_types=1);

namespace App\Endpoint\Web\View;

use App\Database\Post;
use Spiral\DataGrid\GridSchema;
use Spiral\DataGrid\Specification\Filter\Equals;
use Spiral\DataGrid\Specification\Pagination\PagePaginator;
use Spiral\DataGrid\Specification\Sorter\Sorter;
use Spiral\DataGrid\Specification\Value\IntValue;
use Spiral\Prototype\Annotation\Prototyped;

#[Prototyped(property: 'postGrid')]
final class PostGrid extends GridSchema
{
    public function __construct(
        private readonly PostView $view,
    ) {
        $this->addFilter('author', new Equals('author.id', new IntValue()));

        $this->addSorter('id', new Sorter('id'));
        $this->addSorter('author', new Sorter('author.id'));

        // default limit, available limits
        $this->setPaginator(new PagePaginator(10, [10, 20, 50]));
    }

    public function __invoke(Post $post): array
    {
        return $this->view->map($post);
    }
}
