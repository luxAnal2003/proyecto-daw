<!-- autor: Ramírez Avilés Sebastián Emilio -->
<?php require_once HEADER; ?>

<style>
    /* Estilos por Sebastián Ramírez */
    .seccionTablero {
        margin: 20px;
        padding: 20px;
        background-color: #fff;
    }
    .seccionTablero h2 {
        margin-top: 0;
        font-size: 1.5em;
        color: #333;
    }
    .seccionTablero label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
    }
    .seccionTablero input[type="text"],
    .seccionTablero textarea,
    .seccionTablero select {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .seccionTablero textarea {
        resize: vertical;
    }
    .seccionTablero input[type="submit"] {
        padding: 10px 15px;
        border: none;
        background-color: #28a745;
        color: white;
        border-radius: 4px;
        cursor: pointer;
        font-size: 1em;
    }
    .seccionTablero input[type="submit"]:hover {
        background-color: #218838;
    }
    .seccionTablero a {
        display: inline-block;
        margin-top: 10px;
        color: #007bff;
        text-decoration: none;
    }
    .seccionTablero a:hover {
        text-decoration: underline;
    }
</style>

<div class="container">
  <div class="seccionTablero">
    <h2 class="mb-4"><?php echo $titulo; ?></h2>
    <form action="index.php?c=Lista&f=store" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion"></textarea>

        <label for="tipo">Tipo:</label>
        <select name="tipo" id="tipo" required>
            <option value="Personal">Personal</option>
            <option value="Estudio">Estudio</option>
            <option value="Trabajo">Trabajo</option>
        </select>

        <label for="prioridad">Prioridad:</label>
        <select name="prioridad" id="prioridad" required>
            <option value="Alta">Alta</option>
            <option value="Media">Media</option>
            <option value="Baja">Baja</option>
        </select>

        <label for="estado">Estado:</label>
        <select name="estado" id="estado" required>
            <option value="Nuevo">Nuevo</option>
            <option value="En Progreso">En Progreso</option>
            <option value="Completo">Completo</option>
        </select>

        <input type="submit" value="Guardar">
    </form>
    <a href="index.php?c=Lista&f=index">Volver</a>
  </div>
</div>

<?php require_once FOOTER; ?>
