
import { setRapportDetails, applyFilters, displayResults } from './admin.js';

function isCurrentUrl(path) {
    return window.location.pathname === path;
}

if (isCurrentUrl('/connexion-rapport')) {

    document.addEventListener('DOMContentLoaded', function() {
        const rapportDetailsJson = document.getElementById('rapportDetailsJson').textContent;
        const rapportDetails = JSON.parse(rapportDetailsJson);
        setRapportDetails(rapportDetails);
        
    
        displayResults(rapportDetails);
    
        document.getElementById('filterForm').addEventListener('submit', function(event) {
            event.preventDefault(); 
            applyFilters();
        });
    });

}

if (isCurrentUrl('/habitats')) {
    
    function callPHPscript(url, data, callback) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    callback(response);
                } else {
                    console.error('Erreur lors de la requête:', xhr.status);
                }
            }
        };
        xhr.send(JSON.stringify(data));
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('button[data-bs-toggle="modal-animal"]');
        
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const animalId = this.getAttribute('data-id');
                console.log(animalId);
    
                callPHPscript('../incrementViewCount.php', { id: animalId }, function(response) {
                    if (response.success) {
                        console.log(`View count for animal ${animalId} incremented.`);
                    } else {
                        console.error(`Failed to increment view count for animal ${animalId}.`);
                    }
                });
            });
        });
    });
    
}
