<?php

include("includes/header.php");


?>

<div class="userSettings">
    <div>
        <h2>Email</h2>
        <input type="text" class="email" name="email" placeholder="email address" value="<?php echo $userClass->getEmail() ?>">
        <span class="message"></span>
        <button onclick="editEmail('email')">Save</button>
    </div>
    <div>
    <br>
        <h2>Password</h2>
        <input type="text" class="oldPassClass" name="oldPass" placeholder="current password">
        <input type="text" class="newPassClass1" name="newPass1" placeholder="new password">
        <input type="text" class="newPassClass2" name="newPass2" placeholder="repeat new password">
        <span class="message"></span>
        <button onclick="editPassword('oldPassClass','newPassClass1','newPassClass2')">Save</button>
        <br><br>
        <h2>Delete profile</h2>
        <a href='includes/apis/api-delete-user.php?userId=<?php echo $userClass->getUserId();?>'> delete</a>
    </div>
</div>