<?php

session_start();
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($confirmPassword == $newPassword) {
        include_once 'dbcom/connect.php';

        $sql = "SELECT accesskey FROM user WHERE id='$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                if ($row['accesskey'] == $oldPassword) {
                    $sql = "UPDATE user SET accesskey = '$newPassword' WHERE id = '$id'";

                    if ($conn->query($sql)) {
                        echo 'Success: Password has been changed!';
                    } else {
                        //header('Location: logout.php');
                        echo 'Error: Something wrong with update query!';
                    }
                } else {
                    echo 'Error: Invalid old password!';
                }
            } else {
                echo 'Error: Can not fetch the data!';
            }
        } else {
            echo 'Error: Can not find this user!';
        }
    } else {
        echo 'Notify: New password and Confirm password should be same!';
    }
} else {
    echo 'Error: Session id is not valid';
}