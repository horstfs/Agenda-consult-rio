document.addEventListener("DOMContentLoaded", function () {
    const calendario = document.getElementById("calendario");

    // Função para criar o calendário para um mês específico
    function createCalendar(year, month) {
        const table = document.createElement("table");
        const tbody = document.createElement("tbody");

        const headerRow = document.createElement("tr");
        const headerCell = document.createElement("th");
        headerCell.setAttribute("colspan", "7");
        headerCell.textContent = meses[month];
        headerRow.appendChild(headerCell);
        tbody.appendChild(headerRow);

        const daysOfWeekRow = document.createElement("tr");
        const diasSemana = ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"];
        for (let i = 0; i < 7; i++) {
            const cell = document.createElement("th");
            cell.textContent = diasSemana[i];
            daysOfWeekRow.appendChild(cell);
        }
        tbody.appendChild(daysOfWeekRow);

        const firstDay = new Date(year, month, 1).getDay();
        const lastDay = new Date(year, month + 1, 0).getDate();

        let day = 1;

        for (let i = 0; i < 6; i++) {
            const row = document.createElement("tr");

            for (let j = 0; j < 7; j++) {
                const cell = document.createElement("td");
                const dayNumber = day + " - " + diasSemana[j];

                if (i === 0 && j < firstDay) {
                    cell.className = "empty";
                } else if (day <= lastDay) {
                    cell.textContent = dayNumber;
                    day++;

                    const date = year + "-" + (month + 1) + "-" + (day - 1);

                    // Solicitar informações do servidor para verificar se há agendamentos para a data
                    checkAppointments(date, cell);
                } else {
                    cell.className = "empty";
                }

                row.appendChild(cell);
            }

            tbody.appendChild(row);
        }

        table.appendChild(tbody);
        calendario.appendChild(table);
    }

    // Função para verificar agendamentos no servidor (usando AJAX)
    function checkAppointments(date, cell) {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "verificar_agendamentos.php?data=" + date, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);

                if (response.agendado) {
                    cell.className = "booked";
                    // Crie um link para exibir os agendamentos
                    const link = document.createElement("a");
                    link.textContent = "Ver agendamentos";
                    link.href = "exibir_agendamentos.php?data=" + date;
                    cell.innerHTML = `${cell.textContent}<br>`;
                    cell.appendChild(link);
                } else {
                    cell.className = "available";
                }
            }
        };

        xhr.send();
    }

    const meses = [
        "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
        "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
    ];

    const currentDate = new Date();
    const currentYear = currentDate.getFullYear();

    for (let month = 0; month < 12; month++) {
        createCalendar(currentYear, month);
    }
});
