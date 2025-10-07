# Custom Accordion Builder

**Custom Accordion Builder** is a WordPress plugin that allows you to easily create and manage accordion sections, and display them anywhere using shortcodes.  
It is lightweight, flexible, and ideal for FAQs, collapsible content, or structured presentations.

---

## Features

- Create unlimited accordions with multiple panels.
- Display accordions anywhere using shortcodes.
- Simple admin interface for managing accordion items.
- Lightweight code with no unnecessary dependencies.
- Responsive design compatible with all WordPress themes.
- Smooth toggle animations for open/close states.

---

## Installation

1. Upload the plugin folder `custom-accordion-builder` to the `/wp-content/plugins/` directory.
2. Activate the plugin via the **Plugins** menu in WordPress.
3. Navigate to **Accordion Builder** in the WordPress admin to create your accordions.

---

## Usage

1. Create a new accordion from the plugin admin page.  
2. Add panels with titles and content.  
3. Copy the generated shortcode and paste it into any post, page, or widget.  

**Example shortcode:**  
```
[custom_accordion id="123"]
```

Where `id` is the accordion’s unique ID.

---

## Requirements

- WordPress 5.0+
- PHP 7.4+

---

## Troubleshooting

- **Accordion not showing** → Ensure shortcode ID is valid and plugin is activated.  
- **Style conflicts** → May require minor CSS adjustments depending on your theme.  
- **JavaScript not working** → Check for console errors or conflicting scripts.

---

## Developer Notes

- Accordions are stored as custom post types.  
- Shortcode rendering uses clean HTML with CSS and JS enqueued only when needed.  
- Functions and hooks are prefixed with `cab_` to prevent conflicts.

---

## License

GPLv2 or later.
