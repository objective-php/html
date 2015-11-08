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

        public function testBooleanAttributes()
        {
            $attribs = new Attributes();

            $attribs->set('a', true)->set('b', false)->append('disabled');

            $this->assertEquals('a disabled', (string) $attribs);

            $attribs->set('a', false);
            $this->assertEquals('disabled', (string) $attribs);
        }

    }