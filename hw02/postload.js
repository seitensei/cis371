document.getElementById("patronName").innerHTML = patron_instance.patron_id;
document.getElementById("patronTable").innerHTML = patron_instance.table.toString();

/* 
  Rust Monster - 5 gold
  Goblin - 1 gold
  Intellect Devourer - 10 gold
*/ 

Patron.prototype.appendItem = function(item_id) {
  if(item_id == 1) {
    this.orders.push(new OrderItem(1, "Intellect Devourer", 10));
  }
  if(item_id == 2) {
    this.orders.push(new OrderItem(2, "Goblin", 1));
  }
  if(item_id == 3) {
    this.orders.push(new OrderItem(3, "Rust Monster", 5));
  }
  this.update();
  console.log(JSON.stringify(this.orders))
}

Patron.prototype.update = function() {
  var amount_brain = 0;
  var amount_goblin = 0;
  var amount_rust = 0;
  
  // parse orders for each
  for(var meatindex in this.orders) {
    console.log(JSON.stringify(meatindex));
    if(this.orders[meatindex].ident == 1) {
      amount_brain++;
    }
    if(this.orders[meatindex].ident == 2) {
      amount_goblin++;
    }
    if(this.orders[meatindex].ident == 3) {
      amount_rust++;
    }
  }
  
  var total_brain = amount_brain * 10;
  var total_goblin = amount_goblin * 1;
  var total_rust = amount_rust * 5;
  var total_cost = total_brain + total_goblin + total_rust;
  
  var shim = "<tr><td>QTY</td><td>Meat</td><td>Price</td></tr><tr><td>" + amount_brain + "</td><td>Intellect Devourer</td><td>" + total_brain.toFixed(2) + " Gold</td></tr><tr><td>" + amount_goblin + "</td><td>Goblin</td><td>" + total_goblin.toFixed(2) + " Gold</td></tr><tr><td>" + amount_rust + "</td><td>Rust Monster</td><td>" + total_rust.toFixed(2) + " Gold</td></tr><tr><td></td><td>Total</td><td>" + total_cost.toFixed(2) + " Gold</td></tr>";

  
  document.getElementById("bill").innerHTML = shim;  
}