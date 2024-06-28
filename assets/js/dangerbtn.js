function dangerbtns() {
  document.querySelectorAll("[danger-btn]:not([db-eh])").forEach((db) => {
    db.addEventListener("click", (event) => {
      event.preventDefault();
      event.pluslib_wait = true;
      Swal.fire({
        title: "مطمئن هستی؟",
        text: "این قابل بازگشت نیست!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "آره انجامش بده",
        cancelButtonText: "نه!",
      }).then((result) => {
        if (result.isConfirmed) {
          event.pluslib_actions?.forEach((action) => action());
          event.pluslib_actions || (location.href = db.getAttribute("href"));
        }
      });
    });
    db.setAttribute("db-eh", "set");
  });
}

dangerbtns();
