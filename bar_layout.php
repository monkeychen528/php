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
        <?php for($i=1;$i<10;$i++){ ?>
            <tr>
                <?php for($k=1;$k<10;$k++) :?>
                    <td><?php echo $k*$i ?></td>
                <?php endfor ?>
            </tr>
        <?php }?>
    </table>
</body>
</html>