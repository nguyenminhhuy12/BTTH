<?php
$filename = "questions.txt";
$questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$curr_questionlist = [];
$current_question = [];
$current_choices = [];
$answers = [];

// Đọc câu hỏi và các lựa chọn
foreach ($questions as $line) {
    if (strpos($line, "ANSWER") === false && !empty($line)) {
        if (preg_match("/^[A-D]\./", $line)) {
            // Lưu lựa chọn vào mảng
            $current_choices[] = $line;
        } else {
            // Lưu câu hỏi vào mảng
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
        $answer = trim(substr($line, strpos($line, ":") + 1)); // Lấy phần trả lời đúng
        $answers[] = explode(", ", $answer); // Tách đáp án và lưu vào mảng
    }
}

// Đảm bảo câu hỏi cuối cùng được thêm vào
if (!empty($current_question)) {
    $curr_questionlist[] = [
        'question' => $current_question[0],
        'choices' => $current_choices
    ];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Câu hỏi trắc nghiệm</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Trắc nghiệm: </h2>
        <form action="check.php" method="post">
            <?php foreach ($curr_questionlist as $number => $question): ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <strong><?php echo htmlspecialchars($question['question']); ?></strong>
                    </div>
                    <div class="card-body">
                        <?php foreach ($question['choices'] as $index => $choice): ?>
                            <?php
                                $answer = substr($choice, 0, 1);  // Lấy chữ cái A, B, C, D từ câu trả lời
                            ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="question<?php echo $number; ?>[]" value="<?php echo $answer; ?>" id="question<?php echo $number; ?><?php echo $answer; ?>">
                                <label class="form-check-label" for="question<?php echo $number; ?><?php echo $answer; ?>">
                                    <?php echo htmlspecialchars($choice); ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">Nộp bài</button>
            </div>
        </form>
    </div>
</body>
</html>
