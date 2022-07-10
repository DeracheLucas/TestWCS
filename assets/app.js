import './styles/app.css';
import './bootstrap';
import $ from "jquery";


// VIDE L'INPUT AU LANCEMENT DU DOC
$(document).ready(function () {
    let input = document.querySelector('#ajout_membre_nom');
    input.value = "";
});

// VIDE LE STATE DE LA PAGE
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}
