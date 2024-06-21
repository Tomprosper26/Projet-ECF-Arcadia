var rapportDetails = [];

function setRapportDetails(data) {
    rapportDetails = data;
}

function filterByPrenom(prenom) {
    return rapportDetails.filter(function(rapport) {
        return rapport.prenom.toLowerCase() === prenom.toLowerCase();
    });
}

function filterByDate(startDate, endDate) {
    var start = new Date(startDate);
    var end = new Date(endDate);
    return rapportDetails.filter(function(rapport) {
        var date = new Date(rapport.date);
        return date >= start && date <= end;
    });
}

function applyFilters() {
    var prenom = document.getElementById('prenom').value;
    var startDate = document.getElementById('startDate').value;
    var endDate = document.getElementById('endDate').value;

    var filteredReports = rapportDetails;

    if (prenom) {
        filteredReports = filterByPrenom(prenom);
    }

    if (startDate && endDate) {
        filteredReports = filterByDate(startDate, endDate);
    }

    displayResults(filteredReports);
}

function displayResults(reports) {
    var resultsDiv = document.getElementById('results');
    resultsDiv.innerHTML = '';

    if (reports.length === 0) {
        resultsDiv.innerHTML = '<p class="text-danger">Aucun rapport trouvé.</p>';
        return;
    }

    var table = document.createElement('table');
    table.className = 'table table-striped';

    var thead = document.createElement('thead');
    var headerRow = document.createElement('tr');
    var keys = ['Date', 'Nourriture', 'Grammage', 'Détail', 'Prenom', 'User_id', 'Etat'];
    var headers = ['Date', 'Nourriture', 'Grammage', 'Détail de l\'etat de l\'animal', 'Auteur', 'Animal', 'etat'];

    headers.forEach(function(headerText) {
        var th = document.createElement('th');
        th.textContent = headerText;
        headerRow.appendChild(th);
    });

    thead.appendChild(headerRow);
    table.appendChild(thead);

    var tbody = document.createElement('tbody');

    reports.forEach(function(report) {
        var row = document.createElement('tr');
        
        Object.keys(report).forEach(function(key) {
            if (keys.includes(key.charAt(0).toUpperCase() + key.slice(1))) {
                var cell = document.createElement('td');
                cell.textContent = report[key];
                row.appendChild(cell);
            }
        });

        tbody.appendChild(row);
    });

    table.appendChild(tbody);
    resultsDiv.appendChild(table);
}

export { setRapportDetails, applyFilters, displayResults };