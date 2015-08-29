<?php
    
    namespace Tests\ObjectivePHP\Html\Tag;

    use ObjectivePHP\Html\Tag\Tag;
    use ObjectivePHP\Primitives\Collection\Collection;

    class TagTest extends \PHPUnit_Framework_TestCase
    {
        public function testFactoryAndTags()
        {

            $tag = Tag::div('content', 'first', 'second');


            $tag['class'][] = 'third';

            $this->assertInstanceOf(Tag::class, $tag);
            $this->assertEquals('div', $tag->getTag());
            $this->assertEquals(new Collection(['first', 'second', 'third']), $tag->getAttribute('class'));

            $tag['class'] = ['fourth', 'fifth sixth'];

            $this->assertEquals(new Collection(['fourth', 'fifth', 'sixth']), $tag->getAttribute('class'));

            $tag->removeClass('fifth');
            $this->assertEquals(new Collection(['fourth', 'sixth']), $tag->getAttribute('class'));

        }

        public function testToString()
        {

            $tag = Tag::div('test content', 'first second');
            $tag->append('more content');

            $span = Tag::span('nested tag');
            $tag->append($span);
            $this->assertEquals('<div class="first second">test content more content <span>nested tag</span></div>', (string) $tag);



        }
    }