$(function () {
/***************************************************************************
 * JAUGE DE SURETÉ DU MOT DE PASSE
 ***************************************************************************/
 /* Déclaration de la variable qui va compter les points*/
 let counter;
 /* déclaration des REGEX*/
 let patt1 = /[a-z]+/g;
 let patt2 = /[A-Z]+/g;
 let patt3 = /[0-9]+/g;
 let patt4 = /\W+/g;
 /* on pointe la zone de texte ou l'on entre le mot de passe */
 let password = document.getElementById('password');
    /**
     * Fonction de calcul du score de chaque caractère tapé dans le mot de passe
     * en fonction de son type et de sa pondération (choisie)
     * @param {REGEX} pattern
     * @param {INT} coeff
     * @returns {Number}
     */
     function scoreCalculate(pattern, coeff) {
      /* initialisation du score*/
      let score = 0;
      /* récupération du mot de passe tapé au fur et à mesure*/
      let passwordContent = password.value;
      /* mise en tableau de toutes les séquences de caractères correspondant à la REGEX*/
      let signArray = [...passwordContent.matchAll(pattern)];
      /* obtention de la longueur du tableau pour la boucle*/
      let signChainSize = signArray.length;
        /* boucle de comptage de chaque caractère stocké dans les différentes cases du tableau
        * et application du coefficient*/
        for (i = 0; i < signChainSize; i++) {
          score += signArray[i][0].length * coeff;
        }

        return score;
      }
      /* déclaration du gestionnaire d'évènement (appui sur une touche de clavier)*/
      password.addEventListener('keyup', passwordStrength);
    /**
     * fonction qui s'execute à chaque appui sur une touche dans la zone de texte 
     * du mot de passe et met à jour le score ainsi que le remplissage de la jauge 
     * de force du mot de passe
     * @returns {undefined}
     */
     function passwordStrength() {
      /* pointage de la jauge de force du mdp*/
      let progress = document.getElementById('progress');
      /* initialisation du compteur de score du mdp*/
      counter = 0;

      /* decompte des lettres minuscules*/
      counter += scoreCalculate(patt1, 1);

      /* decompte des lettres majuscules*/
      counter += scoreCalculate(patt2, 8);

      /* decompte des chiffres*/
      counter += scoreCalculate(patt3, 10);


      /* decompte des caractères spéciaux*/
      counter += scoreCalculate(patt4, 15);

      let passwordContent = password.value;
      /* decompte du nombre total de caractères*/
      counter += passwordContent.length * 2;
      /* mise à jour de la jauge de force du mot de passe*/
      progress.style.width = counter + '%';
      /* paliers de definition de la couleur de la jauge et de la couleur de son label*/
      if (counter < 30) {
        progress.setAttribute("class", "pl-4 h6 text-left mb-0 text-dark progress-bar progress-bar-animated bg-danger");
        document.getElementById('progress').innerHTML = 'mot de passe faible';
      } else if (counter > 70) {
        progress.setAttribute("class", "pl-4 h6 text-left mb-0 progress-bar progress-bar-animated bg-success");
        document.getElementById('progress').innerHTML = 'mot de passe fort';
      } else {
        progress.setAttribute("class", "pl-4 h6 text-left mb-0 text-secondary progress-bar progress-bar-animated bg-warning");
        document.getElementById('progress').innerHTML = 'mot de passe moyen';

      }
    }
/***************************************************************************
 * OPTION DE CHANGEMENT DE MOT DE PASSE
 ***************************************************************************/

    /* création du gestionnaire d'évenement au click sur l'option de changement 
     *  de mot de passe
     */
     $('.passwordChange').click(function () {
      $('.passwordPanel').show(1500);
    });
     $('.passwordNotChange').click(function () {
      $('.passwordPanel').hide(300);
    });





   });

