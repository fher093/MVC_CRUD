class suma
{
 
	constructor(numero1, numero2){
		this.numero1 = numero1;
		this.numero2 = numero2;	
	} 

	sumar(){
		return this.numero1 + this.numero2;
	}
} 

function sumita(){
	var num1 = document.getElementById("num1").value;
	var num2 = document.getElementById("num2").value;

	var res = new suma(parseInt(num1), parseInt(num2));
	alert("El resultado es: " + res.sumar());
}