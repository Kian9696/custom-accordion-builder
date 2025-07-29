document.addEventListener('DOMContentLoaded', function () {
    const wrappers = document.querySelectorAll('.cab-accordion-wrapper');

    wrappers.forEach(wrapper => {
        const headers = wrapper.querySelectorAll('.cab-accordion-header');

        headers.forEach(header => {
            header.addEventListener('click', function () {
                const panelId = header.getAttribute('aria-controls');
                const panel = document.getElementById(panelId);
                const expanded = header.getAttribute('aria-expanded') === 'true';

                // Toggle the state
                header.setAttribute('aria-expanded', String(!expanded));

                if (!expanded) {
                    panel.style.maxHeight = panel.scrollHeight + 'px';
                    panel.classList.add('expanded');
                } else {
                    panel.style.maxHeight = null;
                    panel.classList.remove('expanded');
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
        wrapper.querySelectorAll('.cab-accordion-panel').forEach(panel => {
            if (panel.classList.contains('expanded')) {
                panel.style.maxHeight = panel.scrollHeight + 'px';
            }
        });
    });
});
