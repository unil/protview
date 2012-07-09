<?php

class  RESTController extends xWebController {
	var $model = null;
	
	/**
	 * Allowed CRUD operations.
	 * Possible values: 'get', 'post', 'put', 'delete'
	 * @see get()
	 * @see post()
	 * @see put()
	 * @see delete()
	 * @var array
	 */
	var $allow = array('get', 'post', 'put', 'delete');
	
    /**
     * Manages action redirection
     * according the received params and the available controller actions.
     */
    function defaultAction() {
    	if (!isset($this->params['id'])) {
    		if (method_exists($this, 'indexAction')) return $this->indexAction();
    	} else {
    		if (method_exists($this, 'detailAction')) return $this->detailAction();
    	}
    	throw new xException('Not found', 404);
    }
    
    /**
     * API Method.
     * Generic get method for API calls.
     * @param mixed Any model fields for filtering, or a query parameter for search
     * @return array An ExtJS compatible resultset structure.
     */
    function get() {
    if (!in_array('get', $this->allow)) throw new xException("Method not allowed", 403);
        // Fetches data
        $count = xModel::load(
            $this->model,
            xUtil::filter_keys($this->params, array('xoffset', 'xlimit', 'xorder_by', 'xorder'), true)
        )->count();
        $items = xModel::load(
            $this->model,
            $this->params
        )->get();
        // Determines wheter to return a 404 status
        $pk = xModel::load($this->model)->primary();
        $fields = array_keys(xModel::load($this->model)->mapping);
        $by_id = in_array($pk, array_keys($this->params)) && !array_intersect($this->params, $fields);
        if ($by_id && !$count) {
            $resource = xModel::load($this->model)->name;
            throw new xException("The requested {$resource} does not exist", 404);
        }
        // Creates extjs compatible result
        return array(
            'xcount' => $count,
            'items' => $items
        );
    }
    /**
     * API Method.
     * Generic post method for API calls.
     * @param array items: contains an array of model fields and values.
     * @return array An ExtJS compatible resultset structure.
     */
    function post() {
        // Checks if method is allowed
        if (!in_array('post', $this->allow)) throw new xException("Method not allowed", 403);
        // Checks provided parameters
        if (!isset($this->params['items'])) throw new xException('No items provided', 400);
        // Checks for params.id and params.items.id consistency
        // (this test is only for precaution: params.id is not used in anyway)
        if (@$this->params['id'] != @$this->params['items']['id'])
            throw new xException("Parameters id and items.id do not match", 400);
        // Database action
        $r = xModel::load($this->model, $this->params['items'])->post();
        // Result
        $i = xController::load($this->get_name(), array('id'=>$this->params['items']['id']))->get();
        $r['items'] = array_shift($i['items']);
        return $r;
    }
    /**
     * API Method.
     * Generic put method for API calls.
     * @param array items: contains an array of model fields and values.
     * @return array An ExtJS compatible resultset structure.
     */
    function put() {
        // Checks if method is allowed
        if (!in_array('put', $this->allow)) throw new xException("Method not allowed", 403);
        // Checks provided parameters
        if (!isset($this->params['items'])) throw new xException('No items provided', 400);
        // Prevents posting a versioned record
        if (@$this->params['xversion']) throw new xException('Cannot put a versioned record', 400);
        // Checks for params.id and params.items.id consistency
        // (this test is only for precaution: params.id is not used in anyway)
        if (@$this->params['id'] != @$this->params['items']['id'])
            throw new xException("Parameters id and items.id do not match", 400);
        // Database action
        $r = xModel::load($this->model, $this->params['items'])->put();
        // Result
        $i = xController::load($this->get_name(), array('id'=>$r['xinsertid']))->get();
        $r['items'] = array_shift($i['items']);
        return $r;
    }
	 /**
     * API Method.
     * Generic delete method for API calls.
     * @note This method is to be used as default. For nn relationship tables,
     *       one should refine the method in specific controller classes.
     * @param integer id: the id parameter of the record to delete
     * @return array An ExtJS compatible resultset structure.
     */
    function delete() {
        // Checks if method is allowed
        if (!in_array('delete', $this->allow)) throw new xException("Method not allowed", 403);
        // Database action + result
        return xModel::load($this->model, array('id'=>@$this->params['id']))->delete();
    }

}