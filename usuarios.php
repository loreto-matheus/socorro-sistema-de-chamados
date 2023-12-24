<?php
    

    include "include/header.php"; 
    include "include/banco.php";
    if (empty($_COOKIE['admin'])){
        header("Location:index.php");
    }
    
?>
<section >
    <div class="container ">
        <div class="col-xs-12 col-md-12">
            <form method="post" id="document" name="document">
                <div class="form-group">
                    <div class="row">
                        <h3 class="ajust3">Usuários</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-xs-4">
                            <a href="cadastro.php" class="btn btn-success" id="btnAddUsuario">Adicionar Usuário</a>
                        </div>
                        <div class="col-md-2 col-xs-4">
                            <select class="form-select" name="selectStatus" id="selectStatus">
                                <option value="Ativo">Ativo</option>
                                <option value="Inativo">Inativo</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-xs-4">
                            <input class="form-control buscar col-xs-6 col-md-4" type="search" name="buscar" placeholder="buscar"> 
                        </div>
                        <div class="col-md-3 col-xs-4">
                            <input value="Buscar" type="submit" class="btn btn-info sizebtn form-control col-xs-6 col-md-4">  
                        </div>
                        
                        
                    </div>
                </div>
           
            </form>
            <hr>
            <div class="table-responsive">
                    <table class="tab table table-hover">
                        <thead>
                            <tr class='table-primary'>
                            <th>Unidade: </th>
                            <th>Nome:</th>
                            <th>Email:</th>
                            <th>Data de cadastro:</th>
                            <th> Tipo de usuário </th>
                            <th> Status </th>
                            <th>Alterar:</th>
                            </tr>
                        </thead>
                    <?php
                        if(empty($_POST['buscar'])){
                            if(isset($_POST['selectStatus'])){
                               $selectStatus =  $_POST['selectStatus'];
                            }else{
                                $selectStatus = "Ativo";
                            }
                            $query = "select * from usuario where dados_status = '$selectStatus' order by nome";
                        }else{
                            $pesquisa = htmlspecialchars($_POST['buscar']);
                            $selectAtivo = htmlspecialchars($_POST['selectAtivo']);
                            $query = "select * from usuario where email like '%$pesquisa%' and dados_status = '$selectStatus' or nome like '%$pesquisa%' and dados_status = '$selectStatus'";
                        }

                        $consulta = mysqli_query($con,$query);
                        while ($usuario = mysqli_fetch_assoc($consulta)){
                            $unidade = $usuario['unidade'];
                            $nome = $usuario['nome'];
                            $email = $usuario['email'];
                            $data = $usuario['datacadastro'];
                            $tp_usuario = $usuario['tp_usuario'];
                            $dados_status = $usuario['dados_status'];
                            $id= $usuario['idusuario'];
                    ?>

                        <tbody>   
                            <tr>
                                <td><?php echo "$unidade";  ?></td>

                                <td><strong style="color: #674EA7;"><?php echo "$nome"; ?></strong></td>
                                <td><?php echo "$email"; ?></td>
                                <td><?php echo "$data"; ?></td>
                                <td><?php if($tp_usuario == "operador") echo "Operador"; if($tp_usuario == "usuario") echo "Usuário"; if($tp_usuario == "admin") echo "Administrador"; ?></td>
                                <td><?php echo "$dados_status"; ?></td>
                                <td>
                                  <a style="cursor: pointer;" data-bs-toggle="modal" title='ALTERAR DADOS'  data-bs-target="#janelaAlt<?php echo $id; ?>"><i class="bi bi-pencil-square" style="font-size: 1.5rem; color: #674EA7;"></i></a>
                                  <a style="cursor: pointer;" data-bs-toggle="modal" title='ALTERAR SENHA'  data-bs-target="#modalSenhaAdmin<?php echo $id; ?>"><i class="bi bi-key-fill" style="font-size: 1.5rem; color: #674EA7;"></i></a>
                                </td>
                                 
                            </tr> 

                                <?php 
                                    include 'include/modalalterar-excluir.php';
                                    include 'include/modalsenhaadmin.php'
                                 ?>

                        </tbody>   
                    <?php 
                        }
                    ?>
                    </table>
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
        if($msg == "senhaExiste"){
            echo("<script>showToast('Erro', 'Antiga senha incorreta!')</script>");
        };
        if($msg == "cadastro_realizado"){
            echo("<script>showToast('Sucesso', 'Usuário cadastrado com sucesso!')</script>");
        } ;
        if($msg == "branco"){
            echo("<script>showToast('Erro', 'Valores em branco, impossível continuar!')</script>");
        };
        if($msg == "cadastro_alterado"){
            echo("<script>showToast('Sucesso', 'Dados alterados com sucesso!')</script>");
        };
        if($msg == "altera"){
            echo("<script>showToast('Sucesso', 'Senha alterada com sucesso! <br><br> O usuário deverá alterar a senha no próximo login.')</script>");
        };
    
}
?>
<div class="clear3"></div>
<?php
include "include/footer.php"; ?>  