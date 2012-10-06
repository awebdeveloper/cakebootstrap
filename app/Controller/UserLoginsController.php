<?php
App::uses('AppController', 'Controller');
/**
 * UserLogins Controller
 *
 * @property UserLogin $UserLogin
 */
class UserLoginsController extends AppController {

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->UserLogin->recursive = 0;
		$this->set('userLogins', $this->paginate());
	}

/**
 * Function to show comments by a user
 *
 * @author 	Web Developer
 * @throws 	NotFoundException
 * @param 	string $userId
 * @return 	void
 */
	public function admin_user_index($userId = null) {
		$this->UserLogin->User->id = $userId;
		if (!$this->UserLogin->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}

		$this->UserLogin->User->recursive = -1;
		$user = $this->UserLogin->User->findById($userId);	

		$this->UserLogin->recursive = 0;
		$this->paginate['conditions']['UserLogin.user_id'] = $userId;
		$userLogins = $this->paginate();

		$this->set(compact('userLogins','user'));
	}
	
}
