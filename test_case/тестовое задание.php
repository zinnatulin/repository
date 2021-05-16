<?php
final class Item {
	int $id;
	string $name;
	int $status;
	bool $changed;

	private Item($id){
		this.id = $id;
	}

	public getId(){
		return $id;
	}

	public getName(){
		return $name;
	}

	public setName($name){
		this.name = $name;
		save();
	}

	public getStatus(){
		return $status;
	}

	public setStatus($status){
		this.status = $status;
		save();
	}

	public getChanged(){
		return $changed;
	}

	public setChanged($changed){
		this.changed = $changed;
	}

	public __get(){
		return array('id' => this.id, 'name' => this.name, 'status' => this.status, 'changed' => this.changed);
	}

	public __set($name, $status, $changed){
		if($name !== '' and $status!== '' and $changed !== '' and is_string($name) and is_int($status) and is_bool($changed)){
			this.name = $name;
			this.status = $status;
			this.changed = $changed;
			save();
		}
		
	}

	public save(){
		$db = new PDO('mysql:host=localhost;dbname=test, root, ""');
		$query = $db->prepare("insert name, status from objects where id=:id");
		$query = $db->execute(array(':id'=>this.id));
	}

	private Init(){
		$db = new PDO('mysql:host=localhost;dbname=test, root, ""');
		$query = $db->prepare("select name, status from objects where id=:id");
		$query = $db->execute(array(':id'=>this.id));
		$row = $query->fetch();
		$name = $row['name'];
		$status = $row['status'];
	}
}

$item = new Item(5);