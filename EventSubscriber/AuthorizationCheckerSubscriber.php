<?php

namespace Timiki\Bundle\RpcServerBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Timiki\Bundle\RpcServerBundle\Event\JsonExecuteEvent;
use Timiki\Bundle\RpcServerBundle\Exceptions\MethodNotGrantedException;

class AuthorizationCheckerSubscriber implements EventSubscriberInterface
{
    /**
     * @var AuthorizationCheckerInterface
     */
    private $authChecker;

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            JsonExecuteEvent::EVENT => ['execute', 4096],
        ];
    }

    /**
     * AuthorizationCheckerSubscriber constructor.
     *
     * @param AuthorizationCheckerInterface|null $authChecker
     */
    public function __construct(AuthorizationCheckerInterface $authChecker = null)
    {
        $this->authChecker = $authChecker;
    }

    /**
     * @param JsonExecuteEvent $event
     */
    public function execute(JsonExecuteEvent $event)
    {
        if (!$this->authChecker || !isset($event->getMetadata()['roles'])) {
            return;
        }

        if (!$this->authChecker->isGranted($event->getMetadata()['roles']->value)) {
            throw new MethodNotGrantedException();
        }
    }
}