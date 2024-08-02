<?php

class Game {
    private $board;
    private $currentPlayer;
    private $gameResult;
    private $moves;

    public function __construct() {
        $this->board = array_fill(0, 3, array_fill(0, 3, ' '));
        $this->currentPlayer = 'X';
        $this->gameResult = null;
        $this->moves = [];
    }

    public function getBoard() {
        return $this->board;
    }

    public function getCurrentPlayer() {
        return $this->currentPlayer;
    }

    public function makeMove($row, $col) {
        if ($row !== null && $col !== null && $row >= 0 && $row < 3 && $col >= 0 && $col < 3 && $this->board[$row][$col] == ' ') {
            $this->board[$row][$col] = $this->currentPlayer;
            $this->moves[] = [$this->currentPlayer, $row, $col];
            $this->currentPlayer = ($this->currentPlayer == 'X') ? 'O' : 'X';
            $this->checkGameOver();
        }
    }

    private function checkGameOver() {
        // Check rows, columns, and diagonals for a winning condition
        for ($i = 0; $i < 3; $i++) {
            if ($this->board[$i][0] != ' ' && $this->board[$i][0] == $this->board[$i][1] && $this->board[$i][1] == $this->board[$i][2]) {
                $this->gameResult = $this->board[$i][0];
                return true;
            }
            if ($this->board[0][$i] != ' ' && $this->board[0][$i] == $this->board[1][$i] && $this->board[1][$i] == $this->board[2][$i]) {
                $this->gameResult = $this->board[0][$i];
                return true;
            }
        }
        if ($this->board[0][0] != ' ' && $this->board[0][0] == $this->board[1][1] && $this->board[1][1] == $this->board[2][2]) {
            $this->gameResult = $this->board[0][0];
            return true;
        }
        if ($this->board[0][2] != ' ' && $this->board[0][2] == $this->board[1][1] && $this->board[1][1] == $this->board[2][0]) {
            $this->gameResult = $this->board[0][2];
            return true;
        }
        $draw = true;
        foreach ($this->board as $row) {
            foreach ($row as $cell) {
                if ($cell == ' ') {
                    $draw = false;
                    break 2;
                }
            }
        }
        if ($draw) {
            $this->gameResult = 'draw';
            return true;
        }
        return false;
    }

    public function isGameOver() {
        return $this->gameResult !== null;
    }

    public function announceResult() {
        if ($this->gameResult == 'draw') {
            return "It's a draw!";
        } else {
            return "Player {$this->gameResult} wins!";
        }
    }
}
?>
