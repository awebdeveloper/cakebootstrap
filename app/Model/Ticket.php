<?php
App::uses('AppModel', 'Model');
/**
 * Ticket Model
 *
 * @property Ticketcategory $Ticketcategory
 * @property Ticketcomment $Ticketcomment
 */
class Ticket extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'ticketcategory_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
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
		'Ticketcategory' => array(
			'className' => 'Ticketcategory',
			'foreignKey' => 'ticketcategory_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'email',
			'conditions' => '`User`.`email` = `Ticket`.`email`',
			'fields' => '',
			'order' => ''
		),
		'Assignee' => array(
			'className' => 'User',
			'foreignKey' => 'assignee_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);



/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Ticketcomment' => array(
			'className' => 'Ticketcomment',
			'foreignKey' => 'ticket_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
