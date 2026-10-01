function checkDevice() {
  const width = window.innerWidth;
  const height = window.innerHeight;

  // Laptop/Desktop
  const isDesktop = width >= 1024;

  // Tablet in landscape
  const isTabletLandscape = width >= 768 && width < 1024 && width > height;

  const isAllowed = isDesktop || isTabletLandscape;

  if (!isAllowed) {
    const currentPage = encodeURIComponent(window.location.href);

    window.location.href =
      "/AIMS-Cooperative-Management-System/front-end/pages/notApplicable.php?return=" + currentPage;
  }
}

checkDevice();

window.addEventListener("resize", checkDevice);
