<?php
session_start();

if (!isset($_SESSION['lessons'])) {
    $_SESSION['lessons'] = [];
}

$errors = [];

$group = trim($_POST['group'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$class = trim($_POST['class'] ?? '');


if (isset($_POST['clear'])) {
    $_SESSION['lessons'] = [];
}

if (isset($_POST['add'])) {
    if ($group === '') {
        $errors[] = 'Укажите группу';   
    }

    if ($subject === '') {
        $errors[] = 'Укажите предмет';
    }

    if ($class === '') {
        $errors[] = 'Укажите аудиторию';
    }

    if (empty($errors)) {
        $repeat = false;

        foreach ($_SESSION['lessons'] as $lesson) {
            if ($lesson['group'] === $group && $lesson['subject'] === $subject && $lesson['class'] === $class) {
                $repeat = true;
                break;
            }
        } 
        
        if ($repeat) {
            $errors[] = 'Пара для данной группы в данной аудитории уже есть';
        } else {
            $_SESSION['lessons'][] = ['group' => $group, 'subject' => $subject, 'class' => $class];
        }
    }
}
?>

#TODO HTML and CSS

<html>
    <head>
        <title>Расписание</title>
    </head>

    <header>
        <div>
            <p>Расписание</p>
            <p>Практическая работа №4</p>
        </div>
    </header>

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

                    <button type="submit" name="add">Добавить занятие</button>
                    <button type="submit" name="clear">Очистить таблицу</button>
                </article>

                <h2>Полученные данные<h2>
                <table border="1">
                    <tr>
                        <th>Группа</th>
                        <th>Предмет</th>
                        <th>Аудитория</th>
                    </tr>
                    <?php if (empty($errors)) ?>
                        <?php foreach ($_SESSION['lessons'] as $lesson): ?> 
                            <tr>
                                <td><?php echo htmlspecialchars($lesson['group']) ?></td>
                                <td><?php echo htmlspecialchars($lesson['subject']) ?></td>
                                <td><?php echo htmlspecialchars($lesson['class']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                </table>
                
            </form>
            <?php if (!empty($errors)) ?>
                <h4>Ошибка!</h4>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
        </main>
        
    </body>
</html>