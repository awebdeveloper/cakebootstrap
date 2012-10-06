<?php
App::uses('AppController', 'Controller');
/**
 * Shares Controller
 *
 * @property Share $Share
 */
class SharesController extends AppController {


/**
 * Function to show all shares
 *
 * @return 	void
 * @todo 	pagination
 */
	public function admin_index() {
		$this->Share->recursive = 0;

		$title 		= 'Shares';
		$condition 	= '';

		if(!empty($_GET['user'])){
			$this->Share->User->recursive = -1;
			$user = $this->Share->User->findById($_GET['user']);
			$this->paginate['conditions']['Share.user_id'] = $_GET['user'];
			$title = $user['User']['username'];
			$condition = 'user';
		}	

		if(!empty($_GET['provider']))
		{
			$this->Share->Provider->recursive = -1;
			$provider = $this->Share->Provider->findById($_GET['provider']);	
			$title = $provider['Provider']['name'];
			$this->paginate['conditions']['Share.provider_id'] = $_GET['provider'];
			$condition 	= 'provider';
		}

		$this->Share->recursive = 0;			
		$shares = $this->paginate();
		$this->set(compact('shares','title','condition'));
	}

/**
 * Function to show count of shares
 *
 * @return 	void
 * @todo 	sorting, pagination
 */
	public function admin_stats() {
		$this->Share->recursive = 0;

		$title = 'Shares';
		$condition 	= '';

		if(!empty($_GET['user'])){
			$this->Share->User->recursive = -1;
			$user = $this->Share->User->findById($_GET['user']);
			$this->paginate['conditions']['Share.user_id'] = $_GET['user'];
			$title = $user['User']['username'];
			$condition = 'user';
		}
		else if(!empty($_GET['provider'])){	
			$this->Share->Provider->recursive = -1;
			$provider 	= $this->Share->Provider->findById($_GET['provider']);	
			$this->paginate['conditions']['Share.provider_id'] = $_GET['provider'];
			$title 		= $provider['Provider']['name'];
			$condition 	= 'provider';
		}	

		if(isset($_GET['type']) && $_GET['type'] == 'user'){
			$this->paginate['group']  = 'Share.user_id';
			$this->paginate['fields'] = array('count(Share.id) as count', 'concat(User.username,"") as name',  
												'concat(User.id,"") as id');
			$type = 'user';
		}
		else {
			$this->paginate['group']  = 'Share.provider_id';
			$this->paginate['fields'] = array('count(Share.id) as count', 'concat(Provider.name,"") as name', 
												 'concat(Provider.id,"") as id');
			$type = 'provider';
		}

		
		$this->Share->recursive = 0;			
		$shares = $this->paginate();

		$this->set(compact('shares','type','title','condition'));
	}

}
