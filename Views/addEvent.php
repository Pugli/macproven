<?php
    use Model\Category as Category;
    use controllers\ControllerCategory as ControllerCategory;
    $categories = new ControllerCategory;
    $categoriesList = $categories->getAll();

?>
<html>
<head>
    <meta charset="utf-8" />
    <title>Agregar Evento</title>
</head>
<body>
    <form action="<?php echo FRONT_ROOT; ?>/Event/addEvent" method="POST" enctype="multipart/form-data">
    <br>
    <tr>
        <td>Evento: <input type="text" name="name"/></td>
        <td>Categoria: 
            <select name="category">
                <?php 
                foreach ($categoriesList as $category){?>
                    <option value="<?php echo $category->getId()?>"><?php echo $category->getDescription()?></option>
                <?php }?>
            </select></td>
        <td> Imagen: <input type="file" name="image" value="" class="form-control-file ml-3"> </td>
    </tr>
        
        <input type="submit" value="Enviar"/>
    </form>
</body>
</html>