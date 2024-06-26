import { HandleError } from "./ajaxInitCore.js";

window.addEventListener("load", () => {
  let e = document.querySelector("#error");
  window.FormLibInitializer.setting(
    "[ajax-submit]",
    () => (e.textContent = ""),
    HandleError(e)
  ).init();
});
