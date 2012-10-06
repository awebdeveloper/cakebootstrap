<?php
App::uses('AppController', 'Controller');
/**
 * Tickets Controller
 *
 * @property Ticket $Ticket
 */
class TicketsController extends AppController {

/**
 * @var $AllTicketCategories  all possible Ticket Categories
 */
	var $allTicketCategories = array();	

/**
 * @var $AllTicketstatus  all possible Ticket Status
 */
	var $allTicketStatus = array('new'	=>'New', 	'resolved'=>'Resolved',	'duplicate'=>'Duplicate',
								 'hold'=>'Hold',	'invalid' =>'Invalid',	'in_progress'=>'In Progress');									   
/**
 * @var $AllTickettype  all possible Ticket type
 */
	var $allTicketType  = array('bug'=>'Bug','help'=>'Help');
	
 

/**
 * Called before the controller action.
 *
 * @access 		public
 * @category 	core
 * @see 		http://book.cakephp.org/2.0/en/controllers.html#controller-life-cycle
 * @author 		Web Developer
 */
	function beforeFilter() 
	{
	    parent::beforeFilter();	
		$this->allTicketCategories 	= $this->Ticket->Ticketcategory->find('list');
		$this->set('allTicketCategories',$this->allTicketCategories);
		$this->set('allTicketStatus',$this->allTicketStatus);
		$this->set('allTicketType',$this->allTicketType);
	}
/**
 * index method
 *
 * @author  Web Developer
 * @return 	void
 */
	public function admin_index($tickettype='all',$assignee ='') {
		$this->Ticket->recursive = 0;
		if(!in_array($tickettype, array('help','bug')))
		{
			$tickettype = 'All';
		}
		else
		{
			$conditions['Ticket.tickettype'] = $tickettype;
		}

		
		if($assignee !== 'all')
		{
			$conditions[] = 'Ticket.assignee_id = 0 or Ticket.assignee_id  IS NULL  or Ticket.assignee_id  ='.$this->Auth->user('id');
		}
		else
		{
			$conditions[] = 'Ticket.email = "'.urldecode($_GET['email']).'"';
		}

		$this->paginate['conditions'] = $conditions;

		$this->set('tickets',  $this->paginate());
		$this->set(compact('assignee','tickettype'));
	}

/**
 * view method
 *
 * @author  Web Developer
 * @throws 	NotFoundException
 * @param 	string $id
 * @return 	void
 */
	public function admin_view($id = null) {
		$this->Ticket->id = $id;
		if (!$this->Ticket->exists()) {
			throw new NotFoundException(__('Invalid ticket'));
		}
		$this->Ticket->Behaviors->attach('Containable');
		$ticket = $this->Ticket->find('first',array(
     							'conditions'=> array('Ticket.id'=> $id),
    							'contain' 	=> array('Ticketcategory',
    												 'User','Assignee',
    												 'Ticketcomment'=> array('User')
    							)
     					));
		$this->set('ticket', $ticket);
	}

/**
 * edit method
 *
 * @author  Web Developer
 * @throws 	NotFoundException
 * @param 	string $id
 * @return 	void
 */
	public function admin_edit($id = null) {
		$this->Ticket->id = $id;
		if (!$this->Ticket->exists()) {
			throw new NotFoundException(__('Invalid ticket'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Ticket->save($this->request->data)) {
				$this->Session->setFlash(__('The ticket has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ticket could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Ticket->read(null, $id);
		}
		$AsssigneesList = $this->Ticket->User->find('all',array(
													'conditions'=>array('UserType.name'=>array('support','admin')),
													'fields' =>array('User.username','User.id'),
													'recursive' => 0
			));
		foreach($AsssigneesList as $assignee)
		{
			$Asssignees[$assignee['User']['id']] = Inflector::humanize($assignee['User']['username']);
		}
		$this->set(compact('Asssignees'));
	}

/**
 * Function to update/comment on a ticket user provided it belongs to him or is a admin staff
 *
 * @param 		string $id
 * @return 		void
 * @author 		Web Developer
 * @todo		Model validations not showing up
 * @status		developing
 */
	public function admin_comment($id = null) 
	{
		$FieldsToSaveorValidate = array('Ticket.title','Ticket.user_id','Ticket.tickettype',
										'Ticket.ticketcategory_id','Ticketcomment.clientip',
										'Ticketcomment.user_id','Ticketcomment.useragent',
										'Ticketcomment.description');
										
		$ticket = $this->Ticket->findById($id);
		$user	= $this->Auth->user();


		if (($this->request->is('post') || $this->request->is('put')) && isset($this->request->data['Ticketcomment']['description']))
		{
			$data['Ticket']['id'] 						= $id;
			$data['Ticketcomment'][0]['ticket_id'] 		= $id;
			$data['Ticketcomment'][0]['user_id']   		= $user['id'];
			$data['Ticketcomment'][0]['clientip'] 	 	= $this->request->clientIp();
			$data['Ticketcomment'][0]['description'] 	= $this->request->data['Ticketcomment']['description'];
			
			if(empty($ticket['Ticket']['assignee_id']))
			{
				$data['Ticket']['assignee_id'] 			= $user['id'];
			}

			if(isset($this->request->data['Ticket']['status']) && !empty($this->request->data['Ticket']['status']))
			{
				$data['Ticket']['status'] 		= 'resolved';
			}
			else
			{
				$data['Ticket']['status'] 		= 'in_progress';
			}
			
			
			if ($this->Ticket->saveAssociated($data))
			{
				$this->Session->setFlash(__('The ticket has been Updated'));
				$this->redirect(array('admin'=>TRUE,'action'=>'view',$id));
			}
		}
		$this->Session->setFlash(__('Please fill all fields and try again Later'));
		$this->redirect(array('action'=>'view',$id));
	}

}
