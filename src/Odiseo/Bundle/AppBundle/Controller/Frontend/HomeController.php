<?php

namespace Odiseo\Bundle\AppBundle\Controller\Frontend;

use Odiseo\Bundle\AppBundle\Entity\HomeConfiguration;
use Odiseo\Bundle\AppBundle\Entity\HomeImage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function indexAction()
    {
        /** @var HomeImage $homeImage */
        $homeImage = $this->get('odiseo.repository.homeImage')->findBy(array(), array('createdAt' => 'DESC'));

        return $this->render('OdiseoAppBundle:Frontend/Home:index.html.twig', array(
            'images' => $homeImage,
        ));
    }
    public function aboutAction()
    {
        $productsBeraca = $this->get('odiseo.repository.beraca')->findBy(array(), array('createdAt' => 'DESC'));

        return $this->render('OdiseoAppBundle:Frontend/Home:about.html.twig', array(
            'productsBeraca' => $productsBeraca,
        ));
    }
    public function newsAction()
    {
        $news = $this->get('odiseo.repository.news')->findBy(array(), array('createdAt' => 'DESC'));

        return $this->render('OdiseoAppBundle:Frontend/Home:news.html.twig', array(
            'news' => $news,
        ));
    }
    public function contactAction()
    {

        return $this->render('OdiseoAppBundle:Frontend/Home:contact.html.twig');
    }

    public function projectShowAction(Request $request)
    {
        $id = $request->get('id');
        $project = $this->get('odiseo.repository.news')->find($id);

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
