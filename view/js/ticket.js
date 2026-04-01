const seats= document.querySelectorAll(".seat");
const bookTxt= document.querySelector(".book-txt");
const bookBtn= document.querySelector(".book-btn");
const userId= document.querySelector(".user-session-id").getAttribute('data-id');
const busId= seats[0].parentElement.parentElement.getAttribute("data-id");

let seatData= [];
let data= {};

seats.forEach(seat=> {
    seat.addEventListener("click", ()=>{
        if(seat.className == "seat booked") return;
        else if(seat.className == "seat") {
            seat.className= "seat newbook";

            seatData.push(seat.innerText);
        }
        else if(seat.className == "seat newbook") {
            seat.className="seat";

            seatData.splice(seatData.indexOf(seat.innerText), 1);
        }

        handleBookElems();
        data = {
            seats: seatData,
            uid: userId,
            bid: busId
        };
    })
})

const handleBookElems= ()=>{
    if(seatData.length == 0) {
        bookTxt.style.display= "block";
        bookBtn.style.display= "none";
    }
    else{
        bookTxt.style.display= "none";
        bookBtn.style.display= "block";
    }
}
handleBookElems();

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
