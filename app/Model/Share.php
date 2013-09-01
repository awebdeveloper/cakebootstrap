<?php
App::uses('AppModel', 'Model');
/**
 * Share Model
 *
 * @property User $User
 * @property Provider $Provider
 * @property UserLogin $UserLogin
 */
class Share extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'provider_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Provider' => array(
			'className' => 'Provider',
			'foreignKey' => 'provider_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'UserLogin' => array(
			'className' => 'UserLogin',
			'foreignKey' => 'user_login_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
