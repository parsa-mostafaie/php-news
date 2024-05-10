class FormSubmitController {
  $;
  waitTabs = [];
  constructor($el) {
    this.$ = $el;
    $el.addEventListener("submit", () => {
      this.waitTabs.forEach((e) => e.classList.remove("d-none"));
    });
  }
  SubmitWaitTab($query) {
    if (!$query) return;
    document.querySelector($query).classList.add("d-none");
    this.waitTabs.push(document.querySelector($query));
    return this;
  }
}

document.querySelectorAll("form[submit-control]").forEach((el) => {
  let obj = new FormSubmitController(el);
  let attr = (a) => el.getAttribute("form-" + a) || undefined;
  obj.SubmitWaitTab(attr("wait"));
});
