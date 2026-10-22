<?php
session_start();

if (!isset($_SESSION['lessons'])) {
    $_SESSION['lessons'] = [];
}

$errors = [];

$group = trim($_POST['group']);
$subject = trim($_POST['subject']);
$class = trim($_POST['class']);


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

<html>
    <head>
        <link href="style.css" rel="stylesheet">
        <title>Расписание</title>
    </head>

    <body>
        <header>
            <div class="display">
                <p>Расписание</p>
            </div>
            <nav class="flex">
                <a href="#table">Таблица</a>
                <a href="#form">Форма</a>
                <a href="#info">О нас</a>
            </nav>
        </header>

        <main>
            <h1 class="text-center">Расписание занятий</h1>
            <hr>

            <form action="index.php" method="post">
                <section class="main-category">
                    <article class="category">
                        <p>Группа</p>
                        <input type="text" name="group">

                        <p>Предмет</p>
                        <input type="text" name="subject">

                        <p>Аудитория</p>
                        <input type="text" name="class">

                        <div class="buttons">
                            <button class="button" type="submit" name="add">Добавить занятие</button>
                            <button class="button" type="submit" name="clear">Очистить таблицу</button>
                        </div>
                    
                    </article>

                    <article>
                        <h2 class="text-center">Список занятий<h2>
                        <table class="table">
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
                    </article>
                </section>
            </form>

            <article class="errors">
                <?php if (!empty($errors)) ?>
                    <h4>Список ошибок:</h4>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
            </article>
        </main>
        
    </body>
</html>