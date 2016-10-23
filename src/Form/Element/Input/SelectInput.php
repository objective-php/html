<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Element\Input;


use ObjectivePHP\Html\Form\Element\ElementInterface;
use ObjectivePHP\Html\Form\Element\Input\Renderer\SelectInputRenderer;
use ObjectivePHP\Html\Form\Element\Select;

class SelectInput extends AbstractInput
{
    protected $defaultRenderer = SelectInputRenderer::class;

    /**
     * @return Select
     */
    public function getElement(): ElementInterface
    {
        return parent::getElement(); // TODO: Change the autogenerated stub
    }


}
