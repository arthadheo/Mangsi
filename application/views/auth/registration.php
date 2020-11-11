<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class=" login d-flex align-items-center py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-lg-8 mx-auto">
                            <img style="padding-left: 40%; padding-bottom: 5%" src="http://localhost/Mangsi/dist/images/logo/Logo-mangsi.png">
                            <?= $this->session->flashdata('message'); ?>
                            <form method="post" action="<?php echo base_url() ?>auth/signing_up">
                                <?php
                                if ($this->uri->segment(3) == "inserted") {
                                    echo '<p class="text-success"> Data Inserted</p>';
                                }
                                ?>
                                <div class="form-label-group">
                                    <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" required autofocus>
                                    <span class="text-danger"><?php echo form_error("first_name"); ?></span>
                                    <label for="first_name">First Name</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" required autofocus>
                                    <span class="text-danger"><?php echo form_error("last_name"); ?></span>
                                    <label for="last_name">Last Name</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
                                    <label for="email">Email address</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="password" id="password1" name="password1" class="form-control" placeholder="Password" required>
                                    <label for="password1">Password</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="password" id="password2" name="password2" class="form-control" placeholder="Password" required>
                                    <label for="password2">Confirm Password</label>
                                </div>

                                <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit" name="insert" value="Insert">Sign up</button>
                                <div class="text-center">
                                    <h6>or</h6>


                                </div>
                                <button class="btn btn-danger btn-lg btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">
                                    <i class="fab fa-google fa-fw"></i> Sign up with google
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>