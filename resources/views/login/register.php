<div class="container full-height">
    <div class="row justify-content-center align-items-center full-height">

        <div class="col-md-4">
            <h2><?= $_ENV['APP_NAME'] ?></h2>
            <div class="card">
                <div class="card-header text-center">
                    Create Account
                </div>
                <div class="card-body">
                    <form action="<?= URL ?>Login/store" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="juan">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="+123456789">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="admin@admin.com">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="asdeW">
                        </div>

                        <?php if (isset($_GET['errors'])) { ?>
                            <div class="alert alert-warning" role="alert">
                                <ul>
                                    <?php foreach (json_decode($_GET['errors']) as $error) {
                                            echo "<li>$error</li>";
                                        } ?>
                                </ul>
                            </div>
                        <?php } ?>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-outline-secondary" onclick="goToLogin()">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo autoVersionado('login/register.js'); ?>"></script>

<style>
    html,
    body {
        height: 100%;
        margin: 0;
    }

    .full-height {
        height: 100%;
    }
</style>