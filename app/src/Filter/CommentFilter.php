<?php

declare(strict_types=1);

namespace App\Filter;

use Spiral\Filters\Attribute\Input\Post;
use Spiral\Filters\Model\Filter;
use Spiral\Filters\Model\FilterDefinitionInterface;
use Spiral\Filters\Model\HasFilterDefinition;
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
