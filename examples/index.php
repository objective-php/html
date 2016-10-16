<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

use ObjectivePHP\Html\Tag\Tag;

require dirname(__DIR__) . '/vendor/autoload.php';

Tag::h1('Form examples list');

foreach(new DirectoryIterator('.') as $item)
{
    if($item->isFile() && $item->getFilename() != 'index.php')
    {
        echo Tag::a($item->getFilename(), $item->getFilename()) . Tag::br();
    }
}
