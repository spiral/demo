<?php

declare(strict_types=1);

namespace App\Filter;

use Spiral\Filters\Attribute\Input\Post;
use Spiral\Filters\Dto\Filter;
use Spiral\Filters\Dto\FilterDefinitionInterface;
use Spiral\Filters\Dto\HasFilterDefinition;
use Spiral\Validator\FilterDefinition;

class CommentFilter extends Filter implements HasFilterDefinition
{
    #[Post(key: 'message')]
    public readonly string $message;

    public function filterDefinition(): FilterDefinitionInterface
    {
        return new FilterDefinition([
            'message' => ['string', 'required']
        ]);
    }
}
