<?php

class User
{
  private $id;

  private $admin;

  private $pseudo;

  private $email;

  private $password;

  private $creationDate;

  private $keySecret;

  public function __construct($id, $admin, $pseudo, $email, $password, $creationDate, $keySecret)
  {
    $this->id = $id;
    $this->admin = $admin;
    $this->pseudo = strtolower($pseudo);
    $this->email = $email;
    $this->password = $password;
    $this->creationDate = $creationDate;
    $this->keySecret = $keySecret;
  }

  public function getId() {
    return $this->id;
  }

  public function setId($id){
    $this->id = $id;
  }

  public function getAdmin() {
    return $this->admin;
  }

  public function setAdmin($admin){
    $this->admin = $admin;
  }

  public function getPseudo() {
    return ucfirst($this->pseudo);
  }

  public function setPseudo($pseudo){
    $this->pseudo = strtolower($pseudo);
  }

  public function getEmail() {
    return $this->email;
  }

  public function setEmail($email){
    $this->email = $email;
  }

  public function getPassword() {
    return $this->password;
  }

  public function setPassword($password){
    $this->password = $password;
  }

  public function getCreationDate() {
    return $this->creationDate;
  }

  public function setCreationDate($creationDate){
    $this->creationDate = $creationDate;
  }

  public function getKeySecret() {
    return $this->keySecret;
  }

  public function setKeySecret($keySecret){
    $this->keySecret = $keySecret;
  }
}
