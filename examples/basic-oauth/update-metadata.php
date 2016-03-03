<?php
    
    if (isset($_REQUEST['update']) && $_REQUEST['update']) {
        
        $newMetadata = json_decode($_REQUEST["metadata"], true);
        
        $auth0Oauth->updateUserMetadata($newMetadata);
        
        echo "<div>UPDATED!!!</div>";
    }  
  
$userInfo = $auth0Oauth->getUser();
  
?>

<form action="?update-metadata" method="POST">

    <textarea name='metadata'>
        <?php echo json_encode($userInfo["user_metadata"]); ?>
    </textarea>  
    
    <input type="submit" name="update" value="Update" />
</form>