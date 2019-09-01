if (document.getElementById('compradores_destacados') !== null && document.getElementById('compradores_destacados').hasChildNodes()) {
	const slider_cd = Tiny.tns({
		container: '#compradores_destacados',
		slideBy: 1,
		autoplay: true,
		mouseDrag: true,
		controls: false,
		nav: false,
		autoplayButtonOutput: false,
		items: 1,
		responsive: {
			768: {
				edgePadding: 20,
				gutter: 20,
				items: 2
			},
			1100: {
				items: 3
			}
		}
	});
}

if (document.getElementById('vendedores_destacados') !== null && document.getElementById('vendedores_destacados').hasChildNodes()) {
	const slider_vd = Tiny.tns({
		container: '#vendedores_destacados',
		slideBy: 1,
		autoplay: true,
		mouseDrag: true,
		controls: false,
		nav: false,
		items: 1,
		autoplayButtonOutput: false,
		responsive: {
			768: {
				edgePadding: 20,
				gutter: 20,
				items: 2
			},
			1100: {
				items: 3
			}
		}
	});
}

if (document.getElementById('vendedores_destacados') !== null && document.getElementById('vendedores_destacados').hasChildNodes()) {
	const slider_mv = Tiny.tns({
		container: '#empresas_mas_visitadas',
		slideBy: 1,
		autoplay: true,
		mouseDrag: true,
		controls: false,
		nav: false,
		items: 1,
		autoplayButtonOutput: false,
		responsive: {
			768: {
				edgePadding: 20,
				gutter: 20,
				items: 2
			},
			1100: {
				items: 3
			}
		}
	});
}

if (document.getElementById('carousel_categorias1') !== null) {
	const slider_categories1 = Tiny.tns({
		container: '#carousel_categorias1',
		slideBy: 1,
		autoplay: true,
		mouseDrag: true,
		controls: false,
		nav: false,
		items: 2,
		autoplayButtonOutput: false,
		responsive: {
			768: {
				edgePadding: 20,
				gutter: 20,
				items: 3
			},
			1100: {
				items: 5
			}
		}
	});
}

if (document.getElementById('carousel_categorias2') !== null) {
	const slider_categories2 = Tiny.tns({
		container: '#carousel_categorias2',
		slideBy: -1,
		autoplay: true,
		mouseDrag: true,
		controls: false,
		nav: false,
		items: 2,
		autoplayButtonOutput: false,
		responsive: {
			768: {
				edgePadding: 20,
				gutter: 20,
				items: 3
			},
			1100: {
				items: 5
			}
		}
	});
}

