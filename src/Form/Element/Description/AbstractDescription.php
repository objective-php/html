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
use ObjectivePHP\Html\Form\Renderer\RenderingHandler;
use ObjectivePHP\Html\Tag\Attributes\AttributesHandler;

/**
 * Class Label
 *
 * @package ObjectivePHP\Html\Form\Element\Description
 */
abstract class AbstractDescription implements DescriptionInterface
{
    use RenderingHandler;
    use AttributesHandler;

    /**
     * @var mixed
     */
    protected $text;

    /** @var  ElementInterface */
    protected $element;


    /**
     * Description constructor.
     *
     * @param string $text
     */
    public function __construct($text)
    {
        $this->text      = $text;
    }

    /**
     * @return string
     */
    public function getText() : string
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     *
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return ElementInterface
     */
    public function getElement(): ElementInterface
    {
        return $this->element;
    }

    /**
     * @param ElementInterface $element
     *
     * @return $this
     */
    public function setElement(ElementInterface $element)
    {
        $this->element = $element;

        return $this;
    }

}
