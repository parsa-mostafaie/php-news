window.addEventListener("load", () => {
  let e = document.querySelector("#error");
  window.FormLibInitializer.setting(
    "[ajax-submit]",
    () => (e.textContent = ""),
    ({ err }) => (e.textContent = JSON.stringify(err)),
    undefined,
    (df) => {
      const editorContent = tinymce.activeEditor.getContent({ format: "html" });
      df.set("tiny", editorContent);
    }
  ).init();
});
