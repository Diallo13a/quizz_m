<?php
include("fonctions.php");
?>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="../public/css/quizz.css">

<div class="container-fluider">

    <div class="row" id="header">
        <div class="col-lg-2"><img src="../public/images/logo-QuizzSA.png" alt="logo"></div>
        <div class="col-lg-7">CULTURE GENERALE</div>
        <div class="col-lg-3">
            <a class="btn btn-success" href="deconnexion.php" id="deconnexion" style="margin-top: 2px;">Deconnexion</a>
        </div>


    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="milieu">

                <h3 style="text-align: center;">PARAMETRER VOS QUESTIONS</h3><br>
                    <div class="row">
                    <form action="" id="form-connexion" name="form-connexion" method="POST">
                        <div class="form-group">
                            <label for="">Question</label>
                            <textarea class="form-control" name="question" id="" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for=""> Nombre de point</label>
                            <input type="number" step="number" min=1 class="form-control" name="nbq" id=""
                                aria-describedby="helpId" placeholder="">
                            <small id="helpId" class="form-text text-muted"></small>
                        </div>
                
               
                    <div class="form-group">
                        <label for="">Type de reponse</label>
                        <select class="form-control from-group" name="choix" id="choix">
                            <option>Donnez le type de reponse</option>
                            <option value="cm" id="type">Choix multiple</option>
                            <option value="cs">Choix simple</option>
                            <option value="ct">Choix texte</option>
                        </select>
                    </div>
                    <div class="form-group" id="inputs">
                        <div class="wor" id="row_0">
                    <button type="button" class="btn btn-success" onclick="onAddInput()">+</button>
                    </div>
                    </div>
                    <div class="form-group">
                <button name="" id="" class="btn btn-success" type="button" value="">Enregistrer</button>
            </div>
                    </div>

                </form>



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
    width: 80%;
    height: 500px;
    border-radius: 15px;
}

.form-group {
    margin-left: 100px;
    display: ;
}
</style>