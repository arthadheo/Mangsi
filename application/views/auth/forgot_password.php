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
              <form method="post" action="<?php echo base_url()?>auth/resetPassword">
                <div class="form-label-group">
                  <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
                  <label for="email">Email address</label>
                </div>

                <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Reset password</button>
                

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>