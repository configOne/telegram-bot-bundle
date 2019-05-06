<?php

declare(strict_types=1);

namespace ConfigOne\TelegramBotBundle\DependencyInjection;

use ConfigOne\TelegramBotBundle\Model\DefaultChatUser;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('configone_telegram_bot');

        $rootNode
            ->children()
                ->scalarNode('name')->isRequired()->end()
                ->arrayNode('api')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('token')->isRequired()->end()
                        ->scalarNode('tracker_token')->defaultNull()->end()
                        ->scalarNode('proxy')->defaultValue('')->end()
                    ->end()
                ->end()
                ->arrayNode('user')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->defaultValue(DefaultChatUser::class)->end()
                    ->end()
                ->end()
                ->arrayNode('state_machine')
                    ->children()
                        ->scalarNode('workflow')->isRequired()->end()
                        ->arrayNode('states')
                            ->useAttributeAsKey('state')
                            ->prototype('array')
                            ->children()
                                ->scalarNode('command')->defaultValue('')->end()
                                ->scalarNode('transition')->defaultValue('')->end()
                            ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}