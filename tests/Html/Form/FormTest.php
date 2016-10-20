<?php
/**
 * Created by PhpStorm.
 * User: gauthier
 * Date: 20/10/2016
 * Time: 15:08
 */

namespace Tests\ObjectivePHP\Html\Form;


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

}