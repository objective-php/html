<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace Tests\ObjectivePHP\Html\Form;


use ObjectivePHP\Html\Form\Element\AbstractElement;
use ObjectivePHP\Html\Form\Element\ElementInterface;
use ObjectivePHP\Html\Form\Form;

class FormTest extends \PHPUnit_Framework_TestCase
{

    public function testElementAreAdded()
    {
        $form = $this->getMockBuilder(Form::class)->setMethods(['prepareElement'])->getMock();
        $element = $this->getMockBuilder(ElementInterface::class)->getMock();

        $form->expects($this->once())->method('prepareElement')->with($element);

        /** @var Form $form */
        $form->addElement($element);

        $this->assertSame($element, $form->getElements()[0]);

    }

    public function testAddedAlementsGetFormInjected()
    {
        $form = new Form();
        $element = $this->getMockBuilder(AbstractElement::class)
            ->setMethods(['setForm'])
            ->disableOriginalConstructor()->getMock();
        $element->expects($this->once())->method('setForm')->with($form);

        /** @var Form $form */
        $form->addElement($element);

    }

}