<?php

	require_once 'Crud.php';

	class Usuarios extends Crud{

		protected $table = 'hospede';
		private $nome;
		private $email;

		public function setNome($nome){

			$this->nome = $nome;
		}

		public function setEmail($email){

			$this->email = $email;
		}

		public function insert(){

			$sql = "INSERT INTO $this->table (nome, email) VALUES (:nome, :email)";
			$stmt = DB::prepare($sql);
			$stmt->bindParam(':nome', $nome);
			$stmt->bindParam(':email', $email);
			return $stmt->execute(); 
		}

		public function update($id){

			$sql = "UPDATE $this->table SET nome = :nome, email = :email WHERE id = :id";
			$stmt = DB::prepare($sql);
			$stmt->bindParam(':nome', $this->nome);
			$stmt->bindParam(':email', $this->email);
			$stmt->bindParam(':id', $this->id);
			return $stmt->execute(); 
		}
	}

?>