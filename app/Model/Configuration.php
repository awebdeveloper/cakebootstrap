<?php
App::uses('AppModel', 'Model');
/**
 * Configuration Model
 *
 */
class Configuration extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Cannot be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),			
			'isunique' => array(
				'rule' => array('isunique'),
				'message' => 'Alreday Exists',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'code' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Cannot be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isunique' => array(
				'rule' => array('isunique'),
				'message' => 'Alreday Exists',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'value' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Cannot be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'type' => array(
			'inlist' => array(
				'rule' => array('inlist',array('text','enum','json','boolean','date','time','email','tel','url','textlist','datelist','timelist','urllist','tellist')),
				'message' => 'Invalid Type',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'category' => array(
			'inlist' => array(
				'rule' => array('inlist',array('dev','admin','basic','extended')),
				'message' => 'Invalid Category',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'devonly' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Invalid Value',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
/**
 * function to get all the configuration
 *
 * @return void
 * @category dev
 * @author Prathik S Shetty
 */
	public function getSettings() 
	{
		$data = $this->find('all');
		$config = array();
		foreach($data as $key => $value)
		{
			if(strpos($value['Configuration']['type'],'list'))
			{
				$value['Configuration']['value'] = explode('|||',$value['Configuration']['value']);
			}
			$config['SiteSetting'][strtolower($value['Configuration']['code'])] = $value['Configuration']['value'];
		}
		return $config;
	}
	
}
