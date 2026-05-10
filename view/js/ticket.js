const seats         = document.querySelectorAll(".seat");
const bookTxt       = document.querySelector(".book-txt");
const bookBtn       = document.querySelector(".book-btn");
const bookBtn1      = document.getElementById("book-btn-1");
const userId        = document.querySelector(".user-session-id").getAttribute('data-id');
const seatContainer = document.querySelector(".seat-container");
const busId         = seatContainer.getAttribute("data-id");
const ticketPrice   = parseFloat(seatContainer.getAttribute("data-price"));

let seatData = [];
let data     = {};

// ── Seat selection ────────────────────────────────────────────────────────────
seats.forEach(seat => {
    seat.addEventListener("click", () => {
        if (seat.className == "seat booked") return;
        
        else if (seat.className == "seat") {
            seat.className = "seat newbook";
            seatData.push(seat.innerText);
        }
        else if (seat.className == "seat newbook") {
            seat.className = "seat";
            seatData.splice(seatData.indexOf(seat.innerText), 1);
        }

        handleBookElems();
        data = { seats: seatData, uid: userId, bid: busId, price: ticketPrice };
    });
});

const handleBookElems = () => {
    if (seatData.length == 0) {
        bookTxt.style.display = "block";
        bookBtn1.style.display = "none";
    } else {
        bookTxt.style.display = "none";
        bookBtn1.style.display = "block";
    }
};
handleBookElems();

// ── Book button → Khalti ──────────────────────────────────────────────────────
bookBtn1.addEventListener("click", async () => {
console.log('[Khalti] Book button clicked with data:', data);
    // Guards
    if (userId === 'empty') { alert('Please login to book a ticket.'); return; }
    if (seatData.length === 0) { alert('Please select at least one seat.'); return; }

    bookBtn1.disabled    = true;
    bookBtn1.textContent = 'Processing…';

    const payload = { seats: seatData, uid: userId, bid: busId, price: ticketPrice };
    console.log('[Khalti] Sending to initiate_payment.php:', payload);

    try {
        const response = await fetch('./initiate_payment.php', {
            method:  'POST',
            headers: { 'Content-Type': 'application/json' },
            body:    JSON.stringify(payload),
        });

        // Log raw HTTP status first
        console.log('[Khalti] HTTP status:', response.status);

        const result = await response.json();
        console.log('[Khalti] Response:', result);

        if (result.success && result.payment_url) {
            // ✅ Redirect to Khalti hosted payment page
            console.log('[Khalti] Redirecting to:', result.payment_url);
            window.location.href = result.payment_url;
        } else {
            // ❌ Show the exact error Khalti returned
            const errMsg = result.error || 'Unknown error';
            const details = result.details ? '\n\nDetails: ' + JSON.stringify(result.details, null, 2) : '';
            alert('Payment initiation failed:\n' + errMsg + details);
            bookBtn1.disabled    = false;
            bookBtn1.textContent = 'Book';
        }

    } catch (err) {
        // Network / JSON parse error
        console.error('[Khalti] Fetch error:', err);
        alert('Network error — check console (F12) for details.\n' + err.message);
        bookBtn1.disabled    = false;
        bookBtn1.textContent = 'Book';
    }
});

// ── Payment status banner on return from Khalti ───────────────────────────────
const params        = new URLSearchParams(window.location.search);
const paymentStatus = params.get('payment');

if (paymentStatus) {
    const messages = {
        failed:   '❌ Payment was not completed. Please try again.',
        tampered: '⚠️ Payment amount mismatch. Please contact support.',
        db_error: '⚠️ Payment received but booking failed. Contact support with your transaction ID.',
    };
    const banner = document.createElement('div');
    banner.style.cssText = 'background:#fee;color:#900;padding:12px 16px;text-align:center;font-weight:bold;border-bottom:2px solid #c00;';
    banner.textContent   = messages[paymentStatus] ?? '⚠️ Something went wrong with your payment.';
    document.body.prepend(banner);
}
const postToPHP = data => {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = './../backend/postseat.php';

    data.seats.forEach((seat, index) => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = `seats[]`;  
        input.value = seat;
        form.appendChild(input);
    });

    for (const key in data) {
        if (data.hasOwnProperty(key) && key !== 'seats') {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = key;
            input.value = data[key];
            form.appendChild(input);
        }
    }

    document.body.appendChild(form);
    form.submit();  
};

bookBtn.addEventListener("click", ()=> postToPHP(data));