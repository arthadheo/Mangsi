<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class=" login d-flex align-items-center py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-lg-8 mx-auto">
            <img style="padding-left: 40%; padding-bottom: 5%" src="http://localhost/Mangsi/dist/images/logo/Logo-mangsi.png">
              
              <h3 class="text-center login-heading mb-4">Logo Mangsi</h3>
              <?= $this->session->flashdata('message'); ?>
              <form method="post" action="<?php echo base_url()?>auth/changingPassword">
                <div class="form-label-group">
                  <input type="password" id="password1" name="password1" class="form-control" placeholder="Password" required>
                  <label for="password1">Password</label>
                  <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-label-group">
                  <input type="password" id="password2" name="password2" class="form-control" placeholder="Confirm Password" required>
                  <label for="password2">Confirm Password</label>
                  <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Change Password</button>
                

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>