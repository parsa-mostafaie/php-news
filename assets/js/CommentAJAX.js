import { HandleError } from "./ajaxInitCore.js";

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
    },
    HandleError(e)
  ).init();
});
