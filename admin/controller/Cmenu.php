<?php

	require_once "model/Mmenu.php";

	$menu = new Menu();
	switch ($action) {
		case 'add':
      		if ($_POST) {
				$data = $_POST['frm'];
				$menu->addMenu($data);
			}
			$listChid = $menu->listChid(['1', '0']);
			$total = count($listChid); 
    		break;
		case 'list':
			$listMenu = $menu->listMenu();
			$total = count($listMenu);
			if (isset($_GET['active'])) {
				$id = $_GET['id'];
				$data['status'] = '1';
				if ($_GET['active'] == 'yes')
					$data['status'] = '0';
				$menu->updateMenu($data, $id);
				header("Location: index.php?c=menu&a=list");				
			}
			break;
		case 'delete':
			$id = $_GET['id'];
			$menu->deleteMenu($id);
			header("Location: index.php?c=menu&a=list");
			break;
		case 'edit':
			$id = $_GET['id'];
			$edit = $menu->showEdit($id);
			$listChid = $menu->listChid(['1', '0']);
			$total = count($listChid); 
			if ($_POST) {
				$data = $_POST['frm'];
				$menu->updateMenu($data, $id);
				header("Location: index.php?c=menu&a=edit&id=$id");
			}
    		break;
	}

	require_once "view/$controller/V$action.php";

?>