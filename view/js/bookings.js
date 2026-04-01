document.getElementById('downloadPdfBtn').addEventListener('click', function () {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    const busName = document.getElementById('busName').innerText;
    const date = document.getElementById('date').innerText;
    const source = document.getElementById('source').innerText;
    const destination = document.getElementById('destination').innerText;
    const seatNumber = document.getElementById('seatNumber').innerText;
    const price = document.getElementById('price').innerText;

    doc.text(20, 20, 'Bus Ticket');
    doc.text(20, 30, `Bus Name: ${busName}`);
    doc.text(20, 40, `Date: ${date}`);
    doc.text(20, 50, `Source: ${source}`);
    doc.text(20, 60, `Destination: ${destination}`);
    doc.text(20, 70, `Seat Number: ${seatNumber}`);
    doc.text(20, 80, `Price: Rs ${price}`);

    doc.save('bus-ticket.pdf');
});

function showTicketModal(ticketData) {
    document.getElementById('busName').innerText = ticketData.busName;
    document.getElementById('date').innerText = ticketData.date;
    document.getElementById('source').innerText = ticketData.source;
    document.getElementById('destination').innerText = ticketData.destination;
    document.getElementById('seatNumber').innerText = ticketData.seatNumber;
    document.getElementById('price').innerText = ticketData.price;

    document.querySelector('.ticket-modal').classList.add('active');
}

document.querySelectorAll('.ticket-row').forEach(row => {
    row.addEventListener('click', function () {
        const ticketData = {
            busName: this.getAttribute('data-busname'),
            date: this.getAttribute('data-date'),
            source: this.getAttribute('data-source'),
            destination: this.getAttribute('data-destination'),
            seatNumber: this.getAttribute('data-seatnumber'),
            price: this.getAttribute('data-price')
        };
        showTicketModal(ticketData);
    });
});

document.querySelector('.close-modal').addEventListener('click', function () {
    document.querySelector('.ticket-modal').classList.remove('active');
});


