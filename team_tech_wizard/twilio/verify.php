<?php
require './process-verify.php';

$phone = (isset($_GET['phone'])) ? $_GET['phone'] : '+000000';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Verify Page</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
  </head>

  <body>
    <div class="d-flex min-vh-100 justify-content-center align-items-center">
      <div class="shadow-sm mx-2 border rounded p-5">
        <h3>Complete verification!</h3>
            <?php if (isset($alert)) { ?>
                <div class="alert alert-success mt-4"><?php echo $alert; ?></div>
            <?php } ?>
        <form action="#" method="POST">
          <div class="form-group">
            <label for="code" class="mt-3 mb-1 text-muted">
              A verification code has been sent to
              <b><?php echo $phone; ?></b>, <br />
              enter the code below to continue.
            </label>
            <input
              id="code"
              type="text"
              name="code"
              class="form-control"
              required
            />
            <input type="hidden" name="Mno" value="<?php echo $phone; ?>" />
            <button
              type="submit"
              name="submit"
              class="btn btn-success mt-2 w-100"
            >
              Submit
            </button>
            <small class="d-block mt-3">
              <a href="onboard.php" class="text-muted">Wrong number?</a>
            </small>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
