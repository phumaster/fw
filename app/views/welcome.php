<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8"/>
    </head>
    <body>
        <pre>
            <?php foreach ($name as $row): ?>
                <?php echo $row->firstName.' '.$row->lastName . '<br/>'; ?>
            <?php endforeach; ?>
        </pre>
    </body>
</html>