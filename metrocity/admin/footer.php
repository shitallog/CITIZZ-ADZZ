<footer class="footer">
					<div class="container-fluid">
						<div class="copyright m-auto">
							&copy; Copyrights <?php echo date('Y'); ?> Metrocity | All Rights Reserved | Website Designed by <a href="http://www.technobizzar.com" target="_blank">Technobizzar</a>
						</div>				
					</div>
				</footer>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header bg-danger">
					<h6 class="modal-title"><i class="la la-power-off"></i> Logout ?</h6>
					<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">									
					<h6>Are you sure you want to logout ?</h6>
				</div>
				<div class="modal-footer">
					<a href="?logout" class="btn btn-secondary">LOGOUT</a>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/datatables/jquery.dataTables.js"></script>
<script src="assets/datatables/dataTables.bootstrap4.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script> -->
<script src="assets/js/core/jquery.repeater.js"></script>
<!-- Select2 JS --> 
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="assets/js/ready.min.js?v=4"></script>
<!-- <script src="assets/js/demo.js"></script> -->
</html>

<?php
if (isset($_GET['logout']))
{
	session_start();
	session_unset();
	session_destroy();
	echo ("<script LANGUAGE='JavaScript'>
       window.location.href='login.php';
       </script>");
}
?>