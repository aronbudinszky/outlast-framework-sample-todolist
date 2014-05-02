<?php
/**
 * This is a to do item.
 * @package Model
 * @subpackage Example
 */


/**
 * Documentation of cached fields and the data object.
 * @property string $name
 * @property string $completed
 * @property ofwTodoData $data This is documented in /plugins/_project/doc/doc.php. Not required, but allows autocomplete in PhpStorm and others.
 */
class Todo extends zajModel {
	
	/**
	 * __model function. creates the database fields available for objects of this class.
	 * 
	 */
	public static function __model(){
		/////////////////////////////////////////
		// begin custom fields definition:
			$f = new stdClass();
			$f->name = zajDb::name();
			$f->completed = zajDb::boolean();
		// end of custom fields definition
		/////////////////////////////////////////		

		// do not modify the line below!
			$f = parent::__model(__CLASS__, $f); return $f;
	}

	/**
	 * Contruction and static calling methods. These are required and not to be modified!
	 */
	public function __construct($id = ""){ parent::__construct($id, __CLASS__); return true; }
	public static function __callStatic($name, $arguments){ array_unshift($arguments, __CLASS__); return call_user_func_array(array('parent', $name), $arguments); }
	
	
	/**
	 * This method is called after the object is fetched from the database. You will want to use this for caching.
	 **/
	public function __afterFetch(){
		// Let's cache the completed field. You should cache most fields that you want to display in a list.
			$this->completed = $this->data->completed;
	}

}