<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Affiliate;
use AppBundle\Form\AffiliateType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AffiliateController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/new", name="affiliate_new")
     */
    public function newAction()
    {
        $entity = new Affiliate();
        $form = $this->createForm(AffiliateType::class, $entity);

        return $this->render('affiliate/affiliate_new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/create", name="affiliate_create")
     */
    public function createAction(Request $request)
    {
        $affiliate = new Affiliate();
        $form = $this->createForm(AffiliateType::class, $affiliate);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($form->isValid()) {
            $affiliate->setUrl($form->get('url')->getData());
            $affiliate->setEmail($form->get('email')->getData());
            $affiliate->setIsActive(false);

            $em->persist($affiliate);
            $em->flush();

            return $this->redirectToRoute('affiliate_wait');
        }

        return $this->render('affiliate/affiliate_new.html.twig', array(
            'entity' => $affiliate,
            'form'   => $form->createView(),
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/wait", name="affiliate_wait")
     */
    public function waitAction()
    {
        return $this->render('affiliate/wait.html.twig');
    }
}
