<?php
session_start();

if (!isset($_SESSION['todos'])) {
    $_SESSION['todos'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'create') {
        $todo = htmlspecialchars($_POST['todo']);
        $_SESSION['todos'][] = $todo;
    } elseif ($action === 'update') {
        $index = intval($_POST['index']);
        $todo = htmlspecialchars($_POST['todo']);
        if (isset($_SESSION['todos'][$index])) {
            $_SESSION['todos'][$index] = $todo;
        }
    } elseif ($action === 'delete') {
        $index = intval($_POST['index']);
        if (isset($_SESSION['todos'][$index])) {
            array_splice($_SESSION['todos'], $index, 1);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime To-do App</title>
    <link rel="stylesheet" href="styless.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="logo">Anime To-do App</h1>
        </div>
    </header>

    <section class="todo-app">
        <div class="container">
            <h2 class="section-title">Your Tasks</h2>
            <form method="POST" class="todo-form">
                <input type="text" name="todo" placeholder="Add a new task" required>
                <input type="hidden" name="action" value="create">
                <button type="submit">Add</button>
            </form>

            <ul class="todo-list">
                <?php foreach ($_SESSION['todos'] as $index => $todo): ?>
                <li>
                    <form method="POST" class="todo-item-form">
                        <input type="text" name="todo" value="<?php echo htmlspecialchars($todo); ?>" required>
                        <input type="hidden" name="index" value="<?php echo $index; ?>">
                        <button type="submit" name="action" value="update">Update</button>
                        <button type="submit" name="action" value="delete">Delete</button>
                    </form>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; Louis Figo</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
