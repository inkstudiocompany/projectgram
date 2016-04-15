<?php

namespace InkStudio\ProjectgramBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	/*$securityGram = $this->get('instagram_security');

    	var_dump($securityGram); die();

		$userId = $securityGram->getUserId('inkstudiocompany');

		if ($userId === false) {
			echo 'NO se encontró al usuario';
			return false;
		}

		$posts = $securityGram->getPosts($userId);
		
		var_dump($userId, $posts);*/

		$instagram = $this->get('instagram');

		var_dump($instagram);
		
        return $this->render('InkStudioProjectgramBundle:Default:index.html.twig');
    }
}
