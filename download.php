<?php
// перевіряємо, чи була натиснута кнопка скачування та чи був файл завантажений
if (isset($_POST['download']) && !empty($_FILES['file']['name'])) {
    // Визначаємо цільовий каталог для завантаженого файлу
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
    // Отримуємо ім'я файлу
    $filename = basename($_FILES['file']['name']);
    $target_file = $target_dir . $filename;
    
    // перевіряємо, чи файл було успішно завантажено в цільовий каталог
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
        // встановлюємо заголовки для ініціації скачування файлу
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($target_file));

        // очищаємо системний кеш виводу
        flush(); 
        // читаємо файл і відправляємо його до браузера
        readfile($target_file);
        
        // Опціонально: видалення файлу після скачування
        // unlink($target_file);
        
        // Закінчуємо виконання скрипта
        exit;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    echo "No file selected or download button not pressed.";
}
?>
