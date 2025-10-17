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

    </script>
    @yield('extra-js')
   
  </body>
</html>