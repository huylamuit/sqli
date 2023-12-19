<?php
class db
{
  public $con;
  public $servername = "localhost";
  public $username = "root";
  public $password = "";
  public $dbname = "sqli";
  function __construct()
  {
     $this->con = mysqli_connect($this->servername, $this->username, $this->password);
    mysqli_select_db($this->con, $this->dbname);
    mysqli_query($this->con, "SET NAMES'UTF8'");
  }
}