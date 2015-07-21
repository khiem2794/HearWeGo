<?php

namespace HearWeGo\HearWeGoBundle\Form\Transformer;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use HearWeGo\HearWeGoBundle\Entity\Tag;

class TagTransformer implements DataTransformerInterface
{

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function transform($value)
    {
        if (!$value) {
            return null;
        }

        $tags = array();
        if ($value) {
            foreach ($value as $tag) {
                $tags[] = $tag->getName();
            }
        }

        return implode(",", $tags);
    }

    public function reverseTransform($value)
    {
        if (null === $value || '' === $value) {
            return null;
        }

        $tags = $this->entityManager
            ->getRepository('HearWeGoHearWeGoBundle:Tag')
            ->searchTags($value);
        if (!count($tags))
            $tags = array();

        $tagNames = array_filter(explode(",", $value));
        array_walk($tagNames, function ($item) {
            return trim($item);
        });

        $exist = array();
        foreach ($tags as $tag)
            if (in_array($tag->getName(), $tagNames))
                $exist[] = $tag->getName();
        $notFound = array_diff($tagNames, $exist);

        if (count($notFound)) {
            foreach ($notFound as $name) {
                $newTag = new Tag($name);
                $this->entityManager->persist($newTag);
                array_push($tags, $newTag);
            }
            $this->entityManager->flush();

        }

        return $tags;
    }

}