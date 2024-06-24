window.addEventListener("load", () => {
  let e = document.querySelector("#error");
  window.FormLibInitializer.setting(
    "[ajax-submit]",
    () => (e.textContent = ""),
    function (err) {
      if (err instanceof Response) {
        e.innerHTML = "خطای شبکه! کد " + err.status;
      } else if ("err" in err) {
        let ERRORs = err.err;
        if (ERRORs instanceof Object) {
          let temp = "<ul dir='auto'>";
          for (let ERROR in ERRORs) {
            let ERROR_TEXT = ERRORs[ERROR];
            temp += `<li><b>${ERROR}</b>: ${ERROR_TEXT}</li>`;
          }
          temp += "</ul>";
          e.innerHTML = temp;
        } else e.innerHTML = `<p dir='auto'>${ERRORs}</p>`;
      } else {
        e.innerHTML = "خطای ناخواسته: <br/><p>" + JSON.stringify(err) + "</p>";
      }
    }
  ).init();
});
