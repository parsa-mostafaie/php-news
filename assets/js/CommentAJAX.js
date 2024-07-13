import { HandleError } from "./ajaxInitCore.js";

function resetReply() {
  let rep = document.querySelector("#rep");
  let commain = document.querySelector("#commain");
  let card = document.querySelector("#comments");
  commain.prepend(card);
  rep.value = "NULL";
}

window.resetReply = resetReply;

window.addEventListener("load", () => {
  let e = document.querySelector("#error");
  let l = document.querySelector("#logs");
  window.FormLibInitializer.setting(
    "[ajax-submit]",
    (res) => {
      e.textContent = "";
      l.innerHTML = res.json.ob;
      setTimeout(() => {
        l.innerHTML = "";
      }, 5000);
      ajaxContentLoad("#comment");
      document.querySelector("textarea[name=ctext]").value = "";
      resetReply();
    },
    HandleError(e)
  ).init();
});
