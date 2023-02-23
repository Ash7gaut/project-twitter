window.onload = msg_textarea;

function msg_input() {
  if (document.getElementById("title").value == "") {
    document.getElementById("title").value += "Quoi de neuf ?";
  }
}

function clean_input() {
  if (document.getElementById("title").value == "Quoi de neuf ?") {
    document.getElementById("title").value = "";
  }
}
