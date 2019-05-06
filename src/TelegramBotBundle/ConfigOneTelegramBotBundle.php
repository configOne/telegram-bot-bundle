<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle;

use ConfigOne\TelegramBotBundle\DependencyInjection\Compiler\RegisterCommandsPass;
use ConfigOne\TelegramBotBundle\DependencyInjection\ConfigOneTelegramBotExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ConfigOneTelegramBotBundle extends Bundle
{
    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new RegisterCommandsPass());
    }

    /**
     * @inheritDoc
     */
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new ConfigOneTelegramBotExtension();
        }

        return $this->extension;
    }
}