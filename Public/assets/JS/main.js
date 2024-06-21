import { setRapportDetails, applyFilters, displayResults } from './admin.js';

// Assuming the PHP-generated JSON data is passed via a script tag in the HTML
document.addEventListener('DOMContentLoaded', function() {
    const rapportDetailsJson = document.getElementById('rapportDetailsJson').textContent;
    const rapportDetails = JSON.parse(rapportDetailsJson);
    setRapportDetails(rapportDetails);
    
    // Display all reports by default
    displayResults(rapportDetails);

    document.getElementById('filterForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form from submitting in the traditional way
        applyFilters();
    });
});

