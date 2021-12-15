<?php

namespace App\Controller;

use App\Services\GiftsServices;
use Couchbase\User;
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

		/*
		 * Add user to database.
		 */
		/*$entityManager = $this->getDoctrine()->getManager();
		$user = new Users();
		$user->setName('Noom');
		$entityManager->persist( $user );
		$entityManager->flush();

		dump('A new user was saved with the id of '. $user->getId() );
		*/


		/*
		 * ################# read users from db. ##########################
		 */
		//$respository = $this->getDoctrine()->getRepository( Users::class);
		// $user = $respository->find(1); //get by id
		//$user = $respository->findOneBy( ['name' => 'Noom', 'id' => 5] );
		//$user = $respository->findAll();

		//$user = $respository->findBy([ 'name' => 'Jame'], ['id' => 'DESC']);

		//dump( $user );

		/*
		 * ####################### Update data to db.
		 */
		/* $entityManager = $this->getDoctrine()->getManager();
		$id = 2;
		$user = $entityManager->getRepository(Users::class)->find($id);
		if( !$user ){
			throw $this->createNotFoundException( 'Not Found the user');
		}
		$user->setName('new Pradow');
		$entityManager->flush();
		dump($user);
		*/

		/*
		 * Removed the user in DB.
		 */
		/*$entityManager = $this->getDoctrine()->getManager();
		$id = 6;
		$user = $entityManager->getRepository(Users::class)->find($id);
		if( !$user ){
			throw $this->createNotFoundException( 'Not Found the user');
		}
		$entityManager->remove($user);
		$entityManager->flush();*/


		/*
		 * Raw query db.
		 * **** Mark not work.
		 */
		/*$entityManager = $this->getDoctrine()->getManager();
		$conn = $this->getDoctrine()->getConnections();
		$sql = '
			SELECT * FROM users u WHERE u.id > :id
		';
		$stmt = $conn->prepare();
		*/





		$post = ['post 1', 'post 2', 'post 3', 'post 4'];

		return $this->render('default/post.html.twig',[
			'posts' => $post
		]);

	}

	/**
	 * @Route("/example/{id}", name="example")
	 */
	public function example(Request $request, Users $users){

		/*
		 * This method have helper for get data in database by URL key.
		 * composer require sensio/framework-extra-bundle
		 */

		dump( $users );

		return $this->render('default/post.html.twig',[
			'posts' => array()
		]);
	}

	/**
	 * @Route("/cycle",name="cycle")
	 */
	public function cycle(Request $request){

		$entityManager = $this->getDoctrine()->getManager();
		$user = new Users();
		$user->setName('Sanook');
		$entityManager->persist( $user );
		$entityManager->flush();

		return $this->render('default/post.html.twig',[
			'posts' => array()
		]);
	}


}
