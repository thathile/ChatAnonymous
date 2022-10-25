<?php
// Getting the value of post parameters

$room = $_POST['room'];


// Checking for strting size
if(strlen($room)>30 or strlen($room)<2)
{
    $message = "Please choose a name between 2 to 30 characters";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/chatpro";';
    echo '</script>';
}

// Checking whether room name is alphanumeric
elseif(!ctype_alnum($room))
{
    $message = "Please choose an alphanumeric room name";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/chatpro";';
    echo '</script>';
}

else
{
    //Connecting to the database
    include 'db_connect.php';
}


// Checking if room is already exists or not

$sql = "SELECT * FROM `rooms` WHERE roomname = '$room'";
$result = mysqli_query($conn, $sql);
if($result)
{
    if (mysqli_num_rows($result)>0)
    {
        $message = "Please choose a different room name. This room is already exists";
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';
        echo 'window.location="http://localhost/chatpro";';
        echo '</script>';
    }

    else
    {
        $sql = "INSERT INTO `rooms` ( `roomname`, `stime`) VALUES ( '.$room.', current_timestamp);";
        if(mysqli_query($conn, $sql))
        {
            $message = "Your room is ready and you can chat now!";
            echo '<script language="javascript">';
            echo 'alert("'.$message.'");';
            echo 'window.location="http://localhost/chatpro/rooms.php?roomname='. $room.'";';
            echo '</script>';        
        }
    }
}



?>