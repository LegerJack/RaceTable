let table = document.getElementById("raceTable");
let res = document.querySelectorAll(".result");
let numbersCells = [];
for (let i = 0; i < res.length; i++) {
    res[i].onclick = (e) => {
        let hi = res[i].dataset.id;
        let cellID = Number(res[i].cellIndex);
        let countRows = table.rows.length
        for (j = 1; j <= countRows - 1; j++) {
            numbersCells[j] = Number(table.rows[j].cells[cellID].innerHTML);
        };

        for (l = 1; l <= numbersCells.length; l++) {
            let firsRow = table.rows[l];
            let secondRow = table.rows[l + 1];
            
        }

        //     numbersCells.sort((a,b) => b - a);
        // console.log(numbersCells);
    };
};