const modalCam = document.getElementById("modal-cam");
const videoFeed = document.getElementById("videoFeed");
const imagesModelContent = document.getElementById("images-model")?.querySelector("#modal-content > div");
const showImagesBtn = document.getElementById("show-images");

const filesModelContent = document.getElementById("files-model")?.querySelector("#modal-content > div");
const showFilesBtn = document.getElementById("show-files");

const wfilesModelContent = document.getElementById("w-files-model")?.querySelector("#modal-content > div");
const showWFilesBtn = document.getElementById("show-w-files");

const canvas = document.createElement("canvas");
const context = canvas.getContext("2d");

let mediaStream;
let previewImg = "";

let imgList = [];
let filesArr = [];
let wFiles = [];
let camCaptureType = "";

function openSideBar(event) {
  const button = event.target;
  const btnC = button.closest("div");
  window.innerWidth < 1024 ? btnC.classList.toggle("!pl-[278px]") : btnC.classList.toggle("lg:!pl-[278px]")

  // const sidebarDefault = document.getElementById("sidebar-default");
  const sidebar = document.getElementById("sidebar-c");

  const mainContent = sidebar.nextElementSibling;
  mainContent.classList.toggle("lg:!pl-64")

  if (window.innerWidth < 1024) {
    sidebar.classList.toggle("-translate-x-full")
    sidebar.classList.toggle("opacity-0")
  } else {
    sidebar.classList.toggle("lg:-translate-x-0")
    sidebar.classList.toggle("lg:opacity-100")
  }
}

function toggleMenu(event) {
  const button = event.currentTarget;
  let menuContainer = button.nextElementSibling;

  if (menuContainer.classList.contains('max-h-0')) {
    menuContainer.classList.remove('max-h-0', "opacity-0", 'overflow-hidden');
    menuContainer.classList.add('max-h-screen', "opacity-100", 'overflow-visible');
  } else {
    menuContainer.classList.add('max-h-0', "opacity-0", 'overflow-hidden');
    menuContainer.classList.remove('max-h-screen', "opacity-100", 'overflow-visible');
  }

  const chevron = button.querySelector('i');
  if (chevron) {
    chevron.classList.toggle('rotate-180');
  }
}

function openModal(event, id) {
  let timer;
  clearTimeout(timer)

  const modal = document.getElementById(id);

  modal.classList.remove("hidden");
  timer = setTimeout(() => {
    modal.classList.remove("opacity-0");
    modal.classList.add("opacity-100");
  }, 200);

  const firstInput = modal.querySelector("input, textarea");
  if (firstInput) {
    firstInput.focus();
  }

}

function closeModal(event, id, focus = "") {
  let timer;
  const modal = document.getElementById(id);
  clearTimeout(timer)

  modal.classList.remove("opacity-100");
  modal.classList.add("opacity-0");

  timer = setTimeout(() => {
    modal.classList.add("hidden");
  }, 200);

  if(focus != ""){
    var $element = $("#" + focus);

    // Check if the element has a Selectize instance
    if ($element[0] && $element[0].selectize) {
        $element[0].selectize.focus();
    } else {
        $element.focus();
    }
  }
}

function addNewRow(event, id) {
  const modalContent = document.getElementById(id).querySelector("#modal-content");

  // Create a new row as a string
  const newRow = `
    <div class="flex items-end flex-wrap gap-3 mt-5">
      <div class="flex flex-col gap-1">
        <label class="text-gray-600 font-medium">Mobile <span class="text-danger mobile_already"></span></label>
        <input
          name="mobile1[]"
          class="border border-gray-300 w-full transition-all duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md mobile"
          type="text"
        />
      </div>
      <div class="flex flex-col gap-1">
        <label class="text-gray-600 font-medium">Label</label>
        <input
          name="label1[]"
          class="border border-gray-300 w-full transition-all duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md"
          type="text"
        />
      </div>
      <div>
        <button
          class="px-4 py-1.5 transition-colors duration-200 bg-red-600 border border-red-600 text-white rounded-lg hover:bg-transparent hover:text-red-600"
          onclick='removeRow(event)'
        >
          Remove
        </button>
      </div>
    </div>
  `;

  // Append the new row using insertAdjacentHTML
  modalContent.insertAdjacentHTML('beforeend', newRow);

  jQuery('.mobile').last().focus();

}


function addNewless(event, id) {
  const modalContent = document.getElementById(id).querySelector("#modal-content");

  // Create a new row as a string
  const newRow = `
    <div class="flex items-end flex-wrap sm:flex-nowrap gap-3 mt-5">
      <div class="flex flex-col gap-1 flex-grow sm:flex-grow-0">
        <label class="text-gray-600 font-medium">From</label>
        <input
          name="from[]"
          class="no-arrows border border-gray-300 w-full transition-all duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md"
          type="number"
        />
      </div>
      <div class="flex flex-col gap-1 flex-grow sm:flex-grow-0">
        <label class="text-gray-600 font-medium">To</label>
        <input
          name="to[]"
          class="no-arrows border border-gray-300 w-full transition-all duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md"
          type="number"
        />
      </div>
      <div class="flex flex-col gap-1 flex-grow sm:flex-grow-0">
        <label class="text-gray-600 font-medium">Less</label>
        <input
          name="less[]"
          class="no-arrows border border-gray-300 w-full transition-all duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md"
          type="number"
        />
      </div>
      <div class="flex-grow sm:flex-grow-0">
        <button
          class="px-4 py-1.5 transition-colors duration-200 bg-red-600 border border-red-600 text-white rounded-lg hover:bg-transparent hover:text-red-600"
          onclick='removeRow(event)'
        >
          Remove
        </button>
      </div>
    </div>
  `;

  // Append the new row using insertAdjacentHTML
  modalContent.insertAdjacentHTML('beforeend', newRow);

  jQuery('input[name="from[]"]').last().focus();
}

function removeRow(event) {
  const row = event.currentTarget.parentElement.parentElement;
  row.remove()
}

function uploadFile(event, type,) {
  const input = event.target;
  const fileList = input.files
  const files = Array.from(fileList);

  if (type == "img") {

    imgList.push(...files);

    imgList.length > 0 && showImagesBtn.classList.replace("hidden", "block");

    imageList();

  } else if (type == "file") {
    filesArr.push(...files);
    filesArr.length > 0 && showFilesBtn.classList.replace("hidden", "block");
    filesArrFn();
  } else {
    wFiles.push(...files);
    wFiles.length > 0 && showWFilesBtn.classList.replace("hidden", "block");
    wfilesArrFn();
  }
  input.value = "";
}

async function opneCam(event, camCapType) {
  camCaptureType = camCapType;
  try {
    let timer;
    clearTimeout(timer);
    mediaStream = await navigator.mediaDevices.getUserMedia({ video: true });
    videoFeed.srcObject = mediaStream;
    modalCam.classList.remove("hidden");
    timer = setTimeout(() => {
      modalCam.classList.remove("opacity-0");
      modalCam.classList.add("opacity-100");
    }, 200);
  } catch (error) {
    console.error("Error accessing camera:", error);
  }
}

async function capturePhoto() {
  try {
    canvas.width = videoFeed.videoWidth;
    canvas.height = videoFeed.videoHeight;
    context.drawImage(videoFeed, 0, 0, canvas.width, canvas.height);

    canvas.toBlob((blob) => {
      const file = new File([blob], `captured-${blob.size}.png`, { type: "image/png" })
      if (camCaptureType == "img") {
        imgList.push(file);
        showImagesBtn.classList.replace("hidden", "block")
        imageList();
      } else if (camCaptureType == 'file') {
        filesArr.push(file);
        showFilesBtn.classList.replace("hidden", "block")
        filesArrFn();
      } else {
        wFiles.push(file);
        showWFilesBtn.classList.replace("hidden", "block");
        wfilesArrFn();
      }
    }, "image/png");

  } catch (error) {
    console.error("Error capturing photo:", error);
  }
}

function closeCamera() {
  if (mediaStream) {
    mediaStream.getTracks().forEach((track) => track.stop());
    mediaStream = null;
  }
  let timer;
  clearTimeout(timer)

  modalCam.classList.remove("opacity-100");
  modalCam.classList.add("opacity-0");
  timer = setTimeout(() => {
    modalCam.classList.add("hidden");
  }, 200);
}

//
function toggleInputs(event, buttonId,) {
  const target = event.target;
  const allInputContainers = [
    "cash-inpts",
    "cheque-inpts",
    "transfer-inpts",
  ];

  target.parentElement.querySelectorAll("button").forEach((btn) => {
    btn.classList.remove("bg-transparent");
    btn.classList.replace("text-indigo-600", "text-white");
  })

  target.classList.add("bg-transparent");
  target.classList.replace("text-white", "text-indigo-600");

  allInputContainers.forEach((containerId) => {
    document.getElementById(containerId).classList.add("hidden");
  });

  const inputContainerId = `${buttonId}-inpts`;
  const inputContainer = document.getElementById(inputContainerId);
  if (inputContainer) {
    inputContainer.classList.remove("hidden");
  }
}

//

function imageList() {
  imagesModelContent.innerHTML = "",
    imgList.forEach((file) => {
      const reader = new FileReader();
      //reader.onload = function (e) {
        const div = document.createElement("div");
        const img = document.createElement("img");
        const btn = document.createElement("button");
        btn.textContent = "Remove";
        btn.className = 'text-xs font-medium text-indigo-400 underline';

        img.src =URL.createObjectURL(file);
        div.appendChild(img);
        div.appendChild(btn);
        imagesModelContent.appendChild(div);

        btn.addEventListener("click", () => {
          div.remove();
          const fileIndex = imgList.indexOf(file);
          imgList.splice(fileIndex, 1);
          imgList.length < 1 && showImagesBtn.classList.replace("block", "hidden")
        });
      //};
      reader.readAsDataURL(file);
    });
}

function filesArrFn() {

    filesModelContent.innerHTML = "";
  filesArr.forEach((file) => {
      //window.alert('gg');
    const div = document.createElement("div");
    div.className = 'bg-red-50 p-2 border border-red-300 rounded-md';
    const img = document.createElement("img");
      img.className = "text-sm break-words";
    img.src = URL.createObjectURL(file);
    const btn = document.createElement("button");
    btn.textContent = "Remove";
    btn.className = 'text-xs font-medium text-red-400 underline';

    div.appendChild(img);
    div.appendChild(btn);
    filesModelContent.appendChild(div);

    btn.addEventListener("click", () => {
      div.remove();
      const fileIndex = filesArr.indexOf(file);
      filesArr.splice(fileIndex, 1);
      filesArr.length < 1 && showFilesBtn.classList.replace("block", "hidden")
    });
  });
}

function wfilesArrFn() {
  wfilesModelContent.innerHTML = "";
  wFiles.forEach((file) => {
    const div = document.createElement("div");
    div.className = 'bg-green-50 p-2 border border-green-300 rounded-md';
    const img = document.createElement("img");
      img.className = "text-sm break-words";
      img.src = URL.createObjectURL(file);
    const btn = document.createElement("button");
    btn.textContent = "Remove";
    btn.className = 'text-xs font-medium text-green-400 underline';

    div.appendChild(img);
    div.appendChild(btn);
    wfilesModelContent.appendChild(div);

    btn.addEventListener("click", () => {
      div.remove();
      const fileIndex = wFiles.indexOf(file);
      wFiles.splice(fileIndex, 1);
      wFiles.length < 1 && showWFilesBtn.classList.replace("block", "hidden")
    });
  });
}

document.addEventListener("keydown", function(event) {
  if (event.key === "Escape") {
    closeAllModals();
  }
});

function closeAllModals() {
  document.querySelectorAll(".model").forEach(modal => {
    modal.classList.remove("opacity-100");
    modal.classList.add("opacity-0");

    timer = setTimeout(() => {
      modal.classList.add("hidden");
    }, 200);
  });
}
