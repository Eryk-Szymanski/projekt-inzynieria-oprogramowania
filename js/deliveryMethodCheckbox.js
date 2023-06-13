window.onload = () => {
  const checkboxes = document.getElementsByName("deliveryMethod");
  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("click", () => checkboxOnClick(checkbox));
  });
};

const checkboxOnClick = (checkbox) => {
  const finalPrice = document.getElementById("final_price");
  const cartValue = document.getElementById("cart_value");
  const deliveryDate = document.getElementById("delivery_date");

  finalPrice.innerHTML =
    "Cena końcowa: " +
    (+cartValue.innerHTML + +checkbox.getAttribute("price")) +
    " zł";
  let date = new Date();
  date.setDate(date.getDate() + +checkbox.getAttribute("days"));
  console.log(date);
  deliveryDate.innerHTML =
    "Przewidywany termin dostawy: " +
    date.getFullYear() +
    "-" +
    (+date.getMonth() + 1) +
    "-" +
    date.getDate();
};
