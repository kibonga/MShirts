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
                // console.log(pageNum);
                products = products.products;


                Listeners.shop();
                Display.products(products, amount);
                Display.pagination(amount, pageNum);

            })();
        }


        static controller(page = 1) {
            
            (async () => {
                ("HERE");
                let products, perPageNum, pageNum, amount;
                perPageNum = document.querySelector('.active-grid').dataset.offset;
                pageNum = Number(page);


                console.log(`Forwarded: ${pageNum}`);
                const params = Filter.shop();

                (Object.keys(params).length === 0);

                
                params.perPageNum = perPageNum;
                params.pageNum = pageNum;

            
                if(!params || Object.keys(params).length === 0) {
                    products = await this.fetchPOST("getDataAjax.php", { 'method' : "getAllProductsShop", 'params' : params });
                    amount = Number(products.amount[0].amount);
                    pageNum = Number(products.page);
                    products = products.products;
                    Display.products(products, amount);
                    Display.pagination(amount, pageNum);
                }
                else {
                    
                    console.log(params);
                    products = await this.fetchPOST("getDataAjax.php", { 'method' : "getFilteredProducts", 'params' : params });
                    amount = Number(products.amount[0].amount);
                    pageNum = Number(products.page);
                    products = products.products;
                    console.log(`Page num: ${pageNum}`);
                    Display.products(products, amount, pageNum);
                    Display.pagination(amount, pageNum);
                }
                
                

            })();
        
        }



    }





    class Display {

        static products(productsObj, amount, page) {

            (productsObj);
            const loggedUser = document.querySelector('#logged-user').value;
            (loggedUser);

            const div = document.querySelector("#products");
            let content = ``;

            for(let i in productsObj) {
                content += `
                
                        <div class="col-lg-4 col-md-6 col-sm-12">
                        <figure class="card card-product-grid">
                            <div class="img-wrap position-relative"> 
                                <img src="assets/img/${productsObj[i].img_normal}" class="img-fluid">
                                <p class="position-absolute top-0 start-0 bg-light  lead text-dark py-2 mt-4 px-3">${productsObj[i].brand}</p>
                                    <h5 class="d-block mx-3 lead bg-light p-4">Price: <span class="text-success">${productsObj[i].price}</span> &dollar;</h5>
                            </div> <!-- img-wrap.// -->
                            <div class="px-3 mt-3">
                                <span class="lead">Quantity: <br>${Get.quantityInput(loggedUser, productsObj[i].id)}</span>
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
                                ${Get.buyButton(loggedUser, productsObj[i].id)}
                            </figcaption>
                        </figure>
                        <div>



                        </div>
                    </div>

                `;

            }
            div.innerHTML = content;
            document.querySelector('#item-count').innerHTML = amount;
            this.pagination(amount, page);
        }


        static pagination(amount = 1, page = 1) {

            let offset = Get.productsPerPage();
            console.log(offset);

            offset = 6;
            console.log(document.querySelectorAll(".grid"));
            
            if(Get.productsPerPage()) {
                offset = Get.productsPerPage();
            }

            const div = document.querySelector("#pagination");
            let content = ``;
            let end;


            if(amount % offset == 0) {
                end = amount / offset;
            }
            else {
                end = Math.floor(amount/offset+1);
            }

            console.log(offset)
            
            //data-offset="${i*offset}"

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

                    Async.controller(Number(link.dataset.page));
                });
            });


            




        }



    }



    class Get {

        static buyButton(loggedUser, id) {

            let content = ``;

            if(loggedUser === 'customer') {
                content += `
                    <a href="#" class="btn btn-block btn-secondary mt-4 btn-cart" data-bs-toggle="modal" data-bs-target="#add-prod-cart-modal" data-prodid=${id}>Add to cart </a>
                `;
            }

            return content;

        }


        static quantityInput(loggedUser, id) {

            let content = ``;

            if(loggedUser === 'customer') {
                content += `
            
                    <input type="number" id="quantity-${id}" max="100" min="1" value="1">

                `;
            }

            return content;
        }


        // static gridOffset() {

        //     const gridBtns = document.querySelectorAll(".grid");
        //     let offset;
        //     gridBtns.forEach(btn => {
        //         if(btn.classList.contains('active-grid')){
        //             offset = btn.dataset.offset;
        //         };
        //     });

        // }


        static productsPerPage() {

            const gridBtns = document.querySelectorAll(".grid");
            let offset;
            gridBtns.forEach(btn => {
                if(btn.classList.contains('active-grid')) {
                    console.log(btn);
                    console.log(btn.dataset.offset);
                    offset =  btn.dataset.offset;
                }
            });

            return offset;

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
                    Async.controller();
                });
            }

        }


    }




    class Listeners {

        static shop() {

            const inputs = document.querySelectorAll(`input[type="checkbox"]`);
            inputs.forEach(i => {
                i.addEventListener('change', () => {
                    Async.controller();
                });
            });
            document.querySelector("#range").addEventListener('change', () => Async.controller());
            document.querySelector("#select").addEventListener('change', () => Async.controller());
            document.querySelector("#search-products").addEventListener('keyup', () => Async.controller());

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






    if(Paths.location.indexOf('shop.php') !== -1) {
        Async.initShopProducts();
        Helpers.activeGrid();
    }


});

