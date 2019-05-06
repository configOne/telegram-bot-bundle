<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle\DependencyInjection;

use ConfigOne\TelegramBotBundle\Telegram\StateMachine\StateMachineConfiguration;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ConfigOneTelegramBotExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $loader->load('services.yaml');

        $container->setParameter('configone_telegram_bot.api.token', $config['api']['token']);
        $container->setParameter('configone_telegram_bot.api.tracker_token', $config['api']['tracker_token']);
        $container->setParameter('configone_telegram_bot.api.proxy', $config['api']['proxy']);
        $container->setParameter('configone_telegram_bot.name', $config['name']);

        $stateMachineConfig = $container->getDefinition(StateMachineConfiguration::class);
        $stateMachineConfig->addMethodCall('loadConfig', [$config['state_machine']]);

        $container->setParameter('configone_telegram_bot.user.class', $config['user']['class']);

    }

    /**
     * @inheritDoc
     */
    public function getAlias()
    {
        return 'configone_telegram_bot';
    }
}