<?php 
    
    if(empty($_COOKIE['usuario'])){
        header("Location:index.php");
    }

    include "include/banco.php";

    $email = $_COOKIE['usuario'];
    $query = "select idusuario, primeira_vez, nome, unidade from usuario where email = '$email' limit 1";
    $consulta = mysqli_query($con, $query);

    if($usuario = mysqli_fetch_assoc($consulta)){
        $id = $usuario['idusuario'];
        $unidade = $usuario['unidade'];
        $vez = $usuario['primeira_vez'];
        $nome = $usuario['nome'];
    }

   
    if(isset($_POST['selectStatus'])){
        $selectStatus =  $_POST['selectStatus'];
        $query2 = "select idchamado, data, unidade, usuario, descricao, problema, solucao, operador,status, anexo from chamados where usuario = '$nome' and status = '$selectStatus' order by idchamado"; 
     }else{
         $query2 = "select idchamado, data, unidade, usuario, descricao, problema, solucao, operador,status, anexo from chamados where usuario = '$nome' and (status = 'Pendente' OR status = 'Validação') order by status DESC, idchamado ASC"; 
     }
    

    $cons = mysqli_query($con, $query2);
    $total = mysqli_num_rows($cons);
    
    include "include/header.php";

    
?>
    <main>
        <div class="container">
            <div class="position-relative">
                <div class="position-absolute top-0 end-0">
                    <div class="btn-group" role="group">
                        <button type="button" id="btnKanban" class="btn btn-outline-primary active"><i class="bi bi-kanban"></i></button>
                        <button type="button" id="btnLista" class="btn btn-outline-primary"><i class="bi bi-card-list"></i></button>
                        
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-12">
                <div class="row">
                    <form method="post" id="document" name="document">
                        <div class="form-group">
                            <div class="row">
                                <h3 class="ajust3">Meus chamados</h3>
                            </div>
                            <div class="row">
                                <div class="col-sm-2 p-2">
                                    <a class="btn btn-primary" id="btnAddChamado" data-bs-toggle="modal" data-bs-target="#abrirChamado">Abrir Chamado</a>
                                </div>
                                <div class="col-sm-2 p-2 filtroLista">
                                    <select class="form-select" name="selectStatus" id="selectStatus">
                                        <option value="Pendente">Pendente</option>
                                        <option value="Validação">Validação</option>
                                        <option value="Resolvido">Resolvido</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 p-2 filtroLista">
                                    <input value="Buscar" type="submit" class="btn btn-info sizebtn form-control col-xs-6 col-md-4">  
                                </div>
                                
                                
                            </div>
                        </form>
                    </div>
                </div>
                
                <hr>
                <div class="kanban" id="kanban">
                    <div class="kanban-board fs-overflow-auto">
                        <div class="kanban-block" id="pendente">
                            <legend>Pendente</legend>
                            <hr>
                            <?php 
                                $queryPendente = "select idchamado, data, unidade, usuario, descricao, problema, solucao, operador,status, anexo from chamados where usuario = '$nome' and status = 'Pendente' order by status DESC, idchamado ASC";
                                $consultaPendente = mysqli_query($con, $queryPendente);
                                $total = mysqli_num_rows($consultaPendente);
                                if($total > 0){
                                while($chamado = mysqli_fetch_array($consultaPendente)){
                                    $idchamado = $chamado['idchamado'];
                                  
                            ?>
                                <div class="card kanban-card m-2" id="card<?php echo $idchamado ?>">
                                    <div class="position-relative">
                                        <div class="position-absolute top-0 end-0">
                                            <div class="inline">
                                                <a class="m-1" title="Visualizar detalhes" style="cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#kanbanDescricao<?php echo "$idchamado"; ?>"><i class="bi bi-chat-dots-fill" style="font-size: 2rem; color: #674EA7;"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        
                                        <h3 class="card-title"><?php echo $idchamado ?></h3>
                                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $chamado['problema'] ?></h6>
                                        <p class="card-text"><?php echo $chamado['descricao'] ?></p>
                                            <p class="card-text"><?php echo $chamado['data'] ?></p>
                                            <h6 class="card-subtitle mb-2 text-muted">Usuário: <?php echo $chamado['usuario'] ?></h6>
                                            <p class="card-text text-primary">Status: <br>Aguardando atendimento <i class="bi bi-hourglass-split"></i></p>
                                    </div>
                                </div>
                        <?php 
                        include 'include/offcanvasdescricao.php';
                            };
                        }else{
                            echo '<p> Você não possui chamados com status Validação </p>';
                        };
                        ?>
                        </div>
                        <div class="kanban-block" id="validacao">
                            <legend>Validação</legend>
                            <hr>
                            <?php 
                                $queryPendente = "select idchamado, data, unidade, usuario, descricao, problema, solucao, operador,status, anexo from chamados where usuario = '$nome' and status = 'Validação' order by idchamado ASC";
                                $consultaPendente = mysqli_query($con, $queryPendente);
                                $total = mysqli_num_rows($consultaPendente);
                                if($total > 0){
                                while($chamado = mysqli_fetch_array($consultaPendente)){
                                    $idchamado = $chamado['idchamado'];
                                  
                            ?>
                                <div class="card kanban-card m-2" id="card<?php echo $idchamado ?>">
                                    <div class="position-relative">
                                        <div class="position-absolute top-0 end-0">
                                            <div class="inline">
                                            <?php
                                                if ($chamado['usuario'] == $nome){
                                            ?>
                                                <a class="m-1" style="cursor: pointer;" data-bs-toggle="offcanvas"  data-bs-target="#kanbanEncerraChamado<?php echo "$idchamado"; ?>"><i class="bi bi-exclamation-circle-fill" style="font-size: 2rem; color: #674EA7;"></i>  </a>  
                                                <?php
                                                }
                                                ?>
                                                <a class="m-1" title="Visualizar detalhes" style="cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#kanbanDescricao<?php echo "$idchamado"; ?>"><i class="bi bi-chat-dots-fill" style="font-size: 2rem; color: #674EA7;"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title"><?php echo $idchamado ?></h3>
                                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $chamado['problema'] ?></h6>
                                        <p class="card-text"><?php echo $chamado['descricao'] ?></p>
                                            <p class="card-text"><?php echo $chamado['data'] ?></p>
                                            <h6 class="card-subtitle mb-2 text-muted">Usuário: <?php echo $chamado['usuario'] ?></h6>
                                            <p class="card-text text-primary">Status: <br>Aguardando validação <i class="bi bi-hourglass-split"></i></p>
                                    </div>
                                </div>
                        <?php 
                        include 'include/offcanvasEncerraChamado.php';
                        include 'include/offcanvasdescricao.php';
                            };
                        }else{
                            echo '<p> Você não possui chamados com status Pendente </p>';
                        };
                        ?>
                        </div>
                        <div class="kanban-block" id="encerrado">
                            <legend>Finalizado</legend>
                            <hr>
                            <?php 
                                $queryPendente = "select idchamado, data, unidade, usuario, descricao, problema, solucao, operador,status, anexo from chamados where usuario = '$nome' and status = 'Resolvido' order by idchamado ASC";
                                $consultaPendente = mysqli_query($con, $queryPendente);
                                $total = mysqli_num_rows($consultaPendente);
                                if($total > 0){
                                while($chamado = mysqli_fetch_array($consultaPendente)){
                                    $idchamado = $chamado['idchamado'];
                                  
                            ?>
                                <div class="card kanban-card m-2" id="card<?php echo $idchamado ?>">
                                    <div class="position-relative">
                                        <div class="position-absolute top-0 end-0">
                                            <div class="inline">
                                                <a class="m-1" title="Visualizar detalhes" style="cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#kanbanDescricao<?php echo "$idchamado"; ?>"><i class="bi bi-chat-dots-fill" style="font-size: 2rem; color: #674EA7;"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title"><?php echo $idchamado ?></h3>
                                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $chamado['problema'] ?></h6>
                                        <p class="card-text"><?php echo $chamado['descricao'] ?></p>
                                            <p class="card-text"><?php echo $chamado['data'] ?></p>
                                            <h6 class="card-subtitle mb-2 text-muted">Usuário: <?php echo $chamado['usuario'] ?></h6>
                                    </div>
                                </div>
                        <?php 
                         include 'include/offcanvasdescricao.php';
                            };
                        }else{
                            echo '<p> Você não possui chamados encerrados </p>';
                        };
                        ?>
                        </div>
                    </div>
                </div>
                <div class='table-responsive' id="tabelaChamados" style="display:none">
                    <?php if($total != 0){
                        echo "<table class='tab table table-hover'>
                                <thead>
                                    <tr class='table-primary'>
                                        <th>Solicitação:</th>
                                        <th>Unidade:</th>
                                        <th>Usuário:</th>
                                        <th>Descrição:</th>
                                        <th>Data:</th>
                                        <th>Status:</th>
                                        <th>Visualizar:</th>
                                    </tr>
                                </thead>";

                        while($chamado = mysqli_fetch_array($cons)){
                            $idchamado = $chamado['idchamado'];
                            echo "<tbody class='table-group-divider'>   
                                    <tr>
                                        <td>" .$chamado['idchamado']. "</td>
                                        <td>" .$chamado['unidade']. "</td>
                                        <td>" .$chamado['usuario']. "</td>
                                        <td>" .$chamado['descricao']. "</td>
                                        <td>" .$chamado['data']. "</td>
                                        <td>" ?>
                                           <?php 
                                if($chamado['status'] == 'Pendente'){
                                    echo "<span style='color: red;'>".$chamado['status']."</span>";
                                    
                                 }                             
                                if ($chamado['status'] == 'Validação') {
                                    echo "<p style='color: #674EA7; '>".$chamado['status']."</br></p>";
                                    if ($chamado['usuario'] == $nome){
                                        ?>
                                        <a style="cursor: pointer;" data-bs-toggle="modal"  data-bs-target="#janelaConfirma<?php echo "$idchamado"; ?>"><i class="bi bi-check-circle-fill" style="font-size: 2rem; color: #674EA7;"></i></a>
                                        <?php 
                                                include 'include/modalEncerraChamado.php';
                                                }
                                            }  
                                if($chamado['status'] == 'Resolvido') {
                                    echo "<span style='color:green;'>Resolvido</span>"; 
                                }
                                                 
                            ?>
                            <?php echo "</td>";  ?>
                            <?php
                                echo"<td>";?>
                                <a title="Visualizar detalhes" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#janela<?php echo "$idchamado"; ?>"><i class="bi bi-chat-dots-fill" style="font-size: 2rem; color: #674EA7;"></i></a>
                            <?php
                               include 'include/modaldescricao.php';
                                echo "</td>
                                    </tr> 
                                </tbody>"; ?>   
                            <?php     
                            }
        
                            echo "</table>";
                            echo "</div>";
                        }else{  ?>
                         
                        <div class="col-xs-12 col-md-12">
                            <h2>Parece que você não possui nenhum chamado em andamento.</h2>
                        </div>
                       
                        <?php 
                        
                            }
                        ?>
                    </div>
                </div>
            </div>
            
        </div>
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container position-fixed bottom-0 end-0 p-3" id="toastPlacement">
            </div> 
        </div>
    </main>
<?php
if(isset($_GET['mensagem'])){
    $mensagen = $_GET['mensagem'];
    
    
    if($mensagen == "chamado_sucesso"){
        echo("<script>showToast('Sucesso', 'Chamado aberto com sucesso!')</script>");
    }else if($mensagen == "altera"){
        echo("<script>showToast('Sucesso', 'Senha alterada com sucesso! Obs: use esta senha para acessar a plataforma.')</script>");
    }if($_GET['mensagem'] == 'encerrado'){
        echo("<script>showToast('Sucesso', 'Chamado encerrado com sucesso!')</script>");
    };
};
if(isset($_COOKIE['view'])){
    echo "<script>showTableorKanban('".$_COOKIE['view']."')</script>";
};
?>
<?php 
    
	include "include/footer.php";
    include "include/modalAbrirChamado.php";
    include "include/modalsenha.php";
?>
    <script>
<?php 
    if($vez == 1){
?>
        
            $(document).ready(function(){
            $('#modalSenha').modal('show');
            });
    <?php } ?>
            function alteraSenhaUser(){
                $('#modalSenha').modal('show');
            }
        </script>
