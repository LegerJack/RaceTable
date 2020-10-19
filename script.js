let table = document.getElementById("raceTable");
let res = document.querySelectorAll(".result");
for(let i = 0; i < res.length; i++){
    res[i].onclick = (e) => {
        let hi = res[i].dataset.id
        console.log(hi);
    };
};

