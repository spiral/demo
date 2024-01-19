<?php

declare(strict_types=1);

namespace App\Endpoint\Web\Filter;

use Spiral\Filters\Attribute\Input\Post;
use Spiral\Filters\Model\Filter;
use Spiral\Filters\Model\FilterDefinitionInterface;
use Spiral\Filters\Model\HasFilterDefinition;
use Spiral\Validator\FilterDefinition;

final class CommentFilter extends Filter implements HasFilterDefinition
{
    #[Post]
    public readonly string $message;

    public function filterDefinition(): FilterDefinitionInterface
    {
        return new FilterDefinition([
            'message' => ['string', 'required']
        ]);
    }
}
