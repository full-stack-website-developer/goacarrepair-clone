function toggleService(event, serviceId) {
    document.querySelectorAll('.service-detail').forEach(el => el.classList.add('d-none'));
    document.getElementById(serviceId)?.classList.remove('d-none');

    document.querySelectorAll('.services-list ul li').forEach(el => el.classList.remove('active'));
    event?.target?.classList.add('active');
}