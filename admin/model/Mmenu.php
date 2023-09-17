<?php

class Menu extends Uploader
{
	const tbl = 'menu_tbl';
	public function addMenu($data)
	{
		$this->setTbl(self::tbl);
		$this->insertData($data);
	}

	public function listChid($arr)
	{
		$this->setTbl(self::tbl);
		$sql = $this->chooseData(['status', 'chid'], true);
		$sql->bindParam(":val1", $arr[0]);
		$sql->bindParam(":val2", $arr[1], PDO::PARAM_INT);
		$sql->execute();
		$row = $sql->fetchAll(PDO::FETCH_OBJ);
		return $row;
	}

	public function listMenu()
	{
		$this->setTbl(self::tbl);
		$row = $this->selectData('*');
		return $row;
	}

	public function deleteMenu($id)
	{
		$this->setTbl(self::tbl);
		$this->deleteData($id);
	}

	public function updateMenu($data, $id)
	{
		$this->setTbl(self::tbl);
		$this->updateData($data, $id);
	}

	public function showEdit($id)
	{
		$this->setTbl(self::tbl);
		$row = $this->showData('id', $id);
		return $row;
	}
}