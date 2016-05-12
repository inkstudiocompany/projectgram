<?php

namespace InkStudio\ProjectgramBundle\Controller;

use InkStudio\ProjectgramBundle\Services\Instagram\InstagramService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DefaultController extends Controller
{
    public function indexAction (Request $request)
    {
        $cookie = false;
	    if (true === $request->cookies->has('testgram')) {
		    $cookie = $request->cookies->get('testgram');
	    }

	    if (false === $cookie) {
		    /** @var InstagramService $instagram */
		    $instagram = $this->get('instagram');

		    return $this->redirect($instagram->getLoginUrl());
	    }

        return $this->render('InkStudioProjectgramBundle:Default:index.html.twig');
    }

    public function callbackAction (Request $request)
    {
        $code = $request->get('code');

        if (false === $code || null === $code) {
            return false;
        }

        /** @var InstagramService $instagram */
        $instagram = $this->get('instagram');

        $tokenAuth = $instagram->getAuth($code);

        var_dump($tokenAuth); die();

        $response = new Response();
        $cookie = new Cookie('testgram', $tokenAuth);

        $response->headers->setCookie($cookie);

        return $response;
    }

    public function tokenAction (Request $request)
    {
        $token = '177738431.83efd5d.3936a1e6f1ed4305ab1552c3f66a3aaf';

        /** @var InstagramService $instagram */
        $instagram = $this->get('instagram');

        $code = $request->get('code');

        if (false === $code || null === $code) {
            return false;
        }


        $instagram = $this->get('instagram');

        $tokenAuth = $instagram->getAuth($code);

        var_dump($instagam->getUserStatus());
    }

    public function picturesAction($accessToken, $max_id = 0)
    {
        /** @var InstagramService $instagram */
        $instagram = $this->get('instagram');
        $instagram->setAccessToken($accessToken);

        $user = $instagram->getUser();

        $content = $instagram->getMedia($max_id);

        return $this->render('InkStudioProjectgramBundle:Default:gallery.html.twig', [
            'content'  => $content
        ]);


        var_dump($content);
    }
}
