<?php
   include("display-errors.php");
   class Conectando {
       private $driver   = "pgsql";
       private $host     = "127.0.0.1";
       private $port     = "5432";
       private $dbname   = "promocao";
       private $username = "postgres";
       private $password = "post";
       private $rowcount = 0;

       function iniciaConexao(){
          try{
             $dsn  = $this->driver.":host=".$this->host.
                                   ";port=".$this->port.
                                   ";dbname=".$this->dbname.
                                   ";user=".$this->username.
                                   ";password=".$this->password;
             $conn = new PDO($dsn);
             return $conn;
          } catch (PDOException $e){
             echo $e->getMessage();
          }
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       }

       function finalizaConexao(){ $conn = null;}

       function execute($query, $insertId = false){
          try{
               $conn = $this->iniciaConexao();
               if($conn){
                  $result = $conn->query($query);
               }
               $this->finalizaConexao();
             }catch (PDOException $e){
                 echo "<h1>Um erro ocorreu ao executar esta ação " . $e->getMessage() . "</h1>";
                 echo "<h2>Você será direcionado para a página de acesso</h2>";
                 echo "<meta http-equiv=\"refresh\" content=\"1;url='../index.php'>";       
             };
         return $result; //true OR false ou o numero (ID) do registro alterado/adicionado
        }

		   function adiciona($table, array $data, $insertId = false){
         $table  = $table;   
	       $fields = implode(', ', array_keys($data));
	       $values = implode("', '", $data);
	       $query  = "INSERT INTO {$table} ({$fields}) VALUES ('{$values}')";
           return $this->execute($query, $insertId);
        }

       function atualiza($table, array $data, $where = null, $insertId = false){
           foreach($data as $key => $value){
              $fields[] = "{$key} = '{$value}'";
           };
           $fields = implode(', ',$fields);
           $table  = $table;
           $where  = ($where) ? " WHERE {$where}" : null;
           if(is_null($where)){
              echo "Erro na atualização";
              return false;
           }
           $query  = "UPDATE {$table} SET {$fields}{$where}";
           return $this->execute($query, $insertId);
        }
        
       function apaga($table, $where = null){
           $table  = $table;
           $where  = ($where) ? " WHERE {$where}" : null;
           if(is_null($where)){
             echo "Erro na atualização do registro";
             return false;
           }
           $query  = "DELETE FROM {$table}{$where}";
           return $this->execute($query);
        }
    }
?>