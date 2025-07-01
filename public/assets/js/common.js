function toggleService(event, serviceId) {
  document
    .querySelectorAll(".service-detail")
    .forEach((el) => el.classList.add("d-none"));
  document.getElementById(serviceId)?.classList.remove("d-none");

  document
    .querySelectorAll(".services-list ul li")
    .forEach((el) => el.classList.remove("active"));
  event?.target?.classList.add("active");
}

function show(id, event) {
  const activeAns = document.getElementById(id);
  const clickedBtn = event.currentTarget;

  const isAlreadyActive = activeAns.classList.contains("active");

  document
    .querySelectorAll(".answer")
    .forEach((ans) => ans.classList.remove("active"));

  document
    .querySelectorAll(".querybox .btn")
    .forEach((btn) => btn.classList.remove("active-btn"));

  if (!isAlreadyActive) {
    activeAns.classList.add("active");
    clickedBtn.classList.add("active-btn");
  }
}
