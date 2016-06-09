<?php

namespace InkStudio\ProjectgramBundle\Controller;

use InkStudio\ProjectgramBundle\Services\Instagram\InstagramService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DefaultController extends Controller
{
    public function indexAction (Request $request)
    {
        $cookie = false;
	    if (true === $request->cookies->has($this->getParameter('app_cookie'))) {
		    $cookie = $request->cookies->get($this->getParameter('app_cookie'));
	    }

	    if (false === $cookie) {
		    /** @var InstagramService $instagram */
		    $instagram = $this->get('instagram');

		    return $this->redirect($instagram->getLoginUrl());
	    }

        $response = $this->redirectToRoute('ink_studio_projectgram_inicio');

        return $response;
    }

    public function callbackAction (Request $request)
    {
        $code = $request->get('code');

        if (false === $code || null === $code) {
            return false;
        }

        /** @var InstagramService $instagram */
        $instagram = $this->get('instagram');

        $tokenOAuth = $instagram->getOAuth($code);

        if (false === $tokenOAuth) {
            var_dump('Mierda');
        }

        $cookie = new Cookie('TESTGRAM', $tokenOAuth->access_token);
        $response = $this->redirectToRoute('ink_studio_projectgram_inicio');

        $response->headers->setCookie($cookie);

        return $response;
    }

    public function homeAction(Request $request)
    {
        $OAuthToken = $request->cookies->get($this->getParameter('app_cookie'));
        /** @var InstagramService $instagram */
        $instagram = $this->get('instagram');

        return $this->picturesAction($OAuthToken, 5);

        $instagram->setAccessToken($OAuthToken);
    }

    public function tokenAction (Request $request)
    {

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

    public function testAction()
    {
        echo 'hello!';
    }
}
