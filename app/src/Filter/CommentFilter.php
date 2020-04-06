<?php

/**
 * {project-name}
 *
 * @author {author-name}
 */
declare(strict_types=1);

namespace App\Filter;

use Spiral\Filters\Filter;

class CommentFilter extends Filter
{
    protected const SCHEMA = [
        'message' => 'data:message'
    ];

    protected const VALIDATES = [
        'message' => ['notEmpty']
    ];

    protected const SETTERS = [
        'message' => 'strval'
    ];

    public function getMessage(): string
    {
        return $this->message;
    }
}
