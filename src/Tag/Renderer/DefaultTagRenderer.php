<?php

    namespace ObjectivePHP\Html\Tag\Renderer;
    
    
    use ObjectivePHP\Html\Tag\Tag;
    use ObjectivePHP\Primitives\Collection\Collection;

    class DefaultTagRenderer implements TagRendererInterface
    {
        public function render(Tag $tag)
        {

            if ($tag->isClosingTag())
            {
                $tag->close(false);

                return '</' . $tag->getTagName() . '>';
            }
            else
            {
                $html = '<' . trim(implode(' ', [$tag->getTagName(), $tag->getAttributes()])) . '>';


                if (!$tag->getContent()->isEmpty())
                {
                    $chunks = new Collection();
                    $tag->getContent()->each(function ($chunk) use (&$chunks)
                    {
                        $content = (string) $chunk;
                        if($content) $chunks[] = $content;
                    })
                    ;

                    $html .= $chunks->join($tag->getSeparator())->trim();

                    $html .= '</' . $tag->getTagName() . '>';
                }
                elseif ($tag->isAlwaysClosed())
                {
                    $html .= '</' . $tag->getTagName() . '>';
                }

                return $html;

            }
        }

    }
