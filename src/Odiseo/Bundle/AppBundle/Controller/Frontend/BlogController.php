<?php

namespace Odiseo\Bundle\AppBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
    public function showAction(Request $request)
    {
        $post = $request->get('post');

        return $this->render('OdiseoAppBundle:Frontend/Blog:'.$post.'.html.twig');
    }
    
}
