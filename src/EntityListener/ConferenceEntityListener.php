<?php

namespace App\EntityListener;

use App\Entity\Conference;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;


// По аналогии со свойством createdAt, свойство slug должно автоматически обновляться при каждом изменении конференции
// путем вызова метода computeSlug().
//
//Но так как метод зависит от реализации SluggerInterface, мы не можем добавить событие prePersist так, как делали это
// раньше (нет способа внедрить слагер).

#[AsEntityListener(event: Events::prePersist, entity: Conference::class)]
#[AsEntityListener(event: Events::preUpdate, entity: Conference::class)]
class ConferenceEntityListener
{
    public function __construct(
        private SluggerInterface $slugger,
    ) {
    }

    public function prePersist(Conference $conference, LifecycleEventArgs $event)
    {
        $conference->computeSlug($this->slugger);
    }

    public function preUpdate(Conference $conference, LifecycleEventArgs $event)
    {
        $conference->computeSlug($this->slugger);
    }
}