<?php
    
    namespace Tests\ObjectivePHP\HtmlAttributes;

    use ObjectivePHP\Html\Attributes\Attributes;
    use ObjectivePHP\PHPUnit\TestCase;

    class AttributesTest extends TestCase
    {

        public function testToString()
        {
            $attribs = new Attributes();

            $attribs->set('a', 'x')->set('b', ['y', 'z'])->append('disabled');

            $this->assertEquals('a="x" b="y z" disabled', (string) $attribs);
        }

    }