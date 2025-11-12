  <!-- footer start-->
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 footer-copyright footer-content">
                <p class="mb-0">Copyright <?php echo date("Y"); ?> © Patna Broadband  </p>
                <p class="mb-0">Powered By <a href="https://techiesquad.com/" target="_blank">Techie Squad &reg;</a>
                  <svg class="footer-icon">
                    <use href="{{asset('backend/assets/svg/icon-sprite.svg')}}#Heart"></use>
                  </svg>
                </p>
              </div>
            </div>
          </div>
        </footer>

        
      </div>
    </div>
    <!-- latest jquery-->
    <script src="{{asset('backend/assets/js/jquery.min.js')}}"></script>
    <!-- Bootstrap js-->
    {{-- <script src="{{asset('backend/assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/bootstrap/bootstrap.min.js')}}"></script> --}}
    <!-- feather icon js-->
    <script src="{{asset('backend/assets/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/icons/feather-icon/feather-icon.js')}}"></script>
    <!-- scrollbar js-->
    <script src="{{asset('backend/assets/js/scrollbar/simplebar.js')}}"></script>
    <script src="{{asset('backend/assets/js/scrollbar/custom.js')}}"></script>
    <!-- Sidebar jquery-->
    <script src="{{asset('backend/assets/js/config.js')}}"></script>
    <!-- Plugins JS start-->
    <script src="{{asset('backend/assets/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('backend/assets/js/slick/slick.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/slick/slick.js')}}"></script>
    <script src="{{asset('backend/assets/js/header-slick.js')}}"></script>
    <script src="{{asset('backend/assets/js/touchspin/vendors.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/touchspin/touchspin.js')}}"></script>
    <script src="{{asset('backend/assets/js/touchspin/input-groups.min.js')}}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{asset('backend/assets/js/script.js')}}"></script>
    {{-- <script src="{{asset('backend/assets/js/theme-customizer/customizer.js')}}"></script> --}}
    <script src="{{asset('backend/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/datatable/datatables/datatable.custom.js')}}"></script>


    {{-- CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>

    <!-- Bootstrap JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">


    <!-- Custom js used-->
    <script src="{{asset('backend/assets/js/custom/common.js')}}"></script>
    <script>
      // 🔒 Trigger screen lock if cookie is set
      const lockStatus = document.cookie
        .split('; ')
        .find(row => row.startsWith('lockscreen_status='))
        ?.split('=')[1];
       if (lockStatus) myalert();



      	//Hide Loading Box (Preloader)
	function handlePreloader() {
		if($('.preloader').length){
			$('.preloader').delay(200).fadeOut(200);
		}
	}

  	$(window).on('load', function() {
		handlePreloader();
	});	


document.querySelectorAll('.dropdown').forEach(dropdown => {
  const button = dropdown.querySelector('button');
  const span = button.querySelector('span');
  const items = dropdown.querySelectorAll('.dropdown-item');

  items.forEach(item => {
    item.addEventListener('click', e => {
      e.preventDefault();

      const text = item.getAttribute('data-value');
      const icon = item.getAttribute('data-icon');

      // Update the button span only inside this dropdown
      span.innerHTML = `<i class="bi ${icon} me-2"></i>${text}`;
    });
  });
});


const descView = document.getElementById('descView');
const descEdit = document.getElementById('descEdit');
const descText = document.getElementById('descText');
const descInput = document.getElementById('descInput');


// Show textarea on click
descView.addEventListener('click', () => {
  const currentText = descText.innerText.trim();

  // If no description, show placeholder instead
  if (currentText === 'Click to add a description...' || currentText === '') {
    descInput.value = '';
    descInput.placeholder = 'Enter description...';
  } else {
    descInput.value = currentText;
    descInput.placeholder = '';
  }

  descView.classList.add('d-none');
  descEdit.classList.remove('d-none');
  descInput.focus();
});
  document.getElementById('statusSearch').addEventListener('keyup', function() {
    const filter = this.value.toLowerCase();
    const items = document.querySelectorAll('.dropdown-item');
    items.forEach(item => {
      const text = item.textContent.toLowerCase();
      item.style.display = text.includes(filter) ? '' : 'none';
    });
  });
  function updateFileName(slug) {
    const input = document.getElementById(`custom_field_${slug}`);
    const fileNameDiv = document.getElementById(`fileName_${slug}`);
    if (input.files.length > 0) {
      fileNameDiv.textContent = input.files[0].name;
    } else {
      fileNameDiv.textContent = 'No file selected';
    }
  }

//  document.querySelectorAll('[id^="uploadBtn_"]').forEach(btn => {
//     const slug = btn.id.replace('uploadBtn_', '');
//     const input = document.getElementById(`customFile_${slug}`);
//     const nameLabel = document.getElementById(`fileName_${slug}`);

//     // Open file selector when button clicked
//     btn.addEventListener('click', e => {
//       e.preventDefault();
//       input.click();
//     });

//     // Update UI when file selected
//     input.addEventListener('change', () => {
//       if (input.files.length > 0) {
//         const fileName = input.files[0].name;
//         nameLabel.textContent = fileName;
//         nameLabel.classList.remove('text-muted');
//         nameLabel.classList.add('fw-semibold');
//         btn.classList.remove('btn-outline-light');
//         btn.classList.add('btn-success');
//         btn.innerHTML = '<i class="bi bi-check-circle me-1"></i> File Selected';
//       } else {
//         nameLabel.textContent = 'No file selected';
//         nameLabel.classList.add('text-muted');
//         btn.classList.remove('btn-success');
//         btn.classList.add('btn-outline-light');
//         btn.innerHTML = '<i class="bi bi-upload"></i>';
//       }
//     });
//   });

const uploadBtn = document.getElementById('uploadBtn');
    const fileInput = document.getElementById('customFile');
    const fileName = document.getElementById('fileName');

    uploadBtn.addEventListener('click', () => {
      fileInput.click(); // Trigger hidden file input
    });

    fileInput.addEventListener('change', () => {
      if (fileInput.files.length > 0) {
        fileName.textContent = fileInput.files[0].name;
        uploadBtn.classList.remove('btn-outline-primary');
        uploadBtn.classList.add('btn-success');
        uploadBtn.innerHTML = '<i class="bi bi-check-circle me-1"></i> File Selected';
      } else {
        fileName.textContent = 'No file selected';
      }
    });




  const statusBadge = document.getElementById('statusBadge');
const statusText = document.getElementById('statusText');
// const statusDot = statusBadge.querySelector('.status-dot'); // ✅ safer reference
const statusDots = document.getElementsByClassName('status-dot'); // returns an HTMLCollection

const dropdownItems = document.querySelectorAll('.task-status-wrappr .dropdown-item');

const dropdownInstance = bootstrap.Dropdown.getOrCreateInstance(statusBadge);

dropdownItems.forEach(item => {
  item.addEventListener('click', () => {
    const status = item.getAttribute('data-status');
    const color = item.getAttribute('data-color');

    statusText.textContent = status;

    if (statusDots) {
      if (status === "TO DO") {
        statusBadge.className = "badge bg-light text-dark border dropdown-toggle badge-status";
        statusDots.className = "status-dot bg-secondary";
      } else {
        statusBadge.className = `badge bg-${color} text-white dropdown-toggle badge-status`;
        statusDots.className = "status-dot bg-white";
      }
    }

    // Hide dropdown safely
    dropdownInstance.hide();
  });
});
// const statusBadge = document.getElementById('statusBadge');
//     const statusText = document.getElementById('statusText');
//     const dropdownItems = document.querySelectorAll('.task-status-wrappr .dropdown-item');

//     dropdownItems.forEach(item => {
//       item.addEventListener('click', () => {
//         const status = item.getAttribute('data-status');
//         const color = item.getAttribute('data-color');

//         // Update badge appearance
//         statusText.textContent = status;

//         if (status == "TO DO") {
//           // Light gray style
//           statusBadge.className = "badge bg-light text-dark border dropdown-toggle badge-status";
//           statusBadge.querySelector('.status-dot').className = "status-dot bg-secondary";
//         } else {
//           // Colored badge style with white dot
//           statusBadge.className = `badge bg-${color} text-white dropdown-toggle badge-status`;
//           statusBadge.querySelector('.status-dot').className = "status-dot bg-white";
//         }

//         // Close dropdown
//         const dropdown = bootstrap.Dropdown.getInstance(statusBadge);
//         dropdown.hide();
//       });
//     });
   
    const assigneeBtn = document.getElementById('assigneeBtn');
    const userItems = document.querySelectorAll('.user-item');

    userItems.forEach(item => {
      item.addEventListener('click', () => {
        const initials = item.getAttribute('data-initials');
        const name = item.getAttribute('data-name');

        assigneeBtn.innerHTML = `
          <div class="user-avatar">${initials}<span class="online-dot"></span></div>
          {{-- <span class="ms-1">${name}</span> --}}
        `;
        const dropdown = bootstrap.Dropdown.getInstance(assigneeBtn);
        dropdown.hide();
      });
    });




    </script>
    @yield('extra-js')
   
  </body>
</html>