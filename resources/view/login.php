<h1>Login</h1>

<form name="login" method="POST" action="/verificar-login">
    
    <?php if($key['msg']): ?>
    <p><?= $key['msg']; ?></p>
    <?php endif; ?>
    
    <input type="text" name="email">
    <input type="password" name="senha">
    
    <button type="submit">Acessar</button>
</form>