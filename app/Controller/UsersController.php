<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {



/**
 * function to logout the user
 *
 * @return 		void
 * @author 		Web Developer
 *  
 */
	public function logout() 
	{
		$this->Auth->logout();	
		$this->redirect(array('action' => 'login'));
	}
	
/**
 * Function to Login to Admin panel or Users dashboard
 * 
 * @param  		void
 * @return 		void
 * @author 		Web Developer
 */

	public function login() 
	{ 
		$this->layout = null;
		/* no login if already logged in */
		//	$this->_checkAndRedirect();
		
		if($this->request->is('post')) 
		{

			$this->User->set($this->request->data['User']);
			unset($this->User->validate['username']['isUnique']);
			unset($this->User->validate['username']['between']);

			if($this->User->validates())
			{
				if ($this->Auth->login()) 
				{
					$data['UserLogin']['user_id'] 		= $this->Auth->user('id');
					$data['UserLogin']['ip_address'] 	= $this->request->clientIp();
					$data['UserLogin']['referer'] 		= $this->request->referer();
					$data['UserLogin']['user_agent'] 	= env('HTTP_USER_AGENT');
					
					/* browser details like version/os */
					if(function_exists('get_browser'))
					{
						$browser = get_browser(null, true);
						$data['UserLogin']['browser'] = $browser['browser'] . ' ' . $browser['version'];
						$data['UserLogin']['operating_system'] 		= $browser['platform'];
					}
					
					$this->User->UserLogin->save($data);
					$UserType = $this->User->UserType->findById($this->Auth->user('user_type_id'));
	        		$this->Session->write('Auth.User.UserType',$UserType['UserType']['name']);
	        		
					
					/* Redirect user accordingly based on account status*/
					$AccountStatus = $this->Auth->user('status');
					$this->_checkAndRedirect($AccountStatus);
				} 
				else {
						$this->Session->setFlash(__('Username or password is incorrect'), 'default', array('class'=>'error'), 'auth');
				}	
			}	 
		}
	}
	
/**
 *
 * This function to check and redirect after login
 * @param  		string 		$AccountStatus 		User account status
 * @return 		void
 * @author 		Web Developer
 * @todo: 		Config variables setting is pending
 */
	
	function _checkAndRedirect($AccountStatus)
	{
		$UserType = strtolower($this->Auth->user('UserType'));
		if($AccountStatus =='passwordchange')
		{
			$this->redirect(array('controller'=>'users','action'=>'password_change'));
		}
		else if(in_array($AccountStatus,array('suspended','deleted')))
		{
			$this->Session->setFlash(__('The user has been suspended or deleted'));
			$this->Auth->logout();
			$this->redirect(array('/'));
		}
		else if($UserType == 'dev')
		{
			$this->redirect(array('action' => 'dashboard', 'dev'=>true));
		}
		else if(in_array($UserType, array('admin')))
		{
			$this->redirect(array('action' => 'dashboard', 'admin'=>true));
		}
		else
		{
			$this->Auth->logout();
			$this->redirect(array('action' => 'login'));
		}
		
	}
	
/**
 *
 * This is the admins dashboard
 * @param  		void
 * @return 		void
 * @author 		Web Developer
 * @todo: 		Config variables setting is pending
 */
	function admin_dashboard()
	{
		$this->layout = 'admin';
		
		$periods = array(
				'day' => array(
						'display' => __('Today') ,
						'conditions' => array(
								'TO_DAYS(NOW()) - TO_DAYS(created) <= ' => 0,
						)
				) ,
				'week' => array(
						'display' => __('This week') ,
						'conditions' => array(
								'TO_DAYS(NOW()) - TO_DAYS(created) <= ' => 7,
						)
				) ,
				'month' => array(
						'display' => __('This month') ,
						'conditions' => array(
								'TO_DAYS(NOW()) - TO_DAYS(created) <= ' => 30,
						)
				) ,
				'total' => array(
						'display' => __('Total') ,
						'conditions' => array()
				)
		);
		

		
	 	$models[] = array(
				'User' => array(
						'display' => 'Admin' ,

						'conditions' => array(
								'User.user_type_id' =>'1',
						) ,
						'alias' => 'UserAuthor',
						 
				)
		);
		$models[] = array(
				'User' => array(
						'display' => 'Users' ,
						'conditions' => array(
								'User.user_type_id' =>'2',
						) ,
						'alias' => 'UserAll',
					 
				)
		);
		
		$models[] = array(
				'User' => array(
						'display' => 'Movies' ,
						'alias' => 'FreeSite',	
				)
		); 
		
		
		foreach($models as $unique_model) 
		{
		
			foreach($unique_model as $model => $fields) 
			{
				foreach($periods as $key => $period) 
				{
					$conditions = $period['conditions'];
					if (!empty($fields['conditions'])) 
					{
							$conditions = array_merge($periods[$key]['conditions'], $fields['conditions']);
					}

					$aliasName = !empty($fields['alias']) ? $fields['alias'] : $model;
					
					$new_periods = $period;
					foreach($new_periods['conditions'] as $p_key => $p_value) {
							unset($new_periods['conditions'][$p_key]);
							$new_periods['conditions'][str_replace('created', $model . '.created', $p_key) ] = $p_value;
					}
					$conditions = $new_periods['conditions'];
					if (!empty($fields['conditions'])) {
							$conditions = array_merge($new_periods['conditions'], $fields['conditions']);
					}
				 
					$this->set($aliasName . $key, $this->{$model}->find('count', array(
							'conditions' => $conditions,'recursive'=>-1
					)));
						
				}
			}
		}

		
		$this->set(compact('loggedUsers', 'recentUsers', 'onlineUsers', 'periods', 'models'));
	}

/**
 *
 * This is the developers dashboard
 * @param  		void
 * @return 		void
 * @author 		Web Developer
 * @todo: 		Config variables setting is pending
 */
	function dev_dashboard()
	{
		 // Cache file read
		$log_base_path  = APP . DS.'tmp'. DS.'logs'. DS;
		$error_log 		= $debug_log = '';

		if (file_exists($log_base_path.'error.log')) 
		{
			file_get_contents($log_base_path.'error.log', NULL, NULL, 0, 10240);
		}

		if (file_exists($log_base_path.'debug.log')) 
		{
			file_get_contents($log_base_path.'debug.log', NULL, NULL, 0, 10240);
		}
		$this->set('error_log', $error_log);
		$this->set('debug_log', $debug_log);
	}
	
/**
 *
 * function to clear the log and debug files created on tmp folder
 * @param  		void
 * @return 		void
 * @author 		Web Developer
 * @todo: 		Config variables setting is pending
 */
	function dev_clear_logs()
	{
		if (!empty($this->params['named']['type'])) {
				if ($this->params['named']['type'] == 'error_log') {
						unlink(APP . '/tmp/logs/error.log');
						$this->Session->setFlash(__('Error log has been cleared') , 'default', null, 'success');
				} elseif ($this->params['named']['type'] == 'debug_log') {
						unlink(APP . '/tmp/logs/debug.log');
						$this->Session->setFlash(__('Debug log has been cleared') , 'default', null, 'success');
				}
		}
		$this->redirect(array(
				'controller' => 'users',
				'action' => 'admin_dashboard'
		));
	}


/**
 * Admin function to list all users. An dev can view admin/backend users too
 * but others can view only actual site users
 *
 * @return 		void
 * @param 		string 			$status 		determines what kind of users to show
 * @author 		Web Developer
 * @todo		restrict user_type access 
 */

	public function admin_index() {
		$this->User->recursive = 0;
		$conditions = array('User.status'=> 'active');
		$this->paginate = array(
						     'conditions' => $conditions
						  );
		$this->set('users', $this->paginate());
	}



/**
 * Admin function to view users details. An dev can view admin/backend users too
 * but others can view only actual site users
 *
 * @param 		integer 		$id 		id of user
 * @return 		void
 * @author 		Web Developer
 * @todo		restrict user_type access 
 */
	public function admin_view($id = null)
	{
		/* check if user exists and he is not dev */
		$user = $this->User ->findById($id);		
		
		if(!isset($user['User']['id']) || empty($user) ) 
		{
			throw new NotFoundException(__('Invalid user'));
		}		
		$this->User->id = $user['User']['id'];
		
		$this->set('user', $user);
	}


/**
 * Admin function to delete user. For a deleted user his staus is set to 'deleted'
 * An dev can delete any users but others can delete only actual site users
 *
 * @author 		Web Developer
 * @param 		integer 		$id 		id of user
 * @return 		void
 * @todo		restrict user_type access  
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid User'));
		}
		if ($this->User->saveField('status', 'deleted')) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index','support'=>TRUE));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index','support'=>TRUE));
	}
	
/**
 * Admin function to reset user password
 *
 * @param 		integer 		$id 		id of user
 * @return 		void
 * @author 		Web Developer 
 * @todo		restrict user_type access
 *              send mail
 */
	public function admin_passwordreset($id = null) 
	{
		$FieldsToSaveorValidate = array('password','account_status');	
		
		if ($this->request->is('post') || $this->request->is('put')) 
		{
			/* check if user exists and he is not dev */
			$user = $this->User ->findById($id);		
				
			if(!isset($user['User']['id']) || empty($user) || $user['UserType']['name'] == 'dev') 
			{
				throw new NotFoundException(__('Invalid user'));
			}		
			$this->User->id = $user['User']['id'];
			
			/* set user password to the default password and change account status*/
			$this->request->data['User']['password'] 		= Configure::read('SiteSetting.defaultpassword');
			$this->request->data['User']['account_status'] 	= 'passwordchange';
			
			if ($this->User->save($this->request->data,false,$FieldsToSaveorValidate)){
				$this->Session->setFlash(__('The Password has been reset'),'default',array('class'=>'success'));
				$this->redirect(array('action' => 'view',$id,'support'=>true));
			}
		}
		
		$this->Session->setFlash(__('Password could not be reset'));
		$this->redirect(array('action' => 'view',$id,'support'=>true));
	}
	
		

}
