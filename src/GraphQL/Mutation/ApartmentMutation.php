<?php

namespace App\GraphQL\Mutation;

use App\Entity\Apartment;
use App\Repository\ApartmentRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use GraphQL\Language\AST\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class ApartmentMutation implements MutationInterface, AliasedInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param array $argument
     */
    public function addApartment(array $argument)
    {
        $apartment = new Apartment();
        $apartment->setCity($argument['city']);
        $apartment->setBuildYear($argument['build_year']);
        $apartment->setCountry($argument['country']);
        $apartment->setSize($argument['size']);
        $apartment->setStreetAddress($argument['street_address']);
        $apartment->setZipcode($argument['zipcode']);

        $this->em->persist($apartment);
        $this->em->flush();

        return [
            'id' => $apartment->getId()
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
            'AddApartment' => 'add_apartment'
        ];
    }
}
