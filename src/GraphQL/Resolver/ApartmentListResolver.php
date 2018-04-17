<?php

namespace App\GraphQL\Resolver;

use App\Repository\ApartmentRepository;
use GraphQL\Language\AST\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class ApartmentListResolver implements ResolverInterface, AliasedInterface
{
    private $repository;

    public function __construct(ApartmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function resolve(Argument $args)
    {
        $apartments = $this->repository->findBy([], ['id' => 'desc'], $args['limit']);
        return [
            'apartments' => $apartments
        ];
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
            'resolve' => 'ApartmentList'
        ];
    }
}
