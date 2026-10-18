<?php
session_start();

if (!isset($_SESSION['lessons'])) {
    $_SESSION['lessons'] = [];
}

$group = trim($_POST['group'] ?? '');
$subject = trim($_POST['subject']?? '');
$class = trim($_POST['class'] ?? '');

if ($group !== '' && $subject !== '' && $class !== '') {
    $_SESSION['lessons'][] = [
        'group' => $group,
        'subject' => $subject,
        'class' => $class
    ];
}
?>

<html>
    <head>
        <title>Расписание</title>
    </head>

    <body>
        <main>
            <h1>Расписание занятий</h1>

            <form action="index.php" method="post">
                <article>
                    <p>Группа</p>
                    <input type="text" name="group">

                    <p>Предмет</p>
                    <input type="text" name="subject">

                    <p>Аудитория</p>
                    <input type="text" name="class">

                    <button type="submit">Добавить занятие</button>
                </article>

                <h2>Полученные данные<h2>
                <table border="1">
                    <tr>
                        <th>Группа</th>
                        <th>Предмет</th>
                        <th>Аудитория</th>
                    </tr>
                    <?php foreach ($_SESSION['lessons'] as $lesson): ?> 
                    <tr>
                        <td><?php echo htmlspecialchars($lesson['group']) ?></td>
                        <td><?php echo htmlspecialchars($lesson['subject']) ?></td>
                        <td><?php echo htmlspecialchars($lesson['class']) ?></td>
                    </tr>
                    <?php endforeach ?>
                </table>
                
            </form>
        </main>
        
    </body>
</html>