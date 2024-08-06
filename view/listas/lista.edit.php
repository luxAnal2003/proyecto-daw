<!--autor: Ramírez Avilés Sebastián Emilio -->
<?php require_once HEADER; ?>

    <style>
        /* Estilos por Sebastián Ramírez */
        #contenedorPrincipalTab{
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
  
  .seccionTablero{
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
  
  .seccionTablero #contenedor{
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
        #contenedorPrincipal{
        display: flex;
        margin-top: 5%
            }

        #sectionIzquierda{
            display: flex;
            margin-left: 15%;
            flex-direction: column;
            align-items: center;
            background-color: #E7ECEF;
            width: 13%;
            height: 70vh;
            border-radius: 5px;
            }

        .itemsSection{
            display: flex;
            background-color: #6096BA;
            width: 95%;
            height: 30px;
            margin-bottom: 10px;
            align-items: center;
            border-radius: 5px;
            font-size: 14px;
            }

        .itemsSection img{
            width: 18px;
            height: 18px;
            margin-right: 10px;
            margin-left: 10px;
        }
        .itemsSection:nth-child(1){
            margin-top: 20%;
        }
        .lineaDivisoria{
        background-color: #8B8C89;
            width: 100%;
            height: 1px;
            opacity: 50%;
        }
        .tituloDivisorio{
            width: 100%;
            height: 4%;
            font-size: 10px;

        }
        .tituloDivisorio p{
            margin-left: 10px;
            color: #858181;
            font-weight: bold;
        }
        .itemsSection:hover{
            background-color: #A3CEF1;
            transition: 0.1s;
        }

    </style>
    <section class="seccionTablero">
        <h1>Editar Lista</h1>
        <form action="index.php?c=Lista&f=edit" method="post">
            <input type="hidden" name="id" value="<?php echo $lista->id?>">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($lista->nombre) ?>" required>
            <br>
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion"><?= htmlspecialchars($lista->descripcion) ?></textarea>
            <br>
            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo" required>
                <option value="Personal" <?= $lista->tipo == 'Personal' ? 'selected' : '' ?>>Personal</option>
                <option value="Estudio" <?= $lista->tipo == 'Estudio' ? 'selected' : '' ?>>Estudio</option>
                <option value="Trabajo" <?= $lista->tipo == 'Trabajo' ? 'selected' : '' ?>>Trabajo</option>
            </select>
            <br>
            <label for="prioridad">Prioridad:</label>
            <select name="prioridad" id="prioridad" required>
                <option value="Alta" <?= $lista->prioridad == 'Alta' ? 'selected' : '' ?>>Alta</option>
                <option value="Media" <?= $lista->prioridad == 'Media' ? 'selected' : '' ?>>Media</option>
                <option value="Baja" <?= $lista->prioridad == 'Baja' ? 'selected' : '' ?>>Baja</option>
            </select>
            <br>
            <label for="estado">Estado:</label>
            <select name="estado" id="estado" required>
                <option value="Nuevo" <?= $lista->estado == 'Nuevo' ? 'selected' : '' ?>>Nuevo</option>
                <option value="En Progreso" <?= $lista->estado == 'En Progreso' ? 'selected' : '' ?>>En Progreso</option>
                <option value="Completo" <?= $lista->estado == 'Completo' ? 'selected' : '' ?>>Completo</option>
            </select>
            <br>
            <input type="submit" value="Actualizar">
        </form>
    </section>
<?php require_once FOOTER; ?>