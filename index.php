<!DOCTYPE html>
<html>
<head>
    <title>Tic Tac Toe</title>
    <style>
        table { border-collapse: collapse; margin: 20px auto; }
        td { width: 60px; height: 60px; text-align: center; font-size: 24px; border: 1px solid #000; }
        .container { text-align: center; }
        .message { margin-top: 20px; font-size: 18px; }
    </style>
</head>
<body>

<div class="container">
    <h1>Tic Tac Toe</h1>
    <form method="post" action="index.php">
        <table>
            <?php
            require 'Game.php';
            session_start();

            if (!isset($_SESSION['game'])) {
                $_SESSION['game'] = new Game();
            }

            $game = $_SESSION['game'];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['row']) && isset($_POST['col'])) {
                    $row = $_POST['row'];
                    $col = $_POST['col'];
                    $game->makeMove($row, $col);
                }
            }

            $board = $game->getBoard();
            for ($i = 0; $i < 3; $i++) {
                echo "<tr>";
                for ($j = 0; $j < 3; $j++) {
                    echo "<td>";
                    if ($board[$i][$j] === ' ') {
                        echo "<button type='submit' name='row' value='$i' onclick=\"this.form.elements['col'].value=$j\"> </button>";
                    } else {
                        echo $board[$i][$j];
                    }
                    echo "</td>";
                }
                echo "</tr>";
            }
            ?>
            <input type="hidden" name="col" value="">
        </table>
    </form>

    <div class="message">
        <?php
        if ($game->isGameOver()) {
            echo $game->announceResult();
            session_destroy();
            echo "<br><a href='index.php'>Play Again</a>";
        } else {
            echo "Player " . $game->getCurrentPlayer() . "'s turn.";
        }
        ?>
    </div>
</div>

</body>
</html>
