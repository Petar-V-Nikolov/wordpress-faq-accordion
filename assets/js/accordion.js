(function () {
  "use strict";

  function rootOf(node) {
    return node.closest("[data-pnscripts-faq]");
  }

  function buttonsIn(root) {
    return Array.prototype.slice.call(root.querySelectorAll(".pnscripts-faq__button"));
  }

  function setOpen(button, open) {
    var panelId = button.getAttribute("aria-controls");
    var panel = panelId ? document.getElementById(panelId) : null;

    button.setAttribute("aria-expanded", open ? "true" : "false");

    if (panel) {
      if (open) {
        panel.removeAttribute("hidden");
      } else {
        panel.setAttribute("hidden", "");
      }
    }
  }

  function onClick(event) {
    var button = event.target.closest(".pnscripts-faq__button");
    if (!button) {
      return;
    }

    var root = rootOf(button);
    if (!root) {
      return;
    }

    var expanded = button.getAttribute("aria-expanded") === "true";

    buttonsIn(root).forEach(function (item) {
      setOpen(item, item === button ? !expanded : false);
    });
  }

  function onKeydown(event) {
    var button = event.target.closest(".pnscripts-faq__button");
    if (!button) {
      return;
    }

    var root = rootOf(button);
    if (!root) {
      return;
    }

    var buttons = buttonsIn(root);
    var index = buttons.indexOf(button);
    if (index < 0) {
      return;
    }

    var next = index;

    if (event.key === "ArrowDown") {
      next = (index + 1) % buttons.length;
    } else if (event.key === "ArrowUp") {
      next = (index - 1 + buttons.length) % buttons.length;
    } else if (event.key === "Home") {
      next = 0;
    } else if (event.key === "End") {
      next = buttons.length - 1;
    } else {
      return;
    }

    event.preventDefault();
    buttons[next].focus();
  }

  document.addEventListener("click", onClick);
  document.addEventListener("keydown", onKeydown);
})();
