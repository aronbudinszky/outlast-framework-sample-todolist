<?php
/**
 * This controller handles adding and checking todos off your list.
 * @package Controller
 * @subpackage BuiltinControllers
 **/
	class zajapp_todo extends zajController{
		/**
		 * The __load() magic method is run each time this particular controller is used to process the request. You should place code here which is general for all
		 *  related requests. For example, an admin.ctl.php file's __load() method will likely contain an authentication process, so that anyone requesting
		 *  any admin pages will need to login first...
		 **/
		public function __load(){
			// nothing here for now
		}

		/**
		 * Display my todos interface.
		 **/
		public function main(){
			// Fetch all of my todos
				$this->zajlib->variable->todos = Todo::fetch();
			// Is this an ajax request?
				if($this->zajlib->request->is_ajax()){
					// If this is an ajax request, we only want to display the to do list block.
					return $this->zajlib->template->block('todo/list.html', 'todolist');
				}
				else{
					// For non-ajax requests display the whole template.
					return $this->zajlib->template->show('todo/list.html');
				}
		}

		/**
		 * Add a new to do item.
		 */
		public function add(){
			// First, check if we wrote anything. If there is no data, then return an error msg.
				if(empty($_POST['todoname'])) return $this->zajlib->ajax("You did not fill out a name for this todo!");
			// Create a new todo
				$todo = Todo::create();
				// Set the data and save it (you can chain methods)
				$todo->set('name', $_POST['todoname'])->save();
			// Now just return ok
				return $this->zajlib->ajax('ok');
		}

		/**
		 * Remove a to do item
		 */
		public function remove(){
			// Remove the item
				
			// Now just return ok
				return $this->zajlib->ajax('ok');
		}


		/**
		 * Toggle a to do item.
		 */
		public function toggle(){
			// Fetch my item
				/** @var Todo $todo - this enables autocomplete for PhpStorm */
				$todo = Todo::fetch($_GET['id']);
				// Set completed to the opposite of what it was and save (you can chain methods)
				$todo->set('completed', !$todo->data->completed)->save();
			// Now just return ok
				return $this->zajlib->ajax('ok');
		}

		/**
		 * This method will handle all requests which could not be routed anywhere.
		 * @param string $request A string of the actual request.
		 * @param array $optional_parameters This is only specified when the request is coming from another app and $optional_parameters were given.
		 * @return boolean
		 **/
		function __error($request, $optional_parameters){
			echo "The page $request could not be found.";
			return false;
		}

	}