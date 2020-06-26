<?php
namespace app\models;

use yii\base\Model;
use yii\db\Connection;
use yii\db\Command;

class EntryForm extends Model{
	public $name;
	public $email;
	public $imageFiles;

	public function rules(){
		return [
			[['name', 'email'], 'required'],
			[['imageFiles'], 'file', 'skipOnEmpty' => false, 'maxFiles' => 5],
		];
	}

	public function upload($imageFiles){
		$uniqname = uniqid();
		mkdir("f:/php_interpreter/basic/".$uniqname);
		foreach ($imageFiles as $file) {
			$file->saveAs('f:/php_interpreter/basic/'. $uniqname . "/" . $file->basename . "." . $file->extension);

			$db = new Connection(['dsn' => 'sqlite:f:/php_interpreter/sqlite/test.db']);//занесение данных в базу данных

			$db->createCommand()->insert('files', [
				'name' => $file->name, 
				'date' => date('d.m.Y. h:i:s'),
			])->execute();
		}
	}
}