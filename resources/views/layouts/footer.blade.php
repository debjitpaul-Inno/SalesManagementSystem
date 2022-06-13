<footer>
    <x-footer-section></x-footer-section>
</footer>
</div>
<!-- END #app -->

<!-- ================== BEGIN core-js ================== -->
<script src="{{asset('assets/js/vendor.min.js')}}"></script>
<script src="{{asset('assets/js/app.min.js')}}"></script>
<!-- ================== END core-js ================== -->

<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.validate.js')}}"></script>
<!-- ================== BEGIN page-js ================== -->
<script src="{{asset('assets/plugins/jquery-migrate/dist/jquery-migrate.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('assets/plugins/moment/min/moment.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-slider/dist/bootstrap-slider.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-3-typeahead/bootstrap3-typeahead.js')}}"></script>
<script src="{{asset('assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js')}}"></script>
{{--<script src="{{asset('assets/plugins/tag-it/js/tag-it.min.js')}}"></script>--}}
<script src="{{asset('assets/plugins/blueimp-file-upload/js/vendor/jquery.ui.widget.js')}}"></script>
<script src="{{asset('assets/plugins/blueimp-tmpl/js/tmpl.min.js')}}"></script>
<script src="{{asset('assets/plugins/blueimp-load-image/js/load-image.all.min.js')}}"></script>
<script src="{{asset('assets/plugins/blueimp-canvas-to-blob/js/canvas-to-blob.min.js')}}"></script>
<script src="{{asset('assets/plugins/blueimp-gallery/js/jquery.blueimp-gallery.min.js')}}"></script>
<script src="{{asset('assets/plugins/blueimp-file-upload/js/jquery.iframe-transport.js')}}"></script>
<script src="{{asset('assets/plugins/blueimp-file-upload/js/jquery.fileupload.js')}}"></script>
<script src="{{asset('assets/plugins/blueimp-file-upload/js/jquery.fileupload-process.js')}}"></script>
<script src="{{asset('assets/plugins/blueimp-file-upload/js/jquery.fileupload-image.js')}}"></script>
<script src="{{asset('assets/plugins/blueimp-file-upload/js/jquery.fileupload-audio.js')}}"></script>
<script src="{{asset('assets/plugins/blueimp-file-upload/js/jquery.fileupload-video.js')}}"></script>
<script src="{{asset('assets/plugins/blueimp-file-upload/js/jquery.fileupload-validate.js')}}"></script>
<script src="{{asset('assets/plugins/blueimp-file-upload/js/jquery.fileupload-ui.js')}}"></script>
<script src="{{asset('assets/plugins/summernote/dist/summernote-lite.min.js')}}"></script>
<script src="{{asset('assets/plugins/spectrum-colorpicker2/dist/spectrum.min.js')}}"></script>
<script src="{{asset('assets/plugins/select-picker/dist/picker.min.js')}}"></script>
<script src="{{asset('assets/plugins/highlight.js/highlight.min.js')}}"></script>
<script src="{{asset('assets/js/demo/highlightjs.demo.js')}}"></script>
<script src="{{asset('assets/js/demo/form-plugins.demo.js')}}"></script>
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
{{--<script src="{{asset('assets/plugins/jvectormap-next/jquery-jvectormap.js')}}"></script>--}}
{{--<script src="{{asset('assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js')}}"></script>--}}


<!-- ================== END page-js ================== -->

<!-- ================== BEGIN Datatable-js ================== -->
<script src="{{asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>
<!-- ================== END Datatable-js ================== -->

{{--<script src="{{asset('assets/plugins/bootstrap-table/dist/bootstrap-table.min.js')}}"></script>--}}
<script src="{{asset('assets/js/demo/table-plugins.demo.js')}}"></script>
<!-- ================== END Datatable-js ================== -->
<!-- ================== BEGIN MODAL-js ================== -->
<script src="{{asset('assets/js/modal/ui-modal-notification.demo.js')}}"></script>
<!-- ================== END MODAL-js ================== -->



<script src="{{asset('assets/plugins/bootstrap-table/dist/bootstrap-table.min.js')}}"></script>
<script src="{{asset('assets/js/demo/table-plugins.demo.js')}}"></script>



{{--<!-- ================== BEGIN DATEPICKER-js ================== -->--}}
    <script>
        $('#datepicker').datepicker({
            autoclose: true
        });
    </script>
<!-- ================== End DATEPICKER-js ================== -->
<script>
    //<!-- ================== Begin Sidebar Menu expand-js ================== -->
    $("#sidebarMenu .has-sub").on('click',function (){
        var $this = $(this);
        if ($this.hasClass('expand')) {
            $this.removeClass('expand');
            $this.parent().find('.menu-submenu').css('display', 'none');
        } else {
            $this.addClass('expand');
            $this.parent().find('.menu-submenu').css('display', 'block');
        }
    })
    // <!-- ================== End Sidebar expand-js ================== -->
    $(document).ready( function () {

        $('.ex-search').picker({search : true});

        $(".select2").select2({
            allowClear: true
        })

        $("#alert").fadeTo(5000, 500).slideUp(500, function () {
            $("#alert").slideUp(500);
        });
    } );
    $('.app a').click(function(e){
        // $('#sidebar').load(document.URL +  ' #sidebar');
        e.preventDefault //keeps the link from performing default behavior
        // add other stuff to happen when the links are clicked.....
    })
    function onDelete(e) {
        console.log(e.id)
        document.getElementById('delForm').setAttribute('action', e.id)
    }

</script>
<script id="template-upload" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
		<tr class="template-upload">
			<td>
				<span class="preview d-flex justify-content-center flex-align-center" style="height: 80px"></span>
			</td>
			<td>
				<p class="name mb-1">{%=file.name%}</p>
				<strong class="error text-danger"></strong>
			</td>
			<td>
				<p class="size mb-2">Processing...</p>
{{--				<div class="progress progress-sm mb-0 h-10px progress-striped active"><div class="progress-bar bg-theme" style="min-width: 2em; width:0%;"></div></div>--}}
			</td>
{{--			<td nowrap>--}}
{{--				{% if (!i && !o.options.autoUpload) { %}--}}
{{--					<button class="btn btn-outline-theme btn-sm d-block w-100 start" disabled>--}}
{{--						<span>Start</span>--}}
{{--					</button>--}}
{{--				{% } %}--}}
{{--				{% if (!i) { %}--}}
{{--					<button class="btn btn-outline-default btn-sm d-block w-100 cancel mt-2">--}}
{{--						<span>Cancel</span>--}}
{{--					</button>--}}
{{--				{% } %}--}}
{{--			</td>--}}
		</tr>
	{% } %}
	</script>
<!-- BEGIN template-download -->
<script id="template-download" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
		<tr class="template-download">
			<td>
				<span class="preview d-flex justify-content-center flex-align-center" style="height: 80px">
					{% if (file.thumbnailUrl) { %}
						<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
					{% } %}
				</span>
			</td>
			<td>
				<p class="name">
					{% if (file.url) { %}
						<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
					{% } else { %}
						<span>{%=file.name%}</span>
					{% } %}
				</p>
				{% if (file.error) { %}
					<div><span class="label label-danger">Error</span> {%=file.error%}</div>
				{% } %}
			</td>
			<td>
				<span class="size">{%=o.formatFileSize(file.size)%}</span>
			</td>
			<td nowrap>
				{% if (file.deleteUrl) { %}
					<button class="btn btn-outline-danger btn-sm btn-block delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
						<span>Delete</span>
					</button>
					<div class="form-check mt-2">
						<input type="checkbox" id="{%=file.deleteUrl%}" name="delete" value="1" class="form-check-input toggle" />
						<label for="{%=file.deleteUrl%}" class="form-check-label"></label>
					</div>
				{% } else { %}
					<button class="btn btn-outline-default btn-sm d-block w-100 cancel">
						<span>Cancel</span>
					</button>
				{% } %}
			</td>
		</tr>
	{% } %}
	</script>

<!-- END template-download -->
@stack('customScripts')
</body>
</html>
