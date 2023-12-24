<?php
    if(isset($_COOKIE['admin'])){
        header("Location:home.php");
}

    if(isset($_COOKIE['usuario'])){
        header("Location:homeusuario.php");
}
    
    if(isset($_COOKIE['operador'])){
        header("Location:hometech.php");
    }

    include "include/header.php" ;
    include "include/banco.php";

    $query3 = "select unidade from unidades";
    $cons = mysqli_query($con, $query3);


?>
<section id="index">
    <div class="index container">
        <div class="row">
            <div class="offset-md-3 col-md-6 col-xs-12 col-sm-12">
               
                <form action="login.php" method="post" class="acesso card">
                    <div class="card-header text-center">
                            Acesso Restrito
                    </div>
                    
                    <div class="card-body">
                        <div class="form-group">
                            <label for="emailLogin">Email:</label>
                            <input id="emailLogin" name="emailLogin" class="form-control" type="text" required autofocus>
                        </div>
                        
                        <div class="form-group">
                            <label for="senhaLogin">Senha:</label>
                            <input id="senhaLogin" name="senhaLogin" class="form-control" type="password" required>
                        </div>
                    </div>

                    <div class="card-footer text-center">

                        <input type="reset" class="btn btn-secondary" value="Limpar">
                        <input id="botaoLogin" type="submit" class="btn btn-primary" value="Entrar"><br><br>
                        <p>Ainda não possui cadastro?</p>
                        <input type="button" id="botaoCadastro" data-bs-toggle="modal" data-bs-target="#modalCadastro" class="btn btn-primary" value="Cadastre-se aqui">
                    </div>
                    
                </form>  
            </div>   
        </div>
    </div>
</section>
<div aria-live="polite" aria-atomic="true" class="position-relative">
    <div class="toast-container position-fixed bottom-0 end-0 p-3" id="toastPlacement">
    </div> 
</div>
<?php 
  
    if (isset($_GET['mensagem'])) {
        $msg = $_GET['mensagem'];
        if($msg == "logoff"){
            echo("<script>showToast('Sucesso', 'Você foi deslogado com sucesso!')</script>");
        };
        if($msg == "login_invalido"){
            echo("<script>showToast('Erro', 'Login ou Senha Invalida!')</script>");
        } ;
        if($msg == "cadastro_erro"){
            echo("<script>showToast('Erro', 'Não foi possível realizar seu cadastro. Tente novamente em alguns minutos, ou contate o suporte através do email suporte@socorro.com.br')</script>");
        };
    
};
?>
<?php include "include/footer.php" ?>   
<!-- Modal -->
<div class="modal fade" id="modalCadastro" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-body">
        <div class="container">
                <div class="col-xs-12 col-md-12">
                    
                    <form  action="realizaCadastroLogin.php" method="post">
                        <div class="usuarios container">
                        <div class="card">
                            <div class="card-header">
                                
                                Cadastro de Usuário
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nome">Nome:</label>
                                    <input class="form-control" id="nome" name="nome" type="text" placeholder="Digite seu nome completo" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Digite seu Email" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="senha">Senha:</label>
                                    <input class="form-control" id="senha" name="senha" type="password" placeholder="Informe uma senha" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="csenha">Confirma Senha:</label>
                                    <input class="form-control" onblur="verifica()" id="csenha" name="csenha" type="password" placeholder="Informe a mesma senha para confirmação" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="unidade">Unidade:</label>
                                    <select name="unidade" id="unidade" class="form-select" required>
                                        <option value="" readonly>Selecione:</option>
                                        <?php 
                                                
                                                while($arr = mysqli_fetch_array($cons)){
                                                    
                                        ?>
                                        <option value="<?php echo $arr['unidade']?>"><?php echo $arr['unidade']?></option>
                                        <?php 
                                                }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="inline form-group">
                                <input type="reset" class="btn btn-secondary" value="Limpar">
                                <input type="submit" class="btn btn-primary" value="Cadastrar">
                            </div>
                        </div>
                        </div>
                    </form> 
                
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<div class="cleardown"></div>

