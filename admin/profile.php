<?php
require_once __DIR__ . '/header.php';

$successMsg = '';
$errorMsg = '';

// Handle Password Change
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'change_password') {
    $currpass = $_POST['currpass'] ?? '';
    $newpass = $_POST['newpass'] ?? '';
    $repeatnewpass = $_POST['repeatnewpass'] ?? '';

    $change = $auth->changePassword($currentUser['id'], $currpass, $newpass, $repeatnewpass);
    if ($change['error']) {
        $errorMsg = $change['message'];
    } else {
        $successMsg = "Password updated successfully.";
    }
}

// Handle Image Upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_image') {
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_image']['tmp_name'];
        $fileName = $_FILES['profile_image']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg', 'webp');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $uploadFileDir = __DIR__ . '/uploads/';
            
            // Create uploads folder if not exists
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0755, true);
            }
            
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                
                // Get old image to delete it if exists
                $stmt = $dbh->prepare("SELECT profile_image FROM phpauth_users WHERE id = ?");
                $stmt->execute([$currentUser['id']]);
                $oldImg = $stmt->fetchColumn();

                // Update database
                $stmt = $dbh->prepare("UPDATE phpauth_users SET profile_image = ? WHERE id = ?");
                if ($stmt->execute([$newFileName, $currentUser['id']])) {
                    $successMsg = "Profile image successfully updated.";
                    
                    // Delete old file
                    if ($oldImg && file_exists($uploadFileDir . $oldImg)) {
                        unlink($uploadFileDir . $oldImg);
                    }
                    
                } else {
                    $errorMsg = 'Error updating database with new image.';
                }
            } else {
                $errorMsg = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
            }
        } else {
            $errorMsg = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
        }
    } else {
        $errorMsg = 'There is some error in the file upload. Please check the following error.<br>Error:' . $_FILES['profile_image']['error'];
    }
}

// Fetch current profile image for display
$stmt = $dbh->prepare("SELECT profile_image FROM phpauth_users WHERE id = ?");
$stmt->execute([$currentUser['id']]);
$profileImgDb = $stmt->fetchColumn();
$profileImgSrc = $profileImgDb ? './uploads/' . $profileImgDb : './src/images/user-avtar.png';

?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Profile Settings</h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">

    <?php if ($successMsg): ?>
        <div class="alert alert-success"><?= htmlspecialchars($successMsg) ?></div>
    <?php endif; ?>
    <?php if ($errorMsg): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($errorMsg) ?></div>
    <?php endif; ?>

    <div class="row">
      <!-- left column -->
      <div class="col-md-6">
        <!-- Profile Image -->
        <div class="card card-success card-outline">
          <div class="card-body box-profile">
            <div class="text-center mb-3">
              <img class="profile-user-img img-fluid img-circle"
                   src="<?= htmlspecialchars($profileImgSrc) ?>"
                   alt="User profile picture" style="width: 150px; height: 150px; object-fit: cover;">
            </div>

            <h3 class="profile-username text-center"><?= htmlspecialchars($currentUser['email']) ?></h3>
            <p class="text-muted text-center">Administrator</p>

            <form action="profile.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="update_image">
                <div class="form-group">
                    <label for="profile_image">Update Profile Picture</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="profile_image" name="profile_image" accept="image/*" required>
                        <label class="custom-file-label" for="profile_image">Choose file</label>
                      </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-block"><b>Upload Image</b></button>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->

      <div class="col-md-6">
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Change Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="profile.php" method="POST">
                <input type="hidden" name="action" value="change_password">
                <div class="card-body">
                  <div class="form-group">
                    <label for="currpass">Current Password</label>
                    <input type="password" class="form-control" id="currpass" name="currpass" placeholder="Enter current password" required>
                  </div>
                  <div class="form-group">
                    <label for="newpass">New Password</label>
                    <input type="password" class="form-control" id="newpass" name="newpass" placeholder="Enter new password" required>
                  </div>
                  <div class="form-group">
                     <label for="repeatnewpass">Confirm New Password</label>
                     <input type="password" class="form-control" id="repeatnewpass" name="repeatnewpass" placeholder="Confirm new password" required>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
              </form>
            </div>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<script>
// To make custom file input show the selected file name
document.addEventListener('DOMContentLoaded', function () {
  const fileInput = document.querySelector('.custom-file-input');
  if (fileInput) {
      fileInput.addEventListener('change', function (e) {
        var fileName = document.getElementById("profile_image").files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
      });
  }
});
</script>

<?php include './footer.php'; ?>