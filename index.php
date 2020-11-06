<?php 
require './elements/header.php';
require_once './class/Message.php';

$errors = '';
$success = '';
if(!empty($_POST['username']) && !empty($_POST['message'])){
    $message = new Message($_POST['username'], $_POST['message'], new DateTime());
    if(!$message->isValid()){
        $errors = "Veuillez insérer un nom d'utilisateur et un message de 3 caractères minimum !";
    }else{
        $message->toJSON();
        $messages = $message->getJSONContent();
        // echo '<pre>';
        // var_dump($message->getJSONContent());
        // echo '</pre>';


    }
    
}


?>

    <form action="" method="POST">
        <input type="text" name="username" class="username" placeholder="Votre pseudo">
        <textarea name="message" placeholder="Ecrivez un message" class="message"></textarea>
        <button type="submit">Envoyer</button>
    </form>
    <?php if($errors) : ?>
        <div class="errors"> <?= $errors ?></div>
    <?php endif; ?>
    <div class="messages-wrapper">
        
            <?php if(isset($messages)) : ?>
            <?php for($x = 0; $x < count($messages); $x++) : ?>
                <?php if(!empty($messages[$x]['username']) && !empty($messages[$x]['date']) && !empty($messages[$x]['message']) ): ?>
                <div class="messages">
                <p> <?= htmlentities($messages[$x]['username'])?> à <?= $messages[$x]['date']?> </p>
                <p><?= nl2br(htmlentities($messages[$x]['message']))?></p>
                </div>
                <?php endif; ?>
            <?php endfor; ?>
            <?php endif; ?>
        
    </div>
<?php    require './elements/footer.php'; ?>
