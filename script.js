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

// <textarea cols="80" rows="2" id="signature" onblur="javascript:msg_input()" onfocus="javascript:clean_input()">Quoi de neuf ?</textarea>

// textarea {
//   border: 0;
//   background: none;
//   resize: none;
//   color: white;
//   font-size: 18px;
//   padding: 10px 0;
//   font-family: "Atyp Display";
//   outline: none;
// }