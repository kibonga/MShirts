document.addEventListener("DOMContentLoaded", () => {

    class Paths {

        static location = location.pathname;

        static baseURL = `models/`;
        static ajax = `ajax.php`;

    }


    class Validator {

        static regEmail = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
        static regName =  /^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15}$/;
        static regProdName =  /^[\w ]{2,50}$/;
        static regUsernameName =  /^[A-Za-zČĆŽŠĐčćžšđ0-9_.+-]{2,30}$/;
        static regSubject = /(^[\w](( \w+)|(\w*))*$)|(^\w$)/;
        static regUsername = /^\w{2,25}$/;
        static regPhone = /^[0-9]{9,10}$/;
        static regZip = /^[1-4][0-9]{4}$/;
        static regPrice = /^\d{1,8}(?:\.\d{1,4})?$/;
        static regCity = /^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15}){0,4}$/;
        static regAddress = /^[#.0-9a-zA-Z\s,-]{2,50}$/;
        static regMessage = /^[\wA-ZŠĐŽČĆa-zšđžčć0-9][\wŠĐČĆŽšđžčć0-9\/\s\.!,?]+$/gm;
        static regDesc = /^[\wA-ZŠĐŽČĆa-zšđžčć0-9][\wŠĐČĆŽšđžčć0-9\/\s\.!,?]+$/gm;
        static regPassword = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,30}$/;

        constructor(inputs, errs) {
            this.inputs = inputs;
            this.errs = errs;
        }

        checkout() {
            const objInputs = this.inputs;
            this.validateEmail(objInputs.email);
            this.validateName(objInputs.firstName, "firstName");
            this.validateName(objInputs.lastName, "lastName");
            this.validatePhone(objInputs.phone);
            this.validateZip(objInputs.zip);
            this.validateCity(objInputs.city);
            this.validateAddress(objInputs.address);


            return this.errs;
        }

        // contact() {
        //     const objInputs = this.inputs;
        //     this.validateEmail(objInputs.email);
        //     this.validateName(objInputs.firstName, "firstName");
        //     this.validateName(objInputs.lastName, "lastName");
        //     this.validateMessage(objInputs.message);

        //     return this.errs;
        // }
        insertImage() {
            const objInputs = this.inputs;
            this.validateProdName(objInputs.name);
            // this.validateDesc(objInputs.desc);
            this.validatePrice(objInputs.price)

            return this.errs;
        }

        login() {
            const objInputs = this.inputs;
            this.validateUsernameEmail(objInputs.usernameEmail);
            this.validatePassword(objInputs.password);

            return this.errs;
        }

        logout() {
            
            const objInputs = this.inputs;
            console.log(objInputs);
            this.validateUsername(objInputs.username);
            this.validateName(objInputs.fname, 'fname');
            this.validateName(objInputs.lname, 'lname');
            this.validateAddress(objInputs.address);
            this.validateEmail(objInputs.email);
            this.validatePassword(objInputs.password1, '1');
            this.validateConfirmPassword(objInputs.password1, objInputs.password2);

            return this.errs;
            
        }

        contact() {
            const objInputs = this.inputs;
            console.log(objInputs);
            this.validateName(objInputs.fname, "fname");
            this.validateName(objInputs.lname, "lname");
            this.validateEmail(objInputs.email);
            this.validateSubject(objInputs.subject);
            // this.validateMessage(objInputs.message);

            return this.errs;
        }

        validateMessage(message) {
            if(!Validator.regMessage.test(message)) {
                this.errs.message = "Message needs to have between 4-100 characters";
            }
        }

        validateName(name, type) {
            if(!Validator.regName.test(name)) {
                this.errs[type] = "Must be between 2-15 characters";
            }
        }

        validateEmail(email) {
            console.log(email);
            if(!Validator.regEmail.test(email)) {
                this.errs.email = "Email is not in good format!";
            }
        }

        validatePhone(phone) {
            if(!Validator.regPhone.test(phone)) {
                this.errs.phone = "Phone number is not in good format!";
            }
        }

        validateAddress(address) {
            if(!Validator.regAddress.test(address)) {
                this.errs.address = "Please enter a valid street address! eg. Main st 123";
            }
        }

        validateCity(city) {
            if(!Validator.regCity.test(city)) {
                this.errs.city = "Please enter a correct city name";
            }
        }

        validateZip(zip) {
            if(!Validator.regZip.test(zip)) {
                this.errs.zip = "Please enter a valid zip number!";
            }
        }

        validatePassword(password, num='') {
            if(!Validator.regPassword.test(password)) {
                this.errs[`password${num}`] = "Please enter a valid password! (eg. Pass123*)";
            }
        }

        validateUsername(username) {
            console.log(username);
            if(!Validator.regUsername.test(username)) {
                this.errs.username = "Please enter a valid username! (eg. MysticMac*)";
            }
        }

        validateUsernameEmail(user) {
            if(!Validator.regUsernameName.test(user) && !Validator.regEmail.test(user)) {
                this.errs.usernameEmail = "Username or email is not valid";
            }
        }

        validateConfirmPassword(password1, password2) {
            if(password1 !== password2) {
                this.errs.password2 = "Passwords don't match";
            }
        }
        
        validateSubject(subject) {
            if(!Validator.regSubject.test(subject)) {
                this.errs.subject = "Please enter a valid subject name!";
            }
        }

        validateProdName(prodName) {
            if(!Validator.regProdName.test(prodName)) {
                this.errs.name = "Please enter a valid product name!";
            }
        }

        validateDesc(desc) {
            if(!Validator.regDesc.test(desc)) {
                this.errs.desc = "Please enter a valid description!";
            }
        }

        validatePrice(price) {
            if(!Validator.regPrice.test(Number(price))) {
                this.errs.price = "Must contain positive numbers only eg 59.99!";
            }
        }

    }


    class Async {

        static headers = {
            'Accept': 'application/json, text/plain, */*',
            "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
        }

        static fetchPOST(url, data = {} ) {
            try {
                
                const res = fetch(Paths.baseURL + url, {
                    method : "POST",
                    headers : this.headers,
                    body : JSON.stringify(data)
                })
                .then(resp => {
                    if(resp.ok) {
                        // (resp);
                        return resp.json();
                    }
                    else {
                        switch(resp.status) {
                            case 404 : {
                                resp.json().then(r => alert(`404 Error: ${r}`));
                            };
                            break;
                            case 500 : {
                                resp.json().then(r => alert(`500 Error: ${r}`));
                            };
                            break;
                            default : {
                                alert("Oops something went wrong...");
                            };
                        }
                    }
                });

                return res;

            }
            catch(err) {
                console.log("HERE WE GO AGAIN");
                throw new Error(err);
            }
        }

        static fetchPOSTimg(url, data = {} ) {
            try {
                
                const res = fetch(Paths.baseURL + url, {
                    method : "POST",
                    body : JSON.stringify(data)
                })
                .then(resp => {
                    if(resp.ok) {
                        // (resp);
                        return resp.json();
                    }
                    else {
                        switch(resp.status) {
                            case 404 : {
                                resp.json().then(r => alert(`404 Error: ${r}`));
                            };
                            break;
                            case 500 : {
                                resp.json().then(r => alert(`500 Error: ${r}`));
                            };
                            break;
                            default : {
                                alert("Oops something went wrong...");
                            };
                        }
                    }
                });

                return res;

            }
            catch(err) {
                console.log("HERE WE GO AGAIN");
                throw new Error(err);
            }
        }


        static initShopProducts() {
            (async () => {

                const params = {};
                params.perPageNum = 6;
                params.pageNum = 1;

        

                let products = await this.fetchPOST("getDataAjax.php", { "method" : "getAllProductsShop", 'params' : params });
                const amount = Number(products.amount[0].amount);
                const pageNum = Number(products.page);
                products = products.products;



                Listeners.shop();
                Display.productsShop(products, amount, pageNum);
                // Display.pagination(amount, pageNum);

            })();
        }


        static controllerShop(page = 1) {
            
            (async () => {
                let products, perPageNum, pageNum, amount;
                perPageNum = document.querySelector('.active-grid').dataset.offset;
                pageNum = Number(page);

                const params = Filter.shop();

                (Object.keys(params).length === 0);

                
                params.perPageNum = perPageNum;
                params.pageNum = pageNum;

                products = await this.fetchPOST("getDataAjax.php", { 'method' : "getFilteredProducts", 'params' : params });
                amount = Number(products.amount[0].amount);
                pageNum = Number(products.page);
                products = products.products;
                Display.productsShop(products, amount, pageNum);

            })();
        
        }

        static controllerAdminProducts(page = 1) {
            
            (async () => {
                let products, perPageNum, pageNum, amount;
                perPageNum = document.querySelector('.active-grid').dataset.offset;
                pageNum = Number(page);

                

                const params = {};
                
                params.perPageNum = perPageNum;
                params.pageNum = pageNum;

                // console.log(prams);

                products = await this.fetchPOST("getDataAjax.php", { 'method' : "getAllProducts", 'params' : params });
                amount = Number(products.amount[0].amount);
                pageNum = Number(products.page);
                products = products.products;
                Display.adminProducts(products, amount, pageNum);

            })();
        
        }

        static controllerAdminMessages(page = 1) {
            (async () => {
                let perPageNum, pageNum, amount;
                perPageNum = document.querySelector('.active-grid').dataset.offset;
                pageNum = Number(page);

                const params = {};
                
                params.perPageNum = perPageNum;
                params.pageNum = pageNum;

                let messages = await this.fetchPOST("getDataAjax.php", { "method" : "getAllMessages", 'params' : params });

                amount = Number(messages.amount[0].amount);
                pageNum = Number(messages.page);
                // const messagesID = messages.dist;
                messages = messages.messages;

                console.log(messages);

                Display.userMessages(messages, amount, pageNum, "admin");

            })();
        }

        static controllerCustomerMessages(page = 1) {
            (async () => {
                const userID = Number(localStorage.getItem("userID"));
                let perPageNum, pageNum, amount;
                perPageNum = document.querySelector('.active-grid').dataset.offset;
                pageNum = Number(page);

                const params = {};
                
                params.perPageNum = perPageNum;
                params.pageNum = pageNum;
                params.user_id = userID;


                let messages = await this.fetchPOST("getDataAjax.php", { "method" : "getAllMessagesID", 'params' : params });
                

                amount = Number(messages.amount[0].amount);
                pageNum = Number(messages.page);
                // const messagesID = messages.dist;
                messages = messages.messages;

                console.log(messages);

                Display.userMessages(messages, amount, pageNum, "customer");
            })();
        }

        static controllerAdminOrders(page = 1) {
            
            (async () => {
                let orders, perPageNum, pageNum, amount;
                perPageNum = document.querySelector('.active-grid').dataset.offset;
                pageNum = Number(page);

                const params = {};

                // console.log(params);
                
                params.perPageNum = perPageNum;
                params.pageNum = pageNum;

                console.log(params);

                orders = await this.fetchPOST("getDataAjax.php", { 'method' : "getAllOrders", 'params' : params });
                amount = Number(orders.amount[0].amount);
                pageNum = Number(orders.page);
                const ordersID = orders.dist;
                orders = orders.orders;


                Display.userOrders(orders, ordersID, amount, pageNum, "admin");

            })();
        
        }

        static controllerCustomerOrders(page = 1) {
            
            (async () => {
                const userID = Number(localStorage.getItem("userID"));
                let orders, perPageNum, pageNum, amount;
                perPageNum = document.querySelector('.active-grid').dataset.offset;
                pageNum = Number(page);

                const params = {};

                // console.log(params);
                
                params.perPageNum = perPageNum;
                params.pageNum = pageNum;
                params.user_id = userID;

                console.log(params);

                orders = await this.fetchPOST("getDataAjax.php", { 'method' : "getAllOrdersID", 'params' : params });
                console.log(orders);

                amount = Number(orders.amount[0].amount);
                pageNum = Number(orders.page);
                const ordersID = orders.dist;
                orders = orders.orders;


                Display.userOrders(orders, ordersID, amount, pageNum, "customer");

            })();
        
        }

        static controllerAdminUsers(page = 1) {
            (async () => {

                let perPageNum = document.querySelector('.active-grid').dataset.offset;
                let pageNum = Number(page);

                console.log(perPageNum);
                console.log(pageNum);

                const params = {};

                console.log(params);
                
                params.perPageNum = perPageNum;
                params.pageNum = pageNum;

                let users = await this.fetchPOST("getDataAjax.php", { 'method' : "getAllUsers", 'params' : params });

                let amount = Number(users.amount[0].amount);
                pageNum = Number(users.page);
                users = users.users;

                Display.adminUsers(users, amount, pageNum);

            })();
        }


        static initAdminUsers() {
            (async () => {

                const params = {};
                params.perPageNum = 6;
                params.pageNum = 1;

                let users = await this.fetchPOST("getDataAjax.php", { "method" : "getAllUsers", 'params' : params });

                const amount = Number(users.amount[0].amount);
                const pageNum = Number(users.page);
                users = users.users;

                console.log(amount);
                console.log(pageNum);
                console.log(users);

                Display.adminUsers(users, amount, pageNum);
                

            })();
        }

        static initAdminProducts() {
            (async () => {

                const params = {};
                params.perPageNum = 6;
                params.pageNum = 1;

                let products = await this.fetchPOST("getDataAjax.php", { "method" : "getAllProducts", 'params' : params });

                const amount = Number(products.amount[0].amount);
                const pageNum = Number(products.page);
                products = products.products;

                



                Display.adminProducts(products, amount, pageNum);
                

            })();
        }

        static initAdminOrders() {

            (async () => {

                const params = {};
                params.perPageNum = 6;
                params.pageNum = 1;

        

                let orders = await this.fetchPOST("getDataAjax.php", { "method" : "getAllOrders", 'params' : params });

                const amount = Number(orders.amount[0].amount);
                const pageNum = Number(orders.page);
                const ordersID = orders.dist;
                orders = orders.orders;


                Display.userOrders(orders, ordersID, amount, pageNum, "admin");
                

            })();

        }

        static initCustomerOrders() {

            (async () => {

                // const userID = document.querySelector('#customer-id').value;
                const userID = Number(localStorage.getItem("userID"));

                console.log(userID);

                const params = {};
                params.perPageNum = 6;
                params.pageNum = 1;
                params.user_id = userID;

                let orders = await this.fetchPOST("getDataAjax.php", { "method" : "getAllOrdersID", 'params' : params });

                let amount = 0;
                if(orders.orders) {
                    amount = Number(orders.amount[0].amount);
                }
                const pageNum = Number(orders.page);
                const ordersID = orders.dist;
                orders = orders.orders;


                Display.userOrders(orders, ordersID, amount, pageNum, "customer");

            })();


        }

        static initAdminMessages() {
            (async () => {

                const params = {};
                params.perPageNum = 6;
                params.pageNum = 1;

                let messages = await this.fetchPOST("getDataAjax.php", { "method" : "getAllMessages", 'params' : params });

                


                const amount = Number(messages.amount[0].amount);
                const pageNum = Number(messages.page);
                const messagesID = messages.dist;
                messages = messages.messages;

                console.log(messages);

                Display.userMessages(messages, amount, pageNum, "admin");

            })();
        }

        static initCustomerMessages() {
            (async () => {
                const userID = Number(localStorage.getItem("userID"));

                const params = {};
                params.perPageNum = 6;
                params.pageNum = 1;
                params.user_id = userID;

                let messages = await this.fetchPOST("getDataAjax.php", { "method" : "getAllMessagesID", 'params' : params });

                


                const amount = Number(messages.amount[0].amount);
                const pageNum = Number(messages.page);
                const messagesID = messages.dist;
                messages = messages.messages;

                console.log(messages);

                Display.userMessages(messages, amount, pageNum, "customer");

            })();
        }


        static initCustomerPoll() {
            (async () => {
                const userID = Number(localStorage.getItem("userID"));

                const params = {};
                params.user_id = userID;
                params.poll_id = 1;

                console.log(params);

                let poll = await this.fetchPOST("getDataAjax.php", { "method" : "selectPollID", "params" : params });
                console.log(poll);
                const question = poll.question.question;
                const hasVoted = Number(poll.voted);
                const answers = poll.answers;
                
                // console.log(question);
                // console.log(answers);

                if(hasVoted) {
                    const results = poll.results;
                    Display.hasVoted(question, answers, results);
                }
                else {
                    Display.notVoted(question, answers);
                }

            })();
        }


        static singleProduct() {

            (async () => {

                if(localStorage.getItem('prodID') === null) {
                    window.location = 'index.php';
                }
    
                const prodID = Number(localStorage.getItem('prodID'));
                const params = {};
                params.prodID = prodID;


                let product = await this.fetchPOST("getDataAjax.php", { "method" : "getProductID", 'params' : params });
                product= product.product[0];
                

                Display.singleProduct(product);

            })();

        }


        static initCart() {

            (async () => {

                let orders;
                if(localStorage.getItem('orders')) {
                    orders = Storage.getOrders('orders');
                    Display.ordersCart(orders);
                }

                const checkout = document.querySelector('#cart-make-purchase');
                checkout.addEventListener('click', e => {
                    e.preventDefault();
                    if(Storage.getOrders().length > 0) {
                        
                    }
                });
                

            })();

        }


        static logoutCustomer(userID) {
            (async () => {

                console.log(userID);

                const params = {};
                params.user_id = userID;
                const cart = [];
                let orders;
                if(localStorage.getItem('orders')) {
                    orders = Storage.getOrders('orders');
                    console.log(orders);
                    for(let i in orders) {
                        cart.push({"prod_id": orders[i].prod_id, "quantity": orders[i].quantity});
                    }
                    params.cart = cart;
                }
                
                console.log(params);
                // console.log(params.cart);
                // console.log(params.user_id);
                let logout = await this.fetchPOST("getDataAjax.php", { "method": "logoutCustomer", "params" : params});
                // console.log(logout);
                Storage.removeOrders();
                window.location.href = "index.php";
                // if(logout === "Succeeded") {
                    
                // }
                

            })();
        }


        static selectProductsID(prodsID, prodsQuantity)  {
            (async () => {
                
                const params = {};
                params.prodsID = prodsID;
                console.log(prodsID)

                let products = await this.fetchPOST("getDataAjax.php", { "method": "selectProductsID", "params" : params});
                for(let i in products) {
                    products[i].quantity = prodsQuantity[i];
                    products[i].totalPrice = Number(prodsQuantity[i] * Number(products[i].price));
                    console.log(products[i]);
                    Storage.addOrderLine(products[i]);
                }

            })();
        }


        static initLogin(params) {
            (async () => {
                console.log(params);

                let login = await this.fetchPOST("getDataAjax.php", { "method": "loginUser", "params" : params});
                if(typeof login === "string") {
                    document.querySelector('#login-user').nextElementSibling.nextElementSibling.innerHTML = login;
                }
                else if(typeof login === "object") {
                    const userID = Number(login['user_id']);
                    if(login['cart']) {
                        const cart = login['cart'];
                        console.log(cart);
                        for(let i in cart) {
                            cart[i].quantity = Number(cart[i].quantity);
                            cart[i].totalPrice = Number(cart[i].totalPrice);
                            Storage.addOrderLine(cart[i]);
                        }
                    }
                    localStorage.setItem('userID', userID);
                    window.location.href = "index.php";
                }
                


            })();
        }

        static registerCustomer(params) {

            (async () => {

                console.log(params)
                let register = await this.fetchPOST("getDataAjax.php", { "method": "registerUser", "params" : params});
                console.log(register);
                if(typeof register === "string") {
                    document.querySelector('#register-user').nextElementSibling.nextElementSibling.innerHTML = register;
                }
                else if(typeof register === "object") {
                    const userID = Number(register['user_id']);
                    localStorage.setItem('userID', userID);
                    window.location.href = "index.php";
                }

            })();

        }


        static insertOrders() {
            (async () => {
                if(Storage.getOrders().length > 0 && localStorage.getItem('userID')) {

                    const order = Storage.getOrders();
                    const userID = localStorage.getItem('userID');
                    const prodID = [];
                    for(let i in order) {
                        prodID.push(order[i].prod_id);
                    }

                    const params = {};
                    params.orders = order;
                    params.prodID = prodID;
                    params.userID = userID;

                    console.log(params);
                    let orders = await this.fetchPOST("getDataAjax.php", { "method": "insertOrders", "params" : params}); 
                    if(orders === "Success") {
                        document.querySelector("#cart-success").innerHTML = "Successfully purchased";
                        Storage.removeOrders();
                        document.querySelector("#cart-orders-list").innerHTML = '';
                        
                    }
                    else {
                        document.querySelector("#cart-no-item").innerHTML = order;
                    }




                }
            })();
        }

        static insertNewProduct(formData) {
            (async () => {

                formData.append('method', "insertNewProduct");
                for(let f of formData) {
                    console.log(f);
                }

                $.ajax({
                    type:'POST',
                    url: "models/upload.php",
                    data:formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(data){
                        console.log("success");
                        console.log(data);
                        alert("Added new product");
                    },
                    error: function(data){
                        console.log("error");
                        console.log(data);
                        alert("Something went wrong");
                    }
                });

            })();
        }


        static contact(params) {
            (async () => {

                let contact = await this.fetchPOST("getDataAjax.php", { "method": "insertMessage", "params" : params});
                console.log(contact);
                console.log(document.querySelector("#contact-success"));
                if(contact == "Success") {
                    document.querySelector("#contact-success").innerHTML = "Message succesfully sent";
                    console.log(document.querySelector("#contact-success"));
                }
                else {
                    document.querySelector("#contact-fail").innerHTML = "Something went wrong";
                }
                

            })();
        }


        static adminRemoveUser(userID){
            (async () => {

                const params = {};
                params.userID = userID;

                let remove = await this.fetchPOST("getDataAjax.php", { "method": "adminRemoveUser", "params" : params});
                console.log(remove);

                // this.controllerAdminUsers();
                Async.controllerAdminUsers();

            })();
        }

        static adminRemoveOrder(orderID, userID) {
            (async () => {

                const params = {};
                params.user_id = userID;
                params.order_id = orderID;

                let remove = await this.fetchPOST("getDataAjax.php", { "method": "adminRemoveOrder", "params" : params});
                console.log(remove);

                // this.controllerAdminUsers();
                Async.controllerAdminOrders();

            })();
        }

        static adminRemoveProduct(prodID) {
            (async() => {
                
                const params = {};
                params.prod_id = prodID;

                let remove = await this.fetchPOST("getDataAjax.php", { "method": "adminRemoveProduct", "params" : params});
                // console.log(remove);

                Async.controllerAdminProducts();

            })();
        }


        static adminRemoveMessage(msgID) {
            (async () => {

                const params = {};
                params.msg_id = msgID;

                let remove = await this.fetchPOST("getDataAjax.php", { "method": "adminRemoveMessage", "params" : params});
                console.log(remove);

                Async.controllerAdminMessages();

            })();
        }


        static customerVote(choiceID) {
            (async () => {

                const userID = Number(localStorage.getItem("userID"));
                const params = {};

                params.user_id = userID;
                params.choice_id = choiceID;

                let insert = await this.fetchPOST("getDataAjax.php", { "method": "insertPollAnswer", "params" : params});
                // console.log(insert);
                this.initCustomerPoll();
            })();
        }

        static initAdminUpdateProduct(msg = null) {
            (async () => {

                if(msg) {
                    alert(msg);
                }

                if(localStorage.getItem('updateProdID') === null) {
                    window.location = 'index.php';
                }
    
                const prodID = Number(localStorage.getItem('updateProdID'));
                const params = {};
                params.prodID = prodID;


                let product = await this.fetchPOST("getDataAjax.php", { "method" : "getProductID", 'params' : params });
                let filters = await this.fetchPOST("getDataAjax.php", {'method': "getAllFilters"});
                console.log(filters);
                product= product.product[0];
                
                console.log(product);
                Display.adminUpdateProduct(product, filters);

            })();
        }


        static adminUpdateProduct(formData) {
            (async () =>{

                

                formData.append('method', "updateProduct");

                for(let f of formData) {
                    console.log(f);
                }

                $.ajax({
                    type:'POST',
                    url: "models/upload.php",
                    data:formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(data){
                        Async.initAdminUpdateProduct("Product updated");
                    },
                    error: function(data){
                        alert(`Failed to update product ${data}`);
                    }
                });

            })();
        }
        

    }




    class Display {

        static productsShop(productsObj, amount, page) {

            let loggedUser = null
            if(document.querySelector('#customer-type')) {
                loggedUser = document.querySelector('#customer-type').value;
            }
            

            const div = document.querySelector("#products");
            let content = ``;

            for(let i in productsObj) {
                content += `
                
                        <div class="col-lg-4 col-md-6 col-sm-12">
                        <figure class="card card-product-grid">
                            <div class="img-wrap position-relative"> 
                                <img src="assets/img/${productsObj[i].img_normal}" class="img-fluid">
                                <p class="position-absolute top-0 start-0 bg-light  lead text-dark py-2 mt-4 px-3">${productsObj[i].brand}</p>
                                    <h5 class="d-block mx-3 lead bg-light p-4">Price: <span class="text-success">&dollar;${productsObj[i].price}</span></h5>
                            </div> <!-- img-wrap.// -->
                            <div class="px-3 mt-3">
                                <span class="lead">${Get.quantityInput(loggedUser, productsObj[i].id)}</span>
                            </div>
                            <figcaption class="info-wrap py-2 px-3">
                                <div class="fix-height">
                                    <h5 class="d-block my-3 lead bg-light p-3">${productsObj[i].name}</h5>
                                    <div class="price-wrap mt-2">
                                    </div> <!-- price-wrap.// -->
                                    <div class="mt-3">
                                        <p class="ms-1">Color: ${productsObj[i].color}</p>
                                        <div class="d-flex justify-content-start">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <a class="btn btn-light border mb-2 btn-view-product" href="#" data-prodid="${productsObj[i].id}">View</a>
                                    ${Get.buyButton(loggedUser, productsObj[i].id, i)}
                                </div>
                            </figcaption>
                        </figure>
                        <div>


                        <div>
                            <input type="hidden" name="name" id="name-${productsObj[i].id}" value="${productsObj[i].name}">
                            <input type="hidden" name="cat" id="cat-${productsObj[i].id}" value="${productsObj[i].cat}">
                            <input type="hidden" name="brand" id="brand-${productsObj[i].id}" value="${productsObj[i].brand}">
                            <input type="hidden" name="color" id="color-${productsObj[i].id}" value="${productsObj[i].color}">
                            <input type="hidden" name="img" id="img-${productsObj[i].id}" value="${productsObj[i].img}">
                            <input type="hidden" name="price" id="price-${productsObj[i].id}" value="${productsObj[i].price}">
                        </div>



                        </div>
                    </div>

                `;

            }

            

            div.innerHTML = content;
            document.querySelector('#item-count').innerHTML = amount;
            this.pagination(amount, page);


            const linksView = document.querySelectorAll(".btn-view-product");
            linksView.forEach(link => {
                link.addEventListener('click', e => {
                    e.preventDefault();
                    localStorage.setItem('prodID', link.dataset.prodid);
                    window.location.href = "product.php";
                });
            });

            const linksAdd = document.querySelectorAll(".btn-cart");
            linksAdd.forEach(link => {
                link.addEventListener('click', e => {
                    e.preventDefault();

                    const prodID = Number(link.dataset.prodidx);
                    const prod = productsObj[prodID];
                    const orderLine = Get.orderLine(prod);

                    Storage.addOrderLine(orderLine);
                    
                    const modal = Helpers.createShopModalAdd(orderLine);
                    modal.show();
                    
                });
            });

        }


        static pagination(amount, page) {

            let offset = Get.productsPerPage();

            const div = document.querySelector("#pagination");
            let content = ``;
            let end;


            if(amount % offset == 0) {
                end = amount / offset;
            }
            else {
                end = Math.floor(amount/offset+1);
            }

            for(let i=1; i<=end; i++) {
                content += `
                
                    <li class="page-item ${ i === page ? "active" : "" }"><a class="page-link pagination-link" ${ i === page ? "active" : "" } href="#" data-page='${i}'>${i}</a></li>
        
                
                `;
            }
            div.innerHTML = content;

            const links = document.querySelectorAll("#pagination .page-link");
            links.forEach((link, idx) => {
                link.classList.remove('clicked');
                link.addEventListener('click', e => {
                    e.preventDefault();
                    if(Paths.location.indexOf('shop.php') !== -1) {
                        Async.controllerShop(link.dataset.page);
                    }
                    else if(Paths.location.indexOf('admin-products.php') !== -1) {
                        Async.controllerAdminProducts(link.dataset.page);
                    }
                    else if(Paths.location.indexOf('admin-orders.php') !== -1) {
                        Async.controllerAdminOrders(link.dataset.page);
                    }
                    else if(Paths.location.indexOf('customer-orders.php') !== -1) {
                        Async.controllerCustomerOrders(link.dataset.page);
                    }
                    else if(Paths.location.indexOf('admin-messages.php') !== -1) {
                        Async.controllerAdminMessages(link.dataset.page);
                    }
                    else if(Paths.location.indexOf('customer-messages.php') !== -1) {
                        Async.controllerCustomerMessages(link.dataset.page);
                    }
                    else if(Paths.location.indexOf('admin-users.php') !== -1) {
                        Async.controllerAdminUsers(link.dataset.page);
                    }
                });
            });

        }



        static adminUsers(usersObj, amount, page) {

            const div = document.querySelector("#admin-users-table");
            let content = ``;

            for(let i in usersObj) {

                content += `
                
                <tr>
                    <th scope="row">${Number(i)+1}</th>
                    <td>${usersObj[i].username}</td>
                    <td>${usersObj[i].first_name}</td>
                    <td>${usersObj[i].last_name}</td>
                    <td>${usersObj[i].email}</td>
                    <td>${usersObj[i].date_created}</td>
                    <td>
                        <button data-toggle="modal" data-bs-target="#delete-user-modal" class="delete-user btn " data-userid="${usersObj[i].id}" data-userindex=${i}>
                            <span class="material-icons text-danger">delete</span>
                        </button>
                    </td>
                </tr>

                `;

            }

            div.innerHTML = content;
            document.querySelector('#item-count').innerHTML = amount;
            this.pagination(amount, page);

            let userID; 
            let userIndex;
            let user;

            const links = document.querySelectorAll('.delete-user');
            links.forEach(link => {
                link.addEventListener("click", e => {
                    e.preventDefault();
                    userID = link.dataset.userid;
                    userIndex = Number(link.dataset.userindex);
                    user = usersObj[userIndex];
                    
                    const modal = new bootstrap.Modal(document.getElementById('delete-user-modal'));
                    document.querySelector('#delete-user-modal-username').innerHTML = user.username;
                    document.querySelector('#delete-user-modal-fname').innerHTML = user.first_name;
                    document.querySelector('#delete-user-modal-lname').innerHTML = user.last_name;
                    document.querySelector('#delete-user-modal-email').innerHTML = user.email;
                    document.querySelector('#delete-user-modal-id').innerHTML = userID;
                    modal.show();

                    document.querySelector('#remove-user-anchor').addEventListener('click', e => {
                        e.preventDefault();
                        // ASYNC
                        Async.adminRemoveUser(Number(userID));
                    });

                });
            });


        }


        static adminProducts(prodObj, amount, page) {


            const div = document.querySelector("#admin-products-table");
            let content = ``;

            for(let i in prodObj) {

                content += `
                
                <tr>
                    <th class="align-middle" scope="row">${Number(i)+1}</th>
                    <td>
                        <img src="assets/img/${prodObj[i].img_thumb}" alt="${prodObj[i].name}-img">
                    </td>
                    <td class="align-middle">${prodObj[i].name}</td>
                    <td class="align-middle" >${prodObj[i].cat}</td>
                    <td class="align-middle">${prodObj[i].brand}</td>
                    <td class="align-middle">${prodObj[i].color}</td>
                    <td class="align-middle">${prodObj[i].date}</td>
                    <td class="align-middle">
                        <button data-toggle="modal" data-bs-target="#edit-user-modal" class="edit-prod btn " data-prodid="${prodObj[i].id}" data-userindex=${i}>
                            <span class="material-icons text-primary">edit</span>
                        </button>
                    </td>
                    <td class="align-middle">
                        <button data-toggle="modal" data-bs-target="#delete-user-modal" class="delete-prod btn " data-prodid="${prodObj[i].id}" data-userindex=${i}>
                            <span class="material-icons text-danger">delete</span>
                        </button>
                    </td>
                </tr>

                `;

            }

            div.innerHTML = content;
            document.querySelector('#item-count').innerHTML = amount;
            this.pagination(amount, page);

            const edits = document.querySelectorAll('.edit-prod');
            edits.forEach(edit => {
                edit.addEventListener('click', e => {
                    e.preventDefault();
                    const prodID = Number(edit.dataset.prodid);
                    localStorage.setItem('updateProdID', prodID);
                    window.location.href = "admin-product-update.php";
                    

                });
            });

            const links = document.querySelectorAll('.delete-prod');
            links.forEach(link => {
                link.addEventListener("click", e => {
                    e.preventDefault();
                    // console.log();
                    const prodID = Number(link.dataset.prodid);

                    Async.adminRemoveProduct(prodID);

                });
            });


        }


        static userOrders(ordersObj, ordersIDobj, amount, page, userType) {


            const div = document.querySelector(`#${userType}-orders-div`);
            

            let content = ``;

            const groupOrders = [];
            
            let dist = 0;

            const ordersID = [];
            for(let i in ordersIDobj) {
                ordersID.push(Number(ordersIDobj[i].order_id));
            }

            for(let i in ordersID) {
                groupOrders.push(Object.values(ordersObj).filter(obj => {
                    return ordersID[Number(i)] === (Number(obj.order_id));
                }));
            }


            console.log(ordersID);

            groupOrders.forEach((o, i) => {
                // console.log(o);
                content += `
                <div class="mt-5">
                    <h4 class="">Order no.${i+1}</h4>
                    <p class="lead">Customer: <span class="bg-light text-success p-2">${o[0].customer}</span></p>
                    <p class="lead">Purchased on: <span class="bg-light text-success p-2">${o[0].order_date}</span></p>
                    <p class="lead">Total: <span class="bg-light text-success p-2">$${Get.totalPriceOrders(o)}</span></p>
                `

                if(userType === 'admin') {
                    content += `
                        <p class="lead">Remove: 
                        <button data-toggle="modal" data-bs-target="#delete-user-modal" class="delete-order btn " data-orderid="${o[0].order_id}" data-userid="${o[0].user_id}" data-prodid="${o[0].prod_id}">    
                            <span class="material-icons text-danger p-2 bg-light">delete</span>
                        </button></p>
                    `
                }

                content += `
                </div>
                <table class="table table-striped table-bordered text-center">   
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Color</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody id="admin-products-table" class="table-striped">

                `;
                for(let i in o) {
                    content += `

                            <tr>
                            <th class="align-middle" scope="row">${Number(i)+1}</th>
                            <td class="align-middle">
                                <img src="assets/img/${o[i].img_thumb}" alt="${o[i].name}-img">
                            </td>
                            <td class="align-middle">${o[i].prod_name}</td>
                            <td class="align-middle">${o[i].cat}</td>
                            <td class="align-middle">${o[i].brand}</td>
                            <td class="align-middle">${o[i].color}</td>
                            <td class="align-middle">$${o[i].prod_price}</td>
                            <td class="align-middle">${o[i].quantity}</td>
                            <td class="align-middle">$${o[i].total_price}</td>
                        </tr>
                    
                    
                    `;
                }


                content += `
                
                    </tbody>
                </table>

                
                `;


            });



            div.innerHTML = content;
            document.querySelector('#item-count').innerHTML = amount;
            this.pagination(amount, page);


            if(Number(localStorage.getItem('userID')) === 1) {
                const btns = document.querySelectorAll('.delete-order');
                btns.forEach(btn => {
                    btn.addEventListener('click', e => {
                        e.preventDefault();
                        const orderID = btn.dataset.orderid;
                        const userID = btn.dataset.userid;

                        Async.adminRemoveOrder(orderID, userID);
                    });
                });
            }




        }


        static singleProduct(prod) {

            let loggedUser = null
            if(document.querySelector('#customer-type')) {
                loggedUser = document.querySelector('#customer-type').value;
            }

            const div = document.querySelector('#single-product-div');

            document.querySelector('#single-product-h1').innerHTML = `${prod.name}`;
            document.querySelector('#single-product-p').innerHTML = `${prod.name}`;

            const content = `

            <div class="mb-5">
                <div class="container">
                    <h3 class="lead  p-3 display-5 mb-3">${prod.name}</h3>
                    <p class="lead col-md-4 bg-light mb-5 p-3">Here you can view info about <span id="single-product-name">${prod.name}</p>
                </div>
            </div>


            <div class="container">
                <div class="row">
                    <div class="d-md-flex justify-content-between">
                    <div class="col-md-3 col-12">
                        <figcatption>
                            <img src="assets/img/${prod.img_normal}"  alt="${prod.name}" class="img-fluid ">
                        </figcaption>
                    </div>
                    <div class="col-md-8 col-12 mt-5 mt-md-0">
                        <h4 class="lead">Name: <span class="bg-light text-success p-2">${prod.name}</span></h4>
                        <p class="lead mt-4">Category: <span class="bg-light text-success p-2">${prod.cat}</span></p>
                        <p class="lead mt-4">Brand: <span class="bg-light text-success p-2">${prod.brand}</span></p>
                        <p class="lead mt-4">Color: <span class="bg-light text-success p-2">${prod.color}</span></p>
                        <p class="lead mt-4">Price: <span class="bg-light text-success p-2">&dollar;${prod.price}</span></p>
                        <p class="lead mt-4">Description: <span class="bg-light text-success p-2">${prod.prod_desc}</span></p>
                        ${Get.buyButtonNumberInput(loggedUser, prod.id)}
                    </div>
                    </div>
                </div>
            </div>

            
            `;


            div.innerHTML = content;

            

            if(localStorage.getItem('userID') != 1) {
                const btn = document.querySelector('.btn-cart-prod');
                btn.addEventListener('click', e => {
                    e.preventDefault();
                    const orderLine = Get.orderLine(prod);

                    Storage.addOrderLine(orderLine);
                    
                    const modal = Helpers.createProductModalAdd(orderLine);
                    console.log(modal);
                    Helpers.backdropIssue();
                    modal.show();

                })
            }


            // const close = document.querySelector('#close-product-modal');
            // close.addEventListener('click', e => {
            //     e.preventDefault();
            // });
            // console.log(close);
            
            // console.log(addBtns);
            // addBtns.forEach(btn => {
            //     btn.addEventListener('click', () => {
            //         console.log(btn);
            //         const orderLine = Get.orderLine(prod);

            //         Storage.addOrderLine(orderLine);
                    
            //         const modal = Helpers.createProductModalAdd(orderLine);
            //         console.log(modal);
            //         modal.show();
            //     });
            // });


        }


        static ordersCart(orders) {
            const div = document.querySelector('#cart-orders-list');
            let content = ``;

            document.querySelector("#modal-number-products-cart").innerHTML = orders.length;

            let total = 0;
            const userID = Number(document.querySelector(`#cart-user-id`).value);

            for(let i in orders) {
                total += orders[i].totalPrice;
                content += `
                

                <tr>
                            <th class="align-middle" scope="row">${Number(i)+1}</th>
                            <td class="align-middle">
                                <img src="assets/img/${orders[i].img}" alt="${orders[i].name}-img">
                            </td>
                            <td class="align-middle">${orders[i].name}</td>
                            <td class="align-middle">${orders[i].cat}</td>
                            <td class="align-middle">${orders[i].brand}</td>
                            <td class="align-middle">${orders[i].color}</td>
                            <td class="align-middle">$${orders[i].price}</td>
                            <td class="align-middle">${orders[i].quantity}</td>
                            <td class="align-middle">$${orders[i].totalPrice.toFixed(2)}</td>
                            <td class="align-middle">
                                <button data-toggle="modal" data-bs-target="#delete-user-modal" class="remove-prod-btn btn " data-userid="${orders[i].prod_id}" data-prodid="${orders[i].prod_id}">    
                                    <span class="material-icons text-danger p-2 bg-light">delete</span>
                                </button>
                            </td>
                        </tr>


                `;


            }



            document.querySelector("#price").innerHTML = total;
            document.querySelector("#total-price").innerHTML = total;
            div.innerHTML = content;

            const removeBtns = document.querySelectorAll('.remove-prod-btn');
            removeBtns.forEach(btn => {
                btn.addEventListener('click', () => {

                    const prodID = Number(btn.dataset.prodid);
                    Storage.removeOrderLine(prodID);
                    

                });
            });

        }


        static userMessages(msgObj, amount, page, userType) {
            
            const div = document.querySelector(`#${userType}-messages-div`);
            let content = `<div class="row">`;


            console.log(amount);


            for(let i in msgObj) {

                content += `

                <div class="mt-5 col-md-8">
                <h4 class="">Message no.${Number(i)+1}</h4>
                <div class="lead">Sender: <p class="bg-light text-success p-2">${msgObj[i].first_name} ${msgObj[i].last_name}</p></div>
                <div class="lead">Email: <p class="bg-light text-success p-2">${msgObj[i].email}</p></div>
                <div class="lead">Received: <p class="bg-light text-success p-2">${msgObj[i].msg_date}</p></div>
                <div class="lead">Subject: <p class="bg-light text-success p-2">${msgObj[i].subject}</p></div>
                <div class="lead mb-3">Message: <p class="bg-light text-success p-2">${msgObj[i].message}</p></div>
                `

                if(Number(localStorage.getItem("userID")) === 1) {
                    content += `
                    
                    <div>
                    <p class="lead">Remove: 
                    <button data-toggle="modal" data-bs-target="#delete-user-modal" class="delete-msg btn " data-msgid="${msgObj[i].msg_id}" data-email="${msgObj[i].email}">    
                        <span class="material-icons text-danger p-2 bg-light">delete</span>
                    </button></p>
                    </div>
                    
                    `
                }

                content +=`
                <hr>
                </div>
                
                `;

            }

            content += `</div>`;

            div.innerHTML = content;
            document.querySelector('#item-count').innerHTML = amount;
            this.pagination(amount, page);



            if(Number(localStorage.getItem('userID')) === 1) {

                const links = document.querySelectorAll('.delete-msg');
                links.forEach(link => {
                    link.addEventListener("click", e => {
                        e.preventDefault();
                        // userID = link.dataset.userid;
                        // userIndex = Number(link.dataset.userindex);
                        // user = usersObj[userIndex];
                        
                        // const modal = new bootstrap.Modal(document.getElementById('delete-user-modal'));
                        // document.querySelector('#delete-user-modal-username').innerHTML = user.username;
                        // document.querySelector('#delete-user-modal-fname').innerHTML = user.first_name;
                        // document.querySelector('#delete-user-modal-lname').innerHTML = user.last_name;
                        // document.querySelector('#delete-user-modal-email').innerHTML = user.email;
                        // document.querySelector('#delete-user-modal-id').innerHTML = userID;
                        // modal.show();

                        const msgID = Number(link.dataset.msgid);
                        console.log(msgID);

                        Async.adminRemoveMessage(msgID);

                    });
                });

            }

            
            

        }


        static notVoted(question, answers) {

            const div = document.querySelector("#customer-poll");
            console.log(answers);
            let content = `
            
            <div class="mt-5">
                <h3 class="lead bg-light p-3">${question}</h3>
            </div>
            <div class="p-3">
                <form action="">
            `;

            for(let i in answers) {
                content += `
                <div class="form-check mt-3">
                    <input class="form-check-input" ${(Number(i) === 0) ? "checked" : ""} type="radio" name="poll" value='${answers[i].id}' id="pollchoice-${i+1}">
                    <label class="form-check-label" for="flexRadioDefault1">
                        ${answers[i].text}
                    </label>
                </div>
                
                `;
            }


            content += `
                    <hr>
                    <div class="mt-3">
                        <button class="btn btn-light border" id="poll-submit">Submit</button>
                    </div>
                </form>
            </div>
            `;

            div.innerHTML = content;


            const btn = document.querySelector("#poll-submit");
            btn.addEventListener('click', e => {
                e.preventDefault();
                const choices = document.querySelectorAll(`input[name="poll"]`);
                let choiceID = null;
                choices.forEach(c => {
                    if(c.checked) {
                        choiceID = Number(c.value);
                    }
                });
                Async.customerVote(choiceID);
            });


        }


        static hasVoted(question, answers, results) {
            const div = document.querySelector("#customer-poll");
            let content = `
            
            <div class="mt-5">
                <h3 class="lead bg-light p-3">${question}</h3>
            </div>
            <div class="p-3">
                <h4 class='lead'>Results</h4>
                <form action="">
            `;

            for(let i in answers) {
                content += `
                <div class="mt-3">
                    <p class="lead">
                        ${answers[i].text}
                        (${results[i]})
                    </p>
                </div>
                
                `;
            }

            content += `
                </form>
            </div>
            `;

            div.innerHTML = content;

        }

        static adminUpdateProduct(product, filters) {

            const divCat = document.querySelector('#cat');
            const divBrand = document.querySelector('#brand');
            const divColor = document.querySelector('#color');
            const name = document.querySelector('#name');
            const desc = document.querySelector('#desc');
            const price = document.querySelector('#price');
            const img = document.querySelector('#img');
            const btn = document.querySelector('#btn');
            name.value = product.name;
            desc.value = product.prod_desc;
            price.value = product.price;

            let content = ``;
            for(let i in filters[0]) {
                // console.log(filters[0][i]);
                content += `
                    <option ${filters[0][i].cat_name == product.cat ? "selected" : ""} value="${filters[0][i].cat_id}">${filters[0][i].cat_name}</option>
                `;
            }
            divCat.innerHTML = content;

            content = ``;
            for(let i in filters[1]) {
                // console.log(filters[1][i]);
                content += `
                    <option ${filters[1][i].brand_name == product.brand ? "selected" : ""} value="${filters[1][i].brand_id}">${filters[1][i].brand_name}</option>
                `;
            }
            divBrand.innerHTML = content;
            content = ``;
            for(let i in filters[2]) {
                // console.log(filters[2][i]);
                content += `
                    <option ${filters[2][i].color_name == product.color ? "selected" : ""} value="${filters[2][i].color_id}">${filters[2][i].color_name}</option>
                `;
            }
            divColor.innerHTML = content;

            img.innerHTML = `
                <img class="img-fluid" src="assets/img/${product.img_normal}" alt="${product.name}">
            `;

            btn.innerHTML = `
                <button class="btn btn-secondary" id="submit" data-prodid='${product.id}'>Add product</button>
            `;

            const submit = document.querySelector("#submit");
            submit.addEventListener('click', e => {
                e.preventDefault();
                const prodID = submit.dataset.prodid;
                
                const check = document.querySelector('#update-product-agree');
                const invalid = document.querySelector('#update-product-invalid');
                if(!check.checked) {
                    invalid.innerHTML = "You must agree first";
                }
                else {
                    invalid.innerHTML = "";
                    const formData = Listeners.updateProduct();
                    console.log(formData);
                    formData.append("prod_id", prodID);
                    if(formData) {
                        Async.adminUpdateProduct(formData);
                    }
                }

            });

        }

    }



    class Get {

        static buyButton(loggedUser, id, idx) {

            let content = ``;
            if(loggedUser === 'customer') {
                content += `
                    <a href="#" class="btn btn-block btn-secondary btn-cart mb-2" data-prodid=${id} data-prodidx=${idx}>Add to cart </a>
                `;
            }

            // data-bs-toggle="modal" data-bs-target="#add-prod-cart-modal"

            return content;

        }

        static buyButtonNumberInput(loggedUser, id) {

            let content = ``;
            if(loggedUser === 'customer') {
                content += `
                <div>
                <label>Quantity:</label> <br>
                <input type="number" id="quantity-${id}" max="100" min="1" value="1">
            </div>
            <div>
                <a href="#" class="btn btn-block btn-secondary btn-cart-prod mb-2 mt-3" data-bs-toggle="modal" data-backdrop="false" data-bs-target="#single-product-add-modal" data-prodid=${id}>Add to cart </a>
            </div>
                `;
            }

            return content;

        }


        static quantityInput(loggedUser, id) {

            let content = ``;

            if(loggedUser === 'customer') {
                content += `
                    <label>Quantity:</label> <br>
                    <input type="number" id="quantity-${id}" max="100" min="1" value="1">

                `;
            }

            return content;
        }


        static productsPerPage() {

            const gridBtns = document.querySelectorAll(".grid");
            let offset;
            gridBtns.forEach(btn => {
                if(btn.classList.contains('active-grid')) {
                    offset =  btn.dataset.offset;
                }
            });

            return offset;

        }


        static totalPriceOrders(ordersObj) {
        
            let total = 0;

            for(let i in ordersObj) {
                total += Number(ordersObj[i].total_price);
            }

            return total;

        }


        static orderLine(prod) {

            const prodName = prod.name;
            const prodID = prod.id;
            const prodCat = prod.cat;
            const prodBrand = prod.brand;
            const prodColor = prod.color;
            const quantity = Number(document.querySelector(`#quantity-${prodID}`).value);
            const price = Number(prod.price);
            const prodImg = prod.img;

            const orderLine = {
                "prod_id" : prodID,
                "name" : prodName,
                "cat" : prodCat,
                "brand" : prodBrand,
                "quantity" : quantity,
                "price" : price,
                "totalPrice" : price * quantity,
                "img" : prodImg,
                "color" : prodColor

            };

            document.querySelector(`#quantity-${prodID}`).value = 1;

            return orderLine;


        }

        


    }



    class Filter {

        static shop() {

            const data = {};

            const catInputs = document.querySelectorAll(`input[name="cat"]`);
            const brandInputs = document.querySelectorAll(`input[name="brand"]`);
            const colorInputs = document.querySelectorAll(`input[name="color"]`);

            let cat = [];
            let brand = [];
            let color = [];

            catInputs.forEach(c => {
                if(c.checked) {
                    cat.push(c.value);
                }
            });
            cat = cat.join(',');

            brandInputs.forEach(b => {
                if(b.checked) {
                    brand.push(b.value);
                }
            });
            brand = brand.join(',');

            colorInputs.forEach(s => {
                if(s.checked) {
                    color.push(s.value);
                }
            });
            color = color.join(',');

            const range = document.querySelector('#range');
            const select = document.querySelector('#select');
            const search = document.querySelector("#search-products");


            cat !== '' ? data.cat = cat : '';
            brand !== '' ? data.brand = brand : '';
            color !== '' ? data.color = color : '';


            range.value > 0 & range.value < 100 ? data.range = range.value : '';
            select.value !== '' ? data.select = select.value : '';
            search.value !== '' ? data.search = search.value : '';

            // return (Object.keys(data).length === 0) ? false : data;
            (data);
            return data;

        }

    }


    class Helpers {


        static activeGrid() {

            const gridBtns = document.querySelectorAll(".grid");

            let n;
            for(let i=0; i<gridBtns.length; i++) {
                gridBtns[i].addEventListener('click', e => {
                    e.preventDefault();
                    if(!gridBtns[i].classList.contains('active-grid')) {
                        gridBtns[i].classList.add('active-grid');
                        if(i===0) {
                            gridBtns[1].classList.remove('active-grid');
                        }
                        else {
                            gridBtns[0].classList.remove('active-grid');
                        }
                    }
                    if(Paths.location.indexOf('shop.php') !== -1) {
                        Async.controllerShop();
                    }
                    else if(Paths.location.indexOf('admin-products.php') !== -1) {
                        console.log("ADMIN PRODUCTS");
                        Async.controllerAdminProducts();
                    }
                    if(Paths.location.indexOf('admin-orders.php') !== -1) {
                        Async.controllerAdminOrders();
                    }
                    if(Paths.location.indexOf('customer-orders.php') !== -1) {
                        Async.controllerCustomerOrders();
                    }
                    if(Paths.location.indexOf('admin-messages.php') !== -1) {
                        Async.controllerAdminMessages();
                    }
                    if(Paths.location.indexOf('customer-messages.php') !== -1) {
                        Async.controllerCustomerMessages();
                    }
                    if(Paths.location.indexOf('admin-users.php') !== -1) {
                        Async.controllerAdminUsers();
                    }
                });
            }

        }


        static adminUsersModal() {

            document.querySelector("#delete-user-div").innerHTML = `

            <div class="modal fade" id="delete-user-modal" tabindex="-1" aria-labelledby="delete-user-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title lead text-danger">You are about to remove: <span class="p-3 bg-light text-success" id="delete-user-modal-username"></span></h5>
                </div>
                <div class="modal-body">
                    <h3 class="lead text-secondary mb-3" id="modal-error-title">Personal info:</h4>
                    <p class="lead" >First name: <span class="bg-light py-1 px-3 text-success" id="delete-user-modal-fname"></span></p>
                    <p class="lead" >Last name: <span class="bg-light py-1 px-3 text-success" id="delete-user-modal-lname"></span></p>
                    <p class="lead" >Email: <span class="bg-light py-1 px-3 text-success" id="delete-user-modal-email"></span></p>
                    <input type="hidden" id="delete-user-modal-id">
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <p class="lead text-danger">Changes made here will be permanent.</p>
                    <div>
                        <a href="#" id="remove-user-anchor" data-bs-dismiss="modal" class="btn btn-danger">Remove</a>
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
                </div>
            </div> 
            `;


        }


        static shopModalAdd() {

            document.querySelector("#shop-add-div").innerHTML = `

            <div class="modal fade" id="shop-add-modal" tabindex="-1" aria-labelledby="shop-add-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title lead"><span class="p-3 text-success" id="shop-add-modal-heading"></span> added to cart</h5>
                </div>
                <div class="modal-body">
                    <h3 class="lead text-secondary mb-3" id="modal-error-title">Personal info:</h4>
                    <p class="lead" >Name: <span class="bg-light py-1 px-3 text-success" id="shop-add-modal-name"></span></p>
                    <p class="lead" >Category: <span class="bg-light py-1 px-3 text-success" id="shop-add-modal-cat"></span></p>
                    <p class="lead" >Brand: <span class="bg-light py-1 px-3 text-success" id="shop-add-modal-brand"></span></p>
                    <p class="lead" >Price: $<span class="bg-light py-1 px-3 text-success" id="shop-add-modal-price"></span></p>
                    <p class="lead" >Quantity: <span class="bg-light py-1 px-3 text-success" id="shop-add-modal-quantity"></span></p>
                    <p class="lead" >Total: $<span class="bg-light py-1 px-3 text-success" id="shop-add-modal-total"></span></p>
                    <input type="hidden" id="shop-add-modal-id">
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <a href="cart.php" class="btn btn-secondary">View in cart</a>
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
                </div>
            </div> 
            `;

        }

        static productModalAdd() {

            

            document.querySelector("#single-product-add-div").innerHTML = `

            <div class="modal fade" id="single-product-add-modal" tabindex="-1" aria-labelledby="single-product-add-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title lead"><span class="p-3 text-success" id="single-product-add-modal-heading"></span> added to cart</h5>
                </div>
                <div class="modal-body">
                    <h3 class="lead text-secondary mb-3" id="modal-error-title">Personal info:</h4>
                    <p class="lead" >Name: <span class="bg-light py-1 px-3 text-success" id="single-product-add-modal-name"></span></p>
                    <p class="lead" >Category: <span class="bg-light py-1 px-3 text-success" id="single-product-add-modal-cat"></span></p>
                    <p class="lead" >Brand: <span class="bg-light py-1 px-3 text-success" id="single-product-add-modal-brand"></span></p>
                    <p class="lead" >Price: $<span class="bg-light py-1 px-3 text-success" id="single-product-add-modal-price"></span></p>
                    <p class="lead" >Quantity: <span class="bg-light py-1 px-3 text-success" id="single-product-add-modal-quantity"></span></p>
                    <p class="lead" >Total: $<span class="bg-light py-1 px-3 text-success" id="single-product-add-modal-total"></span></p>
                    <input type="hidden" id="single-product-add-modal-id">
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <a href="cart.php" class="btn btn-secondary">View in cart</a>
                        <button type="button" class="btn btn-light border" id="close-product-modal" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
                </div>
            </div> 
            `;

            console.log(document.querySelector("#single-product-add-div"));

        }

        static createShopModalAdd(orderLine) {

            const modal = new bootstrap.Modal(document.getElementById('shop-add-modal'));
            document.querySelector('#shop-add-modal-heading').innerHTML = orderLine.name;
            document.querySelector('#shop-add-modal-name').innerHTML = orderLine.name;
            document.querySelector('#shop-add-modal-cat').innerHTML = orderLine.cat;
            document.querySelector('#shop-add-modal-brand').innerHTML = orderLine.brand;
            document.querySelector('#shop-add-modal-price').innerHTML = `$${orderLine.price}`;
            document.querySelector('#shop-add-modal-quantity').innerHTML = orderLine.quantity;
            document.querySelector('#shop-add-modal-total').innerHTML = `$${orderLine.totalPrice.toFixed(2)}`;

            return modal;

        }

        static createProductModalAdd(orderLine) {

            const modal = new bootstrap.Modal(document.getElementById('single-product-add-modal'));
            document.querySelector('#single-product-add-modal-heading').innerHTML = orderLine.name;
            document.querySelector('#single-product-add-modal-name').innerHTML = orderLine.name;
            document.querySelector('#single-product-add-modal-cat').innerHTML = orderLine.cat;
            document.querySelector('#single-product-add-modal-brand').innerHTML = orderLine.brand;
            document.querySelector('#single-product-add-modal-price').innerHTML = `$${orderLine.price}`;
            document.querySelector('#single-product-add-modal-quantity').innerHTML = orderLine.quantity;
            document.querySelector('#single-product-add-modal-total').innerHTML = `$${orderLine.totalPrice.toFixed(2)}`;
            console.log(modal);
            return modal;

        }


        static productsInCart(len = 0) {

            if(document.querySelector('#customer-cart-quantity')) {

                if(Storage.getOrders().length) {
                    document.querySelector('#customer-cart-quantity').innerHTML = Storage.getOrders().length;
                }
                else if(len > 0) {
                    document.querySelector('#customer-cart-quantity').innerHTML = len;
                }
                else {
                    document.querySelector('#customer-cart-quantity').innerHTML = "";
                }
                
            }

        }


        static backdropIssue() {
            const modals = document.querySelectorAll(".modal-backdrop");
            document.on('show.bs.modal', '.modal', function () {
                
                if (modals.length > 1) {
                    modals.not(':first').remove();
                }
            });
            // Remove all backdrop on close
            document.on('hide.bs.modal', '.modal', function () {
                if (modals.length > 1) {
                    modals.remove();
                }
            });


            // $(document).on('show.bs.modal', '.modal', function () {
            //     if ($(".modal-backdrop").length > 1) {
            //         $(".modal-backdrop").not(':first').remove();
            //     }
            // });
            // // Remove all backdrop on close
            // $(document).on('hide.bs.modal', '.modal', function () {
            //     if ($(".modal-backdrop").length > 1) {
            //         $(".modal-backdrop").remove();
            //     }
            // });

        }


    }




    class Listeners {

        static shop() {

            const inputs = document.querySelectorAll(`input[type="checkbox"]`);
            inputs.forEach(i => {
                i.addEventListener('change', () => {
                    Async.controllerShop();
                });
            });
            document.querySelector("#range").addEventListener('change', () => Async.controllerShop());
            document.querySelector("#select").addEventListener('change', () => Async.controllerShop());
            document.querySelector("#search-products").addEventListener('keyup', () => Async.controllerShop());

        }


        static adminProducts() {

        }


        static login() {

            const usernameEmail = document.querySelector('#usernameEmail');
            const password = document.querySelector('#password');
            // const btn = document.querySelector('#login-user');


            let errs = {};
                const data = {};

                usernameEmail.value === "" ? errs.usernameEmail = "Cannot be empty" : usernameEmail.nextElementSibling.innerHTML = '';
                password.value === "" ? errs.password = "Cannot be empty" : password.nextElementSibling.innerHTML = "";
                data.usernameEmail = usernameEmail.value.trim();
                data.password = password.value.trim();

                if(Object.keys(errs).length > 0) {
                    for(let idx in errs) {
                        document.querySelector(`#${idx}`).nextElementSibling.innerHTML = errs[idx];
                        document.querySelector(`#${idx}`).nextElementSibling.classList.add('text-danger');
                    }
                }
                else {
                    const validator = new Validator(data, errs);
                    errs = validator.login();
                    if(Object.keys(errs).length > 0) {
                        for(let idx in errs) {
                            document.querySelector(`#${idx}`).nextElementSibling.innerHTML = errs[idx];
                            document.querySelector(`#${idx}`).nextElementSibling.classList.add('text-danger');
                        }
                    }
                    else {
                        usernameEmail.nextElementSibling.innerHTML = '';
                        usernameEmail.value = '';
                        password.nextElementSibling.innerHTML = "";
                        password.value = '';

                        return data;

                    }
                    
                }




        }

        static logout() {

            const username = document.querySelector('#username');
            const fname = document.querySelector('#fname');
            const lname = document.querySelector('#lname');
            const address = document.querySelector('#address');
            const email = document.querySelector('#email');
            const password1 = document.querySelector('#password1');
            const password2 = document.querySelector('#password2');
            const btn = document.querySelector('#register-user');

            console.log("Jorge");


            let errs = {};
                const data = {};

                username.value === "" ? errs.username = "Cannot be empty" : username.nextElementSibling.innerHTML = '';
                fname.value === "" ? errs.fname = "Cannot be empty" : fname.nextElementSibling.innerHTML = "";
                lname.value === "" ? errs.lname = "Cannot be empty" : lname.nextElementSibling.innerHTML = "";
                address.value === "" ? errs.address = "Cannot be empty" : address.nextElementSibling.innerHTML = "";
                email.value === "" ? errs.email = "Cannot be empty" : email.nextElementSibling.innerHTML = "";
                password1.value === "" ? errs.password1 = "Cannot be empty" : password1.nextElementSibling.innerHTML = "";
                password2.value === "" ? errs.password2 = "Cannot be empty" : password2.nextElementSibling.innerHTML = "";

                console.log(errs);

                data.username = username.value.trim();
                data.fname = fname.value.trim();
                data.lname = lname.value.trim();
                data.address = address.value.trim();
                data.email = email.value.trim();
                data.password1 = password1.value.trim();
                data.password2 = password2.value.trim();


                if(Object.keys(errs).length > 0) {
                    for(let idx in errs) {
                        document.querySelector(`#${idx}`).nextElementSibling.innerHTML = errs[idx];
                        document.querySelector(`#${idx}`).nextElementSibling.classList.add('text-danger');
                    }
                }
                else {
                    const validator = new Validator(data, errs);
                    errs = validator.logout();
                    if(Object.keys(errs).length > 0) {
                        for(let idx in errs) {
                            console.log(errs);
                            document.querySelector(`#${idx}`).nextElementSibling.innerHTML = errs[idx];
                            document.querySelector(`#${idx}`).nextElementSibling.classList.add('text-danger');
                        }
                    }
                    else {
                        username.nextElementSibling.innerHTML = '';
                        username.value = '';
                        fname.nextElementSibling.innerHTML = '';
                        fname.value = '';
                        lname.nextElementSibling.innerHTML = '';
                        lname.value = '';
                        address.nextElementSibling.innerHTML = '';
                        address.value = '';
                        email.nextElementSibling.innerHTML = '';
                        email.value = '';
                        password1.nextElementSibling.innerHTML = "";
                        password1.value = '';
                        password2.nextElementSibling.innerHTML = "";
                        password2.value = '';

                        return data;

                    }
                    
                }




        }

        static contact() {

            const fname = document.querySelector("#fname");
            const lname = document.querySelector("#lname");
            const email = document.querySelector("#email");
            const subject = document.querySelector("#subject");
            const message = document.querySelector("#message");

            const empty = "Cannot be empty";
            let errs = {};
            let data  = {};
            fname.value === "" ? errs.fname = empty : fname.nextElementSibling.innerHTML = "";
            lname.value === "" ? errs.lname = empty : lname.nextElementSibling.innerHTML = "";
            email.value === "" ? errs.email = empty : email.nextElementSibling.innerHTML = "";
            subject.value === "" ? errs.subject = empty : subject.nextElementSibling.innerHTML = "";
            message.value === "" ? errs.message = empty : message.nextElementSibling.innerHTML = "";


            data.fname = fname.value.trim();
            data.lname = lname.value.trim();
            data.email = email.value.trim();
            data.subject = subject.value.trim();
            data.message = message.value.trim();

            if(Object.keys(errs).length > 0) {
                for(let idx in errs) {
                    document.querySelector(`#${idx}`).nextElementSibling.innerHTML = errs[idx];
                    document.querySelector(`#${idx}`).nextElementSibling.classList.add('text-danger');
                }
            }
            else {
                const validator = new Validator(data, errs);
                errs = validator.contact();
                if(Object.keys(errs).length > 0) {
                    for(let idx in errs) {
                        document.querySelector(`#${idx}`).nextElementSibling.innerHTML = errs[idx];
                        document.querySelector(`#${idx}`).nextElementSibling.classList.add('text-danger');
                    }
                }
                else {
                    fname.nextElementSibling.innerHTML = '';
                    lname.value = '';
                    lname.nextElementSibling.innerHTML = '';
                    lname.value = '';
                    email.nextElementSibling.innerHTML = '';
                    email.value = '';
                    subject.nextElementSibling.innerHTML = '';
                    subject.value = '';
                    message.nextElementSibling.innerHTML = '';
                    message.value = '';

                    return data;

                }
                
            }


        }


        static insertNewProduct() {

            const name = document.querySelector("#name");
            const desc = document.querySelector("#desc");
            const price = document.querySelector("#price");
            const cat = document.querySelector("#cat");
            const brand = document.querySelector("#brand");
            const color = document.querySelector("#color");
            const img_normal = document.querySelector("#img_normal");
            const img_thumb = document.querySelector("#img_thumb");

            const invalid = document.querySelector('#add-product-invalid');

            if(img_normal.files[0] && img_thumb.files[0]) {
                invalid.innerHTML = "";


            // const usernameEmail = document.querySelector('#usernameEmail');
            // const password = document.querySelector('#password');
            // const btn = document.querySelector('#login-user');


                let errs = {};
                const data = {};
                

                name.value === "" ? errs.name = "Cannot be empty" : name.nextElementSibling.innerHTML = '';
                desc.value === "" ? errs.desc = "Cannot be empty" : desc.nextElementSibling.innerHTML = '';
                price.value === "" ? errs.price = "Cannot be empty" : price.nextElementSibling.innerHTML = '';
                data.name = name.value.trim();
                data.desc = desc.value.trim();
                data.price = price.value.trim();

                if(Object.keys(errs).length > 0) {
                    console.log(errs);
                    for(let idx in errs) {
                        console.log(idx);
                        document.querySelector(`#${idx}`).nextElementSibling.innerHTML = errs[idx];
                        document.querySelector(`#${idx}`).nextElementSibling.classList.add('text-danger');
                    }
                }
                else {
                    const validator = new Validator(data, errs);
                    errs = validator.insertImage();
                    if(Object.keys(errs).length > 0) {
                        console.log(errs);
                        for(let idx in errs) {
                            console.log(errs);
                            document.querySelector(`#${idx}`).nextElementSibling.innerHTML = errs[idx];
                            document.querySelector(`#${idx}`).nextElementSibling.classList.add('text-danger');
                        }
                    }
                    else {
                        name.nextElementSibling.innerHTML = '';
                        desc.nextElementSibling.innerHTML = "";
                        price.nextElementSibling.innerHTML = "";
                        

                        const img = img_normal.files[0];
                        const img2 = img_thumb.files[0];

                        const formData = new FormData();
                        formData.append('img_normal', img);
                        formData.append('img_thumb', img2);
                        formData.append('name', name.value);
                        formData.append('desc', desc.value);
                        formData.append('price', price.value);
                        formData.append('cat', cat.value);
                        formData.append('brand', brand.value);
                        formData.append('color', color.value);

                        img_normal.value = '';
                        img_thumb.value = '';
                        name.value = '';
                        desc.value = '';
                        price.value = '';



                        document.querySelector('#add-product-agree').checked = false;

                        return formData;

                    }
                    
                }





            }
            else {
                invalid.innerHTML = "Must provide both images";
            }

        }

        static updateProduct() {
            const name = document.querySelector("#name");
            const desc = document.querySelector("#desc");
            const price = document.querySelector("#price");
            const cat = document.querySelector("#cat");
            const brand = document.querySelector("#brand");
            const color = document.querySelector("#color");
            const img_normal = document.querySelector("#img_normal");
            const img_thumb = document.querySelector("#img_thumb");

            const invalid = document.querySelector('#add-product-invalid');

            const formData = new FormData();

            if(img_normal.files[0]) {
                formData.append("img_normal", img_normal.files[0]);
            }
            if(img_thumb.files[0]) {
                formData.append('img_thumb', img_thumb.files[0]);
            }

            let errs = {};
            const data = {};
            

            name.value === "" ? errs.name = "Cannot be empty" : name.nextElementSibling.innerHTML = '';
            desc.value === "" ? errs.desc = "Cannot be empty" : desc.nextElementSibling.innerHTML = '';
            price.value === "" ? errs.price = "Cannot be empty" : price.nextElementSibling.innerHTML = '';
            data.name = name.value.trim();
            // data.desc = desc.value.trim();
            data.price = price.value.trim();


            if(Object.keys(errs).length > 0) {
                console.log(errs);
                for(let idx in errs) {
                    console.log(idx);
                    document.querySelector(`#${idx}`).nextElementSibling.innerHTML = errs[idx];
                    document.querySelector(`#${idx}`).nextElementSibling.classList.add('text-danger');
                }
            }
            else {
                const validator = new Validator(data, errs);
                errs = validator.insertImage();
                if(Object.keys(errs).length > 0) {
                    console.log(errs);
                    for(let idx in errs) {
                        console.log(errs);
                        document.querySelector(`#${idx}`).nextElementSibling.innerHTML = errs[idx];
                        document.querySelector(`#${idx}`).nextElementSibling.classList.add('text-danger');
                    }
                }
                else {
                    name.nextElementSibling.innerHTML = '';
                    desc.nextElementSibling.innerHTML = "";
                    price.nextElementSibling.innerHTML = "";

                    formData.append('name', name.value);
                    formData.append('desc', desc.value);
                    formData.append('price', price.value);
                    formData.append('cat', cat.value);
                    formData.append('brand', brand.value);
                    formData.append('color', color.value);


                    document.querySelector('#update-product-agree').checked = false;

                    return formData;

                }
            
        }


            
        }

    }



    class Storage {

        static getOrders() {
            let orders;

            if(localStorage.getItem('orders') === null) {
                orders = [];
            }
            else {
                orders = JSON.parse(localStorage.getItem('orders'));
            }
            return orders;

        }


        static addOrderLine(orderLine) {

            const orders = this.getOrders();
            const newOrderLine = this.isOrderLineInStorage(orderLine);

            if(newOrderLine) {
                const idx = newOrderLine.idx;
                orders[idx] = newOrderLine;
            }
            else {
                orders.push(orderLine);
            }

            localStorage.setItem("orders", JSON.stringify(orders));
            Helpers.productsInCart();

        }

        static isOrderLineInStorage(orderLine) {

            const orders = this.getOrders();

            for(let idx in orders) {
                if(orders[idx].prod_id === orderLine.prod_id) {
                    
                    orders[idx].quantity += orderLine.quantity;
                    orders[idx].totalPrice += orderLine.totalPrice;
                    orders[idx].idx = idx;

                    return orders[idx];
 
                }
            }
            Helpers.productsInCart();
            return false;

        }

        static removeOrderLine(prodID) {

            const orders = this.getOrders();

            for(let idx in orders) {
                if(Number(orders[idx].prod_id) === prodID) {
                    orders.splice(idx, 1);
                }
            }

            localStorage.setItem("orders", JSON.stringify(orders));
            Async.initCart();
            Helpers.productsInCart();

        }

        static removeOrders() {
            localStorage.removeItem('orders');
            Helpers.productsInCart();
        }

    }

    
    Helpers.productsInCart();


    if(Paths.location.indexOf('shop.php') !== -1) {
        Async.initShopProducts();
        Helpers.activeGrid();
        Helpers.shopModalAdd();
    }


    if(Paths.location.indexOf('admin-users.php') !== -1) {
        Async.initAdminUsers();
        Helpers.adminUsersModal();
        Helpers.activeGrid();
    }


    if(Paths.location.indexOf('admin-products.php') !== -1) {
        // console.log("HERE");
        Async.initAdminProducts();
        Helpers.activeGrid();
    }

    if(Paths.location.indexOf('admin-orders.php') !== -1) {
        Async.initAdminOrders();
        Helpers.activeGrid();
    }
    
    if(Paths.location.indexOf('product.php') !== -1) {
        Async.singleProduct();
        Helpers.productModalAdd();
        // Helpers.activeGrid();
    }

    if(Paths.location.indexOf('cart.php') !== -1) {
        Async.initCart();
        // Helpers.activeGrid();
    }

    if(Paths.location.indexOf('customer-orders.php') !== -1) {
        Async.initCustomerOrders();
        Helpers.activeGrid();
    }

    if(Paths.location.indexOf('customer.php') !== -1) {
        Async.initCustomerPoll();
    }


    if(Paths.location.indexOf('login.php') !== -1) {

        const login = document.querySelector("#login-user");
        login.addEventListener('click', e => {
            e.preventDefault();
            document.querySelector('#login-user').nextElementSibling.nextElementSibling.innerHTML = "";
            // VALIDATION
            const data = Listeners.login();
            if(data) {
                Async.initLogin(data);
            }
            // Async.initLogin();
           

        });
        
    }

    if(Paths.location.indexOf('register.php') !== -1) {
        const register = document.querySelector('#register-user');
        register.addEventListener('click', e => {
            e.preventDefault();
            document.querySelector('#register-user').nextElementSibling.nextElementSibling.innerHTML = "";
            const data = Listeners.logout();
            Async.registerCustomer(data);
        });
        
    }

    if(Paths.location.indexOf('cart.php') !== -1) {
        const btn = document.querySelector("#cart-make-purchase");
        btn.addEventListener('click', e => {
            e.preventDefault();
            if(Storage.getOrders().length > 0) {
                Async.insertOrders();
            }
            else {
                document.querySelector('#cart-no-item').innerHTML = "Cart is empty";
            }
        });
    }

    if(Paths.location.indexOf('admin-product-add.php') !== -1) {
        const btn = document.querySelector('#submit');
        const check = document.querySelector('#add-product-agree');
        const invalid = document.querySelector('#add-product-invalid');
        btn.addEventListener('click', () => {
            if(!check.checked) {
                invalid.innerHTML = "You must agree first";
            }
            else {
                invalid.innerHTML = "";
                const formData = Listeners.insertNewProduct();
                if(formData) {
                    Async.insertNewProduct(formData);
                }
            }
        });
    }

    if(Paths.location.indexOf('contact.php') !== -1) {
        const btn = document.querySelector("#contact-submit");
        btn.addEventListener('click', e => {
            e.preventDefault();
            const data = Listeners.contact();
            if(data) {
                Async.contact(data);
            }
        });
    }

    if(Paths.location.indexOf('admin-messages.php') !== -1) {
        Async.initAdminMessages();
        Helpers.activeGrid();
    }
    if(Paths.location.indexOf('customer-messages.php') !== -1) {
        Async.initCustomerMessages();
        Helpers.activeGrid();
    }
    if(Paths.location.indexOf('admin-product-update.php') !== -1) {
        Async.initAdminUpdateProduct();
    }

    (() => {
        if(document.querySelector('#customer-id')) {
            // const userID = Number(document.querySelector('#customer-id').value);
            if(localStorage.getItem('userID')) {
                const userID = localStorage.getItem('userID');
                const logout = document.querySelector('#user-logout');
                logout.addEventListener('click', e => {
                    e.preventDefault();
                    Async.logoutCustomer(userID);
                });
            }
            

            // const prodsID = document.querySelectorAll(".prod_id");
            // const prodsQuantity = document.querySelectorAll(".prod_quantity");

            // const prodID = [];
            // const prodQuantity = []

            // const products = [];
            // prodsID.forEach((p, i) => {
            //     console.log(i);
            //     products.push({"id" : Number(p.value), "quantity" : Number(prodsQuantity[i].value) });
            //     prodID.push(Number(p.value));
            //     prodQuantity.push(Number(prodsQuantity[i].value));
            // });

            // console.log(prodID);

            // Helpers.productsInCart(prodID.length);
            // if(prodID.length > 0) {
            //     Async.selectProductsID(prodID, prodQuantity);
            // }

        }

    })();


});




