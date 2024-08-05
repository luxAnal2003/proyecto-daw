<?php require_once '../templates/header.php'; ?>
<style>
    /* Estilos por Sebastián Ramírez */
    #contenedorPrincipalTab {
        display: flex;
        margin-top: 5%;
        padding: 20px;
        background-color: #FFFF;
        gap: 20px;
    }

    .tablero {
        display: flex;
        gap: 10px;
        max-width: 100%;
        padding: 20px;
    }

    .seccionTablero {
        background-color: #E7ECEF;
        border: 1px solid #ccc;
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
        color: white;
        border-radius: 4px;
        cursor: pointer;
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
</style>

<body>
    <div id="contenedorPrincipal">
        <div id="sectionIzquierda">
            <div class="itemsSection">
                <img src="/mvc/assets/images/imgTableros.png" alt="imagen tablero">
                <a href="tableros.html"><b>Tableros</b></a>
            </div>
            <div class="itemsSection">
                <img src="/mvc/assets/images/imgPlantillas.png" alt="imagen tablero">
                <a href="plantillas.html"><b>Plantillas</b></a>
            </div>
            <div class="itemsSection">
                <img src="/mvc/assets/images/imgInicio.png" alt="imagen tablero">
                <a href="index.html"><b>Inicio</b></a>
            </div>
            <div class="lineaDivisoria"></div>
            <p>Espacios de Trabajo</p>
            <div class="itemsSection">
                <img src="/mvc/assets/images/imgMiembros.png" alt="imagen tablero">
                <a href="board.html"><b>Board</b></a>
            </div>
            <p>Personalizar Plantillas</p>
            <div class="itemsSection">
                <img src="/mvc/assets/images/imgMiembros.png" alt="imagen tablero">
                <a href="formPlantilla.php"><b>Personalizar</b></a>
            </div>
        </div>
        <section class="seccionTablero">
            <h2>Primer Tablero</h2>
            <p><em>En esta sección se podrán crear listas de actividades añadiendo tarjetas con una descripción de actividad.</em></p>
            <article>
                <h3>Listas actuales</h3>
            </article>
            <div>
                    <div class="contenedorUnico"><a href="lista.create.php?action=create">Crear nueva Lista</a></div>
            </div>
            <div class="tablero">
                <div class="contenedor">
        <table>
        <table>
        <thead>
            <tr>
                <th>Nombre<br></th>
                <th>Descripción<br></th>
                <th>Tipo<br></th>
                <th>Prioridad<br></th>
                <th>Estado<br></th>
                <th>Acciones<br></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($listas)): ?>
                <?php foreach ($listas as $listaDTO): ?>
                    <tr>
                        <td><?= htmlspecialchars($listaDTO->getNombre()) ?></td>
                        <td><?= htmlspecialchars($listaDTO->getDescripcion()) ?></td>
                        <td><?= htmlspecialchars($listaDTO->getTipo()) ?></td>
                        <td><?= htmlspecialchars($listaDTO->getPrioridad()) ?></td>
                        <td><?= htmlspecialchars($listaDTO->getEstado()) ?></td>
                        <td>
                            <a href="tablero.php?action=edit&id=<?= $listaDTO->getId() ?>">Editar</a>
                            <a href="tablero.php?action=delete&id=<?= $listaDTO->getId() ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No hay listas disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
    </div>
    </div>
    </section>
    </div>
</body>
</html>