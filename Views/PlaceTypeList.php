<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table>
    <thead>
    <tr>
    <th>Descripcion</th>
    </tr>
    </thead>
    <?php foreach($list as $i){ ?>
    <tbody>
    <tr>
    <td><?php echo $i->getDescription()?></td>
    </tr>
    </tbody>
    <?php } ?>
    </table>
</body>
</html>