<?php

namespace App\GraphQL\Resolver;

use App\Repository\ApartmentRepository;
use Doctrine\ORM\EntityManager;
use GraphQL\Language\AST\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class ApartmentResolver implements ResolverInterface, AliasedInterface
{
    private $repository;

    public function __construct(ApartmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function resolve(Argument $args)
    {
        return $this->repository->findOneBy(['id' => $args['id']]);
    }

    /**
     * Returns methods aliases.
     *
     * For instance:
     * array('myMethod' => 'myAlias')
     *
     * @return array
     */
    public static function getAliases()
    {
        return [
            'resolve' => 'Apartment'
        ];
    }
}
