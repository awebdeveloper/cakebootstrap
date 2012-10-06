<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright	 Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @see		   http://cakephp.org CakePHP(tm) Project
 * @package	   Cake.Controller
 * @since		 CakePHP(tm) v 0.2.9
 * @license	   MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package	 Cake.Controller
 * @see 		http://book.cakephp.org/view/957/The-App-Controller
 */
class AppController extends Controller {
	
/**
 * @var $components  all components used
 */
	public $components = array(
		'Email'=>array(),
		'Session'  => array(),
		'Imagemagick',
		'RequestHandler'=>array(),
		'Auth'				=> array(
			'loginAction' 		=> array(
				'admin' 			=> false,
				'controller' 		=> 'users',
				'action' 			=> 'login'
			),
			'authError' 	=> 'Your session has expire. Please log in to continue',
			'authenticate' 	=> array(
				'Form' 			=> array(
					'fields' 		=> array('username' => 'username')
				),
				'all' => array(
					'userModel' => 'User',
					'scope' => array('User.status' =>array('active','passwordchange','suspended'))
				)
				
			)
		)
	);
	

/**
 * @var $IsAjax weather request is ajax or not
 */
	public $RequestType	= 'NORMAL';
 
/**
 * @var $helpers  all helpers used
 */	
	public $helpers = array('Form', 'Html', 'Text', 'Time','Session');
	
/**
 * @var $paginate default value for pagination
 */
	public $paginate = array(
		'limit' => 5,
	);
	
	
	
/**
 * Called before the controller action.
 *
 * @access public
 * @category core
 * @see http://book.cakephp.org/2.0/en/controllers.html#controller-life-cycle
 * @author Web Developer
 */
	function beforeFilter() 
	{

		parent::beforeFilter();

		//tell Auth to call the isAuthorized function before allowing access 
	  // $this->Auth->authorize = array('Controller');

		//allow all non-logged in users access to items without a prefix 
		if( !isset($this->params['prefix'])) $this->Auth->allow('*'); 
		

		$user = $this->Auth->user();
		//$this->_checkAuth();
	   		
 }	
  /**
  *
  * @author 	Web Developer
  * @version 	$1.0.0$
  * @package 	default
  * @return 	void
  */
	 public function beforeRender()
	 {
		 $this->setLayout();
		 $this->set('_USER',$this->Session->read('Auth.User'));
		 $this->set('inputDefaults', array('label' => false,'div' => array('class'=>'controls')));
	 }

 
/**
 * function logs all the error
 *
 * @return void
 * @param  $error array data to be saved
 * @author Web Developer
 */
	function logError($error='other') 
	{
		$this->loadModel('Errorlog');
		
		$data['Errorlog'] 		 		= $error;
		$data['Errorlog']['url'] 		= $this->request->url;
		$data['Errorlog']['referer'] 	= $this->request->referer();
		$data['Errorlog']['clientip'] 	= $this->request->clientIp();
		$data['Errorlog']['method'] 	= $this->request->method();
		$data['Errorlog']['useragent'] 	= $_SERVER['HTTP_USER_AGENT'];
		
		$this->Errorlog->create();
		$this->Errorlog->save($data);
		$random 	= substr(sha1(rand()),0,6);
		$ErrorCode 	= strtoupper($random .$this->Errorlog->id);
		
		return $ErrorCode;
	}
	
/**
 * function logs all the error
 *
 * @return void
 * @param  $ModelErrors array containing model validation result
 * @param  $ModelName		modelname
 * @author Web Developer
 */	

	function ajaxModelValidation($ModelErrors, $ModelName)
	{
		
		$this->autoRender = false;
		$i = 0;
		foreach ($ModelErrors as $field => $message)
		{
			$error[$i]['field'] 	= Inflector::camelize($ModelName . ucwords($field));
			$error[$i++]['message'] = $message[0];
		}
		
		$message['result']  	= 'error';
		$message['message'] 	= $error;
		echo json_encode($message);
	///	$this->logError('Model_Error', $error, 'Model Error');
	}
	
/**
 * function show success or failure 
 *
 * @return 	void
 * @param  	$redirect mixed where to redirect 
 * @param  	$message string message to be shown
 * @param	$result boolean weather action was successfull or not
 * @author 	Web Developer
 */	

	function showResponse($message,$result,$redirect =false,$exit = true)
	{
		if(!$this->request->is('ajax'))
		{
			if(($result === true))
			{
				$this->Session->setFlash(__($message), 'default', array('class' => 'success'));
			}
			else
			{
				$this->Session->setFlash(__($message));
			}
			
			if($redirect == true)
			{
				$this->redirect($redirect);
			}
			
		}
		else
		{
			if(is_array($result))
			{
				//do something in future
			}
			else
			{
				$error['result']  		= ($result === true) ? 'success' : 'failure';
				$error['applyclass']  	= ($result === true) ? 'success' : 'message';
				$error['message'] 		= $message;
				echo json_encode($error);
			}
		}
		
		if($exit === true)
		{
			exit;
		}
	}


  
 /**
 * Function to decide request type and set corresponding layout 
 *
 * @access 		public
 * @author 		Web Developer
 */

	function requestType() 
	{
		$ajax 			= false;
		$mobile 		= false;
		$MainMenuLink	= false;
		$SubMenuLink	= false;
		
		if($this->request->is('ajax'))
		{
			$this->RequestType	= 'AJAX';
			$this->layout 		= 'ajax';
			$ajax				= true;
		}
		if($this->request->is('mobile'))
		{
			$this->RequestType	= 'MOBILE';
			$mobile				= true;
		}
		
		if(isset($_GET['mainmenulink']))
		{
			$MainMenuLink	= true;
		}
		
		if(isset($_GET['submenulink']))
		{
			$SubMenuLink	= true;
		}
		
		
		$this->set('ajax',$ajax);
		$this->set('mobile',$mobile);
		$this->set('MainMenuLink',$MainMenuLink);
		$this->set('SubMenuLink',$SubMenuLink);
		
	}
	
 /**
 * Function to set layout unless it's ajax or forced
 *
 * @access 		public
 * @author 		Web Developer
 * @param		$LayoutName  string name of the layout 
 */

	function setLayout($LayoutName = null, $force = false) 
	{
		$this->layout ='default';

		if((!empty($this->params['isAjax']) || $this->RequestHandler->isAjax()) && $force == false)
		{
			$this->layout = 'ajax';
		}
		elseif(!empty($LayoutName))
		{
			$this->layout = $LayoutName;
		}
		elseif(!empty($this->params['prefix']) && $this->params['prefix'] == ('admin' || 'support'  || 'dev'))
		{
			$this->layout = 'admin';
		}
		
	}
	

/**
 * Function to allow the non login pages
 * * @access 	Private
 * @author 		Web Developer
 */
	
	function _checkAuth()
	{
		$exception_array = array(
			'designs/index',
			'designs',
			'users/login',
			'users/add',
		);
		$cur_page = $this->params['controller'] . '/' . $this->params['action'];
		if (!in_array($cur_page, $exception_array)) {
			if (!$this->Auth->user('id')) {
				$is_admin = false;
				if (isset($this->params['prefix']) and $this->params['prefix'] == 'admin') {
					$is_admin = true;
				}
 
			  //$this->Session->setFlash(__('Authorization Required'));
			  if($is_admin == 1)
			  {
				  $this->redirect(array(
					'controller' => 'users',
					'action' => 'login','admin'=>true
					
				));
			  
			  }
			
			$this->redirect(array(
					'controller' => 'users',
					'action' => 'login',
					'f'=>base64_encode($this->params->url)
				));
				
			}
		  
		}
		else 
		{
			$this->Auth->allow('*');
		}
   }
	
}
