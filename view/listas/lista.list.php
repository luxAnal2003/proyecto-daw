<!--autor: Ramírez Avilés Sebastián Emilio -->
<?php require_once HEADER; ?>
<style>
    /* Estilos por Sebastián Ramírez */
    #contenedorPrincipalTab {
        display: flex;
        margin-top: 5%;
        padding: 20px;
        background-color: #FFFF;
        gap: 20px;
    }

    .seccionTablero {
        background-color: #fff;
    }

    .contenedor {
        background-color: #A3CEF1;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        width: 200px;
    }

    .seccionTablero #contenedor {
        width: 24px;
        height: 24px;
    }

    .contenedor h2 {
        margin-top: 0;
        font-size: 1.2em;
    }

    .contenedorUnico {
        padding: 10px;
        width: 200px;
        background-color: #28a745;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
        font-size: 16px;
        color: white;
    }

    .contenedorUnico:hover {
        background-color: #218838;
    }

    .cajaTxt {
        background-color: #FFFF;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 10px;
        margin-bottom: 10px;
        font-size: 0.9em;
    }

    button {
        padding: 5px 10px;
        border: none;
        background-color: #28a745;
        border-radius: 4px;
        cursor: pointer;
    }

    a{
        text-decoration: none;
        color: white; 
    }


    button:hover {
        background-color: #218838;
    }

    details {
        margin-top: 20px;
    }

    summary {
        cursor: pointer;
    }

    /* Lado izquierdo */
    #contenedorPrincipal {
        display: flex;
        margin-top: 5%;
    }

    #sectionIzquierda {
        display: flex;
        margin-left: 15%;
        flex-direction: column;
        align-items: center;
        background-color: #E7ECEF;
        width: 13%;
        height: 70vh;
        border-radius: 5px;
    }

    .itemsSection {
        display: flex;
        background-color: #6096BA;
        width: 95%;
        height: 30px;
        margin-bottom: 10px;
        align-items: center;
        border-radius: 5px;
        font-size: 14px;
    }

    .itemsSection img {
        width: 18px;
        height: 18px;
        margin-right: 10px;
        margin-left: 10px;
    }

    .itemsSection:nth-child(1) {
        margin-top: 20%;
    }

    .lineaDivisoria {
        background-color: #8B8C89;
        width: 100%;
        height: 1px;
        opacity: 50%;
    }

    .tituloDivisorio {
        width: 100%;
        height: 4%;
        font-size: 10px;
    }

    .tituloDivisorio p {
        margin-left: 10px;
        color: #858181;
        font-weight: bold;
    }

    .itemsSection:hover {
        background-color: #A3CEF1;
        transition: 0.1s;
    }

    .container {
        font-family: 'Arial', sans-serif;
    }

    .btn-secondary {
        background-color: #274C77;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #6096BA;
    }
    
    .centro{
        text-align: center;
    }

    h2 {
        color: #343a40;
    }

    .table-dark th {
        background-color: #274C77;
        color: white;
    }
</style>
<div class="container mt-4">
    <h2 class="mb-4"><?php echo $titulo; ?></h2>
    <div class="row">
        <div class="col-sm-6">
            <form action="index.php?c=Lista&f=search" method="POST" class="input-group">
                <input type="text" name="b" id="busqueda" placeholder="Buscar..." class="form-control"/>
                <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i> Buscar</button>
            </form>     
        </div>
    </div>
    <section class="seccionTablero">
        <br>
        <h2 >Tablero del Usuario</h2>
        <p><em>En esta sección se podrán crear listas de actividades añadiendo tarjetas con una descripción de actividad.</em></p>
        <article>
            <h3>Listas actuales</h3>
        </article>
        <div>
            <div class="contenedorUnico"><a href="index.php?c=Lista&f=create">Crear nueva Lista</a></div>
        </div>
        <div class="table-responsive mt-2">
            <table class="table mt-4">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Tipo</th>
                        <th>Prioridad</th>
                        <th>Estado</th>
                        <th>Creado el</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listas as $fila) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($fila['descripcion']); ?></td>
                        <td><?php echo htmlspecialchars($fila['tipo']); ?></td>
                        <td><?php echo htmlspecialchars($fila['prioridad']); ?></td>
                        <td><?php echo htmlspecialchars($fila['estado']); ?></td>
                        <td><?php echo htmlspecialchars($fila['fecha_creacion']); ?></td>
                        <td>
                            <a class="btn btn-warning btn-sm me-2" 
                                href="index.php?c=Lista&f=view_edit&id=<?php echo htmlspecialchars($fila['id']); ?>">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a class="btn btn-danger btn-sm" 
                                onclick="if(!confirm('¿Está seguro de eliminar la lista?')) return false;" 
                                href="index.php?c=Lista&f=destroy&id=<?php echo htmlspecialchars($fila['id']); ?>">
                            <i class="fas fa-trash-alt"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
<?php require_once FOOTER; ?>