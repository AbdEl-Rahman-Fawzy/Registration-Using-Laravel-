<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8" />
        <title>نموذج التسجيل</title>
        <link rel="icon" href="{{asset('front-assets')}}/Uploads/registration-form.png">
        <link rel="stylesheet" href="{{asset('front-assets')}}/editAR.css">
    </head>
    <body>
        <header>
            <a href="indexAR" title="الذهاب إلى صفحة التسجيل"><img src="{{asset('front-assets')}}/Uploads/registration-form.png" alt="تسجيل" width="70"></a>
        </header>
        <h1>نموذج التسجيل</h1>
        <form action="/register" method="POST">
            @csrf
            <label for="full_name">الاسم الكامل:</label><br>
            <input type="text" id="full_name" name="full_name"><br><br>

            <label for="user_name">اسم المستخدم:</label><br>
            <input type="text" id="user_name" name="user_name"><br><br>

            <label for="birthdate">تاريخ الميلاد:</label><br>
            <input type="date" id="birthdate" name="birthdate"><br><br>

            <label for="phone">الهاتف:</label><br>
            <input type="text" id="phone" name="phone"><br><br>

            <label for="password">كلمة المرور:</label><br>
            <input type="password" id="password" name="password"><br><br>

            <label for="pwd">تأكيد كلمة المرور:</label><br>
            <input type="password" id="pwd" name="pwd"><br><br>

            <label for="email">البريد الإلكتروني:</label><br>
            <input type="email" id="email" name="email"><br><br>

            <label for="image">الصورة:</label><br>
            <input type="file" id="image" name="image"><br><br>

            <button type="submit" class="styled-button">تسجيل</button>
        </form>
        <div id="errorMessages"></div>
        <script src="{{asset('front-assets')}}/javascript/clientValidations.js"></script>
        <!-- <script src="{{asset('front-assets')}}/javascript/API_Ops.js"></script> -->

        <footer>
            <h4>&copy; 2024 <span>FCAI-CU</span>. جميع الحقوق محفوظة</h4>
        </footer>
    </body>
</html>
