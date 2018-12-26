var goods = {
    cart: [{total: 0}],
    insert_good: function (context) {
        var cart_length = this.cart.length;
        var exist = 0;

        var id = context.getAttribute('data-id');
        var data_name = context.getAttribute('data-name');
        var data_price = context.getAttribute('data-price');

        if(cart_length > 0) {
            exist = this.exist(id);
            if(exist > 0) {
                this.cart[exist].count = this.cart[exist].count + 1;
                this.cart[exist].price = parseInt(this.cart[exist].price) + parseInt(data_price);
                this.calculate_total('+', data_price);
                localStorage.setItem('cart', JSON.stringify(this.cart));
            } else {
                this.cart[cart_length] = {
                    id: id,
                    name: data_name,
                    price: data_price,
                    count: 1
                };
                this.calculate_total('+', data_price);
                localStorage.setItem('cart', JSON.stringify(this.cart));
            }
        } else {
            this.cart[cart_length] = {
                id: id,
                name: data_name,
                price: data_price,
                count: 1
            };
            this.calculate_total('+', data_price);
            localStorage.setItem('cart', JSON.stringify(this.cart));
        }
        this.current_data();
        this.show_cart();
        this.show_total();
    },
    delete_good: function (context) {
        var id = context.getAttribute('data-id');
        var data_price = context.getAttribute('data-price');
        var exist = this.exist(id);

        if(this.cart[exist].price >= data_price) {
            if (this.cart[exist].price > data_price) {
                this.cart[exist].count--;
                this.cart[exist].price = parseInt(this.cart[exist].price) - parseInt(data_price);
                this.calculate_total('-', data_price);
                localStorage.setItem('cart', JSON.stringify(this.cart));
            } else {
                this.calculate_total('-', data_price);
                document.getElementById('count-' + id).innerHTML = '0';
                document.getElementById('price-' + id).innerHTML = '0';
                this.cart.splice(exist, 1);
                localStorage.setItem('cart', JSON.stringify(this.cart));
            }
        }
        this.current_data();
        this.show_cart();
        this.show_total();
        if (this.cart.length == 1) {
            this.empty_cart();
        }
    },
    exist: function (id) {
        var index = this.cart.length;
        var p = 0;
        for(var i = 0; i < index; i++){
            if(this.cart[i].id == id){
                p = i;
            }
        }
        return p;
    },
    check_cart: function () {
        if (localStorage.getItem('cart') != null) {
            this.cart = JSON.parse(localStorage.getItem('cart'));
        }
    },
    empty_cart: function () {
        localStorage.removeItem("cart");
        location.reload(true);
        $("#total").html(goods.cart);
    },
    current_data: function () {
        for (var a = 1; a <= 100; a++) {
            var local = JSON.parse(localStorage.getItem('cart'));
            if (localStorage.getItem('cart') != null) {
                if (local[a] != undefined) {
                    $("#price-" + local[a].id).html(local[a].price);
                    $("#count-" + local[a].id).html(local[a].count);
                }
            }
        }
    },
    calculate_total: function (sign, price) {
        if (sign == '+') {
            this.cart[0].total += parseInt(price);
        }
        if (sign == '-') {
            this.cart[0].total -= parseInt(price);
        }
    },
    show_cart: function () {
        var exist_goods = JSON.parse(localStorage.getItem('cart'));
        if (exist_goods) {
            for (var i = 1; i < exist_goods.length; i++) {
                var id = exist_goods[i].id;
                var name = exist_goods[i].name;
                var count = exist_goods[i].count;
                var price = parseInt(document.getElementById('one-good-' + exist_goods[i].id).innerHTML);
                var index = this.exist(exist_goods[i].id);
                if (index == 1) {
                    $("#exist_goods").html("<tr>" +
                        "<td>" + name + "</td>" +
                        "<td>" + count + "</td>" +
                        "<td>" + exist_goods[i].price + "</td>" +
                        "<td><button onclick='goods.delete_good(this)' data-id='" + id + "' data-name='" + name + "' data-price='" + price + "' type='button' class='btn btn-danger btn-lg remove-from-cart'><span class='glyphicon glyphicon-minus'></span></button></td>" +
                        "<td><button onclick='goods.insert_good(this)' data-id='" + id + "' data-name='" + name + "' data-price='" + price + "' type='button' class='btn btn-success btn-lg insert-to-cart'><span class='glyphicon glyphicon-plus'></span></button></td>"+
                        "<td><button onclick='goods.set_to_zero(this)' data-id='" + id + "' data-sum-one-good='" + exist_goods[i].price + "' type='button' class='btn btn-primary btn-lg'>x</button></td>" +
                        "</tr>");
                } else {
                    $("#exist_goods").append("<tr>" +
                        "<td>" + name + "</td>" +
                        "<td>" + count + "</td>" +
                        "<td>" + exist_goods[i].price + "</td>" +
                        "<td><button onclick='goods.delete_good(this)' data-id='" + id + "' data-name='" + name + "' data-price='" + price + "' type='button' class='btn btn-danger btn-lg remove-from-cart'><span class='glyphicon glyphicon-minus'></span></button></td>" +
                        "<td><button onclick='goods.insert_good(this)' data-id='" + id + "' data-name='" + name + "' data-price='" + price + "' type='button' class='btn btn-success btn-lg insert-to-cart'><span class='glyphicon glyphicon-plus'></span></button></td>"+
                        "<td><button onclick='goods.set_to_zero(this)' data-id='" + id + "' data-sum-one-good='" + exist_goods[i].price + "' type='button' class='btn btn-primary btn-lg'>x</button></td>" +
                        "</tr><h1>Итого: " + this.cart[0].total + "</h1>");
                }
            }
            $("#check").html("<button type='button' data-toggle='collapse' data-target='#zakaz' id='check' class='btn btn-default check-out'>Потвердить заказ</button>");
            $("#itogo").html("<h1>Итого: " + this.cart[0].total + "</h1>");
        } else {
            $("#exist_goods").html("<tr><td><h3>Вы ещё не заказали ни одного товара! Заказывайте быстрее!</h3></td></tr>");
        }
    },
    show_total: function () {

        var exist_goods = JSON.parse(localStorage.getItem('cart'));
        if (exist_goods) {
            if (exist_goods[0].total != 0) {
                $("#common-amount").html(this.cart[0].total);
            } else {
                $("#common-amount").html("");
            }
        }
    },
    set_to_zero: function (context) {
        var id = context.getAttribute('data-id');
        var count = context.getAttribute('data-count');
        var price = context.getAttribute('data-price');
        var sum_one_good = context.getAttribute('data-sum-one-good');
        var exist = this.exist(id);
        console.log(sum_one_good);
        document.getElementById('count-' + id).innerHTML = '0';
        document.getElementById('price-' + id).innerHTML = '0';
        this.cart.splice(exist, 1);
        this.calculate_total('-', sum_one_good);
        console.log(this.cart);
        localStorage.setItem('cart', JSON.stringify(this.cart));
        this.current_data();
        this.show_cart();
        this.show_total();
        if (this.cart.length == 1) {
            this.empty_cart();
        }
    }
};

goods.check_cart();
goods.current_data();
goods.show_cart();
goods.show_total();