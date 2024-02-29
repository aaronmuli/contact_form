<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
</head>
<body>
    <form method="post">

    <?php wp_nonce_field('wp_rest')?>
    
    <label for="name">Name</label><br/>
    <input type="text" name="name" id="name" placeholder="name"><br/>
    
    <label for="email">Email</label><br/>
    <input type="email" name="email" id="email" placeholder="email"><br/>
    
    <label for="phone">Phone</label><br/>
    <input type="tel" name="phone" id="phone" placeholder="phone"><br/>
    
    <label for="message">Message</label><br/>
    <textarea name="message" id="message" cols="30" rows="10" placeholder="your message"></textarea><br/>

    <button id="submit" type="submit">send message</button>
</form>
<script>
    
    document.getElementById("submit").addEventListener('click', function (event) {
        event.preventDefault();

        const form = document.querySelector('form');

        let formData = new FormData(form);
        
        fetch("<?php echo get_rest_url() . 'contact_form/v1/submit'?>", {
            method: "POST",
            body: formData
        });
    });

</script>
</body>
</html>