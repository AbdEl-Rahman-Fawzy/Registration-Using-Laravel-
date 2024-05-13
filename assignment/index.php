<?php
include_once 'header.php';
?>

<form id="MyForm" method="POST" >
    <label for="fullname">Fullname:</label>
    <input type="text" name="fullname" id="fullname" placeholder="Fullname" required><br>

    <label for="username">Username:</label>
    <input type="text" name="username" id="username" placeholder="Username" required><br>

    <label for="birth">Date Of Birth:</label>
    <input type="date" name="birth" id="birth" required><br>

    <label for="phone">Phone Number:</label>
    <input type="text" name="phone" id="phone" placeholder="Phone Number" required><br>

    <label for="address">Address:</label>
    <input type="text" name="address" id="address" placeholder="Address" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" placeholder="Password" required><br>

    <label for="cpassword">Confirm Password:</label>
    <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" placeholder="Email" required><br>

    <label for="upload">Select image to upload:</label>
    <input type="file" name="upload" id="upload"><br><br>

    <input type="submit" name="submit" value="Submit" id="submitBtn">
</form>

<script src="javascript/clientValidations.js"></script>

<?php
include_once 'footer.php';
?>
