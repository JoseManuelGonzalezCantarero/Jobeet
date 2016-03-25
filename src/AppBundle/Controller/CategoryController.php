<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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

        $latestJob = $em->getRepository('AppBundle:Job')->getLatestPost($category->getId());

        if($latestJob) {
            $lastUpdated = $latestJob->getCreatedAt()->format(DATE_ATOM);
        } else {
            $lastUpdated = new \DateTime();
            $lastUpdated = $lastUpdated->format(DATE_ATOM);
        }

        $category->setActiveJobs($em->getRepository('AppBundle:Job')->getActiveJobs($category->getId()));
        $activeJobsQuery = $em->getRepository('AppBundle:Job')->getActiveJobsQuery($category->getId());
        $pagination = $paginator->paginate(
            $activeJobsQuery, /* query NOT result */
            $request->query->getInt("page", $request->get('page')), $this->getParameter('max_jobs_on_category')
        );

        $format = $request->getRequestFormat();
        return $this->render('category/show.'.$format.'.twig', array(
            'pagination' => $pagination,
            'feedId' => sha1($this->get('router')->generate('categoryPage', array('slug' => $category->getSlug(), 'format' => 'atom'), UrlGeneratorInterface::ABSOLUTE_PATH)),
            'lastUpdated' => $lastUpdated
        ));
    }
}
