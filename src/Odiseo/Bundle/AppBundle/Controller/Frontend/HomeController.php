<?php

namespace Odiseo\Bundle\AppBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function indexAction()
    {
        $projects = $this->get('odiseo.repository.project')->findBy(array(), array('position' => 'ASC'));
        $tags = $this->get('odiseo.repository.tag')->findAll();

        return $this->render('OdiseoAppBundle:Frontend/Home:index.html.twig', array(
            'projects' => $projects,
            'tags' => $tags
        ));
    }

    public function projectShowAction(Request $request)
    {
        $id = $request->get('id');
        $project = $this->get('odiseo.repository.project')->find($id);

        return $this->render('OdiseoAppBundle:Frontend/Home:projectShow.html.twig', array(
            'project' => $project
        ));
    }

    public function contactSendAction(Request $request)
    {
        $contact = $request->get('email');

        $message = \Swift_Message::newInstance()
            ->setSubject('CONSULTA WEB')
            ->setFrom($contact['userEmail'], $contact['name'])
            ->setTo('odiseo.team@gmail.com')
            ->setBody(
                $contact['body'],
                'text/html'
            )
            /*
             * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'Emails/registration.txt.twig',
                    array('name' => $name)
                ),
                'text/plain'
            )
            */
        ;
        $this->get('mailer')->send($message);

        return JsonResponse::create(array());
    }
}
