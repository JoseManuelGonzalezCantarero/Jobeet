<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ApiController extends Controller
{

    /**
     * @param Request $request
     * @param $token
     * @return Response
     * @Route("/api/{token}/jobs.{_format}", name="jobeet_api", requirements={"_format": "xml|json|yaml"})
     */
    public function listAction(Request $request, $token)
    {
        $em = $this->getDoctrine()->getManager();

        $jobs = array();

        $rep = $em->getRepository('AppBundle:Affiliate');
        $affiliate = $rep->getForToken($token);

        if(!$affiliate)
        {
            throw $this->createNotFoundException('This affiliate account does not exist!');
        }

        $rep = $em->getRepository('AppBundle:Job');
        $active_jobs = $rep->getActiveJobs(null, null, null, $affiliate->getId());

        foreach ($active_jobs as $job) {
            $jobs[$this->get('router')->generate('job_show', array('company' => $job->getCompanySlug(),
                'location' => $job->getLocationSlug(), 'id' => $job->getId(), 'position' => $job->getPositionSlug()),
                UrlGeneratorInterface::ABSOLUTE_PATH)] = $job->asArray($request->getHost());
        }

        $format = $request->getRequestFormat();
        $jsonData = json_encode($jobs);

        if ($format == "json") {
            $headers = array('Content-Type' => 'application/json');
            $response = new Response($jsonData, 200, $headers);

            return $response;
        }

        return $this->render('api/jobs.' . $format . '.twig', array(
            'jobs' => $jobs
        ));
    }
}
