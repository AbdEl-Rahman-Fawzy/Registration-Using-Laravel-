<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
</head>
<body>
    <h1>Registration Form</h1>
    <form action="/register" method="POST">
        @csrf
        <label for="full_name">Full Name:</label><br>
        <input type="text" id="full_name" name="full_name"><br><br>

        <label for="user_name">Username:</label><br>
        <input type="text" id="user_name" name="user_name"><br><br>

        <label for="birthdate">Birthdate:</label><br>
        <input type="date" id="birthdate" name="birthdate"><br><br>

        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone"><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>

        <label for="pwd">Confirm Password:</label><br>
        <input type="password" id="pwd" name="pwd"><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>

        <label for="image">Image:</label><br>
        <input type="file" id="image" name="image"><br><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
