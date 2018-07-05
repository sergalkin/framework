<h2 class="card-title mt-5 text-center">Войти в аккаунт</h2>
<div class="row justify-content-center mt-3">
    <div class="col-md-6">
        <form method="post" action="/user/login">
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" name="login" class="form-control" id="login" placeholder="Login"
                       value="<?= isset($_SESSION['form_data']['login']) ? h($_SESSION['form_data']['login']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>
            <button class="btn btn-outline-success float-right mb-5">Вход</button>
        </form>
        <?php if (isset($_SESSION['form_data'])) unset($_SESSION['form_data']); ?>
    </div>
</div>
