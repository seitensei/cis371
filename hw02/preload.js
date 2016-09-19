function OrderItem(ident, meat, price) {
  this.ident = ident;
  this.meat = meat;
  this.price = price;
}

function Patron(patron_id, table) {
  this.patron_id = patron_id;
  this.table = table;
  this.orders = [];
}

var patron_name = window.prompt("Input Patron Name: ", "Anonymouse");
var patron_table = parseInt(window.prompt("Input Table Number: ", "1"));


var patron_instance = new Patron(patron_name, patron_table);
console.log(patron_instance);