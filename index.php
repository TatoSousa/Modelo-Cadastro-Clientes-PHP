<!DOCTYPE html>
<html lang="pt-br" charset="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="HandheldFriendly" content="true">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../js/jquery-3.2.1.min.js"></script>
        <script src="../js/cadastro.dados.js"></script>		

		<script type="text/javascript" >
		// NAO ALTERAR
		function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('estado').value=("");
            //document.getElementById('ibge').value=("");
		}
		function meu_callback(conteudo) {
			if (!("erro" in conteudo)) {
				//Atualiza os campos com os valores.
				document.getElementById('rua').value=(conteudo.logradouro);
				document.getElementById('bairro').value=(conteudo.bairro);
				document.getElementById('cidade').value=(conteudo.localidade);
				document.getElementById('estado').value=(conteudo.uf);
				//document.getElementById('ibge').value=(conteudo.ibge);
			} //end if.
			else {
				//CEP não Encontrado.
				limpa_formulário_cep();
				alert("CEP não encontrado.");
			}
		}

		function pesquisacep(valor) {

			//Nova variável "cep" somente com dígitos.
			var cep = valor.replace(/\D/g, '');

			//Verifica se campo cep possui valor informado.
			if (cep != "") {

				//Expressão regular para validar o CEP.
				var validacep = /^[0-9]{8}$/;

				//Valida o formato do CEP.
				if(validacep.test(cep)) {

					//Preenche os campos com "..." enquanto consulta webservice.
					document.getElementById('rua').value="...";
					document.getElementById('bairro').value="...";
					document.getElementById('cidade').value="...";
					document.getElementById('estado').value="...";
					//document.getElementById('ibge').value="...";

					//Cria um elemento javascript.
					var script = document.createElement('script');

					//Sincroniza com o callback.
					script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

					//Insere script no documento e carrega o conteúdo.
					document.body.appendChild(script);

				} //end if.
				else {
					//cep é inválido.
					limpa_formulário_cep();
					alert("Formato de CEP inválido.");
				}
			} //end if.
			else {
				//cep sem valor, limpa formulário.
				limpa_formulário_cep();
			}
		};
    	</script>
   
        <script type="text/javascript" >
		    //NAO ALTERAR
			function validar_cpf( cpf_a_validar ) {

				// remove pontos e traços
				cpf_a_validar = cpf_a_validar.toString();
				cpf_a_validar = cpf_a_validar.replace(/[^0-9]/g, ''); // remove o que não é dígito com regex
				
				// verificar se possui 11 dígitos, o total padrão de um CPF
				if ( cpf_a_validar.length != 11 ) {
					alert("CPF Inválido");
					document.getElementById("cpf_cadastro").value = '';
					return false; // já nã será válido
				}	

				// pegando os 9 dígitos 
				codigo = cpf_a_validar.substr(0, 9);
				
				// fazendo o cálculo para gerar o primeiro dígito
				soma = 0; // será a soma
				numero_calculo = 10; // começa com 10 no primeiro dígito
				for (i=0; i < 9; i++) { 
					soma += ( codigo[i]*numero_calculo-- );	
				}
				$resto = soma%11; // trabalhar com o resto
				if($resto < 2) 
					codigo += "0"; // se for menor que 2 será 0
				else
					codigo += (11-$resto); // caso seja maior que 2 sera subtraído em 11

				// fazendo o cálculo para gerar o segundo dígito
				soma = 0; // zerar a soma
				numero_calculo = 11; // desta vez é 11, para o segundo dígito
				for (i=0; i < 10; i++) { 
					soma += ( codigo[i]*numero_calculo-- );	
				}
				$resto = soma%11; // trabalhar com o resto novamente
				if($resto < 2)  // verifica se é maior que 2
					codigo += "0";
				else
					codigo += (11-$resto);

				// Se forem iguais é porque é válido
				if ( codigo === cpf_a_validar ) {
					//alert("OK");
					return true; // cpd válido!
				} else {
					alert("CPF Inválido");
					document.getElementById("cpf_cadastro").value = '';
					return false; // cpf inválido!
				}
			}
		</script>

		<script type="text/javascript" >
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
					var passwordField = $('#senha_cadastro');
					var passwordFieldType = passwordField.attr('type');
					if (passwordFieldType == 'password')
					{
						passwordField.attr('type', 'text');
						$(this).val('Ocultar a senha');
					} else {
						passwordField.attr('type', 'password');
						$(this).val('Mostrar a senha');
					}
				})
			   });
		</script>

	   <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <title> Cadastro de clientes para as nossas promoções</title>
	</head>
    <body>
        <div class="container">
            <div id="inicio" style="margin-top:20px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
					    <img src="img/logo.png" class="img-responsive">
                        <!-- <div style="margin: 0 auto;" class="panel-title">PARTICIPE DE NOSSAS PROMOÇÕES</div> -->
                    </div>
                    <div class="panel-body" >
                        <form id="signupform" name="cadastro" class="form-horizontal" role="form" method="post" action="customer_access.php" autocomplete="off">
						<div class="form-group">
								<div>
                                    <input type="button" id="queroMeCadastrar" value="QUERO ME CADASTRAR" class="btn btn-info btn-block" onClick="$('#inicio').hide();
                                        $('#cadastro').show()" />
                                </div>
                            </div>
						    <div class="form-group">
								<div>
                                    <input type="button" id="JaTenhoCartao" value="JÁ TENHO CARTÃO TesteBr" class="btn btn-info btn-block" onClick="$('#inicio').hide();
                                        $('#cartao').show()" />
                                </div>
                            </div>
						</form>
                        <form id="signupform" name="cadastro" class="form-horizontal" role="form" method="post" action="customer_access.php" autocomplete="off">
                            <div id="signupalert" style="display:none" class="alert alert-danger">
                                <p>Error:</p>
                                <span></span>
                            </div>
                            <div class="form-group">
                                <div>
                                   <label for="cpf" class="control-label">CPF</label>
									<input type="text" class="form-control" name="cpf_login" id="cpf_login" size="11" pattern="[0-9]+$" maxlength="11" placeholder="CPF somente números" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <label for="senha" class="control-label">Digite uma senha</label>
                                    <input type="password" class="form-control" name="senha" id="senhaLogin" maxlength="10" placeholder="Digite uma senha" required>
                                    <br />
                                    <input class="btn btn-success btn-block" type="submit" name="Submit" value="E N T R A R">
                                </div>
                            </div>
                            <div class="form-group">
                                <!-- Button -->
                                <div>
                                    <input type="button" id="EsqueciMinhaSenha" value="ESQUECI MINHA SENHA" class="btn btn-info btn-block" onClick="$('#inicio').hide();
                                        $('#esqueci').show()" />
                                </div>
                            </div>
						    <div class="form-group">
								<div>
                                    <input type="button" id="br_esclarecimento" value="ESCLARECIMENTO DE DÚVIDAS" class="btn btn-info btn-block" onClick="$('#inicio').hide();
                                        $('#esclarecimento').show()" />
                                </div>
								<div>
                                   <label class="control-label">Dúvidas e sugestões</label>
							     <label class="control-label"><a href='mailto:sugestao@testebr.com.br'>sugestoes@testebr.com.br</a></label>
								</div>
                            </div>
						</form>
                    </div>
                </div>
            </div>
			
    		<!-- Cadastrando -->
            <div id="cadastro" style="display:none; margin-top:20px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                       <img src="img/logo.png" class="img-responsive">
                       <!-- <div class="panel-title">INFORME SEUS DADOS</div> -->
                    </div>
                    <div class="panel-body" >
                        <form id="signupform" name="cadastro" class="form-horizontal" role="form" method="post" action="customer_call.php" autocomplete="off">
                            <div id="signupalert" style="display:none" class="alert alert-danger">
                                <p>Error:</p>
                                <span></span>
                            </div>
                            <div class="form-group">
                                <div>
                                    <label for="cpf" class="control-label">CPF</label>
									<input type="text" class="form-control" name="cpf_cadastro" id="cpf_cadastro" size="11" pattern="[0-9]+$" maxlength="11" placeholder="CPF somente números" onBlur="validar_cpf(this.value)" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <label for="nome" class="control-label">Nome</label>
                                    <input type="text" class="form-control" name="nome" maxlength="80" placeholder="Nome completo" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <label for="rg" class="control-label">RG / RNE</label>
                                    <input type="text" class="form-control" name="rg" maxlength="20" placeholder="RG ou RNE" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                <label for="cep" class="control-label">CEP</label>
                                    <input type="text" class="form-control" name="cep" id="cep" size="8" maxlength="8" onblur="pesquisacep(this.value);" placeholder="CEP somente números">
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                <label for="endereco" class="control-label">Endereço</label>
                                    <input type="text" class="form-control" name="endereco" id="rua" maxlength="80" placeholder="Rua, Avenida, Travessa..." required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                <label for="enderecoNr" class="control-label">Número</label>
                                    <input type="number" class="form-control" name="enderecoNr" placeholder="Digite o número" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                <label for="complemento" class="control-label">Complemento</label>
                                    <input type="text" class="form-control" name="complemento" maxlength="50" placeholder="Apartamento, Bloco, Casa">
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                <label for="bairro" class="control-label">Bairro</label>
                                    <input type="text" class="form-control" name="bairro" id="bairro" maxlength="50" placeholder="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                <label for="cidade" class="control-label">Cidade</label>
                                    <input type="text" class="form-control" name="cidade" id="cidade" maxlength="80" placeholder="" value="São Paulo" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                <label for="estado" class="control-label">Estado</label>
                                    <select class="form-control" name="estado" id="estado"> 
                                        <option value="AC">Acre</option> 
                                        <option value="AL">Alagoas</option> 
                                        <option value="AM">Amazonas</option> 
                                        <option value="AP">Amapá</option> 
                                        <option value="BA">Bahia</option> 
                                        <option value="CE">Ceará</option> 
                                        <option value="DF">Distrito Federal</option> 
                                        <option value="ES">Espírito Santo</option> 
                                        <option value="GO">Goiás</option>  
                                        <option value="MA">Maranhão</option> 
                                        <option value="MT">Mato Grosso</option> 
                                        <option value="MS">Mato Grosso do Sul</option> 
                                        <option value="MG">Minas Gerais</option> 
                                        <option value="PA">Pará</option> 
                                        <option value="PB">Paraíba</option> 
                                        <option value="PR">Paraná</option> 
                                        <option value="PE">Pernambuco</option> 
                                        <option value="PI">Piauí</option> 
                                        <option value="RJ">Rio de Janeiro</option> 
                                        <option value="RN">Rio Grande do Norte</option> 
                                        <option value="RO">Rondônia</option> 
                                        <option value="RS">Rio Grande do Sul</option> 
                                        <option value="RR">Roraima</option> 
                                        <option value="SC">Santa Catarina</option> 
                                        <option value="SE">Sergipe</option> 
                                        <option value="SP" selected="selected">São Paulo</option> 
                                        <option value="TO">Tocantins</option> 
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                <label for="email" class="control-label">E-mail</label>
                                    <input type="email" class="form-control" name="email" maxlength="80" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                <label for="telefone" class="control-label">Telefone</label>
                                    <input type="number" class="form-control" name="telefone" id="telefone" maxlength="15" placeholder="Residencial ou comercial">
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                <label for="celular" class="control-label">Celular</label>
                                    <input type="number" class="form-control" name="celular" id="celular" maxlength="15" placeholder="Celular">
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                <label for="sexo" class="control-label">Sexo</label>
                                    <select class="form-control" name="sexo"> 
                                        <option value="F" selected="selected">Feminino</option> 
                                        <option value="M">Masculino</option> 
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
<!--                                <div>                                    
                                <label for="bday" class="control-label">Data de nascimento</label>
                                    <input type="date" class="form-control" name="data_nascimento" id="bday" data-date-inline-picker="false" required max="2017-08-01" onClick="dataAtual()">
                                </div>
						-->
                             <div>
							   <span class="control-label">Data de nascimento</span>
							 </div>
							 <div class="input-group">
							        <span class="input-group-addon" title="Dia" id="data_mes_label">Dia</span>
									<select id="data_dia" name="data_dia" class="form-control selectpicker">
										<?php
											for ($i=1; $i<=31; $i++)
											{
												?>
													<option value="<?php echo $i;?><?php if($i == 1)echo '" selected="selected';?>"><?php echo $i;?></option>
												<?php
											}
										?>
									</select>
							    <span class="input-group-addon" title="Mês" id="data_mes_label">Mês</span>
								<select id="data_mes" name="data_mes" class="form-control selectpicker">
								  <option value="01" selected>Janeiro</option> 
								  <option value="02">Fevereiro</option>
								  <option value="03">Março</option>
								  <option value="04">Abril</option>
								  <option value="05">Maio</option>
								  <option value="06">Junho</option>
								  <option value="07">Julho</option>
								  <option value="08">Agosto</option>
								  <option value="09">Setembro</option>
								  <option value="10">Outubro</option>
								  <option value="11">Novembro</option>
								  <option value="12">Dezembro</option>
								</select>
								<span class="input-group-addon" title="Ano" id="data_mes_label">Ano</span>
									<select id="data_ano" name="data_ano" class="form-control selectpicker">
										<?php
											for ($i=1; $i<=100; $i++)
											{
												?>
													<option value="<?php echo (2017+1)-$i;?><?php if($i == 1)echo '" selected="selected';?>"><?php echo (2017+1)-$i;?></option>
												<?php
											}
										?>
									</select>
								
							</div>						
                            </div>
                            <div class="form-group">
                                <div>
                                <label for="senha" class="control-label">Digite uma senha</label>
                                    <input type="password" class="form-control" name="senha_cadastro" id="senha_cadastro" maxlength="10" placeholder="Digite uma senha" required>
                                    <br />
                                    <input type="button" id="showPassword" value="MOSTRAR A SENHA" class="btn btn-primary btn-block" />
                                </div>
                            </div>
                            <div class="form-group">
							<div>
                                <label class="control-label">Declaro que li e aceito o <a href="#" onClick="$('#cadastro').hide();
                                        $('#termo').show()">Termo de Adesão</a>.</label>
							</div>
                            </div>
                            <div class="form-group">
                                <!-- Button -->
                                <div>
                                    <input class="btn btn-success btn-block" type="submit" name="Submit" value="SALVAR CADASTRO E VOLTAR">
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <br />
                                    <input type="button" id="CancelarCadastro" value="CANCELAR O CADASTRO" class="btn btn-danger btn-block" onClick="$('#cadastro').hide();
                                        $('#inicio').show()" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Esclarecimento -->
            <div id="esclarecimento" style="display:none; margin-top:20px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
           				<img src="img/logo.png" class="img-responsive">
                    </div>
                    <div class="panel-body" >
                        <form id="signupform" class="form-horizontal" role="form" autocomplete="off">
                            <div id="signupalert" style="display:none" class="alert alert-danger">
                                <p>Error:</p>
                                <span></span>
                            </div>
                            <div class="form-group">
							<div>
                                <p style="text-align: center; padding-left: 5px;"><b>ANIVERSÁRIO DO TesteBr - INICIO 01/08/2017</b></p>
                                <br/>
                                <p style="text-align: justify; padding-left: 5px;">Promoção válida para todas as formas de pagamento.</p>
                                <br/>
                                <p style="text-align: justify; padding-left: 5px;">Você não precisa mais preencher cupons para participar. Basta se cadastrar apenas uma vez no TesteBr Lojas, na loja ou pelo site www.testebr.com.br</p>
                                <br/>
                                <p style="text-align: justify; padding-left: 5px;">Quem é cliente do Cartão TesteBr, não precisa fazer o cadastro, somente deverá criar uma senha de 4 ou 6 digitos para atualizar ou consultar seus dados.</p>
                                <br/>
                                <p style="text-align: justify; padding-left: 5px;">Este cadastro será válido para todas as promoções no TesteBr Lojas.</p>
                                <br/>
                                <p style="text-align: justify; padding-left: 5px;">O regulamento completo da promoção estará disponível a partir do dia 01/08/2017 na loja e no site www.testebr.com.br</p>
                                <br/>
                                <p style="text-align: justify; padding-left: 5px;">Aguardem! Vai ter prêmio todos os dias da promoção!</p>
                                <br/>
                                <p style="text-align: justify; padding-left: 5px;">A família TesteBr deseja Boa Sorte à Todos!</p>
                                <br/>
                                <input type="button" id="fecharEsclarecimento" value="Voltar" class="btn btn-danger btn-block" onClick="$('#esclarecimento').hide();$('#inicio').show()" />
						    </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Cartao -->
            <div id="cartao" style="display:none; margin-top:20px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <img src="img/logo.png" class="img-responsive">
                    </div>
                    <div class="panel-body" >
                        <form id="signupform" class="form-horizontal" role="form" autocomplete="off">
                            <div id="signupalert" style="display:none" class="alert alert-danger">
                                <p>Error:</p>
                                <span></span>
                            </div>
                            <div class="form-group">
                                <br/>
								<div>
									<p style="text-align: center; padding-left: 5px;"><b>JÁ TENHO CARTÃO TesteBr</b></p>
									<br/>
									<p style="text-align: justify; padding-left: 5px;">Obrigado por ser nosso cliente do Cartão TesteBr, não é necessário fazer o cadastro na loja ou acessando o site. Crie uma senha de 4 a 6 dígitos para atualizar e consultar os seus dados</p>
									<br/>
								</div>
							</div>
							<div class="form-group">
							    <div>
									<input type="button" id="EsqueciMinhaSenha" value="CRIE SUA SENHA" class="btn btn-info btn-block" onClick="$('#cartao').hide();
										$('#esqueci').show()" />
								</div>
							</div>
							<div class="form-group">
								<!-- Button -->
								<div>
									<input type="button" id="fecharCartao" value="VOLTAR" class="btn btn-danger btn-block" onClick="$('#cartao').hide();$('#inicio').show()" />
								</div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Esqueci minha senha -->
            <div id="esqueci" style="display:none; margin-top:20px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <img src="img/logo.png" class="img-responsive">
                    </div>
                    <div class="panel-body" >
                        <form id="signupform" class="form-horizontal" role="form" method="post" action="customer_update.php" autocomplete="off">
                            <div id="signupalert" style="display:none" class="alert alert-danger">
                                <p>Error:</p>
                                <span></span>
                            </div>
								<div>
									<p style="text-align: center; padding-left: 5px;"><b>ESQUECI A MINHA SENHA</b></p>
									<br/>
								</div>
                            <div class="form-group">
                                <div>
                                    <label for="cpf" class="control-label">CPF</label>
									<input type="text" class="form-control" name="cpf_esqueci" id="cpf_esqueci" size="11" pattern="[0-9]+$" maxlength="11" placeholder="CPF somente números" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <label for="rg" class="control-label">RG / RNE</label>
                                    <input type="text" class="form-control" name="rg" maxlength="20" placeholder="RG ou RNE" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                <label for="senha" class="control-label">Digite uma NOVA senha</label>
                                    <input type="password" class="form-control" name="senha" id="senhaEsqueci" maxlength="10" placeholder="Digite uma senha" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <input class="btn btn-success btn-block" type="submit" name="Submit" value="ALTERAR A SENHA">
                                </div>
                            </div>
                            <div class="form-group">
                                <!-- Button -->
                                <div>
                                    <input type="button" id="fecharEsqueci" value="VOLTAR" class="btn btn-danger btn-block" onClick="$('#esqueci').hide();$('#inicio').show()" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
			
            <!-- Termo de adesão -->
            <div id="termo" style="display:none; margin-top:20px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <img src="img/logo.png" class="img-responsive">
                    </div>
                    <div class="panel-body" >
                        <form id="signupform" class="form-horizontal" role="form" autocomplete="off">
                            <div id="signupalert" style="display:none" class="alert alert-danger">
                                <p>Error:</p>
                                <span></span>
                            </div>
								<div>
									<p style="text-align: center; padding-left: 5px;"><b>TERMO DE ADESÃO</b></p>
									<br/>
								</div>
                            <div class="form-group">
							<div>
                                <p>1. DEFINIÇÕES</p>
                                <p>1.1. Para o presente, todas as palavras ou expressões constantes da lista abaixo deverão ser entendidas conforme o respectivo significado:</p>
                                <p style="padding-left: 10px;">1.1.1. “USUARIO”: cliente do TesteBr HIPER CENTER que deseje, mediante cadastro, participar de promoções realizadas no TesteBr HIPER CENTER.</p>
                                <br/>
                                <p>2. INFORMAÇÕES INICIAIS</p>
                                <p>2.1. Para poder participar de promoções e receber informativos do TesteBr HIPER CENTER, o USUÁRIO deverá preencher um cadastro. Ao fazê-lo, o usuário irá cadastrar um usuário e senha, sendo esta de uso pessoal e intransferível. Feito isso, o usuário estará habilitado para participar das promoções realizadas.</p>
                                <p>2.2. O cadastro deverá ser preenchido uma única vez, podendo, ocasionalmente, ser solicitado ao USUÁRIO que responda a pesquisas de satisfação, enquetes ou, ainda, seu aceite a eventuais alterações no presente documento.</p>
                                <p>2.3. O USUARIO autoriza expressamente o TesteBr HIPER CENTER a utilizar os seus dados cadastrais em campanhas promocionais realizadas pelo próprio estabelecimento.</p>
                                <p>2.4. O TesteBr HIPER CENTER não compartilha informações pessoais dos USUÁRIOS com outras empresas, organizações ou indivíduos, exceto nas seguintes circunstâncias:</p>
                                <p style="padding-left: 10px;">2.4.1. Com autorização expressa do usuário;</p>
                                <p style="padding-left: 10px;">2.4.2. Para processamento externo;</p>
                                <p style="padding-left: 10px;">2.4.3. Por motivos legais;</p>
                                <br/>
                                <p>3. DISPOSIÇÕES DIVERSAS</p>
                                <p>3.1. O USUÁRIO expressamente declara e garante, para todos os fins de direito:</p>
                                <p style="padding-left: 10px;">3.1.1. Possuir capacidade jurídica para celebrar o presente;
                                <p style="padding-left: 10px;">3.1.2. Reconhecer que o presente termo se formaliza, vinculando as partes, com a confirmação contratual, o que se fará mediante o clique no botão "CADASTRAR";</p>
                                <p style="padding-left: 10px;">3.1.3. Que está ciente e de pleno acordo que será impactado por mídias e informativos, passando a fazer parte da base de dados do TesteBr HIPER CENTER, e;</p>
                                <p style="padding-left: 10px;">3.1.4. Que está ciente e de pleno acordo com todas as condições deste termo.</p>
                                <p style="padding-left: 10px;">3.2. O presente Termo e Condições de Uso são regidos pela legislação da República Federativa do Brasil. Seu texto deverá ser interpretado no idioma português e os USUÁRIOS se submetem ao Foro da Comarca da Capital do Estado de São Paulo para dirimir quaisquer dúvidas do presente.</p>
                                <br/>
                                    <input type="button" id="VoltarParaCadastro" value="Voltar para o cadastro" class="btn btn-danger btn-block" onClick="$('#cadastro').show(); $('#termo').hide()" />
                            </div>
							</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>