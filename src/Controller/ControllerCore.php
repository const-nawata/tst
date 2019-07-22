<?php
namespace App\Controller;

/**
 * Created by PhpStorm.
 * User: Nawata
 * Date: 03.03.2019
 * Time: 14:30
 */

//use Omines\DataTablesBundle\Controller\DataTablesTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Psr\Log\LoggerInterface;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Omines\DataTablesBundle\DataTableFactory;

class ControllerCore  extends AbstractController
{
//	use DataTablesTrait;

	protected $params;
	protected $logger;
	protected $datatableFactory;


	public function __construct( ParameterBagInterface $params, LoggerInterface $logger/*, DataTableFactory $datatableFactory*/ ){
		$this->params = $params;
		$this->logger = $logger;
//		$this->datatableFactory = $datatableFactory;
	}
//______________________________________________________________________________

	/**
	 * extends render method
	 * @param string $view
	 * @param array $parameters
	 * @param Response|null $response
	 * @param Request $request
	 * @return Response
	 */
	protected function show(Request $request, string $view, array $parameters = [], Response $response = null ): Response
	{
//		$parameters['locale_name']		= 'langs.'.$request->getLocale();
//		$parameters['shop_name']	= $this->params->get('shop_name');
		return $this->render( $view, $parameters, $response );
	}
//______________________________________________________________________________

	protected function getQueryStr( Request $request ){
		$params	= $request->query->all();
		$query	= [];
		foreach( $params as $param => $value ){
			$query[]	= $param.'='.$value;
		}
		$query	= implode('&', $query);
		return empty($query) ? '' : '?'.$query;
	}
//______________________________________________________________________________

//	protected function createDataTable(array $options = [])
//	{
//		return $this->datatableFactory->create($options);
//	}


	protected function getFormError( $form ){
		$fields = $form->all();

//$this->logger->info("count: ".count($fields),[__FILE__]);

		$error_field = '';

		foreach ( $fields as $field ) {
			$errs	= $field->getErrors(true)->__toString();

			if(!empty($errs)){
				$error_field	= $field->getName();
				break;
			}
		}

		return [ $errs, $error_field ];
	}

}