<?php
    include "config/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>Lista de materiales</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<section id="container">
		<?php

            $busqueda = strtolower($_REQUEST['busqueda']);
            if(empty($busqueda)){
                header("Location: lista-materiales.php");
            }
        ?>
<h1><i class="fas fa-user-group"></i> Lista de materiales</h1>
        <a href="registro-material.php" class="btn-new"><i class="fa-solid fa-user-plus"></i> Agregar material/insumo</a>
        <form action="buscar-material.php" method="get" class="form-search">
            <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
            <input type="submit" value="Buscar" class="btn-search">
        </form> 
        <table>
            <tr>
                <th>Id Material</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Codigo</th>
                <th>Acciones</th>
            </tr>
            <?php 
                $query = mysqli_query($conexion, "SELECT * FROM materiales WHERE (idmaterial LIKE '%$busqueda%' OR nombre LIKE '%$busqueda%' OR  descripcion LIKE '%$busqueda%' OR codigo LIKE '%$busqueda%') AND estado = 1 ORDER BY idmaterial ASC");

                $result = mysqli_num_rows($query);

                if($result > 0){
                    while ($data = mysqli_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $data['idmaterial'] ?></td>
                            <td><?php echo $data['nombre'] ?></td>
                            <td><?php echo $data['descripcion'] ?></td>
                            <td><?php echo $data['cantidad'] ?></td>
                            <td><?php echo $data['codigo'] ?></td>
                            <td>
                                <a href="editar-material.php?id=<?php echo $data['idmaterial'] ?>" class="link-edit"> Editar</a>
                                <a href="eliminar-material.php?id=<?php echo $data['idmaterial'] ?>" class="link-delete"> Eliminar</a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
        </table>
    </section>
</body>
</html>