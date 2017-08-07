<?php
/*
 * Copyright 2017 Jack Sleight <http://jacksleight.com/>
 * This source file is subject to the MIT license that is bundled with this package in the file LICENCE.md. 
 */

namespace Chalk\Sitemap;

use Chalk\Backend;
use Chalk\Chalk;
use Chalk\Event;
use Chalk\InfoList;
use Chalk\Module as ChalkModule;
use Closure;
use Coast\Request;
use Coast\Response;
use Coast\Router;

class Module extends ChalkModule
{   
    const NAME    = 'sitemap';
    const VERSION = '0.7.0';

    protected $_options = [];

    protected $_hasRoutes = false;

    public function init()
    {
        $this
            ->entityDir('sitemap');
    }
    
    public function frontendInit()
    {
        $this
            ->frontendControllerNspace('sitemap');

        $this
            ->frontendRoute(
                'sitemap_xml',
                Router::METHOD_ALL,
                "sitemap.xml", [
                    'group'      => 'sitemap',
                    'controller' => 'sitemap',
                    'action'     => 'xml',
                ]);

        $this
            ->frontendHookListen('core_robots', function($robots) {
                $url = $this->frontend->url->route([], 'sitemap_xml', true);
                array_unshift($robots->lines, "Sitemap: {$url}\n");
                return $robots;
            });
    }
}