                    <section class="mb-5">
                        <div class="card bg-light">
                            <div class="card-body">
                                <?php if (!isset($_SESSION['id'])): ?>
                                    Para comentar debes <a href="login.php">acceder </a>
                                <?php else: ?> 
                                <!-- Comment form-->
                <?php
                        $id_user = $_SESSION['id'];
                        $sql = "SELECT id,usuario FROM login WHERE id = '$id_user'";
                        $resultado = $base->prepare($sql);
                        $resultado->execute(); 

                ?>
                                <form class="mb-4" action="procesa_comentarios.php" method="post">
                                    <input type="hidden" name="id_post" value="<?php echo $id_post ?>">
                        <?php foreach ($resultado as $datos): ?>
                                    <input type="hidden" name="id_usuario" value="<?php echo $datos['id'] ?>">
                                    <input type="hidden" name="usuario" value="<?php echo $datos['usuario'] ?>">
                        <?php endforeach; ?>
                                    <textarea class="form-control" rows="3" placeholder="Únete a la conversación y escribe un comentario!" name="comentario"></textarea>
                                    <button class="btn btn-primary mt-2" type="submit" name="enviar">Comentar</button>
                                </form>
                            <?php endif ?>
                                
                                                                
                            </div>
                        </div>
                    </section>
                    <!-- Comment with nested comments-->
                                <H3 class="mb-2">COMENTARIOS</H3><hr>
                    <section class="mb-5">
            <?php
                    $sql = "SELECT * FROM comentarios WHERE id_post = '$id_post'";
                    $resultado = $base->prepare($sql);
                    $resultado->execute();
                    $registros = $resultado->rowCount();
                    if ($registros<1){
                        echo "No hay comentarios en este post";
                    }else{

            ?>
                        
                    <?php foreach ($resultado as $datos):?>                                                                  
                <div class="fw-bold"><?php echo $datos['fecha'] ?> <?php echo $datos['usuario'] ?> dijo:</div>
                                    <?php echo $datos['comentario'] ?>

                    <?php endforeach; }?>                                    
                                        
                                    
                    </section>