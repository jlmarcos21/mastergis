<script src="https://cdn.jsdelivr.net/npm/svg-to-pdfkit@0.1.7/examples/pdfkit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/svg-to-pdfkit@0.1.7/examples/blobstream.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/svg-to-pdfkit@0.1.7/source.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script>

function createPdf() {

	let compress = 'false',
		pagewidth = parseFloat(($('#svgcertificate').width() * 3) / 4 ),
		pageheight = parseFloat(($('#svgcertificate').height() * 3) / 4 ),
		showViewport = false,
		x = null,
		y = null;
	  
	let options = {
		useCSS: false,
		assumePt: false,
		preserveAspectRatio: "",
		width: null,
		height: null
	};

  	let doc = new PDFDocument({compress: compress, size: [pagewidth || 612, pageheight || 792]}),
		textarea = $('#bg-svg');

  	//Crear PDF
  	SVGtoPDF(doc, textarea.html(), x, y, options);

	let stream = doc.pipe(blobStream());
	stream.on('finish', function() {
		let blob = stream.toBlob('application/pdf');
		if (navigator.msSaveOrOpenBlob) {
		navigator.msSaveOrOpenBlob(blob, 'File.pdf');
		} else {
			document.getElementById('pdf-file').contentWindow.location.replace(URL.createObjectURL(blob));
		}
	});

	$('#bg-svg').hide()
	$('#pdf-file').show()

	doc.end()

}

</script>