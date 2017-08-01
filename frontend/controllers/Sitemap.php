<?php
/*
 * Copyright 2017 Jack Sleight <http://jacksleight.com/>
 * This source file is subject to the MIT license that is bundled with this package in the file LICENCE.md. 
 */

namespace Chalk\Sitemap\Frontend\Controller;

use Chalk\Chalk;
use Coast\Controller\Action;
use Coast\Request;
use Coast\Response;
use Coast\Sitemap as CoastSitemap;
use Chalk\Repository;

class Sitemap extends Action
{
    public function xml(Request $req, Response $res)
    {
        $sitemap = $this->hook->fire('sitemap_xml', new CoastSitemap());
        return $res->xml($sitemap->toXml());
    }
}