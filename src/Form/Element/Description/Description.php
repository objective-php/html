<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Element\Description;


use ObjectivePHP\Html\Form\Element\Description\Renderer\DescriptionRenderer;

/**
 * Class Description
 *
 * @package ObjectivePHP\Html\Form\Element\Description
 */
class Description extends AbstractDescription
{
    protected $defaultRenderer = DescriptionRenderer::class;

}
