<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use App\Repository\ConferenceRepository;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $conferenceRepository;

    public function __construct(Environment $twig, ConferenceRepository $conferenceRepository)
    {
        $this->twig = $twig;
        $this->conferenceRepository = $conferenceRepository;
    }

//    symfony console make:subscriber TwigEventSubscriber
//    Команда спросит вас о том, какое событие вы хотите обрабатывать.
//    Выберите событие Symfony\Component\HttpKernel\Event\ControllerEvent, отправляемое непосредственно
//    перед вызовом контроллера. Самое время для определения глобальной переменной conferences, чтобы Twig имел
//    к ней доступ во время отрисовки шаблона контроллером.
    public function onControllerEvent(ControllerEvent $event): void
    {
        $this->twig->addGlobal('conferences', $this->conferenceRepository->findAll());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ControllerEvent::class => 'onControllerEvent',
        ];
    }
}
