<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "info@coolmood.net"; 
    $subject = "رسالة جديدة من موقعك";
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-type: text/plain; charset=UTF-8\r\n";

    $body = "الاسم: $name\n";
    $body .= "البريد الإلكتروني: $email\n\n";
    $body .= "الرسالة:\n$message";

    if (mail($to, $subject, $body, $headers)) {
        echo "تم إرسال رسالتك بنجاح!";
    } else {
        echo "حدث خطأ أثناء إرسال الرسالة.";
    }
}
?>
