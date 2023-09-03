<!DOCTYPE html>
<html lang="pt-br" charset="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="HandheldFriendly" content="true">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/jquery-3.2.1.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <title> Atualizando cadastros</title>
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
		</head>
		<body>
		<?php
			include("customer.php");
			$cpf         = htmlspecialchars($_POST["cpf_cadastro"]);
			$nome        = htmlspecialchars($_POST["nome"]);
			$rg          = htmlspecialchars($_POST["rg"]);
			$cep         = htmlspecialchars($_POST["cep"]);
			$endereco    = htmlspecialchars($_POST["endereco"]);
			$numero      = htmlspecialchars($_POST["enderecoNr"]);
			$complemento = htmlspecialchars($_POST["complemento"]);
			$bairro      = htmlspecialchars($_POST["bairro"]);
			$cidade      = htmlspecialchars($_POST["cidade"]);
			$uf          = htmlspecialchars($_POST["estado"]);
			$email       = htmlspecialchars($_POST["email"]);
			$foneres     = htmlspecialchars($_POST["telefone"]);
			$fonecel     = htmlspecialchars($_POST["celular"]);
			$sexo        = htmlspecialchars($_POST["sexo"]);
			
			$data_dia    = htmlspecialchars($_POST["data_dia"]);
			$data_mes    = htmlspecialchars($_POST["data_mes"]);
			$data_ano    = htmlspecialchars($_POST["data_ano"]);

            $datanasc = $data_ano . "-" . $data_mes . "-" . $data_dia;

			$senha	     = htmlspecialchars($_POST["senha_cadastro"]);
			if(empty($numero)) $numero = 0;
			$objeto = new customer( $cpf, $nome, $rg, $cep, $endereco, $numero, $complemento, $bairro, $cidade, $uf, $email, $foneres, $fonecel, $sexo, $datanasc, $senha);
			$objeto->updateCustomer();
	    ?>
        <div class="container">
            <div id="inicio" style="margin-top:20px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">ATUALIZAÇÃO DE CADASTRO</div>
                    </div>
                    <div class="panel-body" >
                        <form id="signupform" name="cadastro" class="form-horizontal" role="form" autocomplete="off">
    						<div class="form-group">
								<div class="col-md-9">
								    <label class="control-label">Atualizado com sucesso</label>
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