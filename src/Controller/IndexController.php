<?php
namespace App\Controller;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

//	Annotations
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
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
		$post	= $request->request->get('test_form');

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
		return $this->show($request, 'pages/test.form.twig', [ 'userForm' => $form->createView() ]);
	}
//______________________________________________________________________________

/**
 *
 * @Route("/getjson", name="getjson")
 * @param Request $request,
 * @return JsonResponse
 */
	public function testJson(Request $request):JsonResponse
	{
		return new JsonResponse([ 'success'	=> true, 'count' => 10 ]);
	}
//______________________________________________________________________________ JsonResponse

/**
 * @Route("/uploadform", name="uploadform")
 * @param Request $request,
 * @return Response
 */
	public function uploadFormAction(Request $request):Response
	{
		return $this->show($request,'pages/upload.form.twig');
	}
//______________________________________________________________________________ try.tst/uploadform

/**
 * @Route("/uploadfile", name="uploadfile")
 * @param Request $request,
 * @return JsonResponse
 */
	public function uploadFileAction(Request $request):JsonResponse
	{
		// retrieve the file with the name given in the form.
		// do var_dump($request->files->all()); if you need to know if the file is being uploaded.

		$file = $request->files->get('upload');
		$status = array('status' => "success","fileUploaded" => false);

		// If a file was uploaded
		if(!is_null($file)){
			// generate a random name for the file but keep the extension
			$filename = uniqid().".".$file->getClientOriginalExtension();
			$path = "uploads";
			$file->move($path,$filename); // move the file to a path
			$status = array('status' => "success","fileUploaded" => true);
		}

		return new JsonResponse($status);
	}
//______________________________________________________________________________ try.tst/uploadform

}
