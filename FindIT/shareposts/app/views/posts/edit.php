<?php require APPROOT . '/views/inc/header.php'; ?>
  <a href="<?php echo URLROOT; ?>/posts" class="btn btn-back mb-4"><i class="fa fa-chevron-left" style="color: aliceblue;"></i> Back</a>
  <div class="card card-body mt-5">
    <h2>Edit Post</h2>
    <p>Create a post with this form</p>
    <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method="post" id = "send-form">
      <div class="form-group">
        <label for="title">Title: <sup>*</sup></label>
        <div id="errorContainer"></div>
        <input type="text" name="title" id = "allInput" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
        <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="body">Body: <sup>*</sup></label>
        <textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body']; ?></textarea>
        <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
      </div>
      <input type="submit" class="btn btn-success"id ="submit-btn" value="Submit" onclick = "return confirmSubmit();">
    </form>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>