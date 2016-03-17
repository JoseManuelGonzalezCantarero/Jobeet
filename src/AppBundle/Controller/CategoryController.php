<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    /**
     * @param $slug
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/category/{slug}/{page}", name="categoryPage", defaults={"page": 1})
     */
    public function showAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository('AppBundle:Category')->findOneBySlug($slug);
        $paginator = $this->get('knp_paginator');
        if(!$category)
        {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        $category->setActiveJobs($em->getRepository('AppBundle:Job')->getActiveJobs($category->getId()));
        $activeJobsQuery = $em->getRepository('AppBundle:Job')->getActiveJobsQuery($category->getId());
        $pagination = $paginator->paginate(
            $activeJobsQuery, /* query NOT result */
            $request->query->getInt('page', 1), $this->getParameter('max_jobs_on_homepage')
        );
        return $this->render('category/show.html.twig', array(
            'category' => $category,
            'pagination' => $pagination
        ));
    }
}
