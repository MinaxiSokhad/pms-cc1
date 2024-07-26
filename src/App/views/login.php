<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.login-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 300px;
    max-width: 100%;
    text-align: center;
}

.login-container h2 {
    margin-bottom: 20px;
    color: #333;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    text-align: left;
    margin-bottom: 5px;
    color: #666;
}

.form-group input[type="email"],
.form-group input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    box-sizing: border-box;
}

.form-group input[type="email"]:focus,
.form-group input[type="password"]:focus {
    outline: none;
    border-color: #007bff;
}

button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 12px 20px;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Form</title>
<link rel="stylesheet" href="styles.css">
</head>
<!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const login = document.getElementById('login');
            const email = document.getElementById('email');
            const password = document.getElementById('password');

            const emailErr = document.getElementById('emailErr');
            const passwordErr = document.getElementById('passwordErr');

            email.addEventListener('input',EmailRule);
            password.addEventListener('input',passRule);

            login.addEventListener('submit',function(event){
            if (!validForm()) {
                event.preventDefault();
            }
           });

           function EmailRule(){
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                
                if(!emailPattern.test(email.value)){
                    emailErr.textContent = "Enter Valid Email ";
                    return false;
                }
                else{
                    emailErr.textContent ="";
                    return true;
                }   
            }

            function passRule(){
                const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
                if(!passwordPattern.test(password.value)){
                    passwordErr.textContent = "Enter valid Password";
                    return false;
                }
                else{
                    passwordErr.textContent='';
                    return true;
                }
            }

            function validForm(){
                let isValid = true;
                isValid &= EmailRule();
                isValid &= passRule();
                return isValid;
            }
        });
    </script> -->
<body>
<div class="login-container">
    <h2>Login</h2>
    <form id="login" method="POST">
    <?php include $this->resolve('partials/_csrf.php'); ?>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
            <div id="emailErr" style="color:red">
      </div>
            <?php if (array_key_exists('email', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['email'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            <div id="passwordErr" class="mt-2 p-2 text-red-500" style="color:red">
      </div>
            <?php if (array_key_exists('password', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['password'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif; ?>
        </div>
        <button type="submit">Login</button>
        <p>Not registered yet? <a href="/register">Check registration</a></p>
    </form>
</div>
</body>
</html>
