<?php


namespace HearWeGo\HearWeGoBundle\Form\Transformer;

use HearWeGo\HearWeGoBundle\Entity\Destination;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;


class DestinationTransformer implements DataTransformerInterface
{
    private $entityManager;

    function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function transform($destination)
    {
        if (null === $destination)
            return null;
        return $destination->getName();
    }


    public function reverseTransform($destinationName)
    {
        if (!$destinationName)
            return null;
        $destination = $this->entityManager
                            ->getRepository('HearWeGoHearWeGoBundle:Destination')
                            ->findByName($destinationName);
        if ($destination === null)
            throw new TransformationFailedException('Destination not exist');

        return $destination;
    }


}