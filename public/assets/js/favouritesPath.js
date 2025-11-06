let favPaths = JSON.parse(localStorage.getItem("fav")) || [];

const buttons = document.querySelectorAll('button[data-label]');
const favourites = document.getElementById("favourites");
const ulList = document.createElement("ul");
ulList.className = "flex overflow-x-auto gap-2 items-center text-[13px] px-6 py-4 md:py-0 md:h-16";
ulList.style.scrollbarWidth = "thin";

favouritesFn("sidebar-default");
favouritesFn("sidebar-c");
updateFavs()

function favouritesFn(sideBarC) {
  const sideBar = document.getElementById(sideBarC);
  sideBar.addEventListener("click", (e) => {
    const button = e.target.closest("button");;
    if (!button) return;
    const dataLabel = button.getAttribute("data-label");
    if (!dataLabel) return;
    const isActive = button.classList.toggle("active");
    const a = button.closest("li")?.querySelector("a") || button.closest("div").querySelector("a");
    const url = a.href;
    const icon = a.querySelector("svg") ? a.querySelector("svg").classList.item(1).split("feather-")[1] : "";

    const matchingButtons = document.querySelectorAll(`button[data-label="${dataLabel}"]`);
    matchingButtons.forEach((btn) => {
      const btnStar = btn.querySelector("i");
      if (isActive) {
        btn.classList.add("active");
        btnStar.classList.replace("text-gray-300", "text-orange-300");
      } else {
        btn.classList.remove("active");
        btnStar.classList.replace("text-orange-300", "text-gray-300");
      }
    });

    if (button.classList.contains("active")) {
      if (!favPaths.some((fav) => fav.text === dataLabel)) {
        favPaths.push({ text: dataLabel, icon, url });
        localStorage.setItem("fav", JSON.stringify(favPaths));
        updateFavsList(dataLabel, icon, url);
        favPaths.length > 0 && ulList.classList.add("px-6", "py-4", "md:py-0", "md:h-16")
        favourites.appendChild(ulList);
      }
    } else {
      favPaths = favPaths.filter((fav) => fav.text !== dataLabel);
      localStorage.setItem("fav", JSON.stringify(favPaths));
      removeFavFromList(dataLabel)
      favPaths.length < 1 && ulList.classList.remove("px-6", "py-4", "md:py-0", "md:h-16")
    }

    feather.replace();
  })
}

function updateFavs() {
  favPaths.forEach((fav) => {
    buttons.forEach((btn) => {
      const label = btn.dataset.label;
      if (fav.text === label) {
        btn.classList.add("active");
        const star = btn.querySelector("i");
        star.classList.replace("text-gray-300", "text-orange-300");
      }
    })
    updateFavsList(fav.text, fav.icon, fav.url)
  })
  favPaths.length > 0 && favourites.append(ulList)
}

function updateFavsList(text, icon, url) {
  const li = document.createElement("li");
  li.setAttribute("data-text", text);
  li.className = "flex-shrink-0";
  const a = document.createElement("a");
  a.className = `p-2.5 flex items-center text-indigo-600 bg-indigo-50 rounded-lg font-medium`;
  a.href = url;
  const i = document.createElement("i");
  (
    icon && i.setAttribute("data-feather", icon),
    icon && (i.className = `w-5 h-5 mr-3`),
    icon && a.append(i)
  )
  a.append(text);
  li.appendChild(a);
  ulList.appendChild(li);
}

function removeFavFromList(text) {
  const li = ulList.querySelector(`li[data-text="${text}"]`);
  if (li) {
    li.remove();
  }
}
