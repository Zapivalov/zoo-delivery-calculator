<?php

declare(strict_types=1);

namespace App\Request;

use App\Model\Weight;
use Jrm\RequestBundle\Attribute\PathAttribute;
use Jrm\RequestBundle\Attribute\Query;
use Symfony\Component\Validator\Constraints as Assert;

final class DeliveryCalculateRequest
{
    public function __construct(
        #[PathAttribute]
        public readonly string $slug,
        #[Query]
        #[Assert\Type('numeric')]
        private readonly string $weight,
    ) {
    }

    public function weight(): Weight
    {
        return new Weight((int) $this->weight);
    }
}
