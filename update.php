
<?php

include 'connection.php';
session_start();
if(isset($_SESSION['userEmail'])){  

   if(isset($_GET['id'])) 
    {
    $id = $_GET['id'];
    $sql = "SELECT ID,Avatar, Name, Phone,District,Pin_code, State,User_id ,Country FROM contacts WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    }

if(isset($_POST['update'])) 
{  
    $id = $_POST['id'];
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $country=$_POST['country'];
    $district=$_POST['district'];
    $pincode=$_POST['pincode'];
    $state=$_POST['state'];
    $avtar=$_POST['avatar'];


    //Server side validation
    $namebool = false;
    $phonebool = false;
    $distbool = false;
    $countrybool = false;
    $pinbool = false;
    $statebool = false;
    // $avtarbool = false;
    

    $nameerror = "";
    $phoneerror = "";
    $disterror = "";
    $pinerror = "";
    $stateerror = "";
    $countryerror = "";
    // $avtarerror = "";

    //Validation  for name that will accept alphabetically only.
    if(empty($name)){
        $nameerror= "Enter name,if you want to change!";
        $namebool = false;
    }else{
        if(!preg_match("/^[a-zA-Z ]*$/",$name)){
            $nameerror="Name must be enter in alphabet";
            $namebool = false;
        }
        else{
            $namebool = true;
        }
       
    }

   //Phone Input validation
    if(empty($phone)){
        $phoneerror="Enter phone,if you want to change!";
        $phonebool = false;
    }
    else{

        if((!is_numeric($phone)) || (strlen($phone) != 10))  {
            $phoneerror=" Phone must be numeric value and only 10 digits!";
            $phonebool = false;
        }   
        else{
            $phonebool = true;
        }
    }
    //Country Input Validation
    if(empty($country)){
        $countryerror="Enter country name,if you want to change!";
        $countrybool = false;
    }
    else{
        if(!preg_match("/^[a-zA-Z ]*$/",$country)){
            $countryerror="Country name must be enter in alphabet";
            $countrybool = false;
        }else{
        $countrybool = true;
        }
    }
    //District Input validation
    if(empty($district)){
        $disterror="Enter district name,if you want to change!";
        $distbool = false;
    }
    else{
        if(!preg_match("/^[a-zA-Z ]*$/",$district)){
           $disterror=" District name must be enter in alphabet";
          $distbool = false;
        }
        else{
            $distbool = true;
        }
       
    }
  //Pin code Input validation
    if(empty($pincode)){
        $pinerror="Enter pin code,if you want to change!";
        $pinbool = false;
    }
    else{

        if((!is_numeric($pincode)) || (strlen($pincode) != 6))  {
            $pinerror="Enter pin code must be numeric and  only 6 digit!";
            $pinbool = false;
        }  
        else{
            $pinbool = true;
        }
    }

   //State Input validation
    if(empty($state)){
        $stateerror="Enter state name,if you want to change!";
        $statebool = false;
    }
    else{
        if(!preg_match("/^[a-zA-Z ]*$/",$state)){
            $stateerror="State name must be enter in alphabet";
            $statebool = false;
        }
        else{
            $statebool = true;
        }
       
    }
    
   //check condition if all the validation are true then it will insert record through sql language.
  
  if($namebool == true && $phonebool == true && $countrybool == true && $distbool == true && $pinbool == true && $statebool == true ){

    $sql = "UPDATE contacts SET Name='$name', Phone='$phone',District='$district',Pin_code='$pincode', State='$state', Country='$country', Avatar='$avtar'  WHERE id='$id'";
    if (mysqli_query($conn, $sql))
     {
        echo '<script>alert("Updated successfully!");location.href="Dashboard.php"</script>';
        // header("Location: Dashboard.php");
    }
     else 
     {
      echo "Error updating record: " . mysqli_error($conn);
    }
 }
}
mysqli_close($conn);

?>

<html>
  <head>
    <title>Update Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

        <!-- <link rel="stylesheet" href="style.css" type="text/css"> -->
    <style>
    body {
    font-family: Arial, sans-serif;
    /* background-color:hsla(178, 33%, 56%, 0.849); */
    background-color:#2C74B3;

    }

    nav {
    background-color: cyan;
    overflow: hidden;
    display: flex;
    justify-content: space-between;
    padding: 20px;
     }

    nav a {
    color: #f2f2f2;
    text-decoration: none;
    margin-right: 20px;
    }

    form {
    /* background-color:rgb(77, 110, 188);
     */
     background-color:white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 0 10px #999;
    margin: 50px auto;
    width: 500px;
    text-align: center;
     }

    input[type="text"],
    input[type="file"] {
    padding: 10px;
    margin-bottom: 20px;
    width: 100%;
    border-radius: 5px;
    border: 1px solid #333;
    }

    input[type="submit"] {
    background-color: #333;
    color: #ffffff;
    padding: 10px 20px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    }

    input[type="submit"]:hover {
    background-color: #f2f2f2;
    color: #333;
    }  
   </style>
  </head>

  <body>
  <nav class="navbar navbar-expand-lg " style="background-color:#0e59a5;">
        <div class="container-fluid">
        <a class="navbar-brand" href="index.php" style="color:white" ><img src="Images/contactlogo.png" alt="#" height="40px" width="40px" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color:white">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color:white">Abouts Us</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="Register.php" style="padding-right:2vw;color:white">
                            <?php echo $_SESSION['userEmail']?>
                        </a>
                    </li>
                    <button class="btn btn-primary">
                        <span class="navbar-text"><a href="Logout.php" style=" text-decoration: none;color:white">Logout</a></span>
                    </button>
                </ul>
            </div>
        </div>
    </nav>
    <form action="" method="post">
      <h4>Update Record</h4>
      <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
      <p>Name: <input type="text" name="name" value="<?php echo $row['Name']; ?>">
       <span style="color:red">
                        <?php if(isset($nameerror)){
                        echo $nameerror;
                        }?>
                    </span>
    </p>
      <!-- <p>Email: <input type="text" name="email" value="<?php echo $row['Email']; ?>"></p> -->
      <p>Phone: <input type="number" name="phone" value="<?php echo $row['Phone']; ?>">
      <span style="color:red">
                        <?php if(isset($phoneerror)){
                        echo $phoneerror;
                        }?>
                    </span>
    </p>
      <p>District: <input type="text" name="district" value="<?php echo $row['District']; ?>">
       <span style="color:red">
                        <?php if(isset($disterror)){
                        echo $disterror;
                        }?>
                    </span>
    </p>
      <p>Pin_code: <input type="number" name="pincode" value="<?php echo $row['Pin_code']; ?>">
     <span style="color:red">
                        <?php if(isset($pinerror)){
                        echo $pinerror;
                        }?>
                    </span>
    </p>
      <p>State: <input type="text" name="state" value="<?php echo $row['State']; ?>">
      <span style="color:red">
                        <?php if(isset($stateerror)){
                        echo $stateerror;
                        }?>
                    </span>
    </p>
      <p>Country: <input type="text" name="country" value="<?php echo $row['Country']; ?>">
      <span style="color:red">
                        <?php if(isset($countryerror)){
                        echo $countryerror;
                        }?>
                    </span>
    </p>
      <p>Avtar: <input type="file" name="avatar" value="<?php echo $row['Avatar']; ?>"><span><?php echo $row['Avatar']; ?></span></p>
      
      <input type="submit" name="update" value="Update">
      <a href="Dashboard.php">
      <button class="btn btn-danger" type="submit" name="Cancel"><a href="Dashboard.php" style=" text-decoration: none;color:white">Cancel </a></button>
    
    </form>
  </body>
</html>

<?php
}else{
    header("Location:Login.php");
}
?>