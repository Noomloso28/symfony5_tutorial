<?php

namespace App\Controller;

use App\Services\GiftsServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Users;

//cookies
use Symfony\Component\HttpFoundation\Cookie;
//session
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class DefaultController extends AbstractController
{
	public function __construct()
	{

	}

	/**
	 * @Route("/index/", name="index")
	 */

	public function index( GiftsServices $giftsServices ): Response
	{
		/*$users = array(
			"Noom" , "Jame", "Kwang" , "Thip"
		);*/

		/*$users = new Users;
		$users->setName('Jame');*/
		/*$entityManager = $this->getDoctrine()->getManager();
		$entityManager->persist( $users );
		$entityManager->flush();*/

		$users = array();
		$users = $this->getDoctrine()->getRepository(Users::class)->findAll();

		//flash message.
		$this->addFlash(
			'notice', //warning, success
			'notice message'
		);

		//cookies
		$cookies = new Cookie(
			'cookies_name',
			'cookie value',
			time() + ( 2*2*60*60 )
		);
		$res = new Response();
		$res->headers->setCookie( $cookies );
		///Clear cookies //$res->headers->clearCookie('cookies_name');
		$res->sendHeaders();





		return $this->render('default/index.html.twig', [
			'controller_name' => 'IndexContffffffgfroller',
			'users' => $users,
			'random_gifts' => $giftsServices->gifts
		]);

	}

	/**
	 * @Route("session/{param?}", name="session")
	 */
	public function session( SessionInterface $session , Request $request ){


		//var_dump( $request->cookies->get('PHPSESSID') );

		$session->set('test_session' , 1110 );
		if( $session->has( 'test_session' ) ){
			echo "sesion test_session = ".$session->get('test_session' );
		}

		$session->remove('test_session');

		/*
		 * create for POST GET metond.
		 */
		echo '<br>';
		echo "get page url id = ".$request->query->get('page', 'NULL');

		/*
		exit(
			$this->generateUrl(
				'session',
				array( 'param' => 122 )
			)
		);*/
		return $this->render('default/session.html.twig', [
			'test_varible' => 'Varible Name'
		]);
	}


    /**
     * @Route("/default/{name}", name="default")
     */
    public function index_backup( $name ): Response
    {
        /*return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
        */

	   // return new Response( 'Hello !!!'.$name );

	    //return $this->redirect( 'http://www.symfony.com');
	    return $this->redirectToRoute('default2');
    }

	/**
	 * @Route("/default2", name="default2")
	 */
	public function default2(){

		return new Response('I here default2');

	}

	/**
	 * @Route("/posts", name="posts")
	 */
	public function posts(){

		$post = ['post 1', 'post 2', 'post 3', 'post 4'];

		return $this->render('default/post.html.twig',[
			'posts' => $post
		]);

	}


}
