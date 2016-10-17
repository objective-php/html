<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Element\Description;


use ObjectivePHP\Html\Form\Element\ElementInterface;
use ObjectivePHP\Html\Form\Renderer\RenderableInterface;
use ObjectivePHP\Html\Tag\Attributes\AttributesProvider;

interface DescriptionInterface extends RenderableInterface, AttributesProvider
{
    public function setText($text);

    public function getText() : string;

    public function setElement(ElementInterface $element);

    public function getElement() : ElementInterface;

}
