<?php
// ����������, �� ���� ��������� ������ ���������� �� �� ��� ���� ������������
if (isset($_POST['download']) && !empty($_FILES['file']['name'])) {
    // ��������� �������� ������� ��� ������������� �����
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
    // �������� ��'� �����
    $filename = basename($_FILES['file']['name']);
    $target_file = $target_dir . $filename;
    
    // ����������, �� ���� ���� ������ ����������� � �������� �������
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
        // ������������ ��������� ��� �������� ���������� �����
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($target_file));

        // ������� ��������� ��� ������
        flush(); 
        // ������ ���� � ����������� ���� �� ��������
        readfile($target_file);
        
        // �����������: ��������� ����� ���� ����������
        // unlink($target_file);
        
        // �������� ��������� �������
        exit;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    echo "No file selected or download button not pressed.";
}
?>
