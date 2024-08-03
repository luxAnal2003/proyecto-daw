<!-- incluimos  Encabezado -->
<?php require_once HEADER; ?>

<div class="container">
<h2> <?php echo $titulo?></h2>
    <div class="card card-body">
    
        <form action="index.php?c=productos&f=edit" method="POST" name="formProdNuevo" id="formProdNuevo">
        
        <input type="hidden" name="id" id="id" value="<?php echo $prod['prod_id']; ?>"/>
            <div class="form-row">
               <div class="form-group col-sm-6">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo $prod['prod_nombre']; ?>" class="form-control" placeholder="nombre producto" required>
                </div>
                <div class="form-group col-sm-6"><!--Se nmuestran los datos de la descripcion-->
                    <label for="descripcion">Descripcion</label>
                    <input type="text" name="descripcion" id="descripcion" value="<?php echo $prod['descripcion_producto']; ?>" class="form-control" placeholder="descripcion producto" required>
                </div>

                <div class="form-group col-sm-6">
                    <label for="categoria">Categoria</label>
                    <select id="categoria" name="categoria" class="form-control">
                       <?php foreach ($categorias as $cat) {
                        //por defecto el atributo select es vacío, hasta que cumpla con la condicion del if
                            $selected='';
                            //q el id de la categoria es igual al de la categoria del producto
                            if($cat->cat_id == $prod['prod_idCategoria']){
                                  $selected='selected="selected"';
                            }
                       ?>
                       <!--se usa la propiedad selected y el valor del atributo para aparecer seleccionado-->
                            <option value="<?php echo $cat->cat_id ?>" <?php echo $selected; ?>>
                            <?php echo $cat->cat_nombre; ?>
                            </option>
                        <?php
                        }
                        ?>   

                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label for="precio">Precio</label>
                    <input type="text" name="precio" id="precio" value="<?php echo $prod['prod_precio']; ?>" class="form-control" placeholder="precio producto" required>
                </div>          

                <div class="form-group col-sm-12">
                    <input type="checkbox" id="estado" value="<?php echo $prod['prod_estado']?>" 
                        name="estado"  <?php echo ($prod['prod_estado'] == 1)?'checked="checked"':''; ?> >
                           <!--si el estado del producto es igual a 1, aparece marcado, sino entonces no se marca-->
                    <!--para los radios y checkbox es checked=checked-->
                    <label for="estado">Activo</label>
                </div>
                <div class="form-group mx-auto">
                    <!--ventana de emergencia---ojo nos sirve-->
                    <button type="submit" class="btn btn-primary"
                     onclick="if (!confirm('Esta seguro de modificar el producto?')) return false;" >Guardar</button>
                    <a href="index.php?c=productos&f=index" class="btn btn-primary">Cancelar</a>
                </div>
                    
            </div>  
        </form>
    </div>
</div>

<!-- incluimos  pie de pagina -->
<?php require_once FOOTER; ?>
