$(document).ready(function(){
    $('#submitBtn').click(function(e){
        e.preventDefault();
        var birthday = $('#birthday').val();
        $.ajax({
            type: 'POST',
            url: '/CelebritiesBornToday',
            data: {
                '_token': '{{ csrf_token() }}',
                'birthday': birthday
            },
            success: function(response) {
                $('#birthdayMsg').html(response.message);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});
