<?php

namespace Odiseo\Bundle\AppBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function indexAction()
    {
        $projects = $this->get('odiseo.repository.project')->findBy(array(), array('createdAt' => 'DESC'));
        $tags = $this->get('odiseo.repository.tag')->findAll();

        return $this->render('OdiseoAppBundle:Frontend/Home:index.html.twig', array(
            'projects' => $projects,
            'tags' => $tags
        ));
    }
    public function aboutAction()
    {
        $projects = $this->get('odiseo.repository.project')->findBy(array(), array('createdAt' => 'DESC'));
        $tags = $this->get('odiseo.repository.tag')->findAll();

        return $this->render('OdiseoAppBundle:Frontend/Home:about.html.twig', array(
            'projects' => $projects,
            'tags' => $tags
        ));
    }
    public function blogAction()
    {
        $projects = $this->get('odiseo.repository.project')->findBy(array(), array('createdAt' => 'DESC'));
        $tags = $this->get('odiseo.repository.tag')->findAll();

        return $this->render('OdiseoAppBundle:Frontend/Home:blog.html.twig', array(
            'projects' => $projects,
            'tags' => $tags
        ));
    }
    public function contactAction()
    {

        return $this->render('OdiseoAppBundle:Frontend/Home:contact.html.twig');
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
        $name = $request->get('name');
        $phone = $request->get('phone');
        $email = $request->get('email');
        $message = $request->get('message');

        $message = \Swift_Message::newInstance()
            ->setSubject('CONSULTA WEB')
            ->setFrom($email, $name)
            ->setTo($this->container->getParameter('odiseo.contact.email'))
            ->setBody(
                $message,
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
