document.addEventListener("DOMContentLoaded", () => {

    class Paths {

        static location = location.pathname;

        static baseURL = `models/`;
        static ajax = `ajax.php`;

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
                            case 404 : ("404 error");
                            break;
                            case 505 : ("505 error");
                            break;
                            default : ("Some error occurred");
                        }
                    }
                });

                return res;

            }
            catch(err) {
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

                products = await this.fetchPOST("getDataAjax.php", { 'method' : "getAllProducts", 'params' : params });
                amount = Number(products.amount[0].amount);
                pageNum = Number(products.page);
                products = products.products;
                Display.adminProducts(products, amount, pageNum);

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


                Display.adminUsers(users);
                

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


                Display.adminOrders(orders, ordersID, amount, pageNum);
                

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
                        <button data-toggle="modal" data-bs-target="#edit-user-modal" class="edit-user btn " data-userid="${prodObj[i].id}" data-userindex=${i}>
                            <span class="material-icons text-primary">edit</span>
                        </button>
                    </td>
                    <td class="align-middle">
                        <button data-toggle="modal" data-bs-target="#delete-user-modal" class="delete-user btn " data-userid="${prodObj[i].id}" data-userindex=${i}>
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
                    });

                });
            });


        }


        static adminOrders(ordersObj, ordersIDobj, amount, page) {


            const div = document.querySelector("#admin-orders-div");

            let content = ``;

            const groupOrders = [];

            const ordersID = [];
            for(let i in ordersIDobj) {
                ordersID.push(Number(ordersIDobj[i].order_id));
            }


            for(let i in ordersID) {
                groupOrders.push(Object.values(ordersObj).filter(obj => {
                    return ordersID[Number(i)] === (Number(obj.order_id));
                }));
            }


            groupOrders.forEach((o, i) => {
                content += `
                
                <div class="mt-5">
                    <h4 class="">Order no.${i+1}</h4>
                    <p class="lead">Customer: <span class="bg-light text-success p-2">${o[0].customer}</span></p>
                    <p class="lead">Purchased on: <span class="bg-light text-success p-2">${o[0].order_date}</span></p>
                    <p class="lead">Total: <span class="bg-light text-success p-2">$${Get.totalPriceOrders(o)}</span></p>
                    <p class="lead">Remove: 
                    <button data-toggle="modal" data-bs-target="#delete-user-modal" class="delete-user btn " data-orderid="${o[0].order_id}" data-userid="${o[0].user_id}" data-prodid="${o[0].prod_id}">    
                        <span class="material-icons text-danger p-2 bg-light">delete</span>
                    </button></p>
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




            content += `
                
                <table class="table">   
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Color</th>
                            <th scope="col">Inserted on</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="admin-products-table" class="table-striped">
                        
                    </tbody>
                </table>
                
                `;




        }


        static singleProduct(prod) {

            let loggedUser = null
            if(document.querySelector('#customer-type')) {
                loggedUser = document.querySelector('#customer-type').value;
            }

            const div = document.querySelector('#single-product-div');

            document.querySelector('#single-product-h1').innerHTML = `${prod.name} page`;
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


        }


        static ordersCart(orders) {
            const div = document.querySelector('#cart-orders-list');
            let content = ``;

            const userID = Number(document.querySelector(`#cart-user-id`).value);

            for(let i in orders) {

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


            div.innerHTML = content;

            const removeBtns = document.querySelectorAll('.remove-prod-btn');
            removeBtns.forEach(btn => {
                btn.addEventListener('click', () => {

                    const prodID = Number(btn.dataset.prodid);
                    Storage.removeOrderLine(prodID);
                    

                });
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
            <a href="#" class="btn btn-block btn-secondary btn-cart mb-2 mt-3" data-bs-toggle="modal" data-bs-target="#add-prod-cart-modal" data-prodid=${id}>Add to cart </a>
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


        static productsInCart() {

            if(document.querySelector('#customer-cart-quantity')) {

                if(Storage.getOrders().length) {
                    document.querySelector('#customer-cart-quantity').innerHTML = Storage.getOrders().length;
                }
                else {
                    document.querySelector('#customer-cart-quantity').innerHTML = "";
                }
                
            }

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
    }


    if(Paths.location.indexOf('admin-products.php') !== -1) {
        Async.initAdminProducts();
        Helpers.activeGrid();
    }

    if(Paths.location.indexOf('admin-orders.php') !== -1) {
        Async.initAdminOrders();
        Helpers.activeGrid();
    }
    
    if(Paths.location.indexOf('product.php') !== -1) {
        Async.singleProduct();
        // Helpers.activeGrid();
    }

    if(Paths.location.indexOf('cart.php') !== -1) {
        Async.initCart();
        // Helpers.activeGrid();
    }


});

