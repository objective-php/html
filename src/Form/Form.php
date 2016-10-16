<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form;


use ObjectivePHP\Html\Form\Element\ElementInterface;
use ObjectivePHP\Html\Form\Renderer\FormRenderer;
use ObjectivePHP\Html\Form\Renderer\FormRenderingHandler;
use ObjectivePHP\Html\Form\Renderer\RenderingHandler;
use ObjectivePHP\Html\Tag\Attributes\AttributesHandler;
use ObjectivePHP\Notification\Stack;
use ObjectivePHP\Primitives\Collection\Collection;

class Form extends AbstractForm
{
    
    protected $defaultRenderer = FormRenderer::class;
    
}
