<?php

declare(strict_types=1);

namespace Spyck\ConversionSonataBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\DatePickerType;
use Spyck\ConversionBundle\Entity\Goal;
use Spyck\SonataExtension\Utility\DateTimeUtility;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\Form\Extension\Core\Type\DateType;

#[AutoconfigureTag('sonata.admin', [
    'group' => 'Conversion',
    'manager_type' => 'orm',
    'model_class' => Goal::class,
    'label' => 'Goal',
])]
final class CategoryAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Fields')
                ->add('name', null, [
                    'required' => true,
                ])
                ->add('adapter', null, [
                    'required' => true,
                ])
                ->add('type', null, [
                    'required' => false,
                ])
                ->add('dateMin', DatePickerType::class, [
                    'format' => DateType::HTML5_FORMAT,
                    'required' => true,
                ])
                ->add('active')
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid
            ->add('name')
            ->add('adapter')
            ->add('type')
            ->add('active');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('name')
            ->add('type')
            ->add('active')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('name')
            ->add('adapter')
            ->add('type')
            ->add('dateMin', null, [
                'format' => DateTimeUtility::FORMAT_DATE,
            ])
            ->add('active')
            ->add('timestampCreated', null, [
                'format' => DateTimeUtility::FORMAT_DATETIME,
            ])
            ->add('timestampUpdated', null, [
                'format' => DateTimeUtility::FORMAT_DATETIME,
            ]);
    }
}
