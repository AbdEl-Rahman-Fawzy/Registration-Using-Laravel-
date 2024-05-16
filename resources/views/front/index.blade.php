
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Index</title>
        <link rel="icon" href="{{asset('front-assets')}}/Uploads/registration-form.png">
        <link rel="stylesheet" href="{{asset('front-assets')}}/edit.css">

    </head>
    <body>
        <header>
            <a href="index.html"title="Go To Registeration Page"><img src="{{asset('front-assets')}}/Uploads/registration-form.png" alt="Register" width="70"></a>
        </header>
        <div class="heading">
            <h2>Registeration</h2>
            
        </div>
        <form method="post">
            <label for="fullname">Fullname:</label>
            <input type="text" name="fullname" id="fullname" placeholder="Fullname" required>
            
            <br>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" placeholder="Username" required>
            
            <br>
            <label for="birth">Date Of Birth:</label>
            <input type="date" name="birth" id="birth" placeholder="Date Of Birth" required>
            <br>
            <button type="button" id="getceleb"  >Celebrities With Your Birthday</button>
            <br>
            <p id="answer"></p>

            
            <label for="phone">Phone Number:</label>
            <input type="text" name="phone" id="phone" placeholder="Phone Number" required>
            <br>
            
            <label for="adress">Adress:</label>
            <input type="text" name="adress" id="adress" placeholder="Adress" required>
            <br>
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <br>
            
            <label for="cpassword">Confirm password:</label>
            <input type="password" name="cpassword" id="cpassword" placeholder="Confirm password" required>
            <br>
            
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <br>
            
            <label for="img">Select image:</label>
            <input type="file" id="img" name="img" accept="image/*">
            <br>
            <br>
            <input type="submit" name="sub" id="sub" value="Register">

        </form>
        <div id="errorMessages"></div>
        <script> src="{{asset('front-assets')}}/javascript/clientValidations.js"</script>
        <script  src="{{asset('front-assets')}}/javascript/API_Ops.js"></script>

        <footer>
            <h4>&copy; 2024 <span>FCAI-CU</span>. All rights reserved</h4>
        </footer>

    </body>
</html>