<?php
session_start();
include('fonctions.php');
?>
<?php
 echo Connexion::decTotal($_SESSION['Id']);
 ?>
<!-- Bootstrap CSS -->
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="../public/css/quizz.css">

<div class="container-fluider">

    <div class="row" id="header">
        <div class="col-lg-2"><img src="../public/images/logo-QuizzSA.png" alt="Tigre"></div>
        <div class="col-lg-7"> CULTURE GENERALE</div>
        <div class="col-lg-3">
            <a class="btn btn-success" href="deconnexion.php" id="deconnexion" style="margin-top: 2px;">Deconnexion</a>
        </div>



    </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="milieu">
                <div class="row">
                    <div class="col-lg-8">
                        <?php  echo'<img src="'.register::selectImage($_SESSION['Id']).'" class="rounded-circle">'; ?>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <button type="button" class="btn btn-info">
                            <a name="" id="" class="" href="creer_admin.php" role="button" style="color:white">
                                Creer admin</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8" style="margin-left:450px; background-color:white;top:-400px;border-radius:10px">
                <h2 style="text-align: center;">TABLEAU DE BORD</h2>
            </div>

            <div class="row inline-block" style="margin-left:400px;margin-top:-400px">
                <div class="col-lg-4">
                    <button type="button" class="btn btn-danger" style="font-size: 24px">
                        <a href="liste_admin.php" style="text-decoration: none;color:white;">Liste Admin</a>

                    </button>
                </div>
                <div class="col-lg-4">
                    <button type="button" class="btn btn-success" style="font-size: 24px">
                        <a href="liste_joueur.php" style="text-decoration: none;color:white">Liste Joueur</a>
                    </button>
                </div>
            </div>
            <div class="row inline-block" style="margin-left:400px;margin-top:-10px">
                <div class="col-lg-4">
                    <button type="button" class="btn btn-warning" style="font-size: 24px">
                        <a href="creer_question.php" style="text-decoration: none;color:white">Creer Question</a>

                    </button>
                </div>
                <div class="col-lg-4">
                    <button type="button" class="btn btn-info" style="font-size: 24px">
                        <a href="liste_question.php" style="text-decoration: none;color:white">Liste Question</a>
                    </button>
                </div>
            </div>


        </div>

    </div>

</div>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>

<style type="text/css">
.milieu {
    background-color: white;
    margin-top: 20px;
    width: 30%;
    height: 400px;
    border-radius: 15px;


}

.rounded-circle {
    margin-left: 50%;
    margin-top: 30px;
    width: 100px;
    height: 100px;
}

.btn {
    margin-left: 50%;
    margin-top: 100px;
}
</style>