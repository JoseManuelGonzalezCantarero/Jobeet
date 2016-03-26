<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class AffiliateAdmin extends Admin
{
    protected $datagridValues = array(
        '_sort_order' => 'ASC',
        '_sort_by' => 'is_active',
        'is_active' => array('value' => 2) // The value 2 represents that the displayed affiliate accounts are not activated yet
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('email')
            ->add('url')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('email')
            ->add('isActive')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('isActive')
            ->addIdentifier('email')
            ->add('url')
            ->add('createdAt')
            ->add('token')
            ->add('_action', 'actions', array( 'actions' => array('activate' => array('template' => ':AffiliateAdmin:list__action_activate.html.twig'),
                'deactivate' => array('template' => ':AffiliateAdmin:list__action_deactivate.html.twig'))))
        ;
    }

    public function getBatchActions()
    {
        $actions = parent::getBatchActions();

        if($this->hasRoute('edit') && $this->isGranted('EDIT') && $this->hasRoute('delete') && $this->isGranted('DELETE')) {
            $actions['activate'] = array(
                'label'            => 'Activate',
                'ask_confirmation' => true
            );

            $actions['deactivate'] = array(
                'label'            => 'Deactivate',
                'ask_confirmation' => true
            );
        }

        return $actions;
    }

    protected function configureRoutes(RouteCollection $collection) {
        parent::configureRoutes($collection);

        $collection->add('activate',
            $this->getRouterIdParameter().'/activate')
        ;

        $collection->add('deactivate',
            $this->getRouterIdParameter().'/deactivate')
        ;
    }
}