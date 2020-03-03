<?php view('layouts/header'); ?>

<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="<?php echo $user_data['image_path'] ?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?php echo $user_data['full_name'] ?></h5>
                <p class="card-text"><?php echo $user_data['birthday'] ?></p>
                <a href="/" class="btn btn-primary">Go back</a>
            </div>
        </div>
    </div>
</div>

<?php view('layouts/footer'); ?>s