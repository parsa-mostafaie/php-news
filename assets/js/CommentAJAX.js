import { HandleError } from "./ajaxInitCore.js";

function resetReply() {
  let rep = document.querySelector("#rep");
  let commain = document.querySelector("#commain");
  let card = document.querySelector("#comments");
  resetReplyButton();
  commain.prepend(card);
  rep.value = "NULL";
}

function resetReplyButton(value = "NULL") {
  value == "NULL"
    ? document.querySelector("#resetReplyButton").classList.add("d-none")
    : document.querySelector("#resetReplyButton").classList.remove("d-none");
}

window.resetReplyButton = resetReplyButton;
window.resetReply = resetReply;

window.addEventListener("load", () => {
  let e = document.querySelector("#error");
  let l = document.querySelector("#logs");
  let n = document.getElementsByName("sec_form_sess_n")[0];
  let v = document.getElementsByName("sec_form_sess_v")[0];
  window.FormLibInitializer.setting(
    "[ajax-submit]",
    (res) => {
      resetReply();
      e.textContent = "";
      l.innerHTML = res.json.ob;
      [n.value, v.value] = Object.values(res.json.secform);
      setTimeout(() => {
        l.innerHTML = "";
      }, 5000);
      ajaxContentLoad("#comment");
      document.querySelector("textarea[name=ctext]").value = "";
    },
    HandleError(e)
  ).init();
});
