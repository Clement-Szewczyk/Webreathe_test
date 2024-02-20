$(document).ready(function() {
    function addElement() {
        console.log('Ajout Element');
        $.ajax({
            url: './script/add_element.php',
            type: 'GET',
            dataType: 'json',
        });
        
    }

    addElement();
    setInterval(ModuleStates, 5000);
});
