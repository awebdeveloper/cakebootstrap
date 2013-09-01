<?php
App::uses('AppController', 'Controller');
/**
 * Shares Controller
 *
 * @property Share $Share
 * @property PaginatorComponent $Paginator
 */
class SharesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Share->recursive = 0;
		$this->set('shares', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Share->exists($id)) {
			throw new NotFoundException(__('Invalid share'));
		}
		$options = array('conditions' => array('Share.' . $this->Share->primaryKey => $id));
		$this->set('share', $this->Share->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Share->create();
			if ($this->Share->save($this->request->data)) {
				$this->Session->setFlash(__('The share has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The share could not be saved. Please, try again.'));
			}
		}
		$users = $this->Share->User->find('list');
		$providers = $this->Share->Provider->find('list');
		$userLogins = $this->Share->UserLogin->find('list');
		$this->set(compact('users', 'providers', 'userLogins'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Share->exists($id)) {
			throw new NotFoundException(__('Invalid share'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Share->save($this->request->data)) {
				$this->Session->setFlash(__('The share has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The share could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Share.' . $this->Share->primaryKey => $id));
			$this->request->data = $this->Share->find('first', $options);
		}
		$users = $this->Share->User->find('list');
		$providers = $this->Share->Provider->find('list');
		$userLogins = $this->Share->UserLogin->find('list');
		$this->set(compact('users', 'providers', 'userLogins'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Share->id = $id;
		if (!$this->Share->exists()) {
			throw new NotFoundException(__('Invalid share'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Share->delete()) {
			$this->Session->setFlash(__('The share has been deleted.'));
		} else {
			$this->Session->setFlash(__('The share could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
