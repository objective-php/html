<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Element\Label;


use ObjectivePHP\Html\Form\Renderer\RenderableInterface;

interface LabelInterface extends RenderableInterface
{
    const WRAP   = 'wrap';
    const BEFORE = 'before';
    const AFTER  = 'after';
    
    public function getPlacement() : string;
    
    public function setPlacement(string $placement) : LabelInterface;
    
    public function setText($text);
    
    public function getText() : string;
}
