<script src="../assets/vendors/core/core.js"></script>
	<!-- endinject -->

	<!-- Plugin js for this page -->
  <script src="../assets/vendors/flatpickr/flatpickr.min.js"></script>
  <script src="../assets/vendors/apexcharts/apexcharts.min.js"></script>
	<!-- End plugin js for this page -->

	<!-- inject:js -->
	<script src="../assets/vendors/feather-icons/feather.min.js"></script>
	<script src="../assets/js/template.js"></script>
	<!-- endinject -->

	<!-- Custom js for this page -->
  <script src="../assets/js/dashboard-dark.js"></script>
	<!-- End custom js for this page -->
	<script src="../assets/js/data-table.js"></script>

	<script src="../assets/vendors/datatables.net/jquery.dataTables.js"></script>
	<script src="../assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>



	<script>
		function confirmStatusChange(event, orderId) {
			const newStatus = event.target.value;
			const confirmation = confirm(`Are you sure you want to change the status to "${newStatus}"?`);
	
			if (confirmation) {
				document.getElementById(`update-form-${orderId}`).submit();
			} else {
				event.target.value = event.target.getAttribute('data-current-status'); // Reset to previous value
			}
		}
	</script>