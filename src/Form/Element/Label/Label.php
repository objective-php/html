<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Element\Label;


use ObjectivePHP\Html\Form\Element\Label\Renderer\LabelRenderer;

/**
 * Class Label
 *
 * @package ObjectivePHP\Html\Form\Element\Label
 */
class Label extends AbstractLabel
{
    protected $defaultRenderer = LabelRenderer::class;
    
}
