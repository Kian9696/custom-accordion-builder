document.addEventListener("DOMContentLoaded", function () {
  const wrappers = document.querySelectorAll(".cab-accordion-wrapper");

  wrappers.forEach((wrapper) => {
    const headers = wrapper.querySelectorAll(".cab-accordion-header");

    headers.forEach((header) => {
      header.addEventListener("click", function () {
        const panelId = header.getAttribute("aria-controls");
        const panel = document.getElementById(panelId);
        const expanded = header.getAttribute("aria-expanded") === "true";

        // Toggle the state
        header.setAttribute("aria-expanded", String(!expanded));

        const cabUpIcon = `<svg class="cab-arrow-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 56 56" fill="none">
            <path d="M17.29 36.645L28 25.9583L38.71 36.645L42 33.355L28 19.355L14 33.355L17.29 36.645Z" fill="#060606"/>
            </svg>`;

        const cabDownIcon = `<svg class="cab-arrow-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 56 56" fill="none">
            <path d="M17.29 19.355L28 30.0416L38.71 19.355L42 22.645L28 36.645L14 22.645L17.29 19.355Z" fill="#060606"/>
            </svg>`;

        const iconSpan = header.querySelector(".cab-header-icon");

        if (!expanded) {
          panel.style.maxHeight = panel.scrollHeight + "px";
          panel.classList.add("expanded");
          iconSpan.innerHTML = cabUpIcon;
        } else {
          panel.style.maxHeight = null;
          panel.classList.remove("expanded");
          iconSpan.innerHTML = cabDownIcon;
        }

        // Optionally: Close others (if single-open behavior is desired)
        /*
                headers.forEach(otherHeader => {
                    if (otherHeader !== header) {
                        const otherPanelId = otherHeader.getAttribute('aria-controls');
                        const otherPanel = document.getElementById(otherPanelId);
                        otherHeader.setAttribute('aria-expanded', 'false');
                        otherPanel.style.maxHeight = null;
                        otherPanel.classList.remove('expanded');
                    }
                });
                */
      });
    });

    // Auto-expand if marked open
    wrapper.querySelectorAll(".cab-accordion-panel").forEach((panel) => {
      if (panel.classList.contains("expanded")) {
        panel.style.maxHeight = panel.scrollHeight + "px";
      }
    });
  });
});
