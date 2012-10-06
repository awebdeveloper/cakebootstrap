<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * 
 * @package       Cake.Model
 */
class AppModel extends Model {
	   var $actsAs = array('Containable' );
/**
 * function to check if they are same
 * @author 	Web Developer
 * @see 	http://book.cakephp.org/2.0/en/models/data-validation.html#adding-your-own-validation-methods
 * @example $this->User->find('fulllist');
 * 
 */	
	function isSameAs($check,$field)
	{
		$value = array_values($check);
		$value = $value[0];
		return $value == $this->data[$this->alias][$field];
	}

/**
 * function to check if slug exists. If it does return the data else return false
 * 
 * @param   $slug slug name
 * @param   $FindConditions all find parameters
 * @author 	Web Developer
 * @example $this->User->findIfSlugExists('big-book');
 * 
 */	
	function returnIfSlugExists($slug,$FindConditions=array())
	{
		if(empty($slug))
		{
			return false;
		}
		$ModelName = $this->alias;
		$ModelData = $this->findBySlug($slug,$FindConditions);
		
		if(!isset($ModelData[$ModelName]['id']) || empty($ModelData[$ModelName]['id']))
		{
			return false;
		}
		return $ModelData;
	}
	function returnIfNameExists($name,$FindConditions=array(),$type=null)
	{
		if(empty($name))
		{
			return false;
		}
		$find ='findBy'.$type;

		$ModelName = $this->alias;
		$ModelData = $this->$find($name,$FindConditions);
		
		if(!isset($ModelData[$ModelName]['id']) || empty($ModelData[$ModelName]['id']))
		{
			return false;
		}
		return $ModelData;
	}
	
/**
 * function to check if data exists
 * 
 * @param   $field_name is the table field name
 * @param   $field_value is the value to match
 * @type    $type is first/all/count etc
 * @author Web Developer
 * 
 */	
    function findCount($field_name = null, $field_value = null,$type = 'count')
    {
		
        $record = $this->find($type , array(
            'conditions' => array(
                "$this->name.$field_name" => $field_value
            ) ,
            'recursive' => -1
        ));
        
        return $record;
    }
    
    
    function checkDates($endDate =null)
    {
	
		 $endDate =strtotime($endDate['eligibility_date']); 
		 $startDate = strtotime(date('Y-m-d'));
		 if( $startDate <= $endDate)
		 {
			return true; 
			
		 }
		return false;
	}
	

}
