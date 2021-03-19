const select = document.querySelector("select");

const getSelectColor = () => {
  if (select.querySelector(`option[value="${select.value}"]`).className === "M") {
    select.style.color = "blue";
  } else {
    select.style.color = "pink";
  }
};

getSelectColor();

select.addEventListener("change", () => {
  getSelectColor();
});
