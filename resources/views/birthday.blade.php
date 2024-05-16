<!DOCTYPE html>
<html>
<head>
    <title>User Birthday Form</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('front-assets')}}/edit.css">
</head>
<body>
@include('layout.header')
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">  
    <br>  <h2>Enter Your Birthday</h2>
        <label for="birthday">Birthday:</label><br>
        <input type="date" id="birthday" name="birthday"><br><br>
        <input type="submit" id="submitBtn" name="submit" value="Submit">
        <p id="birthdayMsg"></p>
    </form>
 @include('layout.footer')
   
</body>
<script>
    $(document).ready(function(){
    $('#submitBtn').click(function(e){
        e.preventDefault();
        var birthday = $('#birthday').val(); // Get the value of the date input
        
        // Extract day and month from the birthday value
        var parts = birthday.split('-');
        var day = parts[2];
        var month = parts[1];
        $.ajax({
            type: 'POST',
            url: '/CelebritiesBornToday',
            data: {
                '_token': '{{ csrf_token() }}',
                'day': day,
                'month': month
            },
            success: function(response) {
                if (response.status) {
                    var celebrities = response.data.list;
                    var names = celebrities.map(function(celebrity) {
                        return celebrity.nameText.text;
                    });
                    var message = "Actors born on " + day + "-" + month + ":<br>" + names.join("<br>");
                    $('#birthdayMsg').html(message);
                } else {
                    $('#birthdayMsg').html("No celebrities found for the specified date.");
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});

</script>
</html>
