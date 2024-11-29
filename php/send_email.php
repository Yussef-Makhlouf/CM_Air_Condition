<?php
// التأكد أن النموذج تم إرساله بالطريقة الصحيحة
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استلام البيانات من النموذج
    $to = "info@coolmood.net"; // البريد الإلكتروني الذي ستستقبل الرسائل عليه
    $subject = "رسالة جديدة من موقعك"; // عنوان الرسالة
    
    // التحقق من صحة البيانات المدخلة
    $name = htmlspecialchars(trim($_POST['name'])); // اسم المرسل
    $email = htmlspecialchars(trim($_POST['email'])); // بريد المرسل
    $message = htmlspecialchars(trim($_POST['message'])); // نص الرسالة

    // التحقق من صحة البريد الإلكتروني
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "البريد الإلكتروني غير صالح.";
        exit;
    }

    // إعداد الهيدر للرسالة (Headers)
    $headers = "From: $email\r\n"; // المرسل
    $headers .= "Reply-To: $email\r\n"; // الرد على المرسل
    $headers .= "Content-type: text/plain; charset=UTF-8\r\n"; // نوع المحتوى
    $headers .= "X-Mailer: PHP/" . phpversion(); // إضافة X-Mailer

    // محتوى الرسالة
    $body = "الاسم: $name\n";
    $body .= "البريد الإلكتروني: $email\n\n";
    $body .= "الرسالة:\n$message";

    // إرسال الرسالة باستخدام دالة mail()
    if (mail($to, $subject, $body, $headers)) {
        // إعادة توجيه المستخدم إلى صفحة شكر أو رسالة تأكيد
        echo "تم إرسال رسالتك بنجاح! شكرًا لتواصلك معنا.";
        // يمكن إعادة التوجيه هنا مثل:
        // header("Location: thank_you.html");
    } else {
        echo "حدث خطأ أثناء إرسال الرسالة. حاول مرة أخرى.";
    }
} else {
    echo "طريقة الإرسال غير صحيحة.";
}
?>
