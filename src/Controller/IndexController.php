<?php
namespace App\Controller;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

//	Annotations
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Author;
use App\Form\TestForm;

/**
 * @Route("/")
 * @author Nawata
 */
class IndexController extends ControllerCore
{

/**
 * @Route("/", name="index")
 * @param Request $request,
 * @return Response
 */
	public function index(Request $request):Response
	{
		return $this->show($request,'pages/index.twig');
	}
//______________________________________________________________________________

/**
 * @Route("/testform", name="testform")
 * @param Request $request,
 * @return Response
 */
	public function testform(Request $request):Response
	{



//		return $this->show($request,'pages/test.form.twig');


		$user = new Author();
		$form = $this->createForm(TestForm::class, $user, []);
		$form->handleRequest($request);

		$errs = '';
/*
		if ($form->isSubmitted() && $form->isValid()) {
			$user->setPassword(
				$passwordEncoder->encodePassword(
					$user,
					$form->get('plainPassword')->getData()
				)
			);

			$user->setConfirmed(false);

//			$user->setRoles(['ADMIN']);
			$user->setRoles(['USER']);

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($user);
			$entityManager->flush();

			return $guardHandler->authenticateUserAndHandleSuccess(
				$user,
				$request,
				$authenticator,
				'main'
			);
		}else{
			list($errs, $error_field)	= $this->getFormError( $form );
		}


/*      */

		return $this->show($request, 'pages/test.form.twig', [ 'userForm' => $form->createView() ]);



	}
//______________________________________________________________________________

}
