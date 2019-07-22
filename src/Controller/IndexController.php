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
//______________________________________________________________________________ try.tst/testform

/**
 *
 * @Route("/testform", name="testform")
 * @param Request $request,
 * @return Response
 */
	public function testForm(Request $request):Response
	{



//		return $this->show($request,'pages/test.form.twig');

		$post	= $request->request->get('test_form');


//$this->logger->info(print_r( $post ,1),[__FILE__]);

		$user = new Author();
		$form = $this->createForm(TestForm::class, $user, []);
		$form->handleRequest($request);

		$errs = '';

		if ($form->isSubmitted() && $form->isValid()) {

			$user->setName($post['name']);


			$em = $this->getDoctrine()->getManager();
			$em->persist($user);
			$em->flush();

		}else{
			list($errs, $error_field)	= $this->getFormError( $form );
		}

//$this->logger->info("$errs",[__FILE__]);
/*      */

		return $this->show($request, 'pages/test.form.twig', [ 'userForm' => $form->createView() ]);



	}
//______________________________________________________________________________

}
