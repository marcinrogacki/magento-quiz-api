<?php
header('Content-type: application/json');

include 'src/Quiz.php';

$responce = [ 
    'success' => false,
    'msg'     => null,
    'result'  => null, 
];

try {
    $quiz = new Quiz();
} catch (Exception $e) {
    $responce['msg'] = $e->getMessage();
    echo json_encode($responce);
    die(); 
}

$action = isset($_GET['action']) ? strtolower($_GET['action']) : null;

switch ($action) {

    case 'install':
        if ($quiz->install()) {
            $responce['success'] = true;
            $responce['msg']     = "Quiz has been installed";
        } else {
            $responce['msg'] = "Instalation failed. Please try again.";
        }
        break;

    case 'installed':
        if ($quiz->isInsalled()) {
            $responce['result'] = true;
        } else {
            $responce['result'] = false;
        }
        $responce['success'] = true;
        break;

    case 'question':
        $questionData = $quiz->getQuestionRow();
        if (!$questionData) {
            $responce['msg'] = 'Error while fetching question';
        } else {
            $responce['success'] = true; 
            $responce['result'] = $questionData;
        }
        break;

    default:
        $responce['msg'] = "Invalid action '$action'";

}

echo json_encode($responce);
?>
