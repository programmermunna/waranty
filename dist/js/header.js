// Full Screen Toggler
let on_full_screen = false;
function toggle_full_screen() {
  if (!on_full_screen) {
    document.documentElement
      .requestFullscreen()
      .then(() => (on_full_screen = true));
  } else {
    document.exitFullscreen().then(() => (on_full_screen = false));
  }
}

// Header Search Toggler For Mobile Device


// Header Profile Options Toggler
const profile_options = document.getElementById("profile_options");
let profile_options_overlay = document.getElementById(
  "profile_options_overlay"
);
const header_profile_image = document.getElementById("header_profile_image");
let show_options = false;
(() => {
  function toggle() {
    show_options = !show_options;
    if (show_options) {
      profile_options.style.transform = "scaleY(1)";
      profile_options_overlay.style.display = "flex";
    } else {
      profile_options.style.transform = "scaleY(0)";
      profile_options_overlay.style.display = "none";
    }
  }
  header_profile_image.addEventListener("click", () => {
    toggle();
  });
  profile_options_overlay.addEventListener("click", () => {
    toggle();
  });
})();

// Sort functionality
let reverse_sort = false;
let sorted_text = "";
function make_sort(get_sort, items = [], icon_element) {
  let sort = get_sort.toString();
  const sorted = items.sort(function (x, y) {
    let a = x[sort];
    let b = y[sort];
    if (typeof a === "string") {
      a = a.toUpperCase();
      b = b.toUpperCase();
    }
    return a == b ? 0 : a > b ? 1 : -1;
  });

  icon_element.innerHTML = sort_ascending_icon;
  make_show(sorted);

  if (sorted_text !== sort) {
    reverse_sort = false;
  }
  if (sorted_text === sort) {
    reverse_sort = !reverse_sort;
    if (reverse_sort) {
      make_show(sorted.reverse());
      icon_element.innerHTML = sort_descending_icon;
    } else {
      make_show(sorted);
      icon_element.innerHTML = sort_ascending_icon;
    }
  }
  sorted_text = sort;
}

// Load event for all pages
const all_sort_icon = document.querySelectorAll(".sort_icon");
window.addEventListener("load", () => {
  all_sort_icon.forEach((ele) => {
    ele.innerHTML = sort_ascending_icon;
    ele.parentElement.setAttribute(
      "title",
      `Sort by ${ele.previousElementSibling.innerText}`
    );
  });

  localStorage.removeItem("pos_selected");

  setTimeout(() => {
    document.querySelectorAll(".go_home").forEach((ele) => {
      ele.addEventListener("click", () => {
        localStorage.clear();
      });
    });
  }, 100);
});

// function
function adjust_active_icon(is_all) {
  localStorage.removeItem("active_nav_link_text_i");
  if (is_all) {
    localStorage.clear();
  }
}

// Print Page
function print_page() {
  window.print();
}

// Popup Message
const popup_message = document.getElementById("popup_message");
function show_popup_message(message) {
  popup_message.innerHTML += `
  <div class="flex_center gap-2 fixed top-20 right-16 z-50 p-2 rounded bg-green-600 text-white">
  <span>✔</span>
  <span>${message}</span>
  </div>
  `;
  setTimeout(() => {
    popup_message.innerHTML = "";
  }, 1500);
}
