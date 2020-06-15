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
        <a class="btn btn-info" href="admin.php" id="" style="margin-top: 2px;">Accueil</a>
            <a class="btn btn-success" href="deconnexion.php" id="deconnexion" style="margin-top: 2px;">Deconnexion</a>
        </div>


    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="milieu">

                <h3 style="text-align: center;">LA LISTE DES ADMINISTRATEURS</h3><br>
                
                <table>
                    <thead>
                        <tr>
                            <th>PRENOM</th>
                            <th>NOM</th>
                            <th>SCORE</th>
                            <th>PHOTO</th>
                            <th>MODIFIER</th>
                            <th>SUPPRIMER</th>
                        </tr>
                    </thead>
                    <?php
                   


    foreach(register::afficheJoueur("admin") as $liste){
        
        echo '<tbody>
                <tr>
                    <td>'.$liste['Prenom_ad'].'</td>
                    <td>'.$liste['NOM_ad'].'</td>
                    <td>'.$liste['score'].'</td>
                    <td><img src="'.$liste['stamp'].'" style="width=100px ;height:100px"/></td>
                    <td><button><a href="update.php?id='.$liste['Id'].'">modifier</a></button></td>
                    <td><button><a href="delate.php?id='.$liste['Id'].'" onclick="return confirm(\'Voulez-vous vraiment supprimer?\')">Supprimer</a></button></td>
                </tr>
            </tbody>';
    }
?>
                </table>
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
    height: 450px;
    border-radius: 15px;
}
</style>