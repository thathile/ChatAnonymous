<?php
// Get parameters
$roomname = $_GET['roomname'];

//Connecting to the database
include 'db_connect.php';


// Execute sql to check whether room exists
$sql = "SELECT * FROM `rooms` WHERE roomname = '$roomname'";

$result = mysqli_query($conn, $sql);
if($result)
    {
        // Check if room exists
        if(mysqli_num_rows($result)>0)
        {
            $message = "This room does not exist. Try creating a new one";
            echo '<script language="javascript">';
            echo 'alert("'.$message.'");';
            echo 'window.location="http://localhost/chatpro";';
            echo '</script>';
        }
    }
else
{
    echo "Error : ". mysqli_error($conn);
}


?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- Custom styles for this template -->
<link href="css/product.css" rel="stylesheet">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}

.anyClass{
    height: 350px;
    overflow: scroll;
}

.formcontrol{
    width: 762px;
    padding: 6px;
    margin-top: 14px;
    border-radius: 11px;
}

.btn{
    background-color: green;
    color: white;
    margin-top: 12px;
}

.btn:hover{
    background-color: red;
    color: white;
    transition: 0.9s;
}

@media (max-width: 998px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
        .formcontrol2{
        width: 21rem;
        }
      }  

@media (max-height: 768px) {
      .formcontrol1{
          width: 48.5rem;
        }
}
</style>
</head>
<body>

<h2>Chat Name - <?php echo $roomname; ?></h2>
<div class="anyClass">
<div class="container">
</div>
</div>

<input type="text" class="formcontrol formcontrol1 formcontrol2" name="usermsg" id="usermsg" placeholder="Enter your message"><br>

<btn class="btn btn-default" name="submitmsg" id="submitmsg">Send</btn>


<script src="getbootstrap.com/docs/5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script type="text/javascript">
//Check for new message every 1 second
setInterval(runFunction, 1000);
function runFunction()
{
    $.post("htcont.php", {room:'<?php echo $roomname ?>'},
        function(data, status)
        {
            document.getElementsByClassName('anyClass')[0].innerHTML = data;
        }
    
    )

}

    // Using enter key to submit
    var input = document.getElementById("usermsg");
    input.addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
    event.preventDefault();
    document.getElementById("submitmsg").click();
  }
});

    // If user submits the form
    
    $("#submitmsg").click(function(){
        var clientmsg = $("#usermsg").val();
    $.post("postmsg.php", {text: clientmsg, room:'<?php echo $roomname ?>', ip:'<?php echo $_SERVER['REMOTE_ADDR'] ?>'},
    function(data, status){
    document.getElementsByClassName('anyClass')[0].innerHTML = data;});
    $("#usermsg").val("");
    return false;
});

</script>

</body>
</html>