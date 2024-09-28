const meses = {
    "1": "Janeiro",
    "2": "Fevereiro",
    "3": "Março",
    "4": "Abril",
    "5": "Maio",
    "6": "Junho",
    "7": "Julho",
    "8": "Agosto",
    "9": "Setembro",
    "10": "Outubro",
    "11": "Novembro",
    "12": "Dezembro"
};

const mesSelect = document.getElementById('mes_patrimonio');
const tableBody = document.getElementById('chk_fita').getElementsByTagName('tbody')[0];

    // Function to extract month and year from a date string
    function getMonthYear(dateString) {
        const parts = dateString.split('-')[0].split('/');
        const month = parseInt(parts[1], 10);
        const year = parts[2];
        return `${meses[month]} / ${year}`;
    }
    
    // Get all unique months from the table rows
    const uniqueMonths = new Set();
    for (const row of tableBody.rows) {
        const dateString = row.cells[1].textContent.trim(); // Get the date from the second cell
        uniqueMonths.add(getMonthYear(dateString));
    }

    // Populate the select element with unique months
    for (const monthYear of uniqueMonths) {
        const option = document.createElement('option');
        const mes = monthYear.split(' / ');
        option.value = mes; // Set the option value (can be used for filtering)
        option.textContent = monthYear;
        mesSelect.appendChild(option);
    }