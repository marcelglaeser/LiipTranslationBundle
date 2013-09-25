<?php

namespace Liip\TranslationBundle\Form;

/**
 * To be completed
 *
 * This file is part of the LiipTranslationBundle. For more information concerning
 * the bundle, see the README.md file at the project root.
 *
 * @package Liip\TranslationBundle\Form
 * @version 0.0.1
 *
 * @license http://opensource.org/licenses/MIT MIT License
 * @author David Jeanmonod <david.jeanmonod@liip.ch>
 * @author Gilles Meier <gilles.meier@liip.ch>
 * @copyright Copyright (c) 2013, Liip, http://www.liip.ch
 */
class FilterType extends CompatibleAbstractType
{
    private $locales;
    private $domains;

    public function __construct(array $locales, array $domains)
    {
        $this->locales = array_combine($locales, $locales);
        $this->domains = array_combine($domains, $domains);
    }

    protected function decorateOption($options, $possibilities)
    {
        if (isset($possibilities['translation_domain'])) {
            $options['translation_domain'] = 'translation-bundle';
        }
        return $options;
    }

    public function compatibleBuildForm($builder, array $options)
    {
        $builder
            ->add('domain', 'choice', $this->decorateOption(array(
                'choices' => $this->domains,
                'multiple' => true,
                'expanded' => true,
                'required' => false
            ), $options))
            ->add('locale', 'choice', $this->decorateOption(array(
                'choices' => $this->locales,
                'multiple' => true,
                'expanded' => true,
                'required' => false
            ), $options))
        ;
    }

    public function getName()
    {
        return 'translation_filter';
    }
}
