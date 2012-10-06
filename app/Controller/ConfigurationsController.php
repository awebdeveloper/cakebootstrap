<?php
App::uses('AppController', 'Controller');


class ConfigurationsController extends AppController {
	
/**
 * @var $layout layout used 
 */
	var $layout = 'admin';
	


/**
 * @var $AllConfigurationTypes  all possible configuration types
 */
	var $AllConfigurationTypes = array('text'=>'Text','boolean'=>'Boolean','date'=>'Date',
									   'time'=>'Time','email'  =>'Email','tel'   =>'Tel',
									   'url' =>'URL','textlist'=>'Textlist','datelist'=>'Datelist',
									   'timelist'=>'Timelist','urllist'=>'URLlist','tellist'=>'Tellist');									   
	function beforeFilter() 
	{
	    parent::beforeFilter();
		$this->set('AllConfigurationTypes',$this->AllConfigurationTypes);
	}

/**
 * dev_index method
 *
 * @return 		void
 * @author 		Web Developer
 */
	public function dev_index() 
	{
		$this->Configuration->recursive = 0;
		$this->set('configurations', $this->paginate());
	}

/**
 * admin_index method
 *
 * @return 		void
 * @author 		Web Developer
 */
	public function admin_index() 
	{
		$this->Configuration->recursive = 0;
		$Configurations = $this->Configuration->find('all');			
		
		if(empty($Configurations)){
			
			throw new NotFoundException(__('Invalid configuration'));
		}
		
		/* Process before displaying to user */
		foreach($Configurations as $key => $configuration)
		{
			if(!empty($configuration['Configuration']['allowedvalues']))
			{
				$Configurations[$key]['Configuration']['allowedvalues'] = $this->_explode($configuration['Configuration']['allowedvalues']);
			}
		}	
		unset($configuration);
		
		if ($this->request->is('post') || $this->request->is('put')) 
		{
			$ConfigurationData = array();
			foreach($Configurations as $configuration)
			{
				$code = $configuration['Configuration']['code'];
				if(isset($this->request->data['Configuration']['value'][$code]))
				{
					/* Process before saving */
					$value = $this->_processvalue($this->request->data['Configuration']['value'][$code],$configuration['Configuration']['type']);
					$ConfigurationData[] = array('Configuration' => array('value' 	=> $value, 
																  		  'id' 		=> $configuration['Configuration']['id']));
				}
			}
			
			if($this->Configuration->saveMany($ConfigurationData))
			{
				$this->Session->setFlash(__('The configuration has been saved'));
				$this->redirect(array('action' => 'index'));
			} 
			else 
			{
				$this->Session->setFlash(__('The configuration could not be saved. Please, try again.'));
			}
			
		}
		 
		$this->set('configurations', $Configurations);
	}
	
/**
 * Dev add method
 *
 * @return 		void
 * @category 	dev
 * @author 		Web Developer
 */
	public function dev_add() 
	{
		
		if ($this->request->is('post'))
		{
			$this->Configuration->create();
			$this->request->data['Configuration']['allowedvalues'] = $this->_implode($this->request->data['Configuration']['allowedvalues']);
			if ($this->Configuration->save($this->request->data)) 
			{
				$this->Session->setFlash(__('The configuration has been saved'));
				$this->redirect(array('action' => 'index'));
			} 
			else 
			{
				$this->Session->setFlash(__('The configuration could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @param 		string $id
 * @return 		void
 * @category 	admin
 * @author 		Web Developer
 */
	public function admin_edit($id = null) 
	{
		$Configuration = $this->Configuration->read(null, $id);
		
		$this->Configuration->id = $id;
		if (!isset($Configuration['Configuration']['id']) || $Configuration['Configuration']['devonly'] == 0 ) 
		{
			throw new NotFoundException(__('Invalid configuration'));
		}
		if ($this->request->is('post') || $this->request->is('put')) 
		{
			
			/* Process before saving */
			$this->request->data['Configuration']['value'] = array_unique($this->request->data['Configuration']['value']);
			if(strpos($Configuration['Configuration']['type'],'list') !== false)
			{
				$this->request->data['Configuration']['value'] = $this->_implode($this->request->data['Configuration']['value']);
			}

			if ($this->Configuration->saveField('value',$this->request->data['Configuration']['value'])) 
			{
				$this->Session->setFlash(__('The configuration has been saved'));
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(__('The configuration could not be saved. Please, try again.'));
			}
			$this->request->data['Configuration']['type'] = $Configuration['Configuration']['type'];
		} 
		else 
		{
			$this->request->data = $Configuration;
		}
		
		$this->request->data['Configuration']['value'] 			= $this->_explode($this->request->data['Configuration']['value']);
		$this->request->data['Configuration']['allowedvalues'] 	= $this->_explode($Configuration['Configuration']['allowedvalues']);
		
	
	}
/**
 * Dev edit method
 *
 * @param 		string $id
 * @return 		void
 * @category 	dev
 * @author 		Web Developer
 */
	public function dev_edit($id = null) 
	{
		$Configuration = $this->Configuration->read(null, $id);
		
		
		$this->Configuration->id = $id;
		if (!isset($Configuration['Configuration']['id']) ) 
		{
			throw new NotFoundException(__('Invalid configuration'));
		}
		if ($this->request->is('post') || $this->request->is('put')) 
		{
			
			/* Process before saving */
			if(strpos($Configuration['Configuration']['type'],'list') !== false)
			{
				$this->request->data['Configuration']['value'] 		= $this->_implode($this->request->data['Configuration']['value']);
			}
			$this->request->data['Configuration']['allowedvalues'] 	= $this->_implode($this->request->data['Configuration']['allowedvalues']);
			
			
			
			if ($this->Configuration->save($this->request->data)) 
			{
				$this->Session->setFlash(__('The configuration has been saved'));
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(__('The configuration could not be saved. Please, try again.'));
			}
			$this->request->data['Configuration']['type'] = $Configuration['Configuration']['type'];
		} 
		else 
		{
			$this->request->data = $Configuration;
		}
		
		$this->request->data['Configuration']['allowedvalues'] = $this->_explode($this->request->data['Configuration']['allowedvalues']);
	}

/**
 * Dev_delete method
 *
 * @param 		string $id
 * @return 		void
 * @category 	dev
 * @author 		Web Developer
 */
	public function dev_delete($id = null) 
	{
		if (!$this->request->is('post')) 
		{
			throw new NotFoundException(__('Invalid Request'));
		}
		
		$this->Configuration->id = $id;
		if (!$this->Configuration->exists()) 
		{
			throw new NotFoundException(__('Invalid configuration'));
			
		}
		if ($this->Configuration->delete()) 
		{
			$this->Session->setFlash(__('Configuration deleted'));
			$this->redirect(array('action'=>'index'));
		}

		$this->logError(array('type'=>'412'));
		$this->Session->setFlash(__('Configuration was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * function to implode a array to save in db
 *
 * @param 		array $data array to be imploded 
 * @return 		string $result 
 * @author 		Web Developer 
 */
	private function _implode($data)
	{
		$result = '';
		if(!is_array($data))
		{
			return $data;
		}
		foreach($data as $value)
		{
			$value = trim($value);
			if(!empty($value))
			{
				$result = $result.$value.'|||';
			}
		}
		return substr($result, 0,-3);
	}
	
/**
 * function to explode a array to save in db
 *
 * @param 		array $data array to be imploded 
 * @return 		string $result 
 * @author 		Web Developer
 */
	private function _explode($data)
	{
		if(strpos($data,'|||') === false)
		{
			return $data;
		}
		
		$result  = explode('|||',$data);
		$results = array();
		foreach($result as $value)
		{
			$results[$value] = $value;
		}
		return $results;
	}
	
/**
 * function to explode a array to save in db
 *
 * @param  		string $value value to be processed
 * @param  		string $type  type of the value
 * @param  		string $allowedvalues allowed values
 * @return 		string $result 
 * @author 		Web Developer
 */
	private function _processvalue($value,$type,$allowedvalues=null)
	{
		switch($type)
		{
			case 'date' 		:	return $value['year'].'-'.$value['month'].'-'.$value['day'];
									break;
			case 'time' 		: 	return implode(':',$value);
									break;
			case 'datelist'		: 	break;  
			case 'timelist'		:	break;
			case 'boolean'		:	return intval($value);
									break;
			case 'emaillist'	: 
			case 'urllist'		:
			case 'textlist'		:	 
			case 'tellist'		: 	foreach($value as $item)
									{
										if(!is_array($allowedvalues) || in_array($item,$allowedvalues))
										{
											$data[] = $item;
										}
									}
									$value = $this->_implode($data);
									return $value;
									break;
			case 'email'		:   
			case 'url'			: 
			case 'boolean'		:  
			case 'text' 		:  	
			default				: 	if(!is_array($allowedvalues) || in_array($value, $allowedvalues))
									{
										return $value;
									}
									break;
		}
		
		return $value;
	}
	
	
}
