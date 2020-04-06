<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
declare(strict_types=1);


namespace App\View;

use Spiral\DataGrid\GridSchema;
use Spiral\DataGrid\Specification\Filter\Equals;
use Spiral\DataGrid\Specification\Pagination\PagePaginator;
use Spiral\DataGrid\Specification\Sorter\Sorter;
use Spiral\DataGrid\Specification\Value\IntValue;
use Spiral\Prototype\Annotation\Prototyped;

/**
 * @Prototyped(property="postGrid")
 */
class PostGrid extends GridSchema
{
    public function __construct()
    {
        $this->addFilter('author', new Equals('author.id', new IntValue()));

        $this->addSorter('id', new Sorter('id'));
        $this->addSorter('author', new Sorter('author.id'));

        // default limit, available limits
        $this->setPaginator(new PagePaginator(10, [10, 20, 50]));
    }
}
