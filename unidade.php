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
                        <h3 class="ajust3">Unidades</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-xs-4">
                            <a data-bs-toggle="modal" data-bs-target="#criaunidade" class="btn btn-success" id="btnAddUsuario">Adicionar Unidade</a>
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
                    <table class=" tab table table-hover">
                        <thead>
                            <tr class='table-primary'>
                            <th>ID: </th>
                            <th>Unidade:</th>
                            <th>Status:</th>
                            <th>Editar:</th>
                            </tr>
                        </thead>
                    <?php
                        if(!empty($_POST['buscar'])){
                            if(isset($_POST['buscar'])){
                               $buscar =  $_POST['buscar'];
                               $query = "select * from unidades where unidade like '%$buscar%' order by unidade";
                            }else{
                                
                                $query = "select * from unidades order by unidade";
                            }
                            
                        }else{
                            $query = "select * from unidades order by unidade";
                        }

                        $consulta = mysqli_query($con,$query);
                        while ($usuario = mysqli_fetch_assoc($consulta)){
                            $unidade = $usuario['unidade'];
                            $idunidade = $usuario['idunidade'];
                            $status = $usuario['status'];
                    ?>

                        <tbody>   
                            <tr>
                                <td><?php echo "$idunidade";  ?></td>
                                <td><?php echo "$unidade"; ?></td>
                                <td><?php echo "$status"; ?></td>
                                <td>
                                  <a style="cursor: pointer;" data-bs-toggle="modal" title='ALTERAR DADOS'  data-bs-target="#janelaUnd<?php echo $idunidade; ?>"><i class="bi bi-pencil-square" style="font-size: 1.5rem; color: #674EA7;"></i></a>
                                </td>
                            </tr> 
                                <?php 
                                    include 'include/modalalterarunidade.php';
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
        if($msg == "unidadeExiste"){
            echo("<script>showToast('Erro', 'Unidade já existe!')</script>");
        };
        if($msg == "cadastro_realizado"){
            echo("<script>showToast('Sucesso', 'Unidade cadastrada com sucesso!')</script>");
        } ;
        if($msg == "branco"){
            echo("<script>showToast('Erro', 'Valores em branco, impossível continuar!')</script>");
        };
        if($msg == "cadastro_alterado"){
            echo("<script>showToast('Sucesso', 'Dados alterados com sucesso!')</script>");
        };
    
}
?>
<div class="clear3"></div>
<?php
include "include/footer.php"; ?>  
 <?php 
    include 'include/modaladicionaunidade.php';
    ?>