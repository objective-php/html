<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace Tests\ObjectivePHP\HtmlAttributes;


use ObjectivePHP\Html\Tag\Attributes\AttributesHandler;

class AttributesHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function testAttributesHandling()
    {
        $attribs = new UsingAttributesHandler();
        
        $attribs->attr('test', 'test value');
        
        $this->assertTrue($attribs->getAttributes()->has('test'));
        $this->assertEquals('test value', $attribs->getAttributes()->get('test'));
        $this->assertEquals('test value', $attribs->attr('test'));
    }
    
    public function testDataAttributesHandling()
    {
        $attribs = new UsingAttributesHandler();
        
        $attribs->data('test', 'test value');
        
        $this->assertTrue($attribs->getAttributes()->has('data-test'));
        $this->assertEquals('test value', $attribs->getAttributes()->get('data-test'));
        $this->assertEquals('test value', $attribs->data('test'));
    }
}

class UsingAttributesHandler {
    use AttributesHandler;
}
