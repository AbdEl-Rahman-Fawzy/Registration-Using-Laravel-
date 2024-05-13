document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('MyForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var fullname = document.getElementById('fullname').value.trim();
        var password = document.getElementById('password').value.trim();
        var CPassw = document.getElementById('cpassword').value.trim();
        var email = document.getElementById('email').value.trim();
        var BdateString = document.getElementById('birth').value.trim();
        var Bdate = new Date(BdateString);
        var errors = [];

        if (!validatefullName(fullname)) {
            errors.push('Name is invalid');
        }

        if (!validatePassword(password)) {
            errors.push('Password must have at least a number, 1 special character & must be at least 8 characters');
        }

        if (!validateCPass(CPassw, password)) {
            errors.push('Passwords don\'t match');
        }

        if (!validateEmail(email)) {
            errors.push('Write a valid email');
        }

        if (!validateBirthdate(Bdate)) {
            errors.push('You must be 18+ years old');
        }

        displayErrors(errors);
        if (errors.length === 0) {
            var formData = new FormData(document.getElementById("MyForm"));

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "DB_Ops.php", true);

            xhr.onload = function () {
                if (this.status == 200) {
                    console.log(this.response);   
                } else {
                    
                    console.error(this.statusText);
                }
            };

            xhr.onerror = function () {
                // Network error
                console.error("AJAX request failed");
            };
            // event.preventDefault();
            xhr.send(formData);
        }
    });

    function validatefullName(fullname) {
        if (typeof fullname !== 'string' || fullname.trim() === '') {
            return false;
        }
        if (/^\d+$/.test(fullname)) {
            return false;
        }
        return true;
    }

    function validatePassword(password) {
        var regex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;
        return regex.test(password);
    }

    function validateCPass(CPassw, password) {
        return CPassw === password;
    }

    function validateEmail(email) {
        var regex = /^[\w-]+(\.[\w-]+)*@[a-zA-Z0-9]+(\.[a-zA-Z0-9]+)*(\.[a-zA-Z]{2,})$/;
        return regex.test(email);
    }

    function validateBirthdate(Bdate) {
        var currentDate = new Date();
        var minDate = new Date();
        minDate.setFullYear(minDate.getFullYear() - 18);
        return Bdate <= minDate;
    }

    function displayErrors(errors) {
        var errorMessages = document.getElementById('errorMessages');
        errorMessages.innerHTML = '';
        if (errors.length > 0) {
            var ul = document.createElement('ul');

            errors.forEach(function(error) {
                var li = document.createElement('li');
                li.textContent = error;
                ul.appendChild(li);
            });

            errorMessages.appendChild(ul);
        }
    }
});
