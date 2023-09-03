<?php
    include("conecta.php");
    class customer {
	  private $par_cpf;
	  private $par_nome;
	  private $par_rg;
	  private $par_cep;
	  private $par_endereco;
	  private $par_numero;
	  private $par_complemento;
	  private $par_bairro;
	  private $par_cidade;
	  private $par_uf;
	  private $par_email;
	  private $par_foneres;
	  private $par_fonecel;
	  private $par_sexo;
	  private $par_datanasc;
	  private $par_senha;
	  
      function __construct( $cpf, $nome, $rg, $cep, $endereco, $numero, $complemento, $bairro, $cidade, $uf, $email, $foneres, $fonecel, $sexo, $datanasc, $senha){
      	   $this->par_cpf         = $cpf;        //(string)addslashes($cpf);
           $this->par_nome        = $nome;       //(string)addslashes($nome);
           $this->par_rg          = $rg;         //(string)addslashes($rg);
           $this->par_cep         = $cep;        //(string)addslashes($cep);
           $this->par_endereco    = $endereco;   //(string)addslashes($endereco);
           $this->par_numero      = $numero;     //(int)addslashes($numero);
           $this->par_complemento = $complemento;//(string)addslashes($complemento);
           $this->par_bairro      = $bairro;     //(string)addslashes($bairro);
           $this->par_cidade      = $cidade;     //(string)addslashes($cidade);
           $this->par_uf          = $uf;         //(string)addslashes($uf);
           $this->par_email       = $email;      //(string)addslashes($email);
           $this->par_foneres     = $foneres;    //(string)addslashes($foneres);
           $this->par_fonecel     = $fonecel;    //(string)addslashes($fonecel);
           $this->par_sexo        = $sexo;       //(string)addslashes($sexo);
           $this->par_datanasc    = $datanasc;   //(string)addslashes($datanasc);
           $this->par_senha       = $senha;      //(string)addslashes($senha);
        }

		function retornaArray(){
           $a['par_cpf']         =$this->par_cpf;
           $a['par_nome']        =$this->par_nome;
           $a['par_rg']          =$this->par_rg;
           $a['par_cep']         =$this->par_cep;
           $a['par_endereco']    =$this->par_endereco;
           $a['par_numero']      =$this->par_numero;
           $a['par_complemento'] =$this->par_complemento;
           $a['par_bairro']      =$this->par_bairro;
           $a['par_cidade']      =$this->par_cidade;
           $a['par_uf']          =$this->par_uf;
           $a['par_email']       =$this->par_email;
           $a['par_foneres']     =$this->par_foneres;
           $a['par_fonecel']     =$this->par_fonecel;
           $a['par_sexo']        =$this->par_sexo;
           $a['par_datanasc']    =$this->par_datanasc;
           $a['par_senha']       =$this->par_senha;
           return $a;
       }

       function updateCustomer(){
         $comando = "SELECT * FROM AtualizaClientesInternet('" . 
                                                             (string)addslashes($this->par_cpf)         . "','" .
                                                             (string)addslashes($this->par_nome)        . "','" .
                                                             (string)addslashes($this->par_rg)          . "','" .
                                                             (string)addslashes($this->par_cep)         . "','" .
                                                             (string)addslashes($this->par_endereco)    . "',"  .
                                                             (string)addslashes($this->par_numero)      . ",'"  .
                                                             (string)addslashes($this->par_complemento) . "','" .
                                                             (string)addslashes($this->par_bairro)      . "','" .
                                                             (string)addslashes($this->par_cidade)      . "','" .
                                                             (string)addslashes($this->par_uf)          . "','" .
                                                             (string)addslashes($this->par_email)       . "','" .
                                                             (string)addslashes($this->par_foneres)     . "','" .
                                                             (string)addslashes($this->par_fonecel)     . "','" .
                                                             (string)addslashes($this->par_sexo)        . "','" .
                                                             (string)addslashes($this->par_datanasc)    . "','" .
                                                             (string)addslashes($this->par_senha)       . "')"; 

 		 $objetoBanco = new Conectando();
         $objetoBanco->iniciaConexao();
		 $execute = $objetoBanco->execute($comando, false);
		 $objetoBanco->finalizaConexao();
          
         /* header("Location: index.php"); */ 
       }
	   
	   function selectCustomer(){
		 $comando = "SELECT * FROM retornaCrmLocalizado('" . (string)addslashes($this->par_cpf) . "','" . (string)addslashes($this->par_senha) . "')";
         $objetoBanco = new Conectando();
         $objetoBanco->iniciaConexao();
		 $execute = $objetoBanco->execute($comando, false);
		 $objetoBanco->finalizaConexao();
		 return $execute;
	   }

	   function updateCustomerPass(){
		 $comando = "SELECT atualizaSenha FROM atualizaSenha('" . (string)addslashes($this->par_cpf) . "','" . (string)addslashes($this->par_rg) . "','" . (string)addslashes($this->par_senha) . "')";
         $objetoBanco = new Conectando();
         $objetoBanco->iniciaConexao();
		 $execute = $objetoBanco->execute($comando, false);
		 $objetoBanco->finalizaConexao();
		 return $execute;
	   }
    }
  ?>