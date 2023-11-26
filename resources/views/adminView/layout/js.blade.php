<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('admin/dist/js/demo.js')}}"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      order:false,
      "language": {
        "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/fr-FR.json",
        //"searchPlaceholder": "Entrez date ou devise"
      }
    });
    $("#example3").DataTable({
      "responsive": true,
      "autoWidth": false,
      order:false,
      "language": {
        "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/fr-FR.json",
      }
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "language": {
        "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/fr-FR.json"
      }
    });
  });
</script>
<script src="https://cdn.ckeditor.com/4.19.0/full/ckeditor.js"></script>