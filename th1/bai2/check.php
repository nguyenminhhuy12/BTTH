<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<?php
$filename = "questions.txt";
$questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Tạo mảng chứa các câu trả lời đúng
$answers = [];
$curr_questionlist = [];
$current_question = [];
$current_choices = [];

// Đọc các câu hỏi và lựa chọn
foreach ($questions as $line) {
    if (strpos($line, "ANSWER") === false && !empty($line)) {
        if (preg_match("/^[A-D]\./", $line)) {
            $current_choices[] = $line;
        } else {
            if (!empty($current_question)) {
                $curr_questionlist[] = [
                    'question' => $current_question[0],
                    'choices' => $current_choices
                ];
            }
            $current_question = [$line];
            $current_choices = [];
        }
    }

    // Đọc phần ANSWER
    if (strpos($line, "ANSWER") !== false) {
        $answer = trim(substr($line, strpos($line, ":") + 1));
        $answers[] = explode(", ", $answer); // Lưu đáp án đúng vào mảng
    }
}

// Tính điểm cho người dùng
$score = 0;
foreach ($_POST as $key => $userAnswer) {
    $questionNumber = (int)filter_var($key, FILTER_SANITIZE_NUMBER_INT); // Lấy số câu hỏi từ key
    
    // Kiểm tra xem mảng $answers có phần tử cho câu hỏi này không
    if (isset($answers[$questionNumber])) {
        $correctAnswers = $answers[$questionNumber];

        // Kiểm tra nếu người dùng đã chọn câu trả lời
        if (isset($userAnswer)) {
            // Sắp xếp các lựa chọn của người dùng và đáp án đúng
            sort($userAnswer);
            sort($correctAnswers);
            if ($userAnswer === $correctAnswers) {
                $score++;
            }
        }
    }
}

echo "<div class='alert alert-success text-center'>";
echo "Bạn trả lời đúng <strong>$score</strong>/" . count($answers) . " câu.";
echo "</div>";

?>
</body>
</html>