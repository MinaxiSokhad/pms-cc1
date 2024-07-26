
<style>
    /* styles.css */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background-color: #fff;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
}

h2 {
    text-align: center;
    margin-bottom: 1rem;
    color: #333;
}
h5{
    text-align: center;
  color: red;
  
}
.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    color: #555;
}


.form-group input,
.form-group textarea {
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 1rem;
    color: #333;
}

.form-group textarea {
    resize: vertical; /* Allow vertical resizing */
    min-height: 60px; /* Set minimum height */
}

button {
    display: block;
    width: 100%;
    padding: 0.75rem;
    background-color: #007BFF;
    color: #fff;
    border: none;
    border-radius: 4px;
    font-size: 1rem;
    cursor: pointer;
    margin-top: 1rem;
}

button:hover {
    background-color: #0056b3;
}

</style>
<!DOCTYPE html>
   <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Customer Information</h2>
        <hr>
         <h5> * Indicates required question</h5>
        <form method="POST">
            <div class="form-group">
            <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                <h5>
  <?php $err = [];
  foreach($errors as $error){
    if($error["0"] =="This field is required"){
        $err[] = $error;
}}
  
    if((sizeOf($err)) >= 3  ){
        
            echo e ("Please filll all the required fill * ");
            $errors = [];
    }

    
 ?></h5></div>
                <label for="company">Company<span style="color: red;"> * </span></label>
                <input type="text" id="company" name="company" value="<?php echo e($oldFormData['company'] ?? ''); ?>" >
                <?php if (array_key_exists('company', $errors)) :?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['company']); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="website">Website<span style="color: red;"> * </span></label>
                <input type="url" id="website" name="website" value="<?php echo e($oldFormData['website'] ?? ''); ?>">
                <?php if (array_key_exists('website', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['website']); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="email">Email<span style="color: red;"> * </span></label>
                <input type="email" id="email" name="email" value="<?php echo e($oldFormData['email'] ?? ''); ?>" >
                <?php if (array_key_exists('email', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['email']); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="phone">Phone<span style="color: red;"> * </span></label>
                <input type="tel" id="phone" name="phone"value="<?php echo e($oldFormData['phone'] ?? ''); ?>">
                <?php if (array_key_exists('phone', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['phone']); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="phone">Country<span style="color: red;"> * </span></label>
                <input type="text" id="country" name="country" value="<?php echo e($oldFormData['country'] ?? ''); ?>">
                <?php if (array_key_exists('country', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['country'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif; ?>
            </div>
            <div class="form-group">
            <label for="address">Address <span style="color: red;"> * </span></label>
             <textarea id="address" name="address"><?php echo e($oldFormData['address'] ?? ''); ?></textarea>
                <?php if (array_key_exists('address', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500" style="color:red">
                    <?php echo e($errors['address'][0]); //show error through looping -> one by one error is check and show it // [0] is display the first error message
                    ?>
                </div>
            <?php endif; ?> 
         </div>
         <?php include $this->resolve('partials/_csrf.php'); ?>

            <button value="submit" type="submit">Submit</button>
        </form>
    </div>
    
</body>
</html>


