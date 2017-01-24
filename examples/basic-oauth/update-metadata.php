<?php

use Auth0\SDK\API\Management;

  if (isset($_REQUEST['update']) && $_REQUEST['update']) {

    $managementApi = new Management($auth0->getIdToken(), $domain);

    $newMetadata = json_decode($_REQUEST["metadata"], true);

    $userInfo = $managementApi->users->update(
          $userInfo['user_id'],
          [ 'user_metadata' => $newMetadata ]
        );

    $auth0->setUser($userInfo);

    echo "<div>UPDATED!!!</div>";
  }

$userInfo = $auth0->getUser();

?>

<form action="?update-metadata" method="POST">

    <textarea name='metadata'>
        <?php echo json_encode($userInfo["user_metadata"]); ?>
    </textarea>

    <input type="submit" name="update" value="Update" />
</form>