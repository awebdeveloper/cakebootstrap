<?php
App::uses('AppController', 'Controller');
/**
 * Ticketcategories Controller
 *
 * @property Ticketcategory $Ticketcategory
 */
class TicketcategoriesController extends AppController {

/**
 * index method
 *
 * @author  Web Developer
 * @return void
 */
	public function admin_index() {
		$this->Ticketcategory->recursive = 0;
		$this->set('ticketcategories', $this->paginate());
	}

/**
 * add method
 *
 * @author  Web Developer
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Ticketcategory->create();
			if ($this->Ticketcategory->save($this->request->data)) {
				$this->Session->setFlash(__('The ticketcategory has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ticketcategory could not be saved. Please, try again.'));
			}
		}
		$parentTicketcategories = $this->Ticketcategory->ParentTicketcategory->find('list');
		$this->set(compact('parentTicketcategories'));
	}

/**
 * edit method
 *
 * @author  Web Developer
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Ticketcategory->id = $id;
		if (!$this->Ticketcategory->exists()) {
			throw new NotFoundException(__('Invalid ticketcategory'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Ticketcategory->save($this->request->data)) {
				$this->Session->setFlash(__('The ticketcategory has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ticketcategory could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Ticketcategory->read(null, $id);
		}
		$parentTicketcategories = $this->Ticketcategory->ParentTicketcategory->find('list');
		$this->set(compact('parentTicketcategories'));
	}

/**
 * to get categories and subcategories
 *
 * @author  Web Developer
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function get_categories_list($id = null) {
		
		$ticketcategories = $this->Ticketcategory->find('all',array('recursive'=>-1));
		pr($ticketcategories);
		foreach ($ticketcategories as $ticketcategory) {
			if($ticketcategory['Ticketcategory']['parent_id'] == 0){
				//$ticketcategorylist[]
			}
		}
		$this->set(compact('parentTicketcategories'));
	}

/**
 * Delete method
 *
 * @author  Web Developer
 * @throws 	MethodNotAllowedException
 * @throws 	NotFoundException
 * @param 	string $id
 * @return 	void
 * @todo 	move existing tickets to parent category
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Ticketcategory->id = $id;
		if (!$this->Ticketcategory->exists()) {
			throw new NotFoundException(__('Invalid ticketcategory'));
		}
		if ($this->Ticketcategory->delete()) {
			$this->Session->setFlash(__('Ticketcategory deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Ticketcategory was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
