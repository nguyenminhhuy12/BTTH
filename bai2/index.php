<?php
    $filename = "questions.txt";
    $questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $curr_questionlist =[];
    foreach ($questions as $line) {
        if (strpos($line, "Câu") === 0) {
            if (!empty($current_question)) {
                $curr_questionlist[] = $current_question;
            }
            $current_question = [];
        }
        $current_question[] = $line;
    }
    if (!empty($current_question)) {
        $curr_questionlist[] = $current_question;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        Trắc nghiệm:
    </div>
    <form action="check.php" method="post">
        <?php
            foreach($curr_questionlist as $number => $question){
                echo "<div class='card mb-4'>";
                echo "<div class='card-header'><strong>{$question[0]}</strong></div>";
                echo "<div class='card-body'>";
                for ($i = 1; $i <= 4; $i++) {
                    $answer = substr($question[$i], 0, 1);
                    echo "<div class='form-check'>";
                    echo "<input class='form-check-input' type='radio' name='question{$number}' value='{$answer}' id='question{$number}{$answer}'>";
                    echo "<label class='form-check-label' for='question{$number}{$answer}'>{$question[$i]}</label>";
                    echo "</div>";
                }
                echo "</div>";
                echo "</div>";
            }
        ?>
        <button type="submit" class="btn btn-primary">Nộp bài</button>
    </form>
</body>
</html>