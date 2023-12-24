<?php 
   
    
    
    include "include/header.php"; 
    include "include/banco.php";

    $query3 = "select unidade from unidades where status = 'Ativo'";
    $cons = mysqli_query($con, $query3);
?>  
   <!-- FORMULÁRIO PARA CADASTRAR USUÁRIOS -->
<div class="container">
    <div class="col-xs-12 col-md-12">
        <form  action="gravarcadastro.php" method="post" >
            <div class="usuarios container">
                <div class="row">
                    <h3>Cadastro de Usuário</h3>
                   <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input class="form-control" id="nome" name="nome" type="text" placeholder="Digite seu nome completo" autocomplete="off">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Digite seu Email" autocomplete="off">
                    </div>
                    
                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input class="form-control" id="senha" name="senha" type="password" placeholder="Informe uma senha" autocomplete="off">
                    </div>
                    
                    <div class="form-group">
                        <label for="csenha">Confirma Senha:</label>
                        <input class="form-control" onblur="verifica()" id="csenha" name="csenha" type="password" placeholder="Informe a mesma senha para confirmação" autocomplete="off">
                    </div>
                    
                    <div class="form-group">
                        <label for="unidade">Unidade:</label>
                        <select name="unidade" id="unidade" class="form-select" >
                               <option value="" readonly>Selecione:</option>
                               <?php 
                                    print_r($arr);
                                    while($arr = mysqli_fetch_array($cons)){
                                        
                               ?>
                               <option value="<?php echo $arr['unidade']?>"><?php echo $arr['unidade']?></option>
                               <?php 
                                    }
                               ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tp_usuario">Tipo de Usuário:</label>
                        <select name="tp_usuario" id="tp_usuario" class="form-select" >
                            <option value="" readonly>Selecione:</option>
                            <option value="usuario">Usuário</option>
                            <option value="operador">Operador</option>
                            <option value="admin" >Administrador</option>
                        </select>
                    </div>
                </div>
                
                <div class="inline form-group">
                    <button type="submit" class="btn btn-secondary" name="cancelar" value="cancelar">Cancelar</button>
                    <button type="submit" class="btn btn-primary" name="cadastrar" value="cadastrar">Cadastrar</button>
                </div>
            </div>
        </form> 
    </div>
</div>
<div aria-live="polite" aria-atomic="true" class="position-relative">
    <div class="toast-container position-fixed bottom-0 end-0 p-3" id="toastPlacement">
    </div> 
</div>
<?php
if(isset($_GET['mensagem'])){
    if ($_GET['mensagem'] == 'cadastro_erro') {
        echo("<script>showToast('Erro', 'Usuário já existe! tente com outro email.')</script>");
        $msg = "";
    } 

    
}

?>
<!-- 
<?php include "include/footer.php"; ?> 
-->
