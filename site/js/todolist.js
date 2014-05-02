/**
 * These are some helper functions for managing the to do list.
 **/

/**
 * Submits the form and adds an item to your to do list.
 */
function addItem(){
	// This will submit the data and run the second parameter callback function with the returned ajax
		$('#additem').$zaj().submit('/todo/add/', function(r){
			// If ok is returned, refresh. Otherwise alert.
				if(r == 'ok') refreshItems();
				else zaj.alert(r);
		});
	// For more on ajax requests in the Javascript API, see http://framework.outlast.hu/api/javascript-api/ajax-requests/
}

/**
 * Submits a request to toggle item and then refresh the whole todolist.
 * @parameter string itemid The item id you want to toggle.
 * @note Yes, this is not optimal (you wouldn't want to refresh the whole list in this case). But this is a quick demo. :)
 */
function toggleItem(itemid){
	// This will submit a request to toggle the specific item, then refresh all items if toggle was successful
		zaj.ajax.get('/todo/toggle/?id='+zaj.urlencode(itemid), function(r){
			// If ok is returned, refresh. Otherwise alert.
				if(r == 'ok') refreshItems();
				else zaj.alert(r);
		});
	// For more on ajax requests in the Javascript API, see http://framework.outlast.hu/api/javascript-api/ajax-requests/
}


/**
 * Refresh the to do list.
 **/
function refreshItems(){
	// Fetch the todos and insert in todolist section
		zaj.ajax.get('/todo/', $('#todolist'));
	// For more on ajax requests in the Javascript API, see http://framework.outlast.hu/api/javascript-api/ajax-requests/
}