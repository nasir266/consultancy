const visitedPaths = [];

const tabsEl = document.getElementById("tabs");
const ul = document.createElement("ul");
ul.className = "overflow-x-auto pt-2.5 flex text-gray-600 text-[13px] font-medium bg-white rounded-b-xl sm:max-w-[calc(100%_-_0px)] mx-auto";
ul.style.scrollbarWidth = "thin";

window.addEventListener("popstate", trackPath);
trackPath();

function trackPath() {
  const title = document.title;
  const fullPath = window.location.href;
  if (!fullPath.includes("#")) {

      const vp = JSON.parse(localStorage.getItem("vp"));

      if (vp) {
        visitedPaths.push(...vp)
      }

      if (!visitedPaths.find((path) => path.title === title)) {
        visitedPaths.push({ path: fullPath, title: title });
        localStorage.setItem("vp", JSON.stringify(visitedPaths));
      }

      const li = visitedPaths.map((path, index) => {
        const li = document.createElement("li");
        const a = document.createElement("a");
        const button = document.createElement("button");
        const i = document.createElement("i");
        li.className = `flex-shrink-0 ${title == path.title ? "px-4 bg-indigo-400 text-white rounded-t-lg" : "px-[10px]"} py-2.5 flex items-center justify-between gap-2`
        a.href = path.path;
        a.textContent = path.title;
        button.type = "button";
        i.setAttribute("data-feather", "x");
        i.className = "w-3 h-3";
        a.setAttribute("target", "_blank");

        button.onclick = () => {
          visitedPaths.splice(index, 1);
          localStorage.setItem("vp", JSON.stringify(visitedPaths));
          li.remove();
        }

        button.appendChild(i);
        li.append(a, button);
        return li;
      })

      ul.append(...li);

      if (tabsEl) tabsEl.appendChild(ul);

    }
}