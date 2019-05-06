<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle\DependencyInjection\Compiler;

use ConfigOne\TelegramBotBundle\Telegram\Command\CommandInterface;
use ConfigOne\TelegramBotBundle\Telegram\Command\CommandRegistry;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\PriorityTaggedServiceTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\LogicException;

class RegisterCommandsPass implements CompilerPassInterface
{
    const TAG = 'configone_telegram_bot.command';

    use PriorityTaggedServiceTrait;

    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        $registry = $container->getDefinition(CommandRegistry::class);

        $commands = $this->findAndSortTaggedServices(self::TAG, $container);

        foreach ($commands as $command) {

            $definition = $container->getDefinition($command);
            $class = $definition->getClass();
            $interfaces = class_implements($class);
            $tag = $definition->getTag(self::TAG);

            if (!isset($interfaces[CommandInterface::class])) {

                throw new LogicException(sprintf(
                    'Can\'t apply tag "%s" to %s class. It must implement %s interface',
                    self::TAG,
                    $class,
                    CommandInterface::class
                ));
            }

            if (!empty($tag['default']) && TRUE === $tag['default']) {
                $registry->addMethodCall('setDefaultCommand', [
                    $command,
                ]);
            }

            $registry->addMethodCall('addCommand', [
                $command,
            ]);
        }
    }
}