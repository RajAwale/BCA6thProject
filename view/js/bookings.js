// document.getElementById('downloadPdfBtn').addEventListener('click', function () {
//     const { jsPDF } = window.jspdf;
//     const doc = new jsPDF();

//     const busName = document.getElementById('busName').innerText;
//     const date = document.getElementById('date').innerText;
//     const source = document.getElementById('source').innerText;
//     const destination = document.getElementById('destination').innerText;
//     const seatNumber = document.getElementById('seatNumber').innerText;
//     // const price = document.getElementById('price').innerText;

//     doc.text(20, 20, 'Bus Ticket');
//     doc.text(20, 30, `Bus Name: ${busName}`);
//     doc.text(20, 40, `Date: ${date}`);
//     doc.text(20, 50, `Source: ${source}`);
//     doc.text(20, 60, `Destination: ${destination}`);
//     doc.text(20, 70, `Seat Number: ${seatNumber}`);
//     // doc.text(20, 80, `Price: Rs ${price}`);

//     doc.save('bus-ticket.pdf');
// });


document.getElementById('downloadPdfBtn').addEventListener('click', function () {

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // ===========================
    // GET DATA
    // ===========================
    const busName = document.getElementById('busName').innerText;
    const date = document.getElementById('date').innerText;
    const source = document.getElementById('source').innerText;
    const destination = document.getElementById('destination').innerText;
    const seatNumber = document.getElementById('seatNumber').innerText;
    const price = document.getElementById('price').innerText;

    // ===========================
    // BACKGROUND
    // ===========================
    doc.setFillColor(15, 23, 42);
    doc.rect(0, 0, 210, 297, 'F');

    // ===========================
    // HEADER
    // ===========================

    // HEADER TITLE
    doc.setTextColor(255, 255, 255);
    doc.setFont("helvetica", "bold");
    doc.setFontSize(24);
  

    // ===========================
    // WHITE CARD
    // ===========================
    doc.setFillColor(255, 255, 255);
    doc.roundedRect(20, 30, 180, 130, 8, 8, 'F');

    // ===========================
    // CARD TITLE
    // ===========================
    doc.setTextColor(37, 99, 235);
    doc.setFontSize(18);
    doc.text("Passenger Details", 25, 45);

    // LINE
    doc.setDrawColor(220, 220, 220);
    doc.line(25, 53, 180, 53);

    // ===========================
    // DETAILS
    // ===========================
    doc.setTextColor(0, 0, 0);
    doc.setFont("helvetica", "normal");
    doc.setFontSize(13);

    let y = 60;

    function addDetail(label, value) {

        // Label
        doc.setFont("helvetica", "bold");
        doc.text(label, 25, y);

        // Value
        doc.setFont("helvetica", "normal");
        doc.text(value, 80, y);

        y += 15;
    }

    addDetail("Bus Name:", busName);
    addDetail("Date:", date);
    addDetail("Source:", source);
    addDetail("Destination:", destination);
    addDetail("Seat Number:", seatNumber);
    addDetail("Price:", `Rs ${price}`);
    // ===========================
    // SEAT BADGE
    // ===========================
    doc.setFillColor(37, 99, 235);
    doc.roundedRect(130, 100, 45, 22, 5, 5, 'F');

    doc.setTextColor(255, 255, 255);
    doc.setFontSize(14);
    doc.setFont("helvetica", "bold");
    doc.text(`Seat ${seatNumber}`, 142, 112);

    // ===========================
    // FOOTER
    // ===========================
    doc.setTextColor(255, 255, 255);
    doc.setFont("helvetica", "italic");
    doc.setFontSize(10);

    doc.text("Thank you for choosing our bus service!", 48, 260);

    // ===========================
    // SAVE PDF
    // ===========================
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


