<?php
App::uses('AppController', 'Controller');
/**
 * Messages Controller
 *
 * @property Message $Message
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class MessagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index($id = null) {
		$this->loadModel('Users');
		//$this->Users->find('all', array('conditions'=>array('id'=>$id)));
		$userProf = $this->Users->find('first', array('conditions'=>array('id'=>$id)));
		$this->set('userProf', $userProf);
		$this->Message->recursive = 0;
		$auth = $this->Auth->user();
		$this->Paginator->settings = array(
			'conditions' => array(
				'OR' =>array(
					array('user_id'=>$auth['id'], 'sender_id'=>$id),
					array('sender_id'=>$auth['id'], 'user_id'=>$id),
				)
			),
			'order'=>'modified DESC',
		);
		$this->set('messages', $this->Paginator->paginate());
		$this->set('user_id', $id);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
		$this->set('message', $this->Message->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id) {
		$this->set('user_id', $id);
		if ($this->request->is('post')) {
			$auth = $this->Auth->user();
			$data = array(
				'message' => $this->request->data('Message.message'),
				'user_id' => $auth['id'],
				'sender_id' => $id
			);
			//debug($data);
			$this->Message->create();
			if ($this->Message->save($data)) {
				$this->Flash->success(__('The message has been saved.'));
				return $this->redirect(array('action' => 'index', $id));
			} else {
				$this->Flash->error(__('The message could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Message->save($this->request->data)) {
				$this->Flash->success(__('The message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The message could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
			$this->request->data = $this->Message->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Message->id = $id;
		if (!$this->Message->exists()) {
			throw new NotFoundException(__('Invalid message'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Message->delete()) {
			$this->Flash->success(__('The message has been deleted.'));
		} else {
			$this->Flash->error(__('The message could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
