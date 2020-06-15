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

                <h3 style="text-align: center;">PARAMETRER VOS QUESTIONS</h3><br>
                <?php

   if (isset($_POST['btn_enregistrer'])) {
      var_dump($_POST);
        if ($_POST['nbp'] >=1) {
        if(isset($_POST["choix"]))
        
        {
            $choix =$_POST["choix"];
            $extra=array();
            $extra['question']=$_POST['questions'];
            $extra['nbredepoint']=$_POST['nbp'];
            $extra['typedereponse']= $choix ;
            
            if($choix=='ct')
            {
            
                $extra['reponses']=$_POST['reponse'];
          
          
            $file[] = $extra;
            $json_data = json_encode($file);

            file_put_contents('./data/questions.json',$json_data);
        }
        else if($choix=='cs')
        {
            $nbrRow=0;
            $tab_reponse=array();
            while(isset($_POST['reponse'.$nbrRow]))
            {
                    if(isset($_POST['rad'.$nbrRow]))
                    {
                    
                        $tab_reponse['valeur']=$_POST['reponse'.$nbrRow];
                        $tab_reponse['bon_resultat']="oui";
                    }
                    else {
                        $tab_reponse['valeur']=$_POST['reponse'.$nbrRow];
                        $tab_reponse['bon_resultat']="non";
                    }
                    $extra['reponses'][]=$tab_reponse;
                    $nbrRow++;
            }
            $file[] = $extra;
            $json_data = json_encode($file);

            file_put_contents('./data/questions.json',$json_data);
       
        }
        else if($choix=='cm')
        {
            $nbrRow=0;
            $tab_reponse=array();
            while(isset($_POST['reponse'.$nbrRow]))
            {
                    if(isset($_POST['cbx'.$nbrRow]))
                    {
                        $tab_reponse['valeur']=$_POST['reponse'.$nbrRow];
                        $tab_reponse['bon_resultat']="oui";
                    }
                    else {
                        $tab_reponse['valeur']=$_POST['reponse'.$nbrRow];
                        $tab_reponse['bon_resultat']="non";
                    }
                    $extra['reponses'][]=$tab_reponse;
                    $nbrRow++;
            }
            $file[] = $extra;
            $json_data = json_encode($file);

            file_put_contents('./data/questions.json',$json_data);
       
        }
        }
        else{
            echo "Choisissez une type de reponse";
        }
        }else {
            echo "Nbre de point insuffisant";
        }
    }
  // var_dump($_POST);
?>
                <form action="" id="form-connexion" name="form-connexion" method="POST">
                    <div class="row">
                        <div class="col-lg-5">
                            <textarea type="text" class="form-control" placeholder="Veuillez saisir votre question"
                                name="questions" id="questions" error="error-1"></textarea>
                            <div class="error-form" id="error-1"></div>
                        </div>
                        <div class="col-lg-5">
                            <input type="number" name="nbq" class="form-control" step="number" min=1
                                placeholder="Saisir le nombre de point" error="error-2">
                            <div class="error-form" id="error-2"></div>

                        </div>
                    </div><br><br>
                    <div class="row">
                        <div class="col-lg-5">
                            <select class="form-control from-group" name="choix" id="choix" error="error-3">
                                <option>Donnez le type de reponse</option>
                                <option value="cm" id="type">Choix multiple</option>
                                <option value="cs">Choix simple</option>
                                <option value="ct">Choix texte</option>
                            </select>
                            <div class="error-form" id="error-3"></div>
                        </div>
                        <div class="col-lg-5" id="inputs">
                            <div class="row" id="row_0">
                                <button type="button" class="btn btn-success" onclick="onAddInput()">+</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <button name="btn_enregistrer" id="" class="btn btn-success" type="submit"
                                    value="">Enregistrer</button>
                            </div>
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



<script>
var nbrRow = 0;

function onAddInput() {
    var type = document.getElementById('choix').value;
    if (type == 'ct') {
        nbrRow++;
        var divInputs = document.getElementById('inputs');
        var newInput = document.createElement('div');
        var recup = document.getElementById('choix').value;
        newInput.setAttribute('class', 'row');
        newInput.setAttribute('id', 'row_' + nbrRow);
        newInput.innerHTML = `
                <input type="text" class="champ font" name="reponse" error="error-2">
                <button type="button" class="btn btn-danger" onclick="onDeleteInput(${nbrRow})">X</button>
                <input id="prodId" name="nb_reponse" type="hidden" value="comp">
                <div class="error-form" id="error-2"></div>
                `;
        divInputs.appendChild(newInput);
    } else if (type == 'cm') {
        nbrRow++;
        var divInputs = document.getElementById('inputs');
        var newInput = document.createElement('div');
        var recup = document.getElementById('choix').value;
        newInput.setAttribute('class', 'row');
        newInput.setAttribute('id', 'row_' + nbrRow);
        newInput.innerHTML = `
                <input type="text" class="champ font" name="reponse${nbrRow}" error="error-3">
                <input type="checkbox" name="cbx${nbrRow}" id="cbx">
                <button type="button" class="btn btn-danger" onclick="onDeleteInput(${nbrRow})">X</button>
                <input id="prodId" name="nb_reponse" type="hidden" value="comp">
                <div class="error-form" id="error-3"></div>
                `;
        divInputs.appendChild(newInput);
    } else if (type == 'cs') {
        nbrRow++;
        var divInputs = document.getElementById('inputs');
        var newInput = document.createElement('div');
        var recup = document.getElementById('choix').value;
        newInput.setAttribute('class', 'row');
        newInput.setAttribute('id', 'row_' + nbrRow);
        newInput.innerHTML = `
                <input type="text" class="champ font" name="reponse${nbrRow}" error="error-4">
                <input type="radio" name="rad${nbrRow}" id="rad">
                <button type="button" class="btn btn-danger" onclick="onDeleteInput(${nbrRow})">X</button>
                <input id="prodId" name="nb_reponse" type="hidden" value="comp">
                <div class="error-form" id="error-4"></div>
                `;
        divInputs.appendChild(newInput);
    }
}

function onDeleteInput(n) {
    var target = document.getElementById('row_' + n);
    setTimeout(function() {
        target.remove();
    }, 500)
    fadeOut('row_' + n);
}

function fadeOut(idTarget) {
    var target = document.getElementById(idTarget);
    var effect = setInterval(function() {
        if (!target.style.opacity) {
            target.style.opacity = 1;
        }
        if (target.style.opacity) {
            target.style.opacity -= 0.1;
        } else {
            clearInterval(effect);
        }
    }, 200)
}

const inputs = document.getElementsByTagName("input");
for (input of inputs) {
    input.addEventListener("keyup", function(e) {
        if (e.target.hasAttribute("error")) {
            var idDivError = e.target.getAttribute("error");
            document.getElementById(idDivError).innerText = ""
        }
    })
}
document.getElementById("form-connexion").addEventListener("submit", function(e) {
    const inputs = document.getElementsByTagName("input");
    var error = false;
    for (input of inputs) {
        if (input.hasAttribute("error")) {
            var idDivError = input.getAttribute("error");
            if (!input.value) {
                document.getElementById(idDivError).innerText = "Ce champ est obligatoire"
                error = true
            }
        }
    }
    if (error) {
        e.preventDefault();
        return false;
    }

})

const textareas = document.getElementsByTagName("textarea");
for (input of inputs) {
    input.addEventListener("keyup", function(e) {
        if (e.target.hasAttribute("error")) {
            var idDivError = e.target.getAttribute("error");
            document.getElementById(idDivError).innerText = ""
        }
    })
}
document.getElementById("form-connexion").addEventListener("submit", function(e) {
    const textareas = document.getElementsByTagName("textarea");
    var error = false;
    for (textarea of textareas) {
        if (textarea.hasAttribute("error")) {
            var idDivError = textarea.getAttribute("error");
            if (!textarea.value) {
                document.getElementById(idDivError).innerText = "Ce champ est obligatoire"
                error = true
            }
        }
    }
    if (error) {
        e.preventDefault();
        return false;
    }

})

const selects = document.getElementsByTagName("choix");
for (choix of selects) {
    choix.addEventListener("keyup", function(e) {
        if (e.target.hasAttribute("error")) {
            var idDivError = e.target.getAttribute("error");
            document.getElementById(idDivError).innerText = ""
        }
    })
}
document.getElementById("form-connexion").addEventListener("submit", function(e) {
    const selects = document.getElementsByTagName("choix");
    var error = false;
    for (choix of selects) {
        if (choix.hasAttribute("error")) {
            var idDivError = choix.getAttribute("error");
            if (!choix.value) {
                document.getElementById(idDivError).innerText = "Ce champ est obligatoire"
                error = true
            }
        }
    }
    if (error) {
        e.preventDefault();
        return false;
    }

})
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
}

.col-lg-5 {
    margin-left: 20px;
}

.error-form {
    color: red;
    font-size: bold;
}
</style>