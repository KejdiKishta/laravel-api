import "./bootstrap";
import "~resources/scss/app.scss";
import.meta.glob(["../img/**"]);
import * as bootstrap from "bootstrap";

const trList = document.querySelectorAll('.ms_click');

trList.forEach(row => {
    row.addEventListener("click", function () {
        const href = row.dataset.href;
        window.location.href = href;
    })
});