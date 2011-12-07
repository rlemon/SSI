<?php

class Inventory extends Controller {

	function __construct() {
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIn');
		if ($logged == false) {
			Session::destroy();
			header('location: ../login');
			exit;
		}
		
		$this->view->js = array('inventory/js/default.js');
	}
	
	function index() {
		/* this is the default method for all controllers */
		$this->itemList();
	}
	
	function itemList() {
		$filter = ' WHERE ';
		if( isset($_GET['suppliers']) && !empty($_GET['suppliers']) ) {
			$filter .= '(part_supplier_id IN (' . implode(',', $_GET['suppliers']) . ')) AND ';
		}
		if( isset($_GET['groups']) && !empty($_GET['groups']) ) {
			$filter .= '(inv.id IN (SELECT item_id FROM group_item_mapping WHERE group_id IN (' . implode(',', $_GET['groups']) . '))) AND ';
		}
		if( isset($_GET['text']) && !empty($_GET['text']) ) {
			$filter .= '(inv.part_code LIKE "%' . $_GET['text'] . '%" OR inv.part_description LIKE "%' . $_GET['text'] . '%") AND ';
		}
		$filter .= '1';
		
		$this->view->suppliers = $this->model->getSuppliers();
		$this->view->groups = $this->model->getGroups();
		$this->view->rowData = $this->model->getItems($filter);
		$this->view->render('inventory/itemList');
	}

	function createItem() {
		if( isset($_POST['submit']) ) {
			$id = $this->model->addItem($_POST['part_code'], $_POST['part_description'], $_POST['part_supplier_id'], $_POST['supplier_part_code'], $_POST['loc'], $_POST['qty'], $_POST['unit_cost'], $_POST['groups']);
			header('Location: ' . URL . 'inventory/itemList');
		}
		
		/** Default values for new item template */
		$this->view->itemDefaults = array(
			'part_code' => 'DM_',
			'part_description' => 'No Description',
			'supplier_part_code' => 'SPC_',
			'loc' => 'X',
			'qty' => '0',
			'unit_cost' => '0.00'
		);
		$this->view->suppliers = $this->model->getSuppliers();
		$this->view->groups = $this->model->getGroups();
		$this->view->render('inventory/createItem');
	}

/*	Creates a new item and loads the edit page. 
	function createBlankItem() {
		$id = $this->model->addItem('DM_', 'No Description', -1, '', 'A', '0', '0.00', array());
		header('Location: ' . URL . 'inventory/editItem/' . $id);
		//$this->editItem($id);
	}
*/

	function editItem($id) {
		if( isset($_POST['submit']) ) {
			$this->model->updateItem($_POST['id'], array(
				'part_code' => $_POST['part_code'],
				'part_description' => $_POST['part_description'],
				'part_supplier_id' => $_POST['part_supplier_id'],
				'supplier_part_code' => $_POST['supplier_part_code'],
				'loc' => $_POST['loc'],
				'qty' => $_POST['qty'],
				'unit_cost' => $_POST['unit_cost']
			), $_POST['groups']);
			header('Location: ' . URL . 'inventory/itemList');
		}
		$filter = ' WHERE inv.id = ' . $id;
		$this->view->items = $this->model->getItems($filter);
		$this->view->suppliers = $this->model->getSuppliers();
		$this->view->groups = $this->model->getGroups();
		$this->view->render('inventory/editItem');
	}
	
	function deleteItem($id) {
		$this->model->deleteItem($id);
		header('Location: ' . URL . 'inventory/itemList');
	}
}
