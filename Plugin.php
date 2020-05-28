<?php

namespace Kanboard\Plugin\ReorderAction;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;
use Kanboard\Plugin\ReorderAction\Action\ReorderColumnAction;

class Plugin extends Base
{
    public function initialize()
    {
        //Actions
        $this->actionManager->register(new ReorderColumnAction($this->container));
    }
    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__ . '/Locale');
    }
    public function getPluginName()
    {
        return 'ReorderAction';
    }
    public function getPluginDescription()
    {
        return t('Automated action to reorder a column');
    }
    public function getPluginAuthor()
    {
        return 'BlueTeck';
    }
    public function getPluginVersion()
    {
        return '1.0.0';
    }
    public function getPluginHomepage()
    {
        return 'https://github.com/BlueTeck/kanboard_plugin_reorderaction';
    }
    public function getCompatibleVersion()
    {
        return '>=1.2.13';
    }
}
