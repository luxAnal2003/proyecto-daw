<div class="container">
    <h2>Iniciar Sesión</h2>
    <?php
    if (!empty($_SESSION['mensaje'])) {
        ?>
        <div class="alert alert-<?php echo $_SESSION['color']; ?> alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['mensaje']; ?>
        </div>
        <?php
        unset($_SESSION['mensaje']);
        unset($_SESSION['color']);
    }
    ?>
    <form action="index.php?c=Login&f=login" method="POST" name="formLogin" id="formLogin">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
    </form>
</div>
