<?php

namespace InkStudio\ProjectgramBundle\Controller;

use InkStudio\ProjectgramBundle\Services\Instagram\InstagramService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction ()
    {
    	/** @var InstagramService $instagram */
		$instagram = $this->get('instagram');

        return $this->redirect($instagram->getLoginUrl());

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
}
