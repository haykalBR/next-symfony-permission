<?php


namespace next\SymfonyPermissionBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration  implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder("symfony_permission");
        $rootNode = $treeBuilder->getRootNode("symfony_permission");
        $rootNode
            ->children()
            ->scalarNode('user')
            ->isRequired()
            ->cannotBeEmpty()
            ->end()
            ->scalarNode('role')
            ->end()
            ->end();
        return $treeBuilder;
    }
}