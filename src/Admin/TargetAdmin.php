<?php

declare(strict_types=1);

namespace Spyck\ConversionSonataBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Spyck\ConversionBundle\Entity\Target;
use Spyck\SonataExtension\Form\Type\ParameterType;
use Spyck\SonataExtension\Utility\DateTimeUtility;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('sonata.admin', [
    'group' => 'Conversion',
    'manager_type' => 'orm',
    'model_class' => Target::class,
    'label' => 'Target',
])]
final class TargetAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Fields')
                ->add('goal', null, [
                    'required' => true,
                ])
                ->add('name', null, [
                    'required' => true,
                ])
                ->add('variables', ParameterType::class, [
                    'required' => false,
                ])
                ->add('value', null, [
                    'required' => true,
                ])
                ->add('remarks', null, [
                    'required' => false,
                ])
                ->add('important')
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid
            ->add('goal')
            ->add('name')
            ->add('variables')
            ->add('value')
            ->add('remarks')
            ->add('important');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('goal')
            ->add('name')
            ->add('variables')
            ->add('value')
            ->add('remarks')
            ->add('important')
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
            ->add('goal')
            ->add('name')
            ->add('variables')
            ->add('value')
            ->add('remarks')
            ->add('important')
            ->add('timestampCreated', null, [
                'format' => DateTimeUtility::FORMAT_DATETIME,
            ])
            ->add('timestampUpdated', null, [
                'format' => DateTimeUtility::FORMAT_DATETIME,
            ]);
    }
}
