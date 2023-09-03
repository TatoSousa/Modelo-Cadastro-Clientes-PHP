<!DOCTYPE html>
<html lang="pt-br" charset="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="HandheldFriendly" content="true">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/jquery-3.2.1.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <title> Cadastro de clientes para as nossas promoções</title>
    </head>
    <body>
        <script type="text/javascript">
            function retornaIndex() {
                location.href = "index.php"
            }
            function dataAtual() {
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth() + 1;
                var yyyy = today.getFullYear();
                if (dd < 10) {
                    dd = '0' + dd;
                }
                if (mm < 10) {
                    mm = '0' + mm;
                }
                today = yyyy + '-' + mm + '-' + dd;
                document.getElementById("bday").setAttribute("max", today);
            }
            $(document).ready(function () {
                $('#showPassword').on('click', function () {
                    var passwordField = $('#senha');
                    var passwordFieldType = passwordField.attr('type');
                    if (passwordFieldType == 'password')
                    {
                        passwordField.attr('type', 'text');
                        $(this).val('Ocultar a senha');
                    } else {
                        passwordField.attr('type', 'password');
                        $(this).val('Mostrar a senha');
                    }
                });
            });
			function mascara_data(campo, valor){
			  var mydata = '';
			  mydata = mydata + valor;
			  if (mydata.length == 2){
				mydata = mydata + '/';
				campo.value = mydata;
			  }
			  if (mydata.length == 5){
				mydata = mydata + '/';
				campo.value = mydata;
			  }
			}
        </script>
		<?php
			include("customer.php");
			$cpf         = htmlspecialchars($_POST["cpf_esqueci"]);
			$nome        = "";
			$rg          = htmlspecialchars($_POST["rg"]);
			$cep         = "";
			$endereco    = "";
			$numero      = "";
			$complemento = "";
			$bairro      = "";
			$cidade      = "";
			$uf          = "";
			$email       = "";
			$foneres     = "";
			$fonecel     = "";
			$datanasc    = "";
			$senha	     = htmlspecialchars($_POST["senha"]);
			$sexo        = "";
			$objeto = new customer( $cpf, $nome, $rg, $cep, $endereco, $numero, $complemento, $bairro, $cidade, $uf, $email, $foneres, $fonecel, $sexo, $datanasc, $senha);
			$consulta = $objeto->updateCustomerPass();
			$encontrado    = 0;
			while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
			  $r_retorno         = $linha['atualizasenha'] ;
			}
		   ?>
        <div class="container">
            <div id="inicio" style="margin-top:20px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">ATUALIZAÇÃO DE SENHA</div>
                    </div>
                    <div class="panel-body" >
                        <form id="signupform" name="cadastro" class="form-horizontal" role="form" autocomplete="off">
    						<div class="form-group">
								<div class="col-md-9">
								    <label class="control-label"><?php echo $r_retorno; ?></label>
                                    <input type="button" id="br_termo" value="VOLTAR" class="btn btn-danger btn-block" onClick="retornaIndex()" />
                                </div>
                            </div>
						</form>
                    </div>
                </div>
			</div>
        </div>
    </body>
</html>