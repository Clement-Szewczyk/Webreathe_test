$(document).ready(function() {
    function ModuleStates() {
        console.log('Change state');
        $.ajax({
            url: './script/etat.php',
            type: 'GET',
            dataType: 'json',
        });
        console.log('Updating module states...');
        $.ajax({
            url: './script/recup_etat.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                // Parcourir les données reçues
                for (var moduleId in data) {
                    // Récupérer l'état et le nom du module
                    var moduleState = data[moduleId].Etat;
                    var moduleName = data[moduleId].Nom;
                    
                    // Mettre à jour l'élément d'état correspondant à l'identifiant du module
                    $('#etat_' + moduleId).text(moduleState);
                    $('#etat_' + moduleId).attr('class', 'etat_text ' + moduleState);
                }
            }
        });
        
    }

    ModuleStates();

    setInterval(ModuleStates, 5000);
});
