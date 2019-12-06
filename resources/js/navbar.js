window.onscroll = () => {
	const nav = document.querySelector("#navbar");
	const logo = document.querySelector("#logo");
	const img_logo = document.querySelector("#img-logo");
	const img_small_logo = document.querySelector("#img-small-logo");

	if (window.scrollY <= 20) {
		nav.style = "transition: all ease 1500ms;";
		img_logo.style = "display: block; transition: all ease-in-out 4000ms";
		img_small_logo.style =
			"display: none; transition: all ease-in-out 400ms;";
		logo.classList.add("logo-main");
		logo.classList.remove("small-logo-main");
	} else {
		nav.style = "background-color: #09122e; transition: all ease 1000ms;";
		img_logo.style = "display: none; transition: all ease-in-out 4000ms;";
		img_small_logo.style =
			"display: block; margin-top: -5px; transition: all ease-in-out 4000ms;";
		logo.classList.add("small-logo-main");
		logo.classList.remove("logo-main");
	}
};
