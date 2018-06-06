const previousPageBtn = document.getElementById('go-back');
previousPageBtn.onclick = function (event) {
	history.go(-1);
}
