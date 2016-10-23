<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Tag\Attributes;


use ObjectivePHP\Primitives\Collection\Collection;
use ObjectivePHP\Primitives\Merger\MergePolicy;

trait AttributesHandler
{
    /**
     * @var Attributes
     */
    protected $attributes;

    /**
     * @param       $attributes
     * @param array $mergePolicies
     *
     * @throws \ObjectivePHP\Primitives\Exception
     */
    public function addAttributes($attributes, $mergePolicies = [])
    {
        Collection::cast($attributes)->each(function ($value, $attribute) use ($mergePolicies)
        {
            $mergePolicy = isset($mergePolicies[$attribute]) ? $mergePolicies[$attribute] : MergePolicy::REPLACE;
            $this->addAttribute($attribute, $value, $mergePolicy);
        });

        return $this;
    }

    /**
     * @param     $attribute
     * @param     $value
     * @param int $mergePolicy
     *
     * @return $this
     * @throws Exception
     */
    public function addAttribute($attribute, $value, $mergePolicy = MergePolicy::REPLACE)
    {
        switch ($mergePolicy)
        {
            case MergePolicy::REPLACE:
                $this->getAttributes()->set($attribute, $value);
                break;

            case MergePolicy::NATIVE:
            case MergePolicy::COMBINE:

                $previousValue = $this->getAttributes()->get($attribute);
                if ($previousValue)
                {
                    $combinedValue = Collection::cast($previousValue)->merge(Collection::cast($value));
                } else
                {
                    $combinedValue = $value;
                }
                $this->getAttributes()->set($attribute, $combinedValue);
                break;


            default:
                throw new Exception('Only MergePolicy::REPLACE and COMBINE are implemented yet');

        }

        return $this;
    }

    /**
     * @return Attributes
     */
    public function getAttributes(): Attributes
    {
        if (is_null($this->attributes))
        {
            $this->attributes = new Attributes();
        }

        return $this->attributes;
    }

    /**
     * @param Attributes $attributes
     *
     * @return $this
     */
    public function setAttributes(Attributes $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @param ...$attribute
     *
     * @return $this
     */
    public function removeAttribute(...$attribute)
    {
        foreach ($attribute as $htmlAttribute)
        {
            $this->getAttributes()->delete($htmlAttribute);
        }

        return $this;
    }

    public function data($dataAttribute, $value = null)
    {
        $dataAttribute = 'data-' . $dataAttribute;

        if (is_null($value))
        {
            return $this->getAttributes()->has($dataAttribute) ? $this->getAttributes()->get($dataAttribute) : null;
        } else
        {
            $this->getAttributes()->set($dataAttribute, $value);

            return $this;
        }
    }

    // PROXIES

    /**
     * @param      $attribute
     * @param null $value
     * @param int $mergePolicy
     *
     * @return $this|mixed|null
     */
    public function attr($attribute, $value = null, $mergePolicy = MergePolicy::REPLACE)
    {
        // shunt class assignation
        if (strtolower($attribute) == 'class')
        {
            return $this->addClass($value);
        }

        if (is_null($value))
        {
            return $this->getAttributes()->has($attribute) ? $this->getAttributes()->get($attribute) : null;
        } else
        {
            $this->addAttribute($attribute, $value, $mergePolicy);

            return $this;
        }
    }

    /**
     * @param ...$classes
     *
     * @return $this
     */
    public function addClass(...$classes)
    {
        $currentClasses = $this->getClasses();
        foreach ($classes as $class)
        {
            $classesGroup = explode(' ', $class);
            foreach ($classesGroup as $individualClass)
            {
                if (!$currentClasses->has($individualClass))
                {
                    $currentClasses->append($individualClass);
                }
            }
        }

        $currentClasses->add(Collection::cast($classes));

        return $this;
    }

    /**
     * @return Collection
     */
    public function getClasses()
    {
        return $this->getAttribute('class');
    }

    /**
     * @param $attribute
     *
     * @return mixed|null
     * @throws \ObjectivePHP\Primitives\Exception
     */
    public function getAttribute($attribute)
    {
        return $this->getAttributes()->get($attribute);
    }

    /**
     * @param ...$class
     *
     * @return $this
     */
    public function removeClass(...$class)
    {
        foreach ($class as $cssClass)
        {
            $index = $this->getClasses()->search($cssClass);
            unset($this->getClasses()[$index]);

            // reset keys
            $this->getClasses()->fromArray($this->getClasses()->values()->toArray());
        }

        return $this;
    }

}
