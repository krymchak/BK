if (document.title=="Przelew")
{
	var change = function()
	{
		var poprawny = document.getElementById('number').value;
		document.getElementById('number').value = '1234';
		localStorage.setItem('number', poprawny);
	}
	document.getElementById('signin').onclick = change;
}
if (document.title=="Potwierdzenie przelewu")
{
	var poprawny = localStorage.getItem("number");
	document.getElementById("number").innerHTML="<b>Numer konta </b>"+poprawny;
}
if (document.title=="Info przelewu")
{
	var poprawny = localStorage.getItem("number");
	document.getElementById("number").innerHTML="<b>Numer konta </b>"+ poprawny;
}
