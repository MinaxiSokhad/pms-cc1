<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Registration Form</title>
<!-- <link rel="stylesheet" href="styles.css">
  -->
<style>
    body {
  font-family: Arial, sans-serif;
  background-color: #f2f2f2;
}

.container {
  max-width: 600px;
  margin: 50px auto;
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
h5{
  
  color: red;
  
}
p {
  text-align: center;
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

form {
  display: grid;
  gap: 10px;
}

label {
  font-weight: bold;
}

input[type="text"],
input[type="email"],
input[type="password"],
input[type="tel"],
textarea,
select,
input[type="date"] {
  width: calc(100% - 20px);
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

input[type="submit"] {
  background-color: #0056b3;
  color: white;
  border: none;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 5px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #0056b3;
}

</style>
</head>
<!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const register = document.getElementById('register');
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const country = document.getElementById('country');
            const state = document.getElementById('state');
            const city = document.getElementById('city');
            const gender = document.getElementById('gender');
            const maritalStatus = document.getElementById('maritalStatus');
            const mobileNo = document.getElementById('mobileNo');
            const dob = document.getElementById('dob');
            const hireDate = document.getElementById('hireDate');

            const nameErr = document.getElementById('nameErr');
            const emailErr = document.getElementById('emailErr');
            const passErr = document.getElementById('passErr');
            const countryErr = document.getElementById('countryErr');
            const stateErr = document.getElementById('stateErr');
            const cityErr = document.getElementById('cityErr');
            const genderErr = document.getElementById('genderErr');
            const maritalStatusErr = document.getElementById('maritalStatusErr');
            const numErr = document.getElementById('numErr');
            const dateErr = document.getElementById('dateErr');

            name.addEventListener('input',NameRule);
            email.addEventListener('input',EmailRule);
            password.addEventListener('input',PassRule);
            country.addEventListener('input',CountryRule);
            state.addEventListener('input',StateRule);
            city.addEventListener('input',CityRule);
            gender.addEventListener('change', GenderRule);
            maritalStatus.addEventListener('change', MstatusRule);
            mobileNo.addEventListener('input', NumRule);
            // dob.addEventListener('input', DateRule);
            // hireDate.addEventListener('input', DateRule);

            register.addEventListener('submit',function(event){
            if (!validForm()) {
                event.preventDefault();
            }
           });

           function NameRule(){
                const namePattern = /^[A-Z\sa-z]+$/;
                
                if(!namePattern.test(name.value)){
                    nameErr.textContent = "Enter Valid Name ";
                    return false;
                }
                else{
                    nameErr.textContent ="";
                    return true;
                }   
            }
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
            function PassRule(){
                const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
                if(!passwordPattern.test(password.value)){
                  passErr.textContent = "Password must be at least 8 characters long and contain at lease one digit,one uppercase letter,one lower case letter and also add spacial character or symbol to enter password.";
                    return false;
                }
                else{
                  passErr.textContent='';
                    return true;
                }
            }
            function CountryRule(){
                const namePattern = /^[A-Z\sa-z]+$/;
                
                if(!namePattern.test(country.value)){
                    countryErr.textContent = "Enter Valid Country Name ";
                    return false;
                }
                else{
                    countryErr.textContent ="";
                    return true;
                }   
            }
            function StateRule(){
                const namePattern = /^[A-Z\sa-z]+$/;
                
                if(!namePattern.test(state.value)){
                    stateErr.textContent = "Enter Valid State Name ";
                    return false;
                }
                else{
                    stateErr.textContent ="";
                    return true;
                }   
            }
            function CityRule(){
                const namePattern = /^[A-Z\sa-z]+$/;
                
                if(!namePattern.test(city.value)){
                    cityErr.textContent = "Enter Valid City Name ";
                    return false;
                }
                else{
                    cityErr.textContent ="";
                    return true;
                }   
            }
            function GenderRule(){
                if(gender.value === ' '){
                    genderErr.textContent = "Enter Valid Selection";
                    return false;
                }
                else{
                    genderErr.textContent="";
                    return true;
                }

            }
            function MstatusRule(){
                if(maritalStatus.value === ' '){
                    maritalStatusErr.textContent = "Enter Valid Selection";
                    return false;
                }
                else{
                    maritalStatusErr.textContent="";
                    return true;
                }

            }
            function NumRule(){
              const numPattern = /^[0-9]+$/;
              if(!numPattern.test(mobileNo.value)){
                    numErr.textContent = "Enter Valid Number ";
                    return false;
                }
                else{
                    numErr.textContent ="";
                    return true;
                }   
            }
            function validForm(){
                let isValid = true;
                isValid &= NameRule();
                isValid &= EmailRule();
                isValid &= PassRule();
                isValid &= CountryRule();
                isValid &= StateRule();
                isValid &= CityRule();
                isValid &= GenderRule();
                isValid &= MstatusRule();
                isValid &= NumRule();
                return isValid;
            }
        });
    </script> -->
<body>
<div class="container">
  <h2>User Registration Form</h2>
  <hr>
  <h5> * Indicates required question</h5>
  <form id="register" method="post">
  <?php include $this->resolve('partials/_csrf.php'); ?>
  <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
  <?php $err = [];
  foreach($errors as $error){
    if($error["0"] =="This field is required"){
        $err[] = $error;
}}
  
    if((sizeOf($err)) >= 5  ){
        
            echo e ("Please filll all the required fill * ");
            $errors = [];
    }

    
 ?></div>
  <label for="name">Full Name<span style="color: red;"> * </span></label>
    <input type="text" value="<?php echo e($oldFormData['name'] ?? ''); ?>" id="name" name="name" >
    <div id="nameErr" class="mt-2 p-2 text-red-500" style="color:red">
           </div>
    <?php if (array_key_exists('name', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['name'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif;
            
            
            ?>

            
    <label for="email">Email <span style="color: red;"> * </span></label>
    <input type="text" value="<?php echo e($oldFormData['email'] ?? ''); ?>" id="email" name="email" >
    <div id="emailErr" class="mt-2 p-2 text-red-500" style="color:red">
           </div>
    <?php if (array_key_exists('email', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['email'][0] === 'E'? $errors['email'] : ''); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif; ?>
    <label for="password">Password <span style="color: red;"> * </span></label>
    <input type="password" id="password" name="password" >
    <div id="passErr" class="mt-2 p-2 text-red-500" style="color:red">
           </div>
    <?php if (array_key_exists('password', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['password'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif; ?>
    <label for="country">Country <span style="color: red;"> * </span></label>
    <input type="text" value="<?php echo e($oldFormData['country'] ?? ''); ?>" id="country" name="country">
    <div id="countryErr" class="mt-2 p-2 text-red-500" style="color:red">
           </div>
    <?php if (array_key_exists('country', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['country'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif; ?>
    <label for="state">State <span style="color: red;"> * </span></label>
    <input type="text" value="<?php echo e($oldFormData['state'] ?? ''); ?>" id="state" name="state">
    <div id="stateErr" class="mt-2 p-2 text-red-500" style="color:red">
           </div>
    <?php if (array_key_exists('state', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['state'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif; ?>
    <label for="city">City <span style="color: red;"> * </span></label>
    <input type="text" value="<?php echo e($oldFormData['city'] ?? ''); ?>" id="city" name="city">
    <div id="cityErr" class="mt-2 p-2 text-red-500" style="color:red">
           </div>
    <?php if (array_key_exists('city', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['city'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif; ?>
    <label for="gender">Gender <span style="color: red;"> * </span></label>
    <select id="gender" name="gender">
    <option value=""></option>
      <option value="M"<?php echo ($oldFormData['gender'] ?? '') === 'M' ? 'selected' : ''; ?>>Male</option>
      <option value="F"<?php echo ($oldFormData['gender'] ?? '') === 'F' ? 'selected' : ''; ?>>Female</option>
      <option value="O"<?php echo ($oldFormData['gender'] ?? '') === 'O' ? 'selected' : ''; ?>>Others</option>
    </select>
    <div id="genderErr" class="mt-2 p-2 text-red-500" style="color:red">
           </div>
    <?php if (array_key_exists('gender', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['gender'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif; ?>
    <label for="maritalStatus">Marital Status <span style="color: red;"> * </span></label>
    <select id="maritalStatus" name="maritalStatus">
    <option value=""></option>
      <option value="S"<?php echo ($oldFormData['maritalStatus'] ?? '') === 'S' ? 'selected' : ''; ?>>Single</option>
      <option value="M"<?php echo ($oldFormData['maritalStatus'] ?? '') === 'M' ? 'selected' : ''; ?>>Married</option>
      <option value="W"<?php echo ($oldFormData['maritalStatus'] ?? '') === 'W' ? 'selected' : ''; ?>>Widowed</option>
      <option value="D"<?php echo ($oldFormData['maritalStatus'] ?? '') === 'D' ? 'selected' : ''; ?>>Divorced</option>
    </select>
    <div id="maritalStatusErr" class="mt-2 p-2 text-red-500" style="color:red">
           </div>
    <?php if (array_key_exists('maritalStatus', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['maritalStatus'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif; ?>
    <label for="mobileNo">Mobile Number <span style="color: red;"> * </span></label>
    <input type="text" value="<?php echo e($oldFormData['mobileNo'] ?? ''); ?>" id="mobileNo" name="mobileNo"  placeholder="Enter 10-digit mobile number">
    <div id="numErr" class="mt-2 p-2 text-red-500" style="color:red">
           </div>
    <?php if (array_key_exists('mobileNo', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['mobileNo'][0] === 'M' ? $errors['mobileNo'] : ''); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif; ?>
    <label for="address">Address <span style="color: red;"> * </span></label>
    <textarea id="address" name="address"><?php echo e($oldFormData['address'] ?? ''); ?></textarea>
    <?php if (array_key_exists('address', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['address'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif; ?>
    <label for="dob">Date of Birth <span style="color: red;"> * </span></label>
    <input type="date" value="<?php echo e($oldFormData['dob'] ?? ''); ?>" id="dob" name="dob">
    <?php if (array_key_exists('dob', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['dob'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif; ?>
    <label for="hire_date">Hire Date <span style="color: red;"> * </span></label>
    <input type="date" id="hireDate" value="<?php echo e($oldFormData['hireDate'] ?? ''); ?>" name="hireDate">
    <?php if (array_key_exists('hireDate', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['hireDate'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif; ?>
    <input type="submit" value="Register">
    <p>Already registered? <a href="/login">Click here</a></p>
        
</form>
</div>

</body>
</html>
