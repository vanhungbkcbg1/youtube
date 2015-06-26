<?php
/**
 * Created by PhpStorm.
 * User: vanhung
 * Date: 6/20/15
 * Time: 11:24 AM
 */

class PDOImplement
{
    private    $name="root";
    private    $pass="";
    private    $servername="localhost";
    private    $dbname="test";
    private    $db;
    private    function Open()
    {

           try
           {
              $connect="mysql:host=".$this->servername.";dbname=".$this->dbname;

              $this->db=new PDO($connect,$this->name,$this->pass);
               $this->db->exec("SET NAMES 'utf8';");

           }catch (PDOException $ex)
           {
               echo $ex->getMessage();
               exit();
           }

    }
    private  function  Close()
    {
        $this->db=null;
    }

    public   function ExecuteQuery($query)
    {
       try
       {
           $this->Open();
           $pdoStament=$this->db->prepare($query);
           $pdoStament->execute();
           $result = $pdoStament->fetchAll(PDO::FETCH_ASSOC);
           $this->Close();
           return $result;

       }catch (PDOException $ex)
       {
             echo $ex->getMessage();
       }
    }
}
?>