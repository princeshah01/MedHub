<?php
if (isset($_GET['file'])) {
    $filename = urldecode($_GET['file']);
    $filepath = realpath(__DIR__ . '/../uploads/') . '/' . $filename;

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        readfile($filepath);
        exit();
    } else {
        echo "Error: File not found.";
    }
} else {
    echo "Error: Invalid file request.";
}
?>
