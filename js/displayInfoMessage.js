window.onload = () => {
  const message = document.getElementById("info");
  displayMessage(message);
};

const displayMessage = (message) => {
  message.style.top = "80px";
  setInterval(() => hideMessage(message), 2000);
};

const hideMessage = (message) => {
  message.style.top = "-300px";
};
