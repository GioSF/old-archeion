<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>{{ config('app.name', 'Laravel') }}</title>

		<!-- Fonts -->
		<link rel="dns-prefetch" href="//fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css?family=Nunito|Source+Code+Pro|IBM+Plex+Mono|Raleway:300&display=swap" rel="stylesheet">

		<!-- Scripts -->
		<script src="{{ asset('js/app.js') }}"></script>
		<script
			  src="https://code.jquery.com/jquery-3.5.1.js"
			  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
			  crossorigin="anonymous"></script>
		<script
			  src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
			  integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
			  crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

		<!-- Styles -->
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
		<!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
		<link href="{{ asset('css/wb.css') }}" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

		<style type="text/css">
			img {
				display: block;
				max-width: 100%;
			}
			.preview {
				overflow: hidden;
				width: 160px; 
				height: 160px;
				margin: 10px;
				border: 1px solid red;
			}
			.modal-lg{
				max-width: 1000px !important;
			}
		</style>

		
	</head>

	<body>
		<div id="app">

				{!! view('blocos.navbar') !!}

				@yield('content')

				{!! view('componentes.footer') !!}
			
		</div>

	</body>

	<script type="text/javascript">

		$(document).ready(function() {
		/**
		* for showing edit item popup
		*/
			$('body').on('click', '#editar-item-grid', function (event) {
				var button = $(event.currentTarget) // Button that triggered the modal
				var recipient = button.data('whatever') // Extract info from data-* attributes
				// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
				// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
				var modal = $('#editar-modal')

				// Atribui aos inputs do modal os atributos do 
				// objeto (noticia, ficha, etc) que vem do link editar
				// Importante: os ids dos inputs dos modais devem ter
				// nome identico aos atributos do objeto

				jQuery.each(recipient, function(name, value) {
					modal.find('#modal-' + name).val(value)
				});

				//Substitui id da ficha em modal-form > action > route
				var str = $('#modal-form').attr('action');
				var i = str.lastIndexOf('/');
				if (i != -1) {
					str = str.substr(0, i + 1) + recipient.id;
				}
				modal.find('#modal-form').attr('action', str)

			})

			$('#apagar-modal').on('shown.bs.modal', function (event) {

				var button = $(event.relatedTarget) // Button that triggered the modal
				var recipient = button.data('whatever') // Extract info from data-* attributes
				// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
				var modal = $(this)

				//Substitui id da ficha em modal-form > action > route
				var str = $('#modal-form').attr('action');
				console.log(str)
				var i = str.lastIndexOf('/');
				if (i != -1) {
					str = str.substr(0, i + 1) + recipient.id;
				}
				modal.find('#modal-form').attr('action', str)

			})

			setTimeout(function() {
				$(".alert").fadeOut().empty();
			}, 3000);

			$.datepicker.setDefaults({
				dateFormat: 'dd-mm-yy',
				changeMonth: true,
				changeYear: true,
				showOtherMonths: true,
				selectOtherMonths: true,
				dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
				dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
				monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
				yearRange: '1500:'+(new Date).getFullYear()
			});

			$( function() {
				var dateFormat = "dd-mm-yy",
				to = $('#duracao_edicao').datepicker({
					defaultDate: "+1w",
					changeMonth: true,
				});

				$("#data_edicao").datepicker({
					onSelect: function(dateStr) 
					{
						$('#duracao_edicao').val(dateStr);
						to.datepicker("option", "minDate", dateStr);
					}
				});

				$("#modal-data_edicao").datepicker({
					onSelect: function(dateStr) 
					{
						$('#modal-duracao_edicao').val(dateStr);
						to.datepicker("option", "minDate", dateStr);
					}
				});

				function getDate( element ) {
					var date;
					try {
						date = $.datepicker.parseDate( dateFormat, element.value );
					} catch( error ) {
						date = null;
					}

					return date;
				}
			});

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});


			var $modal = $('#modal-crop');
			var image = document.getElementById('image');
			var cropper;
			$("body").on("change", ".image", function (e) {
				var files = e.target.files;
				var done = function (url) {
					image.src = url;
					$modal.modal('show');
				};
				var reader;
				var file;
				var url;
				if (files && files.length > 0) {
					file = files[0];
					if (URL) {
						done(URL.createObjectURL(file));
					} else if (FileReader) {
						reader = new FileReader();
						reader.onload = function (e) {
							done(reader.result);
						};
						reader.readAsDataURL(file);
					}
				}
			});
			$modal.on('shown.bs.modal', function () {
				cropper = new Cropper(image, {
					aspectRatio: 1.75,
					viewMode: 1,
					preview: '.preview'
				});
			}).on('hidden.bs.modal', function () {
				cropper.destroy();
				cropper = null;
			});
			$("#crop").click(function () {
				canvas = cropper.getCroppedCanvas({
					width: 700,
					height: 400,
				});
				canvas.toBlob(function (blob) {
					url = URL.createObjectURL(blob);
					var reader = new FileReader();
					reader.readAsDataURL(blob);
					reader.onloadend = function () {
						var base64data = reader.result;
						$.ajax({
							type: "POST",
							dataType: "json",
							// Rota para o CropImageController
							url: "crop-image-upload",
							data: {
								'_token': $('meta[name="_token"]').attr('content'),
								'image': base64data
							},
							success: function (data) {
								/*
									Após o ajax POST request, o CropImageController
									salva a imagem e retorna um json com o atributo filepath.
									Aqui, este filepath é attribuído ao <input hidden>
								*/
								$('#filepath').val(data.filePath);
								$modal.modal('hide');
							}
						});
					}
				});
			})
		})

	</script>

</html>
